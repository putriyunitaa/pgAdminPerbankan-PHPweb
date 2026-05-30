<?php
// Real processing: add transaksi and update rekening saldo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $id_nasabahfk = isset($_POST['id_nasabahfk']) ? (int) $_POST['id_nasabahfk'] : 0;
    $no_rekeningfk = isset($_POST['no_rekeningfk']) ? $_POST['no_rekeningfk'] : null;
    $jenis = isset($_POST['jenis_transaksi']) ? $_POST['jenis_transaksi'] : '';
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d H:i:s');
    $jumlah = isset($_POST['jumlah']) ? (float) $_POST['jumlah'] : 0;

    if ($id_nasabahfk <= 0 || $no_rekeningfk === null || ($jenis !== 'debit' && $jenis !== 'kredit') || $jumlah <= 0) {
        die('Data transaksi tidak lengkap atau tidak valid.');
    }

    // Start DB transaction
    pg_query($conn, 'BEGIN');

    $sql = "INSERT INTO transaksi (id_nasabahfk, no_rekeningfk, jenis_transaksi, tanggal, jumlah) VALUES ($1,$2,$3,$4,$5) RETURNING no_transaksi";
    $res = pg_query_params($conn, $sql, array($id_nasabahfk, $no_rekeningfk, $jenis, $tanggal, $jumlah));

    if (!$res) {
        pg_query($conn, 'ROLLBACK');
        die('Gagal menyimpan transaksi: ' . pg_last_error($conn));
    }

    $row = pg_fetch_assoc($res);

    // Apply saldo change
    $delta = ($jenis === 'debit') ? -$jumlah : $jumlah;
    $upd = pg_query_params($conn, "UPDATE rekening SET saldo = saldo + $1 WHERE no_rekening = $2", array($delta, $no_rekeningfk));

    if (!$upd) {
        pg_query($conn, 'ROLLBACK');
        die('Gagal mengupdate saldo: ' . pg_last_error($conn));
    }

    pg_query($conn, 'COMMIT');

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

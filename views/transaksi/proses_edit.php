<?php
// Real processing: edit transaksi and adjust rekening saldo accordingly
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $no_transaksi = isset($_POST['no_transaksi']) ? (int) $_POST['no_transaksi'] : 0;
    $new_id = isset($_POST['id_nasabahfk']) ? (int) $_POST['id_nasabahfk'] : 0;
    $new_no = isset($_POST['no_rekeningfk']) ? $_POST['no_rekeningfk'] : null;
    $new_jenis = isset($_POST['jenis_transaksi']) ? $_POST['jenis_transaksi'] : '';
    $new_tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d H:i:s');
    $new_jumlah = isset($_POST['jumlah']) ? (float) $_POST['jumlah'] : 0;

    if ($no_transaksi <= 0 || $new_id <= 0 || $new_no === null || ($new_jenis!=='debit' && $new_jenis!=='kredit') || $new_jumlah <= 0) {
        die('Data tidak valid.');
    }

    pg_query($conn, 'BEGIN');

    // Ambil transaksi lama
    $oldRes = pg_query_params($conn, "SELECT * FROM transaksi WHERE no_transaksi = $1", array($no_transaksi));
    if (!$oldRes) { pg_query($conn,'ROLLBACK'); die('Gagal membaca transaksi lama: '.pg_last_error($conn)); }
    $old = pg_fetch_assoc($oldRes);
    if (!$old) { pg_query($conn,'ROLLBACK'); die('Transaksi tidak ditemukan'); }

    $old_no = $old['no_rekeningfk'];
    $old_jenis = $old['jenis_transaksi'];
    $old_jumlah = (float) $old['jumlah'];

    // Revert old effect
    $revert = ($old_jenis === 'debit') ? $old_jumlah : -$old_jumlah;
    $revUpd = pg_query_params($conn, "UPDATE rekening SET saldo = saldo + $1 WHERE no_rekening = $2", array($revert, $old_no));
    if (!$revUpd) { pg_query($conn,'ROLLBACK'); die('Gagal revert saldo: '.pg_last_error($conn)); }

    // Update transaksi
    $updTrans = pg_query_params($conn, "UPDATE transaksi SET id_nasabahfk=$1, no_rekeningfk=$2, jenis_transaksi=$3, tanggal=$4, jumlah=$5 WHERE no_transaksi=$6", array($new_id, $new_no, $new_jenis, $new_tanggal, $new_jumlah, $no_transaksi));
    if (!$updTrans) { pg_query($conn,'ROLLBACK'); die('Gagal update transaksi: '.pg_last_error($conn)); }

    // Apply new effect
    $apply = ($new_jenis === 'debit') ? -$new_jumlah : $new_jumlah;
    $applyUpd = pg_query_params($conn, "UPDATE rekening SET saldo = saldo + $1 WHERE no_rekening = $2", array($apply, $new_no));
    if (!$applyUpd) { pg_query($conn,'ROLLBACK'); die('Gagal apply saldo baru: '.pg_last_error($conn)); }

    pg_query($conn,'COMMIT');

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

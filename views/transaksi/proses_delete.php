<?php
// Real processing: delete transaksi and revert saldo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $no_transaksi = isset($_POST['no_transaksi']) ? (int) $_POST['no_transaksi'] : 0;
    if ($no_transaksi <= 0) {
        die('ID transaksi tidak valid.');
    }

    pg_query($conn,'BEGIN');

    $oldRes = pg_query_params($conn, "SELECT * FROM transaksi WHERE no_transaksi = $1", array($no_transaksi));
    if (!$oldRes) { pg_query($conn,'ROLLBACK'); die('Gagal membaca transaksi: '.pg_last_error($conn)); }
    $old = pg_fetch_assoc($oldRes);
    if (!$old) { pg_query($conn,'ROLLBACK'); die('Transaksi tidak ditemukan'); }

    $old_no = $old['no_rekeningfk'];
    $old_jenis = $old['jenis_transaksi'];
    $old_jumlah = (float) $old['jumlah'];

    // Revert effect
    $revert = ($old_jenis === 'debit') ? $old_jumlah : -$old_jumlah;
    $revUpd = pg_query_params($conn, "UPDATE rekening SET saldo = saldo + $1 WHERE no_rekening = $2", array($revert, $old_no));
    if (!$revUpd) { pg_query($conn,'ROLLBACK'); die('Gagal revert saldo: '.pg_last_error($conn)); }

    $del = pg_query_params($conn, "DELETE FROM transaksi WHERE no_transaksi = $1", array($no_transaksi));
    if (!$del) { pg_query($conn,'ROLLBACK'); die('Gagal menghapus transaksi: '.pg_last_error($conn)); }

    pg_query($conn,'COMMIT');

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

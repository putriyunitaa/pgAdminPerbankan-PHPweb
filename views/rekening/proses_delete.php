<?php
// Real processing: delete rekening
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $no_rekening = isset($_POST['no_rekening']) ? (int) $_POST['no_rekening'] : 0;
    if ($no_rekening <= 0) {
        die('No rekening tidak valid.');
    }

    // Optionally: cek relasi/transaksi sebelum hapus
    $sql = "DELETE FROM rekening WHERE no_rekening = $1";
    $res = pg_query_params($conn, $sql, array($no_rekening));

    if (!$res) {
        die('Gagal menghapus rekening: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

<?php
// Real processing: delete cabang
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $kode = isset($_POST['kode_cabang']) ? trim($_POST['kode_cabang']) : '';
    if ($kode === '') {
        die('Kode cabang tidak valid.');
    }

    $sql = "DELETE FROM cabang_bank WHERE kode_cabang = $1";
    $res = pg_query_params($conn, $sql, array($kode));

    if (!$res) {
        die('Gagal menghapus cabang: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

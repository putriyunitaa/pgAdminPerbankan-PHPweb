<?php
// Real processing: edit rekening
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $no_rekening = isset($_POST['no_rekening']) ? (int) $_POST['no_rekening'] : 0;
    $pin = isset($_POST['pin']) ? trim($_POST['pin']) : '';
    $saldo = isset($_POST['saldo']) ? (float) $_POST['saldo'] : 0;
    $kode_cabangfk = isset($_POST['kode_cabangfk']) ? $_POST['kode_cabangfk'] : null;

    if ($no_rekening <= 0 || $pin === '' || $kode_cabangfk === null) {
        die('Data tidak lengkap.');
    }

    $sql = "UPDATE rekening SET pin = $1, saldo = $2, kode_cabangfk = $3 WHERE no_rekening = $4";
    $res = pg_query_params($conn, $sql, array($pin, $saldo, $kode_cabangfk, $no_rekening));

    if (!$res) {
        die('Gagal mengupdate rekening: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

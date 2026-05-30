<?php
// Real processing: add rekening
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $no_rekening = isset($_POST['no_rekening']) ? (int) $_POST['no_rekening'] : 0;
    $pin = isset($_POST['pin']) ? trim($_POST['pin']) : '';
    $saldo = isset($_POST['saldo']) ? (float) $_POST['saldo'] : 0;
    $kode_cabangfk = isset($_POST['kode_cabangfk']) ? $_POST['kode_cabangfk'] : null;

    if ($no_rekening <= 0 || $pin === '' || $kode_cabangfk === null) {
        die('Data tidak lengkap.');
    }

    $sql = "INSERT INTO rekening (no_rekening, pin, saldo, kode_cabangfk) VALUES ($1, $2, $3, $4)";
    $res = pg_query_params($conn, $sql, array($no_rekening, $pin, $saldo, $kode_cabangfk));

    if (!$res) {
        die('Gagal menyimpan rekening: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

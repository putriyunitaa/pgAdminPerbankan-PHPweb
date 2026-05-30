<?php
// Real processing: add relasi nasabah-rekening
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $id_nasabahfk = isset($_POST['id_nasabahfk']) ? (int) $_POST['id_nasabahfk'] : 0;
    $no_rekeningfk = isset($_POST['no_rekeningfk']) ? $_POST['no_rekeningfk'] : null;

    if ($id_nasabahfk <= 0 || $no_rekeningfk === null) {
        die('Data relasi tidak lengkap.');
    }

    // Cek apakah relasi sudah ada
    $check = pg_query_params($conn, "SELECT 1 FROM nasabah_has_rekening WHERE id_nasabahfk = $1 AND no_rekeningfk = $2", array($id_nasabahfk, $no_rekeningfk));
    if (pg_fetch_row($check)) {
        die('Relasi sudah ada.');
    }

    $sql = "INSERT INTO nasabah_has_rekening (id_nasabahfk, no_rekeningfk) VALUES ($1, $2)";
    $res = pg_query_params($conn, $sql, array($id_nasabahfk, $no_rekeningfk));

    if (!$res) {
        die('Gagal menyimpan relasi: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

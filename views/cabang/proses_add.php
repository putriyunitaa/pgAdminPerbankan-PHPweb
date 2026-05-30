<?php
// Real processing: add cabang
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $kode = isset($_POST['kode_cabang']) ? trim($_POST['kode_cabang']) : '';
    $nama = isset($_POST['nama_cabang']) ? trim($_POST['nama_cabang']) : '';
    $alamat = isset($_POST['alamat_cabang']) ? trim($_POST['alamat_cabang']) : '';

    if ($kode === '' || $nama === '') {
        die('Kode dan nama cabang tidak boleh kosong.');
    }

    $sql = "INSERT INTO cabang_bank (kode_cabang, nama_cabang, alamat_cabang) VALUES ($1, $2, $3)";
    $res = pg_query_params($conn, $sql, array($kode, $nama, $alamat));

    if (!$res) {
        die('Gagal menyimpan cabang: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

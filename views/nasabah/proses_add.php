<?php
// Real processing: add nasabah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $nama = isset($_POST['nama_nasabah']) ? trim($_POST['nama_nasabah']) : '';
    $alamat = isset($_POST['alamat_nasabah']) ? trim($_POST['alamat_nasabah']) : '';

    if ($nama === '') {
        die('Nama nasabah tidak boleh kosong.');
    }

    $sql = "INSERT INTO nasabah (nama_nasabah, alamat_nasabah) VALUES ($1, $2)";
    $res = pg_query_params($conn, $sql, array($nama, $alamat));

    if (!$res) {
        die('Gagal menyimpan nasabah: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

// If not POST, redirect back
header('Location: list.php');
exit;

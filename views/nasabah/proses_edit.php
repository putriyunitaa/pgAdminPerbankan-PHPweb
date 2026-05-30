<?php
// Real processing: edit nasabah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $id = isset($_POST['id_nasabah']) ? (int) $_POST['id_nasabah'] : 0;
    $nama = isset($_POST['nama_nasabah']) ? trim($_POST['nama_nasabah']) : '';
    $alamat = isset($_POST['alamat_nasabah']) ? trim($_POST['alamat_nasabah']) : '';

    if ($id <= 0) {
        die('ID nasabah tidak valid.');
    }

    if ($nama === '') {
        die('Nama nasabah tidak boleh kosong.');
    }

    $sql = "UPDATE nasabah SET nama_nasabah = $1, alamat_nasabah = $2 WHERE id_nasabah = $3";
    $res = pg_query_params($conn, $sql, array($nama, $alamat, $id));

    if (!$res) {
        die('Gagal mengupdate nasabah: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

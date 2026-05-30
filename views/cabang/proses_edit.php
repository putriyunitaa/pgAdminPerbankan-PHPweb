<?php
// Real processing: edit cabang
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $kode = isset($_POST['kode_cabang']) ? trim($_POST['kode_cabang']) : '';
    $nama = isset($_POST['nama_cabang']) ? trim($_POST['nama_cabang']) : '';
    $alamat = isset($_POST['alamat_cabang']) ? trim($_POST['alamat_cabang']) : '';

    if ($kode === '' || $nama === '') {
        die('Kode dan nama cabang tidak boleh kosong.');
    }

    $sql = "UPDATE cabang_bank SET nama_cabang = $1, alamat_cabang = $2 WHERE kode_cabang = $3";
    $res = pg_query_params($conn, $sql, array($nama, $alamat, $kode));

    if (!$res) {
        die('Gagal mengupdate cabang: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

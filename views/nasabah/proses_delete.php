<?php
// Real processing: delete nasabah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $id = isset($_POST['id_nasabah']) ? (int) $_POST['id_nasabah'] : 0;
    if ($id <= 0) {
        die('ID nasabah tidak valid.');
    }

    $sql = "DELETE FROM nasabah WHERE id_nasabah = $1";
    $res = pg_query_params($conn, $sql, array($id));

    if (!$res) {
        die('Gagal menghapus nasabah: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

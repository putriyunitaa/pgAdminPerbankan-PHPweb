<?php
// Real processing: delete relasi nasabah-rekening
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $id = isset($_POST['id_nasabah']) ? (int) $_POST['id_nasabah'] : 0;
    $no = isset($_POST['no_rekening']) ? $_POST['no_rekening'] : null;

    if ($id <= 0 || $no === null) {
        die('Data tidak valid.');
    }

    $sql = "DELETE FROM nasabah_has_rekening WHERE id_nasabahfk = $1 AND no_rekeningfk = $2";
    $res = pg_query_params($conn, $sql, array($id, $no));

    if (!$res) {
        die('Gagal menghapus relasi: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

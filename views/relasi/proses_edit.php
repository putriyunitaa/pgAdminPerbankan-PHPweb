<?php
// Real processing: edit relasi nasabah-rekening (update composite key)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../core/config.php';

    $old_id = isset($_POST['old_id_nasabah']) ? (int) $_POST['old_id_nasabah'] : 0;
    $old_no = isset($_POST['old_no_rekening']) ? $_POST['old_no_rekening'] : null;

    $new_id = isset($_POST['id_nasabahfk']) ? (int) $_POST['id_nasabahfk'] : 0;
    $new_no = isset($_POST['no_rekeningfk']) ? $_POST['no_rekeningfk'] : null;

    if ($old_id <= 0 || $old_no === null || $new_id <= 0 || $new_no === null) {
        die('Data tidak valid.');
    }

    // Cek duplikasi pada new pair
    $check = pg_query_params($conn, "SELECT 1 FROM nasabah_has_rekening WHERE id_nasabahfk = $1 AND no_rekeningfk = $2", array($new_id, $new_no));
    if (pg_fetch_row($check) && !($old_id==$new_id && $old_no==$new_no)) {
        die('Relasi baru sudah ada.');
    }

    $sql = "UPDATE nasabah_has_rekening SET id_nasabahfk = $1, no_rekeningfk = $2 WHERE id_nasabahfk = $3 AND no_rekeningfk = $4";
    $res = pg_query_params($conn, $sql, array($new_id, $new_no, $old_id, $old_no));

    if (!$res) {
        die('Gagal mengupdate relasi: ' . pg_last_error($conn));
    }

    header('Location: list.php');
    exit;
}

header('Location: list.php');
exit;

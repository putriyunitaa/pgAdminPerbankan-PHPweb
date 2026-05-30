<?php
$page_title = "Edit Nasabah";
ob_start();
include '../../core/config.php';

if (!isset($_GET['id_nasabah'])) {
    die("ID Nasabah tidak ditemukan di URL.");
}

$id_nasabah = (int) $_GET['id_nasabah']; // pastikan integer
$query = "SELECT * FROM nasabah WHERE id_nasabah = $id_nasabah";
$result = pg_query($conn, $query);

if (!$result) {
    die("Query gagal: " . pg_last_error($conn));
}

$data = pg_fetch_assoc($result);
?>
<div class="form-card">
  <h1>Edit Nasabah</h1>
  <form method="post" action="proses_edit.php">
    <input type="hidden" name="id_nasabah" value="<?= $data['id_nasabah'] ?>">
    <div class="form-row">
      <label>Nama Nasabah:</label>
      <input type="text" name="nama_nasabah" value="<?= $data['nama_nasabah'] ?>">
    </div>
    <div class="form-row">
      <label>Alamat Nasabah:</label>
      <input type="text" name="alamat_nasabah" value="<?= $data['alamat_nasabah'] ?>">
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-edit">Update</button>
    </div>
  </form>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

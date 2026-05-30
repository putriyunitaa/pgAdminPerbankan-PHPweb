<?php
$page_title = "Edit Cabang Bank";
ob_start();
include '../../core/config.php';

$kode_cabang = $_GET['kode_cabang'];
$query = "SELECT * FROM cabang_bank WHERE kode_cabang = '$kode_cabang'";
$result = pg_query($conn, $query);
$data = pg_fetch_assoc($result);
?>
<div class="form-card">
  <h1>Edit Cabang Bank</h1>
  <form method="post" action="proses_edit.php">
    <input type="hidden" name="kode_cabang" value="<?= $data['kode_cabang'] ?>">
    <div class="form-row">
      <label>Nama Cabang:</label>
      <input type="text" name="nama_cabang" value="<?= $data['nama_cabang'] ?>">
    </div>
    <div class="form-row">
      <label>Alamat Cabang:</label>
      <input type="text" name="alamat_cabang" value="<?= $data['alamat_cabang'] ?>">
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

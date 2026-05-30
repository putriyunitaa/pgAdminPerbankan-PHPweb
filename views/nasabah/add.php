<?php
$page_title = "Tambah Nasabah";
ob_start();
?>
<div class="form-card">
  <h1>Tambah Nasabah</h1>
  <form method="post" action="proses_add.php">
    <div class="form-row">
      <label>Nama Nasabah:</label>
      <input type="text" name="nama_nasabah">
    </div>
    <div class="form-row">
      <label>Alamat Nasabah:</label>
      <input type="text" name="alamat_nasabah">
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-add">Simpan</button>
    </div>
  </form>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

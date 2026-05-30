<?php
$page_title = "Tambah Cabang Bank";
ob_start();
?>
<div class="form-card">
  <h1>Tambah Cabang Bank</h1>
  <form method="post" action="proses_add.php">
    <div class="form-row">
      <label>Kode Cabang:</label>
      <input type="text" name="kode_cabang">
    </div>
    <div class="form-row">
      <label>Nama Cabang:</label>
      <input type="text" name="nama_cabang">
    </div>
    <div class="form-row">
      <label>Alamat Cabang:</label>
      <input type="text" name="alamat_cabang">
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

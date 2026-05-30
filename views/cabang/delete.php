<?php
$page_title = "Hapus Cabang Bank";
ob_start();
$kode_cabang = $_GET['kode_cabang'];
?>
<div class="form-card confirm-card">
  <h1>Hapus Cabang Bank</h1>
  <p>Apakah Anda yakin ingin menghapus cabang dengan kode <?= $kode_cabang ?>?</p>
  <form method="post" action="proses_delete.php">
    <input type="hidden" name="kode_cabang" value="<?= $kode_cabang ?>">
    <div class="form-actions">
      <button type="submit" class="btn btn-delete">Ya, Hapus</button>
    </div>
  </form>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

<?php
$page_title = "Hapus Nasabah";
ob_start();
$id_nasabah = $_GET['id_nasabah'];
?>
<div class="form-card confirm-card">
  <h1>Hapus Nasabah</h1>
  <p>Apakah Anda yakin ingin menghapus nasabah dengan ID <?= $id_nasabah ?>?</p>
  <form method="post" action="proses_delete.php">
    <input type="hidden" name="id_nasabah" value="<?= $id_nasabah ?>">
    <div class="form-actions">
      <button type="submit" class="btn btn-delete">Ya, Hapus</button>
    </div>
  </form>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

<?php
$page_title = "Hapus Rekening";
ob_start();
$no_rekening = $_GET['no_rekening'];
?>
<div class="form-card confirm-card">
  <h1>Hapus Rekening</h1>
  <p>Apakah Anda yakin ingin menghapus rekening dengan nomor <?= $no_rekening ?>?</p>
  <form method="post" action="proses_delete.php">
    <input type="hidden" name="no_rekening" value="<?= $no_rekening ?>">
    <div class="form-actions">
      <button type="submit" class="btn btn-delete">Ya, Hapus</button>
    </div>
  </form>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

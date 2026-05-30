<?php
$page_title = "Hapus Relasi Nasabah-Rekening";
ob_start();
$id_nasabah = $_GET['id_nasabah'];
$no_rekening = $_GET['no_rekening'];
?>
<div class="form-card confirm-card">
  <h1>Hapus Relasi Nasabah-Rekening</h1>
  <p>Apakah Anda yakin ingin menghapus relasi Nasabah <?= $id_nasabah ?> dengan Rekening <?= $no_rekening ?>?</p>
  <form method="post" action="proses_delete.php">
    <input type="hidden" name="id_nasabahfk" value="<?= $id_nasabah ?>">
    <input type="hidden" name="no_rekeningfk" value="<?= $no_rekening ?>">
    <div class="form-actions">
      <button type="submit" class="btn btn-delete">Ya, Hapus</button>
    </div>
  </form>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

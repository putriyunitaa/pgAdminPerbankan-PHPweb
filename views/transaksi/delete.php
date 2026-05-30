<?php
$page_title = "Hapus Transaksi";
ob_start();
$no_transaksi = $_GET['no_transaksi'];
?>
<div class="form-card confirm-card">
  <h1>Hapus Transaksi</h1>
  <p>Apakah Anda yakin ingin menghapus transaksi dengan nomor <?= $no_transaksi ?>?</p>
  <form method="post" action="proses_delete.php">
    <input type="hidden" name="no_transaksi" value="<?= $no_transaksi ?>">
    <div class="form-actions">
      <button type="submit" class="btn btn-delete">Ya, Hapus</button>
    </div>
  </form>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

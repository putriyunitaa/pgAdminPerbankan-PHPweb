<?php
$page_title = "Tambah Rekening";
ob_start();
include '../../core/config.php';

// Ambil daftar cabang untuk dropdown
$cabang = pg_query($conn, "SELECT kode_cabang, nama_cabang FROM cabang_bank ORDER BY nama_cabang ASC");
?>
<div class="form-card">
  <h1>Tambah Rekening</h1>
  <form method="post" action="proses_add.php">
    <div class="form-row">
      <label>No Rekening:</label>
      <input type="number" name="no_rekening">
    </div>
    <div class="form-row">
      <label>PIN:</label>
      <input type="text" name="pin">
    </div>
    <div class="form-row">
      <label>Saldo Awal:</label>
      <input type="number" name="saldo">
    </div>
    <div class="form-row">
      <label>Cabang:</label>
      <select name="kode_cabangfk">
        <?php while ($row = pg_fetch_assoc($cabang)) { ?>
          <option value="<?= $row['kode_cabang'] ?>"><?= $row['nama_cabang'] ?></option>
        <?php } ?>
      </select>
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

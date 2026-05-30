<?php
$page_title = "Tambah Transaksi";
ob_start();
include '../../core/config.php';

// Ambil daftar nasabah & rekening untuk dropdown
$nasabah = pg_query($conn, "SELECT id_nasabah, nama_nasabah FROM nasabah ORDER BY nama_nasabah ASC");
$rekening = pg_query($conn, "SELECT no_rekening FROM rekening ORDER BY no_rekening ASC");
?>
<div class="form-card">
  <h1>Tambah Transaksi</h1>
  <form method="post" action="proses_add.php">
    <div class="form-row">
      <label>Nasabah:</label>
      <select name="id_nasabahfk">
        <?php while ($n = pg_fetch_assoc($nasabah)) { ?>
          <option value="<?= $n['id_nasabah'] ?>"><?= $n['nama_nasabah'] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="form-row">
      <label>No Rekening:</label>
      <select name="no_rekeningfk">
        <?php while ($r = pg_fetch_assoc($rekening)) { ?>
          <option value="<?= $r['no_rekening'] ?>"><?= $r['no_rekening'] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="form-row">
      <label>Jenis Transaksi:</label>
      <select name="jenis_transaksi">
        <option value="debit">Debit</option>
        <option value="kredit">Kredit</option>
      </select>
    </div>

    <div class="form-row">
      <label>Tanggal:</label>
      <input type="datetime-local" name="tanggal">
    </div>

    <div class="form-row">
      <label>Jumlah:</label>
      <input type="number" name="jumlah">
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

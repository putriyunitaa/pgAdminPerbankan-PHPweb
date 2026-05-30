<?php
$page_title = "Edit Transaksi";
ob_start();
include '../../core/config.php';

$no_transaksi = $_GET['no_transaksi'];
$query = "SELECT * FROM transaksi WHERE no_transaksi = $no_transaksi";
$result = pg_query($conn, $query);
$data = pg_fetch_assoc($result);

$nasabah = pg_query($conn, "SELECT id_nasabah, nama_nasabah FROM nasabah ORDER BY nama_nasabah ASC");
$rekening = pg_query($conn, "SELECT no_rekening FROM rekening ORDER BY no_rekening ASC");
?>
<div class="form-card">
  <h1>Edit Transaksi</h1>
  <form method="post" action="proses_edit.php">
    <input type="hidden" name="no_transaksi" value="<?= $data['no_transaksi'] ?>">

    <div class="form-row">
      <label>Nasabah:</label>
      <select name="id_nasabahfk">
        <?php while ($n = pg_fetch_assoc($nasabah)) { ?>
          <option value="<?= $n['id_nasabah'] ?>" <?= ($n['id_nasabah']==$data['id_nasabahfk'])?'selected':'' ?>>
            <?= $n['nama_nasabah'] ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="form-row">
      <label>No Rekening:</label>
      <select name="no_rekeningfk">
        <?php while ($r = pg_fetch_assoc($rekening)) { ?>
          <option value="<?= $r['no_rekening'] ?>" <?= ($r['no_rekening']==$data['no_rekeningfk'])?'selected':'' ?>>
            <?= $r['no_rekening'] ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="form-row">
      <label>Jenis Transaksi:</label>
      <select name="jenis_transaksi">
        <option value="debit" <?= ($data['jenis_transaksi']=='debit')?'selected':'' ?>>Debit</option>
        <option value="kredit" <?= ($data['jenis_transaksi']=='kredit')?'selected':'' ?>>Kredit</option>
      </select>
    </div>

    <div class="form-row">
      <label>Tanggal:</label>
      <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d\TH:i', strtotime($data['tanggal'])) ?>">
    </div>

    <div class="form-row">
      <label>Jumlah:</label>
      <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>">
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

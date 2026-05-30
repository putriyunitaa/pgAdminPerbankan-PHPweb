<?php
$page_title = "Data Transaksi";
ob_start();
include '../../core/config.php';

$query = "SELECT t.no_transaksi, t.tanggal, n.nama_nasabah, r.no_rekening,
                 c.nama_cabang, t.jenis_transaksi, t.jumlah, r.saldo
          FROM transaksi t
          JOIN nasabah n ON t.id_nasabahfk = n.id_nasabah
          JOIN rekening r ON t.no_rekeningfk = r.no_rekening
          JOIN cabang_bank c ON r.kode_cabangfk = c.kode_cabang
          ORDER BY t.tanggal DESC";
$result = pg_query($conn, $query);
?>
<div class="table-card">
  <h1>Data Transaksi</h1>
  <a href="add.php" class="btn btn-add">+ Tambah Transaksi</a>
  <table>
  <tr>
    <th>No</th><th>Tanggal</th><th>Nama Nasabah</th><th>No Rekening</th>
    <th>Cabang</th><th>Jenis</th><th>Jumlah</th><th>Saldo</th><th>Aksi</th>
  </tr>
  <?php while ($row = pg_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $row['no_transaksi'] ?></td>
      <td><?= $row['tanggal'] ?></td>
      <td><?= $row['nama_nasabah'] ?></td>
      <td><?= $row['no_rekening'] ?></td>
      <td><?= $row['nama_cabang'] ?></td>
      <td><?= $row['jenis_transaksi'] ?></td>
      <td>Rp <?= number_format($row['jumlah'],0,',','.') ?></td>
      <td>Rp <?= number_format($row['saldo'],0,',','.') ?></td>
      <td>
        <a href="edit.php?no_transaksi=<?= $row['no_transaksi'] ?>" class="btn btn-edit">Edit</a>
        <a href="delete.php?no_transaksi=<?= $row['no_transaksi'] ?>" class="btn btn-delete">Hapus</a>
      </td>
    </tr>
  <?php } ?>
  </table>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

<?php
$page_title = "Data Rekening";
ob_start();
include '../../core/config.php';

$query = "SELECT r.no_rekening, r.pin, r.saldo, c.nama_cabang
          FROM rekening r
          JOIN cabang_bank c ON r.kode_cabangfk = c.kode_cabang
          ORDER BY r.no_rekening ASC";
$result = pg_query($conn, $query);
?>
<div class="table-card">
  <h1>Data Rekening</h1>
  <a href="add.php" class="btn btn-add">+ Tambah Rekening</a>
  <table>
    <tr>
      <th>No Rekening</th>
      <th>PIN</th>
      <th>Saldo</th>
      <th>Cabang</th>
      <th>Aksi</th>
    </tr>
    <?php while ($row = pg_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['no_rekening'] ?></td>
        <td><?= $row['pin'] ?></td>
        <td>Rp <?= number_format($row['saldo'],0,',','.') ?></td>
        <td><?= $row['nama_cabang'] ?></td>
        <td>
          <a href="edit.php?no_rekening=<?= $row['no_rekening'] ?>" class="btn btn-edit">Edit</a>
          <a href="delete.php?no_rekening=<?= $row['no_rekening'] ?>" class="btn btn-delete">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

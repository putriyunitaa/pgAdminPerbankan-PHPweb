<?php
$page_title = "Relasi Nasabah-Rekening";
ob_start();
include '../../core/config.php';

$query = "SELECT n.id_nasabah, n.nama_nasabah, r.no_rekening, c.nama_cabang
          FROM nasabah_has_rekening nh
          JOIN nasabah n ON nh.id_nasabahfk = n.id_nasabah
          JOIN rekening r ON nh.no_rekeningfk = r.no_rekening
          JOIN cabang_bank c ON r.kode_cabangfk = c.kode_cabang
          ORDER BY n.nama_nasabah ASC";
$result = pg_query($conn, $query);
?>
<div class="table-card">
  <h1>Relasi Nasabah-Rekening</h1>
  <a href="add.php" class="btn btn-add">+ Tambah Relasi</a>
  <table>
  <tr>
    <th>ID Nasabah</th>
    <th>Nama Nasabah</th>
    <th>No Rekening</th>
    <th>Cabang</th>
    <th>Aksi</th>
  </tr>
  <?php while ($row = pg_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $row['id_nasabah'] ?></td>
      <td><?= $row['nama_nasabah'] ?></td>
      <td><?= $row['no_rekening'] ?></td>
      <td><?= $row['nama_cabang'] ?></td>
      <td>
        <a href="edit.php?id_nasabah=<?= $row['id_nasabah'] ?>&no_rekening=<?= $row['no_rekening'] ?>" class="btn btn-edit">Edit</a>
        <a href="delete.php?id_nasabah=<?= $row['id_nasabah'] ?>&no_rekening=<?= $row['no_rekening'] ?>" class="btn btn-delete">Hapus</a>
      </td>
    </tr>
  <?php } ?>
  </table>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

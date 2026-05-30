<?php
$page_title = "Data Nasabah";
ob_start();
include '../../core/config.php';

$query = "SELECT id_nasabah, nama_nasabah, alamat_nasabah FROM nasabah ORDER BY id_nasabah ASC";
$result = pg_query($conn, $query);
?>
<div class="table-card">
  <h1>Data Nasabah</h1>
  <a href="add.php" class="btn btn-add">+ Tambah Nasabah</a>
  <table>
    <tr>
      <th>ID Nasabah</th>
      <th>Nama Nasabah</th>
      <th>Alamat Nasabah</th>
      <th>Aksi</th>
    </tr>
    <?php while ($row = pg_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['id_nasabah'] ?></td>
        <td><?= $row['nama_nasabah'] ?></td>
        <td><?= $row['alamat_nasabah'] ?></td>
        <td>
          <a href="edit.php?id_nasabah=<?= $row['id_nasabah'] ?>" class="btn btn-edit">Edit</a>
          <a href="delete.php?id_nasabah=<?= $row['id_nasabah'] ?>" class="btn btn-delete">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

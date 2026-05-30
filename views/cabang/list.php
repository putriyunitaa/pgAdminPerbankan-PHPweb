<?php
$page_title = "Data Cabang Bank";
ob_start();
include '../../core/config.php';

$query = "SELECT kode_cabang, nama_cabang, alamat_cabang FROM cabang_bank ORDER BY nama_cabang ASC";
$result = pg_query($conn, $query);
?>
<div class="table-card">
  <h1>Data Cabang Bank</h1>
  <a href="add.php" class="btn btn-add">+ Tambah Cabang</a>
  <table>
    <tr>
      <th>Kode Cabang</th>
      <th>Nama Cabang</th>
      <th>Alamat Cabang</th>
      <th>Aksi</th>
    </tr>
    <?php while ($row = pg_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['kode_cabang'] ?></td>
        <td><?= $row['nama_cabang'] ?></td>
        <td><?= $row['alamat_cabang'] ?></td>
        <td>
          <a href="edit.php?kode_cabang=<?= $row['kode_cabang'] ?>" class="btn btn-edit">Edit</a>
          <a href="delete.php?kode_cabang=<?= $row['kode_cabang'] ?>" class="btn btn-delete">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
<?php
$content = ob_get_clean();
require_once '../../layouts/dashboard_layout.php';
?>

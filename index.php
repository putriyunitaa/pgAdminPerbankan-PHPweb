<?php
$page_title = "Dashboard";
ob_start();
?>
<div class="dashboard-wrapper">
  <h2>Selamat Datang di Sistem Perbankan</h2>
  <p>Pilih salah satu menu di bawah untuk mengelola data nasabah, rekening, cabang, transaksi, dan relasi.</p>

  <div class="dashboard-menu">
    <a href="views/nasabah/list.php" class="card nasabah">
      <i class="fas fa-users"></i>
      <span>Data Nasabah</span>
    </a>
    <a href="views/rekening/list.php" class="card rekening">
      <i class="fas fa-credit-card"></i>
      <span>Data Rekening</span>
    </a>
    <a href="views/transaksi/list.php" class="card transaksi">
      <i class="fas fa-exchange-alt"></i>
      <span>Data Transaksi</span>
    </a>
    <a href="views/cabang/list.php" class="card cabang">
      <i class="fas fa-university"></i>
      <span>Data Cabang</span>
    </a>
    <a href="views/relasi/list.php" class="card relasi">
      <i class="fas fa-link"></i>
      <span>Relasi Nasabah-Rekening</span>
    </a>
  </div>
</div>
<?php
$content = ob_get_clean();
require_once __DIR__."/layouts/dashboard_layout.php";
?>

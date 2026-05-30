<?php
$page_title = "Edit Rekening";
ob_start();
include '../../core/config.php';

 $no_rekening = $_GET['no_rekening'];
 $query = "SELECT * FROM rekening WHERE no_rekening = $no_rekening";
 $result = pg_query($conn, $query);
 $data = pg_fetch_assoc($result);

 $cabang = pg_query($conn, "SELECT kode_cabang, nama_cabang FROM cabang_bank ORDER BY nama_cabang ASC");
 ?>
 <div class="form-card">
   <h1>Edit Rekening</h1>
   <form method="post" action="proses_edit.php">
     <input type="hidden" name="no_rekening" value="<?= $data['no_rekening'] ?>">
     <div class="form-row">
       <label>PIN:</label>
       <input type="text" name="pin" value="<?= htmlspecialchars($data['pin']) ?>">
     </div>
     <div class="form-row">
       <label>Saldo:</label>
       <input type="number" name="saldo" value="<?= htmlspecialchars($data['saldo']) ?>">
     </div>
     <div class="form-row">
       <label>Cabang:</label>
       <select name="kode_cabangfk">
         <?php while ($row = pg_fetch_assoc($cabang)) { ?>
           <option value="<?= $row['kode_cabang'] ?>" <?= ($row['kode_cabang']==$data['kode_cabangfk'])?'selected':'' ?> >
             <?= $row['nama_cabang'] ?>
           </option>
         <?php } ?>
       </select>
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

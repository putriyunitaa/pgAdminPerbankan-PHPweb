<?php
$page_title = "Edit Relasi Nasabah-Rekening";
ob_start();
include '../../core/config.php';

$id_nasabah = $_GET['id_nasabah'];
$no_rekening = $_GET['no_rekening'];

 $query = "SELECT * FROM nasabah_has_rekening 
           WHERE id_nasabahfk = $id_nasabah AND no_rekeningfk = $no_rekening";
 $result = pg_query($conn, $query);
 $data = pg_fetch_assoc($result);

 $nasabah = pg_query($conn, "SELECT id_nasabah, nama_nasabah FROM nasabah ORDER BY nama_nasabah ASC");
 $rekening = pg_query($conn, "SELECT no_rekening FROM rekening ORDER BY no_rekening ASC");
 ?>
 <div class="form-card">
   <h1>Edit Relasi Nasabah-Rekening</h1>
   <form method="post" action="proses_edit.php">
     <input type="hidden" name="old_id_nasabah" value="<?= $data['id_nasabahfk'] ?>">
     <input type="hidden" name="old_no_rekening" value="<?= $data['no_rekeningfk'] ?>">

     <div class="form-row">
       <label>Nasabah:</label>
       <select name="id_nasabahfk">
         <?php while ($n = pg_fetch_assoc($nasabah)) { ?>
           <option value="<?= $n['id_nasabah'] ?>" <?= ($n['id_nasabah']==$data['id_nasabahfk'])?'selected':'' ?> >
             <?= $n['nama_nasabah'] ?>
           </option>
         <?php } ?>
       </select>
     </div>

     <div class="form-row">
       <label>No Rekening:</label>
       <select name="no_rekeningfk">
         <?php while ($r = pg_fetch_assoc($rekening)) { ?>
           <option value="<?= $r['no_rekening'] ?>" <?= ($r['no_rekening']==$data['no_rekeningfk'])?'selected':'' ?> >
             <?= $r['no_rekening'] ?>
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

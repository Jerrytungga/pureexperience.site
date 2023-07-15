<?php
include '../koneksi.php';
include 'session.php';
error_reporting(E_ALL ^ E_NOTICE);



if (isset($_POST['ts'])){
    $ts = $_POST['ts'];
    $hapus = mysqli_query($conn,"DELETE FROM `tb_ts` WHERE TS='$ts'");
    if($hapus){
        echo "<script type='text/javascript'>
        alert('Data TS Berhasil Di Hapus!');
        </script>";
    }
   
}
if (isset($_POST['doakasihkarunia'])){
    $doakasihkarunia = $_POST['doakasihkarunia'];
    $hapusdoakasihkarunia = mysqli_query($conn,"DELETE FROM `tb_doa` WHERE P='$doakasihkarunia'");
    if($hapusdoakasihkarunia){
        echo "<script type='text/javascript'>
        alert('Data Doa Berhasil Di Hapus!');
        </script>";
    }
   
}
if (isset($_POST['pameran'])){
    $pameran = $_POST['pameran'];
    $Exhibition = mysqli_query($conn,"DELETE FROM `tb_pameran` WHERE E='$pameran'");
    if($Exhibition){
        echo "<script type='text/javascript'>
        alert('Data Exhibition Berhasil Di Hapus!');
        </script>";
    }
   
}

if (isset($_POST['kidung'])){
    $kidung = $_POST['kidung'];
    $kidung_ = mysqli_query($conn,"DELETE FROM `tb_kidung` WHERE H='$kidung'");
    if($kidung_){
        echo "<script type='text/javascript'>
        alert('Data Kidung Berhasil Di Hapus!');
        </script>";
    }
   
}

if (isset($_POST['presensi'])){
    $presensi = $_POST['presensi'];
    $presensi_ = mysqli_query($conn,"DELETE FROM `presensi` WHERE status='$presensi'");
    if($presensi_){
        echo "<script type='text/javascript'>
        alert('Data Presensi Berhasil Di Hapus!');
        </script>";
    }
   
}

if (isset($_POST['Kelas'])){
    $Kelas = $_POST['Kelas'];
    $Kelas_ = mysqli_query($conn,"DELETE FROM `activity` WHERE status='$Kelas'");
    if($Kelas_){
        echo "<script type='text/javascript'>
        alert('Data Kelas Berhasil Di Hapus!');
        </script>";
    }
   
}

if (isset($_POST['Berita'])){
    $Berita = $_POST['Berita'];
    $Berita_ = mysqli_query($conn,"DELETE FROM `tb_daftar_berita` WHERE status='$Berita'");
    if($Berita_){
        echo "<script type='text/javascript'>
        alert('Data Berita/judul Berhasil Di Hapus!');
        </script>";
    }
   
}
if (isset($_POST['traines'])){
    $traines = $_POST['traines'];
    $traines_ = mysqli_query($conn,"DELETE FROM `traines` WHERE id_hapus='$traines'");
    if($traines_){
        echo "<script type='text/javascript'>
        alert('Data Traines Berhasil Di Hapus!');
        </script>";
    }
   
}

if (isset($_POST['asisten'])){
    $asisten = $_POST['asisten'];
    $asisten_ = mysqli_query($conn,"DELETE FROM `asisten` WHERE Id_hapus='$asisten'");
    if($asisten_){
        echo "<script type='text/javascript'>
        alert('Data Asisten Berhasil Di Hapus!');
        </script>";
    }
   
}

if (isset($_POST['trainer'])){
    $trainer = $_POST['trainer'];
    $trainer_ = mysqli_query($conn,"DELETE FROM `trainer` WHERE id_hapus_trainer='$trainer'");
    if($trainer_){
        echo "<script type='text/javascript'>
        alert('Data Trainer Berhasil Di Hapus!');
        </script>";
    }
   
}

if (isset($_POST['jadwal_kelas'])){
    $jadwal_kelas = $_POST['jadwal_kelas'];
    $jadwal_kelas_ = mysqli_query($conn,"DELETE FROM `schedule` WHERE id_hapus='$jadwal_kelas'");
    if($jadwal_kelas_){
        echo "<script type='text/javascript'>
        alert('Data Schedule Berhasil Di Hapus!');
        </script>";
    }
   
}


?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'head.php';
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php
    include 'sidebar.php';
    ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
            <?php
            include 'navbar.php';
            ?>

                 <!-- Begin Page Content -->
                 <div class="container-fluid">
<?php
$presensi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `presensi`"));
$tb_doa = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `tb_doa`"));
$tb_kidung = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `tb_kidung`"));
$tb_pameran = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `tb_pameran`"));
$tb_ts = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `tb_ts`"));
$traines = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `traines`"));
$asisten = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `asisten`"));
$activity = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id_activity) as data FROM `activity`"));
$doa_kasih_karunia = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `doa_kasih_karunia`"));
$r_ayathafalan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(nip) as data FROM `r_ayathafalan`"));
$schedule = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(week) as data FROM `schedule`"));
$tb_angkatan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) as data FROM `tb_angkatan`"));
$tb_daftar_berita = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id_berita) as data FROM `tb_daftar_berita`"));
$trainer = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id_trainer) as data FROM `trainer`"));


$total = $presensi['data'] + $tb_doa['data'] + $tb_kidung['data'] + $tb_pameran['data'] + $tb_ts['data'] + $traines['data'] + $asisten['data'] + $activity['data'] + $doa_kasih_karunia['data'] + $r_ayathafalan['data']+ $schedule['data'] + $tb_angkatan['data'];
?>
<!-- <h1>Total Data Sistem <?= $total; ?></h1> -->
<!-- <button>Hapus</button> -->

<h1 class="text text-danger">
    DATA INI BISA DI KOSONGKAN HANYA DI SEMESTER AKHIR ATAU PERGANTIAN SEMESTER
</h1> <br>
<h5 class="text text-info">Apabila angkatan masih sama maka data traines tidak perlu dikosongkan kecuali kalau ada angkatan baru.</h5>

<table class="table table-striped">
  <thead>
    <tr>
     
      <th scope="col">Data</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Aksi</th>
    </tr>
</thead>
<tbody>
      <tr>
      
        <th scope="col">Hasil Presensi</th>
        <th scope="col"><?= $presensi['data']; ?></th>
        <th scope="col">

        <?php
            if ($presensi['data'] > 0) {  ?>

                <form action="" method="post">
                    <button type="submit" name="presensi" class="btn btn-danger" value="0" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
        <?php    }
        ?>
        </th>
      </tr>
      <tr> 
      
        <th scope="col">Kelas</th>
        <th scope="col"><?= $activity['data']; ?></th>
        <th scope="col">
        <?php
            if ($activity['data'] > 0) {  ?>
                <form action="" method="post">
                    <button type="submit" name="Kelas" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>

        <?php    }
        ?>

        </th>
      </tr>
      <tr>
      
        <th scope="col">Kidung</th>
        <th scope="col"><?= $tb_kidung['data']; ?></th>
        <th scope="col">
        <?php
            if ($tb_kidung['data'] > 0) {  ?>
                
                <form action="" method="post">
                    <button type="submit" name="kidung" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
                
                <?php    }
        ?>
        
        </th>
      </tr>
      <tr>
        <th scope="col">Berita Kelas</th>
        <th scope="col"><?= $tb_daftar_berita['data']; ?></th>
        <th scope="col">
        <?php
            if ($tb_daftar_berita['data'] > 0) {  ?>
                <form action="" method="post">
                    <button type="submit" name="Berita" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
                <?php    }
        ?>
        
        </th>
      </tr>
      <tr>
        <th scope="col">Traines</th>
        <th scope="col"><?= $traines['data']; ?></th>
        <th scope="col">
        <?php
            if ($traines['data'] > 0) {  ?>
                
                <form action="" method="post">
                    <button type="submit" name="traines" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
                
                <?php    }
        ?>

        </th>
      </tr>
      <tr>
        <th scope="col">Asisten</th>
        <th scope="col"><?= $asisten['data']; ?></th>
        <th scope="col">
        <?php
            if ($asisten['data'] > 0) {  ?>
                
                <form action="" method="post">
                    <button type="submit" name="asisten" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
                <?php    }
        ?>


        
        </th>
      </tr>
      <tr>
        <th scope="col">Trainer</th>
        <th scope="col"><?= $trainer['data']; ?></th>
        <th scope="col">
        <?php
            if ($trainer['data'] > 0) {  ?>
                
                <form action="" method="post">
                    <button type="submit" name="trainer" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
               
                <?php    }
        ?>

        </th>
      </tr>
      <tr>
        <th scope="col">Jadwal Kelas</th>
        <th scope="col"><?= $schedule['data']; ?></th>
        <th scope="col">
        <?php
            if ($schedule['data'] > 0) {  ?>
                
                <form action="" method="post">
                    <button type="submit" name="jadwal_kelas" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
               
               
                <?php    }
        ?>

        </th>
      </tr>
      <!-- <tr>
        <th scope="col">Kejar Berita</th>
        <th scope="col"><?= $tb_daftar_berita['data']; ?></th>
        <th scope="col"><button>Kosongkan Data</button></th>
      </tr> -->
      <tr>
        <th scope="col">Exhibition</th>
        <th scope="col"><?= $tb_pameran['data']; ?></th>
        <th scope="col">
        <?php
            if ($tb_pameran['data'] > 0) {  ?>
                <form action="" method="post">
                    <button type="submit" name="pameran" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
                </form>
                <?php    }
        ?>
        </th>
      </tr>
      <tr>
        <th scope="col">TS</th>
        <th scope="col"><?= $tb_ts['data']; ?></th>
        <th scope="col">
        <?php
            if ($tb_ts['data'] > 0) {  ?>
               
               <form action="" method="post">
                   <button type="submit" name="ts" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
               </form>
                <?php    }
        ?>

        </th>
      </tr>
      <tr>
        <th scope="col">Doa </th>
        <th scope="col"><?= $tb_doa['data']; ?></th>
        <th scope="col">
        <?php
            if ($tb_doa['data'] > 0) {  ?>
               
              
               <form action="" method="post">
                   <button type="submit" name="doakasihkarunia" class="btn btn-danger" value="1" onclick="return confirm('Yakin Hapus Data ?')" >Kosongkan Data</button>
               </form>
                <?php    }
        ?>
        </th>
      </tr>
      <!-- <tr>
        <th scope="col">Remedial Ayat Hafalan</th>
        <th scope="col"><?= $r_ayathafalan['data']; ?></th>
        <th scope="col"><button>Kosongkan Data</button></th>
      </tr> -->
    
  </tbody>
</table>

</div>
<!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
                include 'fotter.php';
                ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php
    include 'script.php';
    ?>


</body>

</html>
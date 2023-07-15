<?php
include '../koneksi.php';
include 'session.php';
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_POST['week'])){
    $tgl = $_POST['week'];

    $data = mysqli_query($conn, "SELECT * FROM `presensi` where `week`='".$_POST['week']."'");
    $data_presensi = mysqli_fetch_array($data);
} else {

    $data = mysqli_query($conn, "SELECT * FROM `presensi` where `week`='".$_POST['week']."'");
    $data_presensi = mysqli_fetch_array($data);
}

if (isset($_POST['hapus'])){
    $week = $_POST['hapus'];
    $hapus = mysqli_query($conn,"DELETE FROM `presensi` WHERE `week`='$week'");
    $hapus = mysqli_query($conn,"DELETE FROM `tb_doa` WHERE `week`='$week'");
    $hapus = mysqli_query($conn,"DELETE FROM `tb_kidung` WHERE `week`='$week'");
    $hapus = mysqli_query($conn,"DELETE FROM `tb_pameran` WHERE `week`='$week'");
    $hapus = mysqli_query($conn,"DELETE FROM `tb_ts` WHERE `week`='$week'");
    if($hapus){
        echo "<script type='text/javascript'>
        alert('Data Berhasil Di Hapus!');
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

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Data Asisten</h1> -->
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger ">HISTORI PRESENSI</h6> <br>
       <!-- Button trigger modal tambahkan asisten -->
       <form action="" method="post" id="form_id">
        <select  class="form-control col-3 mt-2" name="week" onChange="document.getElementById('form_id').submit();" required>
        <option value="">PILIH MINGGU</option>
           <option value="Orientation">Orientation</option>
            <option value="PT1">PT1</option>
            <option value="PT2">PT2</option>
            <option value="PT3">PT3</option>
            <option value="R1">R1</option>
            <option value="R2">R2</option>
            <option value="R3">R3</option>
            <option value="R4">R4</option>
            <option value="R5">R5</option>
            <option value="R6">R6</option>
            <option value="R7">R7</option>
            <option value="R8">R8</option>
            <option value="R9">R9</option>
            <option value="R10">R10</option>
            <option value="R11">R11</option>
            <option value="R12">R12</option>
            <option value="R13">R13</option>
            <option value="R14">R14</option>
            <option value="R15">R15</option>
            <option value="R16">R16</option>
            <option value="R17">R17</option>
            <option value="R18">R18</option>
            <option value="Evaluasi">Evaluasi</option>
          </select>
          <?php 
          if($_POST['week']){ ?>
            </form>

<a href="histori.php" class="btn btn-danger mt-2 mb-2">Reset</a>
<form action="" method="post">
    <button type="submit" value="<?= $tgl; ?>" name="hapus" class="btn btn-primary" onclick="return confirm('Yakin Hapus Data Presensi <?php echo $tgl; ?> ?')">
     HAPUS SEMUA HISTORI  <span class="badge badge-danger"><?php echo $tgl; ?></span>
     </button>
</form>

 
        <?php  }
        
          ?>




    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>TRAINES</th>
                    <th>BATCH</th>
                    <th>WEEK</th>
                    <th>JADWAL</th>
                    <th>TANGGAL</th>
                    <th>STATUS</th>
                    <th>PRAYER</th>
                    <th>HYMNS</th>
                    <th>EXHIBITION</th>
                    <th>PROPHESYING</th>
               
                    </tr>
                </thead>
               
                <tbody>
                <?php
                     function name($nama_)
                     {
                       global $conn;
                       $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM traines WHERE nip='$nama_'"));
                       return $sqly['name'];
                      }
                     function jadwal($jadwal)
                     {
                       global $conn;
                       $sqly1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$jadwal'"));
                       return $sqly1['items'];
                      }
                $i = 1;
                foreach ($data as $row) :
                    ?>

<tr>

<td><?= $i; ?></td>
<td><?= name($row['nip']); ?></td>
<td>
    <?php

if(isset($_POST['week'])){
    $tgl = $_POST['week'];
    $prayer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_doa` where date='".$row['presensi_date']."' and `week`='".$_POST['week']."'"));
    $tb_kidung = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_kidung` where date='".$row['presensi_date']."' and `week`='".$_POST['week']."'"));
    $tb_pameran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_pameran` where date='".$row['presensi_date']."' and `week`='".$_POST['week']."'"));
    $tb_ts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_ts` where date='".$row['presensi_date']."' and `week`='".$_POST['week']."'"));
  
} else {

    $prayer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_doa` where date='".$row['presensi_date']."' "));
    $tb_kidung = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_kidung` where date='".$row['presensi_date']."' "));
    $tb_pameran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_pameran` where date='".$row['presensi_date']."' "));
    $tb_ts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tb_ts` where date='".$row['presensi_date']."' "));
}
    $angkatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `traines` where nip='".$row['nip']."' "));
   
    ?>
    <?= $angkatan['angkatan']; ?>
</td>
<td><?= $row['week']; ?></td>
<td><?= jadwal($row['id_activity']); ?></td>
<td><?= $row['presensi_date']; ?></td>
<td><?= $row['mark']; ?></td>
<td>
    <?php
if ($prayer['P'] == NULL) { 
   echo $prayer['P'] = 0;
} else {
   echo $prayer['P'];
}
    ?>
</td>
<td>
    <?php
if ($tb_kidung['H'] == NULL) { 
   echo $tb_kidung['H'] = 0;
} else {
   echo $tb_kidung['H'];
}
    ?>
</td>
<td>
    <?php
if ($tb_pameran['E'] == NULL) { 
   echo $tb_pameran['E'] = 0;
} else {
   echo $tb_pameran['E'];
}
    ?>
</td>
<td>
    <?php
if ($tb_ts['TS'] == NULL) { 
   echo $tb_ts['TS'] = 0;
} else {
   echo $tb_ts['TS'];
}
    ?>
</td>



</tr>
                    
                   
                    <?php $i++; ?>
                     <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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
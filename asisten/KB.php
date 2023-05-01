<?php
include '../koneksi.php';
include 'session.php';

if (isset($_POST['kb'])) {
    $done =  $_POST['done'];
    $id =  $_POST['kb'];
    $id_activity =  $_POST['id_activity'];
    $schedule_id =  $_POST['schedule_id'];
    $menu = mysqli_query($conn, "UPDATE `presensi` SET `status` = '$done' WHERE `presensi`.`nip` ='$id' AND `presensi`.`id_activity` ='$id_activity' AND `presensi`.`schedule_id` ='$schedule_id'");
    
}
$presensi = mysqli_query($conn, "SELECT * FROM `presensi` where mark='I' ");
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
            include 'topbar.php';
            ?>
                

                  <!-- Begin Page Content -->
                  <div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Data Asisten</h1> -->
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4" >
    <div class="card-header py-3" style="background-color: #3C2A21;">
        <h6 class="m-0 font-weight-bold text-light" >Daftar Kejar Berita</h6> <br>
      
    </div>
    <div class="card-body"  style="color: #3C2A21;" >
        <div class="table-responsive" style="color: #3C2A21;" >
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"  style="color: #3C2A21;">
                <thead>
                    <tr>
                    <th>No</th>
        <th>Nama</th>
        <th>Angkatan</th>
        <th>Minggu</th>
        <th>Tanggal</th>
        <th>Kelas</th>
        <th>Judul Berita</th>
        <th>Trainer</th>
        <th>Jam Mulai</th>
        <th>Jam Akhir</th>
        <th>Aksi</th>
               
                    </tr>
                </thead>
               
                <tbody>
           
    <?php
                  function activity($activity)
                  {
                      global $conn;
                      $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$activity'"));
                      return $sqly['items'];
                  }
                  function news($news)
                  {
                      global $conn;
                      $sqly2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_daftar_berita WHERE id_berita='$news'"));
                      return $sqly2['daftar_berita'];
                  }
                  function trainer($trainer)
                  {
                      global $conn;
                      $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM trainer WHERE id_trainer='$trainer'"));
                      return $sqly3['nama_trainer'];
                  }
                  function traines($traines)
                  {
                      global $conn;
                      $sqly4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM traines WHERE nip='$traines'"));
                      return $sqly4['name'];
                  }
                $i = 1;
                foreach ($presensi as $row) :
                ?>
      <tr>
      <td><?= $i; ?></td>
        <td><?= traines($row['nip']); ?></td>
        <?php
            $ambil_angkatan = mysqli_query($conn, "SELECT * FROM `traines` where nip='".$row['nip']."' ");
            $angkatan = mysqli_fetch_array($ambil_angkatan);
            $ambil_berita = mysqli_query($conn, "SELECT * FROM `schedule` where id='".$row['schedule_id']."' ");
            $berita = mysqli_fetch_array($ambil_berita);
            ?>
        <td><?= $angkatan['angkatan']; ?></td>
        <td><?= $row['week']; ?></td>
        <td><?= $row['presensi_date']; ?></td>
        <td><?= activity($row['id_activity']); ?></td>
        <td><?= news($berita['id_berita']); ?></td>
        <td><?= trainer($berita['id_trainer']); ?></td>
        <td><?= $berita['start_time']; ?></td>
        <td><?= $berita['end_time']; ?></td>
        <td>
        <form action="" method="POST">
        <input type="hidden" name="kb" value="<?= $row['nip']; ?>">
        <input type="hidden" name="id_activity" value="<?= $row['id_activity']; ?>">
        <input type="hidden" name="schedule_id" value="<?= $row['schedule_id']; ?>">
        <?php
        if ($row['status'] == "0") { ?>
            <button type="submit" value="1" name="done" class="btn btn-success">DONE</button>
        <?php    } 
        ?>
        </form>
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

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>


</body>

</html>
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
    <div class="card-header py-3" style="background-color: #F79540;">
        <h6 class="m-0 font-weight-bold text-light">Daftar Remedial Ayat Hafalan</h6> <br>
      
    </div>
    <div class="card-body" >
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead style="color: #567189;">
                    <tr>
                    <th>No</th>
        <th>Nama</th>
        <th>Angkatan</th>
      
        <th>Aksi</th>
               
                    </tr>
                </thead>
               
                <tbody style="color: #567189;">
           
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
      
        <td></td>
        <td></td>
     
         
        
      


      
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
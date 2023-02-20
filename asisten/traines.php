<?php
include '../koneksi.php';
include 'session.php';
$ambildata_traines = mysqli_query($conn,"SELECT * FROM `traines` where `Asisten`='$id' order by date DESC");
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
    <div class="card-header py-3" style="background-color: #68B984;">
        <h6 class="m-0 font-weight-bold text-light" >My Trainee</h6> <br>
      
    </div>
    <div class="card-body" >
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead style="color: #567189;">
                    <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Batch</th>
                    <th>Action</th>
               
                    </tr>
                </thead>
               
                <tbody style="color: #567189;">
                <?php
                  $p = 1;
                  function batch($batch)
                  {
                      global $conn;
                      $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_angkatan WHERE id='$batch'"));
                      return $sqly['angkatan'];
                  }
                  function activity($activity)
                  {
                      global $conn;
                      $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$activity'"));
                      return $sqly['items'];
                  }
                foreach ($ambildata_traines as $row) :
                    ?>

                        <tr>
                            <td><?= $p; ?></td>
                            <td><?= $row['name'];  ?></td>
                            <td><?= $row['angkatan'];  ?></td>
                            <td>
                                <a href="tanah_permai.php" class="btn" style="background-color: #CEEDC7; color:#1A0000;">Tanah Permai</a>
                                <a href="" class="btn" style="background-color: #16FF00; color:#1A0000;">Catatan Doa</a>
                            </td>

                          
                         
                        </tr>
                    
                   
                    <?php $p++; ?>
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
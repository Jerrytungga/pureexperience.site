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
        <h6 class="m-0 font-weight-bold text-light" >Jadwal Presensi</h6> <br>
      
    </div>
    <div class="card-body" >
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead style="color: #567189;">
                    <tr>
                    <th>No</th>
                    <th>Jadwal</th>
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
                            <td>
                            <button type="button" class="btn text-light" data-toggle="modal" data-target="#presensi<?= $row['nip']; ?>" style="background-color: #68B984;">
                                View Presensi 
                               
                               
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="presensi<?= $row['nip']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header" style="background-color: #68B984;">
                                        <h5 class="modal-title" id="staticBackdropLabel" style="color: #ffff;">Presensi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body " id="modal-editTraine">
                                        <?php
                                        $tampilan_presensi = mysqli_query($conn,"SELECT * FROM `presensi` where `nip`='".$row['nip']."'  GROUP BY nip");
                                        ?>
                
                                    <table class="table table-striped">
                                        <thead style="color: #171717;">
                                            <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Jadwal</th>
                                            <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color: #567189;">
                                        <?php
                                        
                                             $ambildata_traines1 = mysqli_query($conn,"SELECT * FROM `presensi` WHERE `nip`='".$row['nip']."'");
                                             $ambildata_traines_ = mysqli_fetch_array($ambildata_traines1);
                                            $i = 1;
                                            foreach ($ambildata_traines1 as $data) :
                                            ?>

                                            <tr>
                                            <th scope="row"><?= $i;  ?></th>
                                            <td><?= activity($data['id_activity']); ?></td>
                                            <td><?= $data['mark']; ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                                 <?php endforeach; 
                                            
                                                 ?>
                                            
                                        </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                                    </div>
                                    </div>
                                </div>
                                </div>
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
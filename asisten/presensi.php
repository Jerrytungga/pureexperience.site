<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
include 'session.php';
$ambildata_presensi = mysqli_query($conn,"SELECT * FROM `presensi` where `asisten` = '$id'");
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
<div class="card shadow mb-4">
    <div class="card-header py-3 " style="background-color: #68B984;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
    Presensi
    </button>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #68B984; color: #ffff;">
                <h5 class="modal-title" id="staticBackdropLabel">Tambahkan Presensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="">Jadwal </label>
                    <select name="jadwal" id="" class="form-control">
                        <option value="">Pilih Jadwal</option>
                        <?php
                         function activity($activity)
                         {
                             global $conn;
                             $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$activity'"));
                             return $sqly['items'];
                         }
                            $ambiljadwal = mysqli_query($conn,"SELECT * FROM `schedule` where `date` ='$hari_ini'");
                            while ($ambiljadwal1 = mysqli_fetch_array($ambiljadwal)){ ?>
                            <option value="<?= $ambiljadwal1['id']?>"><?= activity($ambiljadwal1['id_berita'])?></option>
    
                         <?php   }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="">Waktu Presensi :</label>
                    <input type="time" name="waktu" class="form-control">
                </div>
                <div class="mt-2">
                    <label for="">Mark:</label>
                   <select name="mark" id="" class="form-control">
                    <option value="V">V</option>
                    <option value="O">O</option>
                    <option value="X">X</option>
                   </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success">Tambahkan</button>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <!-- <th>Waktu Presensi</th> -->
                    <th>Kelas</th>
                    <th>Presensi dilakukan</th>
                    <th>Tanda</th>
                    <th>Durasi Terlambat</th>
                    <th>Minggu</th>
               
                    </tr>
                </thead>
               
                <tbody>
                <?php
                  function nama($nama)
                  {
                      global $conn;
                      $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM traines WHERE nip='$nama'"));
                      return $sqly['name'];
                  }
                $i = 1;
                foreach ($ambildata_presensi as $row) :
                    ?>

                        <tr>

                            <td><?= $i; ?></td>
                            <td><?= nama($row['nip']);?></td>
                            <!-- <td><?= $row['batch'];?></td> -->
                            <td><?= $row['batch'];?></td>
                            <td><?= $row['presensi_time'];?></td>
                            <td><?= $row['mark'];?></td>
                            <td>
                                <?php
                                            $awal  = strtotime($row['presensi_time']); //waktu awal
                                            $akhir = strtotime($row['presensi_time']); //waktu akhir
                                            $diff  = $akhir - $awal;
                                            $jam   = floor($diff / (60 * 60));
                                            $menit = $diff - $jam * (60 * 60);
                                            echo ' ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';
                                            ?>
                            </td>
                            <td><?= $row['week'];?></td>
                          
                            
                         
                         
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
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
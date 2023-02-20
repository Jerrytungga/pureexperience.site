<?php
include '../koneksi.php';
include 'session.php';
if (isset($_POST['submit'])) {
    $nip = $data['nip'];
    $sql_traines = mysqli_query($conn, "SELECT angkatan, semester, Asisten FROM `traines` WHERE nip='$nip'");
    $data_angkatan = mysqli_fetch_array($sql_traines);
    $angkatan = $data_angkatan['angkatan'];
    $asisten_ = $data_angkatan['Asisten'];
    $sqli_jadwal = mysqli_query($conn, "SELECT MAX(week) as week FROM `schedule`");
    $array_jadwal_ALL = mysqli_fetch_array($sqli_jadwal);
    $ambil_idpermai = mysqli_query($conn, "SELECT MAX(id_permai) as id_permai FROM `tb_tanah_permai`");
    $data_id = mysqli_fetch_array($ambil_idpermai);
    $id_permai = $data_id['id_permai']+1;
    $week = $array_jadwal_ALL['week'];
    $ayat = $_POST['ayat'];
    $Da = $_POST['DA'];
    $Dt = $_POST['DT'];
    $Ds = $_POST['DS'];
    $pengalaman = $_POST['pengalaman'];
    $input_tanah_permai = mysqli_query($conn, "INSERT INTO `tb_tanah_permai`(`nip`, `angkatan`, `Ayat`, `Da`, `Dt`, `Ds`, `Pengalaman_`,`Week`,`asisten`,`id_permai`) VALUES ('$nip','$angkatan','$ayat','$Da','$Dt','$Ds','$pengalaman','$week','$asisten_','$id_permai')");
  }
if (isset($_POST['ubah'])) {
    $idPermai = $_POST['id__permai'];
    $Ayat = $_POST['ayat'];
    $DA = $_POST['dA'];
    $DT = $_POST['dT'];
    $DS = $_POST['dS'];
    $Pengalaman = $_POST['Pengalaman_'];
    $input_tanah_permai = mysqli_query($conn, "UPDATE `tb_tanah_permai` SET `Ayat`='$Ayat',`Da`='$DA',`Dt`='$DT',`Ds`='$DS',`Pengalaman_`='$Pengalaman' WHERE `id_permai`='$idPermai'");
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
    <div class="card-header py-3" style="background-color: #658864;">
        <h6 class="m-0 font-weight-bold text-light" >Tanah Permai</h6> <br>
        <?php
         $ambildatatanahpermai = mysqli_query($conn,"SELECT * FROM `tb_tanah_permai`  where `nip`='$id'");
         $ambil_nip = mysqli_fetch_array($ambildatatanahpermai);
         if ($ambil_nip['nip'] == 0) {  ?>
<button type="button" class="btn"  style="background-color: #CDE990;" data-toggle="modal" data-target="#staticBackdrop">
Tambahkan Tanah Permai
</button>

       <?php  }
        ?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #CDE990;">
        <h5 class="modal-title" id="staticBackdropLabel">Masukan Tanah Permai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="post">
        <div>
            <label for="">Ayat :</label>
            <textarea name="ayat" class="form-control" required id="" cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Doa Apresiasi :</label>
            <textarea name="DA" class="form-control" required id="" cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Doa Terang :</label>
            <textarea name="DT" class="form-control" required id="" cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Doa Syafaat :</label>
            <textarea name="DS" class="form-control" id="" required cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Pengalaman :</label>
            <textarea name="pengalaman" class="form-control" required id="" cols="4" rows="4"></textarea>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </div>
</form>
    </div>
  </div>
</div>

    </div>
    <div class="card-body" >
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead style="color: #567189;">
                    <tr>
                    <th>No</th>
                    <th>TANGGAL</th>
                    <th>AYAT</th>
                    <th>DA</th>
                    <th>DT</th>
                    <th>DS</th>
                    <th>PENGALAMAN</th>
                    <th>ASISTEN</th>
                    <th>AKSI</th>
               
                    </tr>
                </thead>
               
                <tbody style="color: #567189;">
                <?php
                  $p = 1;
                  $ambildata_tanah_permai = mysqli_query($conn,"SELECT * FROM `tb_tanah_permai` order by time_ DESC");
                foreach ($ambildata_tanah_permai as $row) :
                    ?>

                        <tr>
                            <td><?= $p; ?></td>
                            <td><?= $row['date']; ?></td>
                            <td><?= $row['Ayat']; ?></td>
                            <td><?= $row['Da']; ?></td>
                            <td><?= $row['Dt']; ?></td>
                            <td><?= $row['Ds']; ?></td>
                            <td><?= $row['Pengalaman_']; ?></td>
                            <td><?= $row['catatan_asisten']; ?></td>
                            <td>
                            <a id="edit" type="button" class="btn"  style="background-color: #FFC93C; color:#1A0000;" data-toggle="modal" data-target="#edittanahpermai" data-idpermai="<?= $row['id_permai']; ?>" data-ayat="<?= $row['Ayat']; ?>" data-da="<?= $row['Da']; ?>" data-dt="<?= $row['Dt']; ?>" data-ds="<?= $row['Ds']; ?>" data-pengalaman="<?= $row['Pengalaman_']; ?>">
Edit
</a>

<!-- Modal -->
<div class="modal fade" id="edittanahpermai" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #FFC93C;  color:#1A0000;">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Tanah Permai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  id="modal-edit">
       <form action="" method="post">
        <input type="hidden" name="id__permai" id="idpermai">
        <div>
            <label for="">Ayat :</label>
            <textarea name="ayat" class="form-control" id="ayat" cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Doa Apresiasi :</label>
            <textarea name="dA" class="form-control" required id="da" cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Doa Terang :</label>
            <textarea name="dT" class="form-control" required id="dt" cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Doa Syafaat :</label>
            <textarea name="dS" class="form-control" id="ds" required cols="4" rows="4"></textarea>
        </div>
        <div class="mt-1">
            <label for="">Pengalaman :</label>
            <textarea name="Pengalaman_" class="form-control" required id="pengalaman" cols="4" rows="4"></textarea>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" name="ubah" class="btn btn-success">Update</button>
    </div>
</form>
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

    <script>
         $(document).on("click", "#edit", function() {
      let idpermai = $(this).data('idpermai');
      let ayat = $(this).data('ayat');
      let da = $(this).data('da');
      let dt = $(this).data('dt');
      let ds = $(this).data('ds');
      let pengalaman = $(this).data('pengalaman');
      $(" #modal-edit #idpermai").val(idpermai);
      $(" #modal-edit #ayat").val(ayat);
      $(" #modal-edit #da").val(da);
      $(" #modal-edit #dt").val(dt);
      $(" #modal-edit #ds").val(ds);
      $(" #modal-edit #pengalaman").val(pengalaman);


    });
    </script>
</body>

</html>
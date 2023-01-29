<?php
include '../koneksi.php';
include 'session.php';
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['save'])) {
    $idsemester = $_POST['idsemester'];
    $keterangan = $_POST['keterangan'];
    $semester = mysqli_query($conn, "INSERT INTO `tb_semester`(`thn_semester`, `keterangan`) VALUES ('$idsemester','$keterangan')");
?>
    <script>
        alert("Data Berhasil ditambahkan!!");
    </script>
<?php
}
if (isset($_POST['thn'])) {
    $jd =  $_POST['nonaktifkan'];
    $jd2 =  $_POST['aktif'];
    $id =  $_POST['thn'];
    if ($_POST['nonaktifkan']) {
        $menu = mysqli_query($conn, "UPDATE `tb_semester` SET `status` = '$jd' WHERE `tb_semester`.`thn_semester` = '$id'");
    } else {
        $menu = mysqli_query($conn, "UPDATE `tb_semester` SET `status` = '$jd2' WHERE `tb_semester`.`thn_semester` = '$id'");
    }
}
$data = mysqli_query($conn, "SELECT * FROM `tb_semester` ");
$data_semester = mysqli_fetch_array($data);
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
        <h6 class="m-0 font-weight-bold text-primary">Data Traines</h6> <br>
       <!-- Button trigger modal tambahkan asisten -->
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Tambahkan Angkatan
        </button>
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Masukan Angkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div>
                                <label for="">ID Semester :</label>
                                <input type="text" class="form-control" name="idsemester" placeholder="contoh : 20221">
                            </div>
                            <br>
                            <div>
                                <label for="">Keterangan :</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="contoh : semester 1">
                            </div>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
            </form>
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
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Options</th>
               
                    </tr>
                </thead>
               
                <tbody>
                <?php
                  
                $i = 1;
                foreach ($data as $row) :
                    ?>

<tr>

<td><?= $i; ?></td>
<td><?= $row['keterangan'];  ?></td>
<td> <?php
        if ($row['status'] == "Aktif") { ?>
        <button type="button" class="btn btn-custon-rounded-four btn-success"><?= $row['status'];  ?></button>
    <?php    } else { ?>
        <button type="button" class="btn btn-custon-rounded-four btn-danger"><?= $row['status'];  ?></button>
    <?php  }
    ?></button>
</td>
<td>

    <form action="" method="POST">

        <input type="hidden" name="thn" value="<?= $row['thn_semester']; ?>">
        <?php
        if ($row['status'] == "Aktif") { ?>
            <button type="submit" value="Tidak Aktif" name="nonaktifkan" class="btn btn-danger">Nonaktifkan</button>
        <?php    } else { ?>
            <button type="submit" value="Aktif" name="aktif" class="btn btn-success">Aktifkan</button>
        <?php  }
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
    <?php
    include 'script.php';
    ?>

    <script>
         $(document).on("click", "#editdata", function() {
      let nip = $(this).data('nip');
      let idt = $(this).data('idt');
      let batch = $(this).data('batch');
      let nama = $(this).data('nama');
      let gender = $(this).data('gender');
      let asisten = $(this).data('asisten');
      let semester = $(this).data('semester');
     
      $(" #modal-editTraine #nip").val(nip);
      $(" #modal-editTraine #idt").val(idt);
      $(" #modal-editTraine #batch").val(batch);
      $(" #modal-editTraine #nama").val(nama);
      $(" #modal-editTraine #gender").val(gender);
      $(" #modal-editTraine #asisten").val(asisten);
      $(" #modal-editTraine #semester").val(semester);
  

    });
    </script>
</body>

</html>
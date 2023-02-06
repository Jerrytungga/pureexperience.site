<?php
include '../koneksi.php';
include 'session.php';
if (isset($_POST['addringtones'])) {
    $sumber = $_FILES['filUpload']['tmp_name'];
    $target = '../music/';
    $ringtones = $_FILES['filUpload']['name'];
    $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_alarm`) As id FROM `ringtones`"));
    $id_max = $max_id['id'] + 1;
    if ($ringtones != '') {
        if (move_uploaded_file($sumber, $target . $ringtones)) {
            $addnadaalarm =  mysqli_query($conn, "INSERT INTO `ringtones`(`id_alarm`, `Ringtones`) VALUES ('$id_max','$ringtones')");
        }
    }
}

if (isset($_POST['hapus'])) {
    $id =  $_POST['del'];
    // hapus file dalam folder
    $data1 = mysqli_query($conn, "SELECT * FROM `ringtones` WHERE `ringtones`.`id_alarm` = '$id'");
    $ringtones1 = mysqli_fetch_array($data1);
    $data_ = $ringtones1['Ringtones'];
    if (file_exists("../music/$ringtones1[Ringtones]")) {
        unlink("../music/$ringtones1[Ringtones]");
    }
    $menu = mysqli_query($conn, "DELETE FROM `ringtones` WHERE `ringtones`.`id_alarm` = '$id'");
?>
    <script>
        alert("Data Berhasil dihapus!!");
    </script>
<?php
}

$data2 = mysqli_query($conn, "SELECT * FROM `ringtones` ");
$ringtones2 = mysqli_fetch_array($data2);
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
        <h6 class="m-0 font-weight-bold text-primary">Alarm</h6> <br>
        <form action="" method="POST" enctype="multipart/form-data">
                                <div>
                                    <input type="file" name="filUpload"><br>
                                    <button type="submit" name="addringtones" class="btn btn-primary mt-2">Simpan</button>
                                </div>
                            </form>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th data-field="id">ID</th>
                    <th data-field="name" data-editable="false">Ringtones</th>
                    <th data-field="action">Action</th>
               
                    </tr>
                </thead>
               
                <tbody>
                <?php
                   
                $i = 1;
                foreach ($data2 as $row) :
                ?>
                    <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['Ringtones'];  ?></td>
                        
                    <td>
                        <form action="" method="post">
                        <input type="hidden" name="del" value="<?= $row['id_alarm']; ?>">
                        <button type="submit" name="hapus" class="btn btn-danger">Delete</button>
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
<?php
include '../koneksi.php';
include 'session.php';
error_reporting(0);

if (isset($_POST['selesai'])) {
    $done =  $_POST['selesai'];
    $id =  $_POST['id'];
    $menu = mysqli_query($conn, "UPDATE `doa_kasih_karunia` SET `status`='$done' WHERE `id`='$id'");
    
}

if (isset($_POST['simpan'])) {
    $pic =  $_POST['pic'];
    $terburuk =  $_POST['terburuk'];
    $jurnal =  $_POST['jurnal'];
    $r =  $_POST['reguler'];
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id`) As id FROM `doa_kasih_karunia`"));
    $idr = $max['id'] + 1;
    $menu = mysqli_query($conn, "INSERT INTO `doa_kasih_karunia`(`nip`, `reguler`,`id`,`Terburuk`,`incomplete`) VALUES ('$pic','$r','$idr','$terburuk','$jurnal')");
    
}

$presensi = mysqli_query($conn, "SELECT * FROM `doa_kasih_karunia`");
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



<style>
    .rim{
        background-color: #AAD9BB;
        rounded-bottom: 0.5em;
        border-radius: 10px;
    }
    .text{
        color: #000000;
    }
</style>
<div class="card shadow mb-4" >
    <div class="card-header py-3" style="background-color: #80BCBD;">
        <h6 class="m-0 font-weight-bold text-light">Daftar Doa Kasih Karunia</h6> <br>
        <form action="" method="post">
        <div class="btn-group">
      <select name="pic" id="" class="form-control text-gray-900 col-3 mr-2" required>
        <option value="" >Pilih Traines</option>
        <?php
               
               $tampilkan_traines = mysqli_query($conn,"SELECT * FROM `traines`");
               while ($tampilkan_traines_ = mysqli_fetch_array($tampilkan_traines)) {  ?>
               <option value="<?= $tampilkan_traines_['nip'];?>"><?= $tampilkan_traines_['name'];?></option>
             <?php  }
               ?>
      </select>
      <select name="reguler" class="form-control text-gray-900 col-3 mr-2" id="" required>
        <option value="">Pilih Reguler</option>
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
       <option value="R19">R19</option>
       <option value="Evaluasi">Evaluasi</option>
      </select>
      <div class="form-group form-check">
    <input type="checkbox" name="terburuk" value="1" class="form-check-input" id="Terburuk">
    <label class="form-check-label font-weight-bold text-gray-900 mr-4" for="Terburuk">Terburuk</label>
    <input type="checkbox" name="jurnal" value="1" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label font-weight-bold text-gray-900" for="incomplete">incomplete</label>
    </div>
    <button type="submit" class="ml-2 rim" name="simpan">Simpan</button>
</div>






      </form>
    </div>
    <div class="card-body text" >
        <div class="table-responsive">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead style="color: #541212;">
                    <tr>
                    <th>No</th>
        <th>Name</th>
        <th>Terburuk</th>
        <th>incomplete</th>

        <th>Week</th>
      
        
        <th>Aksi</th>
               
                    </tr>
                </thead>
               
                <tbody style="color: #541212;">
           
    <?php
                
                
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
      <td><?= $row['Terburuk']; ?></td>
      <td><?= $row['incomplete']; ?></td>
        <td><?= $row['reguler']; ?></td>
        <td>
            <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <?php
        if ($row['status'] == "0") { ?>
            <button type="submit" value="1" name="selesai" class="btn btn-success">DONE</button>
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
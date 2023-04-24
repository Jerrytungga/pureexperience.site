<?php
include '../koneksi.php';
include 'session.php';
$AKT = $_GET['nip'];
$week = $_GET['week'];

$ambil_data = mysqli_query ($conn,"SELECT * FROM presensi where nip='$AKT' and week='$week'");
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'head.php';
?>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
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
        <h6 class="m-0 font-weight-bold text-primary">Laporan Presensi</h6> <br>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table id="myTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Minggu</th>
        <th>Tanggal</th>
        <th>Kelas</th>
        <th>Judul Berita</th>
        <th>Trainer</th>
        <th>Jam Mulai</th>
        <th>Jam Akhir</th>
        <th>Status</th>
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
                foreach ($ambil_data as $row) :
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
     
        <td><?= $row['week']; ?></td>
        <td><?= $row['presensi_date']; ?></td>
        <td><?= activity($row['id_activity']); ?></td>
        <td><?= news($berita['id_berita']); ?></td>
        <td><?= trainer($berita['id_trainer']); ?></td>
        <td><?= $berita['start_time']; ?></td>
        <td><?= $berita['end_time']; ?></td>
        <td>
        <?php
                           if($row['mark'] == "V") { ?>
                            <span class="badge badge-pill badge-success">V</span>
                         <?php  }
                           if($row['mark'] == "X") { ?>
                            <span class="badge badge-pill badge-danger">X</span>
                         <?php  }
                           if($row['mark'] == "O") { ?>
                            <span class="badge badge-pill badge-warning">O</span>
                         <?php  }
                        if($row['mark'] == "I") { ?>
                        <span class="badge badge-pill badge-info">I</span>
                        <?php  }
                             
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

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>
</body>

</html>
<?php
include 'koneksi.php';
$presensi = mysqli_query($conn, "SELECT * FROM `presensi` where mark='I' ");
$list = mysqli_fetch_array($presensi);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Daftar Kejar Berita</title>
  </head>
  <body>
    
  <div class="card text-center m-3">
  <div class="card-header">
    Daftar Kejar Berita
  </div>
  <div class="card-body">
  <div class="container mt-4">
  <table id="myTable" class="table table-striped table-bordered">
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

      
      </tr>
      <?php $i++; ?>
                     <?php endforeach; ?>
    </tbody>
  </table>
</div>

  </div>
  
</div>



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
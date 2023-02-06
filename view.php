<?php
include 'koneksi.php';
$AKT = $_GET['akt'];
if(isset($_POST['cari'])){
$tgl = $_POST['mulai'];
$akhir_tgl = $_POST['akhir'];

};
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>View Presensi</title>
  </head>
  <body>
 
  <div class="card m-3">
  <div class="card-header">
  <div class="form-group">
 
 
  <div class="card-body">
    <h5 class="card-title">Presensi</h5>
    <form action="" method="post">
    <div>
      <label for="">Masukan Tanggal</label>
      <input type="date" name="mulai">
      <input type="date" name="akhir">
      <button type="submit" name="cari" >Cari</button>
    </div>
  </form>
  <a href="presensi.php?akt=<?= $AKT;?>" class="btn btn-danger">Back</a>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Batch</th>
      <th scope="col"><span class="badge badge-pill badge-success">V</span></th>
      <th scope="col"><span class="badge badge-pill badge-warning">O</span></th>
      <th scope="col"><span class="badge badge-pill badge-danger">X</span></th>
      <th scope="col">Prayer</th>
      <th scope="col">Hymns</th>
      <th scope="col">Exhibition</th>
      <th scope="col">Prophesying</th>
      <th scope="col">Total Minus</th>
    </tr>
  </thead>
  <tbody>
  <?php
   function name($nama_)
   {
     global $conn;
     $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM traines WHERE nip='$nama_'"));
     return $sqly['name'];
   }
   $i = 1;
   $tampilan_presensi = mysqli_query($conn, "SELECT * FROM `presensi` where presensi_date BETWEEN '".$_POST['mulai']."' AND '".$_POST['akhir']."' group by `week`");
   while ($array_presensi = mysqli_fetch_array($tampilan_presensi)) {
    $nip = $array_presensi['nip'];
    $mark_V = $array_presensi['mark'] = 'V';
    $mark_O = $array_presensi['mark'] = 'O';
    $mark_X = $array_presensi['mark'] = 'X';
    $tampil_mark_V = mysqli_query($conn, "SELECT nip, count(mark) as total FROM presensi where nip='$nip' and mark='$mark_V' AND presensi_date BETWEEN '$tgl' AND '$akhir_tgl' GROUP BY week");
    $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);



    foreach ($tampilan_presensi as $row) :
      $traines = mysqli_query($conn, "SELECT * FROM `traines` where nip='".$row['nip']."'");
      $angkatan= mysqli_fetch_array($traines);
                       ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= name($row['nip']); ?></td>
      <td><?= $angkatan['angkatan']; ?></td>
      <td><?= $arraytampil_mark_V['total']; ?></td>
      <td></td>
      <td></td>
      </td>
      
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
    
    <?php $i++; ?>
                     <?php endforeach; 
   }
                     
                     ?>
  </tbody>
</table>

  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>
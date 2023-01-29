<?php
include 'koneksi.php';
if (isset($_POST['buka'])) {
  $AKT = $_POST['batch'];
  header('Location: presensi.php?akt=' . $AKT . '');
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Pure Experience</title>
  <link rel="icon" type="image/x-icon" href="img/logo.png">
</head>

<body>
  <center>

    <img src="img/logo.png" alt="" height="290" width="300">
    <form action="" method="POST">
      <h2 class="m-lg-5">PURE EXPERIENCE</h2>
      <select name="batch" class="form-control m-lg-5 col-4" required>
        <option value="">Select Batch</option>
        <?php
        $abl_angkatan = mysqli_query($conn, "SELECT angkatan FROM `tb_angkatan` ");
        while ($dataangkatan = mysqli_fetch_array($abl_angkatan)) { ?>
          <option value="<?= $dataangkatan['angkatan']; ?>"><?= $dataangkatan['angkatan']; ?></option>
        <?php  }

        ?>
      </select>

      <button class="btn btn-success shadow" type="submit" name="buka">Open Presensi</button>
    </form>
    <a href="Login.php"><button class="btn btn-danger mt-2 mb-4">Login Panel Presensi</button></a>

  </center>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>
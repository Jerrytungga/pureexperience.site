<?php
include 'koneksi.php';
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
  <form action="" method="POST" id="form_id">
  <label for="">Week :</label>
                                                                                        <select id="minggu" name="weekly_" onChange="document.getElementById('form_id').submit();">
                                                                                            <option value="">Select Week</option>
                                                                                            <option value="Orientation">Orientation</option>
                                                                                            <option value="PT1">PT1</option>
                                                                                            <option value="PT2">PT2</option>
                                                                                            <option value="PT3">PT3</option>
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
                                                                                            <option value="Evaluasi">Evaluasi</option>

                                                                                        </select>
                                                                                    </div>
                                                                                    <?php
                                                                                      if ($_POST['weekly_'] > 0 ){ ?>

                                                                                            <div class="form-group">
                                                                                            <input type="hidden" id="idj" name="idj">
                                                                                            <label for="">Batch :</label>
                                                                                            <select id="angkatan" name="akt">
                                                                                                <option value="">Select Batch</option>
                                                                                                <?php
                                                                                                $abl_angkatan = mysqli_query($conn, "SELECT angkatan FROM `tb_angkatan` ");
                                                                                                while ($dataangkatan = mysqli_fetch_array($abl_angkatan)) { ?>
                                                                                                    <option value="<?= $dataangkatan['angkatan']; ?>"><?= $dataangkatan['angkatan']; ?></option>
                                                                                                <?php  }

                                                                                                ?>
                                                                                            </select> <br>

                                                                                            <a href="view.php" class="btn btn-danger">Reset</a>
                                                                                        </div>
                                                                                   <?php   }
                                                                                    ?>
    
    </form>
  </div>
  <div class="card-body">
    <h5 class="card-title">Presensi</h5>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Batch</th>
      <th scope="col">V</th>
      <th scope="col">O</th>
      <th scope="col">X</th>
      <th scope="col">Prayer</th>
      <th scope="col">Hymns</th>
      <th scope="col">Exhibition</th>
      <th scope="col">Prophesying</th>
      <th scope="col">Total Minus</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
    
    </tr>
  </tbody>
</table>

  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>
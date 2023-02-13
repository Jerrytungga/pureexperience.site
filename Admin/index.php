<?php
include '../koneksi.php';
include 'session.php';
if(isset($_POST['simpan'])){
    $tgl = $_POST['week'];
    
    };
$ambil_data = mysqli_query ($conn,"SELECT * FROM presensi GROUP BY nip");
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
       <!-- Button trigger modal tambahkan asisten -->
       <form action="" method="post" id="form_id">
        <select  class="form-control col-3 mt-2" name="week" onChange="document.getElementById('form_id').submit();" required>
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
          <?php 
          if($_POST['week']){ ?>

<a href="index.php" class="btn btn-danger mt-2">Reset</a>
        <?php  }
          ?>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table id="example" class="display nowrap" style="width:100%">
    <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Batch</th>
                <th width="120"><span class="badge badge-pill badge-success">V</span></th>
              <th width="110"><span class="badge badge-pill badge-warning">O</span></th>
              <th width="110"><span class="badge badge-pill badge-danger">X</span></th>
                <th>Prayer</th>
                <th>Hymns</th>
                <th>Exhibition</th>
                <th>Prophesying</th>
                <th>Total Minus</th>
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
            $ambil_data_ = mysqli_query ($conn,"SELECT * FROM presensi GROUP BY nip");
            $i = 1; ?>
            <?php
                while ($array_presensi = mysqli_fetch_array($ambil_data)) {
                  $nip = $array_presensi['nip'];
                  $mark_V = $array_presensi['mark'] = 'V';
                  $mark_O = $array_presensi['mark'] = 'O';
                  $mark_X = $array_presensi['mark'] = 'X';

                  $tampil_mark_V = mysqli_query($conn, "SELECT nip, count(mark) as total FROM presensi where nip='$nip' and mark='$mark_V' and week='".$_POST['week']."'");
                  $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                  $tampil_mark_O = mysqli_query($conn, "SELECT nip, count(mark) as total FROM presensi where nip='$nip' and mark='$mark_O' and week='".$_POST['week']."'");
                  $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                  $tampil_mark_X = mysqli_query($conn, "SELECT nip, count(mark) as total FROM presensi where nip='$nip' and mark='$mark_X' and week='".$_POST['week']."'");
                  $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                  $doa = mysqli_query($conn, "SELECT nip, SUM(P) as total  FROM `tb_doa` WHERE nip='$nip' AND week='".$_POST['week']."'");
                  $poindoa = mysqli_fetch_array($doa);
                  
                  $kidung = mysqli_query($conn, "SELECT nip, SUM(H) as total  FROM `tb_kidung` WHERE nip='$nip' AND week='".$_POST['week']."'");
                  $poinkidung = mysqli_fetch_array($kidung);
                  
                  $exhibition = mysqli_query($conn, "SELECT nip, SUM(E) as total  FROM `tb_pameran` WHERE nip='$nip' AND week='".$_POST['week']."'");
                  $poinexhibition = mysqli_fetch_array($exhibition);
                  
                  $ts = mysqli_query($conn, "SELECT nip, SUM(TS) as total  FROM `tb_ts` WHERE nip='$nip' AND week='".$_POST['week']."'");
                  $points = mysqli_fetch_array($ts);
                  
                  $tampil3 = mysqli_query($conn, "SELECT * FROM presensi where nip='$nip' group by nip ");
                  $arraytampil3 = mysqli_fetch_array($tampil3);
                  
                  $total_point = $arraytampil_mark_O['total']*-1 + $arraytampil_mark_X['total']*-2;
                  ?>

<?php foreach ($tampil3 as $row) : 
                $traines = mysqli_query ($conn,"SELECT * FROM traines where nip='$nip'");
                $ambil_batch = mysqli_fetch_array($traines);
              
            
            ?>
              <center>
            <tr>

                <td><?= $i; ?></td>
                <td><?= name($arraytampil3['nip']); ?></td>
             <td><?= $ambil_batch['angkatan']; ?></td>
             <td><?= $arraytampil_mark_V['total']; ?></td>
             <td><?= $arraytampil_mark_O['total']*-1; ?></td>
             <td><?= $arraytampil_mark_X['total'] *-2; ?></td>
             <td><?php
             if($poindoa['total'] > 0) {
              echo $poindoa['total'];
            } else {
               echo $poindoa['total'] = 0;
             }
               ?></td>
             <td><?php
              if($poinkidung['total'] > 0) {
                echo $poinkidung['total'];
              } else {
                 echo $poinkidung['total'] = 0;
               }
               ?></td>
             <td><?php
               if($poinexhibition['total'] > 0) {
                 echo $poinexhibition['total'];
                } else {
                  echo $poinexhibition['total'] = 0;
                }
                ?></td>
             <td><?php
               if($points['total'] > 0) {
                 echo $points['total'];
                } else {
                  echo $points['total'] = 0;
                }
                ?></td>
        
        <td><?php
        if($total_point < 0) { ?>
        <span class="badge badge-pill badge-danger"><?= $total_point ?></span>
       <?php  } else {
           echo $total_point = 0;
         }
        ?></td>
      </tr>
    </center>
      <?php $i++; ?>
            <?php endforeach; 
            } ?>
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
    <script>
      $(document).ready(function() {
        $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
          ]
        } );
      } );
      </script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    
</body>

</html>
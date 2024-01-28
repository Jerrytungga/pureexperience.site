<?php
include 'koneksi.php';
$AKT = $_GET['akt'];
if ($AKT == "") {
  header("location: index.php");
}
$page = $_SERVER['REQUEST_URI'];
$sec = "30";
session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');

if (isset($_POST['nip'])) {
  $nip = htmlspecialchars($_POST['nip']);
  $jadwal = htmlspecialchars($_POST['jadwal']);
  $ambil_traines = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `traines` WHERE nip='$nip'"));
  $ambildata_jadwal = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `schedule` WHERE id='$jadwal'"));
  $idkegiatan = $ambildata_jadwal['id_activity'];
  $minggu = $ambildata_jadwal['week'];
  $mark_ = "V";
  $smt2 = $ambil_traines['semester'];
  $asisten_ = $ambil_traines['Asisten'];
  $angkatan = $ambil_traines['angkatan'];
  
  $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_presensi`) As id FROM `presensi`"));
  $idbr = $max['id'] + 1;
  $masukan_data =  mysqli_query($conn, "INSERT INTO `presensi`(`nip`, `batch`, `week`, `id_activity`, `presensi_time`, `mark`,`id_presensi`,`schedule_id`,`semester`,`asisten`) VALUES ('$nip','$angkatan','$minggu','$idkegiatan','$waktu_sekarang','$mark_','$idbr','$jadwal','$smt2','$asisten_')");
          
  }










$presensi = mysqli_query($conn, "SELECT * FROM `presensi` where batch='$AKT' ");
$list = mysqli_fetch_array($presensi);

$jadwal = mysqli_query($conn, "SELECT * FROM schedule where batch='$AKT' and status='Aktif' and  date='$hari_ini' and end_time > '$waktu_sekarang'   ORDER BY start_time ASC");
$list = mysqli_fetch_array($jadwal);

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="css/sb-admin-2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>


    <link rel="stylesheet" href="source/bootstrap.min.css">
    <script src="source/jquery.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
    <script src="source/popper.min.js"></script>
    <script src="source/bootstrap.min.js"></script>

    <!--<script src="datatables/jquery.dataTables.js"></script>-->
    <script src="source/jquery.dataTables.min.js"></script>
    <!--<script src="datatables/dataTables.bootstrap.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>-->
    <script src="source/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="source/dataTables.bootstrap4.min.css">
    <link rel="icon" href="data:;base64,=">



    <title>Presensi</title>
    <style media="screen">
      td { vertical-align: top }
    
      img {
        border-radius: 50%;
        
      }
      td,th,h4{
    font-size: 14pt;
    color:#03001C;
      }

      body {
  background-color: #E6FFFD;
}

      
    </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
 
    $("button1").hide();
});
</script>



  </head>


  <body>
    <script src="client.js"></script>
    <a class="btn btn-outline-primary m-1" href="presensi.php?akt=<?= $AKT;?>">Back</a>
    <!-- <a class="btn btn-outline-primary m-1" href="view.php?akt=<?= $AKT;?>">View Presensi</a> -->
    <a class="btn btn-info m-1" href="presensipm.php?akt=<?= $AKT;?>">Presensi PM & LIVING <span class="badge bg-danger text-light">New</span></a>
    <table class="table" id="bodyTable">
        <tr>
            <td style="width:35%; height:30%;">
                <center>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: #16FF00;">
                            <h4 class="m-0 font-weight-bold text-white" id='dateToday'> </h4>
                            <!--<p id='dateToday' style="font-size:25pt"> -->
                                <script type="text/javascript">
                                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                document.getElementById("dateToday").innerHTML = new Date().toLocaleDateString('en-ID', options);
                                </script>
                            <!--</p> -->
                        </div>
                        <div class="card-body">
                            <p id='jam' style="font-size:70pt;color: #03001C;">
                               
                            </p>
                        </div>
                    </div>
                
                
                </center>
             
         
            </td>
            
            <td style="width:35%; height:30%;">
               
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: #16FF00;">
                            <h2 class="m-0 font-weight-bold text-white" id='dateToday'> 
                               RFID 
                               <div class="spinner-grow text-danger" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                            </h2>
                            
                        </div>
                        <div class="card-body">
                        <form action="" method="post">
          <select name="jadwal" class="form-control m-1" id="" required>
            <option value="">Pilih Jadwal</option>
            <?php
            $tampilkan_jadwal = mysqli_query($conn,"SELECT * FROM `schedule` where `date`='$hari_ini'");
            while ($tampilkan = mysqli_fetch_array($tampilkan_jadwal)){ ?>
              <option value="<?= $tampilkan['id'];?>"><?= activity($tampilkan['id_activity']);?></option>

          <?php  }
            ?>
          </select>

          <input type="text" class="form-control m-1" name="nip" required>
        <button1 type="submit" name="simpan">Simpan</button1>
        </form>
               
           
                           
                          
                        </div>
                    </div>
             
            </td>

            <td style="width:40%; font-size: 14pt" rowspan="2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Today's Schedule</th>
                            <th>Start Time</th>
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
                    $i = 1;
                        foreach ($jadwal as $row) :
                    ?>
                        <tr>
                            <td><?= activity($row['id_activity']); ?></td>
                            <td><?= $row['start_time']; ?></td>
                           
                            
                        </tr>
                        <?php $i++; ?>
                     <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td style="height:10%;">
                <!-- Basic Card Example -->
                            <div class="card shadow mb-4 anouncement_marquee">
                                <div class="card-header py-3" style="background-color: #16FF00;">
                                    <marquee><h3 class="m-0 font-weight-bold text-white">A  N  N  O  U  N  C  E  M  E  N  T</h3></marquee>
                                </div>
                                <div class="card-body"><font size="4pt"><p id="anouncement">
                                  Bagi saudara-saudari yang terlibat pelayanan makan, harus presensi di bawa waktu terakhir <b class="text-danger"><?= $list['timer']; ?></b>  lebih dari itu, sistem akan secara automatis menganggap  <span class="badge badge-pill badge-danger">X</span>
                                </p></font></div>
                            </div>
            </td>
            <td style="height:10%;">
                <!-- Basic Card Example -->
                            <div class="card shadow mb-4 anouncement_marquee">
                            <div class="card-header py-3" style="background-color: #16FF00;">
                            <meta http-equiv="refresh" content="<?= $sec ?>;URL='<?= $page ?>'">
                                    <h3 class="m-0 font-weight-bold text-white">View Presence Summary</h3>
                                </div>
                                <table class="table table-striped">
                                <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                            <th>Schedule</th>
                            <th></th>
                            <th></th>
                            <th>Status</th>
                        </tr>
                    </thead>
                                </table>
                                <div class="card-body" style="height: 350px;overflow: scroll;">
                                <table class="table table-striped">
                 
                    <tbody>
                        <?php
                    $i = 1;
                    function name($nama_)
                    {
                      global $conn;
                      $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM traines WHERE nip='$nama_'"));
                      return $sqly['name'];
                    }
                    $tampil3 = mysqli_query($conn, "SELECT * FROM presensi where presensi_date='$hari_ini'  order by presensi_time DESC");
                    $arraytampil3 = mysqli_fetch_array($tampil3);
                        foreach ($tampil3 as $data) :
                    ?>
                        <tr>
                            <td><?= name($data["nip"]); ?></td>
                            <td><?= activity($data['id_activity']); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php
                           if($data['mark'] == "V") { ?>
                            <span class="badge badge-pill badge-success">V</span>
                         <?php  }
                           if($data['mark'] == "X") { ?>
                            <span class="badge badge-pill badge-danger">X</span>
                         <?php  }
                           if($data['mark'] == "O") { ?>
                            <span class="badge badge-pill badge-warning">O</span>
                         <?php  }
                             
                             ?></td>
                           
                            
                        </tr>
                        <?php $i++; ?>
                     <?php endforeach; ?>
                    </tbody>
                </table>
                            </div>
                            </div>
            </td>
        </tr>
    </table>

   

























  <?php
  include 'alert.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>





  <center><p>FTTI Absent system (ver. 1.0) - © 2023 by JERRI <sup>51</sup></p></center>
 <ul id="log"></ul>






<!---------------------------- event handling ------------------------------------->
<script type="text/javascript" src="scanner/js/jquery.js"></script>
  <script type="text/javascript" src="scanner/js/qrcodelib.js"></script>
  <script type="text/javascript" src="scanner/js/webcodecamjquery.js"></script>
  <script type="text/javascript">
    window.onload = function() {
      jam();
    }

    function jam() {
      var e = document.getElementById('jam'),
        d = new Date(),
        h, m, s;
      h = d.getHours();
      m = set(d.getMinutes());
      s = set(d.getSeconds());

      e.innerHTML = h + ':' + m + ':' + s;

      setTimeout('jam()', 1000);
    }

    function set(e) {
      e = e < 10 ? '0' + e : e;
      return e;
    }
  </script>
  </body>
</html>

<?php
function notice($type)
{
  if ($type == 2) {
    return "<audio autoplay><source src='" . 'music/beep.mp3' . "'></audio><br><audio autoplay><source src='" . 'music/voice.mp3' . "'></audio>";
  } elseif ($type == 1) {
    return "<audio autoplay><source src='" . 'music/success.wav' . "'></audio>";
  } elseif ($type == 3) {
    return "<audio autoplay><source src='" . 'music/beep.mp3' . "'></audio>";
  } elseif ($type == 4) {
    return "<audio autoplay><source src='" . 'music/Akses_ditolak.mp3' . "'></audio>";
  } elseif ($type == 5) {
    return "<audio autoplay><source src='" . 'music/Tidak_terdaftar.mp3' . "'></audio>";
  }
}
?>
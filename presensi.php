<?php
include 'koneksi.php';
$AKT = $_GET['akt'];
if ($AKT == "") {
  header("location: index.php");
}
$page = $_SERVER['REQUEST_URI'];
$sec = "30";
session_start();

error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');

if (isset($_POST['nip'])) {
  $nip = $_POST['nip'];
  $sql_traines = mysqli_query($conn, "SELECT angkatan, semester, Asisten FROM `traines` WHERE nip='$nip'");
  $data_angkatan = mysqli_fetch_array($sql_traines);
  $angkatan = $data_angkatan['angkatan'];
  $smt2 = $data_angkatan['semester'];
  $asisten_ = $data_angkatan['Asisten'];
}

// cek angkatan presensi ijin
if (isset($_POST['ijin'])) {
  $nip = $_POST['ijin'];
  $sql_traines = mysqli_query($conn, "SELECT angkatan, semester, Asisten FROM `traines` WHERE nip='$nip'");
  $data_angkatan = mysqli_fetch_array($sql_traines);
  $angkatan34 = $data_angkatan['angkatan'];
  $smt2 = $data_angkatan['semester'];
  $asisten_ = $data_angkatan['Asisten'];
}
/////////


$jadwal1 = mysqli_query($conn, "SELECT * FROM schedule WHERE batch='$AKT' and status='Aktif' and  date='$hari_ini' and end_time > '$waktu_sekarang'   ORDER BY start_time ASC");
$cek_presensi = mysqli_fetch_array($jadwal1);
$cek = mysqli_num_rows($jadwal1);

$data_jadwal = mysqli_query($conn, "SELECT date FROM schedule ");
$cek_presensi2 = mysqli_fetch_array($data_jadwal);
if($hari_ini > $cek_presensi2['date']){
 mysqli_query($conn, "UPDATE `schedule` SET `status` = 'Tidak Aktif' WHERE `schedule`.`status` ='Aktif' and date < '$hari_ini'");
    
}


$cekid = mysqli_query($conn, "SELECT nip FROM traines WHERE nip='".$_POST['nip']."'");
$cekdata_id = mysqli_fetch_array($cekid);
$cek__id = mysqli_num_rows($cekid);

$cek_angkatan_jadwal = mysqli_query($conn, "SELECT * FROM `schedule` where batch='$AKT' and  status='Aktif' and date='$hari_ini'  and   `presensi_time` < '$waktu_sekarang' and  `end_time` > '$waktu_sekarang'");
$cek_batch = mysqli_fetch_array($cek_angkatan_jadwal);
$cek_batch['batch'];

// set alarm
$alert_alarm = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `schedule` WHERE  batch='$AKT' and status='Aktif' and  `date`='$hari_ini' and `presensi_time`  < '$waktu_sekarang' and  `timer` > '$waktu_sekarang' "));
$alarm = $alert_alarm['nada_alarm'];
if ($alert_alarm['presensi_time'] < $waktu_sekarang && $alert_alarm['start_time'] > $waktu_sekarang) { ?>
  <audio src="music/<?= $alarm; ?>" autoplay="autoplay" hidden="hidden"></audio>
<?php }


if ($angkatan == $cek_batch['batch']) {
  $angkatan_sama = mysqli_query($conn, "SELECT * FROM `schedule` where status='Aktif' and batch='$AKT' and date='$hari_ini'  and   `presensi_time` < '$waktu_sekarang' and  `end_time` > '$waktu_sekarang'");
  $jadwal_angkatan_sama = mysqli_fetch_array($angkatan_sama);
  $id_1 = $jadwal_angkatan_sama['id'];
  $week1 = $jadwal_angkatan_sama['week'];
  $batch1 = $jadwal_angkatan_sama['batch'];
  $id_kegiatan2 = $jadwal_angkatan_sama['id_activity'];
  $info1 = $jadwal_angkatan_sama['info'];
  $waktu1 = $jadwal_angkatan_sama['start_time'];
  $jam_akhir1 = $jadwal_angkatan_sama['end_time'];
  $waktuabsent1 = $jadwal_angkatan_sama['presensi_time'];
  $timer1 = $jadwal_angkatan_sama['timer'];


  if ($angkatan == $cek_batch['batch']) {
    // memasukan data jadwal kegiatan berdasarkan data angkatan dan waktu dan hari
    if ($waktuabsent1 < $waktu_sekarang && $jam_akhir1 > $waktu_sekarang) {
      if ($waktuabsent1 < $waktu_sekarang && $timer1 > $waktu_sekarang) {
        $hasil1 = 'V';
      } 
      if ($waktu1 < $waktu_sekarang && $timer1 > $waktu_sekarang) {
        $hasil1 = 'O';
      } 
      if ($waktu1 < $waktu_sekarang && $timer1 < $waktu_sekarang) {
        $hasil1 = 'X';
      }
    }

    if (isset($_POST['nip'])) {
      $nip = htmlspecialchars($_POST['nip']);
      $sql_cekdata_presensi = mysqli_num_rows(mysqli_query($conn, "SELECT nip, angkatan FROM `traines` WHERE nip='$nip' and angkatan='" . $cek_batch['batch'] . "'"));
      if ($sql_cekdata_presensi > 0) {
        $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_presensi`) As id FROM `presensi`"));
        $idbr2 = $max['id'] + 1;
        $inputpresensi =  mysqli_query($conn, "INSERT INTO `presensi`(`nip`, `batch`, `week`, `id_activity`, `presensi_time`, `mark`, `info_schedule`,`id_presensi`,`schedule_id`,`semester`,`asisten`) VALUES ('$nip','$batch1','$week1','$id_kegiatan2','$waktu_sekarang','$hasil1','$info1','$idbr2','$id_1','$smt2','$asisten_')");

        if($inputpresensi){
          echo notice(2);
        } else {
          echo notice(4);
        }
        
      }
    }

}
  }
  if ($cek_batch['batch'] == $angkatan34) {
    $angkatan_sama = mysqli_query($conn, "SELECT * FROM `schedule` where status='Aktif' and batch='$AKT' and date='$hari_ini'  and   `presensi_time` < '$waktu_sekarang' and  `end_time` > '$waktu_sekarang'");
    $jadwal_angkatan_sama = mysqli_fetch_array($angkatan_sama);
    $id_1 = $jadwal_angkatan_sama['id'];
    $week1 = $jadwal_angkatan_sama['week'];
    $batch1 = $jadwal_angkatan_sama['batch'];
    $id_kegiatan2 = $jadwal_angkatan_sama['id_activity'];
    $info1 = $jadwal_angkatan_sama['info'];
    $waktu1 = $jadwal_angkatan_sama['start_time'];
    $jam_akhir1 = $jadwal_angkatan_sama['end_time'];
    $waktuabsent1 = $jadwal_angkatan_sama['presensi_time'];
    $timer1 = $jadwal_angkatan_sama['timer'];
    if ($cek_batch['batch'] == $angkatan34) {
    if (isset($_POST['ijin'])) {
    $nip_2 = $_POST['ijin'];
    $hasil_ = 'I';
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_presensi`) As id FROM `presensi`"));
    $idbr2 = $max['id'] + 1;
    $inputpresensi =  mysqli_query($conn, "INSERT INTO `presensi`(`nip`, `batch`, `week`, `id_activity`, `presensi_time`, `mark`, `info_schedule`,`id_presensi`,`schedule_id`,`semester`,`asisten`) VALUES ('$nip_2','$batch1','$week1','$id_kegiatan2','$waktu_sekarang','$hasil_','$info1','$idbr2','$id_1','$smt2','$asisten_')");
  }
 }
}
  if (isset($_POST['nip'])) {
    if ($cek_presensi['presensi_time'] > $waktu_sekarang) {
       echo notice(4);
     }
   }

if ($cek_batch['batch'] == 'ALL') {
  $sqli_jadwal_All = mysqli_query($conn, "SELECT * FROM `schedule` where status='Aktif' and `batch`='" . $cek_batch['batch'] . "' and  date='$hari_ini'  and   `presensi_time` < '$waktu_sekarang' and  `end_time` > '$waktu_sekarang'");
  $array_jadwal_ALL = mysqli_fetch_array($sqli_jadwal_All);
  $id_ = $array_jadwal_ALL['id'];
  $week = $array_jadwal_ALL['week'];
  $batch = $array_jadwal_ALL['batch'];
  $id_kegiatan1 = $array_jadwal_ALL['id_activity'];
  $info = $array_jadwal_ALL['info'];
  $waktu = $array_jadwal_ALL['start_time'];
  $jam_akhir = $array_jadwal_ALL['end_time'];
  $waktuabsent = $array_jadwal_ALL['presensi_time'];
  $timer = $array_jadwal_ALL['timer'];
  if ($batch) {
    // memasukan data jadwal kegiatan berdasarkan data angkatan dan waktu dan hari
    if ($waktuabsent < $waktu_sekarang && $jam_akhir > $waktu_sekarang) {
      if ($waktuabsent < $waktu_sekarang && $timer > $waktu_sekarang) {
        $hasil = 'V';
      } 
      if ($waktu < $waktu_sekarang && $timer > $waktu_sekarang) {
        $hasil = 'O';
      } 
      if ($waktu < $waktu_sekarang && $timer < $waktu_sekarang) {
        $hasil = 'X';
      }


    }




    if (isset($_POST['nip'])) {
      $nip = htmlspecialchars($_POST['nip']);
      $sql_cekdata_nip = mysqli_num_rows(mysqli_query($conn, "SELECT nip, angkatan FROM `traines` WHERE nip='$nip' and angkatan='$angkatan'"));
      if ($sql_cekdata_nip > 0) {
        $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_presensi`) As id FROM `presensi` WHERE presensi_date=date(now()) AND schedule_id='$id_'"));
        $idbr = $max['id'] + 1;
        $inputpresensi =  mysqli_query($conn, "INSERT INTO `presensi`(`nip`, `batch`, `week`, `id_activity`, `presensi_time`, `mark`, `info_schedule`, `id_presensi`, `schedule_id`,`semester`,`asisten`) VALUES ('$nip','$batch','$week','$id_kegiatan1','$waktu_sekarang','$hasil','$info','$idbr','$id_','$smt2','$asisten_')");
        if($inputpresensi){
          echo notice(2);
        } else {
          echo notice(4);
          // $Announcement = $_SESSION['Announcement'] = '<strong>Hanya bisa 1 kali Presensi!</strong>';

        }
      } 
    }
    if (isset($_POST['ijin'])) {
      $idbr = $max['id'] + 1;
    $nip_2 = $_POST['ijin'];
      $sql_traines2 = mysqli_query($conn, "SELECT angkatan, semester, Asisten FROM `traines` WHERE nip='$nip_2'");
      $data_angkatan2 = mysqli_fetch_array($sql_traines2);
      $angkatan2 = $data_angkatan2['angkatan'];
      $smt22 = $data_angkatan2['semester'];
      $asisten_2 = $data_angkatan2['Asisten'];
      $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_presensi`) As id FROM `presensi` WHERE presensi_date=date(now()) AND schedule_id='$id_'"));
      $hasil_ = 'I';
      $inputpresensi =  mysqli_query($conn, "INSERT INTO `presensi`(`nip`, `batch`, `week`, `id_activity`, `presensi_time`, `mark`, `info_schedule`, `id_presensi`, `schedule_id`,`semester`,`asisten`) VALUES ('$nip_2','$batch','$week','$id_kegiatan1','$waktu_sekarang','$hasil_','$info','$idbr','$id_','$smt22','$asisten_2')");
    }
  }

}
if (isset($_POST['nip'])) {
  if ($cek__id == 0) {
    echo notice(5);
  }
}

if (isset($_POST['nip'])) {
 if ($cek_presensi['presensi_time'] > $waktu_sekarang) {
    echo notice(4);
  }
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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
      
    </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
 
    $("button1").hide();
});
</script>

<style>
input {
  width: 0px;
  height: 0px;
  border:0px;
  outline: none;
  border-radius: 5px; 
  margin-bottom: 10px;
  margin-top: 5px;
  font-family: sans-serif,Arial;
  font-size: 16px;
  color: white; 
}

.garis_verikal{
border-left: 2px black solid;
height: 10px;
width: 0px;
}

</style>

  </head>


  <body>
    <script src="client.js"></script>
    <form action="" method="post"  id="nip2">
    <div class="input-group">
      <a class="btn btn-outline-primary m-1" href="index.php">Back</a>
      <a class="btn btn-info m-1" href="presensipm.php?akt=<?= $AKT;?>">Presensi PM, LIVING & SEKUTU  </a>
      <select name="ijin" id="" class="form-control col-3 m-1"  autocomplete="off"  required="" onChange="document.getElementById('nip2').submit();">
        <option value="">Permission Not To Enter Class</option>
        <?php
               
              $tampilkan_traines = mysqli_query($conn,"SELECT * FROM `traines`");
              while ($tampilkan_traines_ = mysqli_fetch_array($tampilkan_traines)) {  ?>
              <option value="<?= $tampilkan_traines_['nip'];?>"><?= $tampilkan_traines_['name'];?></option>
            <?php  }
              ?>
      </select>
    </div>
  </form>
    <table class="table" id="bodyTable">
        <tr>
            <td style="width:35%; height:30%;">
                <center>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: #243763;">
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
                        <div class="card-header py-3" style="background-color: #243763;">
                            <h2 class="m-0 font-weight-bold text-white" id='dateToday'> 
                               RFID 
                               <div class="spinner-grow text-danger" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                            </h2>
                            
                        </div>
                        <div class="card-body">
                          
                <a href="prayer.php?akt=<?= $AKT;?>" class="btn text-light btn-sm ml-3" style="background-color: #0E8388;">Prayer</a>
                <a href="Hymns.php?akt=<?= $AKT;?>" class="btn text-light btn-sm ml-3" style="background-color: #3A98B9;">Hymns</a>
                <a href="Exhibition.php?akt=<?= $AKT;?>" class="btn text-dark btn-sm ml-3" style="background-color: #FFED00;">Exhibition</a>
                <a href="Prophesying.php?akt=<?= $AKT;?>" class="btn text-dark btn-sm ml-3 " style="background-color: #BFDB38;">Prophesying</a>
                <!-- <a href="Prophesying.php?akt=<?= $AKT;?>" class="btn text-dark btn-sm ml-3 m-2 " style="background-color: #19A7CE;">Permission Not To Enter Class</a> -->
                <form action="" method="post">
                          <input type="number"   name="nip"   autofocus  autocomplete="off"  required="" >
                          <button1 type="submit" name="simpan" style="width: 50px; height: 37px; background: white"><i class='bx bx-scan color:white; '></i></button1>
                          </form>
                           
                          
                        </div>
                    </div>
             
            </td>

            <td style="width:40%; font-size: 14pt" rowspan="2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Today's Schedule</th>
                            <th>Presensi Time</th>
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
                            <td><?= $row['presensi_time']; ?></td>
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
                                <div class="card-header py-3" style="background-color: #243763;">
                                    <marquee><h3 class="m-0 font-weight-bold text-white">A  N  N  O  U  N  C  E  M  E  N  T</h3></marquee>
                                </div>
                                <div class="card-body"><font size="4pt"><p id="anouncement">
                                    Karena kasih karunia Allah yang menyelamatkan semua manusia sudah nyata. Ia (kasih karunia Allah ini) mendidik (melatih) kita supaya kita meninggalkan kefasikan dan keinginan-keinginan duniawi dan supaya kita hidup bijaksana, adil dan beribadah di dalam dunia sekarang ini dengan menantikan penggenapan pengharapan kita yang penuh bahagia dan penyataan kemuliaan Allah yang Mahabesar dan Juruselamat kita Yesus Kristus, yang telah menyerahkan diri-Nya bagi kita untuk membebaskan kita dari segala kejahatan dan untuk menguduskan bagi diri-Nya suatu umat, kepunyaan-Nya sendiri, yang rajin berbuat baik. <b>(Titus 2:11-14)</b>
                                </p></font></div>
                            </div>
            </td>
            <td style="height:10%;">
                <!-- Basic Card Example -->
                            <div class="card shadow mb-4 anouncement_marquee">
                            <div class="card-header py-3" style="background-color: #243763;">
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
                    $tampil3 = mysqli_query($conn, "SELECT * FROM presensi where batch='$AKT' and presensi_date='$hari_ini'  order by presensi_time DESC");
                    $arraytampil3 = mysqli_fetch_array($tampil3);
                        foreach ($tampil3 as $data) :
                    ?>
                        <tr>
                            <td><?= name($data["nip"]); ?></td>
                            <td><?= activity($data['id_activity']); ?></td>
                            <td></td>
                            <td></td>
                           
                            <td></td>
                            <td>
                              <?php
                           if($data['mark'] == "V") { ?>
                            <span class="badge badge-pill badge-success">V</span>
                         <?php  }
                           if($data['mark'] == "X") { ?>
                            <span class="badge badge-pill badge-danger">X</span>
                         <?php  }
                           if($data['mark'] == "O") { ?>
                            <span class="badge badge-pill badge-warning">O</span>
                         <?php  }
                        if($data['mark'] == "I") { ?>
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
            </td>
        </tr>
    </table>

   
























  <?php
  include 'alert.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>






<center><p>FTTI Absent system (ver. 1.0) - © 2023 by JerSoft</p></center>
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
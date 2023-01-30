<?php
include 'koneksi.php';
$AKT = $_GET['akt'];
if ($AKT == "") {
  header("location: index.php");
}
$page = $_SERVER['REQUEST_URI'];
$sec = "40";
session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');

if (isset($_POST['nip'])) {
  $nip = $_POST['nip'];
  $sql_traines = mysqli_query($conn, "SELECT angkatan, semester FROM `traines` WHERE nip='$nip'");
  $data_angkatan = mysqli_fetch_array($sql_traines);
  $angkatan = $data_angkatan['angkatan'];
  $smt2 = $data_angkatan['semester'];
}

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
        $inputpresensi =  mysqli_query($conn, "INSERT INTO `presensi`(`nip`, `batch`, `week`, `id_activity`, `presensi_time`, `mark`, `info_schedule`,`id_presensi`,`schedule_id`,`semester`) VALUES ('$nip','$batch1','$week1','$id_kegiatan2','$waktu_sekarang','$hasil1','$info1','$idbr2','$id_1','$smt2')");
        
        if($inputpresensi){
          echo notice(2);
        } else {
          $cekdata = $_SESSION['cek_data'] = '<p class="text-danger"><strong>Hanya bisa 1 kali Presensi!</strong></p>';
          echo notice(3);

        }
      }
    }
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
        $inputpresensi =  mysqli_query($conn, "INSERT INTO `presensi`(`nip`, `batch`, `week`, `id_activity`, `presensi_time`, `mark`, `info_schedule`, `id_presensi`, `schedule_id`,`semester`) VALUES ('$nip','$batch','$week','$id_kegiatan1','$waktu_sekarang','$hasil','$info','$idbr','$id_','$smt2')");
          
        if($inputpresensi){
          echo notice(2);
        } else {
          echo notice(3);
          $Announcement = $_SESSION['Announcement'] = 'Terimakasih';

        }
      } 
    }
  }

  // if (isset($_POST['nip'])) {
  //   if ($cek == 0) {
  //     $Announcement = $_SESSION['Announcement'] = 'No Schedule';
  //     echo notice(4);
  //   } else if ($cek_presensi['presensi_time'] > $waktu_sekarang) {
  //     $Announcement = $_SESSION['Announcement'] = 'Belum Saatnya Untuk Presensi!';
  //     echo notice(4);
  //   }
  // }
}












$presensi = mysqli_query($conn, "SELECT * FROM `presensi` where batch='$AKT' ");
$list = mysqli_fetch_array($presensi);

$jadwal = mysqli_query($conn, "SELECT * FROM schedule where batch='$AKT' and status='Aktif' and   date='$hari_ini' and end_time > '$waktu_sekarang'   ORDER BY start_time ASC");
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



    <title></title>
    <style media="screen">
      td { vertical-align: top }
    
      img {
        border-radius: 50%;
        
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


</style>

  </head>


  <body>
    <script src="client.js"></script>
    <a class="btn btn-success m-1" href="index.php">Kembali</a>
    <?= $data_angkatan['angkatan']; ?>
    <table class="table" id="bodyTable">
        <tr>
            <td style="width:35%; height:30%;">
                <center>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-success">
                            <h4 class="m-0 font-weight-bold text-white" id='dateToday'> </h4>
                            <!--<p id='dateToday' style="font-size:25pt"> -->
                                <script type="text/javascript">
                                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                document.getElementById("dateToday").innerHTML = new Date().toLocaleDateString('en-ID', options);
                                </script>
                            <!--</p> -->
                        </div>
                        <div class="card-body">
                            <p id='clock' class="text-dark" style="font-size:70pt">
                                <script type="text/javascript">
                                        var myVar = setInterval(myTimer, 1000);
                                        function myTimer() {
                                            document.getElementById("clock").innerHTML = new Date().toLocaleTimeString('it-IT');
                                        }
                                </script>
                            </p>
                        </div>
                    </div>
                
                
                </center>
             
         
            </td>
            
            <td style="width:35%; height:30%;">
               
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-success">
                            <h2 class="m-0 font-weight-bold text-white" id='dateToday'> 
                               RFID 
                               <div class="spinner-grow text-danger" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                            </h2>
                            
                        </div>
                        <div class="card-body">
                          
                <button class="btn btn-success btn-sm ml-3">Prayer</button>
                <button class="btn btn-success btn-sm ml-3">Hymns</button>
                <button class="btn btn-success btn-sm ml-3">Exhibition</button>
                <button class="btn btn-success btn-sm ml-3 ">Prophesying</button>
                <form action="" method="post">
                          <input type="text"   name="nip"   autofocus  autocomplete="off"  required="" >
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
                                <div class="card-header py-3 bg-success">
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
                            <div class="card-header py-3 bg-success">
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
                    $tampil3 = mysqli_query($conn, "SELECT * FROM presensi  group by nip ");
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

   




  <!-------------------- Modal view Absent-------------->
  <div class="modal fade" id="modalViewAbsent" role="dialog">
    <div class="modal-dialog modal-xl" style="width:1400px;" >
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
          <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height:550px;">
                <table class="table table-bordered table-hover" id="viewAbsentTable" >
                </table>
          </div>
        </div>
        <div class="modal-footer">
          <h5 align="left"><script type="text/javascript">document.write(new Date().toLocaleDateString('en-ID', options) + "&nbsp;&nbsp;");</script></h5>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>























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
    var arg = {
      resultFunction: function(result) {

        var redirect = '';
        $.redirectPost(redirect, {
          nip: result.code
        });
      }
    };

    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("selet");
    decoder.play();
    // $('selct').on('change', function() {
    //   decoder.stop().play();
    // });

    $.extend({
      redirectPost: function(location, args) {
        var form = '';
        $.each(args, function(key, value) {
          form += '<input type="hidden" name="' + key + '" value="' + value + '">';
        });
        $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
      }
    });
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
    return "<audio autoplay><source src='" . 'music/error.wav' . "'></audio>";
  }
}
?>
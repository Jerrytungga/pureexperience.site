<?php
include 'koneksi.php';
$AKT = $_GET['akt'];
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');
$jadwal_minggu = mysqli_query($conn, "SELECT MAX(week) as akhir FROM `presensi` where  presensi_date='$hari_ini'");
$ambil_max = mysqli_fetch_array($jadwal_minggu);
$week = $ambil_max['akhir'];
if (isset($_POST['nip'])) {
  $nip = $_POST['nip'];
  $sql_traines = mysqli_query($conn, "SELECT angkatan, semester, Asisten FROM `traines` WHERE nip='$nip'");
  $data_angkatan = mysqli_fetch_array($sql_traines);
  $angkatan = $data_angkatan['angkatan'];
  $smt2 = $data_angkatan['semester'];
  $asisten_ = $data_angkatan['Asisten'];
}
if (isset($_POST['nip'])) {
$nip = htmlspecialchars($_POST['nip']);
$week = $ambil_max['akhir'];
$poinProphesying = 1;
$masukan_data = mysqli_query($conn, "INSERT INTO `tb_ts`(`nip`,`batch`,`week`, `TS`,`asisten`) VALUES ('$nip','$angkatan','$week','$poinProphesying','$asisten_')");
if ($masukan_data){
    echo notice(5);
}
}
  $Prophesying = mysqli_query($conn, "SELECT nip, SUM(TS) as ts FROM `tb_ts` where week='$week' GROUP BY nip");
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/sb-admin-2.css">
    <script type="text/javascript" src="js/qrcodelib.js"></script>
    <script type="text/javascript" src="js/webcodecamjs.js"></script>
    <link rel="stylesheet" href="source/bootstrap.min.css">
    <script src="source/jquery.min.js"></script>
    <script src="source/popper.min.js"></script>
    <script src="source/bootstrap.min.js"></script>

    <!--<script src="datatables/jquery.dataTables.js"></script>-->
    <script src="source/jquery.dataTables.min.js"></script>
    <!--<script src="datatables/dataTables.bootstrap.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>-->
    <script src="source/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="source/dataTables.bootstrap4.min.css">
    <link rel="icon" href="data:;base64,=">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    <title>Prophesying</title>
    <script>
    $(document).ready(function(){
    
     $("button1").hide();
    });
    </script>
 
    <style media="screen">
      td { vertical-align: top 
    
    }
    
      img {
        border-radius: 50%;
        
      }
      td,th{
    font-size: 14pt;
    color:#03001C;
      }
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
  
    <table class="table" id="bodyTable">
        <tr>
        <a href="presensi.php?akt=<?= $AKT;?>" class="btn btn-danger btn-sm m-2">Back</a>
            <td style="width:65%; height:30%;">
                <center>
                    <div class="card shadow mb-4">
                
                        <div class="card-header py-3" style="background-color: #243763;">
                            <div class="spinner-grow text-danger" role="status">
                            <form action="" method="post">
                                  <input type="number"   name="nip"   autofocus  autocomplete="off"  required="" >
                                  <button1 type="submit" name="simpan" style="width: 50px; height: 37px; background: white"><i class='bx bx-scan color:white; '></i></button1>
        
                                  </form>
  <span class="sr-only">Loading...</span>
</div>
                            <h2 class="m-0 font-weight-bold text-white" id='dateToday'> </h2>
                            <!--<p id='dateToday' style="font-size:25pt"> -->
                                <script type="text/javascript">
                                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                document.getElementById("dateToday").innerHTML = new Date().toLocaleDateString('en-ID', options);
                                </script>
                            <!--</p> -->
                        </div>
                        <div class="card-body">
                            <p id='clock' style="font-size:70pt">
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

            <td style="width:40%; font-size: 14pt color:Tomato;" rowspan="2">
            </div>
                <table class="table table-striped" >
                    <thead>
                       
                        <tr>
                            <th>Name</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
               
                        function nama($nama)
                        {
                            global $conn;
                            $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM traines WHERE nip='$nama'"));
                            return $sqly['name'];
                        }  
                        $i = 1;
                            foreach ($Prophesying as $row) :
                                ?>
                        <tr>
                        <td><?= nama($row['nip']); ?></td>
                        <td><span class="badge badge-pill badge-success"><?= $row['ts']; ?></span></td>
                           
                        </tr>
                        <?php $i++; ?>
                     <?php endforeach; 
                       
                     ?>
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
        </tr>
    </table>

   























    <center><p>FTTI Absent system (ver. 1.0) - © 2023 by JerSoft</p></center>
 <ul id="log"></ul>

  </body>
</html>
<?php
function notice($type)
{
  if ($type == 2) {
    return "<audio autoplay><source src='" . '../music/beep.mp3' . "'></audio><br><audio autoplay><source src='" . 'music/voice.mp3' . "'></audio>";
  } elseif ($type == 1) {
    return "<audio autoplay><source src='" . '../music/success.wav' . "'></audio>";
  } elseif ($type == 3) {
    return "<audio autoplay><source src='" . '../music/beep.mp3' . "'></audio>";
  } elseif ($type == 4) {
    return "<audio autoplay><source src='" . '../music/Akses_ditolak.mp3' . "'></audio>";
  } elseif ($type == 5) {
    return "<audio autoplay><source src='" . '../music/Terimakasih.mp3' . "'></audio>";
  }
}
?>
<?php
include 'koneksi.php';
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');

// if (isset($_POST['cari'])){
//     $id_asisten = $_POST['keyword'];
//     $save = mysqli_query($conn,"INSERT INTO `asisten`(`nip`) VALUES ('$id_asisten')");
//     // if($save){
//     //     echo "<script type='text/javascript'>
//     //     alert('Data Berhasil Ditambahkan!');
//     //     </script>";
    
// }

if (isset($_POST['nip'])) {
    $nip = $_POST['nip'];
    $sql_traines = mysqli_query($conn, "SELECT angkatan, semester FROM `traines` WHERE nip='$nip'");
    $data_angkatan = mysqli_fetch_array($sql_traines);
    $angkatan = $data_angkatan['angkatan'];
    $smt2 = $data_angkatan['semester'];
     if($sql_traines){
    echo "<script type='text/javascript'>
    alert('Data Berhasil Ditambahkan!');
    alert('Data Berhasil Ditambahkan!');
    </script>";
  }
}












$data = mysqli_query($conn, "SELECT * FROM `schedule` where date='$hari_ini' and end_time >'$waktu_sekarang'");
$data_Schedule = mysqli_fetch_array($data);
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

  </head>


  <body>
    <script src="client.js"></script>
    <p></p>
    <form action="" method="post">
    <input type="text" name="nip"  size="30"  autofocus  autocomplete="off"  required="">
    <button type="submit" name="nip" style="width: 50px; height: 37px; background: white"><i class='bx bx-scan color:white; '></i></button>

  </form>
    <table class="table" id="bodyTable">
        <tr>
            <td style="width:35%; height:30%;">
                <center>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-primary">
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
                <center>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-primary">
                            <h2 class="m-0 font-weight-bold text-white" id='dateToday'> 
                                Scanner
                            </h2>
                            
                        </div>
                        <div class="card-body">
                            <p  class="text-dark" style="font-size:70pt">
                            <canvas></canvas>
                            </p>
                        </div>
                    </div>
                </center>
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
                        foreach ($data as $row) :
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
                                <div class="card-header py-3 bg-primary">
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
                            <div class="card-header py-3 bg-primary">
                                    <h3 class="m-0 font-weight-bold text-white">View Presence Summary</h3>
                                </div>
                                <table class="table table-striped">
                                <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Status</th>
                        </tr>
                    </thead>
                                </table>
                                <div class="card-body" style="height: 400px;overflow: scroll;">
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
                            <td><?= $data['mark']; ?></td>
                           
                            
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
























<!--------------- Alert/Information MODAL -->
<div id="alert_modal" class="modal fade">  
      <div class="modal-dialog modal-s modal-dialog-centered">  
           <div class="modal-content">  
                <div class="modal-header bg-primary text-white">  
                     <h5 class="modal-title">Information</h5> 
                     <button type="button" class="close btn-danger text-white" data-dismiss="modal">&times;</button> 
                </div>  
                <div class="modal-body" id="alert_txt_content">  
                     
                </div>  
                <!--<div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> 
                </div>  --> 
           </div>  
      </div>  
 </div> 








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

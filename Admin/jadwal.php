<?php
include '../koneksi.php';
include 'session.php';
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');
// error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['simpan'])) {
    $batch = $_POST['batch'];
    $class = $_POST['class'];
    $news = $_POST['news'];
    $pembicara = $_POST['pembicara'];
    $weekly = $_POST['weekly'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_akhir = $_POST['waktu_akhir'];
    $waktu_presensi = $_POST['waktu_presensi'];
    $waktu_akhir_presensi = $_POST['waktu_akhir_presensi'];
    $alarm = $_POST['ringtones'];
    $date = $_POST['date'];
    $pesan = $_POST['pesan'];
    $insert_data = mysqli_query($conn, "INSERT INTO `schedule`(`batch`, `week`, `id_activity`, `info`, `start_time`, `end_time`, `presensi_time`,`date`,`timer`,`nada_alarm`, `id_berita`, `id_trainer`) VALUES ('$batch','$weekly','$class','$pesan','$waktu_mulai','$waktu_akhir','$waktu_presensi','$date','$waktu_akhir_presensi','$alarm','$news','$pembicara')");
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Insert');
    window.location.href='jadwal.php';
    </script>");
}
if (isset($_POST['simpan_perubahan'])) {
    $idj = $_POST['idj'];
    $batch_ = $_POST['akt'];
    $kelas_ = $_POST['kelas_'];
    $berita_ = $_POST['berita_'];
    $pembicara_ = $_POST['pembicara_'];
    $weekly_ = $_POST['weekly_'];
    $waktu_mulai_ = $_POST['waktu_mulai_'];
    $waktu_akhir_ = $_POST['waktu_akhir_'];
    $waktu_presensi_ = $_POST['waktu_presensi_'];
    $waktu_akhir_presensi_ = $_POST['waktu_akhir_presensi_'];
    $ringtones_ = $_POST['ringtones_'];
    $date_ = $_POST['date_'];
    $pesan_ = $_POST['pesan_'];
    $insert_perubahandata = mysqli_query($conn, "UPDATE `schedule` SET `batch`='$batch_',`week`='$weekly_',`id_activity`='$kelas_',`info`='$pesan_',`start_time`='$waktu_mulai_',`end_time`='$waktu_akhir_',`presensi_time`='$waktu_presensi_',`date`='$date_',`timer`='$waktu_akhir_presensi_',`nada_alarm`='$ringtones_',`id_berita`='$berita_',`id_trainer`='$pembicara_' WHERE `id`='$idj'");
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data Changed Successfully');
    window.location.href='jadwal.php';
    </script>");
}
$data = mysqli_query($conn, "SELECT * FROM `schedule` where date='$hari_ini' and end_time >'$waktu_sekarang'");
$data_Schedule = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'head.php';
?>

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
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Presensi</h6> <br>
       <!-- Button trigger modal tambahkan asisten -->
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Tambahkan Jadwal
        </button>
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Masukan Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div>
                                                    <form action="" method="POST">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <!-- <input name="firstname" type="text" class="form-control" placeholder="Full Name">
                                                                 -->
                                                                    <div class="form-group">
                                                                        <label for="">Angkatan :</label>
                                                                        <select name="batch" class="form-control" required>
                                                                            <option value="">Pilih Angkatan</option>
                                                                            <?php
                                                                            $abl_angkatan = mysqli_query($conn, "SELECT angkatan FROM `tb_angkatan` ");
                                                                            while ($dataangkatan = mysqli_fetch_array($abl_angkatan)) { ?>
                                                                                <option value="<?= $dataangkatan['angkatan']; ?>"><?= $dataangkatan['angkatan']; ?></option>
                                                                            <?php  }

                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Kelas :</label>
                                                                    <!-- <input name="nip" type="text" class="form-control" placeholder="Nip"> -->
                                                                    <select name="class" class="form-control" required>
                                                                        <option value="">Pilih Kelas</option>
                                                                        <?php
                                                                        $kelas_ = mysqli_query($conn, "SELECT * FROM `activity` ");
                                                                        while ($datakelas = mysqli_fetch_array($kelas_)) { ?>
                                                                            <option value="<?= $datakelas['id_activity']; ?>"><?= $datakelas['items']; ?></option>
                                                                        <?php  }

                                                                        ?>
                                                                    </select>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Berita :</label>
                                                                    <select name="news" class="form-control" required>
                                                                        <option value="">Pilih Berita</option>
                                                                        <?php
                                                                        $berita = mysqli_query($conn, "SELECT * FROM `tb_daftar_berita` ");
                                                                        while ($databerita = mysqli_fetch_array($berita)) { ?>
                                                                            <option value="<?= $databerita['id_berita']; ?>"><?= $databerita['daftar_berita']; ?></option>
                                                                        <?php  }

                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Waktu Mulai :</label>
                                                                    <input name="waktu_mulai" type="time" class="form-control" placeholder="Start Time" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Waktu Mulai Presensi :</label>
                                                                    <input name="waktu_presensi" type="time" class="form-control" placeholder="waktu_presensi" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Nada Alarm :</label>
                                                                    <select name="ringtones" class="form-control">
                                                                        <option value="">Pilih Alarm</option>
                                                                        <?php
                                                                        $ringtones = mysqli_query($conn, "SELECT * FROM `ringtones` ");
                                                                        while ($dataalarm = mysqli_fetch_array($ringtones)) { ?>
                                                                            <option value="<?= $dataalarm['Ringtones']; ?>"><?= $dataalarm['Ringtones']; ?></option>
                                                                        <?php  }

                                                                        ?>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="">Minggu Ke :</label>
                                                                    <select name="weekly" class="form-control">
                                                                        <option value="">Pilih Minggu</option>
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
                                                                <div class="form-group res-mg-t-15">
                                                                    <label for="">Pembicara :</label>
                                                                    <select name="pembicara" class="form-control">
                                                                        <option value="">Pilih Pembicara</option>
                                                                        <?php
                                                                        $Trainer = mysqli_query($conn, "SELECT * FROM `trainer` ");
                                                                        while ($dataTrainer = mysqli_fetch_array($Trainer)) { ?>
                                                                            <option value="<?= $dataTrainer['id_trainer']; ?>"><?= $dataTrainer['nama_trainer']; ?></option>
                                                                        <?php  }

                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Tanggal :</label>
                                                                    <input name="date" type="date" class="form-control" placeholder="Date">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Watku Akhir :</label>
                                                                    <input name="waktu_akhir" type="time" class="form-control" placeholder="End Time">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Watku Akhir Presensi :</label>
                                                                    <input name="waktu_akhir_presensi" type="time" class="form-control" placeholder="waktu_akhir_presensi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Pesan Untuk Trainee :</label>
                                                                    <textarea name="pesan" id="" cols="4" rows="2" class="form-control"></textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress">
                                                                    <button name="simpan" type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
    </div>
  </div>
</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th data-field="id">ID</th>
                    <th>Angkatan</th>
                    <th>Pasan</th>
                    <th>Minggu</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Akhir</th>
                    <th>Waktu Presensi</th>
                    <th>Waktu Akhir Presensi</th>
                    <th data-field="action">Action</th>
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
                $i = 1;
                foreach ($data as $row) :
                ?>
                    <tr>
                      

                    <td><?= $i; ?></td>
                                                    <td><?= $row['batch'];  ?></td>
                                                    <td>
                                                        <h6 class="font-weight-bold text-success font-italic"><?= $row['info'];  ?></h6>
                                                    </td>
                                                    <td><?= $row['week'];  ?></td>
                                                    <td><?= activity($row['id_activity']);  ?><br>
                                                        <h6 class="font-weight-bold text-primary font-italic"><?= news($row['id_berita']);  ?></h6>
                                                        <br>
                                                        <h6 class="font-weight-bold text-danger font-italic"><?= trainer($row['id_trainer']);  ?></h6>
                                                    </td>
                                                    <td><?= $row['date'];  ?></td>
                                                    <td><?= $row['start_time'];  ?></td>
                                                    <td><?= $row['end_time'];  ?></td>
                                                    <td><?= $row['presensi_time'];  ?></td>
                                                    <td><?= $row['timer'];  ?></td>
                                                    <!-- <td class="datatable-ct"><i class="fa fa-check"></i>
                                                    </td> -->
                                                    <td>
                                                        <?php
                                                        if ($row['end_time'] > $waktu_sekarang) { ?>
                                                           <a id="edit" class="btn btn-warning" data-toggle="modal" data-target="#editjadwal" data-idj="<?= $row['id']; ?>" data-angkatan="<?= $row['batch']; ?>" data-info="<?= $row['info']; ?>" data-minggu="<?= $row['week']; ?>" data-starttime="<?= $row['start_time']; ?>" data-activity="<?= $row['id_activity']; ?>" data-trainer="<?= $row['id_trainer']; ?>" data-berita="<?= $row['id_berita'];?>" data-date="<?= $row['date']; ?>" data-akhirwaktu="<?= $row['end_time']; ?>" data-waktupresensi="<?= $row['presensi_time']; ?>" data-timer="<?= $row['timer']; ?>" data-nada="<?= $row['nada_alarm']; ?>">
                                                            Edit
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
                                                            <div class="modal fade" id="editjadwal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-dark" id="editjadwal">Masukan Perubahan Data</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="" method="POST">
                                                                    <div class="modal-body" id="modal-edit">
                                                                    <div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <!-- <input name="firstname" type="text" class="form-control" placeholder="Full Name">
                                                                                    -->
                                                                                        <div class="form-group">
                                                                                            <input type="hidden" id="idj" name="idj">
                                                                                            <label for="">Angkatan :</label>
                                                                                            <select id="angkatan" name="akt" class="form-control">
                                                                                                <option value="">Select Batch</option>
                                                                                                <?php
                                                                                                $abl_angkatan = mysqli_query($conn, "SELECT angkatan FROM `tb_angkatan` ");
                                                                                                while ($dataangkatan = mysqli_fetch_array($abl_angkatan)) { ?>
                                                                                                    <option value="<?= $dataangkatan['angkatan']; ?>"><?= $dataangkatan['angkatan']; ?></option>
                                                                                                <?php  }

                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Kelas :</label>
                                                                                        <!-- <input name="nip" type="text" class="form-control" placeholder="Nip"> -->
                                                                                        <select name="kelas_" id="activity" class="form-control">
                                                                                            <option value="">Pilih Kelas</option>
                                                                                            <?php
                                                                                            $kelas_ = mysqli_query($conn, "SELECT * FROM `activity` ");
                                                                                            while ($datakelas = mysqli_fetch_array($kelas_)) { ?>
                                                                                                <option value="<?= $datakelas['id_activity']; ?>"><?= $datakelas['items']; ?></option>
                                                                                            <?php  }

                                                                                            ?>
                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Berita :</label>
                                                                                        <select id="berita" name="berita_" class="form-control">
                                                                                            <option value="">Pilih Berita</option>
                                                                                            <?php
                                                                                            $berita = mysqli_query($conn, "SELECT * FROM `tb_daftar_berita` ");
                                                                                            while ($databerita = mysqli_fetch_array($berita)) { ?>
                                                                                                <option value="<?= $databerita['id_berita']; ?>"><?= $databerita['daftar_berita']; ?></option>
                                                                                            <?php  }

                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Start Time :</label>
                                                                                        <input id="starttime" name="waktu_mulai_" type="time" class="form-control" placeholder="Start Time">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Start Time Presensi :</label>
                                                                                        <input id="waktupresensi" name="waktu_presensi_" type="time" class="form-control" placeholder="waktu_presensi">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Ringtones :</label>
                                                                                        <select id="nada" name="ringtones_" class="form-control">
                                                                                            <option value="">Select Ringtones</option>
                                                                                            <?php
                                                                                            $ringtones = mysqli_query($conn, "SELECT * FROM `ringtones` ");
                                                                                            while ($dataalarm = mysqli_fetch_array($ringtones)) { ?>
                                                                                                <option value="<?= $dataalarm['Ringtones']; ?>"><?= $dataalarm['Ringtones']; ?></option>
                                                                                            <?php  }

                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label for="">Week :</label>
                                                                                        <select id="minggu" name="weekly_" class="form-control">
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
                                                                                    <div class="form-group res-mg-t-15">
                                                                                        <label for="">Speaker :</label>
                                                                                        <select id="trainer" name="pembicara_" class="form-control">
                                                                                            <option value="">Select Trainer</option>
                                                                                            <?php
                                                                                            $Trainer = mysqli_query($conn, "SELECT * FROM `trainer` ");
                                                                                            while ($dataTrainer = mysqli_fetch_array($Trainer)) { ?>
                                                                                                <option value="<?= $dataTrainer['id_trainer']; ?>"><?= $dataTrainer['nama_trainer']; ?></option>
                                                                                            <?php  }

                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Date :</label>
                                                                                        <input id="date" name="date_" type="date" class="form-control" placeholder="Date">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">End Time :</label>
                                                                                        <input id="akhirwaktu" name="waktu_akhir_" type="time" class="form-control" placeholder="End Time">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Time Out Presensi :</label>
                                                                                        <input id="timer" name="waktu_akhir_presensi_" type="time" class="form-control" placeholder="waktu_akhir_presensi">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Message :</label>
                                                                                        <textarea id="info" name="pesan_" id="" cols="4" rows="2" class="form-control"></textarea>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="payment-adress">
                                                                                        <button name="simpan_perubahan" type="submit" class="btn btn-warning waves-effect waves-light">Simpan Perubahan</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
    </div>
  </div>
                                                    </td>

                       
                    </tr>
                    
                   
                    <?php $i++; ?>
                     <?php endforeach; ?>
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

    <script>
         $(document).on("click", "#edit", function() {
      let idj = $(this).data('idj');
      let angkatan = $(this).data('angkatan');
      let activity = $(this).data('activity');
      let berita = $(this).data('berita');
      let starttime = $(this).data('starttime');
      let waktupresensi = $(this).data('waktupresensi');
      let nada = $(this).data('nada');
      let minggu = $(this).data('minggu');
      let trainer = $(this).data('trainer');
      let date = $(this).data('date');
      let akhirwaktu = $(this).data('akhirwaktu');
      let timer = $(this).data('timer');
      let info = $(this).data('info');
      $(" #modal-edit #info").val(info);
      $(" #modal-edit #timer").val(timer);
      $(" #modal-edit #akhirwaktu").val(akhirwaktu);
      $(" #modal-edit #date").val(date);
      $(" #modal-edit #trainer").val(trainer);
      $(" #modal-edit #minggu").val(minggu);
      $(" #modal-edit #nada").val(nada);
      $(" #modal-edit #waktupresensi").val(waktupresensi);
      $(" #modal-edit #starttime").val(starttime);
      $(" #modal-edit #berita").val(berita);
      $(" #modal-edit #activity").val(activity);
      $(" #modal-edit #idj").val(idj);
      $(" #modal-edit #angkatan").val(angkatan);


    });
    </script>
</body>

</html>
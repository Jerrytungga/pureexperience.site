<?php
include '../koneksi.php';
include 'session.php';
if (isset($_POST['simpandata'])){
    $id_traines = $_POST['id_traines'];
    $nm_traines = $_POST['nm_traines'];
    $angkatan = $_POST['angkatan'];
    $gender = $_POST['gender'];
    $asisten = $_POST['asisten'];
    // $semester = $_POST['semester'];
    $save = mysqli_query($conn,"INSERT INTO `traines`(`nip`, `name`,`angkatan`,`gender`,`Asisten`) VALUES ('$id_traines','$nm_traines','$angkatan','$gender','$asisten')");
    if($save){
        echo "<script type='text/javascript'>
        alert('Data Berhasil Ditambahkan!');
        </script>";
    }
}
if (isset($_POST['perubahan'])){
    $id_t = $_POST['id_t'];
    $nip_t = $_POST['nip_t'];
    $nm_trainee = $_POST['nm_trainee'];
    $angkatan = $_POST['angkatan'];
    $gender = $_POST['gender'];
    $asisten = $_POST['asisten'];
    // $semester = $_POST['semester'];
    $perubahan = mysqli_query($conn,"UPDATE `traines` SET `nip`='$nip_t',`name`='$nm_trainee',`angkatan`='$angkatan',`gender`='$gender',`Asisten`='$asisten' WHERE `idt`='$id_t'");
    if($perubahan){
        echo "<script type='text/javascript'>
        alert('Data Berhasil Di Edit!');
        </script>";
    }
}
if (isset($_POST['hapus'])){
    $traine = $_POST['idtr'];
    $hapus = mysqli_query($conn,"DELETE FROM `traines` WHERE `idt`='$traine'");
    if($hapus){
        echo "<script type='text/javascript'>
        alert('Data Berhasil Di Hapus!');
        </script>";
    }
   
}

$ambildata_traines = mysqli_query($conn,"SELECT * FROM `traines` ORDER BY idt DESC");
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
        <h6 class="m-0 font-weight-bold text-primary">Data Traines</h6> <br>
       <!-- Button trigger modal tambahkan asisten -->
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Tambahkan Trainee
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
                <form action="" method="post">

                <div>
                    <label for="id">ID :</label>
                    <input type="text" class="form-control" name="id_traines" required>
                </div>
                <div class="mt-1">
                    <label for="id">Nama :</label>
                    <input type="text" class="form-control" name="nm_traines" required>
                </div>
                <div class="mt-1">
                    <label for="id">Angkatan :</label>
                    <select name="angkatan" class="form-control" id="" required>
                        <option value="">Pilih Angkatan</option>
                        <?php
                          $tb_angkatan = mysqli_query($conn,"SELECT * FROM `tb_angkatan`");
                          while ($tp_angkatan = mysqli_fetch_array($tb_angkatan)){ ?>
                            <option  value="<?= $tp_angkatan['angkatan']?>"><?= $tp_angkatan['angkatan']?></option>
                        <?php  }
                        ?>
                    </select>
                </div>
                <div class="mt-1">
                    <label for="id">Gender :</label>
                    <select class="form-control" name="gender" id="" required>
                        <option value="">Pilih Gender</option>
                        <option value="L">L</option>
                        <option value="P">P</option>
                    </select>
                </div>
                <div class="mt-1">
                    <label for="id">Asisten :</label>
                    <select class="form-control" name="asisten" id="" required>
                        <option value="">Pilih Asisten</option>
                        <?php
                          $tb_asisten = mysqli_query($conn,"SELECT * FROM `asisten`");
                          while ($tp_asisten = mysqli_fetch_array($tb_asisten)){ ?>
                            <option  value="<?= $tp_asisten['nip']?>"><?= $tp_asisten['name']?></option>
                        <?php  }
                        ?>
                    </select>
                </div>
                <!-- <div class="mt-1">
                    <label for="id">Semester :</label>
                    <select class="form-control" name="semester" id="" required>
                        <option value="">Pilih Semester</option>
                        <?php
                          $tb_semester = mysqli_query($conn,"SELECT * FROM `tb_semester`");
                          while ($tp_semester = mysqli_fetch_array($tb_semester)){ ?>
                            <option  value="<?= $tp_semester['thn_semester']?>"><?= $tp_semester['keterangan']?></option>
                        <?php  }
                        ?>
                    </select>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" name="simpandata" class="btn btn-success">Tambahkan</button>
            </div>
            </form>
    </div>
  </div>
</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Gender</th>
                        <th>Tanggal Regis</th>
                        <th>Asisten</th>
                        <!-- <th>Semester</th> -->
                        <th>Aksi</th>
               
                    </tr>
                </thead>
               
                <tbody>
                <?php
                    //  function batch($batch)
                    //  {
                    //      global $conn;
                    //      $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_angkatan WHERE id='$batch'"));
                    //      return $sqly['angkatan'];
                    //  }
                     function semester($semester)
                     {
                         global $conn;
                         $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_semester WHERE thn_semester='$semester'"));
                         return $sqly['keterangan'];
                     }
                     function asisten($asisten)
                     {
                         global $conn;
                         $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM asisten WHERE nip='$asisten'"));
                         return $sqly['name'];
                     }
                $i = 1;
                foreach ($ambildata_traines as $row) :
                ?>
                    <tr>
                        <td><?= $row['nip']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['angkatan']; ?></td>
                        <td><?= $row['gender']; ?></td>
                        <td><?= $row['date']; ?></td>
                        <td><?= asisten($row['Asisten']); ?></td>
                        <!-- <td>
                            <?php
                                if($row['semester'] > 0){ ?>
                                    <?= semester($row['semester']); ?>
                             <?php   } else { 
                                    $row['semester'] = "";
                             }
                            ?>
                        
                        </td> -->
                        <td>
                       
                        <a id="editdata" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edittraines" data-idt="<?= $row['idt']; ?>" data-nip="<?= $row['nip']; ?>" data-batch="<?= $row['angkatan']; ?>" data-nama="<?= $row['name']; ?>" data-gender="<?= $row['gender']; ?>" data-asisten="<?= $row['Asisten']; ?>" data-semester="<?= $row['semester']; ?>">
                        Edit
                        </a>

                        <div class="modal fade" id="edittraines" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Trainee</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modal-editTraine">
                            <form action="" method="post">
                                <div>
                                    <label for="id">ID :</label>
                                    <input type="text" class="form-control" id="nip" name="nip_t" >
                                    <input type="hidden" class="form-control" id="idt" name="id_t" >
                                </div>
                                <div class="mt-1">
                                    <label for="id">Nama :</label>
                                    <input type="text" class="form-control" id="nama" name="nm_trainee" >
                                </div>
                                <div class="mt-1">
                                    <label for="id">Angkatan :</label>
                                    <select name="angkatan" class="form-control" id="batch" >
                                        <option value="">Pilih Angkatan</option>
                                        <?php
                                        $tb_angkatan = mysqli_query($conn,"SELECT * FROM `tb_angkatan`");
                                        while ($tp_angkatan = mysqli_fetch_array($tb_angkatan)){ ?>
                                            <option  value="<?= $tp_angkatan['angkatan']?>"><?= $tp_angkatan['angkatan']?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                                <div class="mt-1">
                                    <label for="id">Gender :</label>
                                    <select class="form-control" name="gender" id="gender" >
                                        <option value="">Pilih Gender</option>
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                </div>
                                <div class="mt-1">
                                    <label for="id">Asisten :</label>
                                    <select class="form-control" name="asisten" id="asisten" >
                                        <option value="">Pilih Asisten</option>
                                        <?php
                                        $tb_asisten = mysqli_query($conn,"SELECT * FROM `asisten`");
                                        while ($tp_asisten = mysqli_fetch_array($tb_asisten)){ ?>
                                            <option  value="<?= $tp_asisten['nip']?>"><?= $tp_asisten['name']?></option>
                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                                <!-- <div class="mt-1">
                    <label for="id">Semester :</label>
                    <select class="form-control" name="semester" id="semester">
                        <option value="">Pilih Semester</option>
                        <?php
                          $tb_semester = mysqli_query($conn,"SELECT * FROM `tb_semester`");
                          while ($tp_semester = mysqli_fetch_array($tb_semester)){ ?>
                            <option  value="<?= $tp_semester['thn_semester']?>"><?= $tp_semester['keterangan']?></option>
                        <?php  }
                        ?>
                    </select>
                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" name="perubahan" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>

                        <form action="" method="post">
                                    <input type="hidden" name="idtr" value="<?= $row["idt"]; ?>">
                                    <button type="submit" name="hapus" onclick="return confirm('Yakin Hapus?')" class="btn btn-sm mt-1 btn-danger">Hapus</button>
                                </form>
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
         $(document).on("click", "#editdata", function() {
      let nip = $(this).data('nip');
      let idt = $(this).data('idt');
      let batch = $(this).data('batch');
      let nama = $(this).data('nama');
      let gender = $(this).data('gender');
      let asisten = $(this).data('asisten');
    //   let semester = $(this).data('semester');
     
      $(" #modal-editTraine #nip").val(nip);
      $(" #modal-editTraine #idt").val(idt);
      $(" #modal-editTraine #batch").val(batch);
      $(" #modal-editTraine #nama").val(nama);
      $(" #modal-editTraine #gender").val(gender);
      $(" #modal-editTraine #asisten").val(asisten);
    //   $(" #modal-editTraine #semester").val(semester);
  

    });
    </script>
</body>

</html>
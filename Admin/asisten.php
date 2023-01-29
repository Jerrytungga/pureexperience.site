<?php
include '../koneksi.php';
include 'session.php';
if (isset($_POST['simpandata'])){
    $id_asisten = $_POST['id_asisten'];
    $nm_asisten = $_POST['nm_asisten'];
    $user_asisten = $_POST['user_asisten'];
    $psw_asisten = $_POST['psw_asisten'];
    $save = mysqli_query($conn,"INSERT INTO `asisten`(`nip`,`name`,`username`, `password`) VALUES ('$id_asisten','$nm_asisten','$user_asisten','$psw_asisten')");
}
if (isset($_POST['btn_edit_asisten'])){
    $Eid_ = $_POST['Eid_'];
    $Eid_asisten = $_POST['Eid_asisten'];
    $Enm_asisten = $_POST['Enm_asisten'];
    $Euser_asisten = $_POST['Euser_asisten'];
    $Epsw_asisten = $_POST['Epsw_asisten'];
    $save = mysqli_query($conn,"UPDATE `asisten` SET `nip`='$Eid_asisten',`name`='$Enm_asisten',`username`='$Euser_asisten',`password`='$Epsw_asisten'WHERE `id_as`='$Eid_'");
}
if (isset($_POST['tidakaktif'])){
    $Ei_ = $_POST['ids'];
    $sts = $_POST['tidakaktif'];
    $save = mysqli_query($conn,"UPDATE `asisten` SET `status` = '$sts' WHERE `asisten`.`id_as` ='$Ei_'");
}
if (isset($_POST['aktifkan'])){
    $Ei_ = $_POST['ids'];
    $sts = $_POST['aktifkan'];
    $save = mysqli_query($conn,"UPDATE `asisten` SET `status` = '$sts' WHERE `asisten`.`id_as` ='$Ei_'");
}
$ambildata_asisten = mysqli_query($conn,"SELECT * FROM `asisten`");
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
        <h6 class="m-0 font-weight-bold text-primary">Data Asisten</h6> <br>
       <!-- Button trigger modal tambahkan asisten -->
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Tambahkan Asisten
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
                    <input type="text" class="form-control" name="id_asisten">
                </div>
                <div class="mt-1">
                    <label for="id">Nama :</label>
                    <input type="text" class="form-control" name="nm_asisten">
                </div>
                <div class="mt-1">
                    <label for="id">Username :</label>
                    <input type="text" class="form-control" name="user_asisten">
                </div>
                <div class="mt-1">
                    <label for="id">Password :</label>
                    <input type="text" class="form-control" name="psw_asisten">
                </div>
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
                        <th>Nama</th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Tanggal Regis</th>
                        <th>Aksi</th>
               
                    </tr>
                </thead>
               
                <tbody>
                <?php
                $i = 1;
                foreach ($ambildata_asisten as $row) :
                ?>
                    <tr>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['nip']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['password']; ?></td>
                        <td><?= $row['date']; ?></td>
                        <td>
                            <a id="editasisten"  type="button" class="btn btn-sm m-1 btn-warning" data-toggle="modal" data-target="#Edit" data-ids="<?= $row["id_as"]; ?>" data-id="<?= $row["nip"]; ?>" data-nama="<?= $row["name"]; ?>" data-username="<?= $row["username"]; ?>" data-password="<?= $row["password"]; ?>">
                            Edit
                            </a>

                            <?php
                            if ($row['status'] == "Aktif" ) { ?>
                                <form action="" method="post">
                                    <input type="hidden" name="ids" value="<?= $row["id_as"]; ?>">
                                    <button type="submit" class="btn btn-sm m-1 btn-danger" name="tidakaktif" value="Tidak Aktif" >Tidak Aktif</button>
                                </form>
                                <?php
                            } elseif ($row['status'] == "Tidak Aktif"){ ?>
                                <form action="" method="post">
                                    <input type="hidden" name="ids" value="<?= $row["id_as"]; ?>">
                                    <button type="submit" name="aktifkan" value="Aktif" class="btn btn-sm m-1 btn-success">Aktifkan</button>
                                </form>


                            <?php

                            }
                            ?>

                            <!-- Modal -->
                            <div class="modal fade" id="Edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Asisten</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="">
                                <div class="modal-body" id="modal-edit">
                                    <input type="hidden" class="form-control" id="ids" name="Eid_">
                                <div>
                                    <label for="id">ID :</label>
                                    <input type="text" class="form-control" id="id" name="Eid_asisten">
                                </div>
                                <div class="mt-1">
                                    <label for="id">Nama :</label>
                                    <input type="text" class="form-control" id="nama" name="Enm_asisten">
                                </div>
                                <div class="mt-1">
                                    <label for="id">Username :</label>
                                    <input type="text" class="form-control" id="username" name="Euser_asisten">
                                </div>
                                <div class="mt-1">
                                    <label for="id">Password :</label>
                                    <input type="text" class="form-control" id="password" name="Epsw_asisten">
                                </div>
                             
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="btn_edit_asisten" id="btn_edit_punishment" class="btn btn-warning">Simpan Perubahan</button>
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
         $(document).on("click", "#editasisten", function() {
      let id = $(this).data('id');
      let nama = $(this).data('nama');
      let username = $(this).data('username');
      let password = $(this).data('password');
      let ids = $(this).data('ids');
      $(" #modal-edit #id").val(id);
      $(" #modal-edit #nama").val(nama);
      $(" #modal-edit #username").val(username);
      $(" #modal-edit #password").val(password);
      $(" #modal-edit #ids").val(ids);

    });
    </script>
</body>

</html>
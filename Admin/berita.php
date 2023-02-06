<?php
include '../koneksi.php';
include 'session.php';
if (isset($_POST['simpandata'])){
    $items = $_POST['aktifitas'];
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_berita`) As id FROM `tb_daftar_berita`"));
    $idbr = $max['id'] + 1;
    $dataactivity = mysqli_query($conn, "INSERT INTO `tb_daftar_berita`(`id_berita`,`daftar_berita`) VALUES ('$idbr','$items')");
}
if (isset($_POST['editkegiatan'])){
    $activ_ =  $_POST['nama_'];
    $id_ =  $_POST['id_'];
    $menu = mysqli_query($conn, "UPDATE `tb_daftar_berita` SET `daftar_berita` = '$activ_' WHERE `tb_daftar_berita`.`id_berita` = '$id_'");
}

$ambildata_berita = mysqli_query($conn,"SELECT * FROM `tb_daftar_berita` ORDER BY id_berita DESC");
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
        <h6 class="m-0 font-weight-bold text-primary">Data Berita</h6> <br>
       <!-- Button trigger modal tambahkan asisten -->
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Tambahkan Berita
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
                <div class="mt-1">
                    <label for="id">Nama Berita :</label>
                    <input type="text" class="form-control" name="aktifitas">
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
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
               
                <tbody>
                <?php
                $i = 1;
                foreach ($ambildata_berita as $row) :
                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['daftar_berita']; ?></td>
                        <td>
                            <a id="edit"  type="button" class="btn btn-sm m-1 btn-warning" data-toggle="modal" data-target="#Edit" data-id="<?= $row['id_berita']; ?>" data-nama="<?= $row['daftar_berita']; ?>">
                            Edit
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="Edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Berita</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="">
                                <div class="modal-body" id="modal-edit">
                                    <input type="hidden" class="form-control" id="id" name="id_">
                                <div>
                                    <label for="id">Nama Berita :</label>
                                    <input type="text" class="form-control" id="nama" name="nama_">
                                </div>
                            
                             
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="editkegiatan" class="btn btn-warning">Simpan Perubahan</button>
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
      let id = $(this).data('id');
      let nama = $(this).data('nama');
      $(" #modal-edit #id").val(id);
      $(" #modal-edit #nama").val(nama);


    });
    </script>
</body>

</html>
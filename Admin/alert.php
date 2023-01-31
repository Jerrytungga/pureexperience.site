  <?php if (isset($notifsukses)) { ?>
    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'success',
        title: '<?php echo $notifsukses; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>

    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($notif);
  } else if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo $notifgagal; ?>',

      })
    </script>

  <?php
  } else if (isset($notifsuksesedit)) { ?>
    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'success',
        title: '<?php echo $notifsuksesedit; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>

  <?php  } else if (isset($notifgagaledit)) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo $notifgagaledit; ?>',

      })
    </script>
  <?php
  } else if (isset($notifdelete)) { ?>

    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'success',
        title: '<?php echo $notifdelete; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>

  <?php } else if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo $notifgagal; ?>',

      })
    </script>

  <?php } else if (isset($pesan)) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: '<?php echo $pesan; ?>',
        html: '<p class=" text-uppercase"><b>Waktu Akhir <?= $_POST['waktu_akhir'] ?></b><br><br>Mohon Maaf <br>Waktu Akhir Harus Lebih Besar Dari <br>Waktu Mulai <?= $_POST['waktu_mulai'] ?></p>',
      })
    </script>
  <?php }
  if (isset($pesan_presensi)) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: '<?php echo $pesan_presensi; ?>',
        html: '<p class=" text-uppercase"><b>Waktu Presensi <?= $_POST['waktu_presensi'] ?></b><br><br>Mohon Maaf <br>Waktu Presensi Harus Lebih Kecil Dari <br>Waktu Mulai <?= $_POST['waktu_mulai'] ?> <br> Atau Sama Dengan Waktu Mulai</p>',
      })
    </script>
  <?php }
  if (isset($waktu_timer)) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: '<?php echo $waktu_timer; ?>',
        html: '<p class=" text-uppercase"><b>Waktu Timer <?= $_POST['waktu_akhir_presensi'] ?></b><br><br>Mohon Maaf <br>Waktu Timer Harus Lebih Besar Dari <br>Waktu Presensi <?= $_POST['waktu_presensi'] ?>',
      })
    </script>
  <?php } ?>
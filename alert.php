  <?php

  if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: '<?php echo $notifgagal; ?>',

      })
    </script>

  <?php unset($notifgagal);
  } elseif (isset($cekdata)) {
  ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: '<p class="text-danger"><strong>PERINGATAN!</strong></p>',
        html: '<p class=" text-uppercase"><b><?= name($_POST['nis']) ?></b><br><br> Telah melakukan presensi sebelumnya</p>',
        footer: '<?php echo $cekdata; ?>'
      })
    </script>
  <?php  } elseif (isset($Announcement)) { ?>

    <script>
      Swal.fire({
        icon: 'warning',
        title: '<p class="text-danger"><strong>ANNOUNCEMENT!</strong></p>',
        html: '<?php echo $Announcement; ?>'
      })
    </script>
  <?php unset($Announcement);
  }
  ?>
<?php
session_start();
if (!isset($_SESSION['id'])) {
  echo "<script type='text/javascript'>
  alert('Anda harus login terlebih dahulu!');
  window.location = '../login.php'
</script>";
} else {
  $id = $_SESSION['id'];
  $get_data = mysqli_query($conn, "SELECT * FROM asisten WHERE nip='$id'");
  $data = mysqli_fetch_array($get_data);
}

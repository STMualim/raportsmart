<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'function.php';
$user = $_SESSION["logged_in_user"];
$namauser = $_SESSION["logged_in_nama"];

$nis= $_GET["nis"];
// var_dump($nis);die;
if (hapus_siswa($nis) > 0) {
    echo "<script>
            alert('Data BERHASIL dihapus !');
            document.location.href = 'data_siswa.php';
          </script>";
} else {
    echo "<script>
            alert('Data GAGAL dihapus !');
            document.location.href = 'data_siswa.php';
          </script>";
}
?>
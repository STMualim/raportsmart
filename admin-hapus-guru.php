<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'function.php';
$user = $_SESSION["logged_in_user"];
$namauser = $_SESSION["logged_in_nama"];

$nip= $_GET["nip"];
// var_dump($nis);die;
if (hapus_guru($nip) > 0) {
    echo "<script>
            alert('Data BERHASIL dihapus !');
            document.location.href = 'data_guru.php';
          </script>";
} else {
    echo "<script>
            alert('Data GAGAL dihapus !');
            document.location.href = 'data_guru.php';
          </script>";
}
?>
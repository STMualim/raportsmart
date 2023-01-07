<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "smart-rapor";

$koneksi = mysqli_connect($server, $user, $pass, $database);

if (!$koneksi) {
  die("<script>alert('Gagal tersambung dengan database.')</script>");
}

// proses mengambil tiap isi di database
function query($query) {
  global $koneksi;

  //penyimpanan
  $result = mysqli_query($koneksi, $query);
  //menyiapkan data kosong
  $rows = [];

  // Proses memasukkan tiap isi kedalam $rows
  while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function input_nilai($data) {
  global $koneksi;
  // ambil data tiap elemen
  $nis = $data["nis"];
  $nama_siswa = $data["nama_siswa"];
  $semester = $data["semester"];
  $mtk = $data["mtk"];
  $b_indo = $data["b_indo"];
  $b_inggris = $data["b_inggris"];
  $ipa = $data["ipa"];
  $ips = $data["ips"];

  //query insert data
  $query = "INSERT INTO nilai VALUES ('', '$nis', '$nama_siswa', '$semester', '$mtk', '$b_indo', '$b_inggris', '$ipa', '$ips')";
  mysqli_query($koneksi, $query);
  //mengembalikan nilai apakah ada perubahan atau tidak
  return mysqli_affected_rows($koneksi);
}

//============================= function CRUD siswa ==================================
function tambah_siswa($data) {
  global $koneksi;
  // ambil data tiap elemen
  $nis = $data["nis"];
  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $kelas = $data["kelas"];
  $kelamin = $data["kelamin"];
  $alamat = $data["alamat"];

  //query insert data
  $query = "INSERT INTO siswa VALUES ('$nis', '$username', '$password', '$nama', '$kelas', '$kelamin', '$alamat')";
  mysqli_query($koneksi, $query);
  //mengembalikan nilai apakah ada perubahan atau tidak
  return mysqli_affected_rows($koneksi);
}

function edit_siswa($data) {
  global $koneksi;
  // ambil data tiap elemen
  $nis = $data["nis"];
  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $kelas = $data["kelas"];
  $kelamin = $data["kelamin"];
  $alamat = $data["alamat"];
  
  //query update data
  $query = "UPDATE siswa SET username = '$username', password = '$password', nama = '$nama', kelas = '$kelas', kelamin = '$kelamin', alamat = '$alamat' WHERE nis = '$nis'";

  // proses ke database
  mysqli_query($koneksi, $query);
  //mengembalikan nilai apakah ada perubahan atau tidak
  return mysqli_affected_rows($koneksi);
}

function hapus_siswa($id) {
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM siswa WHERE nis=$id");
  //mengembalikan nilai apakah ada perubahan atau tidak
  return mysqli_affected_rows($koneksi);
}
//============================= function CRUD siswa ==================================

//============================= function CRUD guru ==================================
function tambah_guru($data) {
  global $koneksi;
  // ambil data tiap elemen
  $nip = $data["nip"];
  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $wali_kelas = $data["wali_kelas"];
  $alamat = $data["alamat"];
  $no_telp = $data["no_telp"];

  //query insert data
  $query = "INSERT INTO guru VALUES ('$nip', '$username', '$password', '$nama', '$wali_kelas', '$alamat', '$no_telp')";
  mysqli_query($koneksi, $query);
  //mengembalikan nilai apakah ada perubahan atau tidak
  return mysqli_affected_rows($koneksi);
}

function edit_guru($data) {
  global $koneksi;
  // ambil data tiap elemen
  $nip = $data["nip"];
  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $wali_kelas = $data["wali_kelas"];
  $alamat = $data["alamat"];
  $no_telp = $data["no_telp"];
  
  //query update data
  $query = "UPDATE guru SET username = '$username', password = '$password', nama = '$nama', wali_kelas = '$wali_kelas', alamat = '$alamat', no_telp = '$no_telp' WHERE nip = '$nip'";

  // proses ke database
  mysqli_query($koneksi, $query);
  //mengembalikan nilai apakah ada perubahan atau tidak
  return mysqli_affected_rows($koneksi);
}

function hapus_guru($id) {
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM guru WHERE nip=$id");
  //mengembalikan nilai apakah ada perubahan atau tidak
  return mysqli_affected_rows($koneksi);
}
//============================= function CRUD guru ==================================
?>
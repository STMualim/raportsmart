<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'function.php';
$user = $_SESSION["logged_in_user"];
$namauser = $_SESSION["logged_in_nama"];

//ambil id
$nis = $_GET["nis"];
$data_siswa = query("SELECT * FROM siswa WHERE nis=$nis");

// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
  //cek apakah data berhasil ditambahkan
  if (edit_siswa($_POST) > 0) {
    echo "<script>
            alert('Data berhasil diupdate')
            document.location.href = 'admin-data-siswa.php';
          </script>
    ";
  } else {
    echo "<script>
            alert('Data gagal diupdate')
            document.location.href = 'admin-data-siswa.php';
          </script>
    ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Update Siswa | Smart-Rapor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Smart-Rapor</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/admin.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $namauser?></span>
          </a>
          <!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $namauser?></h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="admin-profil.php">
                <i class="bi bi-person"></i>
                <span>Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- End Profile Nav -->
      </ul>
    </nav>
  </header>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard Admin</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " data-bs-target="#siswa-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window"></i><span>Data Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="siswa-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="admin-data-siswa.php" class="active">
              <i class="bi bi-circle"></i><span>Lihat Data</span>
            </a>
          </li>
          <li>
            <a href="admin-tambah-siswa.php">
              <i class="bi bi-circle"></i><span>Tambah Data</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#guru-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Data Guru</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="guru-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="admin-data-guru.php">
              <i class="bi bi-circle"></i><span>Lihat Data</span>
            </a>
          </li>
          <li>
            <a href="admin-tambah-guru.php">
              <i class="bi bi-circle"></i><span>Tambah Data</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-jadwal.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Jadwal Pelajaran</span>
        </a>
      </li>

      <li class="nav-heading">Account Settings</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-profil.php">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-right"></i>
          <span>Sign Out</span>
        </a>
      </li>
    </ul>
  </aside>
  <!-- End Sidebar-->

  <!-- ======= Main ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Data Siswa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Data Siswa</li>
          <li class="breadcrumb-item active">Edit Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Data Siswa</h5>

              <?php
              // echo $data_siswa;
              foreach ($data_siswa as $row):
              ?>
              
              <!-- Form tambah data-->
              <form class="row g-3" method="POST">
                <div class="col-md-12">
                  <label for="nis" class="form-label">Nomor Induk Siswa</label>
                  <input type="text" class="form-control" name="nis" id="nis" value="<?= $row['nis']?>">
                </div>
                <div class="col-md-6">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username" value="<?= $row['username']?>">
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" value="<?= $row['password']?>">
                </div>
                <div class="col-12 ">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" id="nama" value="<?= $row['nama']?>">
                </div>
                <div class="col-md-6">
                  <label for="kelas" class="form-label">Jurusan</label>
                  <select name="kelas" id="kelas" class="form-select" value="<?= $row['kelas']?>">
                    <option <?php if ($row['kelas'] == "X Multimedia") echo "selected"; ?> value="X Multimedia">X Multimedia</option>
                    <option <?php if ($row['kelas'] == "XI Multimedia") echo "selected"; ?> value="XI Multimedia">XI Multimedia</option>
                    <option <?php if ($row['kelas'] == "XII Multimedia") echo "selected"; ?> value="XII Multimedia">XII Multimedia</option>
                    <option <?php if ($row['kelas'] == "X Teknik Komputer & Jaringan") echo "selected"; ?> value="X Teknik Komputer & Jaringan">X Teknik Komputer & Jaringan</option>
                    <option <?php if ($row['kelas'] == "XI Teknik Komputer & Jaringan") echo "selected"; ?> value="XI Teknik Komputer & Jaringan">XI Teknik Komputer & Jaringan</option>
                    <option <?php if ($row['kelas'] == "XII Teknik Komputer & Jaringan") echo "selected"; ?> value="XII Teknik Komputer & Jaringan">XII Teknik Komputer & Jaringan</option>
                    <option <?php if ($row['kelas'] == "X Teknik Gambar Bangunan") echo "selected"; ?> value="X Teknik Gambar Bangunan">X Teknik Gambar Bangunan</option>
                    <option <?php if ($row['kelas'] == "XI Teknik Gambar Bangunan") echo "selected"; ?> value="XI Teknik Gambar Bangunan">XI Teknik Gambar Bangunan</option>
                    <option <?php if ($row['kelas'] == "XII Teknik Gambar Bangunan") echo "selected"; ?> value="XII Teknik Gambar Bangunan">XII Teknik Gambar Bangunan</option>
                    <option <?php if ($row['kelas'] == "X Teknik Sepeda Motor") echo "selected"; ?> value="X Teknik Sepeda Motor">X Teknik Sepeda Motor</option>
                    <option <?php if ($row['kelas'] == "XI Teknik Sepeda Motor") echo "selected"; ?> value="XI Teknik Sepeda Motor">XI Teknik Sepeda Motor</option>
                    <option <?php if ($row['kelas'] == "XII Teknik Sepeda Motor") echo "selected"; ?> value="XII Teknik Sepeda Motor">XII Teknik Sepeda Motor</option>
                    <option <?php if ($row['kelas'] == "X Teknik Kendaraan Ringan") echo "selected"; ?> value="X Teknik Kendaraan Ringan">X Teknik Kendaraan Ringan</option>
                    <option <?php if ($row['kelas'] == "XI Teknik Kendaraan Ringan") echo "selected"; ?> value="XI Teknik Kendaraan Ringan">XI Teknik Kendaraan Ringan</option>
                    <option <?php if ($row['kelas'] == "XII Teknik Kendaraan Ringan") echo "selected"; ?> value="XII Teknik Kendaraan Ringan">XII Teknik Kendaraan Ringan</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="kelamin" id="kelamin" class="form-select" value="<?= $row['kelamin']?>">
                    <option <?php if ($row['kelamin'] == "Laki-Laki") echo "selected"; ?> value="Laki-Laki">Laki-Laki</option>
                    <option <?php if ($row['kelamin'] == "Perempuan") echo "selected"; ?> value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="col-12">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $row['alamat']?>">
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Update</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>

              <?php endforeach; ?>
              <!-- End Multi Columns Form -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SMKN 1 Mojokerto</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>
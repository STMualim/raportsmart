<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'function.php';
$user = $_SESSION["logged_in_user"];
$namauser = $_SESSION["logged_in_nama"];

$ambil_data = query("SELECT * FROM siswa");

// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
  //cek apakah data berhasil ditambahkan
  if (input_nilai($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan')
            document.location.href = 'guru-nilai.php';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal ditambahkan')
            document.location.href = 'guru-nilai.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Input Nilai | Smart-Rapor</title>
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
            <img src="assets/img/guru.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $namauser?></span>
          </a>
          <!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $namauser?></h6>
              <span>Guru</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="guru-profil.php">
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
        <a class="nav-link collapsed" href="guru-dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard Guru</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="guru-nilai.php">
          <i class="bi bi-journal-text"></i>
          <span>Input Nilai</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="guru-jadwal.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Jadwal Pelajaran</span>
        </a>
      </li>

      <li class="nav-heading">Account Settings</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="guru-profil.php">
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
      <h1>Input Nilai</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active">Input Nilai</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Input Nilai Siswa</h5>

              <!-- Form tambah data-->
              <form class="row g-3" method="POST">
                <div class="col-md-6">
                  <label for="nis" class="form-label">Nomor Induk Siswa</label>
                  <select name="nis" id="nis" class="form-select">
                    <?php foreach ($ambil_data as $row) : ?>
                      <option value="<?= $row['nis'] ?>"><?= $row['nis'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="nama_siswa" class="form-label">Nama Siswa</label>
                  <select name="nama_siswa" id="nama_siswa" class="form-select">
                    <?php foreach ($ambil_data as $row) : ?>
                      <option value="<?= $row['nama'] ?>"><?= $row['nama'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <label for="semester" class="form-label">Semester</label>
                  <select name="semester" id="semester" class="form-select">
                    <option value="Ganjil 2019/2020">Ganjil 2019/2020</option>
                    <option value="Genap 2019/2020">Genap 2019/2020</option>
                    <option value="Ganjil 2020/2021">Ganjil 2020/2021</option>
                    <option value="Genap 2020/2021">Genap 2020/2021</option>
                    <option value="Ganjil 2021/2022">Ganjil 2021/2022</option>
                    <option value="Genap 2021/2022">Genap 2021/2022</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="mtk" class="form-label">Matematika</label>
                  <input type="number" class="form-control" name="mtk" id="mtk">
                </div>
                <div class="col-md-4">
                  <label for="b_indo" class="form-label">Bahasa Indonesia</label>
                  <input type="number" class="form-control" name="b_indo" id="b_indo">
                </div>
                <div class="col-md-4">
                  <label for="b_inggris" class="form-label">Bahasa Inggris</label>
                  <input type="number" class="form-control" name="b_inggris" id="b_inggris">
                </div>
                <div class="col-md-6">
                  <label for="ipa" class="form-label">Ilmu Pengetahuan Alam</label>
                  <input type="number" class="form-control" name="ipa" id="ipa">
                </div>
                <div class="col-md-6">
                  <label for="ips" class="form-label">Ilmu Pengetahuan Sosial</label>
                  <input type="number" class="form-control" name="ips" id="ips">
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
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
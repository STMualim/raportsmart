<?php
session_start();

require 'function.php';
if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  //cek username ada di database apa tidak
  $log_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
  $log_guru = mysqli_query($koneksi, "SELECT * FROM guru WHERE username='$username'");
  $log_siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE username='$username'");

  // jika admin yang masuk
  if (mysqli_num_rows($log_admin) === 1 ) {
    //cek password
    $row = mysqli_fetch_assoc($log_admin);
    if ($password === $row["password"]) {
      //set session
      $_SESSION["login"] = true;
      $_SESSION["logged_in_user"] = $row["id_admin"];
      $_SESSION["logged_in_nama"] = $row["nama"];
      header("Location: admin-dashboard.php");
      exit;
    }
  // jika guru masuk
  } else if (mysqli_num_rows($log_guru) === 1 ) {
    //cek password
    $row = mysqli_fetch_assoc($log_guru);
    if ($password === $row["password"]) {
      //set session
      $_SESSION["login"] = true;
      $_SESSION["logged_in_user"] = $row["nip"];
      $_SESSION["logged_in_nama"] = $row["nama"];
      header("Location: guru-dashboard.php");
      exit;
    }
  // jika siswa masuk
  } else if (mysqli_num_rows($log_siswa) === 1 ) {
    //cek password
    $row = mysqli_fetch_assoc($log_siswa);
    if ($password === $row["password"]) {
      //set session
      $_SESSION["login"] = true;
      $_SESSION["logged_in_user"] = $row["nis"];
      $_SESSION["logged_in_nama"] = $row["nama"];
      header("Location: siswa-dashboard.php");
      exit;
    }
  }
  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login | Smart-Rapor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

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
    <?php if (isset($error)) :?>
      <script>
        swal("Gagal Login", "Password atau Username yang anda masukkan salah!", "error");
      </script>
    <?php endif; ?>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Smart-Rapor</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                  </div>

                  <form action="" method="POST" class="row g-3 needs-validation">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input class="form-control" type="text" name="username" id="username" required>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input class="form-control" type="password" name="password" id="password" required>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" value="true">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="login" type="login">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
  <!-- End #main -->

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
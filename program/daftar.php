<?php
session_start();
include "component/koneksi.php";
$pesannama = "";
$pesanuser = "";
$pesanpass = "";
$pesan = "";

if (isset($_POST['daftar'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($nama) && empty($username) && empty($password)) {
    $pesan = "Nama, Username, dan password tidak boleh kosong";
  } elseif (empty($nama) && empty($username)) {
    $pesannama = "Nama harus diisi";
    $pesanuser = "Username harus diisi";
  } elseif (empty($nama) && empty($password)) {
    $pesannama = "Nama harus diisi";
    $pesanpass = "Password harus diisi";
  } elseif (empty($username) && empty($password)) {
    $pesanuser = "Username harus diisi";
    $pesanpass = "Password harus diisi";
  } elseif (empty($nama)) {
    $pesannama = "Nama harus diisi";
  } elseif (empty($username)) {
    $pesanuser = "Username harus diisi";
  } elseif (empty($password)) {
    $pesanpass = "Password harus diisi";
  } else {
    // Periksa apakah username sudah ada di database
    $check_query = "SELECT * FROM tb_login WHERE username = '$username'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
      $pesan = "Username sudah ada. Silakan pilih username lain.";
    } else {
      // Jika username belum ada, lakukan pendaftaran
      $data = "INSERT INTO tb_login (nama, username, password, level) VALUES ('$nama', '$username', '$password','User')";
      $hasil = mysqli_query($koneksi, $data);
      if ($hasil) {
        header("location:login.php");
      } else {
        echo "Pendaftaran gagal.";
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Academix</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/img/stt/logo.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <img src="assets/img/stt/logo.png" width=150px>
              <a href="index.php" class="app-brand-link gap-2">
              </a>
            </div>
            <!-- /Logo -->
            <h1 class="mb-4 text-center">AcademiX</h1>

            <form id="formAuthentication" class="mb-3" action="" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Nama User</label>
                <input type="text" class="form-control" id="email" name="nama" placeholder="Masukkan nama anda"
                  autofocus />
                <p class="text-danger">
                  <?php echo $pesannama; ?>
                </p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" class="form-control" id="email" name="username" placeholder="Masukkan username anda"
                  autofocus />
                <p class="text-danger">
                  <?php echo $pesanuser; ?>
                </p>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                <p class="text-danger">
                  <?php echo $pesanpass; ?>
                </p>
              </div>
              <div class="mb-3">
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" name="daftar" type="submit">Daftar</button>
                <p class="text-center" style="color: red;">
                  <?php echo $pesan; ?>
                </p>
              </div>
            </form>
            <p class="text-center">
              <a href="login.php">
                <span>Sudah Punya Akun</span>
              </a>
            </p>


          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
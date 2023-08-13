<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Digilib SMPIT Nurh Hidayah</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/dist/css/adminlte.min.css">
  <style media="screen">
    body {
      background-color: #ffffff;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='152' height='152' viewBox='0 0 152 152'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='temple' fill='%23dedce1' fill-opacity='0.49'%3E%3Cpath d='M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
  </style>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-success">
      <div class="card-header text-center">
        <div class="h2">Perpustakaan</div>
        <a href="<?= site_url(); ?>" class="h2"><b>SMPIT</b> Nur Hidayah</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Silahkan login untuk memulai!</p>
        <?= $this->session->flashdata('login'); ?>
        <form action="<?= site_url('login/auth'); ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-success">
                <input type="checkbox" id="remember" onclick="tampilkan_password()">
                <label for="remember">
                  Tampilkan Password
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-success btn-block">Login</button>
            </div>
          </div>
        </form>
        <p class="mb-1 mt-4">
          <a href="#" class="text-danger" onclick="lupa_password()">Saya lupa password!</a>
        </p>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-md-12">Kembali ke halaman <a href="<?php echo site_url(); ?>"><i class="fas fa-home"></i> Beranda</a></div>
  </div>
  <script src="<?= base_url('assets/admin') ?>/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/admin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/admin') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url('assets/admin') ?>/dist/js/adminlte.min.js"></script>
  <script type="text/javascript">
  function tampilkan_password(){
    var show_password = document.getElementById("remember");

      if (show_password.checked == true){
        document.getElementById("password").setAttribute('type', 'text');
      } else {
        document.getElementById("password").setAttribute('type', 'password');
      }
  }

  function lupa_password() {
    Swal.fire(
      'Perhatian!',
      'Jika Anda lupa username atau password, <br />silahkan hubungi <strong>Petugas Perpustakaan!</strong>.',
      'warning',
      );
  }

  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Digilib SMPIT Nurh Hidayah</title>
  <meta name="robots" content="noindex">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Data Tables -->
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/dist/css/adminlte.min.css">
  <style media="screen">
    .content-wrapper {
      background-color: #f4f6f9;
      background-attachment: fixed;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 48 48'%3E%3Cg fill='%23d2d2d2' fill-opacity='0.4'%3E%3Cpath d='M12 0h18v6h6v6h6v18h-6v6h-6v6H12v-6H6v-6H0V12h6V6h6V0zm12 6h-6v6h-6v6H6v6h6v6h6v6h6v-6h6v-6h6v-6h-6v-6h-6V6zm-6 12h6v6h-6v-6zm24 24h6v6h-6v-6z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
    }
  </style>
</head>
<body class="hold-transition layout-navbar-fixed layout-top-nav layout-footer-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white pt-3 pb-3">
    <div class="container">
      <a href="<?php echo site_url(); ?>" class="navbar-brand">
        <img src="<?php echo base_url('assets/admin/images/default/logo.jpg'); ?>" alt="Digilib SMPIT Nurh Hidayah" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Digilib SMPIT Nurh Hidayah</span>
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
          <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'kunjungan') $kunjungan = 'active'; ?>
        <?php if ($this->uri->segment(1) == 'katalog') $katalog = 'active'; ?>
        <li class="nav-item">
            <a href="<?php echo site_url('kunjungan'); ?>" class="nav-link <?php if(isset($kunjungan)) { echo $kunjungan; } ?>"><i class="fas fa-atlas"></i> Kunjungan</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('katalog'); ?>" class="nav-link <?php if(isset($katalog)) { echo $katalog; } ?>"><i class="fas fa-book"></i> Katalog</a>
          </li>
        
        </ul>
      </div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('login'); ?>"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php isset($main) ? $this->load->view($main) : ''; ?>
  <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#"><?php if (function_exists('customer')) { echo customer()['aplikasi']; }?> <?php if (function_exists('customer')) { echo customer()['nama']; }?></a></strong> All rights reserved. Developed by <a href="https://tridastudio.com" target="_blank" class="text-success"><strong>Trida Studio</strong></a>
        <div class="float-right d-none d-sm-inline-block">
            <b>Versi</b> <?php if (function_exists('customer')) { echo customer()['versi']; }?>
        </div>
    </footer>
</div>
<!-- jQuery -->
<script src="<?php echo base_url('assets/admin'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/admin'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Data Tables -->
<script src="<?= base_url('assets/admin') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/admin'); ?>/dist/js/adminlte.min.js"></script>
<?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'kunjungan') { require_once './assets/public/ajax/kunjungan.php'; } ?>
<?php if ($this->uri->segment(1) == 'katalog') { require_once './assets/public/ajax/katalog.php'; } ?>
</body>
</html>

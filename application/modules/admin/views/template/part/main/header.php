<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Agus Triyanto">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if (function_exists('customer')) { echo customer()['aplikasi']; }?> <?php if (function_exists('customer')) { echo customer()['nama']; }?></title>
  <?php if (function_exists('customer')): ?>
      <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/admin/images/pengaturan/'.customer()['favicon']); ?>">
  <?php endif; ?>
  <meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-footer-fixed layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars mr-1"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          Assalamu'alaikum <?php if (identitas($this->session->userdata('id'))) { echo identitas($this->session->userdata('id'))->nama; } else { echo 'Trida Studio'; } ?><i class="fas fa-users-cog ml-2"></i>
        </a>
      </li>
    </ul>
  </nav>

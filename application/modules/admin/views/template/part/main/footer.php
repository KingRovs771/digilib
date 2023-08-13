    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3 text-center">
            <?php if (function_exists('customer')): ?>
                        <img class="img-circle elevation-2 mb-4 mt-2" width="100" src="<?= base_url('assets/admin/images/default/'.customer()['logo']) ?>">
				<?php endif; ?>
            <h5><?php if (identitas($this->session->userdata('id'))) { echo identitas($this->session->userdata('id'))->nama; } else { echo 'Trida Studio'; } ?></h5>
            <p><?php
                if (identitas($this->session->userdata('id')) && identitas($this->session->userdata('id'))->level == '0') {
                    echo 'Super Admin';
                } else if (identitas($this->session->userdata('id')) && identitas($this->session->userdata('id'))->level == '1') {
                    echo 'Admin';
                } else {
                    echo 'Petugas';
                }
            ?></p>
            <a href="<?php echo site_url('login/logout') ?>" class="btn btn-danger btn-block text-light mt-5">Keluar</a>
            <a href="<?php echo site_url('admin/pengguna/edit/'.$this->session->userdata('id')); ?>" class="mt-3 d-inline-block">Edit Profil</a>
        </div>
    </aside>
    <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#"><?php if (function_exists('customer')) { echo customer()['aplikasi']; }?> <?php if (function_exists('customer')) { echo customer()['nama']; }?></a></strong> All rights reserved. Developed by <a href="https://tridastudio.com" target="_blank" class="text-success"><strong>Trida Studio</strong></a>
        <div class="float-right d-none d-sm-inline-block">
            <b>Versi</b> <?php if (function_exists('customer')) { echo customer()['versi']; }?>
        </div>
    </footer>
</div>
<script src="<?php echo base_url('assets/admin') ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/admin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo base_url('assets/admin') ?>/dist/js/adminlte.min.js"></script>
<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'katalog') { require_once './assets/admin/ajax/katalog.php'; } ?>
<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'cetak-label') { require_once './assets/admin/ajax/cetak-label.php'; } ?>
<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'anggota') { require_once './assets/admin/ajax/anggota.php'; } ?>
<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'peminjaman') { require_once './assets/admin/ajax/peminjaman.php'; } ?>
<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'pengguna') { require_once './assets/admin/ajax/pengguna.php'; } ?>
<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'kunjungan') { require_once './assets/admin/ajax/kunjungan.php'; } ?>
</body>
</html>

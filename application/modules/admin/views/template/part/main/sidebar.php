<?php
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') $dashboard = 'active';
// Transaksi
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'katalog') $katalog = 'active';
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'anggota') $anggota = 'active';
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'admin') $admin = 'active';
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'laporan') $laporan = 'active';

//  Pengolahan koleksi
if ($this->uri->segment(1) == 'admin' && ($this->uri->segment(2) == 'katalog' || $this->uri->segment(2) == 'cetak-label')) {
	$pengolahan_koleksi = 'menu-open';
}

if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'katalog') $katalog_aktif = 'active';
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'cetak-label') $cetak_label_aktif = 'active';



// Anggota

// Admin

if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'peminjaman') {
	$transaksi = 'menu-open';
	$transaksi_aktif = 'active';
}
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'peminjaman' && $this->uri->segment(3) != 'riwayat') $data_peminjaman = 'active';
if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'peminjaman' && $this->uri->segment(3) == 'riwayat') $riwayat_peminjaman = 'active';

if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'pengguna') $pengguna = 'active';

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<span class="brand-link text-center">
		<a href="<?php echo site_url(); ?>" title="" target="_blank" class="brand-text font-weight-light text-light"><i class="nav-icon fas fa-book-open"></i> <strong><?php if (function_exists('customer')) { echo customer()['aplikasi']; }?></strong></a>
	</span>

	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<?php if (function_exists('customer')): ?>
					<img class="img-circle elevation-2" src="<?= base_url('assets/admin/images/default/'.customer()['logo']) ?>">
				<?php endif; ?>
			</div>
			<div class="info">
				<a href="#" class="d-block"><?php if (identitas($this->session->userdata('id'))) { echo identitas($this->session->userdata('id'))->nama; } else { echo 'Trida Studio'; } ?></a>
			</div>
		</div>
		<nav class="mt-2 mb-5">
			<ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?php echo site_url('admin') ?>" class="nav-link <?php if(isset($dashboard)) { echo $dashboard; } ?>">
						<i class="nav-icon fas fa-home"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-item <?php if(isset($transaksi)) { echo $transaksi; } ?>">
					<a href="<?php echo site_url('admin/peminjaman') ?>" class="nav-link <?php if(isset($transaksi_aktif)) { echo $transaksi_aktif; } ?>">
						<i class="nav-icon fas fa-file-invoice"></i>
						<p>Transaksi <i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo site_url('admin/peminjaman') ?>" class="nav-link <?php if(isset($data_peminjaman)) { echo $data_peminjaman; } ?>">
								<i class="far fa-circle nav-icon text-danger"></i>
								<p>Data Peminjaman</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/kunjungan') ?>" class="nav-link <?php if(isset($kunjungan)) { echo $kunjungan; } ?>">
								<i class="far fa-circle nav-icon text-warning"></i>
								<p>Data Kunjungan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/peminjaman/riwayat') ?>" class="nav-link <?php if(isset($riwayat_peminjaman)) { echo $riwayat_peminjaman; } ?>">
								<i class="far fa-circle nav-icon text-success"></i>
								<p>Data Keterlambatan</p>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="nav-item <?php if (isset($pengolahan_koleksi)) { echo $pengolahan_koleksi; } ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-book-open"></i>
						<p>Pengolahan Koleksi <i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo site_url('admin/katalog') ?>" class="nav-link <?php if (isset($katalog_aktif)) { echo $katalog_aktif; } ?>">
								<i class="far fa-circle nav-icon text-danger"></i>
								<p>Data Buku</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/cetak-label') ?>" class="nav-link <?php if (isset($cetak_label_aktif)) { echo $cetak_label_aktif; } ?>">
								<i class="far fa-circle nav-icon text-warning"></i>
								<p>Cetak Label</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('admin/peminjaman/riwayat') ?>" class="nav-link">
								<i class="far fa-circle nav-icon text-success"></i>
								<p>Cetak Barkode</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?php echo site_url('admin/anggota') ?>" class="nav-link <?php if(isset($anggota)) { echo $anggota; } ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>Anggota</p>
					</a>
				</li>
				<!-- <li class="nav-item">
					<a href="<?php echo site_url('admin/laporan') ?>" class="nav-link <?php if(isset($laporan)) { echo $laporan; } ?>">
						<i class="nav-icon fas fa-server"></i>
						<p>Laporan</p>
					</a>
				</li> -->
				<li class="nav-item">
					<a href="<?php echo site_url('admin/pengguna') ?>" class="nav-link <?php if(isset($pengguna)) { echo $pengguna; } ?>">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>Admin</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>

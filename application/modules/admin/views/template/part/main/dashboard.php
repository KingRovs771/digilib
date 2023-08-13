<div class="col-12">
	<div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php if (isset($jumlah_buku)) { echo sprintf("%03d", $jumlah_buku); } else { echo sprintf("%03d", 0); } ?></h3>
                <p>Total Semua Buku</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i>
              </div>
              <a href="<?php echo site_url('admin/katalog'); ?>" class="small-box-footer">
                Lihat Buku <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php if (isset($jumlah_buku_terpinjam)) { echo sprintf("%03d", $jumlah_buku_terpinjam); } else { echo sprintf("%03d", 0); } ?></h3>
                <p>Total Peminjaman</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-invoice"></i>
              </div>
              <a href="<?php echo site_url('admin/peminjaman'); ?>" class="small-box-footer">
                Lihat Peminjaman <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php if (isset($jumlah_buku_tersedia)) { echo sprintf("%03d", $jumlah_buku_tersedia); } else { echo sprintf("%03d", 0); } ?></h3>
                <p>Total Buku Tersedia</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="<?php echo site_url('admin/katalog'); ?>" class="small-box-footer">
                Lihat Buku <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php if (isset($jumlah_judul_buku)) { echo sprintf("%03d", $jumlah_judul_buku); } else { echo sprintf("%03d", 0); } ?></h3>
                <p>Total Judul Buku</p>
              </div>
              <div class="icon">
                <i class="fas fa-stream"></i>
              </div>
              <a href="<?php echo site_url('admin/anggota'); ?>" class="small-box-footer">
                Lihat Anggota <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>

		<div class="row">
      <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-purple"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Jumlah Anggota</span>
                <span class="info-box-number"><?php if(isset($jumlah_anggota)) { echo sprintf("%03d", $jumlah_anggota); } else { echo sprintf("%03d", 0); } ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-chalkboard-teacher"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Guru/Karyawan</span>
                <span class="info-box-number"><?php if(isset($jumlah_anggota_karyawan)) { echo sprintf("%03d", $jumlah_anggota_karyawan); } else { echo sprintf("%03d", 0); } ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-user-graduate"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Kelas VI</span>
                <span class="info-box-number"><?php if(isset($jumlah_anggota_kelas7)) { echo sprintf("%03d", $jumlah_anggota_kelas7); } else { echo sprintf("%03d", 0); } ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-user-graduate"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Kelas VII</span>
                <span class="info-box-number"><?php if(isset($jumlah_anggota_kelas8)) { echo sprintf("%03d", $jumlah_anggota_kelas8); } else { echo sprintf("%03d", 0); } ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Kelas IX</span>
                <span class="info-box-number"><?php if(isset($jumlah_anggota_kelas9)) { echo sprintf("%03d", $jumlah_anggota_kelas9); } else { echo sprintf("%03d", 0); } ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
</div>

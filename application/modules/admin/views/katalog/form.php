<div class="col-12">
    <?= $this->session->flashdata('katalog'); ?>
	<form role="form" action="<?php if (isset($url)) { echo $url; } ?>" method="post" enctype="multipart/form-data">
		<div class="card">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-outline card-success shadow-none">
						<div class="card-header">
							<h3 class="card-title">Form <?php echo ucfirst($this->uri->segment(3)); ?></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body" style="display: block;">
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label for="judul" class="control-label">Judul</label>
										<input type="text" name="judul" class="form-control" id="judul" placeholder="Contoh: Kembali Ke Dekapan Tarbiyah" value="<?php if (isset($judul)) { echo $judul; } ?>">
										<?php echo form_error('judul'); ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="penulis" class="control-label">Penulis</label>
										<input type="text" name="penulis" class="form-control" id="penulis" placeholder="Contoh: Agus Triyanto" value="<?php if (isset($penulis)) { echo $penulis; } ?>">
										<?php echo form_error('penulis'); ?>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="isbn" class="control-label">ISBN</label>
										<input type="number" name="isbn" class="form-control" id="isbn" placeholder="Contoh: 0895422639422" value="<?php if (isset($isbn)) { echo $isbn; } ?>">
										<?php echo form_error('isbn'); ?>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="tahun_terbit" class="control-label">Tahun Terbit</label>
										<input type="number" name="tahun_terbit" class="form-control" id="tahun_terbit" placeholder="Contoh: 2023" value="<?php if (isset($tahun_terbit)) { echo $tahun_terbit; } ?>">
										<?php echo form_error('tahun_terbit'); ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="tempat_terbit" class="control-label">Tempat Terbit</label>
										<input type="text" name="tempat_terbit" class="form-control" id="tempat_terbit" placeholder="Contoh: Surakarta" value="<?php if (isset($tempat_terbit)) { echo $tempat_terbit; } ?>">
										<?php echo form_error('tempat_terbit'); ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="penerbit" class="control-label">Penerbit</label>
										<input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="Contoh: CV. Trida Mitra Sejahtera" value="<?php if (isset($penerbit)) { echo $penerbit; } ?>">
										<?php echo form_error('penerbit'); ?>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="jumlah" class="control-label">Jumlah</label>
										<input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Contoh: 5" value="<?php if (isset($jumlah)) { echo $jumlah; } ?>">
										<?php echo form_error('jumlah'); ?>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="klasifikasi" class="control-label">Klasifikasi</label>
										<input type="text" name="klasifikasi" class="form-control" id="klasifikasi" placeholder="Contoh: 000.025" value="<?php if (isset($klasifikasi)) { echo $klasifikasi; } ?>">
										<?php echo form_error('klasifikasi'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="id" value="<?php if (isset($id)) { echo $id; } ?>">
			<div class="card-footer text-right">
				<button class="btn bg-success"><i class="fas fa-save"></i> Simpan</button>
				<a href="<?php echo site_url('admin/katalog') ?>" class="btn bg-secondary"><i class="fas fa-times"></i> Batal</a>
			</div>
		</div>
	</form>
</div>

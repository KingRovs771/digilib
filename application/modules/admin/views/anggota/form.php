<div class="col-12">
    <?= $this->session->flashdata('anggota'); ?>
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
								<div class="col-md-2">
									<label for="foto" class="control-label">Pas Foto ( 3x4 )</label>
									<div class="form-group">
										<?php if (isset($foto) && is_file('./assets/admin/images/anggota/'.$foto)):?>
											<img class="img-thumbnail" src="<?php echo base_url('assets/admin/images/anggota/'.$foto); ?>" width="250">
										<?php else:?>
											<img class="img-thumbnail" src="<?php echo base_url('assets/admin/images/anggota/default.jpg'); ?>" width="250">
										<?php endif;?>
										<div class="input-group mt-2">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="foto" name="foto">
												<label class="custom-file-label" for="foto">Pilih file</label>
											</div>
										</div>
										<?php echo form_error('foto'); ?>
									</div>
								</div>
								<div class="col-md-10">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="nama" class="control-label">Nama Lengkap</label>
												<input type="text" name="nama" class="form-control" id="nama" placeholder="Contoh: Agus" value="<?php if (isset($nama)) { echo $nama; } ?>">
												<?php echo form_error('nama'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
												<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
													<option value="">-Pilihan --</option>
													<option value="L" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'L') { echo 'selected=""'; } ?>>Laki-laki</option>
													<option value="P" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'P') { echo 'selected=""'; } ?>>Perempuan</option>
												</select>
												<?php echo form_error('jenis_kelamin'); ?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="nis_nipy" class="control-label">NIS/NIPY</label>
												<input type="number" name="nis_nipy" class="form-control" id="nis_nipy" placeholder="Contoh: 31249" value="<?php if (isset($nis_nipy)) { echo $nis_nipy; } ?>">
												<small class="text-danger"><em>Isikan NIS/NIPY tanpa tanda titik!</em></small>
												<?php echo form_error('nis_nipy'); ?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="jenis_anggota" class="control-label">Jenis Anggota</label>
												<select name="jenis_anggota" id="jenis_anggota" class="form-control">
													<option value="">-Pilihan --</option>
													<option value="7" <?php if (isset($jenis_anggota) && $jenis_anggota == '7') { echo 'selected=""'; } ?>>Kelas VII</option>
													<option value="8" <?php if (isset($jenis_anggota) && $jenis_anggota == '8') { echo 'selected=""'; } ?>>Kelas VIII</option>
													<option value="9" <?php if (isset($jenis_anggota) && $jenis_anggota == '9') { echo 'selected=""'; } ?>>Kelas IX</option>
													<option value="0" <?php if (isset($jenis_anggota) && $jenis_anggota == '0') { echo 'selected=""'; } ?>>Guru/Karyawan</option>
												</select>
												<?php echo form_error('jenis_kelamin'); ?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="tanggal_daftar" class="control-label">Tanggal Daftar</label>
												<input type="date" name="tanggal_daftar" class="form-control" id="tanggal_daftar" value="<?php if (isset($tanggal_daftar)) { echo $tanggal_daftar; } ?>">
												<?php echo form_error('tanggal_daftar'); ?>
											</div>
										</div>
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
				<a href="<?php echo site_url('admin/anggota') ?>" class="btn bg-secondary"><i class="fas fa-times"></i> Batal</a>
			</div>
		</div>
	</form>
</div>

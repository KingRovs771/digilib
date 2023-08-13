<div class="col-12">
	<?php echo $this->session->flashdata('pengguna') ?>
	<form role="form" id="" method="post" enctype="multipart/form-data" action="<?php if (isset($url)) { echo $url; } ?>">
			<div class="card card-outline card-olive">
				<div class="card-header">
						<h3 class="card-title">Form Tambah</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body" style="display: block;">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nama" class="control-label">Nama Lengkap</label>
									<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?php if (isset($nama)) { echo $nama; } ?>">
									<?= form_error('nama'); ?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="status" class="control-label">Status</label>
									<select name="status" id="status" class="form-control" <?php if($this->session->userdata('level') != '0' && $this->session->userdata('level') != '1') { echo 'disabled'; } ?>>
										<option value="0" <?php if (isset($status) && $status == '0') { echo 'selected=""'; } ?>>Tidak Aktif</option>
										<option value="1" <?php if (isset($status) && $status == '1') { echo 'selected=""'; } ?>>Aktif</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="level" class="control-label">Level</label>
									<select name="level" id="level" class="form-control" <?php if($this->session->userdata('level') != '0' && $this->session->userdata('level') != '1') { echo 'disabled'; } ?>>
										<option value="1" <?php if (isset($level) && $level == '1') { echo 'selected=""'; } ?>>Admin</option>
										<?php if ($this->session->userdata('level') == '0'): ?>
											<option value="0" <?php if (isset($level) && $level == '0') { echo 'selected=""'; } ?>>Developer</option>
										<?php endif ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="username" class="control-label">Username</label>
									<input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php if (isset($username)) { echo $username; } ?>" <?php if($this->uri->segment(2) == 'pengguna' && $this->uri->segment(3) == 'edit') { echo 'readonly'; } ?>>
									<?= form_error('username'); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="password" class="control-label">Password</label>
									<input type="password" name="password" class="form-control" id="password" placeholder="password">
									<?= form_error('password'); ?>
								</div>
							</div>
						</div>
					</div>
			<input type="hidden" name="id" value="<?php if (isset($id)) { echo $id; } ?>">
			<input type="hidden" name="password_lama" value="<?php if (isset($password)) { echo $password; } ?>">
			<div class="card-footer text-right">
				<button class="btn bg-success"><i class="fas fa-save"></i> Simpan</button>
				<a href="<?php echo site_url('admin/pengguna');?>" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
			</div>
			</div>
	</form>
</div>

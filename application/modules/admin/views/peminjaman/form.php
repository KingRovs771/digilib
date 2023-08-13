<div class="col-12">
    <?= $this->session->flashdata('peminjaman'); ?>
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
								<div class="col-md-3">
									<div class="form-group">
										<label for="id_anggota" class="control-label">Nama Anggota</label>
										<select name="id_anggota" class="form-control id_anggota" style="width: 100%;" id="id_anggota" required>
											<option value=""></option>
										</select>
										<?php echo form_error('id_anggota'); ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="id_buku" class="control-label">Judul</label>
										<select name="id_buku" class="form-control id_buku" style="width: 100%;" id="id_buku" required>
											<option value=""></option>
										</select>
										<?php echo form_error('id_buku'); ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="tanggal_pinjam" class="control-label">Tanggal Pinjam</label>
										<input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" value="<?php if (isset($tanggal_pinjam) && $tanggal_pinjam) { echo $tanggal_pinjam; } ?>" required>
										<?php echo form_error('tanggal_pinjam'); ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="id_pengguna" class="control-label">Admin yang Bertugas</label>
										<input type="text" class="form-control"placeholder="<?php if(identitas($this->session->userdata('id'))) { echo identitas($this->session->userdata('id'))->nama; } ?>"readonly>
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
				<a href="<?php echo site_url('admin/peminjaman') ?>" class="btn bg-secondary"><i class="fas fa-times"></i> Batal</a>
			</div>
		</div>
	</form>
</div>

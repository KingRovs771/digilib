<div class="col-12">
    <?= $this->session->flashdata('peminjaman'); ?>
	<form role="form" action="#" method="post" enctype="multipart/form-data">
		<div class="card">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-outline card-success">
						<div class="card-header">
							<h3 class="card-title">Form Peminjaman</h3>
						</div>
						<div class="card-body" style="display: block;">
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" name="nis_nipy" placeholder="NIS/NIPY" class="form-control" id="nis_nipy" required autofocus>
										<?php echo form_error('nis_nipy'); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="number" name="isbn" placeholder="ISBN tanpa tanda titik (.)" class="form-control" id="isbn" required>
										<?php echo form_error('isbn'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<button class="btn bg-success"><i class="fas fa-save"></i> Submit</button>
			</div>
		</div>
	</form>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table id="tabel" class="table dt-responsive nowrap table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pinjam</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tangal Kembali</th>
                        <th>Status</th>
                        <th>Pilihan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

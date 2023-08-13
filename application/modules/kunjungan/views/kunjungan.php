<div class="content-wrapper">
    <div class="content pt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <?php echo $this->session->flashdata('kunjungan') ?>
            <form action="<?php echo site_url('kunjungan/simpan');?>" method="post">
              <div class="card">
                <div class="card-header bg-navy">
                    <h4 class="header-title">Masukan Nomor Anggota Anda di sini!</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nis_nipy" class="control-label">No. Anggota</label>
                    <input type="number" class="form-control" name="nis_nipy" id="nis_nipy" placeholder="Ketik nomor anggota Anda tanpa tanda titik (.)" value="<?php if(isset($nis_nipy)) { echo $nis_nipy; } ?>" required autofocus>
                    <?php echo form_error('nis_nipy'); ?>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-purple">
                        <h4 class="header-title">Daftar Kunjungan Anggota</h4>
                    </div>
                    <div class="card-body">
                        <table id="tabel" class="table dt-responsive nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Anggota</th>
                                    <th>NIS/NIPY</th>
                                    <th>Waktu Berkunjung</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="col-12">
    <?= $this->session->flashdata('anggota'); ?>
    <div class="card">
        <div class="card-header">
            <h4 class="header-title">
                <a href="<?php echo site_url('admin/anggota/tambah') ?>" class="btn bg-success waves-effect waves-light" ><i class="fas fa-plus-circle"></i> Tambah</a>
            </h4>
        </div>
        <div class="card-body">
            <table id="tabel" class="table dt-responsive nowrap table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS/NIPY</th>
                        <th>Tanggal Daftar</th>
                        <th>Pilihan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

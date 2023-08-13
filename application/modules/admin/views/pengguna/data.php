<div class="col-12">
    <?php echo $this->session->flashdata('pengguna') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="header-title">
                <a href="<?php echo site_url('admin/pengguna/tambah') ?>" class="btn bg-olive waves-effect waves-light" ><i class="fas fa-plus-circle"></i> Tambah Baru</a>
            </h4>
        </div>
        <div class="card-body">
            <table id="tabel" class="table dt-responsive nowrap table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Pilihan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

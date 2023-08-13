<div class="col-12">
    <?= $this->session->flashdata('katalog'); ?>
    <div class="card">
        <div class="card-header">
            <h4 class="header-title">
                <a href="<?php echo site_url('admin/katalog/tambah') ?>" class="btn bg-success waves-effect waves-light" ><i class="fas fa-plus-circle"></i> Tambah</a>
            </h4>
        </div>
        <div class="card-body">
            <table id="tabel" class="table dt-responsive nowrap table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <!-- <th>ISBN</th> -->
                        <th>Tahun Terbit</th>
                        <!-- <th>Tempat Terbit</th> -->
                        <th>Penerbit</th>
                        <th>Jumlah</th>
                        <!-- <th>Klasifikasi</th> -->
                        <th>Pilihan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="alert alert-warning alert-dismissible">
        Saat ini terdapat <span id="jumlah-item">0</span> dalam antrian yang siap dicetak!
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-2" style="margin-right: -100px;">
                    <a href="#" class="btn bg-purple waves-effect waves-light" id="pilih-semua-label"><i class="fas fa-check"></i> Pilih Semua Data</a>
                </div>
                <div class="col-md-2" style="margin-right: -60px;">
                    <a href="#" class="btn bg-primary disabled waves-effect waves-light" id="tambahkan-antrian-cetak-label"><i class="fas fa-plus-circle"></i> Simpan Dalam Antrian</a>
                </div>
                <div class="col-md-2" style="margin-right: -15px;">
                    <form action="#" id="form-cetak-label">
                        <button type="submit" class="btn bg-success disabled waves-effect waves-light" id="tombol-cetak-label-dari-data-terpilih"><i class="fas fa-print"></i> Cetak Label Dari Data Terpilih</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="#" class="btn bg-danger disabled waves-effect waves-light" id="tombol-hapus-semua-antrian"><i class="fas fa-times"></i> Hapus Semua Antrian</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="tabel" class="table dt-responsive nowrap table-bordered">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="pilih-semua-label">
                        </th>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun Terbit</th>
                        <th>Nomor Buku</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

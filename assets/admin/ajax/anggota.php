
<script type="text/javascript">
$(document).ready(function(){
	$(function () {
		bsCustomFileInput.init();
	});

	let tabel = $("#tabel").DataTable({
		"responsive": true,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"bLengthChange": true,
		"sZeroRecords": "Tidak ada data!",
		"sProcessing": "Sedang Proses",
		// "bInfo" : false,
		"order": [],
		"ajax": {
			"url": "<?= site_url('admin/anggota/get_data/'); ?>",
			"type": "POST"
		},
		"columnDefs": [
			{  "targets": 0,  "orderable": false, "width": "30px", "className": "text-center" },
			{  "targets": 4, "data": null, "orderable": false, "searchable": false, "width": "175px", "className": "text-center",
			// tombol ubah dan hapus
			"render": function(data, type, row) {
				var btn = "<a style=\"margin-right:7px\" title=\"Ubah\" onclick=\"return cetak_kartu("+data[4]+")\" class=\"btn btn-warning btn-sm\" href=\"#\"><i class=\"fas fa-print\"></i> Cetak Kartu</a>"+
				"<a style=\"margin-right:7px\" title=\"Ubah\" class=\"btn btn-info btn-sm\" href=\"<?php echo base_url('admin/anggota/edit/'); ?>"+data[4]+"\"><i class=\"fas fa-edit\"></i> Edit</a>"+
				"<a title=\"Hapus\" class=\"btn btn-danger btn-sm\" href=\"javascript:void(0);\" onclick=\"hapus('"+data[4]+"')\"><i class=\"fas fa-trash\"></i> Hapus</a>";
				return btn;
			}
		}
	],
});
});

function hapus(id) {
	Swal.fire({
		title: 'Apakah Anda yakin?',
		text: 'Anda akan menghapus data ini!',
		icon: 'warning',
		showCancelButton:    true,
		confirmButtonColor: '#1abc9c',
		cancelButtonColor:   '#6c757d',
		confirmButtonText:   'Ya, Hapus!',
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type:    'POST',
				url:     '<?= site_url('admin/anggota/hapus/') ?>'+id,
				data:    id,
				success: function(e){
					if (e == 'berhasilDihapus') {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: 'anggota berhasil dihapus!',
							showConfirmButton: false,
							timer: 1000
						});
						let tabel = $("#tabel").DataTable();
						tabel.ajax.reload(null, false);
					}  else {
						Swal.fire(
							'Gagal!!',
							'Data tidak ditemukan!',
							'error',
						);
					}
				}
			});
		}
	});
}

function cetak_kartu(id_anggota) {
	var x = '<?php echo site_url('admin/anggota/cetak-kartu'); ?>/'+id_anggota;
	window.open(x, '_blank', 'width=1000, height=700, left=150');    
}
</script>

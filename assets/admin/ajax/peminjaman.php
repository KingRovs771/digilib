
<script type="text/javascript">
$(document).ready(function(){
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
			"url": "<?= site_url('admin/peminjaman/get_data/'); ?>",
			"type": "POST"
		},
		"columnDefs": [
			{  "targets": 0,  "orderable": false, "width": "30px", "className": "text-center"},
			{  "targets": 6, "data": null, "orderable": false, "searchable": false, "width": "175px", "className": "text-center",
				// tombol ubah dan hapus
				"render": function(data, type, row) {
					var btn = "<a style=\"margin-right:7px\" title=\"Ubah\" class=\"btn btn-warning btn-sm\" href=\"<?php echo base_url('admin/peminjaman/edit/'); ?>"+data[6]+"\"><i class=\"fas fa-print\"></i> Kembali</a>";
					return btn;
				}
			}
		],
	});

	$('#id_anggota').select2({
		placeholder: 'Pilih nama anggota',
		ajax: {
			dataType: 'json',
			url: '<?php echo site_url('admin/peminjaman/get-data-anggota'); ?>',
			delay: 250,
			processResults: function (result, page) {
				return {
					results: $.map(result.data, function(obj){
						return { id: obj.value, text: obj.label };
					})
				}
			}
		}, escapeMarkup: function(markup) {
			return markup;
		}
	});

	$('#id_buku').select2({
		placeholder: 'Pilih nama buku',
		ajax: {
			dataType: 'json',
			url: '<?php echo site_url('admin/peminjaman/get-data-buku'); ?>',
			delay: 250,
			processResults: function (result, page) {
				return {
					results: $.map(result.data, function(obj){
						return { id: obj.value, text: obj.label };
					})
				}
			}
		}, escapeMarkup: function(markup) {
			return markup;
		}
	});
});

<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'peminjaman' && $this->uri->segment(3) == 'edit'): ?>
$.ajax({
    type: 'GET',
    url: '<?= site_url('admin/peminjaman/get_anggota_by_id_peminjaman/'.$this->uri->segment(4)) ?>',
    dataType: 'JSON',
    success: function(e){
        var id_anggota = new Option(e.nama, e.id, true, true);

        $('select[name=id_anggota]').append(id_anggota).trigger('change');
    }
});

$.ajax({
    type: 'GET',
    url: '<?= site_url('admin/peminjaman/get_buku_by_id_peminjaman/'.$this->uri->segment(4)) ?>',
    dataType: 'JSON',
    success: function(e){
        var id_buku = new Option(e.judul, e.id, true, true);

        $('select[name=id_buku]').append(id_buku).trigger('change');
    }
});
<?php endif; ?>

// <?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'peminjaman' && $this->uri->segment(3) == 'simpan'): ?>
// $.ajax({
//     type: 'GET',
//     url: '<?= site_url('admin/peminjaman/data_input/') ?>',
//     dataType: 'JSON',
//     success: function(e){
//         var data_anggota = new Option(e.nama_anggota, e.id_anggota, true, true);
//         $('select[name=id_anggota]').append(data_anggota).trigger('change');

// 		var data_buku = new Option(e.judul_buku, e.id_buku, true, true);
//         $('select[name=id_buku]').append(data_buku).trigger('change');
//     }
// });
// <?php endif; ?>

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
				url:     '<?= site_url('admin/peminjaman/hapus/') ?>'+id,
				data:    id,
				success: function(e){
					if (e == 'berhasilDihapus') {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: 'peminjaman berhasil dihapus!',
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
</script>

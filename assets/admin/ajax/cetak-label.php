
<script type="text/javascript">	
	$(document).ready(function(){
		let tabel = $("#tabel").DataTable({
			pagingType: 'full_numbers',
			"lengthMenu" : [50, 100, 150],
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
				"url": "<?= site_url('admin/cetak-label/get_data/'); ?>",
				"type": "POST"
			},
			"columnDefs": [
				{  "targets": 0,  "orderable": false, "width": "30px", "className": "text-center"},
				{  "targets": 1,  "orderable": false, "width": "30px", "className": "text-center"},
			],
			
		});
	});

	function cetak_label_dari_data_terpilih() {
		var x = '<?php echo site_url('admin/cetak-label/cetak-label'); ?>/'+siap_cetak;
		window.open(x, '_blank', 'width=1000, height=700, left=150');    
	}


</script>

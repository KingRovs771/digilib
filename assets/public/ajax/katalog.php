
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
			"url": "<?= site_url('katalog/get_data/'); ?>",
			"type": "POST"
		},
		"columnDefs": [
			{  "targets": 0,  "orderable": false, "width": "30px", "className": "text-center" },
        ],
    });
});
</script>

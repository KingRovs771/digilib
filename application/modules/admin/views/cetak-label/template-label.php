<html moznomarginboxes mozdisallowselectionprint>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Perpustakaan SMPIT Nur Hidayah Surakarta</title>
	<style> @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;0,900;1,300&display=swap'); </style>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/buku/satu-label.css'); ?>">
</head>
<body>
    <?php
        if (isset($no_buku) && $no_buku && file_exists('./assets/admin/images/qr-code/buku/'.$no_buku.'.png')) {
            $path_isbn = base_url('assets/admin/images/qr-code/buku/'.$no_buku.'.png');
            $type_isbn = pathinfo($path_isbn, PATHINFO_EXTENSION);
            $data_isbn = file_get_contents($path_isbn);
            $qr_code = 'data:image/' . $type_isbn . ';base64,' . base64_encode($data_isbn);
        }
    ?>

    <div class="row header position-relative">
        <div class="col-8 pt-2" id="barcode">
            <div class="container">
                <h2 class="text-center">PERPUSTAKAAN</h2>
                <h3 class="text-center">SMPIT NUR HIDAYAH SURAKARTA</h3>
            </div>
        </div>
        <div class="col-4 pt-2" id="label">
            <div class="container">
                <h2 class="text-center mt-2">PERPUSTAKAAN</h2>
                <h3 class="text-center">SMPIT NH SURAKARTA</h3>
            </div>
        </div>
    </div>
    <div class="row body mt-3">
        <div class="col-8">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <?php if (isset($qr_code)) : ?>
                            <img src="<?php echo $qr_code; ?>" class="img-thumbnail" id="qr-code">
                            <p class="text-center"><small><?php if (isset($no_buku)) { echo $no_buku; } ?></small></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-8">
                        <h2 class="title"><strong>JUDUL BUKU</strong></h2>
                        <p><em><?php if (isset($judul)) { echo '"'.$judul.'"'; } ?></em></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 label-body text-center">
            <p><strong><?php if (isset($klasifikasi)) { echo $klasifikasi; } ?></strong></p>
            <p><?php if (isset($penulis)) { echo substr($penulis, 0, 3); } ?></p>
            <p><?php if (isset($judul)) { echo substr($judul, 0, 1); } ?></p>
            <p><?php if (isset($jumlah)) { echo 'C1 - '.$jumlah; } ?></p>
        </div>
    </div>
    
	<script>
		window.print();
	</script>
</body>
</html>

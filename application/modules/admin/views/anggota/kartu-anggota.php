<html moznomarginboxes mozdisallowselectionprint>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kartu Anggota <?php if (isset($nama) && $nama) { echo $nama; } ?> <?php if (isset($nis_nipy) && $nis_nipy) { echo '('.$nis_nipy.')'; } ?></title>
	<style> @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;0,900;1,300&display=swap'); </style>
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/kartu-anggota/style.css'); ?>">
</head>
<body>
    <?php
        $path_logo = base_url('/assets/admin/images/default/logo.png');
        $type_logo = pathinfo($path_logo, PATHINFO_EXTENSION);
        $data_logo = file_get_contents($path_logo);
        $logo = 'data:image/' . $type_logo . ';base64,' . base64_encode($data_logo);

        if (isset($foto) && $foto && is_file('./assets/admin/images/anggota/'.$foto)) {
            $path_foto = base_url().'/assets/admin/images/anggota/'.$foto;
            $type_foto = pathinfo($path_foto, PATHINFO_EXTENSION);
            $data_foto = file_get_contents($path_foto);
            $foto = 'data:image/' . $type_foto . ';base64,' . base64_encode($data_foto);
        } else {
            $path_foto = base_url().'/assets/admin/images/default/anggota.png';
            $type_foto = pathinfo($path_foto, PATHINFO_EXTENSION);
            $data_foto = file_get_contents($path_foto);
            $foto = 'data:image/' . $type_foto . ';base64,' . base64_encode($data_foto);
        }
    ?>
    <section id="header" style="background-color: #00783C; height: 64px; padding-top: 10px; clear: both;">
        <div class="container">
            <div class="logo">
                <img src="<?php echo $logo; ?>">
            </div>
            <div class="identitas">
                <h3>KARTU ANGGOTA PERPUSTAKAAN</h3>
                <h1>SMPIT NUR HIDAYAH</h1>
                <p>Jl. Kahuripan Utara Raya, Sumber, Banjarsari, Surakarta, Jawa Tengah 57138</p>
            </div>
        </div>
    </section>

    <section id="body">
        <div class="container">
            <div class="foto">
                <img src="<?php echo $foto; ?>" id="foto">
            </div>
            <div class="data-anggota" style="margin-top: 10px;">
                <div class="list">
                    <p>Nama Anggota</p>
                    <p>NIS/NIPY</p>
                    <p>Jenis Kelamin</p>
                    <p>Masa Berlaku</p>
                </div>
                <div class="item">
                    <p>: <?php if (isset($nama) && $nama) { echo $nama; } ?></p>
                    <p>: <?php if (isset($nis_nipy) && $nis_nipy) { echo $nis_nipy; } ?></p>
                    <p>: <?php if (isset($jenis_kelamin) && $jenis_kelamin) { 
                        if ($jenis_kelamin == 'L') {
                            echo 'Laki-laki';
                        } else {
                            echo 'Perempuan';
                        }
                    } ?></p>
                    <p>: <?php if (isset($masa_berlaku) && $masa_berlaku) { echo tanggal_indonesia($masa_berlaku); } ?></p>
                </div>
                <?php if (isset($nis_nipy) && file_exists('./assets/admin/images/qr-code/anggota/'.$nis_nipy.'.png')): ?>
                    <img src="<?php echo base_url('assets/admin/images/qr-code/anggota/'.$nis_nipy.'.png')?>" width="60" style="position: absolute; right: 15px; bottom: 25px;">
                <?php endif;?>
            </div>
        </div>
    </section>

    <section id="footer" style="background-color: #00783C; position: fixed; bottom: 0; height: 10px; width: 100%;">
    </section>

	<script>
		window.print();
	</script>
</body>
</html>

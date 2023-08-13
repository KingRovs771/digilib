<?php if ($this->uri->segment(1) == ''): ?>
    <meta name="keywords" content="" />
    <meta name="description"            content="<?php echo web_info()['title']; ?> - <?php echo web_info()['tagline']; ?>" />
    <link rel="canonical"               href="<?php echo site_url(); ?>" />
    <meta property="og:title"           content="<?php echo web_info()['title']; ?>" />
    <meta property="og:url"             content="<?php echo site_url(); ?>"/>
    <meta property="og:description"     content="<?php echo web_info()['description']; ?>"/>
    <meta property="og:type"            content="article" />
    <meta property="og:locale"          content="id_id" />
    <meta property="og:site_name"       content="<?php echo web_info()['title']; ?>" />
    <meta property="article:publisher"  content="<?php echo site_url(); ?>" />
    <meta property="article:section"    content="<?php echo web_info()['title']; ?> - <?php echo web_info()['tagline']; ?>" />
    <meta property="og:image"           content="<?php echo base_url(); ?>assets/admin/images/default/og-image.jpg" />
<?php else: ?>
    <meta name="keywords" content="" />
    <meta name="description"            content="<?php if (isset($konten)) { echo strip_tags($konten); } ?>" />
    <link rel="canonical"               href="<?php if (isset($slug)) { echo site_url($slug); } ?>" />
    <meta property="og:title"           content="<?php if (isset($judul)) { echo $judul; } ?>" />
    <meta property="og:url"             content="<?php if (isset($slug)) { echo site_url($slug); } ?>"/>
    <meta property="og:description"     content="<?php if (isset($konten)) { echo strip_tags($konten); } ?>"/>
    <meta property="og:type"            content="article" />
    <meta property="og:locale"          content="id_id" />
    <meta property="og:site_name"       content="<?php echo web_info()['title']; ?>" />
    <meta property="article:publisher"  content="<?php echo site_url(); ?>" />
    <meta property="article:section"    content="<?php echo web_info()['title']; ?> - <?php echo web_info()['tagline']; ?>" />
    <meta property="og:image"           content="<?php if (isset($gambar) && !empty($gambar) && file_exists('assets/admin/images/postingan/gambar-utama/'.$gambar)) { echo base_url('assets/admin/images/postingan/gambar-utama/'.$gambar); } ?>" />
    <!-- <meta property="og:image:width"     content="750" />
    <meta property="og:image:height"    content="390" /> -->
<?php endif ?>
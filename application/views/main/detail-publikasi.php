<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: School Education
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= $title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--    <meta property="og:url"           content="<?= base_url('main/publikasi/'.$publikasi->id.'/'.  post_slug($publikasi->judul)) ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?= $title ?>" />
    <meta property="og:description"   content="<?= post_slug($publikasi->judul) ?>" />-->

<link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png') ?>" />
<link rel="stylesheet" href="<?= base_url('assets/sched/styles/layout.css') ?>" type="text/css" />
<link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome-4.3.0/css/font-awesome.min.css') ?>" type="text/css" />
<script type="text/javascript" src="<?= base_url('assets/sched/scripts/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/sched/scripts/jquery.slidepanel.setup.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.nicescroll.js') ?>"></script>
<script type="text/javascript">
    $(function() {
        $(".scrollable").niceScroll({
            touchbehavior:false,
            cursorcolor:"#666",
            cursoropacitymax:0.7,
            cursorwidth:2,
            cursorborder:"1px solid #2848BE",
            cursorborderradius:"8px",
            background:"#ccc",
            autohidemode:true
        }).cursor.css({
            //'background-image':'url(<?= base_url('') ?>)'
        }); // MAC like scrollbar
    });
</script>
</head>
<body>
<div class="wrapper col0">
  <div id="topbar">
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
        <h1><a href="<?= base_url('') ?>"><img src="<?= base_url('assets/img/logo-univ.png') ?>" /></a></h1>
    </div>
    <div id="topnav">
      <?= $this->load->view('nav') ?>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">You Are Here</li>
      <li>&#187;</li>
      <li><a href="<?= base_url('') ?>">Home</a></li>
      <li>&#187;</li>
      <li><?= $kategori->nama ?></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <div id="content">
      <h1>Kategori <?= $kategori->nama ?></h1>
      <ul class="content-block-link">
      <?php
      if (sizeof($publikasi) > 0) {
        foreach ($publikasi as $data) { ?>
        <li><a href="<?= base_url('main/publikasidetail/'.$kategori->id.'/'.$data->id.'/'.  post_slug($data->judul)) ?>"><?= $data->judul ?></a>
            <br /><span>Tanggal Publish: <?= indo_tgl($data->tanggal) ?></span>
        </li>
      <?php }
      } else { ?>
        <i>Belum ada publikasi ilmiah pada kategori ini ..!</i>
      <?php }
      ?>
    </ul>
    </div>
    <div id="column" class="scrollable" style="max-height: 900px; overflow-y: auto;">
        <h2>Publikasi Ilmiah Lainnya</h2>
        <ul class="news-on-detail">
            <?php foreach ($publikasi_lain as $i => $data) { ?>
              <li>
                  <div class="circleBase2 type2"> <?= ++$i ?></div> <strong><a href="<?= base_url('main/publikasi/'.$data->id.'/'.post_slug($data->nama)) ?>"><?= $data->nama ?></a></strong>
              </li>
            <?php } ?>
        </ul>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="footer">
    <?= $this->load->view('footbox') ?>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<?= $this->load->view('footer') ?>
</body>
</html>
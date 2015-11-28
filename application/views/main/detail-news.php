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
    <meta property="og:url"           content="<?= base_url('main/detailnews/'.$berita->id.'/'.  post_slug($berita->judul)) ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?= $title ?>" />
    <meta property="og:description"   content="<?= post_slug($berita->judul) ?>" />
    <meta property="og:image"         content="<?= base_url('assets/img/berita/'.$berita->gambar) ?>" />

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
      <li><a href="#">Detail Berita</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <div id="content">
      <h1><?= $berita->judul ?></h1>
      <img class="imgl" src="<?= base_url('assets/img/berita/'.$berita->gambar) ?>" width="400" align="left" />
      <?= $berita->isi ?>
      <?php if ($berita->attachment !== '') { ?>
      <p>
      <a target="blank" href="<?= base_url('assets/img/berita/'.$berita->attachment) ?>">Download File</a>
      </p>
      <?php } ?>
      
      <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=345250711962";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <!-- Your share button code -->
        <br/><br/>
        <div class="fb-share-button" data-href="<?= base_url('main/detailnews/'.$berita->id.'/'.  post_slug($berita->judul)) ?>" data-layout="button_count"></div>
    </div>
    <div id="column" class="scrollable" style="max-height: 900px; overflow-y: auto;">
        <h2>Berita Lainnya</h2>
        <ul class="news-on-detail">
            <?php foreach ($berita_lain as $data) { ?>
              <li>
                  <a href="#"><img src="<?= base_url('assets/img/berita/'.$data->gambar) ?>" alt="" style="width: 80px; height: 80px; float: left;" /></a>
                  <b><strong><a href="<?= base_url('main/detailnews/'.$data->id.'/'.post_slug($data->judul)) ?>"><?= $data->judul ?></a></strong></b><br/>
                  <small>Tanggal: <?= datetimefmysql($data->tanggal, true) ?></small>
                  <p><?= substr(strip_tags($data->isi), 0, 200) ?> ...</p>
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
    <div class="footbox">
      <h2>Kontak Kami</h2>
      <ul>
        <li>Alamat: <?= $contact->alamat ?> <?= $contact->kode_pos ?></li>
        <li>Telp: <?= $contact->telp ?></li>
        <li>Fax: <?= $contact->fax ?></li>
        <li>Email: <?= $contact->email ?></li>
        <li class="last">Website: <?= $contact->website ?></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<?= $this->load->view('footer') ?>
</body>
</html>
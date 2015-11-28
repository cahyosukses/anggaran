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
<link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png') ?>" />
<link rel="stylesheet" href="<?= base_url('assets/sched/styles/layout.css') ?>" type="text/css" />
<link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome-4.3.0/css/font-awesome.min.css') ?>" type="text/css" />
<script type="text/javascript" src="<?= base_url('assets/sched/scripts/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/sched/scripts/jquery.slidepanel.setup.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.nicescroll.js') ?>"></script>
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
      <li><a href="#">Home</a></li>
      <li>&#187;</li>
      <li class="current"><?= $title ?></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
      <h1>Hubungi Kami</h1>
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:400px;width:950px;"><div id="gmap_canvas" style="height:400px;width:950px;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.themecircle.net" id="get-map-data">themecircle</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:9,center:new google.maps.LatLng(-7.0150523,109.50597770000002),mapTypeId: google.maps.MapTypeId.HYBRID};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(-7.0150523, 109.50597770000002)});infowindow = new google.maps.InfoWindow({content:"<b>AKN Kajen</b><br/>Jalan Bahurekso No. 1<br/> Pekalongan" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
    
    <div>
        <ul style="list-style-type: square;">
        <li>Alamat: <?= $contact->alamat ?> <?= $contact->kode_pos ?></li>
        <li>Telp: <?= $contact->telp ?></li>
        <li>Fax: <?= $contact->fax ?></li>
        <li>Email: <?= $contact->email ?></li>
        <li class="last">Website: <?= $contact->website ?></li>
      </ul>
    </div>
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
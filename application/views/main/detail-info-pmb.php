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
    <h1><?= $info->judul ?></h1>
    <p><?= str_replace('assets/', base_url("").'assets/', $info->keterangan) ?></p>
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
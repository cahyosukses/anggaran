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
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/css/datepicker3.css') ?>" rel="stylesheet" />


<script type="text/javascript" src="<?= base_url('assets/sched/scripts/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/sched/scripts/jquery.slidepanel.setup.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.nicescroll.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.form.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootbox.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/library.js') ?>"></script>
<script type="text/javascript">
    $(function() {
        $('.wali').hide();
        $('#nama_lengkap').focus();
        $('#datepicker').datepicker({
            format: "dd/mm/yyyy"
        }).on('changeDate', function(){
            $(this).datepicker('hide');
        });
        
        $('.form-control').keyup(function(){
            if($(this).val() !== ''){
                dc_validation_remove(this);
            }
        });
        $('.form-control, input[type=radio]').change(function(){
            if($(this).val() !== ''){
                dc_validation_remove(this);
            }
        });
        
        $('input[type=text], textarea').css('text-transform','uppercase');
        $('input[type=text], textarea').keyup(function(){
            this.value = this.value.toUpperCase();
        });
        
        $('#biayai').change(function() {
            var value = $(this).val();
            if (value !== '') {
                if (value === 'Orang Tua') {
                    $('.wali').fadeOut('slow');
                } else {
                    $('.wali').fadeIn('slow');
                }
            } else {
                $('.wali').fadeOut('slow');
            }
        });
    });
    
    function reset_form() {
        $('input[type=text], input[type=hidden], select, textarea, input[type=file]').val('');
        $('input[type=radio]').removeAttr('checked');
    }
    
    function informasi(messages) {
        bootbox.dialog({
            message: messages,
            title: "Informasi",
            buttons: {
              ya: {
                label: '<i class="fa fa-thumbs-up"></i>  Oke',
                className: "btn-primary",
                callback: function() {

                }
              }
            }
        });
    }
    
    function konfirmasi_simpan() {
        if ($('#nama_lengkap').val() === '') {
            dc_validation('#nama_lengkap','Nama lengkap harus diisi !'); return false;
        }
        if ($('#tempat_lahir').val() === '') {
            dc_validation('#tempat_lahir','Tempat lahir harus diisi !'); return false;
        }
        if ($('#datepicker').val() === '') {
            dc_validation('#datepicker','Tanggal lahir harus diisi !'); return false;
        }
        if ($('#agama').val() === '') {
            dc_validation('#agama','Agama harus diisi !'); return false;
        }
        if ($('#jenis_kelamin').val() === '') {
            dc_validation('#jenis_kelamin','Jenis kelamin harus dipilih !'); return false;
        }
        if ($('#alamat_rumah').val() === '') {
            dc_validation('#tempat_lahir','Alamat rumah harus diisi beserta RT. RW !'); return false;
        }
        if ($('#desa').val() === '') {
            dc_validation('#desa','Desa harus diisi!'); return false;
        }
        if ($('#kecamatan').val() === '') {
            dc_validation('#kecamatan','Kecamatan harus diisikan !'); return false;
        }
        if ($('#kabupaten').val() === '') {
            dc_validation('#kabupaten','Kabupaten harus diisikan !'); return false;
        }
        if ($('#telp').val() === '') {
            dc_validation('#telp','Nomor telepon harus diisi !'); return false;
        }
        if ($('#nama_ayah').val() === '') {
            dc_validation('#nama_ayah','Nama Ayah harus diisi !'); return false;
        }
        if ($('#nama_ibu').val() === '') {
            dc_validation('#nama_ibu','Nama Ibu harus diisi !'); return false;
        }
        if ($('#pekerjaan_ayah').val() === '') {
            dc_validation('#pekerjaan_ayah','Pekerjaan Ayah harus diisi !'); return false;
        }
        if ($('#pekerjaan_ibu').val() === '') {
            dc_validation('#pekerjaan_ibu','Pekerjaan Ibu harus diisi !'); return false;
        }
        if ($('#penghasilan_ayah').val() === '') {
            dc_validation('#penghasilan_ayah','Rata rata penghasilan Ayah harus diisi !'); return false;
        }
        if ($('#penghasilan_ibu').val() === '') {
            dc_validation('#penghasilan_ibu','Rata rata penghasilan Ibu harus diisi !'); return false;
        }
        if ($('#biayai').val() === 'Wali') {
            if ($('#nama_wali').val() === '') {
                dc_validation('#nama_wali','Nama wali harus diisi !'); return false;
            }
            if ($('#hubungan_wali').val() === '') {
                dc_validation('#hubungan_wali','Hubungan dengan wali harus diisi !'); return false;
            }
            if ($('#penghasilan_wali').val() === '') {
                dc_validation('#penghasilan_wali','Nama wali harus diisi !'); return false;
            }
            if ($('#alamat_wali').val() === '') {
                dc_validation('#alamat_wali','Alamat wali harus diisi !'); return false;
            }
        }
        
        if ($('#asal_sekolah').val() === '') {
            dc_validation('#asal_sekolah','Asal sekolah harus diisi !'); return false;
        }
        if ($('#jurusan').val() === '') {
            dc_validation('#jurusan','Jurusan harus diisi !'); return false;
        }
        if ($('input[type=radio]').is(':checked') === false) {
            dc_validation('#status_label','Status sekolah harus dipilih !'); return false;
        }
        if ($('#alamat_sekolah').val() === '') {
            dc_validation('#alamat_sekolah','Alamat sekolah harus diisi !'); return false;
        }
        if ($('#telp_sekolah').val() === '') {
            dc_validation('#telp_sekolah','Telepon sekolah harus diisi !'); return false;
        }
        if ($('#pilihan1').val() === '') {
            dc_validation('#pilihan1','Pilihan program studi harus diisi !'); return false;
        }
        if ($('#biayai').val() === 'Orang Tua') {
            $('#nama_wali, #hubungan_wali, #penghasilan_wali, #alamat_wali').val('');
        }
        
        bootbox.dialog({
            message: 'Anda yakin akan menyimpan data pendaftaran ini,',
            title: "Peringatan",
            buttons: {
              Batal: {
                label: '<i class="fa fa-minus-circle"></i>  Batal',
                className: "btn",
                callback: function() {

                }
              },
              Oke: {
                label: '<i class="fa fa-check-circle"></i>  Ya',
                className: "btn-primary",
                callback: function() {
                    save_pendaftaran();
                }
              }
            }
        });
    }   

    function save_pendaftaran() {
        $('#form-pendaftaran').ajaxSubmit({
            target: '#output',
            dataType: 'json',
            data: $('#form-pendaftaran').serialize(),
            success: function(data) {
                if (data.status === false) {
                    informasi('Pendaftaran gagal di lakukan mohon cek kembali data yang anda masukkan !');
                } else {
                    informasi('<b>Pendaftaran berhasil di simpan</b>!, silahkan melengkapi berkas pendaftaran ke panitia pendaftaran sebagai validasi !')
                    reset_form();
                }
            }
        });
    }
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
      <li><a href="#">Home</a></li>
      <li>&#187;</li>
      <li class="current"><?= $title ?></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container" class="form-pendaftaran">
            <h2><?= $title ?> Tahun Ajaran <?= $tahun->tahun ?>/<?= ($tahun->tahun+1) ?> </h2>
            <p style="margin-left: 20px;">Catatan: Bagian yang ditandai dengan ( * ) adalah komponen yang harus diisikan secara lengkap</p>
            <form id="form-pendaftaran" action="<?= base_url('api/main/save_pendaftaran_sumb') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="tahun_ajaran" id="tahun_ajaran" value="<?= $tahun->tahun ?>" />
                <table class="formulir" width="70%" style="border: none; margin-left: 20px;" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2"><B>IDENTITAS PRIBADI</B></td></tr>
                    <tr><td width="30%">NAMA LENGKAP: *</td><td><input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" size="40"></td></tr>
                    <tr><td>TEMPAT LAHIR: *</td><td><input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"></td></tr>
                    <tr><td>TANGGAL LAHIR: ( dd/mm/yyyy )*</td><td><input style="width: 150px;" type="text" name="tanggal_lahir" size=10 id="datepicker" class="form-control"></td></tr>
                    <tr><td>AGAMA: *</td><td>
                        <select name="agama" id="agama" class="form-control">
                            <option value="">Pilih ...</option>
                        <?php foreach ($agama as $agm) { ?>
                                <option value="<?= $agm ?>"><?= $agm ?></option>
                        <?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr><td>JENIS KELAMIN: *</td><td><select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option selected="" value="">Silahkan Pilih</option>
                            <option value="L">laki-laki</option>
                            <option value="P">perempuan</option>
                            </select></td></tr>
                    <tr valign="top"><td>ALAMAT: *</td><td><textarea name="alamat_rumah" id="alamat_rumah" rows="4" class="form-control"></textarea></td></tr>
                    <tr><td>RT. / RW. / DESA: *</td><td>
                            <input type="text" name="rt" id="rt" class="form-control" style="width: 10%; float: left; margin-right: 3px;" />
                            <input type="text" name="rw" id="rw" class="form-control" style="width: 10%; float: left; margin-right: 3px;" />
                            <input type="text" name="desa" id="desa" class="form-control" style="width: 77%; float: right;" />
                    </td></tr>
                    <tr><td>KECAMATAN: *</td><td><input type="text" name="kecamatan" id="kecamatan" class="form-control"></td></tr>
                    <tr><td>KABUPATEN: *</td><td><input type="text" name="kabupaten" id="kabupaten" class="form-control"></td></tr>
                    <tr><td>NO. TELP. RUMAH / HP:</td><td><input type="text" name="telp" class="form-control"></td></tr>
                    <tr valign="top"><td>NAMA ORANG TUA</td>
                        <td>
                            <table width="100%" style="border: none;" cellspacing="0">
                                <tr>
                                    <td width="20%">AYAH:</td><td width="80%"><input type="text" name="nama_ayah" id="nama_ayah" class="form-control" /></td>
                                </tr>
                                <tr>
                                    <td width="20%">IBU:</td><td width="80%"><input type="text" name="nama_ibu" id="nama_ibu" class="form-control" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr valign="top"><td>PEKERJAAN ORANG TUA</td>
                        <td>
                            <table width="100%" style="border: none;" cellspacing="0">
                                <tr>
                                    <td width="20%">AYAH:</td><td width="80%"><input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" /></td>
                                </tr>
                                <tr>
                                    <td width="20%">IBU:</td><td width="80%"><input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr valign="top"><td>PENGHASILAN RATA-RATA</td>
                        <td>
                            <table width="100%" style="border: none;" cellspacing="0">
                                <tr>
                                    <td width="20%">AYAH:</td><td width="80%"><input type="text" onkeyup="FormNum(this);" name="penghasilan_ayah" id="penghasilan_ayah" class="form-control" style="width: 50%; float: left; margin-right: 5px;" /> PERBULAN</td>
                                </tr>
                                <tr>
                                    <td width="20%">IBU:</td><td width="80%"><input type="text" onkeyup="FormNum(this);" name="penghasilan_ibu" id="penghasilan_ibu" class="form-control" style="width: 50%; float: left; margin-right: 5px;"/> PERBULAN</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td>YANG MEMBIAYAI SEKOLAH *:</td><td>
                            <select name="biayai" id="biayai" class="form-control">
                                <option value="">Pilih ...</option>
                                <option value="Orang Tua">Orang Tua</option>
                                <option value="Wali">Wali</option>
                            </select>
                        </td></tr>
                    <tr class="wali"><td>NAMA WALI: *</td><td><input type="text" id="nama_wali" name="nama_wali" class="form-control" size="40"></td></tr>
                    <tr class="wali"><td>HUBUNGAN DENGAN WALI: *</td><td><input type="text" id="hubungan_wali" name="hubungan_wali" class="form-control" size="40"></td></tr>
                    <tr class="wali"><td>PENGHASILAN RATA-RATA: *</td><td><input type="text" id="penghasilan_wali" name="penghasilan_wali" class="form-control" size="40"></td></tr>
                    <tr class="wali" valign="top"><td>ALAMAT WALI: *</td><td><textarea name="alamat_wali" id="alamat_wali" rows="4" class="form-control"></textarea></td></tr>
                    <tr><td colspan="2">&nbsp;</td><td>
                    <tr><td colspan="2"><B>IDENTITAS SEKOLAH</B></td></tr>
                    <tr><td>ASAL SEKOLAH: *</td><td><input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control" size="40"></td></tr>
                    <tr><td>JURUSAN: *</td><td><input type="text" id="jurusan" name="jurusan" class="form-control" size="40"></td></tr>
                    <tr><td>STATUS SEKOLAH: *</td><td><input type="radio" name="status" id="negeri" value="Negeri" /> <label for="negeri">Negeri</label> <input type="radio" name="status" id="swasta" value="Swasta" /> <label for="swasta">Swasta </label> <span id="status_label"></span></td></tr>
                    <tr valign="top"><td>ALAMAT SEKOLAH: *</td><td><textarea name="alamat_sekolah" rows="4" id="alamat_sekolah" class="form-control"></textarea></td></tr>
                    <tr><td>NO. TELP. SEKOLAH: *</td><td><input type="text" id="telp_sekolah" name="telp_sekolah" class="form-control" size="40"></td></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td colspan="2"><B>PILIH PROGRAM STUDI</B></td></tr>
                    <tr><td></td><td>
                        <p>Untuk Jurusan IPA/SMK Teknik dapat memilih 2 Program Studi</p>
                        <p>Untuk Jurusan IPS/SMK Non Teknik hanya dapat memilih 1 Program Studi, yaitu Teknik Informatika</p>
                        <ol type="1">
                            <li>TEKNIK INFORMATIKA <br/>(Konsentrasi Teknik Rekayasa Perangkat Lunak)</li>
                            <li>TEKNIK KIMIA<br/>(Konsentrasi Teknik Kimia Tekstil)</li>
                            <li>TEKNIK MESIN<br/>(Konsentrasi Teknik Mekatronika)</li>
                        </ol>  
                        </td>
                    </tr>
                    <tr><td>PILIHAN 1: *</td><td>
                            <select id="pilihan1" name="pilihan1" class="form-control">
                                <option value="">Pilih ...</option>
                                <?php foreach ($jurusan as $key => $data) { ?>
                                <option value="<?= $data->id ?>"><?= $data->link ?></option>
                                <?php } ?>
                            </select></td></tr>
                    <tr><td>PILIHAN 2: *</td><td>
                            <select id="pilihan2" name="pilihan2" class="form-control">
                                <option value="">Pilih ...</option>
                                <?php foreach ($jurusan as $key => $data) { ?>
                                <option value="<?= $data->id ?>"><?= $data->link ?></option>
                                <?php } ?>
                            </select>
                        </td></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td colspan="2"><B>UPLOAD BERKAS PENDAFTARAN</B></td></tr>
                    <tr><td>SCAN IJASAH:</td><td><input type="file" name="ijasah" id="ijasah" /> </td></tr>
                    <tr><td>SCAN HASIL UN:</td><td><input type="file" name="hasil_un" id="hasil_un" /> </td></tr>
                    <tr><td>SCAN BUKTI PRESTASI Non AKADEMIK 1:</td><td><input type="file" name="bukti1" id="buktinonakad1" /> </td></tr>
                    <tr><td>SCAN BUKTI PRESTASI Non AKADEMIK 2:</td><td><input type="file" name="bukti2" id="buktinonakad2" /> </td></tr>
                    <tr><td>SCAN BUKTI PRESTASI Non AKADEMIK 3:</td><td><input type="file" name="bukti3" id="buktinonakad3" /> </td></tr>
                    <tr><td>SCAN BUKTI PRESTASI Non AKADEMIK 4:</td><td><input type="file" name="bukti4" id="buktinonakad4" /> </td></tr>
                    <tr><td></td><td>
                            <button  onclick="konfirmasi_simpan(); return false;" class="btn btn-primary btn-xlarge" ><i class="fa fa-save" style="font-size: 12px;"></i> Simpan Pendaftaran</button>
                            <button class="btn" onclick="reset_form(); return false;"><i class="fa fa-refresh"></i> Reset Data</button>
                        </td></tr>
                </table>
            </form>
    
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
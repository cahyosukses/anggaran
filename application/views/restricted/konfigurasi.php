<title><?= $title ?></title>
<script type="text/javascript">
    
    function save_config() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('api/restrictarea/save_config') ?>',
            data: $('#chpass').serialize(),
            dataType: 'json',
            success: function(data) {
                if (data === false) {
                    message_edit_failed();
                } else {
                    message_edit_success();
                }
            }
        });
    }
    
    function reset_form() {
        $('input, select, textarea').val('');
        $('#oldpict').html('');
        $('input[type=checkbox], input[type=radio]').removeAttr('checked');
    }

</script>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active"><?= $title ?></a></li>
      </ul>
      <div class="row">
        <div class="col-md-12">
          <div class="grid simple ">
            <div class="grid-title">
              <h4>Form Ubah Password</h4>
                <div class="tools"> 
                    
                </div>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <form id="chpass">
                        <div class="form-group">
                            <label class="form-label">Tahun Ajaran:</label>    
                            <div class="controls">
                                <input type="text" name="tahun" id="tahun" onkeyup="Angka(this);" maxlength="4" class="form-control" value="<?= $config->tahun ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="form-label">Aktifasi Menu Pendaftaran PMB PMDK:</label>
                            <div class="controls">
                                <select name="aktif_pmdk" id="aktif_pmdk" class="form-control">
                                    <option value="Aktif" <?= ($config->form_pmdk === 'Aktif')?'selected':'' ?>>Aktif</option>
                                    <option value="Tidak" <?= ($config->form_pmdk === 'Tidak')?'selected':'' ?>>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="form-label">Aktifasi Menu Pendaftaran PMB SUMB:</label>
                            <div class="controls">
                                <select name="aktif_sumb" id="aktif_sumb" class="form-control">
                                    <option value="Aktif"<?= ($config->form_sumb === 'Aktif')?'selected':'' ?>>Aktif</option>
                                    <option value="Tidak"<?= ($config->form_sumb === 'Tidak')?'selected':'' ?>>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="form-label"></label>
                            <div class="controls">
                                <button class="btn btn-info btn-cons" onclick="save_config(); return false;"><i class="fa fa-paste"></i> Simpan Konfigurasi</button>
                            </div>
                        </div>
                        </form>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END PAGE -->
    </div>
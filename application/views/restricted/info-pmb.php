<title><?= $title ?></title>
<script type="text/javascript">
    $(document).ready(function() {
    tinyMCE.init({
        selector: "textarea#isi",
        theme: "modern",
        menubar: "tools table format view insert edit",
        force_br_newlines : false,
        force_p_newlines : false,
        forced_root_block : '',
        valid_children : "+body[style],-body[div],p[strong|a|#text]",
        valid_elements : '*[*]',
        height: 300,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        setup: function(ed){
            ed.on("init",
                function(ed) {
                    tinyMCE.get('textarea#isi');
                    tinyMCE.execCommand('mceRepaint');
                }
            );
        }
    });
    });
    $(function() {
        //show_ajax_indicator();
        get_list_info_pendaftaran(1);
        $('#edit_info_pendaftaran').click(function() {
            $('#datamodal').modal('show');
            $('#datamodal h4.modal-title').html('Edit Detail Instansi');
            $.ajax({
                type: 'GET',
                url: '<?= base_url('api/restrictarea/info_pendaftarans') ?>/page/1/id/',
                dataType: 'json',
                success: function(data) {
                    if (data.jumlah > 0) {
                        $('#id').val(data.data[0].id);
                        $('#nama').val(data.data[0].judul);
                        $('#isi_keterangan').val(data.data[0].keterangan);
                        tinyMCE.activeEditor.setContent(data.data[0].keterangan);
                    }
                }
            });
        });

        $('#reload_info_pendaftaran').click(function() {
            reset_form();
            get_list_info_pendaftaran(1);
        });
    });
    
    function get_list_info_pendaftaran(p, id) {
        $('#form-pencarian').modal('hide');
        var id = '';
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/restrictarea/info_pendaftarans") ?>/page/'+p+'/id/'+id,
            data: '',
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                show_ajax_indicator();
            },
            success: function(data) {
                if (data.jumlah > 0) {
                    $('#judul_label').html(data.data[0].judul);
                    $('#informasi_label').html(data.data[0].keterangan);
                }
            },
            complete: function() {
                hide_ajax_indicator();
            },
            error: function(e){
                hide_ajax_indicator();
            }
        });
    }

    function reset_form() {
        $('input, select, textarea').val('');
        $('#oldpict').html('');
        $('input[type=checkbox], input[type=radio]').removeAttr('checked');
    }
        
    function paging(p) {
        get_list_info_pendaftaran(p);
    }

    function konfirmasi_save() {
        $('#isi_keterangan').val(tinyMCE.get('isi').getContent());
        bootbox.dialog({
            message: "Anda yakin akan menyimpan data ini?",
            title: "Konfirmasi Simpan",
            buttons: {
              batal: {
                label: '<i class="fa fa-times-circle"></i> Tidak',
                className: "btn-default",
                callback: function() {

                }
              },
              ya: {
                label: '<i class="fa fa-save"></i>  Ya',
                className: "btn-primary",
                callback: function() {
                    save_info_pendaftaran();
                }
              }
            }
          });
      }

    function save_info_pendaftaran() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('api/restrictarea/info_pendaftaran') ?>',
            dataType: 'json',
            data: $('#formadd').serialize(),
            beforeSend: function() {
                show_ajax_indicator();
            },
            success: function(msg) {
                var page = $('.pagination .active a').html();
                $('#datamodal').modal('hide');
                hide_ajax_indicator();
                message_edit_success();
                get_list_info_pendaftaran(1);
            },
            error: function() {
                $('#datamodal').modal('hide');
                var page = $('.pagination .active a').html();
                get_list_info_pendaftaran(page);
                hide_ajax_indicator();
            }
        });
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
              <h4>Kontak Kami</h4>
              <div class="tools"> 
                <button id="edit_info_pendaftaran" class="btn btn-info btn-mini"><i class="fa fa-plus-circle"></i> Edit</button>
                    <!--<button id="cari_button" class="btn btn-mini"><i class="fa fa-search"></i> Cari</button>-->
                <button id="reload_berita" class="btn btn-mini"><i class="fa fa-refresh"></i> Reload</button>
              </div>
            </div>
            <div class="grid-body">
              <div class="scroller" data-height="220px">
                  <table width="100%">
                      <tr valign="top">
                          <td>
                                <h4><span class="semi-bold">Judul:</span></h4>
                                <p id="judul_label"></p>
                                <h4><span class="semi-bold">Informasi:</span></h4>
                                <p id="informasi_label"></p>
                          </td>
                      </tr>
                  </table>
              </div>
            </div>
          </div>
            <div id="datamodal" class="modal fade">
                <div class="modal-dialog" style="width: 80%;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                <form id="formadd" method="post" role="form">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="isi_keterangan" id="isi_keterangan" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Judul PMB:</label>
                        <input type="text" name="nama"  class="form-control" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Keterangan:</label>
                        <textarea name="isi" class="isi" id="isi" rows="5"></textarea>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                  <button type="button" class="btn btn-primary" onclick="konfirmasi_save();"><i class="fa fa-save"></i> Simpan</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
      </div>
      </div>
      <!-- END PAGE -->
    </div>
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
        get_list_contact(1);
        $('#edit_contact').click(function() {
            $('#datamodal').modal('show');
            $('#datamodal h4.modal-title').html('Edit Detail Instansi');
            $.ajax({
                type: 'GET',
                url: '<?= base_url('api/restrictarea/contacts') ?>/page/1/id/',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.data[0].id);
                    $('#nama').val(data.data[0].nama);
                    $('#alamat').val(data.data[0].alamat);
                    $('#kode_pos').val(data.data[0].kode_pos);
                    $('#telp').val(data.data[0].telp);
                    $('#fax').val(data.data[0].fax);
                    $('#email').val(data.data[0].email);
                    $('#website').val(data.data[0].website);
                }
            });
        });

        $('#reload_contact').click(function() {
            reset_form();
            get_list_contact(1);
        });
    });
    
    function get_list_contact(p, id) {
        $('#form-pencarian').modal('hide');
        var id = '';
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/restrictarea/contacts") ?>/page/'+p+'/id/'+id,
            data: '',
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                show_ajax_indicator();
            },
            success: function(data) {
                $('#nama_instansi').html(data.data[0].nama);
                $('#alamat_instansi').html(data.data[0].alamat);
                $('#kode_pos_instansi').html(data.data[0].kode_pos);
                $('#telp_instansi').html(data.data[0].telp);
                $('#fax_instansi').html(data.data[0].fax);
                $('#email_instansi').html(data.data[0].email);
                $('#website_instansi').html(data.data[0].website);
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
        get_list_contact(p);
    }

    function konfirmasi_save() {
        
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
                    save_contact();
                }
              }
            }
          });
      }

    function save_contact() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('api/restrictarea/contact') ?>',
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
                get_list_contact(1);
            },
            error: function() {
                $('#datamodal').modal('hide');
                var page = $('.pagination .active a').html();
                get_list_contact(page);
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
                <button id="edit_contact" class="btn btn-info btn-mini"><i class="fa fa-plus-circle"></i> Edit</button>
                    <!--<button id="cari_button" class="btn btn-mini"><i class="fa fa-search"></i> Cari</button>-->
                <button id="reload_berita" class="btn btn-mini"><i class="fa fa-refresh"></i> Reload</button>
              </div>
            </div>
            <div class="grid-body">
              <div class="scroller" data-height="220px">
                  <table width="100%">
                      <tr valign="top">
                          <td width="50%">
                                <h4><span class="semi-bold">Nama Instansi:</span></h4>
                                <p id="nama_instansi"></p>
                                <h4><span class="semi-bold">Alamat:</span></h4>
                                <p id="alamat_instansi"></p>
                                <h4><span class="semi-bold">Kode Pos:</span></h4>
                                <p id="kode_pos_instansi"></p>
                                <h4><span class="semi-bold">Telp:</span></h4>
                                <p id="telp_instansi"></p>
                          </td>
                          <td width="50%">
                                <h4><span class="semi-bold">Fax:</span></h4>
                                <p id="fax_instansi"></p>
                                <h4><span class="semi-bold">Email:</span></h4>
                                <p id="email_instansi"></p>
                                <h4><span class="semi-bold">Website:</span></h4>
                                <p id="website_instansi"></p>
                          </td>
                      </tr>
                  </table>
              </div>
            </div>
          </div>
            <div id="datamodal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                <form id="formadd" method="post" role="form">
                    <input type="hidden" name="id" id="id" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nama Instansi:</label>
                        <input type="text" name="nama"  class="form-control" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Alamat:</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Kode Pos:</label>
                        <input type="text" name="kode_pos"  class="form-control" id="kode_pos">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Telephone:</label>
                        <input type="text" name="telp"  class="form-control" id="telp">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Fax:</label>
                        <input type="text" name="fax"  class="form-control" id="fax">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Email:</label>
                        <input type="text" name="email"  class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Website:</label>
                        <input type="text" name="website"  class="form-control" id="website">
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
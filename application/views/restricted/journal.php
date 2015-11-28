<title><?= $title ?></title>
<script type="text/javascript" src="<?= base_url('assets/tinymce/tinymce.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
    tinyMCE.init({
        selector: "textarea",
        theme: "modern",
        menubar: "tools table format view insert edit",
        force_br_newlines : false,
        force_p_newlines : false,
        forced_root_block : '',
        valid_children : "+body[style],-body[div],p[strong|a|#text]",
        valid_elements : '*[*]',
        height: 200,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        setup: function(ed){
            ed.on("init",
                function(ed) {
                    tinyMCE.get('textarea');
                    tinyMCE.execCommand('mceRepaint');
                }
            );
        }
    });
    });
    $(function() {
        $('#tanggal').datepicker({
            format: "dd/mm/yyyy"
        }).on('changeDate', function(){
            $(this).datepicker('hide');
        });
        get_list_journal(1);
        $('#add_journal').click(function() {
            reset_form();
            $('#datamodal').modal('show');
            $('#datamodal h4.modal-title').html('Tambah Journal');
            tinyMCE.activeEditor.setContent('');
        });

        $('#reload_journal').click(function() {
            reset_form();
            get_list_journal(1);
        });
    });
    
    function get_list_journal(p, id) {
        $('#form-pencarian').modal('hide');
        var id = '';
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/restrictarea/journals") ?>/page/'+p+'/id/'+id,
            data: '',
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                show_ajax_indicator();
            },
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_alumni(p-1);
                    return false;
                };

                $('#pagination_no').html(pagination(data.jumlah, data.limit, data.page, 1));
                $('#page_summary_no').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#load_data_table tbody').empty();          
                var str = '';

                $.each(data.data,function(i, v){
                    var highlight = 'odd';
                    if ((i % 2) === 1) {
                        highlight = 'even';
                    };
                    str = '<tr class="'+highlight+'">'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+datefmysql(v.tanggal)+'</td>'+
                            '<td>'+v.judul+'</td>'+
                            '<td>'+v.penulis+'</td>'+
                            '<td align="center" class=aksi>'+
                                '<button type="button" class="btn btn-default btn-mini" onclick="edit_journal(\''+v.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                '<button type="button" class="btn btn-default btn-mini" onclick="delete_journal(\''+v.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
                            '</td>'+
                        '</tr>';
                    $('#load_data_table tbody').append(str);
                    no = v.id;
                });                
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

    function edit_journal(id) {
        $('#oldpict').html('');
        $('#datamodal').modal('show');
        $('#datamodal h4.modal-title').html('Edit Journal');
        $.ajax({
            type: 'GET',
            url: '<?= base_url('api/restrictarea/journals') ?>/page/1/id/'+id,
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.data[0].id);
                $('#tanggal').val(datefmysql(data.data[0].tanggal));
                $('#gambar').val(data.data[0].file);
                $('#judul').val(data.data[0].judul);
                $('#penulis').val(data.data[0].penulis);
                $('#kategori').val(data.data[0].id_journal_category);
                tinyMCE.get('isi').setContent(data.data[0].abstract_id);
                tinyMCE.get('isi_en').setContent(data.data[0].abstract_en);
                $('#keywords_id').val(data.data[0].keywords_id);
                $('#keywords_en').val(data.data[0].keywords_en);
                $('#oldpict').html('<a target="blank" href="<?= base_url('assets/img/journal') ?>/'+data.data[0].file+'">Klik untuk melihat file</a>');
            }
        });
    }
        
    function paging(p) {
        get_list_journal(p);
    }

    function konfirmasi_save() {
        $('#isi_journal').val(tinyMCE.get('isi').getContent());
        $('#isi_journal_en').val(tinyMCE.get('isi_en').getContent());
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
                    save_journal();
                }
              }
            }
          });
      }

    function save_journal() {
        $('#formadd').ajaxSubmit({
            target: '#output',
            dataType: 'json',
            data: $('#formadd').serialize(),
            beforeSend: function() {
                show_ajax_indicator();
            },
            success: function(msg) {
                var page = $('.pagination .active a').html();
                $('#datamodal').modal('hide');
                hide_ajax_indicator();
                $('input[type=text],input[type=file], select').val('');
                if (msg.act === 'add') {
                    message_add_success();
                    get_list_journal(1);
                } else {
                    message_edit_success();
                    get_list_journal(page);
                }
            },
            error: function() {
                hide_ajax_indicator();
            }
        });
    }

    function delete_journal(id, page) {
        bootbox.dialog({
            message: "Anda yakin akan menghapus data ini?",
            title: "Konfirmasi Hapus",
            buttons: {
              batal: {
                label: '<i class="fa fa-times-circle"></i> Tidak',
                className: "btn-default",
                callback: function() {

                }
              },
              ya: {
                label: '<i class="fa fa-trash"></i>  Ya',
                className: "btn-primary",
                callback: function() {
                    $.ajax({
                        type: 'DELETE',
                        url: '<?= base_url('api/restrictarea/journal') ?>/id/'+id,
                        dataType: 'json',
                        success: function(data) {
                            message_delete_success();
                            get_list_journal(page);
                        }
                    });
                }
              }
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
              <h4>Daftar List Journal</h4>
              <div class="tools"> 
                    <button id="add_journal" class="btn btn-info btn-mini"><i class="fa fa-plus-circle"></i> Tambah</button>
                    <!--<button id="cari_button" class="btn btn-mini"><i class="fa fa-search"></i> Cari</button>-->
                    <button id="reload_journal" class="btn btn-mini"><i class="fa fa-refresh"></i> Reload</button>
                </div>
            </div>
            <div class="grid-body">
              <div class="scroller" data-height="220px">
                <div id="result">
                    <table class="table table-bordered table-stripped table-hover" id="load_data_table">
                        <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th width="20%" class="left">Tanggal</th>
                          <th width="55%" class="left">Nama Journal</th>
                          <th width="10%" class="left">Penulis</th>
                          <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div id="pagination_no" class="pagination"></div>
                    <div class="page_summary" id="page_summary_no"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div id="datamodal" class="modal fade">
        <div class="modal-dialog" style="width: 800px">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <form id="formadd" action="<?= base_url('api/restrictarea/journal') ?>" method="POST" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="gambar" id="gambar" />
            <input type="hidden" name="isi_journal" id="isi_journal" />
            <input type="hidden" name="isi_journal_en" id="isi_journal_en" />
            <div class="form-group">
                <label for="recipient-name" class="control-label">Tanggal:</label>
                <input type="text" name="tanggal"  class="form-control" id="tanggal" value="<?= date("d/m/Y") ?>">
            </div>
            <div class="form-group">
                <label for="kategori" class="control-label">Kategori Jurnal:</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="">Pilih ...</option>
                    <?php foreach ($kategori as $data) { ?>
                    <option value="<?= $data->id ?>"><?= $data->nama ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="penulis" class="control-label">Penulis <span class="help">Jika penulis lebih dari satu, pisahkan dengan tanda ";"</span> :</label>
                <input type="text" name="penulis"  class="form-control" id="penulis">
            </div>
            <div class="form-group">
                <label for="judul" class="control-label">Judul:</label>
                <input type="text" name="judul"  class="form-control" id="judul">
            </div>
            <div class="form-group">
                <label for="isi" class="control-label">Abstrak <span class="help">Bhs Indonesia]</span>:</label>
                <textarea name="isi" id="isi" class="form-control isi"></textarea>
            </div>
            <div class="form-group">
                <label for="keyword_id" class="control-label">Keywords <span class="help">Bhs Indonesia</span>:</label>
                <input name="keywords_id" id="keywords_id" class="form-control" />
            </div>
            <div class="form-group">
                <label for="isi_en" class="control-label">Abstrak <span class="help">Bhs Inggris</span>:</label>
                <textarea name="isi_en" id="isi_en" class="form-control isi_en"></textarea>
            </div>
            <div class="form-group">
                <label for="keyword_en" class="control-label">Keywords <span class="help">Bhs Inggris</span>:</label>
                <input name="keywords_en" id="keywords_en" class="form-control" />
            </div>
            <div class="form-group">
                <label class="control-label">File Upload:</label>
                <input type="file" name="mFile"  id="mFile" />
                <span id="output"></span>
            </div>
            <div class="form-group">
                <label class="control-label"></label>
                <div id="oldpict">

                </div>
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
        
      <!-- END PAGE -->
    </div>
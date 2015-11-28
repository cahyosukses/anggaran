<title><?= $title ?></title>
<script type="text/javascript">
    $(function() {
        //show_ajax_indicator();
        get_list_journal_category(1);
        $('#add_journal_category').click(function() {
            reset_form();
            $('#datamodal').modal('show');
            $('#datamodal h4.modal-title').html('Tambah Kategori Journal');
        });

        $('#reload_journal_category').click(function() {
            reset_form();
            get_list_journal_category(1);
        });
    });
    
    function get_list_journal_category(p, id) {
        $('#form-pencarian').modal('hide');
        var id = '';
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/restrictarea/journal_categorys") ?>/page/'+p+'/id/'+id,
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
                            '<td>'+v.nama+'</td>'+
                            '<td align="center" class=aksi>'+
                                '<button type="button" class="btn btn-default btn-mini" onclick="edit_journal_category(\''+v.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                '<button type="button" class="btn btn-default btn-mini" onclick="delete_journal_category(\''+v.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
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

    function edit_journal_category(id) {
        $('#oldpict').html('');
        $('#datamodal').modal('show');
        $('#datamodal h4.modal-title').html('Edit Kategori Journal');
        $.ajax({
            type: 'GET',
            url: '<?= base_url('api/restrictarea/journal_categorys') ?>/page/1/id/'+id,
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.data[0].id);
                $('#judul').val(data.data[0].nama);
            }
        });
    }
        
    function paging(p) {
        get_list_journal_category(p);
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
                    save_journal_category();
                }
              }
            }
          });
      }

    function save_journal_category() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('api/restrictarea/journal_category') ?>',
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
                    get_list_journal_category(1);
                } else {
                    message_edit_success();
                    get_list_journal_category(page);
                }
            },
            error: function() {
                $('#datamodal').modal('hide');
                var page = $('.pagination .active a').html();
                get_list_journal_category(page);
                hide_ajax_indicator();
            }
        });
    }

    function delete_journal_category(id, page) {
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
                        url: '<?= base_url('api/restrictarea/journal_category') ?>/id/'+id,
                        dataType: 'json',
                        success: function(data) {
                            message_delete_success();
                            get_list_journal_category(page);
                        }
                    });
                }
              }
            }
        });
    }

    function paging(page, tab, search) {
        get_list_journal_category(page, search);
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
              <h4>Daftar List Kategori Journal</h4>
              <div class="tools"> 
                    <button id="add_journal_category" class="btn btn-info btn-mini"><i class="fa fa-plus-circle"></i> Tambah</button>
                    <!--<button id="cari_button" class="btn btn-mini"><i class="fa fa-search"></i> Cari</button>-->
                    <button id="reload_journal_category" class="btn btn-mini"><i class="fa fa-refresh"></i> Reload</button>
                </div>
            </div>
            <div class="grid-body">
              <div class="scroller" data-height="220px">
                <div id="result">
                    <table class="table table-bordered table-stripped table-hover" id="load_data_table">
                        <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th width="85%" class="left">Nama Kategori Journal</th>
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
        <form id="formadd" method="post" role="form">
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="gambar" id="gambar" />
            <input type="hidden" name="isi_journal_category" id="isi_journal_category" />
            <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Kategori:</label>
                <input type="text" name="judul"  class="form-control" id="judul">
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
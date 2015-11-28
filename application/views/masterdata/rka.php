<title><?= $title ?></title>
<script type="text/javascript">
    $(function() {
        
        get_list_rka(1);
        $('#add_rka').click(function() {
            reset_form();
            $('#datamodal').modal('show');
            $('#datamodal h4.modal-title').html('Tambah RKA');
            //tinyMCE.activeEditor.setContent('');
        });

        $('#reload_rka').click(function() {
            reset_form();
            get_list_rka(1);
        });
    });
    
    function get_list_rka(p, id) {
        $('#form-pencarian').modal('hide');
        var id = '';
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/masterdata/rkas") ?>/page/'+p+'/id/'+id,
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

                $('#example-advanced tbody').empty();          
                

                $.each(data.data,function(i, v){
                    var str = '';
                    var highlight = 'odd';
                    if ((i % 2) === 1) {
                        highlight = 'even';
                    };
                    str+= '<tr data-tt-id='+i+' class="'+highlight+'">'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+v.kode+'</td>'+
                            '<td>'+v.nama_program+'</td>'+
                            '<td>-</td>'+
                            '<td align="center" class=aksi>'+
                                '<button type="button" class="btn btn-default btn-mini" onclick="edit_rka(\''+v.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                '<button type="button" class="btn btn-default btn-mini" onclick="delete_rka(\''+v.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
                            '</td>'+
                        '</tr>';
                        $.each(v.child1, function(i2, v2) {
                            str+= '<tr data-tt-id='+i+'-'+i2+' data-tt-parent-id='+i+' class="'+highlight+'">'+
                                '<td align="center"></td>'+
                                '<td>'+v2.kode+'</td>'+
                                '<td style="text-indent: 20px;">'+v2.nama_program+'</td>'+
                                '<td>-</td>'+
                                '<td align="center" class=aksi>'+
                                    '<button type="button" class="btn btn-default btn-mini" onclick="edit_rka(\''+v2.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                    '<button type="button" class="btn btn-default btn-mini" onclick="delete_rka(\''+v2.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
                                '</td>'+
                            '</tr>';
                            $.each(v2.child2, function(i3, v3) {
                                str+= '<tr data-tt-id='+i+'-'+i2+'-'+i3+' data-tt-parent-id='+i+'-'+i2+' class="'+highlight+'">'+
                                    '<td align="center"></td>'+
                                    '<td>'+v3.kode+'</td>'+
                                    '<td style="text-indent: 40px;">'+v3.nama_program+'</td>'+
                                    '<td>-</td>'+
                                    '<td align="center" class=aksi>'+
                                        '<button type="button" class="btn btn-default btn-mini" onclick="edit_rka(\''+v3.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                        '<button type="button" class="btn btn-default btn-mini" onclick="delete_rka(\''+v3.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
                                    '</td>'+
                                '</tr>';
                                $.each(v3.child3, function(i4, v4) {
                                    str+= '<tr data-tt-id='+i+'-'+i2+'-'+i3+'-'+i4+' data-tt-parent-id='+i+'-'+i2+'-'+i3+' class="'+highlight+'">'+
                                        '<td align="center"></td>'+
                                        '<td>'+v4.kode+'</td>'+
                                        '<td style="text-indent: 60px;">'+v4.nama_program+'</td>'+
                                        '<td>-</td>'+
                                        '<td align="center" class=aksi>'+
                                            '<button type="button" class="btn btn-default btn-mini" onclick="edit_rka(\''+v4.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                            '<button type="button" class="btn btn-default btn-mini" onclick="delete_rka(\''+v4.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
                                        '</td>'+
                                    '</tr>';
                                    $.each(v4.child4, function(i5, v5) {
                                        str+= '<tr data-tt-id='+i+'-'+i2+'-'+i3+'-'+i4+'-'+i5+' data-tt-parent-id='+i+'-'+i2+'-'+i3+'-'+i4+' class="'+highlight+'">'+
                                            '<td align="center"></td>'+
                                            '<td>'+v5.kode+'</td>'+
                                            '<td style="text-indent: 80px;">'+v5.nama_program+'</td>'+
                                            '<td>-</td>'+
                                            '<td align="center" class=aksi>'+
                                                '<button type="button" class="btn btn-default btn-mini" onclick="edit_rka(\''+v5.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                                '<button type="button" class="btn btn-default btn-mini" onclick="delete_rka(\''+v5.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
                                            '</td>'+
                                        '</tr>';
                                    });
                                });
                            });
                        });
                    $('#example-advanced tbody').append(str);
                    $("#example-advanced").treetable({ expandable: true });
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

    function edit_rka(id) {
        $('#oldpict').html('');
        $('#datamodal').modal('show');
        $('#datamodal h4.modal-title').html('Edit RKA');
        $.ajax({
            type: 'GET',
            url: '<?= base_url('api/restrictarea/rkas') ?>/page/1/id/'+id,
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.data[0].id);
                $('#judul').val(data.data[0].judul);
                tinyMCE.activeEditor.setContent(data.data[0].isi);
                $('#gambar').val(data.data[0].gambar);
                $('#oldpict').html('<img src="<?= base_url('assets/img/rka') ?>/'+data.data[0].gambar+'" width="300px;" />');
                if (data.data[0].attachment !== '') {
                    $('#oldattachment').html('<a target="blank" href="<?= base_url('assets/img/rka') ?>/'+data.data[0].attachment+'" >Download File </a> <i title="Klik untuk menghapus file" onclick="removeFile('+data.data[0].id+');" class="fa fa-times-circle"></i>');
                }
            }
        });
    }
    
    function removeFile(id) {
        bootbox.dialog({
            message: "Anda yakin akan menghapus file ini?",
            title: "Konfirmasi Simpan",
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
                        url: '<?= base_url('api/restrictarea/rka_file') ?>/id/'+id,
                        success: function(data) {
                            message_delete_success();
                            $('#oldattachment').empty();
                        }
                    });
                }
              }
            }
        });
    }
        
    function paging(p) {
        get_list_rka(p);
    }

    function konfirmasi_save() {
        $('#isi_rka').val(tinyMCE.get('isi').getContent());
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
                    save_rka();
                }
              }
            }
          });
      }

    function save_rka() {
        $('#formadd').ajaxSubmit({
            target: '#output',
            dataType: 'json',
            data: $('#formadd').serialize()+'&isi='+tinyMCE.activeEditor.getContent(),
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
                    get_list_rka(1);
                } else {
                    message_edit_success();
                    get_list_rka(page);
                }
            },
            error: function() {
                $('#datamodal').modal('hide');
                var page = $('.pagination .active a').html();
                get_list_rka(page);
                hide_ajax_indicator();
            }
        });
    }

    function delete_rka(id, page) {
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
                        url: '<?= base_url('api/restrictarea/rka') ?>/id/'+id,
                        dataType: 'json',
                        success: function(data) {
                            message_delete_success();
                            get_list_rka(page);
                        }
                    });
                }
              }
            }
        });
    }

    function paging(page, tab, search) {
        get_list_rka(page, search);
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
              <h4>Daftar List RKA</h4>
                <div class="tools"> 
                    <button id="add_rka" class="btn btn-info btn-mini"><i class="fa fa-plus-circle"></i> Tambah</button>
                    <!--<button id="cari_button" class="btn btn-mini"><i class="fa fa-search"></i> Cari</button>-->
                    <button id="reload_rka" class="btn btn-mini"><i class="fa fa-refresh"></i> Reload</button>
                </div>
            </div>
            <div class="grid-body">
              <div class="scroller" data-height="220px">
                <div id="result">
                    <table class="table table-bordered table-stripped table-hover tabel-advance" id="example-advanced">
                        <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th width="10%" class="left">No. Kode</th>
                          <th width="65%" class="left">Uraian</th>
                          <th width="10%" class="left">Jumlah</th>
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
        <div id="datamodal" class="modal fade">
            <div class="modal-dialog" style="width: 800px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('api/restrictarea/rka') ?>" id="formadd" method="post" role="form" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" />
                <input type="hidden" name="gambar" id="gambar" />
                <input type="hidden" name="attachment" id="attachment" />
                <input type="hidden" name="isi_rka" id="isi_rka" />
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kode RKA:</label>
                    <input type="text" name="judul"  class="form-control" id="judul">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Uraian:</label>
                    <textarea name="isi" id="isi" class="isi form-control"></textarea>
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
      <!-- END PAGE -->
    </div>
<title><?= $title ?></title>
<script type="text/javascript">
    $(function() {
        
        get_list_pencairan(1);
        $('#add_pencairan').click(function() {
            reset_form();
            $('#datamodal').modal('show');
            $('#datamodal h4.modal-title').html('Tambah Transaksi Pencairan Bank');
            //tinyMCE.activeEditor.setContent('');
        });
        
        $('#tanggal, #tanggal_kegiatan').datepicker({
                format: 'dd/mm/yyyy'
        }).on('changeDate', function(){
            $(this).datepicker('hide');
        });

        $('#reload_pencairan').click(function() {
            reset_form();
            get_list_pencairan(1);
        });
        
        $('#nourut').select2({
            width: '100%',
            ajax: {
                url: "<?= base_url('api/masterdata_auto/rka_trans_auto') ?>",
                dataType: 'json',
                quietMillis: 100,
                data: function (term, page) { // page is the one-based page number tracked by Select2
                    return {
                        q: term, //search term
                        page: page, // page number
                        level: 4
                    };
                },
                results: function (data, page) {
                    var more = (page * 20) < data.total; // whether or not there are more results available
         
                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {results: data.data, more: more};
                }
            },
            formatResult: function(data){
                var markup = data.kode+'<br/>'+data.nama_program;
                return markup;
            }, 
            formatSelection: function(data){
                $('#s2id_nokode a .select2-chosen').html('');
                $('#nokode').val('');
                $('#uraian').val(data.nama_program);
                return data.kode;
            }
        });
        
        $('#nokode').select2({
            width: '100%',
            ajax: {
                url: "<?= base_url('api/masterdata_auto/rka_trans_auto') ?>",
                dataType: 'json',
                quietMillis: 100,
                data: function (term, page) { // page is the one-based page number tracked by Select2
                    return {
                        q: term, //search term
                        page: page, // page number
                        parent: $('#nourut').val()
                    };
                },
                results: function (data, page) {
                    var more = (page * 20) < data.total; // whether or not there are more results available
         
                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {results: data.data, more: more};
                }
            },
            formatResult: function(data){
                var markup = data.kode+'<br/>'+data.nama_program;
                return markup;
            }, 
            formatSelection: function(data){
                $('#uraian').val(data.nama_program);
                return data.kode;
            }
        });
    });
    
    function get_list_pencairan(p, id) {
        $('#form-pencarian').modal('hide');
        var id = '';
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/transaksi/pencairans") ?>/page/'+p+'/id/'+id,
            data: '',
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                show_ajax_indicator();
                //$("#example-advanced").treetable('destroy');
            },
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_pencairan(p-1);
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
                            '<td align="center">'+datefmysql(v.tanggal)+'</td>'+
                            //'<td align="center">'+v.nourut+'</td>'+
                            '<td>'+v.no_bukti+'</td>'+
                            '<td>'+v.kode+'</td>'+
                            '<td>'+v.uraian+'</td>'+
                            '<td align="right">'+numberToCurrency(v.nominal)+'</td>'+
                            '<td>'+v.penerima+'</td>'+
                            '<td align="right" class=aksi>'+
                                '<button type="button" class="btn btn-default btn-mini" onclick="print_pencairan(\''+v.id+'\')"><i class="fa fa-print"></i></button> '+
                                '<button type="button" class="btn btn-default btn-mini" onclick="edit_pencairan(\''+v.id+'\')"><i class="fa fa-pencil"></i></button> '+
                                '<button type="button" class="btn btn-default btn-mini" onclick="delete_pencairan(\''+v.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
                            '</td>'+
                        '</tr>';
                    $('#example-advanced tbody').append(str);
                });
            },
            complete: function() {
                hide_ajax_indicator();
                //$("#example-advanced").treetable({ expandable: true });
            },
            error: function(e){
                hide_ajax_indicator();
            }
        });
    }
    
    function print_pencairan(id) {
        var wWidth = $(window).width();
        var dWidth = wWidth * 1;
        var wHeight= $(window).height();
        var dHeight= wHeight * 1;
        var x = screen.width/2 - dWidth/2;
        var y = screen.height/2 - dHeight/2;
        window.open('<?= base_url('transaksi/print_pencairan/') ?>?id='+id,'Cetak Transaksi Pencairan','width='+dWidth+', height='+dHeight+', left='+x+',top='+y);
    }

    function reset_form() {
        $('input, select, textarea').val('');
        $('input[type=checkbox], input[type=radio]').removeAttr('checked');
        $('a .select2-chosen').html('');
        $('#tanggal, #tanggal_kegiatan').val('<?= date("d/m/Y") ?>');
    }

    function edit_pencairan(id) {
        $('#oldpict').html('');
        $('#datamodal').modal('show');
        $('#datamodal h4.modal-title').html('Edit Transaksi Pencairan Bank');
        $.ajax({
            type: 'GET',
            url: '<?= base_url('api/transaksi/pencairans') ?>/page/1/id/'+id,
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.data[0].id);
                $('#tanggal').val(datefmysql(data.data[0].tanggal));
                $('#tanggal_kegiatan').val(datefmysql(data.data[0].tanggal_kegiatan));
                $('#nourut').val(data.data[0].id_parent);
                $('#s2id_nourut a .select2-chosen').html(data.data[0].parent_program);
                $('#nokode').val(data.data[0].id_rka);
                $('#nobukti').val(data.data[0].no_bukti);
                $('#s2id_nokode a .select2-chosen').html(data.data[0].kode+' '+data.data[0].nama_program);
                $('#uraian').val(data.data[0].uraian);
                $('#satuan').val(data.data[0].satuan);
                $('#volume').val(data.data[0].volume);
                $('#nominal').val(numberToCurrency(data.data[0].nominal));
                $('#penerima').val(data.data[0].penerima);
            }
        });
    }
        
    function paging(p) {
        get_list_pencairan(p);
    }

    function konfirmasi_save() {
        //$('#isi_pencairan').val(tinyMCE.get('isi').getContent());
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
                    save_pencairan();
                }
              }
            }
          });
      }

    function save_pencairan() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('api/transaksi/pencairan') ?>',
            dataType: 'json',
            data: $('#formadd').serialize(),
            beforeSend: function() {
                show_ajax_indicator();
            },
            success: function(msg) {
                var page = $('.pagination .active a').html();
                hide_ajax_indicator();
                $('#judul, #isi, #nominal').val('');
                //reset_form();
                if (msg.act === 'add') {
                    $('#datamodal').modal('hide');
                    message_add_success();
                    get_list_pencairan(1);
                } else {
                    $('#datamodal').modal('hide');
                    message_edit_success();
                    get_list_pencairan(page);
                }
            },
            error: function() {
                $('#datamodal').modal('hide');
                var page = $('.pagination .active a').html();
                get_list_pencairan(page);
                hide_ajax_indicator();
            }
        });
    }

    function delete_pencairan(id, page) {
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
                        url: '<?= base_url('api/transaksi/pencairan') ?>/id/'+id,
                        dataType: 'json',
                        success: function(data) {
                            message_delete_success();
                            get_list_pencairan(page);
                        }
                    });
                }
              }
            }
        });
    }

    function paging(page, tab, search) {
        get_list_pencairan(page);
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
              <h4>Daftar List <?= $title ?></h4>
                <div class="tools"> 
                    <button id="add_pencairan" class="btn btn-info btn-mini"><i class="fa fa-plus-circle"></i> Tambah</button>
                    <!--<button id="cari_button" class="btn btn-mini"><i class="fa fa-search"></i> Cari</button>-->
                    <button id="reload_pencairan" class="btn btn-mini"><i class="fa fa-refresh"></i> Reload</button>
                </div>
            </div>
            <div class="grid-body">
              <div class="scroller" data-height="220px">
                <div id="result">
                    <table class="table table-bordered table-stripped table-hover tabel-advance" id="example-advanced">
                        <thead>
                        <tr>
                          <th width="3%">No</th>
                          <th width="7%">Tanggal</th>
                          <!--<th width="3%" class="left">Urut</th>-->
                          <th width="10%" class="left">No. Bukti</th>
                          <th width="7%">Kode&nbsp;RKA</th>
                          <th width="40%" class="left">Uraian</th>
                          <th width="10%" class="right">Jumlah</th>
                          <th width="10%" class="left">Penerima</th>
                          <th width="13%"></th>
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
            <div class="modal-dialog" style="width: 700px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="formadd" method="post" role="form">
                <input type="hidden" name="id" id="id" />
                <div class="form-group">
                    <label class="control-label">Tanggal Pencairan:</label>
                    <input type="text" name="tanggal" class="form-control" style="width: 145px;" id="tanggal" value="<?= date("d/m/Y") ?>" />
                </div>
                <div class="form-group">
                    <label class="control-label">Tanggal Kegiatan:</label>
                    <input type="text" name="tanggal_kegiatan" class="form-control" style="width: 145px;" id="tanggal_kegiatan" value="<?= date("d/m/Y") ?>" />
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">No. Urut:</label>
                    <input type="text" name="nourut"  class="js-data-example-ajax" id="nourut">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">No. Kode RKA:</label>
                    <input type="text" name="nokode"  class="js-data-example-ajax" id="nokode" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">No. Bukti:</label>
                    <input type="text" name="nobukti"  class="form-control" id="nobukti" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Uraian <i>Memorial</i>:</label>
                    <textarea name="uraian" class="form-control" id="uraian"></textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Satuan</label>
                    <input type="text" name="satuan"  class="form-control" id="satuan" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Volume:</label>
                    <input type="text" name="volume"  class="form-control" id="volume" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Jumlah:</label>
                    <input type="text" name="nominal"  class="form-control" onkeyup="FormNum(this);" id="nominal">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Penerima:</label>
                    <input type="text" name="penerima" class="form-control" id="penerima" />
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
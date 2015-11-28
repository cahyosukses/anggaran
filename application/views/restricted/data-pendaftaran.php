<title><?= $title ?></title>
<script type="text/javascript">
    $(function() {
        get_list_pmb(1);
        $('#search_pmb').click(function() {
            $('#datamodal').modal('show');
            $('#datamodal h4.modal-title').html('Cari Data PMB');
        });

        $('#reload_pmb').click(function() {
            reset_form();
            get_list_pmb(1);
        });
        
        $('#awal, #akhir').datepicker({
            format: "dd/mm/yyyy"
        }).on('changeDate', function(){
            $(this).datepicker('hide');
        });
        
        $('#export_button').click(function() {
            window.location='<?= base_url('restrictarea/export_pendaftar') ?>/?'+$('#formsearch').serialize();
        });
    });
    
    function print_pmb(id_daftar) {
        
    }
    
    function detail_pmb(id) {
        $('#datamodal-detail').modal('show');
        $('#load-images').empty();
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/restrictarea/pmbs") ?>/page/1/id/'+id,
            data: $('#formsearch').serialize(),
            cache: false,
            dataType: 'json',
            success: function(data) {
                if (data.data[0].ijasah !== '') {
                    $('#load-images').append('<h4>IJASAH</h4><img src="<?= base_url('assets/img/pendaftaran') ?>/'+data.data[0].ijasah+'" width="1024px" /><br/><a href="<?= base_url('assets/img/pendaftaran') ?>" download="'+data.data[0].ijasah+'" title="ImageName">Download Ijasah</a><br/><br/>');
                }
                if (data.data[0].hasil_un !== '') {
                    $('#load-images').append('<h4>HASIL UN</h4><img src="<?= base_url('assets/img/pendaftaran') ?>/'+data.data[0].hasil_un+'" width="1024px" /><br/><a href="<?= base_url('assets/img/pendaftaran') ?>" download="'+data.data[0].hasil_un+'" title="ImageName">Download Hasil UN</a><br/><br/>');
                }
                if (data.data[0].bukti1 !== '') {
                    $('#load-images').append('<h4>BUKTI NON AKADEMIK 1</h4><img src="<?= base_url('assets/img/pendaftaran') ?>/'+data.data[0].bukti1+'" width="1024px" /><br/><a href="<?= base_url('assets/img/pendaftaran') ?>" download="'+data.data[0].bukti1+'" title="ImageName">Download Bukti 1</a><br/><br/>');
                }
                if (data.data[0].bukti2 !== '') {
                    $('#load-images').append('<h4>BUKTI NON AKADEMIK 2</h4><img src="<?= base_url('assets/img/pendaftaran') ?>/'+data.data[0].bukti2+'" width="1024px" /><br/><a href="<?= base_url('assets/img/pendaftaran') ?>" download="'+data.data[0].bukti2+'" title="ImageName">Download Bukti 2</a><br/><br/>');
                }
                if (data.data[0].bukti3 !== '') {
                    $('#load-images').append('<h4>BUKTI NON AKADEMIK 3</h4><img src="<?= base_url('assets/img/pendaftaran') ?>/'+data.data[0].bukti3+'" width="1024px" /><br/><a href="<?= base_url('assets/img/pendaftaran') ?>" download="'+data.data[0].bukti3+'" title="ImageName">Download Bukti 3</a><br/><br/>');
                }
                if (data.data[0].bukti4 !== '') {
                    $('#load-images').append('<h4>BUKTI NON AKADEMIK 4</h4><img src="<?= base_url('assets/img/pendaftaran') ?>/'+data.data[0].bukti4+'" width="1024px" /><br/><a href="<?= base_url('assets/img/pendaftaran') ?>" download="'+data.data[0].bukti4+'" title="ImageName">Download Bukti 4</a><br/><br/>');
                }
            }
        });
    }
    
    function get_list_pmb(p, id) {
        $('#datamodal').modal('hide');
        var id = '';
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/restrictarea/pmbs") ?>/page/'+p+'/id/'+id,
            data: $('#formsearch').serialize(),
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
                            '<td>'+datefmysql(v.tanggal_daftar)+'</td>'+
                            '<td>'+v.no_pendaftaran+'</td>'+
                            '<td>'+v.nama+'</td>'+
                            '<td>'+v.asal_sekolah+'</td>'+
                            '<td>'+v.prodi1+'</td>'+
                            '<td>'+v.prodi2+'</td>'+
                            '<td align="center" class=aksi>'+
//                                '<button type="button" class="btn btn-default btn-mini" onclick="print_pmb(\''+v.id+'\')"><i class="fa fa-print"></i></button> '+
                                '<button type="button" class="btn btn-default btn-mini" onclick="detail_pmb(\''+v.id+'\')"><i class="fa fa-eye"></i></button> '+
                                '<button type="button" class="btn btn-default btn-mini" onclick="delete_pmb(\''+v.id+'\','+data.page+');"><i class="fa fa-trash-o"></i></button>'+
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

    function edit_pmb(id) {
        $('#oldpict').html('');
        $('#datamodal').modal('show');
        $('#datamodal h4.modal-title').html('Edit pmb');
        $.ajax({
            type: 'GET',
            url: '<?= base_url('api/restrictarea/pmbs') ?>/page/1/id/'+id,
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.data[0].id);
                $('#judul').val(data.data[0].judul);
                tinyMCE.activeEditor.setContent(data.data[0].isi);
                $('#gambar').val(data.data[0].gambar);
                $('#oldpict').html('<img src="<?= base_url('assets/img/pmb') ?>/'+data.data[0].gambar+'" width="300px;" />')
            }
        });
    }
        
    function paging(p) {
        get_list_pmb(p);
    }

    function konfirmasi_save() {
        $('#isi_pmb').val(tinyMCE.get('isi').getContent());
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
                    save_pmb();
                }
              }
            }
          });
      }

    function save_pmb() {
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
                    get_list_pmb(1);
                } else {
                    message_edit_success();
                    get_list_pmb(page);
                }
            },
            error: function() {
                $('#datamodal').modal('hide');
                var page = $('.pagination .active a').html();
                get_list_pmb(page);
                hide_ajax_indicator();
            }
        });
    }

    function delete_pmb(id, page) {
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
                        url: '<?= base_url('api/restrictarea/pmb') ?>/id/'+id,
                        dataType: 'json',
                        success: function(data) {
                            message_delete_success();
                            get_list_pmb(page);
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
              <h4>Daftar List Penerimaan Mahasiswa Baru</h4>
                <div class="tools"> 
                    <button id="search_pmb" class="btn btn-info btn-mini"><i class="fa fa-search"></i> Cari</button>
                    <button id="export_button" class="btn btn-mini"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                    <button id="reload_pmb" class="btn btn-mini"><i class="fa fa-refresh"></i> Reload</button>
                </div>
            </div>
            <div class="grid-body">
              <div class="scroller" data-height="220px">
                <div id="result">
                    <table class="table table-bordered table-stripped table-hover" id="load_data_table">
                        <thead>
                        <tr>
                          <th width="3%">No</th>
                          <th width="7%" class="left">Tanggal</th>
                          <th width="7%" class="left">No. Daftar</th>
                          <th width="15%" class="left">Nama</th>
                          <th width="18%" class="left">Asal Sekolah</th>
                          <th width="20%" class="left">Pilihan 1</th>
                          <th width="20%" class="left">Pilihan 2</th>
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
            <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="formsearch">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Tanggal Daftar:</label>
                    <input type="text" name="awal"  class="form-control" id="awal" style="width: 145px; float: left; margin-right: 5px;">
                    <input type="text" name="akhir"  class="form-control" id="akhir" style="width: 145px;">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Tahun Ajaran:</label>
                    <select name="ta" id="ta" class="form-control">
                        <?php foreach ($tahun_ajaran as $data) { ?>
                        <option value="<?= $data->ta ?>"><?= $data->ta ?> / <?= $data->ta+1 ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">No. Pendaftaran:</label>
                    <input type="text" name="no_daftar"  class="form-control" id="no_daftar">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Calon Mahasiswa:</label>
                    <input type="text" name="nama"  class="form-control" id="nama">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Prodi Pilihan 1:</label>
                    <select id="pilihan1" name="pilihan1" class="form-control">
                        <option value="">Pilih ...</option>
                        <?php foreach ($jurusan as $key => $data) { ?>
                        <option value="<?= $data->id ?>"><?= $data->link ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Prodi Pilihan 2:</label>
                    <select id="pilihan2" name="pilihan2" class="form-control">
                        <option value="">Pilih ...</option>
                        <?php foreach ($jurusan as $key => $data) { ?>
                        <option value="<?= $data->id ?>"><?= $data->link ?></option>
                        <?php } ?>
                    </select>
                </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
              <button type="button" class="btn btn-primary" onclick="get_list_pmb(1);"><i class="fa fa-search"></i> Cari Data</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <div id="datamodal-detail" class="modal fade">
            <div class="modal-dialog" style="width: 1055px;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Detail Upload Berkas</h4>
            </div>
              <div class="modal-body" id="load-images">
                  
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
              
      </div>
      <!-- END PAGE -->
    </div>
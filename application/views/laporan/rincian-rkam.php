<link rel="stylesheet" href="<?= base_url('assets/css/printing-A4.css') ?>" media="all" />
<script type="text/javascript">
    function cetak() {
        setTimeout(function(){ window.close();},300);
        window.print();    
    }
</script>
<body onload="cetak();">
    <div class="page">
        <center>RINCIAN RENCANA KEGIATAN DAN ANGGARAN MADRASAH (RKAM)<br/>TAHUN PELAJARAN <?= $thn_agg->tahun_anggaran ?></center>
    <table width="100%">
        
    </table><br/>
    <table width="100%">
        <tr><td width="20%">Nama Madrasah</td><td width="1%">: </td><td width="79"><?= $attr->nama ?></td></tr>
        <tr><td>Desa/Kecamatan</td><td>:</td><td> <?= $attr->kelurahan ?> / <?= $attr->kecamatan ?></td></tr>
        <tr><td>Kabupaten/Kota</td><td>:</td><td> <?= $attr->kabupaten ?></td></tr>
        <tr><td>Provinsi</td><td>:</td><td> <?= $attr->provinsi ?></td></tr>
        <tr><td>Triwulan</td><td>:</td><td><?= triwulan(date("m")) ?></td></tr>
        <tr><td>Sumber Dana</td><td>:</td><td>BOS</td></tr>
    </table>
    <br/>
    <table width="100%" class="tabel-laporan">
        <thead>
        <tr>
            <th width="10%" rowspan="2">No. Urut</th>
            <th width="10%" rowspan="2">No. Kode</th>
            <th width="40%" rowspan="2">Uraian</th>
            <th width="10%" rowspan="2">Jumlah (dalam Rp.)</th>
            <th colspan="30%">Semester</th>
        </tr>
        <tr>
            <th>I</th>
            <th>II</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $total = 0;
        foreach ($list_data as $key => $data) { ?>
        <tr valign="top">
            <td align="center"><?= ++$key ?></td>
            <td><?= $data->kode ?></td>
            <td><?= $data->nama_program ?></td>
            <td align="right"><?= currency($data->nominal) ?></td>
            <td align="center"><?= ($data->semester1 === '1')?'&checkmark;':'' ?></td>
            <td align="center"><?= ($data->semester2 === '1')?'&checkmark;':'' ?></td>
        </tr>
        <?php 
        //$total = $total + $data->subtotal;
        } ?>
<!--        <tr>
            <td colspan="3">TOTAL</td>
            <td align="right"><?= rupiah($total) ?></td>
        </tr>-->
        </tbody>
    </table>
    <br/>
    
    <table align="right" width="100%">
        <tr><td width="33%">Mengetahui<br/>Ketua Komite Madrasah</td><td width="33%">&nbsp;</td><td width="33%">Menyetujui<br/>Kepala Madrasah</td> </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>( <?= $attr->ketua_komite ?> )</td><td></td><td>( <?= $attr->kepala ?> )<br/>NIP. <?= $attr->nip_kepala ?></td></tr>
    </table>
    </div>
</body>
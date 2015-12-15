<link rel="stylesheet" href="<?= base_url('assets/css/printing-A4.css') ?>" media="all" />
<script type="text/javascript">
    function cetak() {
        setTimeout(function(){ window.close();},300);
        window.print();    
    }
</script>
<body onload="cetak();">
    <div class="page">
        <?php foreach($data as $value); ?>
        <center>PENERIMAAN BANK</center>
        <br/><br/>
        <table width="100%">
            <tr><td width="20%">Tanggal</td><td width="1%">: </td><td width="79"><?= indo_tgl($value->tanggal) ?></td></tr>
            <tr><td>No. Kode</td><td>:</td><td> <?= $value->kode ?></td></tr>
            <tr><td>No. Bukti</td><td>:</td><td><?= $value->nobukti ?></td></tr>
            <tr><td>Jumlah</td><td>:</td><td><?= currency($value->nominal) ?></td></tr>
            <tr><td>Jenis Transaksi</td><td>:</td><td><?= $value->jenis ?></td></tr>
        </table>

        <br/>
        <table align="right" width="100%">
            <tr><td width="100%"  colspan="3" align="right"><?= $attr->kabupaten ?>, <?= indo_tgl($value->tanggal) ?></td> </tr>
            <tr><td width="33%" align="center">Mengetahui<br/>Kepala Sekolah Madrasah</td><td width="33%">&nbsp;</td><td width="33%" align="center">Bendahara</td> </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td align="center">( <?= $attr->kepala ?> )</td><td></td><td align="center">( <?= $attr->bendahara ?> )</td></tr>
        </table>
    </div>
</body>
<?php
    header_excel('rekap-pmb.xls');
?>
<table><tr><td colspan="31">REKAP DATA PENDAFTAR</td></table>
<table border="1">
    <thead>
    <tr>
      <th>Tanggal</th>
      <th>No. Daftar</th>
      <th>Nama</th>
      <th>Tempat</th>
      <th>Tanggal Lahir</th>
      <th>Agama</th>
      <th>Jekel</th>
      <th>Alamat</th>
      <th>Desa</th>
      <th>Kecamatan</th>
      <th>Kabupaten</th>
      <th>No. Telp.</th>
      <th>Nama Ayah</th>
      <th>Nama Ibu</th>
      <th>Pekerjaan Ayah</th>
      <th>Pekerjaan Ibu</th>
      <th>Penghasilan Ayah</th>
      <th>Penghasilan Ibu</th>
      <th>Yg Membiayai</th>
      <th>Nama Wali</th>
      <th>Hubungan Wali</th>
      <th>Penghasilan Wali</th>
      <th>Alamat Wali</th>
      <th>Asal Sekolah</th>
      <th>Jurusan</th>
      <th>Status Sekolah</th>
      <th>Alamat Sekolah</th>
      <th>Telp. Sekolah</th>
      <th>Prodi Pilihan 1</th>
      <th>Prodi Pilihan 2</th>
      <th>Jenis Daftar</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $value) { ?>
        <tr>
            <td><?= datefmysql($value->tanggal_daftar) ?></td>
            <td><?= $value->no_pendaftaran ?></td>
            <td><?= $value->nama ?></td>
            <td><?= $value->tempat ?></td>
            <td><?= datefmysql($value->tanggal_lahir) ?></td>
            <td><?= $value->agama ?></td>
            <td><?= $value->jekel ?></td>
            <td><?= $value->alamat ?></td>
            <td><?= $value->desa ?></td>
            <td><?= $value->kecamatan ?></td>
            <td><?= $value->kabupaten ?></td>
            <td><?= $value->telp ?></td>
            <td><?= $value->nama_ayah ?></td>
            <td><?= $value->nama_ibu ?></td>
            <td><?= $value->pekerjaan_ayah ?></td>
            <td><?= $value->pekerjaan_ibu ?></td>
            <td align="right"><?= $value->penghasilan_ayah ?></td>
            <td align="right"><?= $value->penghasilan_ibu ?></td>
            <td><?= $value->pembiaya ?></td>
            <td><?= $value->nama_wali ?></td>
            <td><?= $value->hubungan_wali ?></td>
            <td><?= $value->penghasilan_wali ?></td>
            <td><?= $value->alamat_wali ?></td>
            <td><?= $value->asal_sekolah ?></td>
            <td><?= $value->jurusan ?></td>
            <td><?= $value->status_sekolah ?></td>
            <td><?= $value->alamat_sekolah ?></td>
            <td><?= $value->telp_sekolah ?></td>
            <td><?= $value->prodi1 ?></td>
            <td><?= $value->prodi2 ?></td>
            <td><?= $value->jenis_daftar ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
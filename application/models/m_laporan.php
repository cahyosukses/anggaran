<?php

class M_laporan extends CI_Model {
    
    function data_header() {
        return $this->db->get('tb_sekolah')->row();
    }
    
    function data_tahun_anggaran_aktif() {
        return $this->db->get_where('tb_tahun_anggaran', array('aktifasi' => 'Ya'))->row();
    }
    
    function load_data_rincian_rka() {
        $aktif = $this->data_tahun_anggaran_aktif();
        $sql = "select r2.*, r1.kode as kode_parent, r1.semester1, r1.semester2 from tb_rka r1 join tb_rka r2 on (r1.id = r2.id_parent) where LENGTH(r2.kode) > 7 and r2.id_tahun_anggaran = '".$aktif->id."' order by r2.kode asc";
        return $this->db->query($sql)->result();
    }
}
?>

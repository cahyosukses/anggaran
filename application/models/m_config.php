<?php

class M_config extends CI_Model {
   
    function get_list_tahun_anggaran($limit, $start, $search) {
        //$limitation = null; 
        $q = NULL;
        if ($search['id'] !== '') {
            $q.=" and id = '".$search['id']."'";
        }
        $limitation =" limit $start , $limit";
        
        $sql = "select * from tb_tahun_anggaran where id is not NULL $q order by id";
        $queryAll = $this->db->query($sql.$limitation);
        $data['data'] = $queryAll->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
    
    function aktivasi_tahun_anggaran($id) {
        $this->db->update('tb_tahun_anggaran', array('aktifasi' => 'Tidak'));
        
        $this->db->where('id', $id);
        $this->db->update('tb_tahun_anggaran', array('aktifasi' => 'Ya'));
    }
    
    function save_tahun_anggaran() {
        $id     = post_safe('id');
        $tahun  = post_safe('tahun');
        $aktifasi = post_safe('aktivasi');
        $semester = post_safe('semester');
        $data = array(
            'id' => $id,
            'tahun_anggaran' => $tahun,
            'semester' => $semester,
            'aktifasi' => $aktifasi
        );
        if ($data['id'] === '') {
            if ($data['aktifasi'] === 'Ya') {
                $this->db->update('tb_tahun_anggaran', array('aktifasi' => 'Tidak'));
            }
            $this->db->insert('tb_tahun_anggaran', $data);
            $result['act'] = 'add';
        } else {
            $this->db->where('id', $data['id']);
            $this->db->update('tb_tahun_anggaran', $data);
            $result['act'] = 'edit';
        }
        return $result;
    }
}
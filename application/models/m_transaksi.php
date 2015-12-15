<?php

class M_transaksi extends CI_Model {
    
    function id_tahun_anggaran() {
        return $this->db->get_where('tb_tahun_anggaran', array('aktifasi' => 'Ya'))->row()->id;
    }
    function get_list_penerimaan_banks($limit = null, $start = null, $search = null) {
        $q = null;
        if ($search['id'] !== '') {
            $q.=" and id = '".$search['id']."'";
        }
        $sql = "select * from tb_trans_bank where id is not NULL";
        $limitation = null;
        if ($limit !== NULL) {
            $limitation.=" limit $start , $limit";
        }
        $order=" order by tanggal desc";
        $query = $this->db->query($sql . $q . $order. $limitation);
        //echo $sql . $q . $limitation;
        $queryAll = $this->db->query($sql . $q);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
    
    function save_penerimaan_bank($data) {
        if ($data['id'] === '') {
            $this->db->insert('tb_trans_bank', $data);
            $result['act'] = 'add';
        } else {
            $this->db->where('id', $data['id']);
            $this->db->update('tb_trans_bank', $data);
            $result['act'] = 'edit';
        }
        return $result;
    }
    
    function get_list_penerimaan_pajaks($limit = null, $start = null, $search = null) {
        $q = null;
        if ($search['id'] !== '') {
            $q.=" and id = '".$search['id']."'";
        }
        $sql = "select * from tb_trans_pajak where id is not NULL ";
        $limitation = null;
        if ($limit !== NULL) {
            $limitation.=" limit $start , $limit";
        }
        $query = $this->db->query($sql . $q . $limitation);
        //echo $sql . $q . $limitation;
        $queryAll = $this->db->query($sql . $q);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
    
    function save_penerimaan_pajak($data) {
        if ($data['id'] === '') {
            $this->db->insert('tb_trans_pajak', $data);
            $result['act'] = 'add';
        } else {
            $this->db->where('id', $data['id']);
            $this->db->update('tb_trans_pajak', $data);
            $result['act'] = 'edit';
        }
        return $result;
    }
    
    function get_list_pencairans($limit = null, $start = null, $search = null) {
        $q = null;
        if ($search['id'] !== '') {
            $q.=" and p.id = '".$search['id']."'";
        }
        $sql = "select p.*, r.kode, r.nama_program 
            from tb_trans_pencairan p
            join tb_rka r on (p.id_rka = r.id) 
            where p.id is not NULL ";
        $limitation = null;
        if ($limit !== NULL) {
            $limitation.=" limit $start , $limit";
        }
        $query = $this->db->query($sql . $q . $limitation);
        //echo $sql . $q . $limitation;
        $queryAll = $this->db->query($sql . $q);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        //die(json_encode($data));
        return $data;
    }
    
    function save_pencairan($data) {
        if ($data['id'] === '') {
            $this->db->insert('tb_trans_pencairan', $data);
            $result['act'] = 'add';
        } else {
            $this->db->where('id', $data['id']);
            $this->db->update('tb_trans_pencairan', $data);
            $result['act'] = 'edit';
        }
        return $result;
    }
    
    
}
?>

<?php

class M_laporan extends CI_Model {
    
    function get_data_rekap_penerimaan($limit = null, $start = null, $search = null) {
        $q = null;
        if ($search['id'] !== '') {
            $q.=" and p.id = '".$search['id']."'";
        }
        if ($search['jurusan'] !== '') {
            $q.=" and m.k_prs = '".$search['jurusan']."'";
        }
        if ($search['jenis_bayar'] !== '') {
            $q.=" and p.id_jenis_penerimaan = '".$search['jenis_bayar']."'";
        }
        if ($search['nim'] !== '') {
            $q.=" and m.row_id = '".$search['nim']."'";
        }
        if ($search['tanggal'] !== '') {
            $q.=" and p.tanggal = '".$search['tanggal']."'";
        }
        if ($search['tanggalinput'] !== '') {
            $q.=" and date(p.waktu) = '".$search['tanggalinput']."'";
        }
        $sql = "select p.*, m.row_id, m.k_prs as kode_prodi, m.n_mhs, m.k_mhs, jp.nama as jenis_pembayaran,
            IFNULL(b.nama,'<i>Langsung</i>') as bank
            from tb_pembayaran p 
            join tb_jenis_penerimaan jp on (p.id_jenis_penerimaan = jp.id) 
            join tb_mahasiswa m on (p.id_mhs = m.row_id)
            left join tb_bank b on (p.id_bank = b.id)
            where p.id is not NULL $q";
        $limitation = null;
        $limitation.=" limit $start , $limit";
        $query = $this->db->query($sql . $q . $limitation);
        //echo $sql . $q . $limitation;
        $queryAll = $this->db->query($sql . $q);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
    
    function get_data_rekap_penerimaan_spp($limit = null, $start = null, $search = null) {
        $q = NULL;
        if ($search['bulan'] !== '') {
            $q.=" and p.tanggal like ('".$search['bulan']."%')";
        }
        $sql = "select pr.*,
            (select count(p.id) from tb_pembayaran p 
                join tb_mahasiswa m on (p.id_mhs = m.row_id) 
                join tb_jenis_penerimaan j on (p.id_jenis_penerimaan = j.id)
                where m.k_prs = pr.kode_prodi and j.status = 'SPP' $q) as jumlah_mhs_bayar,
            (select count(row_id) from tb_mahasiswa where k_prs = pr.kode_prodi) as jumlah_mhs
            from tb_prodi pr where pr.kode_prodi is not NULL ORDER BY pr.nama_prodi";
        $limitation = null;
        $limitation.=" limit $start , $limit";
        $query = $this->db->query($sql . $limitation);
        $queryAll = $this->db->query($sql);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
    
    function get_list_history_pembayaran($limit = null, $start = null, $search = null) {
        $q = null;
        $sql = "select p.*, m.row_id, m.k_prs as kode_prodi, m.n_mhs, m.k_mhs, jp.nama as jenis_pembayaran,
            IFNULL(b.nama,'<i>Langsung</i>') as bank
            from tb_pembayaran p 
            join tb_jenis_penerimaan jp on (p.id_jenis_penerimaan = jp.id) 
            join tb_mahasiswa m on (p.id_mhs = m.row_id)
            left join tb_bank b on (p.id_bank = b.id)
            where p.id is not NULL and m.row_id = '".$search['nim']."' order by p.tanggal, id";
        $limitation = null;
        $limitation.=" limit $start , $limit";
        $query = $this->db->query($sql . $q . $limitation);
        //echo $sql . $q . $limitation;
        $queryAll = $this->db->query($sql . $q);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
}
?>

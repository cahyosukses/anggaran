<?php

class Transaksi extends CI_Controller {
    
    /*PEMBAYARAN*/
    function generate_spp() {
        $data['title'] = 'Entri Pembayaran Mahasiswa';
        $data['jenis_pembayaran'] = $this->m_masterdata->load_data_jenis_pembayaran()->result();
        $data['jurusan'] = $this->m_masterdata->load_data_jurusan()->result();
        $this->load->view('transaksi/generate-spp', $data);
    }
    
    function manage_pembayaran_mahasiswa($mode, $page = null) {
        $limit = 10;
        switch ($mode) {
            case 'list':
                $param['jurusan'] = get_safe('jurusan');
                $param['id'] = get_safe('id_pembayaran');
                $param['jenis_bayar'] = get_safe('jenis_pembayaran');
                $param['nim'] = get_safe('nim');
                $param['tanggal'] = date2mysql(get_safe('tanggal'));
                $param['tanggalinput'] = date2mysql(get_safe('tanggalinput'));
                $data = $this->get_list_pembayaran_mahasiswa($limit, $page, $param);
                $this->load->view('transaksi/generate-list', $data);
                
                break;
            
            case 'save':
                $data = $this->m_transaksi->save_pembayaran_mahasiswa();
                die(json_encode($data));
                break;
            case 'import':
                $this->load->helper('excel_reader2');
                $data = $this->m_transaksi->save_import_pembayaran_mahasiswa();
                die(json_encode($data));
                break;
            case 'delete':
                $id = get_safe('id');
                $this->db->delete('tb_pembayaran', array('id' => $id));
                break;
            default:
                break;
        }
    }
    
    function get_list_pembayaran_mahasiswa($limit, $page, $search) {
        if ($page == 'undefined') {
            $page = 1;
        }
        $start = ($page - 1) * $limit;
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['auto'] = $start+1;
        $query = $this->m_transaksi->get_data_pembayaran_mahasiswa($limit, $start, $search);
        $data['jumlah'] = $query['jumlah'];
        $data['list_data'] = $query['data'];
        $data['paging'] = paging_ajax($data['jumlah'], $limit, $page, 2, '');
        return $data;
    }
    
    /*SETTING TAGIHAN*/
    function setting_tagihan() {
        $data['title'] = 'Setting Tagihan Mahasiswa';
        $data['jurusan'] = $this->m_masterdata->load_data_jurusan()->result();
        $this->load->view('transaksi/setting-tagihan', $data);
    }
    
    function get_list_tagihan_mahasiswa($limit, $page, $search) {
        if ($page == 'undefined') {
            $page = 1;
        }
        $start = ($page - 1) * $limit;
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['auto'] = $start+1;
        $query = $this->m_transaksi->get_data_tagihan_mahasiswa($limit, $start, $search);
        $data['jumlah'] = $query['jumlah'];
        $data['list_data'] = $query['data'];
        $data['paging'] = paging_ajax($data['jumlah'], $limit, $page, 2, '');
        return $data;
    }
    
    function manage_setting_tagihan($mode, $page = null) {
        $limit = 10;
        switch ($mode) {
            case 'list':
                $param['prodi'] = get_safe('prodi');
                $data = $this->get_tagihan_mahasiswa($limit, $page, $param);
                $this->load->view('transaksi/setting-tagihan-list', $data);
                
                break;
            
            case 'save':
                $data = $this->m_transaksi->save_setting_tagihan();
                die(json_encode($data));
                break;

            case 'delete':
                $id = get_safe('id');
                $this->db->delete('tb_tagihan', array('id' => $id));
                break;
            default:
                break;
        }
    }
    
    function get_tagihan_mahasiswa($limit, $page, $search) {
        if ($page == 'undefined') {
            $page = 1;
        }
        $start = ($page - 1) * $limit;
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['auto'] = $start+1;
        $query = $this->m_transaksi->get_data_tagihan_mahasiswa($limit, $start, $search);
        $data['jumlah'] = $query['jumlah'];
        $data['list_data'] = $query['data'];
        $data['paging'] = paging_ajax($data['jumlah'], $limit, $page, 2, '');
        return $data;
    }
    
    /*IMPORT BANK*/
    function import_penerimaan() {
        $data['title'] = 'Import Penerimaan';
        $this->load->view('transaksi/import-penerimaan', $data);
    }
    
    /*CETAK KARTU*/
    function cetak_kartu() {
        $data['title'] = 'Cetak Kartu Mahasiswa';
        $this->load->view('transaksi/cetak-kartu', $data);
    }
}
?>

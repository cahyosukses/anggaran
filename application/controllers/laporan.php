<?php

class Laporan extends CI_Controller {
    
    function rekap_penerimaan() {
        $data['title'] = 'Rekap Penerimaan';
        $data['jenis_pembayaran'] = $this->m_masterdata->load_data_jenis_pembayaran()->result();
        $data['jurusan'] = $this->m_masterdata->load_data_jurusan()->result();
        $this->load->view('laporan/penerimaan', $data);
    }
    
    function manage_rekap_penerimaan($action, $page = null) {
        $limit = 15;
        switch ($action) {
            case 'list':
                $param['jurusan'] = get_safe('jurusan');
                $param['id'] = get_safe('id_pembayaran');
                $param['jenis_bayar'] = get_safe('jenis_pembayaran');
                $param['nim'] = get_safe('nim');
                $param['tanggal'] = date2mysql(get_safe('tanggal'));
                $param['tanggalinput'] = date2mysql(get_safe('tanggalinput'));
                $data = $this->get_list_data_rekap_penerimaan($limit, $page, $param);
                $this->load->view('laporan/penerimaan-table', $data);
                break;
            case 'save': 
                $data = $this->m_masterdata->save_jenis_penerimaan();
                die(json_encode($data));
                break;
            case 'delete': 
                $this->m_masterdata->delete_unit($_GET['id']);
                break;
            
        }
    }
    
    function get_list_data_rekap_penerimaan($limit, $page, $search) {
        if ($page == 'undefined') {
            $page = 1;
        }
        //$str = 'null';
        $start = ($page - 1) * $limit;
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['auto'] = $start+1;
        $query = $this->m_laporan->get_data_rekap_penerimaan($limit, $start, $search);
        $data['list_data'] = $query['data'];
        $data['jumlah'] = $query['jumlah'];
        
        $data['paging'] = paging_ajax($data['jumlah'], $limit, $page, 1, null);
        return $data;
    }
    
    function penerimaan_spp() {
        $data['title'] = 'Laporan Penerimaan SPP';
        $data['jenis_pembayaran'] = $this->m_masterdata->load_data_jenis_pembayaran()->result();
        $data['jurusan'] = $this->m_masterdata->load_data_jurusan()->result();
        $this->load->view('laporan/penerimaan-spp', $data);
    }
    
    function manage_rekap_penerimaan_spp($action, $page = null) {
        $limit = 15;
        switch ($action) {
            case 'list':
                $param['jurusan'] = get_safe('jurusan');
                $param['id'] = get_safe('id_pembayaran');
                $param['jenis_bayar'] = get_safe('jenis_pembayaran');
                $param['nim'] = get_safe('nim');
                $param['tanggal'] = date2mysql(get_safe('tanggal'));
                $param['tanggalinput'] = date2mysql(get_safe('tanggalinput'));
                $param['bulan'] = get_safe('bulan');
                $data = $this->get_list_data_rekap_penerimaan_spp($limit, $page, $param);
                $this->load->view('laporan/penerimaan-spp-table', $data);
                break;
            case 'save': 
                $data = $this->m_masterdata->save_jenis_penerimaan();
                die(json_encode($data));
                break;
            case 'delete': 
                $this->m_masterdata->delete_unit($_GET['id']);
                break;
            
        }
    }
    
    function get_list_data_rekap_penerimaan_spp($limit, $page, $search) {
        if ($page == 'undefined') {
            $page = 1;
        }
        //$str = 'null';
        $start = ($page - 1) * $limit;
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['auto'] = $start+1;
        $query = $this->m_laporan->get_data_rekap_penerimaan_spp($limit, $start, $search);
        $data['list_data'] = $query['data'];
        $data['jumlah'] = $query['jumlah'];
        
        $data['paging'] = paging_ajax($data['jumlah'], $limit, $page, 1, null);
        return $data;
    }
    
    /*HISTORY PEMBAYARAN*/
    function history_pembayaran() {
        $data['title'] = 'History Pembayaran';
        $this->load->view('laporan/history-pembayaran', $data);
    }
    
    function manage_history_pembayaran($action, $page = null) {
        $limit = 15;
        switch ($action) {
            case 'list':
                $param['nim'] = get_safe('nim');
                $data = $this->get_list_history_pembayaran($limit, $page, $param);
                $data['attr'] = $this->db->get_where('tb_mahasiswa', array('row_id' => get_safe('nim')))->row();
                $this->load->view('laporan/history-pembayaran-table', $data);
            break;
        }
    }
    
    function get_list_history_pembayaran($limit, $page, $search) {
        if ($page == 'undefined') {
            $page = 1;
        }
        //$str = 'null';
        $start = ($page - 1) * $limit;
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['auto'] = $start+1;
        $query = $this->m_laporan->get_list_history_pembayaran($limit, $start, $search);
        $data['list_data'] = $query['data'];
        $data['jumlah'] = $query['jumlah'];
        
        $data['paging'] = paging_ajax($data['jumlah'], $limit, $page, 1, null);
        return $data;
    }
}
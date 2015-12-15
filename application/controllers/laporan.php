<?php

class Laporan extends CI_Controller {
    
    function rincian_rkam() {
        $data['title'] = 'Rincian RKAM';
        $data['attr']  = $this->m_laporan->data_header();
        $data['thn_agg'] = $this->m_laporan->data_tahun_anggaran_aktif();
        $data['list_data'] = $this->m_laporan->load_data_rincian_rka();
        $this->load->view('laporan/rincian-rkam', $data);
    }
    
    function buku_kas_umum() {
        
    }
    
    function buku_pembantu_bank() {
        $data['title'] = 'Buku Pembantu Bank';
        $this->load->view('laporan/pembantu-bank', $data);
    }
}
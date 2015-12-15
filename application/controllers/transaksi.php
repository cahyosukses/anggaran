<?php

class Transaksi extends CI_Controller {
    
    /*PEMBAYARAN*/
    function penerimaan_bank() {
        $data['title'] = 'Transaksi Bank';
        $this->load->view('transaksi/transaksi-bank', $data);
    }
    
    function penerimaan_pajak() {
        $data['title'] = 'Transaksi Pajak';
        $this->load->view('transaksi/transaksi-pajak', $data);
    }
    
    function pencairan_dana() {
        $data['title'] = 'Pencairan Dana';
        $this->load->view('transaksi/pencairan', $data);
    }
    
    function print_pencairan() {
        $search['id'] = get_safe('id');
        $data = $this->m_transaksi->get_list_pencairans(NULL, NULL, $search);
        $data['thn_agg'] = $this->m_laporan->data_tahun_anggaran_aktif();
        $data['attr']  = $this->m_laporan->data_header();
        $this->load->view('transaksi/print-pencairan', $data);
    }
    
    function print_bank() {
        $search['id'] = get_safe('id');
        $data = $this->m_transaksi->get_list_penerimaan_banks(NULL, NULL, $search);
        $data['thn_agg'] = $this->m_laporan->data_tahun_anggaran_aktif();
        $data['attr']  = $this->m_laporan->data_header();
        $this->load->view('transaksi/print-bank', $data);
    }
    
    function print_pajak() {
        $search['id'] = get_safe('id');
        $data = $this->m_transaksi->get_list_penerimaan_pajaks(NULL, NULL, $search);
        $data['thn_agg'] = $this->m_laporan->data_tahun_anggaran_aktif();
        $data['attr']  = $this->m_laporan->data_header();
        $this->load->view('transaksi/print-pajak', $data);
    }
}
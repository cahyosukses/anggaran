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
}
?>

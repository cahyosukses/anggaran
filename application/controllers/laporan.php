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
        $data['title'] = 'Buku Kas Umum';
        $this->load->view('laporan/buku-kas-umum', $data);
    }
    
    function buku_pembantu_bank() {
        $data['title'] = 'Buku Pembantu Bank';
        $this->load->view('laporan/pembantu-bank', $data);
    }
    
    function print_rekap_bank() {
        $search= array(
            'id' => '',
            'tanggal' => get_safe('tanggal'),
            'kode' => get_safe('nokode'),
            'nobukti' => get_safe('nobukti'),
            'keterangan' => get_safe('uraian'),
            'nominal' => currencyToNumber(get_safe('nominal')),
            'jenis' => get_safe('jenis_transaksi'),
        );
        $data = $this->m_transaksi->get_list_penerimaan_banks(NULL, NULL, $search);
        $data['attr']  = $this->m_laporan->data_header();
        $display = get_safe('cetak');
        if ($display === 'printer') {
            $this->load->view('laporan/print-rekap-bank', $data);
        } else {
            $this->load->view('laporan/excel/rekap-bank', $data);
        }
    }
    
    function buku_pembantu_pajak() {
        $data['title'] = 'Buku Pembantu Pajak';
        $this->load->view('laporan/pembantu-pajak', $data);
    }
    
    function print_rekap_pajak() {
        $search= array(
            'id' => '',
            'tanggal' => get_safe('tanggal'),
            'kode' => get_safe('nokode'),
            'nobukti' => get_safe('nobukti'),
            'keterangan' => get_safe('uraian'),
            'jenis' => get_safe('jenis_transaksi'),
            'jenis_pajak' => get_safe('jenis_pajak')
        );
        $data = $this->m_transaksi->get_list_penerimaan_pajaks(NULL, NULL, $search);
        $data['attr']  = $this->m_laporan->data_header();
        $display = get_safe('cetak');
        if ($display === 'printer') {
            $this->load->view('laporan/print-rekap-pajak', $data);
        } else {
            $this->load->view('laporan/excel/rekap-pajak', $data);
        }
    }
    
    function penggunaan_dana_bos() {
        $data['title'] = 'Laporan Penggunaan Dana Program BOS MA';
        $this->load->view('laporan/rekap-penggunaan-dana', $data);
    }
    
    function print_penggunaan_dana() {
        $search= array(
            'id' => '',
            'awal' => date2mysql(get_safe('awal')),
            'akhir' => date2mysql(get_safe('akhir')),
            'nobukti' => get_safe('nobukti'),
            'nokode' => get_safe('nokode'),
            'nourut' => get_safe('nourut'),
            'uraian' => get_safe('uraian')
        );
        
        $data = $this->m_transaksi->get_list_pencairans(NULL, NULL, $search);
        $data['title'] = 'Laporan Penggunaan Dana Program BOS MA';
        $data['attr']  = $this->m_laporan->data_header();
        $display = get_safe('cetak');
        if ($display === 'printer') {
            $this->load->view('laporan/print-penggunaan-dana', $data);
        } else {
            $this->load->view('laporan/excel/penggunaan-dana', $data);
        }
    }
    
    function penggunaan_dana_non_personal() {
        $data['title'] = 'Rekapitulasi Penggunaan Dana Ops Non Personel Program BOS MA';
        $this->load->view('laporan/rekap-penggunaan-dana-non-personal', $data);
    }
    
    function print_penggunaan_dana_non_personal() {
        $search= array(
            'id' => '',
            'awal' => date2mysql(get_safe('awal')),
            'akhir' => date2mysql(get_safe('akhir')),
            'nobukti' => get_safe('nobukti'),
            'nokode' => get_safe('nokode'),
            'nourut' => get_safe('nourut'),
            'uraian' => get_safe('uraian')
        );
        
        $data = $this->m_transaksi->get_list_pencairans(NULL, NULL, $search);
        $data['title'] = 'Rekapitulasi Penggunaan Dana Operasional Non Personil <br/>
            Program Bantuan Operasional Sekolah Madrasah Aliyah (BOS MA)<br/>
            TAHAP I / TAHAP II:
            ';
        $data['attr']  = $this->m_laporan->data_header();
        $display = get_safe('cetak');
        if ($display === 'printer') {
            $this->load->view('laporan/print-penggunaan-dana-non-personal', $data);
        } else {
            $this->load->view('laporan/excel/penggunaan-dana-non-personal', $data);
        }
    }
    
    function print_buku_kas_umum() {
        $search= array(
            'id' => '',
            'awal' => date2mysql(get_safe('awal')),
            'akhir' => date2mysql(get_safe('akhir')),
            'nobukti' => get_safe('nobukti'),
            'nokode' => get_safe('nokode'),
            'nourut' => get_safe('nourut'),
            'uraian' => get_safe('uraian')
        );
        
        $data = $this->m_laporan->get_list_kas_umum(NULL, NULL, $search);
        $data['title'] = 'BUKU KAS UMUM';
        $data['attr']  = $this->m_laporan->data_header();
        $display = get_safe('cetak');
        if ($display === 'printer') {
            $this->load->view('laporan/print-buku-kas-umum', $data);
        } else {
            $this->load->view('laporan/excel/buku-kas-umum', $data);
        }
    }
    
    function buku_pembantu_kas() {
        $data['title'] = 'Buku Pembantu Kas';
        $this->load->view('laporan/buku-pembantu-kas', $data);
    }
    
    function print_buku_pembantu_kas() {
        $search= array(
            'id' => '',
            'awal' => date2mysql(get_safe('awal')),
            'akhir' => date2mysql(get_safe('akhir')),
            'nobukti' => get_safe('nobukti'),
            'nokode' => get_safe('nokode'),
            'nourut' => get_safe('nourut'),
            'uraian' => get_safe('uraian')
        );
        
        $data = $this->m_laporan->get_list_pembantu_kas(NULL, NULL, $search);
        $data['title'] = 'BUKU PEMBANTU KAS';
        $data['attr']  = $this->m_laporan->data_header();
        $display = get_safe('cetak');
        if ($display === 'printer') {
            $this->load->view('laporan/print-buku-pembantu-kas', $data);
        } else {
            $this->load->view('laporan/excel/buku-pembantu-kas', $data);
        }
    }
}
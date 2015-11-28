<?php

class Restrictarea extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_masterdata','m_main'));
    }
    
    function news() {
        $data['title'] = 'Berita';
        $this->load->view('restricted/news', $data);
    }
    
    function slider() {
        $data['title'] = 'Slider';
        $this->load->view('restricted/slider', $data);
    }
    
    function images() {
        $data['title'] = 'Gambar Pendukung Konten Web';
        $this->load->view('restricted/images', $data);
    }
    
    function profile() {
        $data['title'] = 'Profil Universitas';
        $this->load->view('restricted/profile', $data);
    }
    
    function prodi() {
        $data['title'] = 'Program Studi';
        $this->load->view('restricted/prodi', $data);
    }
    
    function contactus() {
        $data['title'] = 'Kontak Kami';
        $this->load->view('restricted/contact', $data);
    }
    
    function journal_category() {
        $data['title'] = 'Kategori Publikasi Ilmiah';
        $this->load->view('restricted/journal-category', $data);
    }
    
    function journal() {
        $data['title'] = 'Publikasi Ilmiah';
        $data['kategori'] = $this->db->get('tb_journal_category')->result();
        $this->load->view('restricted/journal', $data);
    }
    
    function pendaftaran() {
        $data['title'] = 'Data PMB';
        $data['tahun_ajaran'] = $this->m_masterdata->get_tahun_ajaran_from_daftar()->result();
        $data['jurusan'] = $this->m_main->get_list_prodi()->result();
        $this->load->view('restricted/data-pendaftaran', $data);
    }
    
    function kegiatan() {
        $data['title'] = 'Kegiatan Kemahasiswaan';
        $this->load->view('restricted/kemahasiswaan', $data);
    }
    
    function changepassword() {
        $data['title'] = 'Ubah Password';
        $this->load->view('restricted/changepass', $data);
    }
    
    function info_pmb() {
        $data['title'] = 'Informasi PMB';
        $this->load->view('restricted/info-pmb', $data);
    }
    
    function export_pendaftar() {
        $search= array(
            'awal' => date2mysql(get_safe('awal')),
            'akhir' => date2mysql(get_safe('akhir')),
            'nama' => get_safe('nama'),
            'no_daftar' => get_safe('no_daftar'),
            'pilihan1' => get_safe('pilihan1'),
            'pilihan2' => get_safe('pilihan2'),
            'ta' => get_safe('ta')
        );
        
        $data = $this->m_masterdata->get_list_pmb(NULL, NULL, $search);
        $this->load->view('restricted/export-pendaftar', $data);
    }
    
    function sambutan() {
        $data['title'] = 'Data Sambutan';
        $this->load->view('restricted/sambutan', $data);
    }
    
    function config() {
        $data['title'] = 'Data Konfigurasi';
        $data['config'] = $this->m_masterdata->get_data_config()->row();
        $this->load->view('restricted/konfigurasi', $data);
    }
    
}
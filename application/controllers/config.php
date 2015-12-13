<?php

class Config extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_config'));
    }
    
    function tahun_anggaran() {
        $data['title'] = 'Tahun Anggaran';
        $this->load->view('config/tahun-anggaran', $data);
    }
}
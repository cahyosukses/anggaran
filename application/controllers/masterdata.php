<?php

class Masterdata extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function rka() {
        $data['title'] = 'Rencana Kegiatan dan Anggaran';
        $this->load->view('masterdata/rka', $data);
    }
}
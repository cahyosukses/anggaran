<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Config extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        $this->limit = 10;
        $this->load->model(array('m_config'));
    }
    
    function app_get_key_get() {
        $data = $this->m_config->lock_my_app();
        $this->response($data, 200);
    }
    
    function tahun_anggarans_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }
        
        $start = ($this->get('page') - 1) * $this->limit;
        
        $search= array(
            'id' => $this->get('id')
        );
        
        $data = $this->m_config->get_list_tahun_anggaran($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;
        
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }
    
    function tahun_anggaran_get() {
        $data = $this->m_config->get_tahun_anggaran($this->get('id'));
        $this->response($data, 200);
    }
    
    function tahun_anggaran_post() {
        $data = $this->m_config->save_tahun_anggaran();
        $this->response($data, 200);
    }
    
    function tahun_anggaran_delete() {
        $this->db->delete('tb_tahun_anggaran', array('id' => $this->get('id')));
    }
    
    function aktivasi_tahun_anggaran_get() {
        $data = $this->m_config->aktivasi_tahun_anggaran($this->get('id'));
        $this->response($data, 200);
    }
    
    function change_password_post() {
        $data = $this->m_config->change_password();
        die(json_encode($data));
    }
    
    function institusi_get() {
        $data = $this->db->get('tb_sekolah')->row();
        $this->response($data, 200);
    }
    
    function save_institusi_post() {
        $array = array(
            'id' => post_safe('id'),
            'nama' => post_safe('nama'),
            'alamat' => post_safe('alamat'),
            'provinsi' => post_safe('provinsi'),
            'kabupaten' => post_safe('kabupaten'),
            'kecamatan' => post_safe('kecamatan'),
            'kelurahan' => post_safe('kelurahan'),
            'kepala' => post_safe('kepsek'),
            'nip_kepala' => post_safe('nipkepsek'),
            'ketua_komite' => post_safe('ketua_komite'),
            'bendahara' => post_safe('bendahara'),
            'nip_bendahara' => post_safe('nip_bendahara'),
            'nsm' => post_safe('nsm')
        );
        $data = $this->m_config->save_config_institusi($array);
        $this->response($data, 200);
    }
}
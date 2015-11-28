<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Masterdata extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        $this->limit = 10;
        $this->load->model(array('m_masterdata'));

        $id_user = $this->session->userdata('id_user');
        if (empty($id_user)) {
            $this->response(array('error' => 'Anda belum login'), 401);
        }
    }
    
    function rkas_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }
        
        $start = ($this->get('page') - 1) * $this->limit;
        
        $search= array(
            'id' => $this->get('id')
        );
        
        $data = $this->m_masterdata->get_list_rka($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;
        
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }
    
    function rka_post() {
        $data = $this->m_masterdata->save_rka();
        $this->response($data, 200);
    }
    
    function rka_delete() {
        $data = $this->db->query("select gambar from tb_rka where id = '".$this->get('id')."'")->row();
        @unlink('assets/img/rka/'.$data->gambar);
        $this->db->delete('tb_rka', array('id' => $this->get('id')));
    }
}
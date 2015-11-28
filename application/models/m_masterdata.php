<?php

class M_masterdata extends CI_Model {
    
    /*BERITA*/
    function get_list_rka($limit, $start, $search) {
        //$limitation = null; 
        $q = NULL;
        if ($search['id'] !== '') {
            $q.=" and id = '".$search['id']."'";
        }
        $limitation =" limit $start , $limit";
        
        $sql = "select * from tb_rka where id_parent is NULL $q order by id desc";
        $query = $this->db->query($sql.$limitation)->result();
        //echo $sql . $limitation;
        foreach ($query as $key1 => $val1) {
            $sql_child = "select * from tb_rka where id_parent = '".$val1->id."'";
            $result2 = $this->db->query($sql_child)->result();
            $query[$key1]->child1 = $result2;
            foreach ($result2 as $key2 => $val2) {
                $sql_child2 = "select * from tb_rka where id_parent = '".$val2->id."'";
                $result3 = $this->db->query($sql_child2)->result();
                $query[$key1]->child1[$key2]->child2 = $result3;
                foreach ($result3 as $key3 => $val3) {
                    $sql_child3 = "select * from tb_rka where id_parent = '".$val3->id."'";
                    $result4 = $this->db->query($sql_child3)->result();
                    $query[$key1]->child1[$key2]->child2[$key3]->child3 = $result4;
                    foreach ($result4 as $key4 => $val4) {
                        $sql_child4 = "select * from tb_rka where id_parent = '".$val4->id."'";
                        $result5 = $this->db->query($sql_child4)->result();
                        $query[$key1]->child1[$key2]->child2[$key3]->child3[$key4]->child4 = $result5;
                    }
                }
            }
        }
        $queryAll = $this->db->query($sql);
        $data['data'] = $query;
        $data['jumlah'] = $queryAll->num_rows();
        //die(json_encode($data));
        return $data;
    }
    
    function save_rka() {
        $id = post_safe('id');
        $data_array = array(
            'judul' => post_safe('judul'),
            'isi' => post_safe('isi_rka'),
            //'gambar' => (!empty(strtolower($_FILES['mFile']['name']))?strtolower($_FILES['mFile']['name']):'')
        );
        if ($id === '') {
            $this->db->insert('tb_rka', $data_array);
            $result['act'] = 'add';
            $result['id'] = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tb_rka', $data_array);
            $result['act'] = 'edit';
            $result['id'] = $id;
        }
        return $result;
        
    }
}
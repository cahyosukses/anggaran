<?php

class M_user extends CI_Model {
    
    function cek_login() {
        $query="select *
            from tb_users
            where username = '".post_safe('username')."' and password = '".md5(post_safe('password'))."' and id_user_group = '1'";
        //echo $query;
        $hasil=$this->db->query($query);
        return $hasil->row();
    }
    
    function module_load_data($id=null) {
        $q = null;
        if ($id != null) {
            $q.="where pp.user_group_id = '$id' ";
        }else{
            $q = "where pp.user_group_id = '0'";
        }
        $sql = "select m.* from tb_user_group_privileges pp
            join tb_privileges p on (pp.privileges_id = p.id)
            join tb_module m on (p.module_id = m.id)
            $q group by p.module_id";
        //echo $sql;
        return $this->db->query($sql);
    }
    
    function menu_user_load_data($id = null, $module = null) {
        $q = null;
        if ($id !== NULL) {
            $q.=" and u.id = '$id'";
        }
        if ($module !== NULL) {
            $q .=  "and p.module_id = '$module' ";
        }
        $sql = "select m.*, p.form_nama, p.url, p.module_id, p.id as id_privileges 
            from tb_user_group_privileges pp
            join tb_privileges p on (pp.privileges_id = p.id)
            join tb_user_group ug on (pp.user_group_id = ug.id)
            join tb_users u on (ug.id = u.id_user_group)
            join tb_module m on (p.module_id = m.id)
            where p.id is not null $q and ug.id = '".$this->session->userdata('id_group')."' and p.show_desktop = '1'
            order by p.form_nama";
        //echo $sql;
        return $this->db->query($sql);
    }
}
?>
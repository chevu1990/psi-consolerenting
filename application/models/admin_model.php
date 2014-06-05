<?php

class admin_model extends CI_Model {    

    public function get_admin(){
        $this->db->select('*');
        $this->db->from('admin');
        $query = $this->db->get();        
        return $query;
    }
    
    public function getpicture(){
        return base_url() . "public/img/" . "default.jpg";
    }

}


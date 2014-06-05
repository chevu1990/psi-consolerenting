<?php

class Rents extends CI_Model{

    public function get_crents(){
        $this->db->select('*');
        $this->db->from('requestc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        }
    }

    public function get_grents(){
        $this->db->select('*');
        $this->db->from('requestgame');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        }
    }
    
    public function getactiverents(){
        return $this->db->count_all('requestgame') + $this->db->count_all('requestc');
    }
    
    public function numberofrents(){
       $this->db->select_sum('rentedcount');
       $this->db->from('game');
       $num1 = $this->db->get()->row('rentedcount');

       $this->db->select_sum('rentedcount');
       $this->db->from('console');
       $num2 = $this->db->get()->row('rentedcount');
       
       return $num1 + $num2;
    }
}
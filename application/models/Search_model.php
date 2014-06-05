<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model
{
    public function get_cautocomplete($search_data)
    {
        $this->db->select('CID');
        $this->db->select('naziv');
        $this->db->like('naziv', $search_data);
        return $this->db->get('console', 10);
    }

    public function get_gautocomplete($search_data)
    {
        $this->db->select('GID');
        $this->db->select('naziv');
        $this->db->like('naziv', $search_data);
        return $this->db->get('game', 10);
    }
}

?>
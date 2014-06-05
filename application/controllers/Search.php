<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function cautocomplete() {
        $search_data = $this->input->post('search_data');
        $this->load->model('Search_model');
        $query = $this->Search_model->get_cautocomplete($search_data);

        foreach ($query->result() as $row):
            echo "<li><a href='" . base_url() . "index.php/frontpage/console/" . $row->CID . "'>" . $row->naziv . "</a></li>";
        endforeach;
    }    

    public function gautocomplete() {
        $search_data = $this->input->post('search_data');
        $this->load->model('Search_model');
        $query = $this->Search_model->get_gautocomplete($search_data);

        foreach ($query->result() as $row):
            echo "<li><a href='" . base_url() . "index.php/frontpage/game/" . $row->GID . "'>" . $row->naziv . "</a></li>";
        endforeach;
    }    
}
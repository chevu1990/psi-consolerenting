<?php

class admin extends CI_Controller{
    
    public function add_console(){
        $this->load->model('Consoles_model');
        
        $dbUpdated = $this->Consoles_model->add_console();
        redirect('frontpage/admin_consoles');
        return true;
    }

    public function add_game(){
        $this->load->model('Games_model');
        
        $dbUpdated = $this->Games_model->add_game();
        redirect('frontpage/admin_games');
        return true;
    }
}
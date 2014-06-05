<?php

class View_model extends CI_Model {

    public function aside() {
       $this->load->library('session');
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('include/asidelog');
        } else {
            $this->load->view('include/aside');
        }    }

    public function header() {
        $this->load->view('include/header');
    }

    public function footer() {
        $this->load->view('include/footer');
    }

   public function login(){
       $this->load->library('session');
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('logedin');
        } else {
            $this->load->view('login');
        }
   }
    
    public function signup($title) {
        $this->header($title);
        $this->aside();
        $this->load->view('register');
        $this->footer();
    }
    
    public function update($title) {
        $this->header($title);
        $this->login();
        $this->aside();
        $this->load->view('changeprofile');
        $this->footer();
    }

    public function rate($title) {
        $this->profile();
    }
    
   public function profile(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->myData();
      $this->load->view('include/footer');
   }

    public function myData() {
        $this->load->model('user_model');
        $data['myData'] = $this->user_model->get_user();
        $data['img'] = $this->user_model->getpicture();
        $data['crents'] = $this->user_model->getCRents();
        $data['grents'] = $this->user_model->getGRents();
        $this->load->view('profile', $data);
    }

    }

?>

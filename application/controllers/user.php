<?php

class user extends CI_Controller {

    public function user() {
        parent::__construct();
    }

    public function index() {
        $this->login();
    }

    public function login() {
        $this->load->view('login');
    }

    public function login_validation() {
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

        if ($this->form_validation->run()) {
            $data = array(
                'email' => $this->input->post('email'),
                'is_logged_in' => 1
            );
            $this->session->set_userdata($data);
            redirect('frontpage/index');
        } else {
            redirect('frontpage/confirm');
        }
    }
    
    public function crents($cid, $rcid) {
        $this->load->library('form_validation');
        $this->load->model('user_model');
   
        $this->form_validation->set_rules('rate', 'Rate', 'required|trim|is_natural_no_zero|less_than[6]');

        if ($this->form_validation->run()) {
            $this->user_model->crents($cid, $rcid);
            redirect('frontpage/profile');
            return true;
        }else{
            $this->rate_view('Try Again...');
        }
    }

    public function grents($gid, $rgid) {
        $this->load->library('form_validation');
        $this->load->model('user_model');
        
        $this->form_validation->set_rules('rate', 'Rate', 'required|trim|is_natural_no_zero|less_than[6]');

        if ($this->form_validation->run()) {
            $this->user_model->grents($gid, $rgid);
            redirect('frontpage/profile');
            return true;
        }else{
            $this->rate_view('Try Again...');
        }
    }

    public function signup() {
        $this->load->library('form_validation');
        $this->load->model('user_model');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('firstName', 'First name', 'required|xss_clean|trim|alpha');
        $this->form_validation->set_rules('lastName', 'Last name', 'required|xss_clean|trim|alpha');

        $this->form_validation->set_message('is_unique', "That email address alredy exists.");

        if ($this->form_validation->run()) {
            $dbInserted = $this->user_model->createNewUser();
            redirect('frontpage/index');
            return true;
        } else {
            $this->signup_view('Try Again...');
        }
    }
    
    public function update() {
        $this->load->library('form_validation');
        $this->load->model('user_model');

        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('firstName', 'First name', 'xss_clean|trim|alpha');
        $this->form_validation->set_rules('lastName', 'Last name', 'xss_clean|trim|alpha');

        if ($this->form_validation->run()) {
            $dbUpdated = $this->user_model->updateUser();
            redirect('frontpage/profile');
            return true;
        } else {
            $this->update_view('Try Again...');
        }
    }
  
    public function validate_credentials() {
        $this->load->library('form_validation');
        $array = array('username' => $this->input->post('email'), 'password' => $this->input->post('password'));
        $this->db->select('username');
        $this->db->select('status');
        $this->db->from('user');
        $this->db->where($array);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            if ($query->row()->status == 1){
               return true;
            }else{
                return false;
            }
        } else{
            $this->db->select('username');
            $this->db->from('admin');
            $this->db->where($array);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return true;      
            }else {
                $this->form_validation->set_message('validate_credentials', 'Incorect username/password');
                return false;
            }
        }
    }

    public function logout() {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('frontpage/index');
    }
    
    public function signup_view($title) {
        $this->load->model('view_model');
        $this->view_model->signup($title);
    }
    
    public function rate_view($title){
        $this->load->model('view_model');
        $this->view_model->rate($title);
    }

    public function update_view($title) {
        $this->load->model('view_model');
        $this->view_model->update($title);
    }
}
?>
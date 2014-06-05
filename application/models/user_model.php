<?php

class user_model extends CI_Model {
    
    public function updateUser(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');
        if ($myEmail){
            $userstat = $this->get_user()->row()->status;
            $usermem = $this->get_user()->row()->membership;
            if ($this->input->post('firstName')){
                $name = $this->input->post('firstName');
            }else{
                $name = $this->get_user()->row()->ime;
            }
            if ($this->input->post('lastName')){
                $lastname = $this->input->post('lastName');
            }else{
                $lastname = $this->get_user()->row()->prezime;
            }
            $data = array(
                'username' => $myEmail,
                'password' => $this->input->post('password'),
                'status' => $userstat,
                'ime' => $name,
                'prezime' => $lastname,
                'email' => $myEmail,
                'membership' => $usermem
            );
            $this->db->where('username', $myEmail);
            $this->db->update('user', $data);
            
            $result = $this->getid()->row();
            $id = $result->UID;
            
            
        $this->load->helper('url');
        $config['upload_path'] = './public/img/';
        $config['allowed_types'] = 'jpg|png';      
        $config['max_size'] = '500';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['overwrite'] = TRUE;


        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('user_file')){
           echo $this->upload->display_errors();
        }else{
            $file_data = $this->upload->data();
            $this->db->where('UID', $id);
            $this->db->delete('image');
            
            $img = array(
                'URL' => base_url() . "public/img/" . $file_data['file_name'],
                'UID' => $id,
                'CID' => 0,
                'GID' => 0
            );
            $this->db->insert('image', $img);	
        }    
        }
    }

    public function crents($cid, $rcid) {
        $this->load->library('session');
        $this->db->where('RCID', $rcid);
        $this->db->delete('requestc');
        
            $this->db->select('count');
            $this->db->from('console');
            $this->db->where('CID', $cid);
            $query = $this->db->get();
            $result = $query->row();
            $cnt = $result->count;
            if ($cnt == 0){
                $stat = 1;
                $this->db->where('CID', $cid);
                $this->db->set('status', $stat);
                $this->db->update('console');
            }
            $cnt++;

            $this->db->where('CID', $cid);
            $this->db->set('count', $cnt);
            $this->db->update('console');

            $this->db->select('ocena');
            $this->db->from('console');
            $this->db->where('CID', $cid);
            $query = $this->db->get();
            $result = $query->row();
            $rate = $result->ocena;
            
            $this->db->select('Broj_Ocena');
            $this->db->from('console');
            $this->db->where('CID', $cid);
            $query = $this->db->get();
            $result = $query->row();
            $ratesum = $result->Broj_Ocena;

            $rate = ($rate * $ratesum + $this->input->post('rate'))/($ratesum + 1);
            $ratesum++;
            
            $this->db->where('CID', $cid);
            $this->db->set('ocena', $rate);
            $this->db->update('console');

            $this->db->where('CID', $cid);
            $this->db->set('Broj_Ocena', $ratesum);
            $this->db->update('console');
    }
    
        public function grents($gid, $rgid) {
        $this->load->library('session');
        $this->db->where('RGID', $rgid);
        $this->db->delete('requestgame');
        
            $this->db->select('count');
            $this->db->from('game');
            $this->db->where('GID', $gid);
            $query = $this->db->get();
            $result = $query->row();
            $cnt = $result->count;
            if ($cnt == 0){
                $stat = 1;
                $this->db->where('GID', $gid);
                $this->db->set('status', $stat);
                $this->db->update('game');
            }
            $cnt++;

            $this->db->where('GID', $gid);
            $this->db->set('count', $cnt);
            $this->db->update('game');

            $this->db->select('ocena');
            $this->db->from('game');
            $this->db->where('GID', $gid);
            $query = $this->db->get();
            $result = $query->row();
            $rate = $result->ocena;
            
            $this->db->select('Broj_Ocena');
            $this->db->from('game');
            $this->db->where('GID', $gid);
            $query = $this->db->get();
            $result = $query->row();
            $ratesum = $result->Broj_Ocena;

            $rate = ($rate * $ratesum + $this->input->post('rate'))/($ratesum + 1);
            $ratesum++;
            
            $this->db->where('GID', $gid);
            $this->db->set('ocena', $rate);
            $this->db->update('game');

            $this->db->where('GID', $gid);
            $this->db->set('Broj_Ocena', $ratesum);
            $this->db->update('game');
    }

    public function getpicture(){
        $myEmail = $this->session->userdata('email');
        if ($myEmail) {
        $result = $this->getid()->row();
        $id = $result->UID;
            $this->db->select('URL');
            $this->db->from('image');
            $this->db->where('UID', $id);
            $qv = $this->db->get();
            if ($qv->num_rows() > 0){
                $result = $qv->row();
                $img = $result->URL;
                return $img;
            }                
            else{
                return base_url() . "public/img/" . "default.jpg";
            }
        }
    }
    
    public function getid(){
        $myEmail = $this->session->userdata('email');
        if ($myEmail) {
            $this->db->select('UID');
            $this->db->from('user');
            $this->db->where('email', $myEmail);
            return $this->db->get();
        }
    }
    
    public function get_user() {
        $myEmail = $this->session->userdata('email');
        if ($myEmail) {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('email', $myEmail);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query;
            }
        }
    }
    
    public function getCRents(){
        $myEmail = $this->session->userdata('email');
 
        if ($myEmail) {
        $result = $this->getid()->row();
        $id = $result->UID;
            $this->db->select('*');
            $this->db->from('requestc');
            $this->db->where('UID', $id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query;
            }                
        }
    }

     public function getGRents(){
        $myEmail = $this->session->userdata('email');
 
        if ($myEmail) {
        $result = $this->getid()->row();
        $id = $result->UID;
            $this->db->select('*');
            $this->db->from('requestgame');
            $this->db->where('UID', $id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query;
            }
        }
    }
    
    public function createNewUser() {
        $data = array(
            'username' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'status' => 0,
            'ime' => $this->input->post('firstName'),
            'prezime' => $this->input->post('lastName'),
            'email' => $this->input->post('email'),
            'membership' => 1,
        );

        $insertStatus = $this->db->insert('user', $data);

        if ($insertStatus) {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_users(){               
            $this->db->select('*');
            $this->db->from('user');
            $querry = $this->db->get();
            return $querry;
    }
    
    public function change_status1($id){
        $userstatus = 1;
        $data = array(                
                'status' => $userstatus,                
            );
        $this->db->where('UID', $id);
        $this->db->update('user', $data);        
    }
    
    public function change_status0($id){
        $userstatus = 0;
        $data = array(                
                'status' => $userstatus,                
            );
            $this->db->where('UID', $id);
            $this->db->update('user', $data);        
    }
    
    public function getusercount(){
        return $this->db->count_all('user');
    }

    public function getactiveusercount(){
        $this->db->where('rentscount >', '0');
        $this->db->from('user');
        return $this->db->count_all_results();
    }
    
}

?>
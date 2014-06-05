<?php
class Consoles_model extends CI_Model {

    public function get_consoles() {
                $this->db->select('*');
                $this->db->from('console');
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query;
                }
        }
        
        public function addccount($cid){
            $cnt = $this->get_console($cid)->row()->count;
            $cnt++;
            if ($cnt < 6){
                $data = array(
                    'count' => $cnt
                );
                $this->db->where('CID', $cid);
                $this->db->update('console', $data);
            }
            if ($cnt == 1){
                $stat = 1;
                $data = array(
                  'status' => $stat  
                );
                $this->db->where('CID', $cid);
                $this->db->update('console', $data);
                
            }
        }
                
        public function deleteccount($cid){
            $cnt = $this->get_console($cid)->row()->count;
            $cnt--;
            if ($cnt >= 0){
                $data = array(
                    'count' => $cnt
                );
                $this->db->where('CID', $cid);
                $this->db->update('console', $data);
            }
            if ($cnt == 0){
                $stat = 0;
                $data = array(
                  'status' => $stat  
                );
                $this->db->where('CID', $cid);
                $this->db->update('console', $data);
            }
        }

        public function add_console(){
            if ($this->input->post('count') > 0){
                $stat = 1;
            }else{
                $stat = 0;
            }
            $data = array(
            'naziv' => $this->input->post('naziv'),
            'opis' => $this->input->post('opis'),
            'status' => $stat,
            'Cena' => $this->input->post('cena'),
            'Ocena' => 5,
            'Broj_Ocena' => 1,
            'count' => $this->input->post('count'),
            'rentedcount' => 0
        );

        $this->db->insert('console', $data);

            $cid = $this->get_c_by_name($this->input->post('naziv'))->row()->CID;
            
            $this->load->helper('url');
            $config['upload_path'] = './public/consoles/';
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
                $this->db->where('CID', $cid);
                $this->db->delete('image');

                $img = array(
                    'URL' => base_url() . "public/consoles/" . $file_data['file_name'],
                    'UID' => 0,
                    'CID' => $cid,
                    'GID' => 0
                );
                $this->db->insert('image', $img);	
            }    

        }
        
        public function get_c_by_name($name){
                $this->db->select('*');
                $this->db->from('console');
                $this->db->where('naziv', $name);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                return $query;}
                else { echo "there is no such console in database";
                }        
        }
        

        public function get_console($id){
                $num = $this->db->count_all('game');                     
                $this->db->select('*');
                $this->db->from('console');
                $this->db->where('CID', $id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                return $query;}
                else { echo "there is no such console in database";
                }        
        }
        
    public function createRent($id) {
        $this->load->library('session');
        $email = $this->session->userdata('email');
        if ($email){
        $this->load->helper('date_helper');   
        $this->load->model('user_model');
        $date = date('Y-m-d');
        $days=$this->input->post('days');
        $datereturn = date('Y').'-'.date('m').'-'.(date('d') + $days);            
        $dataconsole = $this->get_console($id);
        $datauser = $this->user_model->get_user();
        $consoleStatus = $dataconsole->row()->status;
        $consoleId = $dataconsole->row()->CID; 
        $consoleCount= $dataconsole->row()->count;
        $rentedCount= $dataconsole->row()->rentedcount;
        $userId = $datauser->row()->UID;  
        $userCount = $datauser->row()->rentscount;
        $userMembership = $datauser->row()->membership;
        
        if($consoleStatus>0 && $consoleCount>0){          
            $data = array(
                 'DatumOd' => $date,
                 'DatumDo' => $datereturn,
                 'CID' => $consoleId,
                 'UID' => $userId
            );
            $this->db->insert('requestc',$data);
            $consoleCount--;       
            $rentedCount++;
            $consoleUpdate = array('count' => $consoleCount, 'rentedcount' => $rentedCount);            
            $this->db->where('CID', $consoleId);
            $this->db->update('console', $consoleUpdate);
            
            
            $userCount++;
            if($userCount >=10 && $userCount<50){
                    $userMembership = 2;
                    $usermData = array('membership'=>$userMembership);
                    $this->db->where('UID', $userId);
                    $this->db->update('user', $usermData);                    
                }
                else if($userCount>=50 ){
                    $userMembership = 3;
                    $usermData = array('membership' => $userMembership);
                    $this->db->where('UID', $userId);
                    $this->db->update('user', $usermData);
                }

            $usercData = array('rentscount'=>$userCount);
            $this->db->where('UID',$userId);
            $this->db->update('user', $usercData);
            
            if($consoleCount == 0){
                $consoleStatus = 0;
                $consoleUpdate = array('status' => $consoleStatus);            
                $this->db->where('CID', $consoleId);
                $this->db->update('console', $consoleUpdate);                
            }
            }       
        else{
                echo "trenutno nema slobodnih konzola!!!";
        }     
        
        }
        else{
            redirect('frontpage/login_req');
        }
    }
    
   public function get_images(){                     
            $id =0;
            $this->db->select('*');
            $this->db->from('image');
            $this->db->where('CID >', $id);
            $qv = $this->db->get();
            if ($qv == NULL){  
                return base_url() . "public/consoles/" . "default.jpg";
            }
            return $qv;
   }
        
   public function get_image($id){                     
            $this->db->select('*');
            $this->db->from('image');
            $this->db->where('CID', $id);
            $qv = $this->db->get();
            if ($qv == NULL){  
                return base_url() . "public/consoles/" . "default.jpg";
            }
            return $qv;
   }

}

?>
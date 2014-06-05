<?php


class Games_model extends CI_Model {

    public function get_games() {
            $num = $this->db->count_all('game');                         
                $this->db->select('*');
                $this->db->from('game');
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    return $query;
                }            
        }
        
       public function add_game(){

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
            'rentedcount' => 0,
        );

        $this->db->insert('game', $data);
            
            $gid = $this->get_g_by_name($this->input->post('naziv'))->row()->GID;
            
            $this->load->helper('url');
            $config['upload_path'] = './public/games/';
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
                $this->db->where('GID', $gid);
                $this->db->delete('image');

                $img = array(
                    'URL' => base_url() . "public/games/" . $file_data['file_name'],
                    'UID' => 0,
                    'CID' => 0,
                    'GID' => $gid
                );
                $this->db->insert('image', $img);	
            }    

        }
        
        public function get_g_by_name($name){
                $this->db->select('*');
                $this->db->from('game');
                $this->db->where('naziv', $name);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                return $query;}
                else { echo "there is no such console in database";
                }        
        }

        
    public function get_game($id){
        $num = $this->db->count_all('game');      
                     
                $this->db->select('*');
                $this->db->from('game');
                $this->db->where('GID', $id);
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                return $query;}
                else { echo "there is no such game in database";
                }        
    }
    
    public function createRent($id) {
        $this->load->helper('date_helper');   
        $this->load->model('user_model');
        $date=date('Y-m-d');
        $days=$this->input->post('days');
        $datereturn=date('Y').'-'.date('m').'-'.(date('d')+$days);            
        $datagame = $this->get_game($id);
        $datauser = $this->user_model->get_user();
        $gameStatus = $datagame->row()->status;
        $gameId = $datagame->row()->GID; 
        $gameCount= $datagame->row()->count;
        $rentedCount= $datagame->row()->rentedcount;
        $userId = $datauser->row()->UID;  
        $userCount = $datauser->row()->rentscount;
        $userMembership =$datauser->row()->membership;
        
        if($gameStatus>0 && $gameCount>0){          
            $data = array(
                 'DatumOd' => $date,
                 'DatumDo' => $datereturn,
                 'GID' => $gameId,
                 'UID' => $userId
            );
            $this->db->insert('requestgame',$data);
            $gameCount--;          
            $rentedCount++;
            $gameUpdate = array('count'=>$gameCount, 'rentedcount' => $rentedCount);            
            $this->db->where('GID',$gameId);
            $this->db->update('game',$gameUpdate);           
            $userCount++;                
                if($userCount >=10 && $userCount<50){
                    $userMembership=2;
                    $usermData = array('membership'=>$userMembership);
                    $this->db->where('UID',$userId);
                    $this->db->update('user', $usermData);                    
                }
                else if($userCount>=50 ){
                    $userMembership=3;
                    $usermData = array('membership'=>$userMembership);
                    $this->db->where('UID',$userId);
                    $this->db->update('user', $usermData);
                }            
            
            $usercData = array('rentscount'=>$userCount);
            $this->db->where('UID',$userId);
            $this->db->update('user', $usercData);
            if($gameCount==0){
                $gameStatus=0;
                $StatusUpdate = array('status'=>$gameStatus);            
                $this->db->where('GID',$gameId);
                $this->db->update('game',$StatusUpdate);                
            }      
            }
        else{
                echo "trenutno nema slobodnih kopija!!!";
            }        
    }
    
    public function addgcount($gid){
            $cnt = $this->get_game($gid)->row()->count;
            $cnt++;
            if ($cnt < 6){
                $data = array(
                    'count' => $cnt
                );
                $this->db->where('GID', $gid);
                $this->db->update('game', $data);
            }
            if ($cnt == 1){
                $stat = 1;
                $data = array(
                  'status' => $stat  
                );
                $this->db->where('GID', $gid);
                $this->db->update('game', $data);
            }
        }
                
        public function deletegcount($gid){
            $cnt = $this->get_game($gid)->row()->count;
            $cnt--;
            if ($cnt >= 0){
                $data = array(
                    'count' => $cnt
                );
                $this->db->where('GID', $gid);
                $this->db->update('game', $data);
            }
            if ($cnt == 0){
                $stat = 0;
                $data = array(
                  'status' => $stat  
                );
                $this->db->where('GID', $gid);
                $this->db->update('game', $data);
            }
        }
        
    public function get_images(){                     
            $id =0;
            $this->db->select('*');
            $this->db->from('image');
            $this->db->where('GID >', $id);
            $qv = $this->db->get();
            if ($qv == NULL){  
                return base_url() . "public/games/" . "default.jpg";
            }
            return $qv;
    }
        
    public function get_image($id){                     
            $this->db->select('*');
            $this->db->from('image');
            $this->db->where('GID', $id);
            $qv = $this->db->get();
            if ($qv == NULL){  
                return base_url() . "public/games/" . "default.jpg";
            }
            return $qv;
    }
}

?>
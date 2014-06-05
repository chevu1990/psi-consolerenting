<?php if (!defined('BASEPATH')) die();
class Frontpage extends CI_Controller{

    public function index(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->load->view('frontpage');
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

   public function getpicture(){
        $this->load->model('user_model');
        $img = $this->user_model->getpicture();
        $this->load->view('profile', $img);
       
   }
   
   public function aside(){
       $this->load->library('session');
        if ($this->session->userdata('is_logged_in')) {
            if (!strcmp($this->session->userdata('email'), 'admin@admin.com')){
                    $this->load->view('include/asideAdmin');
            }
            else{
                $this->load->view('include/asidelog');
            }
        } else {
            $this->load->view('include/aside');
        }
   }
   
    public function myData() {
        $this->load->model('user_model');
        $data['myData'] = $this->user_model->get_user();
        $data['img'] = $this->user_model->getpicture();
        $data['crents'] = $this->user_model->getCRents();
        $data['grents'] = $this->user_model->getGRents();
        $this->load->view('profile', $data);
    }
   
   public function register(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');
        
        if (!$myEmail){
            $this->load->view('include/header');
            $this->aside();
            $this->load->view('register');
            $this->load->view('include/footer');
        }else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->view('logout_req');
            $this->load->view('include/footer');            
        }
   }
   
   public function contact(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->load->view('contact');
      $this->load->view('include/footer');
   }
   
   public function profile(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->myData();
      $this->load->view('include/footer');
   }

   public function changeprofile(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->load->view('changeprofile');          
      $this->load->view('include/footer');
   }
   
   public function mail(){
       $this->load->library('email');
     
        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to('suport@consolerenting.com'); 

        $this->email->subject('Contact form');
        $this->email->message($this->input->post('message'));	

        $this->email->send();
        
        $this->load->view('include/header');
        $this->login();
        $this->aside();
        $this->load->view('contact');
        $this->load->view('include/footer');

   }
   
   public function games(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->GamesData();      
      $this->load->view('include/footer'); 
   }
   
   public function game($id){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->GameData($id);      
      $this->load->view('include/footer'); 
   }
   
    public function game_n($id){
      $this->load->view('include/header');
      $this->login_req();
      $this->aside();
      $this->GameData($id);      
      $this->load->view('include/footer');
    }
   
   public function consoles(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->ConsolesData();
      $this->load->view('include/footer'); 
   }
   
   public function console($id){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->ConsoleData($id);     
      $this->load->view('include/footer'); 
   }
   public function about(){
      $this->load->view('include/header');
      $this->login();
      $this->aside();
      $this->load->view('about');      
      $this->load->view('include/footer');
   }
   
   public function GamesData(){
       $this->load->model('games_model');
       $data['GamesData'] = $this->games_model->get_games();
       $data['ImgData'] = $this->games_model->get_images();
       $this->load->view('games', $data);
   }
   
   public function GameData($id){
       $this->load->model('games_model');
       $this->load->model('user_model');
       $data['GamesData'] = $this->games_model->get_game($id);
       $data['UserData'] = $this->user_model->get_user();
       $data['ImgData'] = $this->games_model->get_image($id);
       $this->load->view('game', $data);
   }
   
   public function ConsolesData(){
       $this->load->model('consoles_model');
       $data['ConsolesData'] = $this->consoles_model->get_consoles();
       $data['ImgData'] = $this->consoles_model->get_images();
       $this->load->view('consoles', $data);
   }
   
   public function ConsoleData($id){
       $this->load->model('Consoles_model');
       $this->load->model('user_model');
       $data['ConsoleData'] = $this->Consoles_model->get_console($id);
       $data['UserData'] =$this->user_model->get_user();
       $data['ImgData'] = $this->Consoles_model->get_image($id);
       $this->load->view('console', $data);
   }
   
    public function createRent($id){
        $this->load->library('session');
        
        if($this->session->userdata('is_logged_in')){
            $this->load->model('Games_model');
            $this->Games_model->createRent($id);
            $this->profile();            
        }
   }   
   
   public function createRentConsole($id){
        $this->load->library('session');
        
        if($this->session->userdata('is_logged_in')){
            $this->load->model('Consoles_model');
            $this->Consoles_model->createRent($id);
            $this->profile();            
        }
   }
   
   public function admin_consoles(){ 
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->model('Consoles_model');
            $data['cons'] = $this->Consoles_model->get_consoles();
            $this->load->view('admin_consoles', $data);      
            $this->load->view('include/footer'); 
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer'); 
            
        }
   }
   
   public function admin_req() {
       $this->load->view('admin_req');
   }
   
   public function admin_games(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->model('Games_model');
            $data['gms'] = $this->Games_model->get_games();
            $this->load->view('admin_games', $data);      
            $this->load->view('include/footer');
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer');
            
        }
   }
   
   public function add_game(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->view('add_game');      
            $this->load->view('include/footer');
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer');
            
        }
   }
   
   public function add_console(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->view('add_console');      
            $this->load->view('include/footer');
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer');
            
        }
   }
   
   public function admin_rents(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->model('Rents');
            $data['conrents'] = $this->Rents->get_crents();
            $data['gamrents'] = $this->Rents->get_grents();
            $this->load->view('admin_rents', $data);      
            $this->load->view('include/footer');
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer');
        }
   }   
   
   public function manage_profiles(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->model('user_model');
            $data['users']= $this->user_model->get_users();
            $this->load->view('manage_profiles', $data);      
            $this->load->view('include/footer');
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer');
        }
   }
   
   public function addccount($cid){
       $this->load->model('Consoles_model');
       $this->Consoles_model->addccount($cid);
       $this->admin_consoles();
   }

   public function manage_profiles1($id){           
        $this->load->model('user_model');
        $data['users']= $this->user_model->change_status1($id);
        $this->manage_profiles();
   }
   
   public function manage_profiles0($id){           
        $this->load->model('user_model');
        $data['users']= $this->user_model->change_status0($id);
        $this->manage_profiles();
   }

   public function admin_profile(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->model('admin_model');
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $data['admin'] = $this->admin_model->get_admin();
            $data['img'] = $this->admin_model->getpicture();
            $this->load->view('admin_profile',$data);
            $this->load->view('include/footer');   
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer');
        }
   }   
   public function deleteccount($cid){
       $this->load->model('Consoles_model');
       $this->Consoles_model->deleteccount($cid);
       $this->admin_consoles();
   }

   public function addgcount($gid){
       $this->load->model('Games_model');
       $this->Games_model->addgcount($gid);
       $this->admin_games();
   }

   public function deletegcount($gid){
       $this->load->model('Games_model');
       $this->Games_model->deletegcount($gid);
       $this->admin_Games();
   }
   
   public function login_c(){
       $this->load->view('login_c');
   }

   public function confirm(){
      $this->load->view('include/header');
      $this->login_c();
      $this->aside();
      $this->load->view('frontpage');
      $this->load->view('include/footer'); 
   }
   
   public function admin_statistic(){
        $this->load->library('session');
        $myEmail = $this->session->userdata('email');

        if (!strcmp($myEmail, 'admin@admin.com')){
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->load->model('user_model');
            $data['usercount'] = $this->user_model->getusercount();
            $data['useractivecount'] = $this->user_model->getactiveusercount();
            $this->load->model('Rents');
            $data['activerents'] = $this->Rents->getactiverents();
            $data['numberofrents'] = $this->Rents->numberofrents();
            $this->load->view('admin_statistic', $data);      
            $this->load->view('include/footer');
        }
        else{
            $this->load->view('include/header');
            $this->login();
            $this->aside();
            $this->admin_req();
            $this->load->view('include/footer');
        }

   }
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */

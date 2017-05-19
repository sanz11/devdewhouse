<?php 
class Clogin extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('Mlogin');
    } 
    
    public function index(){
        $data['show']="none";//
        $this->load->view("vlogin",$data);//cuando se llame a este controlador habrira la vista  vlogin
    }
    
     public function Login(){
        $user =$this->input->post('user');//capturamos lo valores de los inputs
        $pass= $this->input->post('pass');
         
         $resultad = $this->Mlogin->login($user,$pass);//ejecutamos la consulta a la base de datos en  el model
          
        if($resultad ==1){
            header('Location: '.base_url().'Dashboard');
        }
         else{
              $data['show']="";
              $this->load->view("vlogin",$data);
         }
    }
     public function Logout(){
      $this->session->sess_destroy();
      $data['show']="none";
      $this->load->view("vlogin",$data);
    }
}


?>
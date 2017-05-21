<?php
class Dashboard extends CI_Controller{
    
    function __construct(){
        parent::__construct();
         $this->load->model('cliente_model');
        $this->load->model('Habitacion_model');
        $this->load->model('Users_model');
        if(!isset($this->session->userdata['home_user'])||$this->session->userdata['home_user']==null){
        redirect(base_url());
        }
    } 
    public function index(){  
        $data['active']="dashboard";
        $data['titulo']="Página Principal";
        //datos para el menu
        $usercode=$this->session->userdata['home_user'];
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        //FIN datos para el menu
        
        $tenants=$this->cliente_model->get_list();
        $rooms=$this->Habitacion_model->listar_ncuarto();
        $data['list']=$rooms;
        $roomsfree=$this->Habitacion_model->get_list('0');
        
        $data['ntenants']=count($tenants);
        $data['nroom']=count($rooms);
        $data['nfreeroom']=count($roomsfree);
        $this->loadviews('dashboard',$data);
        
    }
    public function loadviews($view,$data){
        $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view($view,$data);
        $this->load->view("layout/footer");
    }
}

?>
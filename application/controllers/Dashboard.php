<?php
class Dashboard extends CI_Controller{
    
    function __construct(){
        parent::__construct();
         $this->load->model('cliente_model');
        $this->load->model('Habitacion_model');
        $this->load->model('Alquiler_model');
        $this->load->model('Cliente_model');
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
        $rooms=$this->Habitacion_model->get_list();
        $result=$this->Alquiler_model->listar();
        $lista=array();
        if(count($result)>0){
            foreach($result as $item =>$value){
                $codigo =$value->alquiler_Code;
                $serie =$this->serie($value->alquiler_Serie);
                $numero =$this->numero($value->alquiler_Numero);
                $tipo =$value->alquiler_tDocumento;
                $fechaf =$value->inquilino_FechaFin;
                $total =$value->alquiler_Total;
                $pendiente =$value->alquiler_pendiente;
                
                $inquilino= $this->Cliente_model->get_cliente($value->inquilino_Code);
                $inquilinoname =$inquilino[0]->person_Name." ".$inquilino[0]->person_LastName." ".$inquilino[0]->person_LastName2;
                
                $cuarto= $this->Habitacion_model->get_habitacion($value->room_Code);
                $ncuarto =$cuarto[0]->room_Number;
                
                
               $lista[]=array($codigo,$serie,$numero,$tipo,$fechaf,$total,$pendiente,$inquilinoname,$ncuarto,$value->room_Code,$value->inquilino_Code);
            }
        }
        $data['list']=$lista;
        $roomsfree=$this->Habitacion_model->get_list('0');
        $cobros=$this->Alquiler_model->listcobrar();
        
        $data['ntenants']=count($tenants);
        $data['nroom']=count($rooms);
         $data['cobros']=count($cobros);
        $data['nfreeroom']=count($roomsfree);
        $this->loadviews('dashboard',$data);
        
    }
    public function loadviews($view,$data){
        $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view($view,$data);
        $this->load->view("layout/footer");
    }
      public function serie($serie){
        $cantidad=strlen($serie);
        $data=$serie;
        if($cantidad==1){
            $data='00'.$serie;
        }
         if($cantidad==2){
            $data='0'.$serie;
        }
        return $data;
    }
    public function numero($numero){
        $cantidad=strlen($numero);
        $data=$numero;
        if($cantidad==1){
            $data='000000'.$numero;
        }
         if($cantidad==2){
            $data='00000'.$numero;
        }
        if($cantidad==3){
            $data='0000'.$numero;
        }
         if($cantidad==4){
            $data='000'.$numero;
        }
        if($cantidad==5){
            $data='00'.$numero;
        }
        if($cantidad==6){
            $data='0'.$numero;
        }
        return $data;
    }
  
}

?>
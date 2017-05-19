<?php 
class Cobros extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('Cobros_model');
        $this->load->model('Users_model');
         $this->load->model('Room_model');
if(!isset($this->session->userdata['home_user'])||$this->session->userdata['home_user']==null){
        redirect(base_url());
        }
    } 
    public function index(){
        //datos para el menu
        $usercode=$this->session->userdata['home_user'];
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        $roomscobros=$this->Room_model->get_cobros('0');
        $data['npay']=count($roomscobros);
        //FIN datos para el menu
       $list=$this->Room_model->get_list('','cobro');
        if(count($list)>0){
            foreach($list as $item => $value){
                $numero=$value->room_Number;
                $fecha=$value->room_DatePay;
                $price=$value->room_Price;
                $ocuped=$value->room_Occupied;
                $code=$value->room_Code;
                $resut=$this->Cobros_model->get_pago($code,date('Y'),date('m'));
                if(count($resut)>0){
                    $deuda="<span style='background:chartreuse;padding:4px; color:#333'>Pagado </span>";
                }
                else{
                    if(date("m-d", strtotime($fecha))<date('m-d')){
                       $deuda="<span style='background:crimson;padding:4px; color:white'>Con deuda </span>";
                    }else{
                        $deuda="<span style='background:deepskyblue;padding:4px; color:white'>pendiente </span>";
                    }
                }
                    
                $lista[]=array($numero,$fecha,$price,$ocuped,$code,$deuda);
            }
        }
       $data['list']=$lista;
        
        $data['active']="cobros";
        $data['titulo']="Tesoreria";
       $this->loadviews('cobros_index',$data);
    }
    public function cobrar(){
        $code=$this->input->post('coderoom');
        $precio=$this->input->post('precio');
        $filter = new stdClass();
        $filter->cob_Code='';
        $filter->room_Code=$code;
        $filter->cob_DatePay=date('Y-m-d');
        $filter->cob_State=1;
         $filter->cob_Total=$precio;
        $this->Cobros_model->cobrar($filter);
        exit('{"result":"ok","codigo":"1"}');
        }

    public function loadviews($view,$data){
        $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view($view,$data);
        $this->load->view("layout/footer");
    }
    public function reportecobros(){
      $code=  $this->input->post('codecobros');
        $result= $this->Cobros_model->reportecobros($code);
        echo json_encode($result);
    }
    public function update(){
        $code =$this->input->post('codecob');
        $precio =$this->input->post('precio');
                    
       $inquilino=$this->Cobros_model->update($code,$precio);
        
        
        exit('{"result":"ok","codigo":"'.$code.'"}');
        
        }
  
}

?>
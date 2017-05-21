<?php 
include("application/libraries/cezpdf.php");
include("application/libraries/class.backgroundpdf.php");
class Room extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Room_model');
        $this->load->model('Users_model');
        $this->load->helper('form');
        if(!isset($this->session->userdata['home_user'])||$this->session->userdata['home_user']==null){
        redirect(base_url());
        }
    } 
    public function index(){
       $list=$this->Room_model->get_list();
         //datos para el menu
       
        $usercode=$this->session->userdata['home_user'];
        
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        //FIN datos para el menu
        $data['list']=$list;
        $data['number']="";
        $data['floor']="";
		$data['precio']="";
        $data['estado']=form_dropdown('estado', array('1'=> 'Actuales','0'=> 'Pasados','2'=> 'Todos'), '1','id="estadob" class="form-control"');
        
        $data['active']="room";
        $data['titulo']="Mantenimiento de Habitaciones";
        
        $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view("habitacion_index",$data);
        $this->load->view("layout/footer");
    }
	public function nuevo(){
       $list=$this->Room_model->get_list();
         //datos para el menu
       
        $usercode=$this->session->userdata['home_user'];
        
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        //FIN datos para el menu
        $data['list']=$list;
        $data['number']="";
        $data['floor']="";
        $data['estado']=form_dropdown('estado', array('1'=> 'Actuales','0'=> 'Pasados','2'=> 'Todos'), '1','id="estadob" class="form-control"');
        
        $data['active']="room";
        $data['titulo']="Mantenimiento de Habitaciones";
        
        $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view("nueva_habitacion",$data);
        $this->load->view("layout/footer");
    }
     public function search(){
         //datos para el menu
        $usercode=$this->session->userdata['home_user'];
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        $roomscobros=$this->Room_model->get_cobros('0');
        $data['npay']=count($roomscobros);
        //FIN datos para el menu
         $number=$this->input->post('number');
         $floor=$this->input->post('floor');
          $state=$this->input->post('state');
         
         $result=$this->Room_model->search($number,$floor,$state);
         
         $data['list']=$result;
        
        $data['number']=$number;
        $data['floor']=$floor;
        $data['active']="room";
        $data['titulo']="Mantenimiento de Habitaciones";
       $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view("habitacion_index",$data);
        $this->load->view("layout/footer");
        }
    public function add_room(){
		 $bath =$this->input->post('bath');
         $laundry=$this->input->post('laundry');
         $cable=$this->input->post('cable');
         $internet=$this->input->post('internet');
         //$datepay=$this->input->post('datepay');
        
        if($bath==""){$bath="0";}
        if($laundry==""){$laundry="0";}
        if($cable==""){$cable="0";}
        if($internet==""){$internet="0";}
        
        $filter = new stdClass();
		$filter->room_Number=$this->input->post('number');
        $filter->room_Floor=$this->input->post('floor');
        $filter->room_Size=$this->input->post('size');
        $filter->room_Price=$this->input->post('price');
        $filter->room_Description=$this->input->post('description');
        //$filter->room_Floors=$this->input->post('floors');
        //$filter->room_DatePay=$this->input->post('datepay');
        $filter->room_Bath=$bath;
        $filter->room_Laundry=$laundry;
        $filter->room_Cable=$cable;
        $filter->room_Internet=$internet;
        //$filter->room_Date= $datepay;
        $filter->room_Occupied=0;
        $filter->room_State=1;
        
        $result=$this->Room_model->add_room($filter);
        
        exit('{"result":"ok","codigo":"'.$result.'"}');
        
        
    }
    public function edit_room(){
         $id =$this->input->post('id');
         $bath =$this->input->post('bath');
         $laundry=$this->input->post('laundry');
         $cable=$this->input->post('cable');
         $internet=$this->input->post('internet');
         $datepay=$this->input->post('datepay');
        
        if($bath==""){$bath="0";}
        if($laundry==""){$laundry="0";}
        if($cable==""){$cable="0";}
        if($internet==""){$internet="0";}
        
        $filter = new stdClass();
        $filter->room_Number=$this->input->post('number');
        $filter->room_Floor=$this->input->post('floor');
        $filter->room_Size=$this->input->post('size');
        $filter->room_Price=$this->input->post('price');
        $filter->room_Description=$this->input->post('description');
        $filter->room_Floors=$this->input->post('floors');
        $filter->room_DatePay=$datepay;
        $filter->room_Bath=$bath;
        $filter->room_Laundry=$laundry;
        $filter->room_Cable=$cable;
        $filter->room_Internet=$internet;
		$filter->room_Date= $datepay;
        $filter->room_Occupied=0;
        $filter->room_State=1;
        
        $result=$this->Room_model->edit_room($filter,$id);
        
        exit('{"result":"ok","codigo":"'.$result.'"}');
        
        
    }
     public function delete_room(){
         $coderoom =$this->input->post('coderoom');
        
        $result=$this->Room_model->delete_room($coderoom);
        
        exit('{"result":"ok","codigo":"'.$result.'"}');
    }
    public function listedit_room(){
        
         $code=$this->input->post('coderoom');
         
         $result=$this->Room_model->edit($code);
         
         echo json_encode($result);
    }
    public function desocupar_room(){
        $coderoom =$this->input->post('coderoom');
        
        $this->Room_model->desocupar_room($coderoom);
        $result=$this->Room_model->limpiar_inquilino($coderoom);
        exit('{"result":"ok","codigo":"'.$result.'"}');
    }
     public function print_pdf($numberb,$floorb,$stateb)
    {
        $this->cezpdf = new cezpdf('a4','portrait');
        $this->cezpdf->selectFont('fonts/Helvetica.afm');
        /* Cabecera */
        $suma = '';

        $listado = $this->Room_model->get_pdf($numberb,$floorb,$stateb);

    
        foreach ($listado as $key => $value) {
           $suma=$suma+$value->room_Price;
            $db_data[] = array(
                'col1' => $key + 1,
                'col2' => $value->room_Number,
                'col3' => $value->room_Floor,
                'col4' => $value->room_Size.'m',
                'col5' => 'S/.'.number_format($value->room_Price,2),
                'col6' => $value->room_Description,
                'col7' => $value->room_Floors
            );
        }
          $db_data[] = array(
                'col1' => '',
                'col2' => '',
                'col3' => '',
                'col4' => 'Total',
                'col5' => 'S/.'.number_format($suma,2),
                'col6' => '',
                'col7' => ''
            );
          
        $col_names = array(
            'col1' => '<b>Itm</b>',
            'col2' => '<b>N'.utf8_decode('°').' DE CUARTO</b>',
            'col3' => '<b>PLANTA</b>',
            'col4' => '<b>'.utf8_decode('TAMAÑO').'</b>',
            'col5' => '<b>PRECIO</b>',
            'col6' => '<b>DESCRIPCION</b>',
            'col7' => '<b>PISOS</b>'
        );
    
    $this->cezpdf->ezText('', '', array("leading" => 5));
         
    //$this->cezpdf->ezImage(base_url()."assets/img/logo.jpg", 30, 130, 'full','left','');
	$this->cezpdf->ezText('', '', array("leading" => 0));
    
         if($stateb==0){$estado='DISPONIBLES'; $left='140';}
         else if($stateb==1){$estado='OCUPADOS'; $left='140';}
         else{$estado='';$left='170';}
	
	$this->cezpdf->ezText('<b>TOTAL DE CUARTOS :   </b>'.count($listado), 9, array("leading" => -50, 'left' => 200));
	$this->cezpdf->ezText('<b>FECHA DE REPORTE   :   </b>'.date('Y-m-d'), 9, array("leading" => 15, 'left' => 200));
	
	$this->cezpdf->ezText('', '', array("leading" => 5));
	$this->cezpdf->ezText('<b> LISTA DE CUARTOS '.$estado.'</b>', 14, array("leading" => 38, 'left' => $left));
	$this->cezpdf->ezText('', '', array("leading" => 2));
	//$this->cezpdf->ezText('<b>TOTAL DE INQUILINOS:   </b>'.count($listado), 8, array("leading" => 15, 'left' => 40));
	$this->cezpdf->ezText('', '', array("leading" => 8));


        $this->cezpdf->ezTable($db_data, $col_names, '', array(
            'width' => 500,
            'showLines' => 1,
            'shaded' => 1,//FONDO ENTRE LINEAS
            'showHeadings' => 1,
            'xPos' => 'center',
            'fontSize' => 8,
            'cols' => array(
                'col1' => array('width' => 25, 'justification' => 'center'),
                'col2' => array('width' => 75, 'justification' => 'center'),
                'col3' => array('width' => 45, 'justification' => 'center'),
                'col4' => array('width' => 45, 'justification' => 'center'),
                'col5' => array('width' => 60, 'justification' => 'center'),
                'col6' => array('width' => 170, 'justification' => 'center'),
                'col7' => array('width' => 35, 'justification' => 'center')
            )
        ));
      
        $cabecera = array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'nama_file.pdf', 'Expires' => '0', 'Pragma' => 'cache', 'Cache-Control' => 'private');
        $this->cezpdf->ezStream($cabecera);
    }
}
?>
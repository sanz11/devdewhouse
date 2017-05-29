<?php 
include("application/libraries/class.ezpdf.php");
include("application/libraries/class.backgroundpdf.php");
class Reporte extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Alquiler_model');
        $this->load->model('Users_model');
         $this->load->model('Habitacion_model');
         $this->load->model('Cliente_model');
        $this->load->helper('form');
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
        //FIN datos para el menu
        $data['fechai']=date('Y-m-d');
        $data['fechaf']=date('Y-m-d');
        
         $ncuartos = $this->Habitacion_model->get_list();
        $options = array('0'=> 'selecciona');
         if(count($ncuartos)){
            foreach($ncuartos as $value){
               $options[$value->room_Code] = $value->room_Number;
            }
        }
        $data['cuartob']=form_dropdown('cuartob', $options, '0','id="cuartob" class="form-control"');  
        $data['fechai2']=date('Y-m-d');
        $data['fechaf2']=date('Y-m-d');
        
        $data['active']="reporte";
        $data['titulo']="Reporte de venta";
       $this->loadviews('reporte_index',$data);
    }
    public function reportediario($fechai,$fechaf){
        $this->cezpdf = new cezpdf('a4','portrait');
        $this->cezpdf->selectFont('fonts/Helvetica.afm');
        /* Cabecera */
        $suma = '';

        $listado=$this->Alquiler_model->reportediario($fechai,$fechaf);

    
        foreach ($listado as $key => $value) {
           $suma=$suma+$value->alquiler_Total;
            $db_data[] = array(
                'col1' => $key + 1,
                'col2' => $this->serie($value->alquiler_Serie),
                'col3' => $this->numero($value->alquiler_Numero),
                'col4' => $value->person_Name.' '.$value->person_LastName.' '.$value->person_LastName2,
                'col5' => $value->alquiler_FechaRegistro,
                'col6' => 'S/.'.number_format(($value->alquiler_SubTotal+$value->alquiler_aumento),2),
                'col7' => 'S/.'.number_format($value->alquiler_Descuento,2),
                'col8' => 'S/.'.number_format($value->alquiler_Total,2)
            );
        }
          $db_data[] = array(
                'col1' => '',
                'col2' => '',
                'col3' => '',
                'col4' => '',
                'col5' => '',
                'col6' => '',
                'col7' => 'Total',
                'col8' => 'S/.'.number_format($suma,2)
            );
          
        $col_names = array(
            'col1' => '<b>Itm</b>',
            'col2' => '<b>SERIE</b>',
            'col3' => '<b>N'.utf8_decode('°').' DOC.</b>',
            'col4' => '<b>CLIENTE</b>',
            'col5' => '<b>FECHA</b>',
            'col6' => '<b>SUBTOTAL</b>',
            'col7' => '<b>DESCUENTO</b>',
            'col8' => '<b>TOTAL</b>'
        );
    
	$this->cezpdf->ezText('', '', array("leading" => 5));
	$this->cezpdf->ezText('<b>REPORTE DE VENTAS DIARIAS</b>', 14, array("leading" => 38, 'left' => 150));
    $this->cezpdf->ezText('<b>DESDE:</b> '.$fechai.' <b>HASTA:</b> '.$fechaf, 9, array("leading" => 15, 'left' => 170));
	$this->cezpdf->ezText('', '', array("leading" => 2));
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
                'col2' => array('width' => 40, 'justification' => 'center'),
                'col3' => array('width' => 50, 'justification' => 'center'),
                'col4' => array('width' => 150, 'justification' => 'center'),
                'col5' => array('width' => 60, 'justification' => 'center'),
                'col6' => array('width' => 60, 'justification' => 'center'),
                'col7' => array('width' => 70, 'justification' => 'center'),
                'col8' => array('width' => 70, 'justification' => 'center')
            )
        ));
      
        $cabecera = array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'nama_file.pdf', 'Expires' => '0', 'Pragma' => 'cache', 'Cache-Control' => 'private');
        $this->cezpdf->ezStream($cabecera);
    }
    
    public function reportecuarto($cuartoid,$fechai,$fechaf){
        $this->cezpdf = new cezpdf('a4','portrait');
        $this->cezpdf->selectFont('fonts/Helvetica.afm');
        /* Cabecera */
        $suma = '';

        $listado=$this->Alquiler_model->reportecuarto($cuartoid,$fechai,$fechaf);
        $cuarto=$this->Habitacion_model->get_habitacion($cuartoid);
    
        foreach ($listado as $key => $value) {
           $suma=$suma+$value->alquiler_Total;
            $db_data[] = array(
                'col1' => $key + 1,
                'col2' => $this->serie($value->alquiler_Serie),
                'col3' => $this->numero($value->alquiler_Numero),
                'col4' => $value->person_Name.' '.$value->person_LastName.' '.$value->person_LastName2,
                'col5' => $value->alquiler_FechaRegistro,
                'col6' => 'S/.'.number_format(($value->alquiler_SubTotal+$value->alquiler_aumento),2),
                'col7' => 'S/.'.number_format($value->alquiler_Descuento,2),
                'col8' => 'S/.'.number_format($value->alquiler_Total,2)
            );
        }
          $db_data[] = array(
                'col1' => '',
                'col2' => '',
                'col3' => '',
                'col4' => '',
                'col5' => '',
                'col6' => '',
                'col7' => 'Total',
                'col8' => 'S/.'.number_format($suma,2)
            );
          
        $col_names = array(
            'col1' => '<b>Itm</b>',
            'col2' => '<b>SERIE</b>',
            'col3' => '<b>N'.utf8_decode('°').' DOC.</b>',
            'col4' => '<b>CLIENTE</b>',
            'col5' => '<b>FECHA</b>',
            'col6' => '<b>SUBTOTAL</b>',
            'col7' => '<b>DESCUENTO</b>',
            'col8' => '<b>TOTAL</b>'
        );
    
	$this->cezpdf->ezText('', '', array("leading" => 5));
	$this->cezpdf->ezText('<b>REPORTE DE VENTAS DIARIAS</b>', 14, array("leading" => 38, 'left' => 150));
    $this->cezpdf->ezText('<b>HABITACION:</b> '.$cuarto[0]->room_Number.' <b>DESDE:</b> '.$fechai.' <b>HASTA:</b> '.$fechaf, 9, array("leading" => 15, 'left' => 100));
	$this->cezpdf->ezText('', '', array("leading" => 2));
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
                'col2' => array('width' => 40, 'justification' => 'center'),
                'col3' => array('width' => 50, 'justification' => 'center'),
                'col4' => array('width' => 150, 'justification' => 'center'),
                'col5' => array('width' => 60, 'justification' => 'center'),
                'col6' => array('width' => 60, 'justification' => 'center'),
                'col7' => array('width' => 70, 'justification' => 'center'),
                'col8' => array('width' => 70, 'justification' => 'center')
            )
        ));
      
        $cabecera = array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'nama_file.pdf', 'Expires' => '0', 'Pragma' => 'cache', 'Cache-Control' => 'private');
        $this->cezpdf->ezStream($cabecera);
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
<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include_once (APPPATH.'libraries/dompdf/dompdf_config.inc.php');
class Alquiler extends CI_Controller{
    
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
        $result= $this->Alquiler_model->listar();
        $data['serieb']='';
        $data['numerob']='';
        $data['clienteb']='';
        $data['clientenameb']='';
        $data['fecharb']='';
        $data['documentob']=form_dropdown('documentob',array('0'=> ':Seleccione:','B'=> 'BOLETA','F'=> 'FACTURA'),'0','id="documentob" class="form-control"');//name opciones,selccionado ,attr
        $ncuartos = $this->Habitacion_model->get_list();
        $options = array('0'=> 'selecciona');
         if(count($ncuartos)){
            foreach($ncuartos as $value){
               $options[$value->room_Code] = $value->room_Number;
            }
        }
        $data['cuartob']=form_dropdown('cuartob', $options, '0','id="cuartob" class="form-control"');  
        $data['estadob']=form_dropdown('estadob',array('5'=> ':Seleccione:','0'=> 'ANULADO','1'=> 'PENDIENTE','2'=> 'COMPLETADO'),'5','id="estadob" class="form-control"');
        $lista=array();
        if(count($result)>0){
            foreach($result as $item =>$value){
                $codigo =$value->alquiler_Code;
                $serie =$this->serie($value->alquiler_Serie);
                $numero =$this->numero($value->alquiler_Numero);
                $tipo =$value->alquiler_tDocumento;
                $fechar =$value->alquiler_FechaRegistro;
                $total =$value->alquiler_Total;
                $pendiente =$value->alquiler_pendiente;
                
                $inquilino= $this->Cliente_model->get_cliente($value->inquilino_Code);
                $inquilinoname =$inquilino[0]->person_Name." ".$inquilino[0]->person_LastName." ".$inquilino[0]->person_LastName2;
                
                $cuarto= $this->Habitacion_model->get_habitacion($value->room_Code);
                $ncuarto =$cuarto[0]->room_Number;
                
                
               $lista[]=array($codigo,$serie,$numero,$tipo,$fechar,number_format($total,2),$pendiente,$inquilinoname,$ncuarto,$value->room_Code,$value->inquilino_Code);
            }
        }
        $data['list']=$lista;
        
        $data['active']="alquiler";
        $data['titulo']="Tesoreria";
       $this->loadviews('alquiler_index',$data);
    }
    public function search(){
        $serieb = $this->input->post('serieb');
        $numerob = $this->input->post('numerob');
        $clienteb = $this->input->post('clienteb');
        $data['clientenameb']= $this->input->post('clientenameb');
        $fechab = $this->input->post('fecharb');
        $tdocub = $this->input->post('documentob');
        $ncuartob = $this->input->post('cuartob');
        $estadob = $this->input->post('estadob');
        $data['serieb']=$serieb;    
        $data['numerob']=$numerob;    
        $data['clienteb']=$clienteb;    
        $data['fecharb']=$fechab;    
        $data['documentob']=form_dropdown('documentob',array('0'=> ':Seleccione:','B'=> 'BOLETA','F'=> 'FACTURA'),$tdocub,'id="documentob" class="form-control"');//name opciones,selccionado ,attr
        $ncuartos = $this->Habitacion_model->get_list();
        $options = array('0'=> 'selecciona');
        if(count($ncuartos)){
            foreach($ncuartos as $value){
               $options[$value->room_Code] = $value->room_Number;
            }
        }
        $data['cuartob']=form_dropdown('cuartob', $options, $ncuartob,'id="cuartob" class="form-control"');    
        $data['estadob']=form_dropdown('estadob',array('5'=> ':Seleccione:','0'=> 'ANULADO','1'=> 'PENDIENTE','2'=> 'COMPLETADO'),$estadob,'id="estadob" class="form-control"');   
        //datos para el menu
        $usercode=$this->session->userdata['home_user'];
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        //FIN datos para el menu
        $result= $this->Alquiler_model->listarbusqueda($serieb,$numerob,$clienteb,$fechab,$tdocub,$ncuartob,$estadob);
        $lista=array();
        if(count($result)>0){
            foreach($result as $item =>$value){
                $codigo =$value->alquiler_Code;
                $serie =$this->serie($value->alquiler_Serie);
                $numero =$this->numero($value->alquiler_Numero);
                $tipo =$value->alquiler_tDocumento;
                $fechar =$value->alquiler_FechaRegistro;
                $total =$value->alquiler_Total;
                $pendiente =$value->alquiler_pendiente;
                
                $inquilino= $this->Cliente_model->get_cliente($value->inquilino_Code);
                $inquilinoname =$inquilino[0]->person_Name." ".$inquilino[0]->person_LastName." ".$inquilino[0]->person_LastName2;
                
                $cuarto= $this->Habitacion_model->get_habitacion($value->room_Code);
                $ncuarto =$cuarto[0]->room_Number;
                
                
               $lista[]=array($codigo,$serie,$numero,$tipo,$fechar,number_format($total,2),$pendiente,$inquilinoname,$ncuarto,$value->room_Code,$value->inquilino_Code);
            }
        }
        $data['list']=$lista;
        
        $data['active']="alquiler";
        $data['titulo']="Tesoreria";
       $this->loadviews('alquiler_index',$data);
        }
    public function hab_libres(){
        $result= $this->Habitacion_model->hab_libres();
        echo json_encode($result);
    }
    public function add_alquiler(){
        $filter = new stdClass();
		$filter->room_Code=$this->input->post('cuartoid');
        $filter->alquiler_tDocumento=$this->input->post('documento');
        $filter->alquiler_Serie=$this->input->post('serie');
        $filter->alquiler_Numero=$this->input->post('snumero');
        $filter->inquilino_Code=$this->input->post('clienteid');
         $filter->inquilino_FechaInicio=$this->input->post('fechai');
        $filter->inquilino_FechaFin=$this->input->post('fechaf');
        $filter->alquiler_detalle=$this->input->post('detalle');
        $filter->alquiler_SubTotal=$this->input->post('precio');
        $filter->alquiler_Descuento=$this->input->post('descuento');
        $filter->alquiler_aumento=$this->input->post('aumento');
        $filter->alquiler_Total=$this->input->post('total');
        $filter->alquiler_pendiente=1;
         $filter->alquiler_FechaRegistro=date('Y-m-d');
        $filter->alquiler_State= 1;
        
       
        
        
        $result=$this->Alquiler_model->add_alquiler($filter);
        $this->Alquiler_model->ocupar_cuarto($this->input->post('cuartoid'),1);//codigo estado
        $this->Cliente_model->cliente_activar($this->input->post('clienteid'),2);//cliente estado
        exit('{"result":"ok","codigo":"'.$result.'"}');
        
        
    }
    public function delete_alquiler(){
        $code=  $this->input->post('codealquiler');
        $cuartoid=  $this->input->post('cuartoid');
        $inquilinoid=  $this->input->post('inquilinoid');
        $result= $this->Alquiler_model->delete_alquiler($code);
         $this->Alquiler_model->ocupar_cuarto($cuartoid,0);//codigo estado
        $this->Cliente_model->cliente_activar($inquilinoid,1);//cliente estado
        
        echo json_encode($result);
    }
    public function listedit_alquiler(){
        $code=$this->input->post('codealquiler');
         $result=$this->Alquiler_model->listaedit($code);
         echo json_encode($result);
        }
    public function edit_alquiler(){
        $filter = new stdClass();
		$filter->room_Code=$this->input->post('cuartoid');
        $filter->alquiler_tDocumento=$this->input->post('documento');
        $filter->alquiler_Serie=$this->input->post('serie');
        $filter->alquiler_Numero=$this->input->post('snumero');
        $filter->inquilino_Code=$this->input->post('clienteid');
         $filter->inquilino_FechaInicio=$this->input->post('fechai');
        $filter->inquilino_FechaFin=$this->input->post('fechaf');
        $filter->alquiler_detalle=$this->input->post('detalle');
         $filter->alquiler_SubTotal=$this->input->post('precio');
        $filter->alquiler_Descuento=$this->input->post('descuento');
        $filter->alquiler_aumento=$this->input->post('aumento');
        $filter->alquiler_Total=$this->input->post('total');
        $filter->alquiler_pendiente=1;
         $filter->alquiler_FechaRegistro=date('Y-m-d');
        $filter->alquiler_State= 1;
        $id =$this->input->post('id');
        
       
        $result=$this->Alquiler_model->editar_alquiler($filter,$id);
        $this->Alquiler_model->ocupar_cuarto($this->input->post('cuartoid'),1);//codigo estado
        $this->Cliente_model->cliente_activar($this->input->post('clienteid'),2);//cliente estado
        exit('{"result":"ok","codigo":"'.$result.'"}');
        
        }
    public function cobrar_alquiler(){
        $code=  $this->input->post('codealquiler');
        $cuartoid=  $this->input->post('cuartoid');
        $inquilinoid=  $this->input->post('inquilinoid');
        $result= $this->Alquiler_model->cobrar_alquiler($code);
         $this->Alquiler_model->ocupar_cuarto($cuartoid,0);//codigo estado
        $this->Cliente_model->cliente_activar($inquilinoid,1);//cliente estado
        
        echo json_encode($result);
    }
    public function anular_documento(){
        $code=  $this->input->post('codealquiler');
        $result= $this->Alquiler_model->anular_documento($code);
        
        echo json_encode($result);
        }
    public function vercomprobante($code){
         $result=$this->Alquiler_model->listaedit($code);
        if($result->alquiler_tDocumento=='B'){
            $tipocod= "BOLETA";
        }else{
            $tipocod="FACTURA";
        }
        
$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comprovante</title>
</head>
<body>

<style type="text/css">
.contenido{
    background-image: url(assets/img/factura.jpg);
    background-repeat: no-repeat;
    background-size:cover;
    width:100%;
    height:500px;
    margin-left:-40px;
}
.tipo{ margin-top:55px; margin-left:535px; }
.numero{ margin-top:-30px; margin-left:535px; font-size:20px;}
.dato{font-size:16px;}
.1{margin-left:130px; margin-top:19px;}
.2{margin-left:145px; margin-top:6px;}
.3{margin-left:145px; margin-top:2px;}
.monto{margin-top:70px;}

.detalle{ margin-top:45px; margin-left:50px; font-size:20px;}
</style>
<body>
<div class="contenido">
    <div class="tipo"><h2>'.$tipocod.'</h2></div>
    <div class="numero">'.$this->serie($result->alquiler_Serie).'-'.$this->numero($result->alquiler_Numero).'</div>
    <div class="dato 1">'.$result->person_Dni.'</div>
    <div class="dato 2">'.$result->person_LastName.' '.$result->person_LastName2.' '.$result->person_Name.'</div>
    <div class="dato 3"><table><tr><td width="360px">.</td><td>'.$result->alquiler_FechaRegistro.'</td><tr></table></div>
    <div class="detalle"><table><tr>
    <td width="50px">1</td>
    <td width="400px">'.utf8_decode($result->alquiler_detalle).'</td>
    <td width="130px" style="font-size:17px;">Desde:<br>'.$result->inquilino_FechaInicio.' </br>Hasta:<br> '.$result->inquilino_FechaFin.'</td>
     <td> S/.'.number_format(($result->alquiler_SubTotal+$result->alquiler_aumento),2).'</td><tr></table></div>
    <div class="monto">
        <table><tr>
    <td width="430px" style="color:white">.</td>
    <td width="120px"> S/.'.number_format(($result->alquiler_SubTotal+$result->alquiler_aumento),2).'</td>
    <td width="80px"> S/.'.number_format($result->alquiler_Descuento,2).'</td>
    <td> S/.'.number_format($result->alquiler_Total,2).'</td><tr></table>
    </div>
</div>
</body>
</html>

    ';
  
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->set_paper("a4", "portrait");
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Comprobante.pdf", array("Attachment" => false));

exit(0);     
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
    public function numtoletras($xcifra){
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }
 
    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }
 
            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                             
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = $this->subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                             
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = $this->subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                             
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = $this->subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO
 
        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        //$xcadena = "CERO NUEVOS SOLES $xdecimales/100 M.N.";
                        $xcadena = "CERO NUEVOS SOLES ";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        //$xcadena = "UN NUEVO SOL $xdecimales/100 M.N. ";
                        $xcadena = "UN NUEVO SOL ";
                    }
                    if ($xcifra >= 2) {
                        //$xcadena.= " NUEVOS SOLES $xdecimales/100 M.N. "; 
                        $xcadena.= " NUEVOS SOLES "; 
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}
    public function subfijo($xx){ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}
}

?>
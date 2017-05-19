<?php 
include("application/libraries/cezpdf.php");
include("application/libraries/class.backgroundpdf.php");

class Tenants extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('cliente_model');
        $this->load->model('Room_model');
        $this->load->model('Users_model');
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
        $roomscobros=$this->Room_model->get_cobros('0');
        $data['npay']=count($roomscobros);
        //FIN datos para el menu
       $list=$this->cliente_model->get_list();
        $data['list']=$list;
        
        $data['name']='';
        $data['apellido']='';
        $data['cuarto']='';
        $data['dni']='';
        $data['estado']=form_dropdown('estado', array('1'=> 'Actuales','0'=> 'Pasados','2'=> 'Todos'), '1','id="estadob" class="form-control"');
        $data['sexo']=form_dropdown('sexo', array('2'=> 'Selecciona','1'=> 'Hombres','0'=> 'Mujeres'), '2','id="sexob" class="form-control"');
        $ncuato = $this->Room_model->listar_ncuarto();
        $options = array(''=> 'selecciona');
        if(count($ncuato)){
            foreach($ncuato as $value){
               $options[$value->room_Number] = $value->room_Number;
            }
        }
        $data['ncuarto']=form_dropdown('ncuarto', $options, '','id="ncuarto"');
        
        $data['active']="tenants";
        $data['titulo']="Mantenimiento de Inquilinos";
       $this->cargarvista('cliente_index',$data);
    }
    public function nuevo(){
        //datos para el menu
        $usercode=$this->session->userdata['home_user'];
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        $roomscobros=$this->Room_model->get_cobros('0');
        $data['npay']=count($roomscobros);
        //FIN datos para el menu
       $list=$this->cliente_model->get_list();
        $data['list']=$list;
        
        $data['name']='';
        $data['apellido']='';
        $data['cuarto']='';
        $data['dni']='';
        $data['estado']=form_dropdown('estado', array('1'=> 'Actuales','0'=> 'Pasados','2'=> 'Todos'), '1','id="estadob" class="form-control"');
        $data['sexo']=form_dropdown('sexo', array('2'=> 'Selecciona','1'=> 'Hombres','0'=> 'Mujeres'), '2','id="sexob" class="form-control"');
        $ncuato = $this->Room_model->listar_ncuarto();
        $options = array(''=> 'selecciona');
        if(count($ncuato)){
            foreach($ncuato as $value){
               $options[$value->room_Number] = $value->room_Number;
            }
        }
        $data['ncuarto']=form_dropdown('ncuarto', $options, '','id="ncuarto"');
        
        $data['active']="tenants";
        $data['titulo']="Cliente nuevo";
       $this->cargarvista('nuevo_cliente.php',$data);
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
         $name=$this->input->post('name');
         $apellido=$this->input->post('apellido');
          $cuarto=$this->input->post('cuarto');
          $sexo=$this->input->post('sexo');
         $dni=$this->input->post('dni');
          $estado=$this->input->post('estado');
         
         $result=$this->cliente_model->search($name,$apellido,$cuarto,$sexo,$dni,$estado);
         
         $data['list']=$result;
        
        $data['name']=$name;
        $data['apellido']=$apellido;
        $data['cuarto']=$cuarto;
        $data['sexo']=$sexo;
        $data['dni']=$dni;
        $data['estado']=form_dropdown('estado', array('1'=> 'Actuales','0'=> 'Pasados','2'=> 'Todos'), $estado,'id="estadob" class="form-control"');
        $data['sexo']=form_dropdown('sexo', array('2'=> 'Selecciona','1'=> 'Hombres','0'=> 'Mujeres'),$sexo,'id="sexob" class="form-control"');
         
        $data['active']="tenants";
        $data['titulo']="Mantenimiento de Inquilinos";
         $this->cargarvista('cliente_index',$data);
        }
    public function add_tenants(){
       
         $nombre=$this->input->post('nombre');
         $apellidop=$this->input->post('apellidop');
         $apellidom=$this->input->post('apellidom');
         $telefono=$this->input->post('telefono');
         //$edad=$this->input->post('edad');
         $sexo=$this->input->post('sexo');
        
        $filter = new stdClass();
        $filter->person_Name=$nombre;
        $filter->person_LastName=$apellidop;
        $filter->person_LastName2=$apellidom;
        //$filter->person_Age=$edad;
        $filter->person_sex=$sexo;
        $filter->person_Dni='70241454';
        $filter->person_Cellphone=$telefono;
        //$filter->person_Photo='';
        $filter->person_State=1;
        
        $idperson=$this->cliente_model->add_person($filter);//agregamos en la tabla persona
        //$idcuarto=$this->cliente_model->select_room($ncuarto);//obtenemos el id cuarto
        //$this->cliente_model->ocupied_room($idcuarto[0]->room_Code);//modificamos a ocupado el cuarto
        
        
        
       //$inquilino=$this->cliente_model->add_tenants($idperson,$idcuarto[0]->room_Code);
        exit('{"result":"ok","codigo":"'.$idperson.'"}');
        
        
    }
    public function get_person_room(){
        $code=$this->input->post('room');
        $result=$this->cliente_model->get_person_room($code);
         
        echo json_encode($result);
        
        }
    public function cargarvista($view,$data){
        $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view($view,$data);
        $this->load->view("layout/footer");
    }
    
     public function delete_tenants(){
         $codetenants =$this->input->post('codetenants');
         $room =$this->input->post('room');
        
        $this->cliente_model->delete_tenants($codetenants);
        
        $result=$this->cliente_model->existe_tnt_room($room);//preguntamos si hay personas en ese cuarto
         if(count($result)<1){//si no hay ponemos que el cuarto esta desocupado
            $this->Room_model->desocupar_room($room);
         }
        
        exit('{"result":"ok","codigo":"1"}');
    }
    public function listedit_tenants(){
        
         $code=$this->input->post('codetenants');
         
         $result=$this->cliente_model->edit($code);
         
         echo json_encode($result);
    }
    public function update_tenants(){
        $id =$this->input->post('id');
         $dni =$this->input->post('dni');
         $nombre=$this->input->post('nombre');
         $apellidop=$this->input->post('apellidop');
         $apellidom=$this->input->post('apellidom');
         $correo=$this->input->post('correo');
         $telefono=$this->input->post('telefono');
         $telefono2=$this->input->post('telefono2');
         $direccion=$this->input->post('direccion');
         $ncuarto=$this->input->post('ncuarto');
         $nacimiento=$this->input->post('nacimiento');
         $genero=$this->input->post('genero');
        
        $filter = new stdClass();
        $filter->person_Name=$nombre;
        $filter->person_LastName=$apellidop;
        $filter->person_LastName2=$apellidom;
        $filter->person_BirthDate='2017-04-19';
        $filter->person_Dni=$dni;
        $filter->person_sex=$genero;
        $filter->person_Cellphone=$telefono;
        $filter->person_Cellphone2=$telefono2;
        $filter->person_Email=$correo;
        $filter->person_DirectionOc=$direccion;
        
        $datatnt=$this->cliente_model->get_data_tenants($id);
        $idperson=$this->cliente_model->update_person($datatnt[0]->person_Code,$filter);//editamos en la tabla persona
        
        $idcuarto=$this->cliente_model->select_room($ncuarto);//obtenemos el id cuarto del nuevo cuarto
        $this->cliente_model->ocupied_room($idcuarto[0]->room_Code);//modificamos a ocupado el cuarto
        
       $inquilino=$this->cliente_model->update_tenants($id,$idcuarto[0]->room_Code);//actualizamos datos de tnt
       
         $result=$this->cliente_model->existe_tnt_room($datatnt[0]->room_Code);//preguntamos si hay personas en el cuato anterior
         if(count($result)<1){//si no hay ponemos que el cuarto esta desocupado
            $this->Room_model->desocupar_room($datatnt[0]->room_Code);
         }
        
        
        exit('{"result":"ok","codigo":"'.$genero.'"}');
        
        }
     public function print_pdf($name,$apellido,$cuarto,$sexo,$dni,$estado){

      $fechahoy = date('d/m/Y');
      $titulo="REPORTE: ".$fechahoy;

         
        $this->cezpdf = new cezpdf('a4','portrait');
        $this->cezpdf->selectFont('fonts/Helvetica.afm');
        /* Cabecera */
        $delta = 20;

        $listado = $this->cliente_model->get_pdf($name,$apellido,$cuarto,$sexo,$dni,$estado);

       
        $codigo="";
        $sum = 0;
        foreach ($listado as $key => $value) {
           
            $db_data[] = array(
                'col1' => $key + 1,
                'col2' => $value->person_Dni,
                'col3' => $value->person_Name.' '.$value->person_LastName.' '.$value->person_LastName2,
                'col4' => $value->room_Number,
                'col5' => $value->person_Cellphone,
                'col6' => date_format(date_create($value->tnt_RegistrationDate),'d-m-Y')
            );
        }
          
        $col_names = array(
            'col1' => '<b>Itm</b>',
            'col2' => '<b>DNI</b>',
            'col3' => '<b>NOMBRES Y APELLIDOS</b>',
            'col4' => '<b>CUARTO</b>',
            'col5' => '<b>TELEFONO</b>',
            'col6' => '<b>FECH. REGISTRO</b>'
        );
    
    $this->cezpdf->ezText('', '', array("leading" => 5));
         
    //$this->cezpdf->ezImage(base_url()."assets/img/logo.jpg", 30, 130, 'none', 'left');
	$this->cezpdf->ezText('', '', array("leading" => 0));
	
	$this->cezpdf->ezText('<b>TOTAL DE INQUILINOS :   </b>'.count($listado), 9, array("leading" => -50, 'left' => 200));
	$this->cezpdf->ezText('<b>FECHA DE REPORTE   :   </b>'.date('Y-m-d'), 9, array("leading" => 15, 'left' => 200));
	
	$this->cezpdf->ezText('', '', array("leading" => 5));
	$this->cezpdf->ezText('<b> LISTA DE INQUILINOS</b>', 14, array("leading" => 30, 'left' => 175));
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
                'col3' => array('width' => 160, 'justification' => 'center'),
                'col4' => array('width' => 60, 'justification' => 'center'),
                'col5' => array('width' => 70, 'justification' => 'center'),
                'col6' => array('width' => 90, 'justification' => 'center')
            )
        ));
      
        $cabecera = array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'nama_file.pdf', 'Expires' => '0', 'Pragma' => 'cache', 'Cache-Control' => 'private');
        $this->cezpdf->ezStream($cabecera);
    }
    
     public function contrato($id){

      $this->cezpdf = new cezpdf('a4','portrait');
      $this->cezpdf->selectFont('fonts/Helvetica.afm');
       
      $listado = $this->cliente_model->contrato($id);

       
        foreach ($listado as $key => $value) {
                $dni = $value->person_Dni;
                $nombre = $value->person_Name.' '.$value->person_LastName.' '.$value->person_LastName2;
                $price=$value->room_Price;
        }
          
    $this->cezpdf->ezSetCmMargins(2,2,2,2);
    $this->cezpdf->ezText(utf8_decode('<b> CONTRATO DE PAGO POR USO DE HABITACIÓN</b>'), 14, array("leading" => 30, 'left' => 60));
    $this->cezpdf->ezText('', 14, array("leading" => 30, 'left' => 10));
    
    
    $this->cezpdf->ezText(utf8_decode('Por medio de este documento se establece lo siguiente: Que el sr.(Srta.) <b>'.$nombre.'</b>, con DNI <b>'.$dni.'</b> quien en adelante se le llamará EL INQUILINO, ha solicitado una habitación en Pasaje Justo Figuerola 132 Lince, para sus fines convenientes a la Sra. Lastenia Frohlich Frohlich quien en adelante se le llamará LA PROPIETARIA.'), 12, array("leading" => 16,'justification'=>''));
       
     $this->cezpdf->ezText('', 14, array("leading" => 10));
         
    $this->cezpdf->ezText(utf8_decode('Primero; la cantidad pactada es de <b>S/.'.number_format($price,2).'</b>  nuevos soles ('.$this->numtoletras(number_format($price,2)).') mensual, por un tiempo acordado de ___ meses. De ser requerido más tiempo por EL INQUILINO la habitación, se procederá a la elaboración de un nuevo contrato si este último hubiera cumplido satisfactoriamente las normas de conducta estipuladas en el párrafo segundo.'), 12, array("leading" => 16,'justification'=>'rigth'));

     $this->cezpdf->ezText('', 14, array("leading" => 10));
         
    $this->cezpdf->ezText(utf8_decode('Segundo; La habitación se entrega siempre de muy buen estado y por ende deberá ser devuelta al termino del contrato de la misma  forma, dado la conducta  y buenos principios de la casa EL INQUILINO deberá asumir comportamiento igual, respetando la privacidad y tranquilidad del vecino, la limpieza de las áreas en común es de responsabilidad compartida en cronograma de fecha, las puertas de acceso a la calle deberán permanecer bajo llave las 24 hrs.'), 12, array("leading" => 16));
         
    $this->cezpdf->ezText('', 14, array("leading" => 10 ));
         
    $this->cezpdf->ezText(utf8_decode('Tercero; los casos que EL INQUILINO deberá abonar dinero extra son; a) al quedarse hasta el otro día de su visita, (20 soles por dia y por persona) b) al uso de artefactos eléctricos como lavadora, cocina eléctrica, refrigeradora (30 soles al mes c/u) c) perdida de sus llaves porque se tendrá que cambiar el tambor y duplicado de llaves en general  (50 soles por perdida) d) por malograr, manchar o romper cualquier ambiente del inmueble (según cueste la reparación).'), 12, array("leading" => 16));
         
    $this->cezpdf->ezText('', 14, array("leading" => 10));    
         
    $this->cezpdf->ezText(utf8_decode('Quedando muy en claro y comprendido los párrafos del contrato tanto EL INQUILINO como LA PROPIETARIA firman  en conformidad  a las ____ hrs. Del dia _______, __ de __________ del '.date('Y').'
'), 12, array("leading" => 16));
	
        
        $cabecera = array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'nama_file.pdf', 'Expires' => '0', 'Pragma' => 'cache', 'Cache-Control' => 'private');
        $this->cezpdf->ezStream($cabecera);
    }


public function numtoletras($xcifra)
{
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
 
// END FUNCTION
 
public function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
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
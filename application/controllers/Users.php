<?php 
class Users extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Habitacion_model');
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
       $list=$this->Users_model->get_list();
        $data['list']=$list;
        
        $data['name']='';
        $data['userusu']='';
        
        $data['active']="users";
        $data['titulo']="Mantenimiento de Usuarios";
       $this->loadviews('users_index',$data);
    }
    public function nuevo(){
        //datos para el menu
        $usercode=$this->session->userdata['home_user'];
        $userlist=$this->Users_model->edit($usercode);//metodo llamar datos por codigo
        $data['user']=$userlist->person_Name.' '.$userlist->person_LastName;
        $data['imagen']=$userlist->person_Photo;
        //FIN datos para el menu
       $list=$this->Users_model->get_list();
        $data['list']=$list;
        
        $data['name']='';
        $data['userusu']='';
        
        $data['active']="users";
        $data['titulo']="Nuevo Uusuario";
       $this->loadviews('nuevo_usuario',$data);
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
         $user=$this->input->post('user');
         
         $result=$this->Users_model->search($name,$user);
         
         $data['list']=$result;
        
        $data['name']=$name;
        $data['userusu']=$user;
         
        $data['active']="users";
        $data['titulo']="Mantenimiento de Usuarios";
         $this->loadviews('users_index',$data);
        }
    public function add_users(){
         $dni =$this->input->post('dni');
         $nombre=$this->input->post('nombre');
         $apellidop=$this->input->post('apellidop');
         $apellidom=$this->input->post('apellidom');
         $correo=$this->input->post('correo');
         $telefono=$this->input->post('telefono');
         //$photo=$this->input->post('photo');
         $direccion=$this->input->post('direccion');
         $user=$this->input->post('user');
         $password=$this->input->post('password');
         $nacimiento=$this->input->post('nacimiento');
         $genero=$this->input->post('genero');
        
        $config['upload_path'] ='./images';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        
        if ( !$this->upload->do_upload('photo') ){
             $fotoname = 'admin.jpg';
        }else{
        $data1 = $this->upload->data();
        $fotoname = $data1['file_name'];
        } 
        
        
        $filter = new stdClass();
        $filter->person_Name=$nombre;
        $filter->person_LastName=$apellidop;
        $filter->person_LastName2=$apellidom;
        $filter->person_BirthDate='2017-04-19';
        $filter->person_Dni=$dni;
        $filter->person_sex=$genero;
        $filter->person_Cellphone=$telefono;
        $filter->person_Cellphone2='';
        $filter->person_Email=$correo;
        $filter->person_DirectionOc='';
        $filter->person_Photo=$fotoname;
        $filter->person_State=1;
        
        $idperson=$this->Users_model->add_person($filter);
        
        $users=$this->Users_model->add_users($idperson,$user,$password);
        exit('{"result":"ok","codigo":"'.$users.'"}');
        
        
    }
    public function CargarPhoto($inputname){
        $config['upload_path'] ='images';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($inputname) ){
        $error = $this->upload->display_errors();
        }else{
        $data1 = $this->upload->data();
        $fotoname = $data1['file_name'];
        echo $fotoname;
        } 
    }
    
    public function listedit_user(){
        
         $code=$this->input->post('codeuser');
         
         $result=$this->Users_model->edit($code);
         
         echo json_encode($result);
    }
    public function loadviews($view,$data){
        $this->load->view("layout/menu",$data);
        $this->load->view("layout/header",$data);
        $this->load->view($view,$data);
        $this->load->view("layout/footer");
    }
    
     public function delete_users(){
         $code =$this->input->post('code');
        
        $this->Users_model->delete_users($code);
        
        
        exit('{"result":"ok","codigo":"1"}');
    }
public function update_users(){
     $filter = new stdClass();
        $id =$this->input->post('id');
        $idperson =$this->input->post('idperson');
         $dni =$this->input->post('dni');
         $nombre=$this->input->post('nombre');
         $apellidop=$this->input->post('apellidop');
         $apellidom=$this->input->post('apellidom');
         $correo=$this->input->post('correo');
         $telefono=$this->input->post('telefono');
         //$photo=$this->input->post('photo');
         $direccion=$this->input->post('direccion');
         $user=$this->input->post('user');
         $password=$this->input->post('password');
         $nacimiento=$this->input->post('nacimiento');
         $genero=$this->input->post('genero');
    
        $config['upload_path'] ='./images';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        
        if ( !$this->upload->do_upload('photo') ){
             $fotoname = 'admin.jpg';
        }else{
        $data1 = $this->upload->data();
            $filter->person_Photo= $data1['file_name'];
        } 
        
       
        $filter->person_Name=$nombre;
        $filter->person_LastName=$apellidop;
        $filter->person_LastName2=$apellidom;
        $filter->person_BirthDate='2017-04-19';
        $filter->person_Dni=$dni;
        $filter->person_sex=$genero;
        $filter->person_Cellphone=$telefono;
        $filter->person_Email=$correo;
        $filter->person_State=1;
        
        $idperson=$this->Users_model->update_person($idperson,$filter);//editamos en la tabla persona
        $inquilino=$this->Users_model->update_users($id,$user,$password);//actualizamos datos de user
       
         
        exit('{"result":"ok","codigo":"'.$genero.'"}');
        
        }
}
?>
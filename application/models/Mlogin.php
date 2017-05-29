<?php 
class Mlogin extends CI_Model{
    
    public function login($user,$pass){
        
    $this->db->select('u.user_Code,p.person_Name,p.person_LastName');
    $this->db->from('caf_user u');
    $this->db->join('caf_person p','p.person_Code = u.person_Code');
    $this->db->where("((u.user_User='$user' AND u.user_Password='$pass') OR (p.person_Email='$user' AND u.user_Password='$pass'))", NULL, FALSE);
    //$this->db->where('u.user_User',$user);
    //$this->db->where('u.user_Password',$pass);//consulta

        $resultado =$this->db->get();
        
        if ($resultado->num_rows() > 0) {
           $r=$resultado->row();
            $S_user=array(//datos de la session
                'home_user'=>$r->user_Code,
                'home_name'=>$r->person_Name.", ".$r->person_LastName
            );
            $this->session->set_userdata($S_user);//esto es para empezar una session
            return 1;//si en contro resultado manda 1
        }
        else{
            return 0;//no hay resultados manda 0
        }
    }
}

?>

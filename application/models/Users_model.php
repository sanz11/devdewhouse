<?php
class Users_model extends CI_Model{
    
    public function get_list(){
        $this->db->select('p.*,u.*');
        $this->db->from('caf_user u');
        $this->db->join('caf_person p','p.person_Code=u.person_Code');
        $this->db->where('user_State',1);
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
    public function search($name,$user){
         $this->db->select('p.*,u.*');
        $this->db->from('caf_user u');
        $this->db->join('caf_person p','p.person_Code=u.person_Code');
        $this->db->where('user_State',1);
        
        if($name!='')
            $this->db->where('person_Name',$name);
        if($user!='')
            $this->db->where('user_User',$user);
       
        
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
        
    }
    public function add_person($filter){
        $this->db->insert('caf_person',(array)$filter);
    return $this->db->insert_id();
    }
    
    
     public function add_users($idperson,$user,$password){
         
         $data = array(
            'user_Code' => '',
            'person_Code' => $idperson ,
            'user_User' => $user,
            'user_Password' => $password,
            'user_State'=> 1,
            'user_RegistrationDate' => date('Y-m-d H:i:s')
         );
        $this->db->insert('caf_user',$data);
    return $this->db->insert_id();
    }
     public function edit($code){
        $this->db->select('p.*,u.*');
        $this->db->from('caf_user u');
        $this->db->join('caf_person p','p.person_Code=u.person_Code');
        $this->db->where('user_Code',$code);
        $query=$this->db->get();
        
         if($query->num_rows()>0){
           
            return $query->row();
        } 
    }
     public function delete_users($code){
        $this->db->where('user_Code',$code);
        $this->db->update('caf_user',array('user_State'=>0));
        return 1;
    }
    public function update_person($code,$filter){
            $this->db->where('person_Code',$code);
            $this->db->update('caf_person',(array)$filter);
            return 1;
        }
     public function update_users($code,$user,$password){
            $this->db->where('user_Code',$code);
            $this->db->update('caf_user',array('user_User'=>$user,'user_Password'=>$password));
            return 1;
        }
    
}
?>
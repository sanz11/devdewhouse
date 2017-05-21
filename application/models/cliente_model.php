<?php
class cliente_model extends CI_Model{
    
    public function get_list(){
        $this->db->select('p.*,t.*,');
        $this->db->from('caf_tenant t');
        $this->db->join('caf_person p','p.person_Code=t.person_Code');
        $this->db->where('tnt_State',1);
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
    public function search($name,$apellido,$sexo,$dni,$estado){
        $this->db->select('p.*,t.*,');
        $this->db->from('caf_tenant t');
        $this->db->join('caf_person p','p.person_Code=t.person_Code');
        //$this->db->join('caf_room r','r.room_Code=t.room_Code');
        
        if($name!='')
            $this->db->where('person_Name',$name);
        if($apellido!='')
            $this->db->where('person_LastName',$apellido);
            //$this->db->('person_LastName2',$apellido);
       /* if($cuarto!='')
             $this->db->where('room_Number',$cuarto);*/
        if($sexo!=2)
            $this->db->where('person_sex',$sexo);
        if($dni!='')
            $this->db->where('person_Dni',$dni);
        if($estado!=2)
             $this->db->where('tnt_State',$estado);
        
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
    
    public function select_room($ncuarto){
        $this->db->select('room_Code');
        $this->db->from('caf_room');
        $this->db->where('room_Number',$ncuarto);
        
        $query=$this->db->get();
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
    
     public function add_tenants($idperson){
         
         $data = array(
            'tnt_Code' => '',
            'person_Code' => $idperson ,
            //'room_Code' => $idcuarto,
            'tnt_State'=> 1,
            'tnt_RegistrationDate' => date('Y-m-d H:i:s')
         );
        $this->db->insert('caf_tenant',$data);
    return $this->db->insert_id();
    }
    public function ocupied_room($idcuarto){
         $this->db->where('room_Code',$idcuarto);  
        $this->db->update('caf_room',array('room_Occupied' => '1'));
                    
    }
    public function get_person_room($cuarto){
        $this->db->select('p.*,t.*');
        $this->db->from('caf_tenant t');
        $this->db->join('caf_person p','p.person_Code=t.person_Code');
        $this->db->join('caf_room r','r.room_Code=t.room_Code');
        $this->db->where('tnt_State',1);
       
        if($cuarto!='')
             $this->db->where('r.room_Code',$cuarto);
        
        
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
    }
    
    public function delete_tenants($code){
        $this->db->where('tnt_Code',$code);
        $this->db->update('caf_tenant',array('tnt_State'=>0));
        return 1;
    }
    public function existe_tnt_room($room){
        $this->db->where('room_Code',$room);
         $this->db->where('tnt_State',1);
        $query=$this->db->get('caf_tenant');
       
        $data=array();
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
                
        }
    public function edit($tntcode){
        $this->db->select('p.*,t.*,');
        $this->db->from('caf_tenant t');
        $this->db->join('caf_person p','p.person_Code=t.person_Code');
        //$this->db->join('caf_room r','r.room_Code=t.room_Code');
        
       $this->db->where('tnt_Code',$tntcode);
        $query=$this->db->get();
      
       if($query->num_rows()>0){
           
            return $query->row();
        } 
    }
    public function get_data_tenants($id){
            $this->db->where('tnt_Code',$id);
            $query=$this->db->get('caf_tenant');

            $data=array();
           if($query->num_rows()>0){
                foreach($query->result() as $value){
                    $data[]=$value;
                }
                return $data;
            } 
        }
    public function update_person($code,$filter){
            $this->db->where('person_Code',$code);
            $this->db->update('caf_person',(array)$filter);
            return 1;
        }
     public function update_tenants($code){
            $this->db->where('tnt_Code',$code);
            $this->db->update('caf_tenant');
            return 1;
        }
    public function get_pdf($name,$apellido,$cuarto,$sexo,$dni,$estado){
        $this->db->select('p.*,t.*,r.room_Number,r.room_Code');
        $this->db->from('caf_tenant t');
        $this->db->join('caf_person p','p.person_Code=t.person_Code');
        $this->db->join('caf_room r','r.room_Code=t.room_Code');
        
        if($name!='-')
            $this->db->where('person_Name',$name);
        if($apellido!='-')
            $this->db->where('person_LastName',$apellido);
            //$this->db->('person_LastName2',$apellido);
        if($cuarto!='-')
             $this->db->where('room_Number',$cuarto);
        if($sexo!=2)
            $this->db->where('person_sex',$sexo);
        if($dni!='-')
            $this->db->where('person_Dni',$dni);
        if($estado!=2)
             $this->db->where('tnt_State',$estado);
        
        $this->db->order_by('room_Number','asc');
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
        
    }
    public function contrato($code){
        $this->db->select('p.*,t.*,r.room_Number,r.room_Code,r.room_Price');
        $this->db->from('caf_tenant t');
        $this->db->join('caf_person p','p.person_Code=t.person_Code');
         $this->db->join('caf_room r','r.room_Code=t.room_Code');
        $this->db->where('tnt_Code',$code);
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
        }
}
?>
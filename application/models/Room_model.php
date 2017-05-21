<?php
class Room_model extends CI_Model{
    
    public function get_list($free='',$cobro=''){
        $this->db->select('*');
        $this->db->from('caf_room');
        $this->db->where('room_State',1);
        if($free!='')
            $this->db->where('room_Occupied',$free);
        if($cobro!='')
            $this->db->order_by('room_Occupied','desc');
            $this->db->order_by('room_DatePay','asc');
            
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
    public function search($number,$floor,$precio){
        $this->db->select('*');
        $this->db->from('caf_room');
        if($number!='')
            $this->db->where('room_Number',$number);
        if($floor!='')
            $this->db->where('room_Floor',$floor);
		if($precio!='')
            $this->db->where('room_Price',$precio);
       
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
        
    }
    public function add_room($filter){
        $this->db->insert('caf_room',(array)$filter);
        return $this->db->insert_id();
    }
    public function edit_room($filter,$id){
        $this->db->where('room_Code',$id);
        $this->db->update('caf_room',(array)$filter);
        return 1;
    }
    public function delete_room($code){
        $this->db->where('room_Code',$code);
        $this->db->update('caf_room',array('room_State'=>0));
        return 1;
    }
    public function edit($roomcode){
        $this->db->select('*');
             $this->db->where('room_Code',$roomcode);
        $this->db->from('caf_room');
        
        $query=$this->db->get();
        
       if($query->num_rows()>0){
           
            return $query->row();
        } 
    }
    public function desocupar_room($roomcode){
       
        $this->db->where('room_Code',$roomcode);
        $this->db->update('caf_room',array('room_Occupied'=>0));
         return 1;
    }
    public function limpiar_inquilino($roomcode){
        
        $this->db->where('room_Code',$roomcode);
        $this->db->update('caf_tenant',array('tnt_State'=>0));
        return 1;
         
    }
    public function get_pdf($number,$floor,$state){
        $this->db->select('*');
        $this->db->from('caf_room');
        if($number!='-')
            $this->db->where('room_Number',$number);
        if($floor!='-')
            $this->db->where('room_Floor',$floor);
        if($state!=2)
             $this->db->where('room_Occupied',$state);
        
        
        $this->db->where('room_State',1);
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
    }
    public function listar_ncuarto(){
      $this->db->select('*');
      $this->db->from('caf_room');
      $this->db->where('room_State',1);
      $this->db->order_by('room_Number','asc');
            
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
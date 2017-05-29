<?php
class Habitacion_model extends CI_Model{
    
    public function get_list($free='',$cobro=''){
        $this->db->select('*');
        $this->db->from('caf_room');
        $this->db->where('room_State',1);
        if($free!='')
            $this->db->where('room_Occupied',$free);
        if($cobro!='')
            $this->db->order_by('room_Occupied','desc');
            
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
    public function search($number,$floor,$estado){
        $this->db->select('*');
        $this->db->from('caf_room');
        if($number!='')
            $this->db->where('room_Number',$number);
        if($floor!='')
            $this->db->where('room_Floor',$floor);
		if($estado!='2')
            $this->db->where('room_Occupied',$estado);
        $this->db->where('room_State',1);
       
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
        
    }
    public function add_habitacion($filter){
        $this->db->insert('caf_room',(array)$filter);
        return $this->db->insert_id();
    }
    public function edit_habitacion($filter,$id){
        $this->db->where('room_Code',$id);
        $this->db->update('caf_room',(array)$filter);
        return 1;
    }
    public function delete_habitacion($code){
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
     public function get_habitacion($roomcode){
        $this->db->select('*');
             $this->db->where('room_Code',$roomcode);
        $this->db->from('caf_room');
        
        $query=$this->db->get();
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
    }
    public function desocupar_room($roomcode){
       
        $this->db->where('room_Code',$roomcode);
        $this->db->update('caf_room',array('room_Occupied'=>0));
         return 1;
    }
    public function hab_libres(){
        $this->db->select("r.*,t.tcuarto_Descripcion,concat(room_Number,',',t.tcuarto_Codigo,',',room_Price,',',room_Bath,',',room_AguaCaliente,',',room_Cable,',',room_Internet) as detalle");
         $this->db->join('caf_tcuarto t','t.tcuarto_Codigo=r.tcuarto_Codigo','left');
        $this->db->where('r.room_Occupied',0);
         $this->db->where('r.room_State',1);
        
        $query=$this->db->get('caf_room r');
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
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
    public function listar_tipocuarto(){
      $this->db->select('*');
      $this->db->from('caf_tcuarto');
     // $this->db->where('room_State',1);
     // $this->db->order_by('room_Number','asc');
            
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
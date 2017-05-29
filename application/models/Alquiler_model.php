<?php
class Alquiler_model extends CI_Model{
    
   public function listar(){
       $this->db->select('*');
       $this->db->from('dom_alquiler');
       $this->db->where('alquiler_State',1);
       $this->db->order_by('alquiler_pendiente','asc');
       $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
     }
   public function listarbusqueda($serieb,$numerob,$clienteb,$fecharb,$documentob,$cuartob,$estadob){
      $this->db->select('*');
       $this->db->from('dom_alquiler');
       $this->db->where('alquiler_State',1);
       if($serieb!=''){
           $this->db->where('alquiler_Serie',$serieb);
       }
       if($numerob!=''){
           $this->db->where('alquiler_Numero',$numerob);
       }
       if($clienteb!=''){
           $this->db->where('inquilino_Code',$clienteb);
       }
       if($fecharb!=''){
           $this->db->where('alquiler_FechaRegistro',$fecharb);
       }
       if($documentob!='0'){
           $this->db->where('alquiler_tDocumento',$documentob);
       }
       if($cuartob!='0'){
           $this->db->where('room_Code',$cuartob);
       }
       if($estadob!=5){
           $this->db->where('alquiler_pendiente',$estadob);
       }
       $this->db->order_by('alquiler_pendiente','asc');
       $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }  
       }
   public function get_desocupados(){
        $this->db->select('*');
        $this->db->from('caf_room');
        $this->db->where('room_State',1);
        $this->db->where('room_Occupied',0);
            
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
   public function add_alquiler($filter){
        $this->db->insert('dom_alquiler',(array)$filter);
    return $this->db->insert_id();
    }
   public function ocupar_cuarto($idcuarto,$estado){
         $this->db->where('room_Code',$idcuarto);  
        $this->db->update('caf_room',array('room_Occupied' => $estado));
                    
    }
   public function delete_alquiler($code){
         $this->db->where('alquiler_Code',$code);  
        $this->db->update('dom_alquiler',array('alquiler_State' => 0));
    }
   public function listaedit($code){
       $this->db->select('a.*,p.*,r.*,tcuarto_Descripcion');
       $this->db->from('dom_alquiler a');
       $this->db->join('caf_tenant t','t.tnt_Code=a.inquilino_Code');
       $this->db->join('caf_person p','p.person_Code=t.person_Code','left');
       $this->db->join('caf_room r','r.room_Code=a.room_Code','left');
        $this->db->join('caf_tcuarto tr','tr.tcuarto_Codigo=r.tcuarto_Codigo','left');
       $this->db->where('alquiler_Code',$code);
        
        $query=$this->db->get();
        
       if($query->num_rows()>0){
           
            return $query->row();
        } 
       } 
   public function reportediario($fechai,$fechaf){
       $this->db->select('a.*,p.*,r.*,tcuarto_Descripcion');
       $this->db->from('dom_alquiler a');
       $this->db->join('caf_tenant t','t.tnt_Code=a.inquilino_Code');
       $this->db->join('caf_person p','p.person_Code=t.person_Code','left');
       $this->db->join('caf_room r','r.room_Code=a.room_Code','left');
        $this->db->join('caf_tcuarto tr','tr.tcuarto_Codigo=r.tcuarto_Codigo','left');
    $this->db->where('alquiler_FechaRegistro >=',$fechai);
        $this->db->where('alquiler_FechaRegistro <=',$fechaf);
    $this->db->where('alquiler_pendiente !=',0);
    $this->db->where('alquiler_State =',1);
        
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
     }
   public function reportecuarto($cuartoid,$fechai,$fechaf){
       $this->db->select('a.*,p.*,r.*,tcuarto_Descripcion');
       $this->db->from('dom_alquiler a');
       $this->db->join('caf_tenant t','t.tnt_Code=a.inquilino_Code');
       $this->db->join('caf_person p','p.person_Code=t.person_Code','left');
       $this->db->join('caf_room r','r.room_Code=a.room_Code','left');
        $this->db->join('caf_tcuarto tr','tr.tcuarto_Codigo=r.tcuarto_Codigo','left');
    $this->db->where('alquiler_FechaRegistro >=',$fechai);
        $this->db->where('alquiler_FechaRegistro <=',$fechaf);
    $this->db->where('alquiler_pendiente !=',0);//no este anulado
       $this->db->where('r.room_Code',$cuartoid);//id de cuarto es igual a variable cuarto
    $this->db->where('alquiler_State =',1);//no este eliminado
        
        $query=$this->db->get();
        
       if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        } 
     }
   public function editar_alquiler($filter,$id){
        $this->db->where('alquiler_Code',$id);
        $this->db->update('dom_alquiler',(array)$filter);
        return 1;
       }
    public function cobrar_alquiler($code){
        $this->db->where('alquiler_Code',$code);  
        $this->db->update('dom_alquiler',array('alquiler_pendiente' => 2));
    }
   public function anular_documento($code){
        $this->db->where('alquiler_Code',$code);  
        $this->db->update('dom_alquiler',array('alquiler_pendiente' => 0));
    }
   public function listcobrar(){
       $this->db->select('*');
       $this->db->from('dom_alquiler');
       $this->db->where('alquiler_State',1);
       $this->db->where('alquiler_pendiente',1);
       $Hora = Time() + (60 *60 * 1);
       $this->db->where('inquilino_FechaFin <',date('Y-m-d H:i a',$Hora));
     
       $this->db->order_by('alquiler_pendiente','asc');
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
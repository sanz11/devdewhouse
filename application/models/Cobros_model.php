<?php
class Cobros_model extends CI_Model{
    
    public function get_pago($code,$anio,$mes){
        $this->db->select('*');
        $this->db->from('caf_cobros');
        $this->db->where('cob_State',1);
        $this->db->where('Year(cob_DatePay)',$anio);
        $this->db->where('Month(cob_DatePay)',$mes);
        $this->db->where('room_Code',$code);
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
    public function cobrar($filter){
        $this->db->insert('caf_cobros',(array)$filter);
        return $this->db->insert_id();
    }
    public function reportecobros($code){
        $this->db->where('room_Code',$code);
        $query=$this->db->get('caf_cobros');
        if($query->num_rows()>0){
            foreach($query->result() as $value){
                $data[]=$value;
            }
            return $data;
        }
    }
    public function update($code,$precio){
        $this->db->where('cob_Code',$code);
        $this->db->update('caf_cobros',array('cob_Total'=>$precio,'cob_DatePay'=>date('Y-m-d')));
        return 1;
    }
   
}
?>
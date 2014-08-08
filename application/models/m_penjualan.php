<?php
class m_penjualan extends CI_Model
{
	function pilihBank($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idbank,nmbank from ref_bank");
         foreach($sql->result() as $rs){
		 		if($rs->idbank==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idbank."' $select>".$rs->nmbank."</option>";
        }
		return $opt; 
	}
	
	function pilihTOP($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idtermin,nmtermin from sys_termin_pembayaran");
         foreach($sql->result() as $rs){
		 		if($rs->idtermin==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idtermin."' $select>".$rs->nmtermin."</option>";
        }
		return $opt; 
	}
	
}
?>
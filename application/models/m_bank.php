<?php
class m_bank extends CI_Model
{
	function pilihBank($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idbank,nmbank from ref_bank order by nmbank asc");
         foreach($sql->result() as $rs){
		 		if($rs->idbank==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idbank."' $select>".$rs->nmbank."</option>";
        }
		return $opt; 
	}
}
?>
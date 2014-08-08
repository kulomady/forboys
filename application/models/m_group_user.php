<?php
class m_group_user extends CI_Model
{
	function pilihUserGroup($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select group_id,name from master_groups");
         foreach($sql->result() as $rs){
		 		if($rs->group_id==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->group_id."' $select>".$rs->name."</option>";
        }
		return $opt; 
	}
}
?>
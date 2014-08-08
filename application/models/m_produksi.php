<?php
class m_produksi extends CI_Model
{
	function pilihPO($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idjo,nmjo from tr_job_order where status = 'OPEN' order by created desc");
         foreach($sql->result() as $rs){
		 		if($rs->idjo==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idjo."' $select>".$rs->nmjo."</option>";
        }
		return $opt; 
	}
	
	function pilihMesin($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idmesin,nmmesin from ref_mesin_bordir order by nmmesin asc");
         foreach($sql->result() as $rs){
		 		if($rs->idmesin==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idmesin."' $select>".$rs->nmmesin."</option>";
        }
		return $opt; 
	}
	
	function pilihShift($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select kdshift,nmshift from ref_shift order by nmshift asc");
         foreach($sql->result() as $rs){
		 		if($rs->kdshift==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->kdshift."' $select>".$rs->nmshift."</option>";
        }
		return $opt; 
	}
	
	function pilihCMT($pilih,$outlet_id) {
		$opt = '<option value=""></option>';
		 $sql = $this->db->query("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '4' and outlet_id = '".$outlet_id."' order by nmrekan asc");
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 	
	}
	
	function pilihJnsPekerjaan($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idjp,nmjp from sys_jns_pekerjaan order by nmjp asc");
         foreach($sql->result() as $rs){
		 		if($rs->idjp==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idjp."' $select>".$rs->nmjp."</option>";
        }
		return $opt; 
	}
}
?>
<?php
class m_perkiraan extends CI_Model
{
	function nmKelompokPerkiraan($idkelompok) {
		$sql = $this->db->query("select nmkelompok from ak_master_kelompok_perkiraan where idkelompok_perkiraan = '".$idkelompok."'");
		if(count($sql->result()) != 0) {
			$rs = $sql->row();
			$nmKelompok = $rs->nmkelompok;
		} else {
			$nmKelompok = "";
		}
		return $nmKelompok;
	}
	
	function pilihKelompokPerkiraan($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idkelompok_perkiraan,nmkelompok from ak_master_kelompok_perkiraan order by idkelompok_perkiraan asc");
         foreach($sql->result() as $rs){
		 		if($rs->idkelompok_perkiraan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idkelompok_perkiraan."' $select>".$rs->idkelompok_perkiraan.' | '.$rs->nmkelompok."</option>";
        }
		return $opt; 
	}
	
	function pilihIndukPerkiraan($pilih,$idKelompok) {
		$opt = '<option value="">&nbsp;</option>';
		 $sql = $this->db->query("select idperkiraan,nmperkiraan from ak_master_perkiraan where idKelompok_perkiraan = '".$idKelompok."' and tipe_perkiraan = 'H' order by idperkiraan asc");
        foreach($sql->result() as $rs){
		 		if($rs->idperkiraan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idperkiraan."' $select>".$rs->idperkiraan.' | '.$rs->nmperkiraan."</option>";
        }
		return $opt; 
	}
	
	function pilihPerkiraan($pilih) {
		$opt = '<option value="">&nbsp;</option>';
		$sql = $this->db->query("select idperkiraan,nmperkiraan from ak_master_perkiraan where tipe_perkiraan = 'D' order by idperkiraan asc");
        foreach($sql->result() as $rs){
		 		if($rs->idperkiraan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idperkiraan."' $select>".$rs->idperkiraan.' | '.$rs->nmperkiraan."</option>";
        }
		return $opt; 
	}
	
	function nmPerkiraan($idperkiraan) {
		$sql = $this->db->query("select nmperkiraan from ak_master_perkiraan where idperkiraan = '".$idperkiraan."'");
		if(count($sql->result()) != 0) {
			$rs = $sql->row();
			$nmperkiraan = $rs->nmperkiraan;
		} else {
			$nmperkiraan = "";
		}
		return $nmperkiraan;
	}
}
?>
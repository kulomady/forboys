<?php
class m_member extends CI_Model
{
	function pilihKategori($pilih) {
	
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idkategori,nmkategori from ref_kategori_member order by nmkategori asc");
         foreach($sql->result() as $rs){
		 		if($rs->idkategori==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idkategori."' $select>".$rs->nmkategori."</option>";
        }
		return $opt; 
	}
	
	function pilihParent($pilih) {
	
		$opt = '<option value="0"></option>';
		$sql = $this->db->query("select id_deal,jns,nama_member,nama_perusahaan from master_member order by nama_member asc");
        foreach($sql->result() as $rs){
			if($rs->jns==1){
				$member = $rs->nama_member;
			} else {
				$member = $rs->nama_perusahaan;
			}
		 	if($rs->id_deal==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
			$opt .= "<option value='".$rs->id_deal."' $select>".$member."</option>";
        }
		return $opt; 
	}
	
	function pilihDev($pilih) {
	
		 $opt = '<option value="0"></option>';
		 $sql = $this->db->query("select kode_developer,nama_developer from master_developer where jns = '1' order by nama_developer asc");
         foreach($sql->result() as $rs){
		 		if($rs->kode_developer==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->kode_developer."' $select>".$rs->nama_developer."</option>";
        }
		return $opt; 
	}
	
	function pilihLanded($pilih) {
	
		 $opt = '<option value="0"></option>';
		 $sql = $this->db->query("select kode_developer,nama_developer from master_developer where jns = '0' order by nama_developer asc");
         foreach($sql->result() as $rs){
		 		if($rs->kode_developer==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->kode_developer."' $select>".$rs->nama_developer."</option>";
        }
		return $opt; 
	}
	
	function nm_member($kode){
		if($kode!=""){
			$sql = $this->db->query("select nama_perusahaan, nama_member from master_member where id_deal = '".$kode."'")->row();
			if($sql->nama_perusahaan==NULL){
				$nm = $sql->nama_member;
			} else {
				$nm = $sql->nama_perusahaan;
			}
		} else {
			$nm = "";
		}
		return $nm;
	}
}
?>
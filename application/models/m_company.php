<?php
class m_company extends CI_Model
{
	function pilihLokasi($pilih) {
	
		 $sql = $this->db->query("select outlet_id,nm_outlet from master_company where outlet_id = '".$this->session->userdata('outlet_id')."'
union select a.outlet_id,a.nm_outlet from master_company a inner join sys_hak_outlet b on a.outlet_id = b.outlet_id where b.group_id = '".$this->session->userdata('group_id')."' and b.view = '1'");
		 if(count($sql->result()) > 1) {
		 	$opt = '<option value=""></option>';
		 } else {
				$opt = ""; 
		 }
         foreach($sql->result() as $rs){
		 		if($rs->outlet_id==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->outlet_id."' $select>".$rs->nm_outlet."</option>";
        }
		return $opt; 
	}
	
	function pilihLokasiGudang($pilih) {
	
		 $sql = $this->db->query("select outlet_id,nm_outlet from master_company where outlet_id = '".$this->session->userdata('outlet_id')."' and type = 'GUDANG'
union select a.outlet_id,a.nm_outlet from master_company a inner join sys_hak_outlet b on a.outlet_id = b.outlet_id where b.group_id = '".$this->session->userdata('group_id')."' and b.view = '1' and a.type = 'GUDANG'");
		 if(count($sql->result()) > 1) {
		 	$opt = '<option value="">.: Semua :.</option>';
		 } else {
				$opt = ""; 
		 }
         foreach($sql->result() as $rs){
		 		if($rs->outlet_id==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->outlet_id."' $select>".$rs->nm_outlet."</option>";
        }
		return $opt; 
	}
	
	function pilihLokasiToko($pilih) {
	
		 $sql = $this->db->query("select outlet_id,nm_outlet from master_company where outlet_id = '".$this->session->userdata('outlet_id')."' and type in ('TOKO','KONSINYASI')
union select a.outlet_id,a.nm_outlet from master_company a inner join sys_hak_outlet b on a.outlet_id = b.outlet_id where b.group_id = '".$this->session->userdata('group_id')."' and b.view = '1' and a.type in ('TOKO','KONSINYASI')");
		 if(count($sql->result()) > 1) {
		 	$opt = '<option value="">.: Semua :.</option>';
		 } else {
				$opt = ""; 
		 }
         foreach($sql->result() as $rs){
		 		if($rs->outlet_id==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->outlet_id."' $select>".$rs->nm_outlet."</option>";
        }
		return $opt; 
	}
	
	function pilihLokasiAll($pilih) {
	
		 $sql = $this->db->query("select outlet_id,nm_outlet from master_company where outlet_id = '".$this->session->userdata('outlet_id')."'
union select a.outlet_id,a.nm_outlet from master_company a where a.is_active = '1'");
		 if(count($sql->result()) > 1) {
		 	$opt = '<option value=""></option>';
		 } else {
				$opt = ""; 
		 }
         foreach($sql->result() as $rs){
		 		if($rs->outlet_id==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->outlet_id."' $select>".$rs->nm_outlet."</option>";
        }
		return $opt; 
	}
	
	function nmCompany($outlet_id) {
		$sql = $this->db->query("select nm_outlet from master_company where outlet_id = '".$outlet_id."'");
		 if(count($sql->result()) == 0) {
		 	$nm_outlet = "";
		 } else {
		 	$rs = $sql->row();
		 	$nm_outlet = $rs->nm_outlet;
		 }
		 return $nm_outlet;
	}
	
	function pilihPajak($pilih) {
	
		 $opt = '';
		 $sql = $this->db->query("select nilai,kode_pajak from master_pajak order by nilai asc");
         foreach($sql->result() as $rs){
		 		if($rs->nilai==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->nilai."' $select>".$rs->kode_pajak."</option>";
        }
		return $opt; 
	}
	
	function periodeAwal() {
		$q = $this->db->query("select bln_thn_mulai from sys_periode_akuntansi where active = '1'");
		if(count($q->result())==0) {
			$periode = "";
		} else {
			$r = $q->row();
			$periode = $r->bln_thn_mulai;
		}
		return $periode;
	}
	
	function thnAkuntansi() {
		$q = $this->db->query("select sa_thn from sys_periode_akuntansi where active = '1'");
		if(count($q->result())==0) {
			$sa_thn = "";
		} else {
			$r = $q->row();
			$sa_thn = $r->sa_thn;
		}
		return $sa_thn;
	}
	
}
?>
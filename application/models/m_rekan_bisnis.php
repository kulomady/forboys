<?php
class m_rekan_bisnis extends CI_Model
{
	function pilihTypeRekan($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from sys_tipe_rekan order by idtipe_rekan asc");
         foreach($sql->result() as $rs){
		 		if($rs->idtipe_rekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idtipe_rekan."' $select>".$rs->nmtipe_rekan."</option>";
        }
		return $opt; 
	}
	
	function pilihMewakili($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from sys_rekan_mewakili order by idmewakili asc");
         foreach($sql->result() as $rs){
		 		if($rs->idmewakili==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idmewakili."' $select>".$rs->nmmewakili."</option>";
        }
		return $opt; 
	}
	
	function pilihPanggilan($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from sys_panggilan_rekan order by idpanggilan asc");
         foreach($sql->result() as $rs){
		 		if($rs->idpanggilan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idpanggilan."' $select>".$rs->nmpanggilan."</option>";
        }
		return $opt; 
	}
	
	function pilihPramuniaga($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select id,nmrekan from master_rekan_bisnis where idtipe_rekan = '3'");
         foreach($sql->result() as $rs){
		 		if($rs->id==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->id."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 
	}
	
	function pilihTerminPembayaran($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from sys_termin_pembayaran");
         foreach($sql->result() as $rs){
		 		if($rs->idtermin==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idtermin."' $select>".$rs->nmtermin."</option>";
        }
		return $opt; 
	}
	
	function pilihGrupPelanggan($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from master_grup_pelanggan");
         foreach($sql->result() as $rs){
		 		if($rs->idgrup==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idgrup."' $select>".$rs->nmgrup."</option>";
        }
		return $opt; 
	}
	
	function pilihTipePotongan($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from sys_tipe_potongan");
         foreach($sql->result() as $rs){
		 		if($rs->idtipepot==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idtipepot."' $select>".$rs->nmtipe."</option>";
        }
		return $opt; 
	}
	
	function pilihMtdPembayaran($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from master_metode_pembayaran");
         foreach($sql->result() as $rs){
		 		if($rs->idmp==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idmp.'-'.$rs->idmetode."' $select>".$rs->nm_mp."</option>";
        }
		return $opt; 
	}
	
	function pilihCaraBayar($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from sys_metode_pembayaran");
         foreach($sql->result() as $rs){
		 		if($rs->idmetode==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idmetode."' $select>".$rs->nmmetode."</option>";
        }
		return $opt; 
	}
	
	function pilihJnsAlamat($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select * from sys_jenis_alamat");
         foreach($sql->result() as $rs){
		 		if($rs->idjnsalamat==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idjnsalamat."' $select>".$rs->nmjnsalamat."</option>";
        }
		return $opt; 
	}
	
	function pilihSupplier($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '2'");
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 
	}
	
	function pilihPelanggan($pilih) {
		 $sql = $this->db->query("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '1'");
		/*  if(count($sql->result()) > 1) {
			 $opt = '<option value=""></option>'; 
		 } else {
			$opt = ''; 
		 } */
		  $opt = '<option value=""></option>';
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 
	}
	
	function pilihPelangganCMT($pilih) {
		 $sql = $this->db->query("select idrekan,if(idtipe_rekan='4',concat(nmrekan,'-CMT'),nmrekan) as nmrekan from master_rekan_bisnis where idtipe_rekan in (1,4)");
		/*  if(count($sql->result()) > 1) {
			 $opt = '<option value=""></option>'; 
		 } else {
			$opt = ''; 
		 } */
		  $opt = '<option value=""></option>';
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 
	}
	
	function pilihCMT($pilih) {
		 $sql = $this->db->query("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '4'");
		/*  if(count($sql->result()) > 1) {
			 $opt = '<option value=""></option>'; 
		 } else {
			$opt = ''; 
		 } */
		  $opt = '<option value=""></option>';
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 
	}
	
	function pilihPelangganPOS($pilih) {
		 $sql = $this->db->query("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '1'");
		 if(count($sql->result()) > 1) {
			 $opt = '<option value=""></option>'; 
		 } else {
			 $opt = ''; 
		 }
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 
	}
	
	function pilihKaryawan($pilih) {
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '3' and outlet_id = '".$this->session->userdata('outlet_id')."'");
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }
		return $opt; 
	}
	
	function nmRekan($idrekan) {
		 $sql = $this->db->query("select nmrekan from master_rekan_bisnis where idrekan = '".$idrekan."'");
		 if(count($sql->result()) == 0) {
		 	$nmrekan = "";
		 } else {
		 	$rs = $sql->row();
		 	$nmrekan = $rs->nmrekan;
		 }
		 return $nmrekan;
	}
	
	function diskon($idrekan,$tglBeli){
		$sql = $this->db->query("SELECT diskon_hari, diskon_pemb_lbh_awal FROM master_rekan_bisnis WHERE idrekan = '".$idrekan."'")->row();
		$diskon_hari = $sql->diskon_hari;
		
		$tgl = explode('-',$tglBeli);
		//batas diskon
		$tgl2 = mktime(0,0,0,$tgl[1],$tgl[2]+$diskon_hari,$tgl[0]);
		//now
		$skrg = mktime(0,0,0,date('m'),date('d'),date('Y'));
		if($tgl2<=$skrg){
			$diskon = ($sql->diskon_pemb_lbh_awal*100);			
		} else {
			$diskon = 1;
		}
		return $diskon;
	}
	
	function tgl_jt_tempo($idrekan,$tglBeli){
		$sql = $this->db->query("SELECT a.jml_hari FROM sys_termin_pembayaran a LEFT JOIN master_rekan_bisnis b ON b.idtermin = a.idtermin WHERE b.idrekan = '".$idrekan."'")->row();
		$jml_hari = $sql->jml_hari;
		
		$tgl = explode('-',$tglBeli);
		$tgl2 = mktime(0,0,0,$tgl[1],$tgl[2]+$jml_hari,$tgl[0]);
		$tgl_jt_tempo = date('Y-m-d',$tgl2);
		
		return $tgl_jt_tempo;
	}
	
}
?>
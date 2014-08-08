<?php
class m_ref_sizerun extends CI_Model
{
	function cekKode($kdSizerun) {
		$sql = $this->db->query("select count(kode_sizerun) as jml from ref_sizerun where kode_sizerun = '".$this->input->post('kdSize')."'")->row();
		$jml = $sql->jml;
		return $jml; 
	}
}
?>
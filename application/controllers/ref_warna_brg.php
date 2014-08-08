<?php 
class ref_warna_brg extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md25');
		$this->load->view('ref_warna_brg/warna_brg_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idwarna like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmwarna like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idwarna,nmwarna,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_warna_barang where nmwarna is not null $qr","id","id,idwarna,nmwarna,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_warna_brg/warna_brg_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_warna_barang where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdwarna' => $r->idwarna,
			'nmwarna' => $r->nmwarna,
			'active' => $r->active
		);
		$this->load->view('ref_warna_brg/warna_brg_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idwarna' => strtoupper($this->input->post('kdwarna')),
			'nmwarna' => strtoupper($this->input->post('nmwarna')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_warna_barang', $data);
			$this->msistem->log_book('Input data baru warna Barang "'.$this->input->post('nmwarna'),'md25',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_warna_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data warna Barang "'.$this->input->post('nmwarna'),'md25',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		// log delete
		$r = $this->db->query("select idwarna from ref_warna_barang where id = '".$idrec."'")->row();
		$idwarna = $r->idwarna;
		$this->msistem->log_delete("ref_warna_barang","where idwarna = '$idwarna'");
		// Hapus
		$this->db->delete("ref_warna_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md25',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
}
?>
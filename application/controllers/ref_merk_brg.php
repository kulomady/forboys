<?php 
class ref_merk_brg extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md24');
		$this->load->view('ref_merk_brg/merk_brg_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idmerk like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmmerk like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idmerk,nmmerk,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_merk_barang where nmmerk is not null $qr","id","id,idmerk,nmmerk,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_merk_brg/merk_brg_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_merk_barang where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdmerk' => $r->idmerk,
			'nmmerk' => $r->nmmerk,
			'active' => $r->active
		);
		$this->load->view('ref_merk_brg/merk_brg_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idmerk' => strtoupper($this->input->post('kdmerk')),
			'nmmerk' => strtoupper($this->input->post('nmmerk')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_merk_barang', $data);
			$this->msistem->log_book('Input data baru merk Barang "'.$this->input->post('nmmerk'),'md24',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_merk_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data merk Barang "'.$this->input->post('nmmerk'),'md24',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idmerk from ref_merk_barang where id = '".$idrec."'")->row();
		$kode = $r->idmerk;
		$this->msistem->log_delete("ref_merk_barang","where idmerk = '$kode'");
		
		$this->db->delete("ref_merk_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md24',$this->session->userdata('sis_user'));
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
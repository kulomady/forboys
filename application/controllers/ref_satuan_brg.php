<?php 
class ref_satuan_brg extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md26');
		$this->load->view('ref_satuan_brg/satuan_brg_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idsatuan like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmsatuan like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idsatuan,nmsatuan,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_satuan_barang where nmsatuan is not null $qr","id","id,idsatuan,nmsatuan,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_satuan_brg/satuan_brg_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_satuan_barang where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdsatuan' => $r->idsatuan,
			'nmsatuan' => $r->nmsatuan,
			'active' => $r->active
		);
		$this->load->view('ref_satuan_brg/satuan_brg_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idsatuan' => strtoupper($this->input->post('kdsatuan')),
			'nmsatuan' => strtoupper($this->input->post('nmsatuan')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_satuan_barang', $data);
			$this->msistem->log_book('Input data baru satuan Barang "'.$this->input->post('nmsatuan'),'md26',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_satuan_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data satuan Barang "'.$this->input->post('nmsatuan'),'md26',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idsatuan from ref_satuan_barang where id = '".$idrec."'")->row();
		$idsatuan = $r->idsatuan;
		$this->msistem->log_delete("ref_satuan_barang","where idsatuan = '$idsatuan'");
		// Hapus
		$this->db->delete("ref_satuan_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md26',$this->session->userdata('sis_user'));
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
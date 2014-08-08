<?php 
class finishing extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pr6');
		$this->load->view('finishing/finishing_index',$data);
	}
	
	function loadMainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idmata_uang,nmmata_uang,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from terima_barang","id","id,idmata_uang,nmmata_uang,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('finishing/finishing_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from terima_barang where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdmata_uang' => $r->idmata_uang,
			'nmmata_uang' => $r->nmmata_uang,
			'active' => $r->active
		);
		$this->load->view('terima_barang/mata_uang_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idmata_uang' => strtoupper($this->input->post('kdmata_uang')),
			'nmmata_uang' => strtoupper($this->input->post('nmmata_uang')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('terima_barang', $data);
			$this->msistem->log_book('Input data baru Mata Uang "'.$this->input->post('nmmata_uang'),'md28',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('terima_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Mata Uang "'.$this->input->post('nmmata_uang'),'md28',$this->session->userdata('sis_user'));
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
		$this->db->delete("terima_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md28',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
}
?>
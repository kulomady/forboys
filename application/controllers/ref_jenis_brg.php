<?php 
class ref_jenis_brg extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md23');
		$this->load->view('ref_jenis_brg/jenis_brg_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idjenis like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmjenis like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idjenis,nmjenis,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_jenis_barang where nmjenis is not null $qr","id","id,idjenis,nmjenis,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_jenis_brg/jenis_brg_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_jenis_barang where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdjenis' => $r->idjenis,
			'nmjenis' => $r->nmjenis,
			'active' => $r->active
		);
		$this->load->view('ref_jenis_brg/jenis_brg_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idjenis' => strtoupper($this->input->post('kdjenis')),
			'nmjenis' => strtoupper($this->input->post('nmjenis')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_jenis_barang', $data);
			$this->msistem->log_book('Input data baru jenis Barang "'.$this->input->post('nmjenis'),'md23',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_jenis_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data jenis Barang "'.$this->input->post('nmjenis'),'md23',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idjenis from ref_jenis_barang where id = '".$idrec."'")->row();
		$kode = $r->idjenis;
		$this->msistem->log_delete("ref_jenis_barang","where idjenis = '$kode'");
		// Hapus
		$this->db->delete("ref_jenis_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md23',$this->session->userdata('sis_user'));
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
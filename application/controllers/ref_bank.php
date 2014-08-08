<?php 
class ref_bank extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md30');
		$this->load->view('ref_bank/bank_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idbank like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmbank like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idbank,nmbank,norek,atas_nama,cabang,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_bank where nmbank is not null $qr","id","id,idbank,nmbank,norek,atas_nama,cabang,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_bank/bank_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_bank where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'idbank' => $r->idbank,
			'nmbank' => $r->nmbank,
			'norek' => $r->norek,
			'atas_nama' => $r->atas_nama,
			'cabang' => $r->cabang,
			'is_active' => $r->active
		);
		$this->load->view('ref_bank/bank_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idbank' => strtoupper($this->input->post('kdbank')),
			'nmbank' => strtoupper($this->input->post('nmbank')),
			'norek' => $this->input->post('norek'),
			'atas_nama' => $this->input->post('atas_nama'),
			'cabang' => $this->input->post('cabang'),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_bank', $data);
			$this->msistem->log_book('Input data baru Bank "'.$this->input->post('txtidbank'),'md30',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_bank', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Bank "'.$this->input->post('txtidbank'),'md30',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idbank from ref_bank where id = '".$idrec."'")->row();
		$idbank = $r->idbank;
		$this->msistem->log_delete("ref_bank","where kode_pajak = '$idbank'");
		// hapus
		$this->db->delete("ref_bank",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md30',$this->session->userdata('sis_user'));
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
<?php 
class master_koordinator extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md6');
		$this->load->view('master_koordinator/koor_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and kode_koordinator like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nama_koordinator like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_koordinator,nama_koordinator,created,modified,created_by,modified_by,if(status=1,'Yes','No') as is_active from master_koordinator where nama_koordinator is not null $qr","id","id,kode_koordinator,nama_koordinator,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input(){
		$this->load->view('master_koordinator/koor_input');
	}
	
	function cek(){
		$sql = $this->db->query("select count(id) as jml from master_koordinator where kode_koordinator = '".strtoupper($this->input->post('kdkoor'))."'")->row();
		$jml = $sql->jml;
		echo $jml;
	}
	
	function simpan() {
		$data = array(
			'kode_koordinator' => strtoupper($this->input->post('kdkoor')),
			'nama_koordinator' => strtoupper($this->input->post('nmkoor')),
			'status' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('master_koordinator', $data);
			$this->msistem->log_book('Input data baru Master Koordinator "'.$this->input->post('nmkoor'),'md6',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('master_koordinator', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Master Koordinator "'.$this->input->post('nmkoor'),'md6',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
	}
	
	function frm_edit($id=""){
		$data['id'] = $id;
		$sql = $this->db->query("select * from master_koordinator where id = '".$id."'")->row();
		$data['kdkoor'] = $sql->kode_koordinator;
		$data['nmkoor'] = $sql->nama_koordinator;
		$data['active'] = $sql->status;
		$this->load->view('master_koordinator/koor_input',$data);
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("master_koordinator",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md6',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
}
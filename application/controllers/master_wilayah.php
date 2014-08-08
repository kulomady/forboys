<?php 
class master_wilayah extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md7');
		$this->load->view('master_wilayah/wilayah_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and kode_wilayah like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nama_wilayah like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_wilayah,nama_wilayah,created,modified,created_by,modified_by,if(status=1,'Yes','No') as is_active from master_wilayah where nama_wilayah is not null $qr","id","id,kode_wilayah,nama_wilayah,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input(){
		$this->load->view('master_wilayah/wilayah_input');
	}
	
	function cek(){
		$sql = $this->db->query("select count(id) as jml from master_wilayah where kode_wilayah = '".$this->input->post('kdwilayah')."'")->row();
		echo $sql->jml;
	}
	
	function simpan() {
		$data = array(
			'kode_wilayah' => strtoupper($this->input->post('kdwilayah')),
			'nama_wilayah' => strtoupper($this->input->post('nmwilayah')),
			'status' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('master_wilayah', $data);
			$this->msistem->log_book('Input data baru Master Koordinator "'.$this->input->post('nmwilayah'),'md7',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('master_wilayah', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Master Koordinator "'.$this->input->post('nmwilayah'),'md7',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
	}
	
	function frm_edit($id=""){
		$data['id'] = $id;
		$sql = $this->db->query("select * from master_wilayah where id = '".$id."'")->row();
		$data['kdwilayah'] = $sql->kode_wilayah;
		$data['nmwilayah'] = $sql->nama_wilayah;
		$data['active'] = $sql->status;
		$this->load->view('master_wilayah/wilayah_input',$data);
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("master_wilayah",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md7',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
}
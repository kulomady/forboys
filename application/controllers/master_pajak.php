<?php 
class master_pajak extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md4');
		$this->load->view('master_pajak/sp_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and a.kode_pajak like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and a.nama_pajak like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.idpajak, a.kode_pajak, a.nama_pajak, a.nilai, if(is_active=1,'Yes','No') as is_active,a.created,a.created_by,a.modified,a.modified_by from master_pajak a where a.nama_pajak is not null $qr order by a.created asc","idpajak","idpajak,kode_pajak,nama_pajak,nilai,is_active,created,created_by,modified,modified_by");
	}
	
	public function frm_input(){
		$this->load->view('master_pajak/sp_input');
	}
	
	public function simpan(){
		$kode = $this->input->post('kdPajak');
		$data = array(
			'kode_pajak' => strtoupper($this->input->post('kdPajak')),
			'nama_pajak' => strtoupper($this->input->post('nmPajak')),
			'nilai' => $this->input->post('nilai'),
			'is_active' => $this->input->post('status')			
		);
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('master_pajak', $data);
			$this->msistem->log_book('Input data baru Master Pajak "'.$kode,'md4',$this->session->userdata('sis_user'));
		} else {
			$kode = $this->input->post('kdPajak');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('master_pajak', $data,array('idpajak' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Master Pajak "'.$kode,'md4',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
            echo "1";
        }
	}
	
	public function frm_edit($id="") {
		$r = $this->db->query("select * from master_pajak where idpajak = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdPajak' => $r->kode_pajak,
			'nmPajak' => $r->nama_pajak,
			'nilai' => $r->nilai,
			'status' => $r->is_active
		);
		$this->load->view('master_pajak/sp_input',$data);
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		// log delete
		$r = $this->db->query("select kode_pajak from master_pajak where idpajak = '".$idrec."'")->row();
		$kode_pajak = $r->kode_pajak;
		$this->msistem->log_delete("master_pajak","where kode_pajak = '$kode_pajak'");
		// hapus
		$this->db->delete("master_pajak",array('idpajak' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md4',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
}
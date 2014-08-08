<?php 
class ref_jabatan_karyawan extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md29');
		$this->load->view('ref_jabatan_karyawan/jbt_kry_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idjbt like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmjbt like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idjbt,nmjbt,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_jabatan_karyawan where nmjbt is not null $qr","id","id,idjbt,nmjbt,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_jabatan_karyawan/jbt_kry_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_jabatan_karyawan where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdjbt' => $r->idjbt,
			'nmjbt' => $r->nmjbt,
			'active' => $r->active
		);
		$this->load->view('ref_jabatan_karyawan/jbt_kry_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idjbt' => strtoupper($this->input->post('kdjbt')),
			'nmjbt' => strtoupper($this->input->post('nmjbt')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_jabatan_karyawan', $data);
			$this->msistem->log_book('Input data baru Jabatan Karyawan "'.$this->input->post('nmjbt'),'md29',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_jabatan_karyawan', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Jabatan Karyawan "'.$this->input->post('nmjbt'),'md29',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idjbt from ref_jabatan_karyawan where id = '".$idrec."'")->row();
		$idjbt = $r->idjbt;
		$this->msistem->log_delete("ref_jabatan_karyawan","where idjbt = '$idjbt'");
		// hapus
		$this->db->delete("ref_jabatan_karyawan",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md29',$this->session->userdata('sis_user'));
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
<?php 
class ref_tipe_brg extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_group_user');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md21');
		$this->load->view('ref_tipe_brg/tipe_brg_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idtipe like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmtipe like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idtipe,nmtipe,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_tipe_barang where nmtipe is not null $qr","id","id,idtipe,nmtipe,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_tipe_brg/tipe_brg_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_tipe_barang where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdTipe' => $r->idtipe,
			'nmTipe' => $r->nmtipe,
			'active' => $r->active
		);
		$this->load->view('ref_tipe_brg/tipe_brg_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idtipe' => strtoupper($this->input->post('kdTipe')),
			'nmtipe' => strtoupper($this->input->post('nmTipe')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_tipe_barang', $data);
			$this->msistem->log_book('Input data baru Tipe Barang "'.$this->input->post('nmTipe'),'MD21',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_tipe_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Tipe Barang "'.$this->input->post('nmTipe'),'MD21',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idtipe from ref_tipe_barang where id = '".$idrec."'")->row();
		$kode = $r->idtipe;
		$this->msistem->log_delete("ref_tipe_barang","where idtipe = '$kode'");
		// Hapus
		$this->db->delete("ref_tipe_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'MD21',$this->session->userdata('sis_user'));
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
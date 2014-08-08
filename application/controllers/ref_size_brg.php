<?php 
class ref_size_brg extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md27');
		$this->load->view('ref_size_brg/size_brg_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and idsize like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmsize like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idsize,nmsize,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from ref_size_barang where nmsize is not null $qr","id","id,idsize,nmsize,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_size_brg/size_brg_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_size_barang where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdsize' => $r->idsize,
			'nmsize' => $r->nmsize,
			'active' => $r->active
		);
		$this->load->view('ref_size_brg/size_brg_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'idsize' => strtoupper($this->input->post('kdsize')),
			'nmsize' => strtoupper($this->input->post('nmsize')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_size_barang', $data);
			$this->msistem->log_book('Input data baru size Barang "'.$this->input->post('nmsize'),'md27',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_size_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data size Barang "'.$this->input->post('nmsize'),'md27',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idsize from ref_size_barang where id = '".$idrec."'")->row();
		$idsize = $r->idsize;
		$this->msistem->log_delete("ref_size_barang","where idsize = '$idsize'");
		// Hapus data
		$this->db->delete("ref_size_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md27',$this->session->userdata('sis_user'));
		
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
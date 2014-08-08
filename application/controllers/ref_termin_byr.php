<?php 
class ref_termin_byr extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md33');
		$this->load->view('ref_termin_byr/termin_byr_index',$data);
	}
	
	function loadMainData($jmlHari="",$nama="") {
		$qr = "";
		if($jmlHari != '0'):
			$qr .= "and jml_hari like '%".$jmlHari."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nmtermin like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select idtermin,nmtermin,jml_hari,created,modified,created_by,modified_by,if(active=1,'Yes','No') as is_active from sys_termin_pembayaran where nmtermin is not null $qr","idtermin","idtermin,nmtermin,jml_hari,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_input() {
		$this->load->view('ref_termin_byr/termin_byr_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from sys_termin_pembayaran where idtermin = '".$id."'")->row();
		$data = array(
			'idtermin' => $id,
			'nmtermin' => $r->nmtermin,
			'jml_hari' => $r->jml_hari,
			'active' => $r->active
		);
		$this->load->view('ref_termin_byr/termin_byr_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'nmtermin' => strtoupper($this->input->post('nmtermin')),
			'jml_hari' => strtoupper($this->input->post('jml_hari')),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('sys_termin_pembayaran', $data);
			$this->msistem->log_book('Input data baru termin pembayaran "'.$this->input->post('idtermin'),'md33',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('sys_termin_pembayaran', $data,array('idtermin' => $this->input->post('id')));
			$this->msistem->log_book('Edit data termin pembayaran "'.$this->input->post('idtermin'),'md33',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select idtermin from sys_termin_pembayaran where idtermin = '".$idrec."'")->row();
		$kode = $r->idtermin;
		$this->msistem->log_delete("sys_termin_pembayaran","where idtermin = '$kode'");
		
		$this->db->delete("sys_termin_pembayaran",array('idtermin' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md33',$this->session->userdata('sis_user'));
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
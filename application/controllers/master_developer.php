<?php 
class master_developer extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md5');
		$this->load->view('developer/developer_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and kode_developer like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nama_developer like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_developer,nama_developer,created,modified,created_by,modified_by,if(is_active=1,'Yes','No') as is_active from master_developer where nama_developer is not null $qr","id","id,kode_developer,nama_developer,created,modified,created_by,modified_by,is_active");
	}
	
	function frm_utama() {
		$this->load->view('developer/developer_utama'); 
	}
	
	function frm_input_2() {
		$this->load->view('developer/developer_input2'); 
	}
	
	function frm_input_3() {
		$this->load->view('developer/developer_input3'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select kode_developer, nama_developer, komisi, jns, is_active from master_developer where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kddeveloper' => $r->kode_developer,
			'nmdeveloper' => $r->nama_developer,
			'komisi' => $r->komisi,
			'jns' => $r->jns,
			'active' => $r->is_active
		);
		$this->load->view('developer/developer_utama',$data); 
	}
	
	function frm_edit_2($id="") {
		$r = $this->db->query("select p_marketing_new, p_kantor_new, p_kep_koordinator_new, p_koordinator_new, p_listing_second, p_kantor_second, p_selling_second, p_reward_second, p_listing2_second, p_selling2_second, p_koor_second from master_developer where id = '".$id."'")->row();
		$data = array(
			'marketing_new' => $r->p_marketing_new,
			'kantor_new' => $r->p_kantor_new,
			'kep_koor_new' => $r->p_kep_koordinator_new,
			'koor_new' => $r->p_koordinator_new,
			'listing_sec' => $r->p_listing_second,
			'kantor_sec' => $r->p_kantor_second,
			'selling_sec' => $r->p_selling_second,
			'kselling_sec' => $r->p_selling2_second,
			'klisting_sec' => $r->p_listing2_second,
			'reward_sec' => $r->p_reward_second,
			'koor_sec' => $r->p_koor_second
		);
		$this->load->view('developer/developer_input2',$data); 
	}
	
	function frm_edit_3($id="") {
		$r = $this->db->query("select p_upline1,p_upline2,p_upline3,p_upline4,p_upline5,p_jual15,p_jual5M,p_jual35,point from master_developer where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'upline1' => $r->p_upline1,
			'upline2' => $r->p_upline2,
			'upline3' => $r->p_upline3,
			'upline4' => $r->p_upline4,
			'upline5' => $r->p_upline5,
			'l15org' => $r->p_jual15,
			'l5org' => $r->p_jual5M,
			'l35org' => $r->p_jual35,
			'point' => $r->point
		);
		$this->load->view('developer/developer_input3',$data); 
	}
	
	function simpan() {
		$data = array(
			'kode_developer' => strtoupper($this->input->post('kddeveloper')),
			'nama_developer' => strtoupper($this->input->post('nmdeveloper')),
			'komisi' => strtoupper($this->input->post('komisi')),
			'is_active' => $this->input->post('status'),
			'jns' => $this->input->post('jns'),
			'p_marketing_new' => strtoupper($this->input->post('marketing_new')),
			'p_kantor_new' => strtoupper($this->input->post('kantor_new')),
			'p_koordinator_new' => strtoupper($this->input->post('koor_new')),
			'p_listing_second' => strtoupper($this->input->post('listing_sec')),
			'p_kantor_second' => strtoupper($this->input->post('kantor_sec')),
			'p_selling_second' => strtoupper($this->input->post('selling_sec')),
			'p_reward_second' => strtoupper($this->input->post('reward_sec')),
			'p_selling2_second' => strtoupper($this->input->post('kselling_sec')),
			'p_listing2_second' => strtoupper($this->input->post('klisting_sec')),
			'p_koor_second' => strtoupper($this->input->post('koor_sec')),
			'p_upline1' => strtoupper($this->input->post('upline1')),
			'p_upline2' => strtoupper($this->input->post('upline2')),
			'p_upline3' => strtoupper($this->input->post('upline3')),
			'p_upline4' => strtoupper($this->input->post('upline4')),
			'p_upline5' => strtoupper($this->input->post('upline5')),
			'p_jual15' => strtoupper($this->input->post('l15org')),
			'p_jual5M' => strtoupper($this->input->post('l5org')),
			'p_jual35' => strtoupper($this->input->post('l35org')),
			'point' => strtoupper($this->input->post('point'))
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('master_developer', $data);
			$this->msistem->log_book('Input data baru Master Developer "'.$this->input->post('nmdeveloper'),'md25',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('master_developer', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Master Developer "'.$this->input->post('nmdeveloper'),'md25',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("master_developer",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md5',$this->session->userdata('sis_user'));
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
<?php 
class user extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_group_user');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pg12');
		$data['lokasi'] = $this->m_company->pilihLokasiAll('0');
		$data['userGroup'] = $this->m_group_user->pilihUserGroup('0');
		$this->load->view('user/user_index',$data);
	}
	
	function loadMainData($username="",$nama="",$group_id="",$outlet_id="") {
		$qr = "";
		if($username != "0"):
			$qr .= " and a.username like '%".$username."%'";
		endif;
		if($nama != "0"):
			$qr .= " and (a.first_name like '%".$nama."%' or a.last_name like '%".$nama."%'";
		endif;
		if($group_id != "0"):
			$qr .= " and a.group_id = '".$group_id."'";
		endif;
		if($outlet_id != "0"):
			$qr .= " and a.outlet_id = '".$outlet_id."'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,b.nm_outlet,a.username,concat(ifnull(a.first_name,''),' ',ifnull(a.last_name,'')) as nama, a.phone,a.email,a.created_on  from tb_users a inner join master_company b on a.outlet_id = b.outlet_id where a.id != '0' $qr","id","id,username,nama,phone,email,nm_outlet,created_on");
	}
	
	function frm_input() {
		$data['lokasi'] = $this->m_company->pilihLokasiAll('0');
		$data['userGroup'] = $this->m_group_user->pilihUserGroup('0');
		$this->load->view('user/user_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tb_users where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'username' => $r->username,
			'email' => $r->email,
			'first_name' => $r->first_name,
			'phone' => $r->phone,
			'active' => $r->active
		);
		$data['lokasi'] = $this->m_company->pilihLokasiAll($r->outlet_id);
		$data['userGroup'] = $this->m_group_user->pilihUserGroup($r->group_id);
		$this->load->view('user/user_input',$data); 
	}
	
	function simpan() {
		// cek namaPengguna
		$sql = $this->db->query("select username from tb_users where username = '".$this->input->post('nmPengguna')."'");
		if(count($sql->result()) != 0 && $this->input->post('id')==""):
			echo "2";
			return;
		endif;
		$data = array(
			'username' => $this->input->post('nmPengguna'),
			'email' => $this->input->post('email'),
			'first_name' => strtoupper($this->input->post('nama')),
			'outlet_id' => $this->input->post('outlet_id'),
			'phone' => $this->input->post('tlp'),
			'group_id' => $this->input->post('group_id'),
			'active' => $this->input->post('status')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created_on' => date("Y-m-d H:i:s"),
				'created_by' => $this->session->userdata('sis_user'),
				'password' => md5($this->input->post('kataKunci'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tb_users', $data);
			$this->msistem->log_book('Input data baru User "'.$this->input->post('nmPengguna'),'PG12',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => $this->session->userdata('sis_user'));
			if($this->input->post('kataKunci') != ""):
				$dataUpdate = array_merge($dataUpdate,array('password' => md5($this->input->post('kataKunci'))));
			endif;
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tb_users', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data baru user "'.$this->input->post('nmPengguna'),'PG12',$this->session->userdata('sis_user'));
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
		$r = $this->db->query("select username from tb_users where id = '".$idrec."'")->row();
		$username = $r->username;
		$this->msistem->log_delete("tb_users","where username = '$username'");
		// hapus
		$this->db->delete("tb_users",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'PG12',$this->session->userdata('sis_user'));
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
<?php 
class master_customer extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');
		$this->load->model('m_komisi');   
    }
	
	public function index(){
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md8');
		$this->load->view('master_customer/customer_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and kdtrans like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nama_customer like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select id, kdtrans, nama_customer, alamat, telp_hp, created, created_by, modified, modified_by from master_customer where kdtrans is not null $qr","id","id,kdtrans,nama_customer,alamat,telp_hp,created,created_by,modified,modified_by");
	}
	
	function frm_input() {
		$this->load->view('master_customer/customer_input'); 
	}
	
	function cekNID(){
		$sql = $this->db->query("select count(id) as jml from master_customer where no_identitas = '".$this->input->post('no_id')."'")->row();
		if($sql->jml==0){
			echo 0;
		} else {
			echo 1;
		}
	}
	
	function simpan(){
		$tgllahir = $this->msistem->conversiTgl($this->input->post("tgl_lahir"));
		$data = array(
			'nama_customer' => strtoupper($this->input->post('nama_customer')),
			'alamat' => $this->input->post('alamat'),
			'agama' => strtoupper($this->input->post('agama')),
			'tgl_lahir' => $tgllahir,
			'kodepos' => strtoupper($this->input->post('kodepos')),
			'telp_rumah' => strtoupper($this->input->post('telp_rumah')),
			'telp_hp' => strtoupper($this->input->post('telp_hp')),
			'telp_kantor' => strtoupper($this->input->post('telp_kantor')),
			'fax' => strtoupper($this->input->post('fax')),
			'no_identitas' => strtoupper($this->input->post('identitas')),
			'email' => $this->input->post('email'),
			'no_npwp' => strtoupper($this->input->post('npwp'))
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$kdtrans = $this->msistem->noCustomer('CS','master_customer');
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('master_customer', $data);
			$this->msistem->log_book('Input data baru Master Customer "'.$kdtrans,'md8',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = strtoupper($this->input->post('kode_customer'));
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('master_customer', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Master Customer "'.$kdtrans,'md8',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
	}
	
	function frm_edit($id="") {
		$data['id'] = $id;
		$r = $this->db->query("select a.id, a.kdtrans, a.telp_hp, a.telp_kantor, a.no_npwp, a.agama, a.no_identitas, DATE_FORMAT(a.tgl_lahir,'%d/%m/%Y') as tgl, a.kdtrans, a.nama_customer, a.kodepos, a.telp_rumah, a.fax, a.created, a.email, a.alamat, a.no_identitas, a.created_by, a.modified, a.modified_by from master_customer a where a.kdtrans = '".$id."'")->row();
		$data['kode_pemesan'] = $r->kdtrans;
		$data['nama_pemesan'] = $r->nama_customer;
		$data['tgl_lahir'] = $r->tgl;
		$data['agama'] = $r->agama;
		$data['alamat'] = $r->alamat;
		$data['npwp'] = $r->no_npwp;
		$data['tlp_hp'] = $r->telp_hp;
		$data['tlp_kantor'] = $r->telp_kantor;
		$data['tlp_rumah'] = $r->telp_rumah;
		$data['identitas'] = $r->no_identitas;
		$data['email'] = $r->email;
		$data['pos'] = $r->kodepos;
		$data['fax'] = $r->fax;
		$this->load->view('master_customer/customer_input',$data);
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("master_customer",array('kdtrans' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md8',$this->session->userdata('sis_user'));
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
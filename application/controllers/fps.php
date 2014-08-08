<?php 
class fps extends SIS_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('m_member');
	}
	
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('mk2');
		$this->load->view('fps/fps_index',$data);
	}
	
	function cbUpline_mk2(){
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select id_deal,nama_member from master_member","id_deal","nama_member");
	}
	
	function loadMainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("trans_fps","id","id,kdtrans,nama_konsumen,created,created_by,modified,modified_by");
	}
	
	function frm_input() {
		$data['opt'] = $this->m_member->pilihParent(0);
		$this->load->view('fps/fps_input',$data); 
	}
	
	function frm_edit($id="") {
		$data['id'] = $id;
		$r = $this->db->query("select * from trans_fps where id = '".$id."'")->row();
		$data['nup'] = $r->kdtrans;
		$data['nama_konsumen'] = $r->nama_konsumen;
		$data['alamat'] = $r->alamat;
		$data['tlp_rumah'] = $r->tlp_rumah;
		$data['tlp_hp'] = $r->tlp_hp;
		$data['email'] = $r->email;
		$data['rek'] = $r->rek;
		$data['type'] = $r->type;
		$data['no_card'] = $r->no_card;
		$data['jumlah'] = $r->jumlah;
		$data['units'] = $r->units;
		$data['hp'] = $r->sales_hp;
		
		$data['opt'] = $this->m_member->pilihParent($r->sales);
		$this->load->view('fps/fps_input',$data); 
	}
	
	function simpan() {
		$data = array(
			'nama_konsumen' => strtoupper($this->input->post('nama_konsumen')),
			'alamat' => strtoupper($this->input->post('alamat')),
			'tlp_rumah' => strtoupper($this->input->post('tlp_rumah')),
			'tlp_hp' => strtoupper($this->input->post('tlp_hp')),
			'email' => strtoupper($this->input->post('email')),
			'rek' => strtoupper($this->input->post('rek')),
			'type' => $this->input->post('type'),
			'no_card' => strtoupper($this->input->post('no_card')),
			'jumlah' => strtoupper($this->input->post('jumlah')),
			'units' => $this->input->post('unit'),
			'sales' => strtoupper($this->input->post('sales')),
			'sales_hp' => strtoupper($this->input->post('hp'))
		);
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$kode = $this->msistem->noTranss('FPS','trans_fps');
			$dataIns = array (
				'kdtrans' => $kode,
				'tgl' => date('Y-m-d'),
				'status' => 1,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('trans_fps', $data);
			$this->msistem->log_book('Input data baru FPS "'.$this->input->post('member'),'MK2',$this->session->userdata('sis_user'));
		} else {
			$kode = $this->input->post('nup');
			$dataUpdate = array('modified' => date("Y-m-d H:i:s"), 'modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('trans_fps', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data FPS "'.$this->input->post('member'),'MK2',$this->session->userdata('sis_user'));
		}

		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "[Auto]";
        } else {
            $this->db->trans_commit();
			echo $kode;
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("trans_fps",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'MK2',$this->session->userdata('sis_user'));
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
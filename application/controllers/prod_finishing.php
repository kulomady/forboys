<?php 
class prod_finishing extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_perkiraan');
		$this->load->model('msistem');
		$this->load->model('m_produksi');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pr5');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pilihJnsPekerjaan'] = $this->m_produksi->pilihJnsPekerjaan('0');
		$this->load->view('prod_finishing/finish_index',$data);
	}	
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$data['pilihJnsPekerjaan'] = $this->m_produksi->pilihJnsPekerjaan('0');
		$this->load->view('prod_finishing/finish_input',$data);
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select a.*,b.idperkiraan as idperkiraan_kas,b.nmperkiraan as nmperkiraan_kas,c.idperkiraan as idperkiraan_biaya,c.nmperkiraan as nmperkiraan_biaya from prod_finishing a left join ak_master_perkiraan b on a.idperkiraan_kas = b.idperkiraan left join ak_master_perkiraan c on a.idperkiraan_biaya = c.idperkiraan where a.id = '".$id."'")->row();		
		$data = array (
			'id' => $id,
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'txttgl' => $this->msistem->conversiTglDB($r->tgl),
			'nama' => $r->nama,
			'pilihJnsPekerjaan' =>  $this->m_produksi->pilihJnsPekerjaan($r->idjns_pekerjaan),
			'idperkiraan_kas' => $r->idperkiraan_kas,
			'nmperkiraan_kas' => $r->nmperkiraan_kas,
			'idperkiraan' => $r->idperkiraan_biaya,
			'nmperkiraan' => $r->nmperkiraan_biaya,
			'pilihPO' => $this->m_produksi->pilihPO($r->idjo),
			'jmlPo' => $r->jml_po,
			'jml' => $r->jml_tagihan,
			'keterangan' => $r->keterangan,
		);
		$this->load->view('prod_finishing/finish_input',$data);
	}
	
	function simpan() {
		
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array (
			'outlet_id' => $this->input->post("outlet_id"),
			'tgl' => $tgl,
			'nama' => strtoupper($this->input->post("nama")),
			'idjns_pekerjaan' => $this->input->post("jnsPekerjaan"),
			'idperkiraan_kas' => $this->input->post("kdakunKas"),
			'idperkiraan_biaya' => $this->input->post("kdakun"),
			'idjo' => $this->input->post("idjo"),
			'jml_po' => $this->input->post("jmlPo"),
			'jml_tagihan' => $this->input->post("totalBayar"),
			'keterangan' => strtoupper($this->input->post("ket"))
		);
		$this->db->trans_begin();
		if($this->input->post("id")=="") {
			$dataIns = array_merge($data,array('created' => date("Y-m-d H:i:s"), 'created_by' => $this->session->userdata('sis_user')));
			$this->db->insert('prod_finishing', $dataIns);
			$this->msistem->log_book('Input data Prod Finishing "'.$this->input->post("id"),'pr5',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array_merge($data,array('modified_by' => $this->session->userdata('sis_user')));
			$this->db->update('prod_finishing',$dataUpdate,array('id' => $this->input->post("id")));
			$this->msistem->log_book('Update data Prod finishing "'.$this->input->post("id"),'pr5',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function loadMainData($tgl1="",$tgl2="",$outlet_id="",$po="",$jnsPekerjaan="") {
		$qr = "";
		if($po != "0"):
			$qr .= " and a.idjo = '".$po."'";	
		endif;
		if($outlet_id != "0"):
			$qr .= " and a.outlet_id = '".$outlet_id."'";	
		endif;
		if($jnsPekerjaan != "0"):
			$qr .= " and a.idjns_pekerjaan = '".$jnsPekerjaan."'";	
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.*,b.nm_outlet,c.nmperkiraan as akun_kas,d.nmperkiraan as akun_biaya,e.nmjo,f.nmjp from prod_finishing a inner join master_company b on a.outlet_id = b.outlet_id inner join ak_master_perkiraan c on a.idperkiraan_kas = c.idperkiraan inner join ak_master_perkiraan d on a.idperkiraan_biaya = d.idperkiraan inner join tr_job_order e on a.idjo = e.idjo inner join sys_jns_pekerjaan f on a.idjns_pekerjaan = f.idjp where a.tgl >= '".$tgl1."' and a.tgl <= '".$tgl2."' $qr","id","id,tgl,nmjp,nm_outlet,nama,akun_kas,akun_biaya,nmjo,jml_po,jml_tagihan,created,created_by");
	}
	
	function hapus() {
		$id = $this->input->post('id');
		$this->db->trans_begin();
		$this->db->delete("prod_finishing",array('id' => $id));
		$this->msistem->log_book('Delete data id "'.$id,'pr5',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function frm_search_akun_kas() {
		$this->load->view('prod_finishing/rb_search_akun_kas');
	}
	
	function frm_search_akun() {
		$this->load->view('prod_finishing/rb_search_akun');
	}
	
}
?>
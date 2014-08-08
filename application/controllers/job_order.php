<?php 
class job_order extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pr1');
		$this->load->view('job_order/jo_index',$data);
	}
	
	function loadMainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.tgljo,a.idjo,a.nmjo,b.nmbarang,c.nmbarang as nmbahan,a.jml,a.tgl_selesai,a.status,a.created,a.created_by from tr_job_order a inner join v_master_barang_detail b on b.idgroup_barang = a.idbarang inner join v_master_barang_detail c on a.idbahan = c.idbarang group by b.idgroup_barang","id","id,tgljo,idjo,nmjo,nmbarang,nmbahan,jml,tgl_selesai,status,created,created_by");
	}
	
	function frm_input() {
		$data['size'] = $this->db->query("select idsize,nmsize from ref_size_barang order by id asc");
		$this->load->view('job_order/jo_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select a.*,b.nmbarang,c.nmbarang as bahan from tr_job_order a inner join v_master_barang_detail b on b.idgroup_barang = a.idbarang inner join v_master_barang_detail c on a.idbahan = c.idbarang where a.id = '".$id."' group by b.idgroup_barang")->row();
		$data = array(
			'id' => $id,
			'tglJO' => $this->msistem->conversiTglDB($r->tgljo),
			'kdPO' => $r->idjo,
			'nmPO' => $r->nmjo,
			'idbarang' => $r->idbarang,
			'nmbarang' => $r->nmbarang,
			'bahan' => $r->idbahan,
			'nmbahan' => $r->bahan,
			'jmlPO' => $r->jml,
			'tglSelesai' => $this->msistem->conversiTglDB($r->tgl_selesai),
			'idplg' => $r->idrekan,
			'status' => $r->status
		);
		$data['size'] = $this->db->query("select idsize,nmsize from ref_size_barang order by id asc");
		$this->load->view('job_order/jo_input',$data); 
	}
	
	function simpan() {
		$tgljo = $this->msistem->conversiTgl($this->input->post("txtTglJO"));
		$tgl_selesai = $this->msistem->conversiTgl($this->input->post('txtTglSelesai'));
		$data = array(
			'tgljo' => $tgljo,
			'idjo' => $this->input->post('kdPO'),
			'nmjo' => strtoupper($this->input->post('nmPO')),
			'idbarang' => $this->input->post('idbarang'),
			'idrekan' => $this->input->post('cbPelanggan'),
			'idbahan' => strtoupper($this->input->post('txtBahan')),
			'jml' => $this->input->post('txtJmlPO'),
			'tgl_selesai' => $tgl_selesai,
			'status' => $this->input->post('slcStatus')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_job_order', $data);
			$this->msistem->log_book('Input data baru Job Order "'.$this->input->post('kdPO'),'pr1',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_job_order', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Job Order "'.$this->input->post('kdPO'),'pr1',$this->session->userdata('sis_user'));
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
		$this->db->delete("tr_job_order",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pr1',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function cbPelanggan() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '1' order by nmrekan asc","idrekan","nmrekan");
	}
}
?>
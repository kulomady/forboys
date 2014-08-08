<?php 
class pinjaman_kry extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('ku1');
		$this->load->view('pinjaman_kry/pk_index',$data);
	}
	
	function loadMainData($tgl1="",$tgl2="",$idrekan="") {
		$qr = "";
		if($idrekan != '0'):
			$qr .= "and idrekan = '".$idrekan."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.*,b.nmrekan from tr_pinjaman_kry a inner join master_rekan_bisnis b on a.idrekan = b.idrekan where tgl >= '".$tgl1."' and tgl <= '".$tgl2."' $qr","id","id,idrekan,nmrekan,tgl,sisa_pinjaman,pinjaman,total_pinjaman,created,created_by");
	}
	
	function frm_input() {
		$this->load->view('pinjaman_kry/pk_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_pinjaman_kry where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'idrekan' => $r->idrekan,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'sisa_pinjaman' => $r->sisa_pinjaman,
			'pinjaman' => $r->pinjaman,
			'total_pinjaman' => $r->total_pinjaman
		);
		$this->load->view('pinjaman_kry/pk_input',$data); 
	}
	
	function simpan() {
		$tglMasuk = $this->msistem->conversiTgl($this->input->post('tglMasuk'));
		$data = array(
			'idrekan' => $this->input->post('idrekan'),
			'tgl' => $tglMasuk,
			'sisa_pinjaman' => $this->input->post('sisaPinjaman'),
			'pinjaman' => $this->input->post('pinjaman'),
			'total_pinjaman' => $this->input->post('totalPinjaman')
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_pinjaman_kry', $data);
			$this->msistem->log_book('Input data baru Pinjaman Kry "'.$this->input->post('txtidbank'),'ku1',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_pinjaman_kry', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Pinjaman Kry "'.$this->input->post('txtidbank'),'ku1',$this->session->userdata('sis_user'));
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
		$this->db->delete("tr_pinjaman_kry",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'ku1',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function cbKaryawan() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select a.idrekan,a.nmrekan from master_rekan_bisnis a inner join sys_hak_outlet b on a.outlet_id = b.outlet_id where a.idtipe_rekan = '3' and b.view = '1' and b.group_id = '".$this->session->userdata('group_id')."'","idrekan","nmrekan");
	}
	
	function sisaPinjaman() {
		$idrekan = $this->input->post('idrekan');
		$r = $this->db->query("select (sisa_pinjaman - byr_pinjaman) as sisa from tr_gaji_kry where idrekan = '".$idrekan."' having max(id)")->row();
		echo $r->sisa;
	}
	
}
?>
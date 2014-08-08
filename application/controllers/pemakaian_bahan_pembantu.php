<?php 
class pemakaian_bahan_pembantu extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
		$this->load->model('m_company');
		$this->load->model('m_produksi');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pr3');
		$this->load->view('pemakaian_bahan_pembantu/pbp_index',$data);
	}
	
	function loadMainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,b.nm_outlet,c.jml,c.nmjo,concat(a.idperkiraan,' ',d.nmperkiraan) as nmperkiraan,a.keterangan,a.created_by,a.created from prod_pemakaian_bhn_bantu a inner join master_company b on a.outlet_id = b.outlet_id inner join tr_job_order c on a.idjo = c.idjo inner join ak_master_perkiraan d on a.idperkiraan = d.idperkiraan","id","id,kdtrans,tgl,nm_outlet,nmjo,jml,nmperkiraan,keterangan,created,created_by");
	}
	
	function loadDataBrgDetail($kdtrans) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="openWinBrg_pb1(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="delRow_pb1(0);" />';
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.*,concat(b.nmbarang,' ',ifnull(b.nmwarna,'')) as nmbarang,b.nmsatuan,'$img' as img,'$img_del' as img_del from prod_pemakaian_bhn_bantu_detail a inner join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","id","idbarang,img,nmbarang,nmsatuan,jml,pcs,harga,total,img_del");	
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$this->load->view('pemakaian_bahan_pembantu/pbp_input',$data); 
	}
	
	function frm_search_akun() {
		$this->load->view('pemakaian_bahan_pembantu/rb_search_akun');
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select a.*,b.nmperkiraan from prod_pemakaian_bhn_bantu a inner join ak_master_perkiraan b on a.idperkiraan = b.idperkiraan where a.id = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'pilihPO' => $this->m_produksi->pilihPO($r->idjo),
			'idperkiraan' => $r->idperkiraan,
			'nmperkiraan' => $r->nmperkiraan,
			'keterangan' => $r->keterangan
		);
		$this->load->view('pemakaian_bahan_pembantu/pbp_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array (
			'tgl' => $tgl,
			'outlet_id' => $this->input->post("gudang"),
			'idjo' => $this->input->post("nopo"),
			'idperkiraan' => $this->input->post("kdakun"),
			'keterangan' => strtoupper($this->input->post("keterangan")),
		);
		$this->db->trans_begin();
		if($this->input->post("kdtrans")=="") {
			$kdtrans = $this->msistem->noTrans('BP','prod_pemakaian_bhn_bantu','',$this->input->post('gudang'),$tgl);
			$dataIns = array_merge($data,array('kdtrans' => $kdtrans,'created' => date("Y-m-d H:i:s"), 'created_by' => $this->session->userdata('sis_user')));
			$this->db->insert('prod_pemakaian_bhn_bantu', $dataIns);
			$this->msistem->log_book('Input data Pemakaian Bahan Bantu Kode "'.$kdtrans,'pr3',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post("kdtrans");
			$dataUpdate = array_merge($data,array('modified_by' => $this->session->userdata('sis_user')));
			$this->db->update('prod_pemakaian_bhn_bantu',$dataUpdate,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Update data Pemakaian Bantu Baku Kode "'.$kdtrans,'pr3',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'prod_pemakaian_bhn_bantu_detail';
		$dataIns = array('idbarang','jml','pcs','harga','total');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		// input report stock
		$table = 'rpt_stock';
		$dataIns = array('idbarang','qty_pakai_out','pcs_pakai_out','','jml_pakai_out');
		$fk = array('notrans' => $kdtrans,'outlet_id' => $this->input->post("gudang"),'tgl' => $tgl);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("prod_pemakaian_bhn_bantu",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pr3',$this->session->userdata('sis_user'));
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
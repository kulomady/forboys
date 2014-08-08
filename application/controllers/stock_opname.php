<?php 
class stock_opname extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pd5');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('stock_opname/so_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$asal="",$no_opname="",$ket="") {
		$qr = "";
		$join = "";
		if($no_opname != "0"):
			$qr .= " and a.kdtrans like '%".$no_opname."%'";
		endif;
		
		if($asal != "0") {
			$qr .= " and a.outlet_id = '".$asal."'";
		} else {
			$join = " inner join sys_hak_outlet e on a.outlet_id = e.outlet_id and group_id = '".$this->session->userdata('group_id')."'";
		}
		
		if($ket != "0"):
			$qr .= " and a.keterangan like '%".$ket."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.outlet_id,a.keterangan,a.created,a.created_by,b.nm_outlet from tr_stock_opname a inner join master_company b on a.outlet_id = b.outlet_id $join where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr","kdtrans","id,kdtrans,tgl,outlet_id,nm_outlet,keterangan,created,created_by");
	}
	
	function loadDataBrgDetail($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.stock_fisik,a.pcs_fisik,a.hrgbeli,a.hrgjual,b.nmbarang,b.nmwarna,b.nmsatuan,b.nmsize,'$img' as img,'$img_del' as img_del from tr_stock_opname_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","idbarang","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,stock_fisik,pcs_fisik,img_del,hrgbeli,hrgjual");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('stock_opname/so_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_stock_opname where kdtrans = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'keterangan' => $r->keterangan
		);
		$this->load->view('stock_opname/so_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array(
			'tgl' => $tgl,
			'outlet_id' => $this->input->post('outlet_id'),
			'keterangan' => strtoupper($this->input->post('keterangan'))
		);
		
		$this->db->trans_begin();
		if($this->input->post('kdtrans')=="") {
			$kdtrans = $this->msistem->noTrans('SO','tr_stock_opname','',$this->input->post('outlet_id'),$tgl);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_stock_opname', $data);
			$this->msistem->log_book('Input data baru Opname "'.$kdtrans,'pd5',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_stock_opname', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data Transfer Barang "'.$kdtrans,'pd5',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'tr_stock_opname_detail';
		$dataIns = array('idbarang','stock_fisik','pcs_fisik','hrgbeli','hrgjual');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		$table = 'rpt_stock';
		$dataIns = array('idbarang','qty_opname','pcs_opname','hrgbeli_opname','hrgjual_opname');
		$fk = array('notrans' => $kdtrans,'outlet_id' => $this->input->post('outlet_id'),'tgl' => $tgl);
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
		$this->db->delete("tr_stock_opname",array('kdtrans' => $idrec));
		$this->db->delete("rpt_stock",array('notrans' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pd5',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
}
?>
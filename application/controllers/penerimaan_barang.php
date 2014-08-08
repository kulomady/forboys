<?php 
class penerimaan_barang extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pd4');
		$data['dari'] = $this->m_company->pilihLokasiAll(0);
		$data['tujuan'] = $this->m_company->pilihLokasi('0');
		$this->load->view('penerimaan_barang/terima_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$asal="",$tujuan="",$ket="") {
		if($asal != "0"):
			$qr .= " and a.outlet_id = '".$asal."'";
		endif;
		if($tujuan != "0"):
			$qr .= " and a.outlet_tujuan = '".$tujuan."'";
		endif;
		if($ket != "0"):
			$qr .= " and a.keterangan like '%".$ket."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.outlet_id,a.outlet_tujuan,a.supir,a.nopol,a.keterangan,a.created,a.created_by,b.nm_outlet,c.nm_outlet as tujuan from tr_terima_barang a inner join master_company b on a.outlet_id = b.outlet_id inner join master_company c on a.outlet_tujuan = c.outlet_id where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr","kdtrans","id,kdtrans,tgl,outlet_id,nm_outlet,outlet_tujuan,tujuan,keterangan,supir,nopol,created,created_by");
	}
	
	function loadDataBrgDetail($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.jml_kirim,a.jml_terima,a.jml_kirim,a.pcs,a.harga,a.hargaBeli,a.total,b.nmbarang,b.nmwarna,b.nmsatuan,b.nmsize,'$img' as img,'$img_del' as img_del from tr_terima_barang_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","id","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,jml_kirim,jml_terima,pcs,harga,hargaBeli,total,img_del");
	}
	
	function loadDataBrgTrans($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select * from (select a.id,a.idbarang,a.harga,((ifnull(a.jml,0) * if(a.pcs='',1,a.pcs)) - (ifnull(c.jml_terima,0) * ifnull(if(c.pcs='0',1,c.pcs),1))) as jml,'' as total,a.hrgbeli,b.nmbarang,b.nmwarna,b.nmsatuan,b.nmsize,'$img' as img,'$img_del' as img_del, '' as input from tr_transfer_barang_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang left join v_terima_barang c on a.kdtrans = c.no_transfer and a.idbarang = c.idbarang where a.kdtrans = '".$kdtrans."') as tb where jml != '0'","id","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,jml,input,pcs,harga,hrgbeli,total,img_del");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasiAll(0);
		$data['tujuan'] = $this->m_company->pilihLokasi(0);
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$this->load->view('penerimaan_barang/terima_input',$data); 
	}
	
	function frm_search_transfer(){
		$this->load->view('penerimaan_barang/terima_search_transfer'); 
	}
	
	
	function loadDataTransfer() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select tb1.* from (select a.id,a.kdtrans,b.nm_outlet,a.outlet_id,a.outlet_tujuan,a.supir,a.nopol,a.keterangan,sum(jml * if(pcs='',1,pcs)) as jmlTransfer from tr_transfer_barang a left join master_company b on a.outlet_id=b.outlet_id inner join tr_transfer_barang_detail c on a.kdtrans = c.kdtrans where a.outlet_tujuan = '".$this->session->userdata('outlet_id')."' group by a.kdtrans) as tb1 left join v_terima_barang tb2 on tb1.kdtrans = tb2.no_transfer group by tb1.kdtrans having jmlTransfer != sum(ifnull(jml_terima,0) * ifnull(if(tb2.pcs='0',1,tb2.pcs),1))","id","id,kdtrans,nm_outlet,outlet_id,outlet_tujuan,supir,nopol,keterangan"); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_terima_barang where kdtrans = '".$id."'")->row();
		$data = array(
			'kdtrans' => $id,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'notrans' => $r->no_transfer,
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'tujuan' => $this->m_company->pilihLokasi($r->outlet_tujuan),
			'supir' => $r->supir,
			'nopol' => $r->nopol,
			'keterangan' => $r->keterangan
		);
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$this->load->view('penerimaan_barang/terima_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array(
			'tgl' => $tgl,
			'no_transfer' => $this->input->post('notrans'),
			'outlet_id' => $this->session->userdata('outlet_id'),
			'outlet_tujuan' => $this->input->post('tujuan'),
			'supir' => strtoupper($this->input->post('supir')),
			'nopol' => strtoupper($this->input->post('nopol')),
			'keterangan' => strtoupper($this->input->post('keterangan')),
		);
		
		$this->db->trans_begin();
		if($this->input->post('kdtrans')=="") {
			$kdtrans = $this->msistem->noTrans('TB','tr_terima_barang','',$this->input->post('outlet_id'),$tgl);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_terima_barang', $data);
			$this->msistem->log_book('Input data baru Terima Barang "'.$kdtrans,'pd4',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_terima_barang', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data Terima Barang "'.$kdtrans,'pd4',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'tr_terima_barang_detail';
		$dataIns = array('idbarang','jml_kirim','jml_terima','pcs','harga','hargaBeli','total','','');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		// input report stock
		$table = 'rpt_stock';
		$dataIns = array('idbarang','','qty_transfer_in','pcs_transfer_in','','hrgbeli_transfer_in','jml_transfer_in','outstanding','jml_outstanding');
		$fk = array('notrans' => $kdtrans,'outlet_id' => $this->input->post("tujuan"),'tgl' => $tgl);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "[AUTO]";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("tr_terima_barang",array('kdtrans' => $idrec));
		$this->db->delete("rpt_stock",array('notrans' => $idrec));
		$this->msistem->log_book('Delete data kdtrans "'.$idrec,'pd4',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	/*function notrans() {
		$periode = $this->msistem->periode();
		$arr = explode("-",$periode);
		$bln = $arr[1];
		$thn = $arr[0];
		$kd_unit = $this->session->userdata('outlet_id');
		$r = $this->db->query("select ifnull(max(substring_index(kdtrans,'.',1)) + 1,1) as no from tr_terima_barang where substring_index(tgl,'-',2) = '".$periode."'")->row();
		$jml = $r->no;
		
		if(strlen($jml)==1) {
			$no_urut = '000'.$jml;	
		} else if(strlen($jml)==2) {
			$no_urut = '00'.$jml;
		} else if(strlen($jml)==3) {
			$no_urut = '0'.$jml;	
		} else if(strlen($jml)==4) {
			$no_urut = $jml;	
		}
		$notrans = $no_urut.'.'.$kd_unit.'-TB.'.$bln.substr($thn,-1);
		return $notrans;
	}*/
}
?>
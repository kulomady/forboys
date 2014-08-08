<?php 
class retur_penjualan extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');   
		$this->load->model('m_penjualan');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pj5');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$this->load->view('retur_penjualan/rp_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$notrans="",$gudang="",$sales="",$pelanggan="") {
		$qr = "";
		if($notrans != "0"):
			$qr .= " and a.kdtrans like '%".$notrans."%'";
		endif;
		if($gudang != "0"):
			$qr .= " and a.outlet_id = '".$gudang."'";
		endif;
		if($sales != "0"):
			$qr .= " and c.idsales = '".$sales."'";
		endif;
		if($pelanggan != "0"):
			$qr .= " and c.idrekan = '".$pelanggan."'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.subtotal,a.disc_rp,a.tax_rp,concat(a.pajak_biaya,if(a.pajak_biaya='','','%')) as pajak_biaya,a.biaya_lain,a.grand_total,a.tunai,a.pot_piutang,b.nm_outlet,a.created,a.created_by,d.nmrekan as nmsales,e.nmrekan from tr_retur_penjualan a inner join master_company b on a.outlet_id = b.outlet_id LEFT JOIN tr_penjualan c on a.kdpenjualan = c.kdtrans LEFT JOIN master_rekan_bisnis d on c.idsales = d.idrekan left join master_rekan_bisnis e on c.idrekan = e.idrekan where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr","kdtrans","id,kdtrans,tgl,nm_outlet,nmrekan,nmsales,subtotal,disc_rp,tax_rp,biaya_lain,pajak_biaya,grand_total,tunai,pot_piutang,created_by");
	}
	
	function loadDataBrgDetail($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.qty,a.total,a.disc_1,a.disc_2,a.disc_3,a.disc_4,concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang,b.nmwarna,b.nmsize,b.nmsatuan,'$img' as img,'$img_del' as img_del,a.hrgbeli from tr_retur_penjualan_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","id","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,qty,harga,disc_1,disc_2,disc_3,disc_4,total,img_del,hrgbeli");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pilihPajak'] = $this->m_company->pilihPajak('0');
		$data['txtTaxPersen'] = $this->m_company->pilihPajak('0');
		$this->load->view('retur_penjualan/rp_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_retur_penjualan where kdtrans = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'noTrsJual' => $r->kdpenjualan,
			'txtjml' => $r->jml_qty,
			'txtsubtotal' => $r->subtotal,
			'txtDiscPersen' => $r->disc_persen,
			'txtDiscRupiah' => $r->disc_rp,
			'pilihPajak' => $this->m_company->pilihPajak($r->tax_persen),
			'txtTaxRupiah' => $r->tax_rp,
			'txtTaxPersen' => $this->m_company->pilihPajak($r->pajak_biaya),
			'txtBiayaLain' => $r->biaya_lain,
			'txtTotalAkhir' => $r->grand_total,
			'txtTunai' => $r->tunai,
			'txtPotPiutang' => $r->pot_piutang,
			'keterangan' => $r->keterangan
		);
		$this->load->view('retur_penjualan/rp_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$tglKirim = $this->msistem->conversiTgl($this->input->post("tglKirim"));
		$data = array('tgl' => $tgl);
		$data = $this->msistem->arrayMerge($data,'idrekan',$this->input->post('pelanggan'));
		$data = $this->msistem->arrayMerge($data,'outlet_id',$this->input->post('gudang'));
		$data = $this->msistem->arrayMerge($data,'kdpenjualan',$this->input->post('noTrsJual'));
		$data = $this->msistem->arrayMerge($data,'jml_qty',$this->input->post('txtjml'));
		$data = $this->msistem->arrayMerge($data,'subtotal',$this->input->post('txtsubtotal'));
		$data = $this->msistem->arrayMerge($data,'disc_persen',$this->input->post('txtDiscPersen'));
		$data = $this->msistem->arrayMerge($data,'disc_rp',$this->input->post('txtDiscRupiah'));
		$data = $this->msistem->arrayMerge($data,'tax_persen',$this->input->post('txtTaxPersen'));
		$data = $this->msistem->arrayMerge($data,'tax_rp',$this->input->post('txtTaxRupiah'));
		$data = $this->msistem->arrayMerge($data,'pajak_biaya',$this->input->post('slcPajak'));
		$data = $this->msistem->arrayMerge($data,'biaya_lain',$this->input->post('txtBiayaLain'));
		$data = $this->msistem->arrayMerge($data,'grand_total',$this->input->post('txtTotalAkhir'));
		$data = $this->msistem->arrayMerge($data,'tunai',$this->input->post('txtTunai'));
		$data = $this->msistem->arrayMerge($data,'pot_piutang',$this->input->post('txtpot_piutang'));
		$data = $this->msistem->arrayMerge($data,'keterangan',strtoupper($this->input->post('keterangan')));
		
		$this->db->trans_begin();
			
		if($this->input->post('kdtrans')=="") {
			
			$kdtrans = $this->msistem->noTrans('RP','tr_retur_penjualan','',$this->input->post('gudang'),$tgl);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_retur_penjualan', $data);
			$this->msistem->log_book('Input data baru retur penjualan"'.$kdtrans,'pj5',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_retur_penjualan', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data retur penjualan "'.$kdtrans,'pj5',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'tr_retur_penjualan_detail';
		$dataIns = array('idbarang','qty','harga','disc_1','disc_2','disc_3','disc_4','total','hrgbeli');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		// input RPT Stock
		$table = 'rpt_stock';
		$dataIns = array('idbarang','qty_retur_in','','','','','','jml_retur_in','hrgbeli_retur_in');
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
		$this->db->delete("tr_retur_penjualan",array('kdtrans' => $idrec));
		$this->db->delete("rpt_stock",array('notrans' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pj5',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function loadDataPenjualan($outlet_id="",$field="",$key="",$tglAwal="",$tglAkhir="") {
		$qr = "";
		if($key != "0"):
			$qr = " and $field like '%".$key."%'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.keterangan,a.grand_total,sum(b.qty) as jml_beli,c.nmrekan as sales,d.nmrekan as pelanggan from tr_penjualan a inner join tr_penjualan_detail b on a.kdtrans = b.kdtrans left join master_rekan_bisnis c on a.idsales = c.idrekan left join master_rekan_bisnis d on a.idrekan = d.idrekan where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' and a.outlet_id = '".$outlet_id."' group by kdtrans","id","id,kdtrans,tgl,pelanggan,sales,jml_beli,grand_total");
	}
	
	function brgPenjualan($noTrans="") {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.idbarang,a.qty,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.total,a.hrgbeli,b.nmbarang,b.nmwarna,b.nmsize,b.nmsatuan,b.nmtipe,b.nmjenis,b.nmkategori from tr_penjualan_detail a inner join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$noTrans."'","id","idbarang,nmbarang,nmwarna,nmsize,nmsatuan,qty,harga,disc_1,disc_2,disc_3,disc_4,total,hrgbeli,nmtipe,nmjenis,nmkategori");
	}
}
?>
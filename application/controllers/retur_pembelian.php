<?php 
class retur_pembelian extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');
		$this->load->model('msistem');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pb3');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['supplier'] = $this->m_rekan_bisnis->pilihSupplier('0');
		$this->load->view('retur_pembelian/rb_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$noTrans="",$gudang="",$nolpb="",$supplier="",$ket="") {
		/*$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.kdtrans, a.no_lpb, a.nmrekan, DATE_FORMAT(a.tgl,'%d-%m-%Y') as tgl_retur, a.total_akhir,a.keterangan,a.created,a.created_by,a.modified,a.modified_by from v_retur_brg a","id","id,kdtrans,tgl_retur,no_lpb,nmrekan,total_akhir,keterangan,created,created_by,modified,modified_by"); */
		$qr = "";
		$join = "";
		if($noTrans != "0"):
			$qr .= " and a.kdtrans like '%".$noTrans."%'";
		endif;
		
		if($supplier != "0"):
			$qr .= " and c.idrekan = '".$supplier."'";
		endif;
		
		if($nolpb != "0"):
			$qr .= " and a.no_lpb like '%".$nolpb."%'";
		endif;
		
		if($ket != "0"):
			$qr .= " and a.keterangan like '%".$nolpb."%'";
		endif;
		
		if($gudang != "0") {
			$qr .= " and a.outlet_id = '".$gudang."'";
		} else {
			$join = " inner join sys_hak_outlet e on a.outlet_id = e.outlet_id and group_id = '".$this->session->userdata('group_id')."'";
		}
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.kdtrans, a.no_lpb, b.nm_outlet, DATE_FORMAT(a.tgl,'%d-%m-%Y') as tgl_pembelian, c.nmrekan,a.created,a.created_by,sum(d.qtyBeli) as qty,sum(d.pcs) as pcs,a.sub_total,a.potongan_rupiah,a.pajak_rupiah,a.total_akhir,a.tunai_dp,a.kredit from trans_retur_brg a left join trans_pembelian_brg f on a.no_lpb = f.kdtrans inner join master_company b on a.outlet_id=b.outlet_id left join master_rekan_bisnis c on f.company_id=c.idrekan inner join trans_retur_brg_child d on a.kdtrans = d.kdtrans $join where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr group by a.kdtrans","kdtrans","id,kdtrans,no_lpb,nm_outlet,tgl_pembelian,nmrekan,qty,pcs,sub_total,potongan_rupiah,pajak_rupiah,total_akhir,tunai_dp,kredit,created,created_by");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pilihPajak'] = $this->m_company->pilihPajak('0');
		$data['pilihPajakBarcode'] = $this->m_company->pilihPajak('0');
		$data['qPajak'] = $this->db->query("select nilai,kode_pajak from master_pajak order by nilai");
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['pajak'] = $this->m_company->pilihPajak('0');
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('retur_pembelian/rb_input',$data); 
	}
	
	function frm_search_beli(){
		$this->load->view('retur_pembelian/rb_search_beli'); 
	}
	
	/*function loadDataBeli($kode_beli) {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,b.nmrekan from trans_pembelian_brg a left join master_rekan_bisnis b on a.company_id=b.idrekan where a.kdtrans like '%".$kode_beli."%' and a.flag = '1'","id","kdtrans,nmrekan");
	}*/
	
	function loadChild($no_retur) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="openWinBrg_pb1(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
		
		$cb = new OptionsConnector($this->db->conn_id);
    	$cb->render_table("master_pajak","nilai","nilai(value),kode_pajak(label)");
   	 	$grid->set_options("pajak",$cb); 
		
		$grid->render_sql("select a.id, a.kdtrans, a.idbarang, concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang, b.nmsatuan, a.qtyBeli, a.pcs, a.harga, a.disc, a.discrp, a.pajak, a.jumlah,'$img' as img,'$img_del' as img_del from trans_retur_brg_child a left join v_master_barang_detail b on a.idbarang=b.idbarang where a.kdtrans = '".$no_retur."'","id","idbarang,img,nmbarang,nmsatuan,qtyBeli,pcs,harga,disc,discrp,pajak,jumlah,img_del");
	}
	
	function frm_search_barang($kode_brg){
		$data['kode_brg'] = $kode_brg;
		$this->load->view('retur_pembelian/rb_search_barang',$data); 
	}
	
	function loadDataBarang($kdtrans) {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.kdtrans, a.kd_barang, b.nmbarang, a.satuan, a.qtyBeli, a.pcs, a.harga, a.disc, a.pajak, a.jumlah from trans_pembelian_brg_child a left join v_master_barang_detail b on a.kd_barang=b.idbarang where a.kdtrans = '".$kdtrans."'","id","kd_barang,nmbarang,satuan,qtyBeli,pcs,harga,disc,pajak,jumlah");
	}
	
	function frm_edit($kdtrans="") {
		$r = $this->db->query("select * from v_retur_brg where kdtrans = '".$kdtrans."'")->row();
		$data = array(
			'id' => $r->id,
			'kdtrans' => $r->kdtrans,
			'tglRetur' => $this->msistem->conversiTglDB($r->tgl),
			'no_lpb' => $r->no_lpb,
			'supplier' => $r->nmrekan,
			'sub_total_item' => $r->sub_total_item,
			'sub_total_terima' => $r->sub_total_terima,
			'sub_total' => $r->sub_total,
			'potongan' => $r->potongan_persen,
			'potongan2' => $r->potongan_rupiah,
			'pajak' => $r->pajak_persen,
			'pajak2' => $r->pajak_rupiah,
			'total_akhir' => $r->total_akhir,
			'tunai' => $r->tunai_dp,
			'kredit' => $r->kredit,
			'ket' => $r->keterangan,
			'pilihPajak' => $this->m_company->pilihPajak('0'),
			'pilihPajakBarcode' => $this->m_company->pilihPajak($r->pajak_bk),
			'biaya_kirim' => $r->biaya_kirim,
			'qPajak' => $this->db->query("select nilai,kode_pajak from master_pajak order by nilai")
		);
		$data['gudang'] = $this->m_company->pilihLokasi($r->outlet_id);
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['pajak'] = $this->m_company->pilihPajak('0');
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('retur_pembelian/rb_input',$data); 
	}
	
	function simpan() {
		if($this->input->post('tglRetur') != "") {
			$tgl = $this->msistem->conversiTgl($this->input->post('tglRetur'));
		} else {
			$tgl = "";
		}
		$this->db->trans_begin();
		
		$data = array (
			'tgl' => $tgl,
			'no_lpb' =>$this->input->post('no_lpb'),
			'outlet_id' => $this->input->post('gudang'),
			'sub_total_item' => $this->input->post('sub_total_item'),
			'sub_total_pcs' => $this->input->post('sub_total_terima'),
			'sub_total' => $this->input->post('sub_total'),
			'potongan_persen' => $this->input->post('potongan'),
			'potongan_rupiah' => $this->input->post('potongan2'),
			'pajak_persen' => $this->input->post('pajak'),
			'pajak_rupiah' => $this->input->post('pajak2'),
			'biaya_kirim' => $this->input->post('biaya_kirim'),
			'pajak_bk' => $this->input->post('slcPajak'),
			'total_akhir' => $this->input->post('total_akhir'),
			'tunai_dp' => $this->input->post('tunai'),
			'kredit' => $this->input->post('kredit'),
			'keterangan' => $this->input->post('ket')
		);
		if($this->input->post('id')=="") {
			$no_retur = $this->msistem->noTrans('RB','trans_retur_brg','',$this->input->post('gudang'),$tgl);
			$dataIns = array (
				'kdtrans' => $no_retur,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('trans_retur_brg', $data);
			$this->msistem->log_book('Input data baru Retur Brg "'.$no_retur,'pb3',$this->session->userdata('sis_user'));
		} else {
			$no_retur = $this->input->post('no_retur');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('trans_retur_brg', $data,array('kdtrans' => $no_retur));
			$this->msistem->log_book('Edit data Retur Brg "'.$no_retur,'pb3',$this->session->userdata('sis_user'));
		}
		
		// input dataBeli
		$dataRetur = $this->input->post('dataRetur');
		$table = 'trans_retur_brg_child';
		$dataIns = array('idbarang','qtyBeli','pcs','harga','disc','discrp','pajak','jumlah');
		$fk = array('kdtrans' => $no_retur);
		$this->msistem->insertDB($dataRetur,$table,$dataIns,$fk);
		
		$table = 'rpt_stock';
		$dataIns = array('idbarang','qty_retur_out','pcs_retur_out','','','','','jml_retur_out');
		$fk = array('notrans' => $no_retur,'outlet_id' => $this->input->post('gudang'),'tgl' => $tgl);
		$this->msistem->insertDB($dataRetur,$table,$dataIns,$fk);
		
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
            echo $no_retur;
        }
	}
	
	function hapus() {
		$no_retur = $this->input->post('idrec');
		
		$this->db->trans_begin();
		$this->db->delete("trans_retur_brg",array('kdtrans' => $no_retur));
		$this->db->delete("rpt_stock",array('notrans' => $no_retur));
		$this->msistem->log_book('Delete data No Transaksi "'.$no_retur,'pb3',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function loadDataBeli($outlet_id="",$field="",$kunci="",$tglAwal="",$tglAkhir="") {
		$qr = "";
		if($kunci != "0"):
			$qr = " and $field like '%".$kunci."%'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.company_id,a.kdtrans,a.tgl,a.no_po,a.keterangan,a.total_akhir,a.tunai_dp,sum(b.qtyBeli) as jml_beli,c.nmrekan as supplier,a.pajak_persen from trans_pembelian_brg a inner join trans_pembelian_brg_child b on a.kdtrans = b.kdtrans left join master_rekan_bisnis c on a.company_id = c.idrekan where a.outlet_id = '".$outlet_id."' and a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr group by kdtrans","id","id,kdtrans,tgl,company_id,supplier,No.PO,jml_beli,total_akhir,tunai_dp,pajak_persen");
	}
	
	function brgPembelian($notrans="") {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.idbarang,b.nmbarang,b.nmwarna,b.nmsize,b.nmsatuan,a.qtyBeli,a.pcs,a.harga,a.disc,a.discrp,a.pajak,'0' as ksg,a.jumlah,b.harga_beli,b.nmtipe,b.nmjenis,b.nmkategori from trans_pembelian_brg_child a inner join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$notrans."'","id","idbarang,nmbarang,nmwarna,nmsize,nmsatuan,qtyBeli,harga,disc,pajak,pcs,ksg,jumlah,harga_beli,nmtipe,nmjenis,nmkategori,ksg,discrp,pajak");
	}
}
?>
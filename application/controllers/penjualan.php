<?php 
class penjualan extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');   
		$this->load->model('m_penjualan'); 
		$this->load->model('m_produksi');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pj4');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelangganCMT('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$this->load->view('penjualan/pj_index',$data);
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
			$qr .= " and a.idsales = '".$sales."'";
		endif;
		if($pelanggan != "0"):
			$qr .= " and a.idrekan = '".$pelanggan."'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.outlet_id,a.idrekan,a.idsales,a.subtotal,a.disc_rp,a.tax_rp,a.pajak_biaya,a.biaya_lain,a.grand_total,a.dp,a.kurang,a.dp_so,b.nm_outlet,c.nmrekan,d.nmrekan as nmsales,a.created,a.created_by from tr_penjualan a inner join master_company b on a.outlet_id = b.outlet_id left join master_rekan_bisnis c on a.idrekan = c.idrekan left join master_rekan_bisnis d on a.idsales = d.idrekan where jnstransaksi = 'NONKASIR' and a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr","kdtrans","id,kdtrans,tgl,nm_outlet,nmrekan,nmsales,subtotal,disc_rp,tax_rp,biaya_lain,pajak_biaya,grand_total,dp_so,dp,kurang,created_by");
	}
	
	function loadDataBrgDetail($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.qty,a.total,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.hrgbeli,concat(b.nmbarang,' ',ifnull(b.nmwarna,''),' ',ifnull(b.nmsize,'')) as nmbarang,b.nmsatuan,'$img' as img,'$img_del' as img_del from tr_penjualan_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","id","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,qty,harga,disc_1,disc_2,disc_3,disc_4,total,img_del,hrgbeli");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelangganCMT('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$data['pilihPajak'] = $this->m_company->pilihPajak('0');
		$data['txtTaxPersen'] = $this->m_company->pilihPajak('0'); 
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$this->load->view('penjualan/pj_input',$data); 
	}
	
	function frm_edit($kdtrans="") {
		$r = $this->db->query("select * from tr_penjualan where kdtrans = '".$kdtrans."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'pelanggan' => $this->m_rekan_bisnis->pilihPelangganCMT($r->idrekan),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'txtjml' => $r->jml_qty,
			'txtsubtotal' => $r->subtotal,
			'txtDiscPersen' => $r->disc_persen,
			'txtDiscRupiah' => $r->disc_rp,
			'txtTaxPersen' => $this->m_company->pilihPajak($r->tax_persen),
			'txtTaxRupiah' => $r->tax_rp,
			'pilihPajak' => $this->m_company->pilihPajak($r->pajak_biaya),
			'txtBiayaLain' => $r->biaya_lain,
			'txtTotalAkhir' => $r->grand_total,
			'txtDpSO' => $r->dp_so,
			'txtDp' => $r->dp,
			'txtKurang' => $r->kurang,
			'noPesanan' => $r->kdpesanan,			
			'sales' => $this->m_rekan_bisnis->pilihKaryawan($r->idsales),
			'keterangan' => $r->keterangan
		);
		$data['pilihPO'] = $this->m_produksi->pilihPO($r->idjo);
		$this->load->view('penjualan/pj_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$tglKirim = $this->msistem->conversiTgl($this->input->post("tglKirim"));
		$data = array('tgl' => $tgl);
		$data = $this->msistem->arrayMerge($data,'idrekan',$this->input->post('pelanggan'));
		$data = $this->msistem->arrayMerge($data,'outlet_id',$this->input->post('gudang'));
		$data = $this->msistem->arrayMerge($data,'kdpesanan',$this->input->post('noPesanan'));
		$data = $this->msistem->arrayMerge($data,'idjo',$this->input->post('nopo'));
		$data = $this->msistem->arrayMerge($data,'jml_qty',$this->input->post('txtjml'));
		$data = $this->msistem->arrayMerge($data,'subtotal',$this->input->post('txtsubtotal'));
		$data = $this->msistem->arrayMerge($data,'disc_persen',$this->input->post('txtDiscPersen'));
		$data = $this->msistem->arrayMerge($data,'disc_rp',$this->input->post('txtDiscRupiah'));
		$data = $this->msistem->arrayMerge($data,'tax_persen',$this->input->post('txtTaxPersen'));
		$data = $this->msistem->arrayMerge($data,'tax_rp',$this->input->post('txtTaxRupiah'));
		$data = $this->msistem->arrayMerge($data,'pajak_biaya',$this->input->post('slcPajak'));
		$data = $this->msistem->arrayMerge($data,'biaya_lain',$this->input->post('txtBiayaLain'));
		$data = $this->msistem->arrayMerge($data,'grand_total',$this->input->post('txtTotalAkhir'));
		$data = $this->msistem->arrayMerge($data,'dp_so',$this->input->post('txtDpSO'));
		$data = $this->msistem->arrayMerge($data,'dp',$this->input->post('txtDp'));
		$data = $this->msistem->arrayMerge($data,'kurang',$this->input->post('txtKurang'));
		$data = $this->msistem->arrayMerge($data,'idsales',$this->input->post('sales'));
		$data = $this->msistem->arrayMerge($data,'keterangan',strtoupper($this->input->post('keterangan')));
		
		$this->db->trans_begin();
			
		if($this->input->post('kdtrans')=="") {
			
			$kdtrans = $this->msistem->noTrans('PL','tr_penjualan','and jnstransaksi = "NONKASIR"',$this->input->post('gudang'),$tgl);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'jnstransaksi' => 'NONKASIR',
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_penjualan', $data);
			$this->msistem->log_book('Input data baru penjualan langsung"'.$kdtrans,'pj4',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_penjualan', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data penjualan langsung "'.$kdtrans,'pj4',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'tr_penjualan_detail';
		$dataIns = array('idbarang','qty','harga','disc_1','disc_2','disc_3','disc_4','total','hrgbeli');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		// input report stock
		$table = 'rpt_stock';
		$dataIns = array('idbarang','qty_jual_out','','','','','','jml_jual_out','hrgbeli_jual_out');
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
		$this->db->delete("tr_penjualan",array('kdtrans' => $idrec));
		$this->db->delete("rpt_stock",array('notrans' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pj4',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function loadDataPesanan($outlet_id="",$field="",$kunci="") {
		$qr = "";
		if($kunci != "0"):
			$qr = " and $field like '%".$kunci."%'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.tgl_kirim,a.keterangan,a.grand_total,a.dp,sum(b.qty) as jml_pesanan,c.nmrekan as sales,d.nmrekan as pelanggan from tr_pesanan_penjualan a inner join tr_pesanan_penjualan_detail b on a.kdtrans = b.kdtrans left join master_rekan_bisnis c on a.idsales = c.idrekan left join master_rekan_bisnis d on a.idrekan = d.idrekan where a.outlet_id = '".$outlet_id."' $qr group by kdtrans","id","id,kdtrans,tgl,pelanggan,sales,tgl_kirim,jml_pesanan,grand_total,dp");
	}
	
	function brgPesanan($noPesanan="") {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.idbarang,a.qty,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.total,b.harga_beli,b.nmbarang,b.nmwarna,b.nmsize,b.nmsatuan,b.nmtipe,b.nmjenis,b.nmkategori from tr_pesanan_penjualan_detail a inner join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$noPesanan."'","id","idbarang,nmbarang,nmwarna,nmsize,nmsatuan,qty,harga,disc_1,disc_2,disc_3,disc_4,total,harga_beli,nmtipe,nmjenis,nmkategori");
	}
	
	function cetak_invoice($kode=""){
		//setting pdf
		//require_once APPPATH.'3rdparty/tcpdf/config/lang/eng'.EXT;
		//sql
		$sql = $this->db->query("SELECT
			a.id,
			a.kdtrans,
			a.kdpesanan,
			a.tgl,
			a.jml_qty,
			a.subtotal,
			a.disc_rp,
			a.tax_rp,
			a.biaya_lain,
			a.grand_total,
			a.dp_so,
			a.dp,
			a.kurang,
			a.keterangan,
			b.nmrekan,
			b.telp_1,
			b.telp_2,
			b.fax,
			c.alamat as alamat_plg,
			g.city_name as city_name_plg,
			d.jml_hari,
			e.nm_outlet,
			e.alamat,
			e.tlp,
			e.fax as fax_company,
			f.city_name
			FROM
			tr_penjualan a
			LEFT JOIN master_rekan_bisnis b ON a.idrekan = b.idrekan
			LEFT JOIN master_alamat_rekan c ON c.idrekan = b.idrekan and c.idjnsalamat = '1'
			LEFT JOIN sys_termin_pembayaran d ON b.idtermin = d.idtermin
			LEFT JOIN master_company e ON a.outlet_id = e.outlet_id 
			LEFT JOIN master_city f on f.city_code = e.city_code
			LEFT JOIN master_city g on g.city_code = c.city_code
			WHERE a.kdtrans = '".$kode."'")->row(); 
		
		// Data Kantor Pusat
		$qPst = $this->db->query("select a.nm_outlet,a.alamat,a.alamat_tambahan,a.tlp,a.fax,b.city_name from master_company a left join master_city b on a.city_code = b.city_code where a.type = 'PUSAT'")->row();
			
		$this->load->library('header/header_invoice');
		
		// create new PDF document
		$pdf = new header_invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Wawan Kurniawan');
		$pdf->SetTitle('Pesanan Pembelian');
		$pdf->SetSubject('Pesanan Pembelian');
		$pdf->SetKeywords('Pesanan Pembelian, sis');
		 
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		$pdf->kode($kode);
		$pdf->nmrekan($sql->nmrekan);
		$pdf->nm_outlet($sql->nm_outlet);
		$pdf->alamat_supl($sql->alamat_plg);
		$pdf->alamat($sql->alamat);
		$pdf->city_name_supl($sql->city_name_plg);
		$pdf->city_name($sql->city_name);
		$pdf->telp_1($sql->telp_1);
		$pdf->fax($sql->fax);
		$pdf->tlp($sql->tlp);
		$pdf->fax_company($sql->fax_company);
		$pdf->jml_hari($sql->jml_hari);
		$pdf->tgl($this->msistem->conversiTglDB($sql->tgl));
		$pdf->keterangan($sql->keterangan);
		$pdf->noPesanan($sql->kdpesanan);
		
		$pdf->kantorPst($qPst->nm_outlet);
		$pdf->alamatPst($qPst->alamat);
		$pdf->alamatTambahanPst($qPst->alamat_tambahan);
		$pdf->cityPst($qPst->city_name);
		$pdf->tlpPst($qPst->tlp);
		$pdf->faxPst($qPst->fax);
		
		//set margins
		$pdf->SetMargins(14,79,10);
		$pdf->SetHeaderMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		 
		// set font
		$pdf->SetFont('times', '', 9);
		 
		// add a page
		$pdf->AddPage();
		 
		

$report = '<table width="702" border="0">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>';
// Detail Barang
$idbarang = "";
$nmbarang = "";
$size = "";
$qtyPesan = "";
$harga = "";
$disc = "";
$pajak = "";
$jumlah = "";
$gambar = "";
$Tqty = 0;
$sqlDetail = $this->db->query("select a.idbarang,concat(b.nmbarang,' ',b.nmwarna) as nmbarang,b.nmsize,a.qty,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.total from tr_penjualan_detail a left join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kode."'");
foreach($sqlDetail->result() as $rs) {

	$br = "<br />";	
	$hrg = $rs->harga;
	if($rs->disc_1 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_1/100);
	endif;
	if($rs->disc_2 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_2/100);
	endif;
	if($rs->disc_3 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_3/100);
	endif;
	if($rs->disc_4 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_4/100);
	endif;
	$idbarang .= '&nbsp;'.$rs->idbarang.$br;
	$nmbarang .= '&nbsp;'.$rs->nmbarang.$br;
	$size .= '&nbsp;'.$rs->nmsize.$br;
	$qtyPesan .= '&nbsp;'.$rs->qty."&nbsp;&nbsp;".$br;
	$harga .= '&nbsp;'.$this->msistem->format_uang($hrg)."&nbsp;&nbsp;".$br;
	$jumlah .= $this->msistem->format_uang($rs->total)."&nbsp;&nbsp;".$br;
	
	$Tqty = $Tqty + $rs->qty;
	
}
$report .= '<table width="701" border="1">
  <tr>
    <td width="80" height="400">'.$idbarang.'</td>
    <td width="340">'.$nmbarang.'</td>
    <td width="40">'.$size.'</td>
    <td width="40" align="right">'.$qtyPesan.'</td>
    <td width="70" align="right">'.$harga.'</td>
    <td width="80" align="right">'.$jumlah.'</td>
  </tr>
  <tr>
   <td colspan="3">&nbsp;JUMLAH</td>
    <td align="right">'.$Tqty.'&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr></table>';
  $report .= '
  <table width="701" border="0">
  <tr>
    <td width="570" align="right">SUB TOTAL&nbsp;&nbsp;:</td>
    <td align="right" width="80">'.$this->msistem->format_uang($sql->subtotal).'&nbsp;</td>
  </tr>
   <tr>
    <td align="right">POTONGAN&nbsp;&nbsp;:</td>
    <td align="right">'.$this->msistem->format_uang($sql->disc_rp).'&nbsp;</td>
  </tr>
   <tr>
    <td align="right">PAJAK&nbsp;&nbsp;:</td>
    <td align="right">'.$this->msistem->format_uang($sql->tax_rp).'&nbsp;</td>
  </tr>
   <tr>
    <td align="right">BIAYA LAIN&nbsp;&nbsp;:</td>
    <td align="right">'.$this->msistem->format_uang($sql->biaya_lain).'&nbsp;</td>
  </tr>
   <tr>
    <td align="right"></td>
    <td align="right"></td>
  </tr>
   <tr>
    <td align="right">TOTAL AKHIR&nbsp;&nbsp;:</td>
    <td align="right">'.$this->msistem->format_uang($sql->grand_total).'&nbsp;</td>
  </tr>
  <tr>
    <td align="right">DP PESAN&nbsp;&nbsp;:</td>
    <td align="right">'.$this->msistem->format_uang($sql->dp_so).'&nbsp;</td>
  </tr>
  <tr>
    <td align="right">BAYAR&nbsp;&nbsp;:</td>
    <td align="right">'.$this->msistem->format_uang($sql->dp).'&nbsp;</td>
  </tr>
  <tr>
    <td align="right">KURANG&nbsp;&nbsp;:</td>
    <td align="right">'.$this->msistem->format_uang($sql->kurang).'&nbsp;</td>
  </tr>
</table>';
$report .= '<table width="200" border="0">
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Dibuat Oleh,</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">('.$this->session->userdata('namauser').')</td>
  </tr>
</table>';
 
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('invoice_'.$kode.'.pdf', 'I');	
	}
	
	function cetak_sj($kode=""){
		
		//setting pdf
		//require_once APPPATH.'3rdparty/tcpdf/config/lang/eng'.EXT;
		//sql
		$sql = $this->db->query("SELECT
			a.id,
			a.kdtrans,
			a.kdpesanan,
			a.tgl,
			a.jml_qty,
			a.subtotal,
			a.disc_rp,
			a.tax_rp,
			a.biaya_lain,
			a.grand_total,
			a.dp_so,
			a.dp,
			a.kurang,
			a.keterangan,
			b.nmrekan,
			b.telp_1,
			b.telp_2,
			b.fax,
			c.alamat as alamat_plg,
			g.city_name as city_name_plg,
			d.jml_hari,
			e.nm_outlet,
			e.alamat,
			e.tlp,
			e.fax as fax_company,
			f.city_name
			FROM
			tr_penjualan a
			LEFT JOIN master_rekan_bisnis b ON a.idrekan = b.idrekan
			LEFT JOIN master_alamat_rekan c ON c.idrekan = b.idrekan and c.idjnsalamat = '1'
			LEFT JOIN sys_termin_pembayaran d ON b.idtermin = d.idtermin
			LEFT JOIN master_company e ON a.outlet_id = e.outlet_id 
			LEFT JOIN master_city f on f.city_code = e.city_code
			LEFT JOIN master_city g on g.city_code = c.city_code
			WHERE a.kdtrans = '".$kode."'")->row(); 
		
		// Data Kantor Pusat
		$qPst = $this->db->query("select a.nm_outlet,a.alamat,a.alamat_tambahan,a.tlp,a.fax,b.city_name from master_company a left join master_city b on a.city_code = b.city_code where a.type = 'PUSAT'")->row();
			
		$this->load->library('header/header_sj');
		
		// create new PDF document
		$pdf = new header_sj(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Wawan Kurniawan');
		$pdf->SetTitle('Pesanan Pembelian');
		$pdf->SetSubject('Pesanan Pembelian');
		$pdf->SetKeywords('Pesanan Pembelian, sis');
		 
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		$pdf->kode($kode);
		$pdf->nmrekan($sql->nmrekan);
		$pdf->nm_outlet($sql->nm_outlet);
		$pdf->alamat_supl($sql->alamat_plg);
		$pdf->alamat($sql->alamat);
		$pdf->city_name_supl($sql->city_name_plg);
		$pdf->city_name($sql->city_name);
		$pdf->telp_1($sql->telp_1);
		$pdf->fax($sql->fax);
		$pdf->tlp($sql->tlp);
		$pdf->fax_company($sql->fax_company);
		$pdf->jml_hari($sql->jml_hari);
		$pdf->tgl($this->msistem->conversiTglDB($sql->tgl));
		$pdf->keterangan($sql->keterangan);
		$pdf->noPesanan($sql->kdpesanan);
		
		$pdf->kantorPst($qPst->nm_outlet);
		$pdf->alamatPst($qPst->alamat);
		$pdf->alamatTambahanPst($qPst->alamat_tambahan);
		$pdf->cityPst($qPst->city_name);
		$pdf->tlpPst($qPst->tlp);
		$pdf->faxPst($qPst->fax);
		
		//set margins
		$pdf->SetMargins(14,71,10);
		$pdf->SetHeaderMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		 
		// set font
		$pdf->SetFont('times', '', 9);
		 
		// add a page
		$pdf->AddPage();
		 
		

$report = '<table width="702" border="0">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>';
// Detail Barang
$idbarang = "";
$nmbarang = "";
$size = "";
$qtyPesan = "";
$harga = "";
$disc = "";
$pajak = "";
$jumlah = "";
$gambar = "";
$Tqty = 0;
$sqlDetail = $this->db->query("select a.idbarang,concat(b.nmbarang,' ',b.nmwarna) as nmbarang,b.nmsize,a.qty,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.total from tr_penjualan_detail a left join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kode."'");
foreach($sqlDetail->result() as $rs) {

	$br = "<br />";	
	$hrg = $rs->harga;
	if($rs->disc_1 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_1/100);
	endif;
	if($rs->disc_2 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_2/100);
	endif;
	if($rs->disc_3 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_3/100);
	endif;
	if($rs->disc_4 != ""):
		$hrg = $hrg - ($hrg * $rs->disc_4/100);
	endif;
	$idbarang .= '&nbsp;'.$rs->idbarang.$br;
	$nmbarang .= '&nbsp;'.$rs->nmbarang.$br;
	$size .= '&nbsp;'.$rs->nmsize.$br;
	$qtyPesan .= '&nbsp;'.$rs->qty."&nbsp;&nbsp;".$br;
	$harga .= '&nbsp;'.$this->msistem->format_uang($hrg)."&nbsp;&nbsp;".$br;
	$jumlah .= $this->msistem->format_uang($rs->total)."&nbsp;&nbsp;".$br;
	
	$Tqty = $Tqty + $rs->qty;
	
}
$report .= '<table width="701" border="1">
  <tr>
    <td width="150" height="500">'.$idbarang.'</td>
    <td width="420">'.$nmbarang.'</td>
    <td width="40">'.$size.'</td>
    <td width="40" align="right">'.$qtyPesan.'</td>
  </tr>
  <tr>
   <td colspan="3">&nbsp;JUMLAH</td>
    <td align="right">'.$Tqty.'&nbsp;</td>
  </tr></table>';
  
$report .= '<br /><br /><table width="725" border="0">
  <tr>
    <td width="260"><div align="left">Tanda Terima</div></td>
    <td width="122"><div align="left">Sopir</div></td>
    <td width="172"><div align="left">Manager</div></td>
    <td width="143"><div align="left">Bag. Packing</div></td>
  </tr>
  <tr>
    <td height="111"><div align="left"></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left">(.........................)</td>
    <td align="left">(.........................)</td>
    <td align="left">(.........................)</td>
    <td align="left">(.........................)</td>
  </tr>
</table>';
 
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('invoice_'.$kode.'.pdf', 'I');	
	}
}
?>
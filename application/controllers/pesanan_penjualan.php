<?php 
class pesanan_penjualan extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');   
		$this->load->model('m_penjualan');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pj3');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$this->load->view('pesanan_penjualan/pp_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$noTrans="",$pelanggan="",$outlet="",$sales="",$tglKirim1="",$tglKirim2="") {
		$qr = "";
		if($noTrans != "0"):
			$qr .= " and a.kdtrans like '%".$noTrans."%'";
		endif;
		if($pelanggan != "0"):
			$qr .= " and a.idrekan = '".$pelanggan."'";
		endif;
		if($sales != "0"):
			$qr .= " and a.idsales = '".$sales."'";
		endif;
		if($outlet != "0"):
			$qr .= " and a.outlet_id = '".$outlet."'";
		endif;
		if($tglKirim1 != "0"):
			$qr .= " and a.tgl_kirim >= '".$tglKirim1."'";
		endif;
		if($tglKirim2 != "0"):
			$qr .= " and a.tgl_kirim <= '".$tglKirim2."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.outlet_id,a.idrekan,a.idsales,a.subtotal,a.disc_rp,a.tax_rp,a.sts_biaya,a.biaya_lain,a.grand_total,a.dp,a.kurang,a.tgl_kirim,b.nm_outlet,c.nmrekan,d.nmrekan as nmsales,a.created,a.created_by from tr_pesanan_penjualan a inner join master_company b on a.outlet_id = b.outlet_id left join master_rekan_bisnis c on a.idrekan = c.idrekan left join master_rekan_bisnis d on a.idsales = d.idrekan where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr","kdtrans","id,kdtrans,tgl,nm_outlet,nmrekan,nmsales,tgl_kirim,subtotal,disc_rp,tax_rp,sts_biaya,biaya_lain,grand_total,dp,kurang,created_by");
	}
	
	function loadDataBrgDetail($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.qty,a.total,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.hrgbeli,concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang,b.nmwarna,b.nmsatuan,b.nmsize,'$img' as img,'$img_del' as img_del from tr_pesanan_penjualan_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","idbarang","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,qty,harga,disc_1,disc_2,disc_3,disc_4,total,img_del,hrgbeli");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		
		$this->load->view('pesanan_penjualan/pp_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_pesanan_penjualan where id = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'pelanggan' => $this->m_rekan_bisnis->pilihPelanggan($r->idrekan),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'txtjml' => $r->jml_qty,
			'txtsubtotal' => $r->subtotal,
			'txtDiscPersen' => $r->disc_persen,
			'txtDiscRupiah' => $r->disc_rp,
			'txtTaxPersen' => $r->tax_persen,
			'txtTaxRupiah' => $r->tax_rp,
			'slcBiaya' => $r->sts_biaya,
			'txtBiayaLain' => $r->biaya_lain,
			'txtTotalAkhir' => $r->grand_total,
			'txtDp' => $r->dp,
			'txtKurang' => $r->kurang,
			'tglKirim' => $this->msistem->conversiTglDB($r->tgl_kirim),			
			'sales' => $this->m_rekan_bisnis->pilihKaryawan($r->idsales),
			'keterangan' => $r->keterangan
		);
		$this->load->view('pesanan_penjualan/pp_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$tglKirim = $this->msistem->conversiTgl($this->input->post("tglKirim"));
		$data = array('tgl' => $tgl);
		$data = $this->msistem->arrayMerge($data,'idrekan',$this->input->post('pelanggan'));
		$data = $this->msistem->arrayMerge($data,'outlet_id',$this->input->post('gudang'));
		$data = $this->msistem->arrayMerge($data,'jml_qty',$this->input->post('txtjml'));
		$data = $this->msistem->arrayMerge($data,'subtotal',$this->input->post('txtsubtotal'));
		$data = $this->msistem->arrayMerge($data,'disc_persen',$this->input->post('txtDiscPersen'));
		$data = $this->msistem->arrayMerge($data,'disc_rp',$this->input->post('txtDiscRupiah'));
		$data = $this->msistem->arrayMerge($data,'tax_persen',$this->input->post('txtTaxPersen'));
		$data = $this->msistem->arrayMerge($data,'tax_rp',$this->input->post('txtTaxRupiah'));
		$data = $this->msistem->arrayMerge($data,'sts_biaya',$this->input->post('slcBiaya'));
		$data = $this->msistem->arrayMerge($data,'biaya_lain',$this->input->post('txtBiayaLain'));
		$data = $this->msistem->arrayMerge($data,'grand_total',$this->input->post('txtTotalAkhir'));
		$data = $this->msistem->arrayMerge($data,'dp',$this->input->post('txtDp'));
		$data = $this->msistem->arrayMerge($data,'kurang',$this->input->post('txtKurang'));
		$data = $this->msistem->arrayMerge($data,'tgl_kirim',$tglKirim);
		$data = $this->msistem->arrayMerge($data,'idsales',$this->input->post('sales'));
		$data = $this->msistem->arrayMerge($data,'keterangan',strtoupper($this->input->post('keterangan')));
		
		$this->db->trans_begin();
			
		if($this->input->post('kdtrans')=="") {
			
			$kdtrans = $this->msistem->noTrans('PP','tr_pesanan_penjualan','',$this->input->post('gudang'),$tgl);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_pesanan_penjualan', $data);
			$this->msistem->log_book('Input data baru pesanan penjualan "'.$kdtrans,'pj3',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_pesanan_penjualan', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data pesanan Penjualan "'.$kdtrans,'pj3',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'tr_pesanan_penjualan_detail';
		$dataIns = array('idbarang','qty','harga','disc_1','disc_2','disc_3','disc_4','total','hrgbeli');
		$fk = array('kdtrans' => $kdtrans);
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
		$this->db->delete("tr_pesanan_penjualan",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pj3',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function loadDaftarTunda($outlet_id="") {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kdtrans,tgl,ket_tunda,idrekan,jml_qty,subtotal,disc_persen,disc_rp,tax_persen,tax_rp,sts_biaya,biaya_lain,grand_total from tr_penjualan where ststunda = '1'","id","id,kdtrans,tgl,ket_tunda,idrekan,jml_qty,subtotal,disc_persen,disc_rp,tax_persen,tax_rp,sts_biaya,biaya_lain,grand_total");
	}
	
	function cetak_pesanan($kode=""){
		//$kode = '0001.P1010-PP.0614';
		//setting pdf
		//require_once APPPATH.'3rdparty/tcpdf/config/lang/eng'.EXT;
		//sql
		$sql = $this->db->query("SELECT
			a.id,
			a.kdtrans,
			a.tgl,
			a.tgl_kirim,
			a.jml_qty,
			a.subtotal,
			a.disc_rp,
			a.tax_rp,
			a.biaya_lain,
			a.grand_total,
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
			tr_pesanan_penjualan a
			LEFT JOIN master_rekan_bisnis b ON a.idrekan = b.idrekan
			LEFT JOIN master_alamat_rekan c ON c.idrekan = b.idrekan and c.idjnsalamat = '1'
			LEFT JOIN sys_termin_pembayaran d ON b.idtermin = d.idtermin
			LEFT JOIN master_company e ON a.outlet_id = e.outlet_id 
			LEFT JOIN master_city f on f.city_code = e.city_code
			LEFT JOIN master_city g on g.city_code = c.city_code
			WHERE a.kdtrans = '".$kode."'")->row(); 
		
		// Data Kantor Pusat
		$qPst = $this->db->query("select a.nm_outlet,a.alamat,a.alamat_tambahan,a.tlp,a.fax,b.city_name from master_company a left join master_city b on a.city_code = b.city_code where a.type = 'PUSAT'")->row();
			
		$this->load->library('header/header_pesanan_jual');
		
		// create new PDF document
		$pdf = new header_pesanan_jual(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
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
$sqlDetail = $this->db->query("select a.idbarang,concat(b.nmbarang,' ',b.nmwarna) as nmbarang,b.nmsize,b.file_gambar,a.qty,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.total from tr_pesanan_penjualan_detail a left join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kode."'");
foreach($sqlDetail->result() as $rs) {
	if($rs->file_gambar == "") {
		$br = "<br />";
		$gambar .= "<br />";
	} else {
		$br = "<br /><br /><br /><br />";
		$gambar .= '<img src="gambar/'.$rs->file_gambar.'" width="100" height="40" style="padding-top:5px;" /><br /><br />';
	}
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
    <td width="140" height="400" align="center">'.$gambar.'</td>
    <td width="80">'.$idbarang.'</td>
    <td width="200">'.$nmbarang.'</td>
    <td width="40">'.$size.'</td>
    <td width="40" align="right">'.$qtyPesan.'</td>
    <td width="70" align="right">'.$harga.'</td>
    <td width="80" align="right">'.$jumlah.'</td>
  </tr>
  <tr>
   <td colspan="4">&nbsp;JUMLAH</td>
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
    <td align="right">TITIP / DP&nbsp;&nbsp;:</td>
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
		$pdf->Output('quote_'.$kode.'.pdf', 'I');	
	}
}
?>
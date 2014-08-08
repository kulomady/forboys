<?php 
class pesanan_pembelian extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company'); 
		$this->load->model('m_rekan_bisnis');
		$this->load->model('m_perkiraan');
		$this->load->model('m_penjualan');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pb4');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['supplier'] = $this->m_rekan_bisnis->pilihSupplier('0');
		$this->load->view('pesanan_pembelian/pp_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$noTrans="",$supplier="",$gudang="") {
		$qr = "";
		$join = "";
		if($noTrans != "0"):
			$qr .= " and a.kdtrans like '%".$noTrans."%'";
		endif;
		if($supplier != "0"):
			$qr .= " and c.idrekan = '".$supplier."'";
		endif;
		if($gudang != "0") {
			$qr .= " and a.outlet_id = '".$gudang."'";
		} else {
			$join = " inner join sys_hak_outlet e on a.outlet_id = e.outlet_id and group_id = '".$this->session->userdata('group_id')."'";
		}
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.sub_total_item,a.sub_total,a.potongan_rupiah,a.pajak_rupiah,a.total_akhir,a.tunai_dp,a.kredit,b.nm_outlet, DATE_FORMAT(a.tgl,'%d-%m-%Y') as tgl_pesanan, c.nmrekan,a.created,a.created_by,sum(d.qtyBeli) as qtyTerima from trans_pesenan_beli a left join master_company b on a.outlet_id=b.outlet_id left join master_rekan_bisnis c on a.company_id=c.idrekan left join v_pembelian_brg d on a.kdtrans = d.no_po $join where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr group by a.kdtrans","kdtrans","id,kdtrans,nm_outlet,tgl_pesanan,nmrekan,sub_total_item,qtyTerima,sub_total,potongan_rupiah,pajak_rupiah,total_akhir,tunai_dp,kredit,created_by,created");
	}
	
	function loadDataSupplier() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '2'","id","idrekan,nmrekan");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi(0);
		$data['bln_tempo'] = $this->msistem->bulan();
		$data['thn_tempo'] = $this->msistem->tahun();
		$data['pilihPajak'] = $this->m_company->pilihPajak('0');
		$data['pilihPajakBarcode'] = $this->m_company->pilihPajak('0');
		$data['pajak'] = $this->m_company->pilihPajak('0');
		$data['qPajak'] = $this->db->query("select nilai,kode_pajak from master_pajak order by nilai");
		$data['periodeAwal'] = $this->session->userdata('periodeAwal');
		$data['top'] = $this->m_penjualan->pilihTOP('0');
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('pesanan_pembelian/pp_input',$data); 
	}
	
	function frm_search_supplier(){
		$this->load->view('pesanan_pembelian/pp_search_supplier'); 
	}
	
	function cariBarang(){
		$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.idsatuan,b.nilai from v_master_barang_detail a left join master_pajak b on a.idpajak=b.kode_pajak where a.idbarang = '".$this->input->post('kodeBarang')."' and a.is_active = '1'");
		if($sql->num_rows()==1){
			$sql = $sql->row();
			if($sql->nilai==NULL){
				$nilai = 0;
			} else {
				$nilai = $sql->nilai;
			}
			$hasil = $sql->idbarang.'|'.$sql->nmbarang.'|'.$sql->idsatuan.'|'.$nilai;			
		} else {
			$hasil = 0;
		}
		echo $hasil;
	}
	
	function detailBarang(){
		$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.idsatuan,b.nilai from v_master_barang_detail a left join master_pajak b on a.idpajak=b.kode_pajak where a.idbarang = '".$this->input->post('kodeBarang')."' and a.is_active = '1'")->row();
		echo $sql->idbarang.'|'.$sql->nmbarang.'|'.$sql->idsatuan.'|'.$sql->nilai;
	}
	
	function frm_search_barang($kode_brg){
		$data['kode_brg'] = $kode_brg;
		$this->load->view('pesanan_pembelian/pp_search_barang',$data); 
	}
	
	function loadDataBarang($kode_brg) {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.idbarang,a.nmbarang,a.idsatuan,b.nilai from v_master_barang_detail a left join master_pajak b on a.idpajak=b.kode_pajak where a.idbarang like '%".$kode_brg."%' and a.is_active = '1'","id","idbarang,nmbarang,idsatuan,nilai");
	}
	
	function loadChild($kdtrans) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail();" />';
		$grid = new GridConnector($this->db->conn_id);
		
		$cb = new OptionsConnector($this->db->conn_id);
    	$cb->render_table("master_pajak","nilai","nilai(value),kode_pajak(label)");
   	 	$grid->set_options("pajak",$cb);
		
		$grid->render_sql("select a.id, a.kdtrans, a.idbarang, concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang, b.nmsatuan, a.qtyPesan, sum(c.qtyBeli) as qtyTerima, a.harga, a.disc, a.discrp, a.pajak, a.jumlah, '$img' as img,'$img_del' as img_del from trans_pesenan_beli_child a left join v_master_barang_detail b on a.idbarang=b.idbarang left join v_pembelian_brg c on a.kdtrans = c.no_po and a.idbarang = c.idbarang where a.kdtrans = '".$kdtrans."' group by a.idbarang,a.kdtrans","idbarang","idbarang,img,nmbarang,nmsatuan,qtyPesan,qtyTerima,harga,disc,discrp,pajak,jumlah,img_del");
	}
	
	function frm_edit($kdtrans="") {
		$r = $this->db->query("select a.*, b.nmrekan from trans_pesenan_beli a left join master_rekan_bisnis b on a.company_id=b.idrekan where a.kdtrans = '".$kdtrans."'")->row();
		$data = array(
			'id' => $r->id,
			'no_lpp' => $r->kdtrans,
			'tglPesen' => $this->msistem->conversiTglDB($r->tgl),
			'tglKirim' => $this->msistem->conversiTglDB($r->tgl_kirim),
			'txtidSupplier' => $r->company_id,
			'nmSupplier' => $r->nmrekan,
			'sub_total_item' => $r->sub_total_item,
			'sub_total_terima' => $r->sub_total_terima,
			'sub_total' => $r->sub_total,
			'potongan' => $r->potongan_persen,
			'potongan2' => $r->potongan_rupiah,
			'pajak' => $this->m_company->pilihPajak($r->pajak_persen),
			'pajak2' => $r->pajak_rupiah,
			'total_akhir' => $r->total_akhir,
			'tunai' => $r->tunai_dp,
			'kredit' => $r->kredit,
			'ket' => $r->keterangan,
			'pilihPajak' => $this->m_company->pilihPajak('0'),
			'pilihPajakBarcode' => $this->m_company->pilihPajak('0'),
			'qPajak' => $this->db->query("select nilai,kode_pajak from master_pajak order by nilai"),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'akun_kas' => $r->akun_kas,
			'akun_dp' => $r->akun_dp,
			'top' => $this->m_penjualan->pilihTOP($r->idtermin)
		);
		$data['periodeAwal'] = $this->session->userdata('periodeAwal');
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('pesanan_pembelian/pp_input',$data); 
	}
	
	function simpan() {
		
		$tglPesan = $this->msistem->conversiTgl($this->input->post('tglPesan'));
		$tglKirim = $this->msistem->conversiTgl($this->input->post('tglKirim'));
		// validasi periode
		$invalid = $this->msistem->validasi_periode($tglPesan);
		if($invalid=='1'):
			echo "ERR";
			return;
		endif;
		
		$this->db->trans_begin();
		
		$ak = $this->db->query("select la_kas_dp_pesen_beli,la_dp_pesen_beli from master_company where outlet_id = '".$this->input->post('gudang')."'")->row();
		if($this->input->post('akun_kas')=="") {
			$akun_kas = $ak->la_kas_dp_pesen_beli;
		} else {
			$akun_kas = $this->input->post('akun_kas');	
		}
		if($this->input->post('akun_dp')=="") {
			$akun_dp = $ak->la_dp_pesen_beli;
		} else {
			$akun_dp = $this->input->post('akun_dp');	
		}
		
		$data = array (
			'tgl' => $tglPesan,
			'tgl_kirim' => $tglKirim,
			'company_id' => $this->input->post('supplier'),
			'outlet_id' => $this->input->post('gudang'),
			'sub_total_item' => $this->input->post('sub_total_item'),
			'sub_total' => $this->input->post('sub_total'),
			'potongan_persen' => $this->input->post('potongan'),
			'potongan_rupiah' => $this->input->post('potongan2'),
			'pajak_persen' => $this->input->post('pajak'),
			'pajak_rupiah' => $this->input->post('pajak2'),
			'total_akhir' => $this->input->post('total_akhir'),
			'tunai_dp' => $this->input->post('tunai'),
			'kredit' => $this->input->post('kredit'),
			'keterangan' => $this->input->post('ket'),
			'idtermin' => $this->input->post('termin'),
			'akun_kas' => $akun_kas,
			'akun_dp' => $akun_dp,
			'flag' => 0
		);
		if($this->input->post('kdtrans')=="") {
			$kdtrans = $this->msistem->noTrans('PP','trans_pesenan_beli','',$this->input->post('gudang'),$tglPesan);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('trans_pesenan_beli', $data);
			$this->msistem->log_book('Input data baru Beli Brg "'.$kdtrans,'pb4',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('trans_pesenan_beli', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data Beli Brg "'.$kdtrans,'pb4',$this->session->userdata('sis_user'));
		}
		
		// input dataBeli
		if($this->input->post('dataBeli') != ""):
			$dataBeli = $this->input->post('dataBeli');
			$table = 'trans_pesenan_beli_child';
			$dataIns = array('idbarang','qtyPesan','harga','disc','discrp','pajak','jumlah');
			$fk = array('kdtrans' => $kdtrans);
			$this->msistem->insertDB($dataBeli,$table,$dataIns,$fk);
		endif;
		
		
		// Nilai Jurnal
		$this->db->delete("ak_jurnal",array('no_jurnal' => $kdtrans));
		$tunai_dp = $this->input->post('tunai');
		if($tunai_dp >= 1):
			// Jurnal Otomatis
			$hJurnal = array(
				'no_jurnal' => $kdtrans,
				'periode' => $this->session->userdata('periode'),
				'tgl_jurnal' => $tglPesan,
				'keterangan' => 'UANG MUKA PESANAN BELI :'.$kdtrans,
				'created_by' => $this->session->userdata('sis_user'),
				'created' => date("Y-m-d"),
				'company' => $this->input->post('gudang'),
				'tipe' => '1'
			);
			$this->db->insert('ak_jurnal', $hJurnal);
			// Kredit
			$kJurnal = array(
				'no_jurnal' => $kdtrans,
				'no_akun' => $akun_kas,
				'debet' => '0',
				'kredit' => $tunai_dp,
				'debet_kredit' => 'K',
				'nilai' => $nj->tunai_dp
			);
			$this->db->insert('ak_jurnal_detail', $kJurnal);
			// Debit
			$dJurnal = array(
				'no_jurnal' => $kdtrans,
				'no_akun' => $akun_dp,
				'debet' => $tunai_dp,
				'kredit' => '0',
				'debet_kredit' => 'D',
				'nilai' => $nj->tunai_dp
			);
			$this->db->insert('ak_jurnal_detail', $dJurnal);
		endif;
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
            echo $kdtrans;
        }
	}
	
	function hapus() {
		//$sql = $this->db->query("select kdtrans from trans_pesenan_beli where id = '".$this->input->post('kdtrans')."'")->row();
		$kdtrans = $this->input->post('idrec');
		
		$this->db->trans_begin();
		$this->db->delete("trans_pesenan_beli",array('kdtrans' => $kdtrans));
		$this->db->delete("rpt_stock",array('notrans' => $kdtrans));
		$this->db->delete("ak_jurnal",array('no_jurnal' => $kdtrans));
		
		$this->msistem->log_book('Delete data No Transaksi "'.$kdtrans,'pb4',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function cetak_pesanan($kode="") {
		//$kode = '0002.P1010-PP.0514';
		//setting pdf
		//require_once APPPATH.'3rdparty/tcpdf/config/lang/eng'.EXT;
		//sql
		error_reporting(0);
		$sql = $this->db->query("SELECT
			trans_pesenan_beli.id,
			trans_pesenan_beli.kdtrans,
			trans_pesenan_beli.tgl,
			trans_pesenan_beli.tgl_kirim,
			trans_pesenan_beli.sub_total_item,
			trans_pesenan_beli.sub_total_terima,
			trans_pesenan_beli.sub_total,
			trans_pesenan_beli.potongan_persen,
			trans_pesenan_beli.potongan_rupiah,
			trans_pesenan_beli.pajak_persen,
			trans_pesenan_beli.pajak_rupiah,
			trans_pesenan_beli.total_akhir,
			trans_pesenan_beli.tunai_dp,
			trans_pesenan_beli.kredit,
			trans_pesenan_beli.keterangan,
			trans_pesenan_beli.flag,
			trans_pesenan_beli.created_by,
			trans_pesenan_beli.created,
			trans_pesenan_beli.modified_by,
			trans_pesenan_beli.modified,
			master_rekan_bisnis.nmrekan,
			master_rekan_bisnis.telp_1,
			master_rekan_bisnis.telp_2,
			master_rekan_bisnis.fax,
			master_alamat_rekan.alamat as alamat_supl,
			b.city_name as city_name_supl,
			sys_termin_pembayaran.jml_hari,
			master_company.nm_outlet,
			master_company.alamat,
			master_company.tlp,
			master_company.fax as fax_company,
			a.city_name,
			c.nmtermin
			FROM
			trans_pesenan_beli
			LEFT JOIN master_rekan_bisnis ON trans_pesenan_beli.company_id = master_rekan_bisnis.idrekan
			LEFT JOIN master_alamat_rekan ON master_alamat_rekan.idrekan = master_rekan_bisnis.idrekan and master_alamat_rekan.idjnsalamat = '1'
			LEFT JOIN sys_termin_pembayaran ON master_rekan_bisnis.idtermin = sys_termin_pembayaran.idtermin
			LEFT JOIN master_company ON trans_pesenan_beli.outlet_id = master_company.outlet_id 
			LEFT JOIN master_city a on a.city_code = master_company.city_code
			LEFT JOIN master_city b on b.city_code = master_alamat_rekan.city_code
			LEFT JOIN sys_termin_pembayaran c on c.idtermin = trans_pesenan_beli.idtermin
			WHERE trans_pesenan_beli.kdtrans = '".$kode."'")->row(); 
		
		// Data Kantor Pusat
		$qPst = $this->db->query("select a.nm_outlet,a.alamat,a.alamat_tambahan,a.tlp,a.fax,b.city_name from master_company a left join master_city b on a.city_code = b.city_code where a.outlet_id = '".$this->session->userdata('outlet_id')."'")->row();
		
		// Data Detail
		$sqlDetail = $this->db->query("select b.idbarang_induk,b.nmbarang,b.nmwarna,b.idsize,b.file_gambar,a.qtyPesan,a.harga,a.disc,a.discrp,a.pajak,a.jumlah,b.idbarang_induk from trans_pesenan_beli_child a left join v_master_barang_detail b on a.idbarang = b.idbarang where kdtrans = '".$kode."' order by b.idbarang");
foreach($sqlDetail->result() as $rs) {
	$nmbarang[$rs->idbarang_induk] = $rs->nmbarang;	
	$gambar[$rs->idbarang_induk] = $rs->file_gambar;
	$warna[$rs->idbarang_induk] = $rs->nmwarna;
	$arrSize[$rs->idsize] = $rs->idsize;
	$qty[$rs->idbarang_induk][$rs->idsize] = $rs->qtyPesan;
	$harga[$rs->idbarang_induk] = $rs->harga;
	$discRp[$rs->idbarang_induk] = $rs->discrp;
	$pajak[$rs->idbarang_induk] = $rs->pajak;
	$jumlah[$rs->idbarang_induk] = $jumlah[$rs->idbarang_induk] + $rs->jumlah;
	$jmlSize[$rs->idsize] = $jmlSize[$rs->idsize] + $rs->qtyPesan; 
}
$lbr = 25;
asort($arrSize);
			
		$this->load->library('header/header_pesanan_beli');
		
		// create new PDF document
		$pdf = new header_pesanan_beli("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
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
		$pdf->alamat_supl($sql->alamat_supl);
		$pdf->alamat($sql->alamat);
		$pdf->city_name_supl($sql->city_name_supl);
		$pdf->city_name($sql->city_name);
		$pdf->telp_1($sql->telp_1);
		$pdf->fax($sql->fax);
		$pdf->tlp($sql->tlp);
		$pdf->fax_company($sql->fax_company);
		$pdf->jml_hari($sql->nmtermin);
		$pdf->tgl($this->msistem->conversiTglDB($sql->tgl));
		$pdf->keterangan($sql->keterangan);
		
		$pdf->kantorPst($qPst->nm_outlet);
		$pdf->alamatPst($qPst->alamat);
		$pdf->alamatTambahanPst($qPst->alamat_tambahan);
		$pdf->cityPst($qPst->city_name);
		$pdf->tlpPst($qPst->tlp);
		$pdf->faxPst($qPst->fax);
		
		// Data Detail
		$pdf->lbr($lbr);
		$pdf->arrSize($arrSize);
		
		//set margins
		$pdf->SetMargins(11,74,10);
		$pdf->SetHeaderMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		 
		// set font
		$pdf->SetFont('times', '', 10);
		 
		// add a page
		$pdf->setPrintFooter(true);
		$pdf->AddPage();
		 
		

$report = '<table width="701" border="1">';

$no = 1; $tDisc = 0; $tTotal = 0;
foreach($nmbarang as $idbarang => $nmbarang) {
	$gbr = '<img src="gambar/'.$gambar[$idbarang].'" width="100" height="40" style="padding-top:50px;" />';
	//$GT = $total[$idbarang];
	$report .=  '<tr>
		<td width="20" align="center">'.$no.'</td>
		<td width="110" align="center"><br />&nbsp;'.$gbr.'</td>
		<td width="120">&nbsp;'.$nmbarang.'<br />&nbsp;Article : '.$idbarang.'<br />&nbsp;Color :'.$warna[$idbarang].'</td>';
		
	 $total = 0;
			foreach($arrSize as $s) {
				if(isset($qty[$idbarang][$s])) {
					$jml = $qty[$idbarang][$s];
				} else {
					$jml = "";
				}
				$report .= '<td width="'.$lbr.'" align="center">'.$jml.'</td>';
				$total = $total + $jml;
			}
		
	$report .= '<td width="30" align="center">'.$total.'</td>
		<td width="50" align="right">'.$this->msistem->format_angka($harga[$idbarang]).'&nbsp;&nbsp;</td>
		<td width="45" align="right">'.$this->msistem->format_angka($discRp[$idbarang]).'&nbsp;&nbsp;</td>
		<td width="30" align="center">'.$pajak[$idbarang].'</td>
		<td width="70" align="right">'.$this->msistem->format_angka($jumlah[$idbarang]).'&nbsp;&nbsp;</td>
	  </tr>';
	  $no++;
	  $tDisc = $tDisc + $discRp[$idbarang];
	  $tTotal = $tTotal + $jumlah[$idbarang];
}
  
  
  $report .= '<tr>
   <td colspan="3">&nbsp;JUMLAH</td>';
   
  			$GT = 0;
			foreach($arrSize as $s) {	
				$tSize = $jmlSize[$s];
				$report .= '<td align="center">'.$tSize.'</td>';
				$GT = $GT + $tSize;
			}
  
    $report .= '<td align="center">'.$GT.'</td>
	 <td colspan="3">&nbsp;</td>
	  <td align="right">'.$this->msistem->format_angka($tTotal).'&nbsp;&nbsp;</td>
  </tr>';
  
  $width = count($arrSize) * $lbr;
  $colspan = 4 + count($arrSize);
  $report .= '
  	<tr>
		<td colspan="'.$colspan.'" rowspan="4" align="left">&nbsp;Keterangan : <br />&nbsp;'.$sql->keterangan.'</td>
		<td align="right" colspan="3"><strong>SUB TOTAL :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->sub_total).'&nbsp;&nbsp;</strong></td>
	</tr>
	<tr>
		<td align="right" colspan="3"><strong>POTONGAN :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->potongan_rupiah).'&nbsp;&nbsp;</strong></td>
	</tr>
	<tr>
		<td align="right" colspan="3"><strong>PAJAK :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->pajak_rupiah).'&nbsp;&nbsp;</strong></td>
	</tr>
	<tr>
		<td align="right" colspan="3"><strong>TOTAL :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->total_akhir).'&nbsp;&nbsp;</strong></td>
	</tr>
	</table>';
	
  $q = $this->db->query("select * from sys_label where id in (5,6,7)");
  foreach($q->result() as $r) {
		$arrLabel[$r->id] = $r->isi;	  
  }
  $report .= '<table width="712" border="0">
  <tr>
    <td width="100" height="30" align="center"></td>
    <td width="200" colspan="2" align="center"></td>
    <td width="120" align="center"></td>
    <td width="80" align="center"></td>
    <td width="80" align="center"></td>
  </tr>
  <tr>
    <td align="center">Dibuat Oleh</td>
    <td colspan="2" align="center">Diketahui</td>
    <td align="center">Disetujui</td>
    <td align="center"></td>
    <td align="center"></td>
  </tr>
  <tr>
    <td height="65"></td>
    <td width="100">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td align="center">('.$this->session->userdata('namauser').')</td>
    <td align="center">('.$arrLabel[5].')</td>
    <td align="center">('.$arrLabel[6].')</td>
    <td align="center">('.$arrLabel[7].')</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
';
 
		$pdf->writeHTML($report, true, false, true, false);
		//$pdf->setPrintFooter(true);
		$pdf->lastPage();
		$pdf->Output('PO_'.$kode.'.pdf', 'I');	
	}
	
	function barcodeLine2($kdtrans="") {
		
		$x = 0;
		$sql = $this->db->query("select b.barcode,a.qtyPesan,b.nmbarang,c.harga from trans_pesenan_beli_child a inner join trans_pesenan_beli f on a.kdtrans = f.kdtrans inner join v_master_barang_detail b on a.idbarang = b.idbarang left JOIN v_harga_barang c on b.idgroup_barang = c.idbarang and c.outlet_id = f.outlet_id and tgl_berlaku <= now() where a.kdtrans = '".$kdtrans."'");
		foreach($sql->result() as $rs) {
			for($i=1;$i<=$rs->qtyPesan;$i++) {
				$arrBarcode[$x] = $rs->barcode;
				$arrNmBarang[$x] = $rs->nmbarang;
				$arrHrg[$x] = $rs->harga;
				$x++;
			}
		}
		echo '<table width="377" border="0" cellpadding="0" cellspacing="0">';
		 /* <tr>
			<td width="40" height="83">&nbsp;</td>
			<td width="162">&nbsp;</td>
			<td width="175">&nbsp;</td>
		  </tr>';*/
		  
	   $i = 0;
	   while($i<$x) {
	   	  $index_1 = $i;
		  $index_2 = $i + 1;
		  
		  if(isset($arrBarcode[$index_1])) {
			  $text_1 = $arrBarcode[$index_1];
			  $harga_1 = $this->msistem->format_angka($arrHrg[$index_1]);
			  $nmbarang_1 = $this->msistem->pecahString($arrNmBarang[$index_1]);
			  $barcode_harga_1 = $this->msistem->pecahString($text_1); //."Rp.".$harga_1;
			  $cetakBarcode_1 = '&nbsp;&nbsp;'.$nmbarang_1.'<br /><img alt="Barcode" src="'.base_url().'index.php/master_barang/barcode/40/'.$text_1.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_1.'<div style="width:auto; height:25.5px;">&nbsp;</div>';
		  } else {
		  	  $cetakBarcode_1 = "";
		  }
		  
		  if(isset($arrBarcode[$index_2])) {
			  $text_2 = $arrBarcode[$index_2];
			  $harga_2 = $this->msistem->format_angka($arrHrg[$index_2]);
			  $nmbarang_2 = $this->msistem->pecahString($arrNmBarang[$index_2]);
			  $barcode_harga_2 = $this->msistem->pecahString($text_2); //."Rp.".$harga_2;
			  $cetakBarcode_2 = '&nbsp;&nbsp;'.$nmbarang_2.'<br /><img alt="Barcode" src="'.base_url().'index.php/master_barang/barcode/40/'.$text_2.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_2.'<div style="width:auto; height:25.5px;">&nbsp;</div>';
		  } else {
		  	   $cetakBarcode_2 = "";
		  }
  
		  
			 echo '<tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">';
			 echo '<td width="40" height="30">&nbsp;</td>';
			 echo '<td width="162">'.$cetakBarcode_1.'</td>';
			 echo '<td width="175">'.$cetakBarcode_2.'</td>';
			 echo '</tr>';	
		   $i = $i+2;
		}
			 echo '</table>';

	}
	
	function setAkun($outlet_id="",$kdtrans="") {
		if($kdtrans == "") {
			$rs = $this->db->query("select la_kas_dp_pesen_beli,la_dp_pesen_beli from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['akun_kas'] = $rs->la_kas_dp_pesen_beli;
			$data['akun_dp'] = $rs->la_dp_pesen_beli;
		} else {
			$rs = $this->db->query("select akun_dp,akun_kas from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['akun_kas'] = $rs->akun_kas;
			$data['akun_dp'] = $rs->akun_dp;	
		}
		$this->load->view('pesanan_pembelian/pp_setakun',$data);
		//echo $rs->la_kas_dp_pesen_beli."|".$rs->la_dp_pesen_beli;
	}
	
	/*function barcodeLine3($kdtrans="") {
		
		$x = 0;
		$sql = $this->db->query("select b.barcode,a.qtyPesan,concat(b.nmbarang,' u',b.nmsize) as nmbarang,c.harga from trans_pesenan_beli_child a inner join trans_pesenan_beli f on a.kdtrans = f.kdtrans inner join v_master_barang_detail b on a.idbarang = b.idbarang inner JOIN v_harga_barang c on b.idgroup_barang = c.idbarang and c.outlet_id = f.outlet_id and tgl_berlaku <= now() where a.kdtrans = '".$kdtrans."'");
		foreach($sql->result() as $rs) {
			for($i=1;$i<=$rs->qtyPesan;$i++) {
				$arrBarcode[$x] = $rs->barcode;
				$arrNmBarang[$x] = $rs->nmbarang;
				$arrHrg[$x] = $rs->harga;
				$x++;
			}
		}
		echo '<table width="377" border="0" cellpadding="0" cellspacing="0">';
  		echo '<tr>';
		echo '<td width="11" height="51">&nbsp;</td>';
    	echo '<td width="117">&nbsp;</td>';
    	echo '<td width="122">&nbsp;</td>';
    	echo '<td width="127">&nbsp;</td>';
  		echo '</tr>';
		  
	   $i = 0;
	   while($i<$x) {
	   	  $index_1 = $i;
		  $index_2 = $i + 1;
		  $index_3 = $i + 2;
		  
		  if(isset($arrBarcode[$index_1])) {
			  $text_1 = $arrBarcode[$index_1];
			  $harga_1 = $this->msistem->format_angka($arrHrg[$index_1]);
			  $nmbarang_1 = $arrNmBarang[$index_1];
			  $barcode_harga_1 = $this->pecahString($text_1); //."Rp.".$harga_1;
			  $cetakBarcode_1 = '&nbsp;&nbsp;'.$nmbarang_1.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/30/'.$text_1.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_1.'<br />&nbsp;';
		  } else {
		  	  $cetakBarcode_1 = "";
		  }
		  
		  if(isset($arrBarcode[$index_2])) {
			  $text_2 = $arrBarcode[$index_2];
			  $harga_2 = $this->msistem->format_angka($arrHrg[$index_2]);
			  $nmbarang_2 = $arrNmBarang[$index_2];
			  $barcode_harga_2 = $text_2; //."Rp.".$harga_2;
			  $cetakBarcode_2 = '&nbsp;&nbsp;'.$nmbarang_2.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/30/'.$text_2.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_2.'<br />&nbsp;';
		  } else {
		  	  $cetakBarcode_2 = "";
		  }
		  
		  if(isset($arrBarcode[$index_3])) {
			  $text_3 = $arrBarcode[$index_3];
			  $harga_3 = $this->msistem->format_angka($arrHrg[$index_3]);
			  $nmbarang_3 = $arrNmBarang[$index_3];
			  $barcode_harga_3 = $text_3; //."Rp.".$harga_3;
			  $cetakBarcode_3 = '&nbsp;&nbsp;'.$nmbarang_3.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/30/'.$text_3.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_3.'<br />&nbsp;';
		  } else {
		  	  $cetakBarcode_3 = "";
		  }
  
		  
			 echo '<tr style="font-family:Arial, Helvetica, sans-serif; font-size:9px;">';
			 echo '<td height="30">&nbsp;</td>';
			 echo '<td>'.$cetakBarcode_1.'</td>';
			 echo '<td>'.$cetakBarcode_2.'</td>';
			 echo '<td>'.$cetakBarcode_3.'</td>';
			 echo '</tr>';	
		   $i = $i+3;
		}
			 echo '</table>';

	}*/
	
}
?>
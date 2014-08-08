<?php 
class transfer_barang extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pd3');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('transfer_barang/tb_index',$data);
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
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,a.outlet_id,a.outlet_tujuan,a.supir,a.nopol,a.keterangan,a.created,a.created_by,b.nm_outlet,c.nm_outlet as tujuan from tr_transfer_barang a inner join master_company b on a.outlet_id = b.outlet_id inner join master_company c on a.outlet_tujuan = c.outlet_id where tgl >= '".$tglAwal."' and tgl <= '".$tglAkhir."' $qr","kdtrans","id,kdtrans,tgl,outlet_id,nm_outlet,outlet_tujuan,tujuan,keterangan,supir,nopol,created,created_by");
	}
	
	function loadDataBrgDetail($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.jml,a.pcs,a.total,a.hrgbeli,b.nmbarang,b.nmwarna,b.nmsatuan,b.nmsize,'$img' as img,'$img_del' as img_del from tr_transfer_barang_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","idbarang","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,jml,pcs,harga,total,img_del,hrgbeli");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['tujuan'] = $this->m_company->pilihLokasiAll('0');
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('transfer_barang/tb_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_transfer_barang where kdtrans = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'tujuan' => $this->m_company->pilihLokasi($r->outlet_tujuan),
			'supir' => $r->supir,
			'nopol' => $r->nopol,
			'keterangan' => $r->keterangan
		);
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('transfer_barang/tb_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array(
			'tgl' => $tgl,
			'outlet_id' => $this->input->post('outlet_id'),
			'outlet_tujuan' => $this->input->post('tujuan'),
			'supir' => strtoupper($this->input->post('supir')),
			'nopol' => strtoupper($this->input->post('nopol')),
			'keterangan' => strtoupper($this->input->post('keterangan')),
		);
		
		$this->db->trans_begin();
		if($this->input->post('kdtrans')=="") {
			$kdtrans = $this->msistem->noTransLabel('TB','tr_transfer_barang','',$this->input->post('outlet_id'),$tgl,$this->input->post('tujuan'));
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_transfer_barang', $data);
			$this->msistem->log_book('Input data baru transfer barang "'.$kdtrans,'pd3',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_transfer_barang', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data Transfer Barang "'.$kdtrans,'pd3',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'tr_transfer_barang_detail';
		$dataIns = array('idbarang','jml','pcs','harga','total','hrgbeli','','');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		// input report stock
		$table = 'rpt_stock';
		$dataIns = array('idbarang','qty_transfer_out','pcs_transfer_out','','jml_transfer_out','hrgbeli_transfer_out','','','');
		$fk = array('notrans' => $kdtrans,'outlet_id' => $this->input->post("outlet_id"),'tgl' => $tgl);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		// input report stock outstanding
		$table = 'rpt_stock';
		$kdoutstanding = $kdtrans."-OST";
		$dataIns = array('idbarang','','','','jml_outstanding','','outstanding','','');
		$fk = array('notrans' => $kdoutstanding,'outlet_id' => $this->input->post("tujuan"),'tgl' => $tgl);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		$ptr = $this->db->query("select type from master_company where outlet_id = '".$this->input->post('tujuan')."'")->row();
		// langsung masuk ke stock tujuan jika nilai = 1
		if($ptr->type == "KONSINYASI"):
			// input in report stock
			$table = 'rpt_stock';
			$dataIns = array('idbarang','qty_transfer_in','pcs_transfer_in','','jml_transfer_in','hrgbeli_transfer_in','','outstanding','jml_outstanding');
			$fk = array('notrans' => $kdtrans,'outlet_id' => $this->input->post("tujuan"),'tgl' => $tgl);
			$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
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
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("tr_transfer_barang",array('kdtrans' => $idrec));
		$this->db->delete("rpt_stock",array('notrans' => $idrec));
		$kdoutstanding = $idrec."-OST";
		$this->db->delete("rpt_stock",array('notrans' => $kdoutstanding));
		$this->msistem->log_book('Delete data id "'.$idrec,'pd3',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function cetak_sj($noTrans="") {
		error_reporting(0);
		// Kantor Pusat
		$qPst = $this->db->query("select a.nm_outlet,a.alamat,a.alamat_tambahan,a.tlp,a.fax,b.city_name from master_company a left join master_city b on a.city_code = b.city_code where a.outlet_id = '".$this->session->userdata('outlet_id')."'")->row();
		
		//Data Utama
		$r = $this->db->query("select DATE_FORMAT(a.tgl,'%d - %b - %y') as tgl,a.outlet_id,a.outlet_tujuan,a.keterangan,a.supir,a.nopol,c.nm_outlet as gudangTujuan,c.alamat,b.city_name,c.tlp,c.fax from tr_transfer_barang a inner join master_company c on a.outlet_tujuan = c.outlet_id left join master_city b on c.city_code = b.city_code  where kdtrans = '".$noTrans."'")->row();
		
		$lbr = 30;
		
		$no = 1; $jmlQty = 0; $jmlTotal = 0; $jmlPcs = 0;
		$sql = $this->db->query("select b.idbarang_induk,a.idbarang,b.nmbarang,b.nmwarna,b.idsize,a.jml,a.pcs,a.harga,a.total from tr_transfer_barang_detail a inner join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$noTrans."'");
		foreach($sql->result() as $rs) {
				$nmbarang[$rs->idbarang_induk] = $rs->nmbarang;
				$arrSize[$rs->idsize] = $rs->idsize;
				$qty[$rs->idbarang_induk][$rs->idsize] = $rs->jml;
				$warna[$rs->idbarang_induk] = $rs->nmwarna;
				$jmlSize[$rs->idsize] = $jmlSize[$rs->idsize] + $rs->jml; 
		}
		asort($arrSize);
		
		$this->load->library('header/header_transfer_brg');
		$pdf = new header_transfer_brg('A4', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Ari Karniawan');
		$pdf->SetTitle('Penjualan');
		$pdf->SetSubject('POS');
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);
		// Kantor Pusat
		$pdf->kantorPst($qPst->nm_outlet);
		$pdf->alamatPst($qPst->alamat);
		$pdf->alamatTambahanPst($qPst->alamat_tambahan);
		$pdf->cityPst($qPst->city_name);
		$pdf->tlpPst($qPst->tlp);
		$pdf->faxPst($qPst->fax);
		// Informasi
		$pdf->kode($noTrans);
		$pdf->tgl($r->tgl);
		$pdf->nm_outlet($r->gudangTujuan);
		$pdf->alamat($r->alamat);
		$pdf->city_name($r->city_name);
		$pdf->tlp($r->tlp);
		$pdf->fax_company($r->fax);
		// Data Detail
		$pdf->lbr($lbr);
		$pdf->arrSize($arrSize);
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		//set margins
		$pdf->SetMargins(10,81, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		$pdf->SetFont('times', '', 10);
		$pdf->AddPage();
		
		$html = '<table width="791" border="1">';
		
		foreach($nmbarang as $idbarang => $nmbarang) {
			
			$html .= '
			  <tr>
				<td width="20" align="center">'.$no.'</td>
				<td width="50" align="left">&nbsp;'.$idbarang.'</td>
				<td width="100" align="left">&nbsp;'.$nmbarang.'</td>
				<td width="80" align="left">&nbsp;'.$warna[$idbarang].'</td>';
			
			 $total = 0;
			foreach($arrSize as $s) {
				if(isset($qty[$idbarang][$s])) {
					$jml = $qty[$idbarang][$s];
				} else {
					$jml = "";
				}
				$html .= '<td width="'.$lbr.'" align="center">'.$jml.'</td>';
				$total = $total + $jml;
			}
			
			$html .= '<td width="60" align="center">'.$total.'</td></tr>';
			 // <td width="50" align="right">'.$this->msistem->format_angka($rs->harga).'</td>
			//	<td width="50" align="right">'.$this->msistem->format_angka($rs->total).'</td>
			 $no++;
			 //$jmlQty = $jmlQty + $rs->jml; 
			 //$jmlPcs = $jmlPcs + $rs->pcs; 
			 //$jmlTotal = $jmlTotal + $rs->total;
		}
		
		// footer
		 $html .= '
			  <tr>
				<td colspan="4" align="center">TOTAL</td>';
			$GT = 0;
			foreach($arrSize as $s) {	
				$tSize = $jmlSize[$s];
				$html .= '<td align="center">'.$tSize.'</td>';
				$GT = $GT + $tSize; 
			}
		$html .= '<td align="center">'.$GT.'</td>
			  </tr>';
		 // Keterangan
		 $kolom = count($arrSize) + 5;
		 $html .= '
			  <tr>
				<td colspan="'.$kolom.'" align="left" height="50">&nbsp;KETERANGAN :<br />
				&nbsp;'.$r->keterangan.'<br />';
				
		if($r->supir != ""):
			  $html .= '&nbsp;Supir : '.$r->supir.'<br />';
		endif;
		if($r->nopol != ""):
			  $html .= '&nbsp;No. Pol : '.$r->nopol.'<br />';
		endif;
		 $html .= '</td></tr>';
			  
		 $html .= '</table><br />&nbsp;<br />';
		 
  // Label
  $q = $this->db->query("select * from sys_label where id in (1,2,3,4)");
  foreach($q->result() as $r) {
		$arrLabel[$r->id] = $r->isi;	  
  }
		 $html .= '<table width="712" border="0">
  <tr>
    <td width="100" align="center">Prepared By</td>
    <td width="160" colspan="2" align="center">Approved By</td>
    <td width="100" align="center">Shipped By</td>
    <td width="100" align="center">Logistic By</td>
    <td width="100" align="center">Received By</td>
  </tr>
  <tr>
    <td height="65">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">('.$this->session->userdata('namauser').')</td>
    <td align="center">('.$arrLabel[1].')</td>
    <td align="center">('.$arrLabel[2].')</td>
    <td align="center">('.$arrLabel[3].')</td>
    <td align="center">('.$arrLabel[4].')</td>
    <td align="center">(............................)</td>
  </tr>
</table>
';
		 $pdf->writeHTML($html, true, false, true, false, '');
		// ---------------------------------------------------------
		//Close and output PDF document
		$pdf->Output('cetakTB.pdf', 'I');
	}
}
?>
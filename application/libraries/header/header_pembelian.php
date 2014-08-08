<?php 
//require_once('application/libraries/pdf.php');
require_once('application/3rdparty/tcpdf/tcpdf.php');
class header_pembelian extends TCPDF {
	
	var $kode = "";
	var $nmrekan = "";
	var $nm_outlet = "";
	var $alamat_supl = "";
	var $alamat = "";
	var $city_name_supl = "";
	var $city_name = "";
	var $telp_1 = "";
	var $fax = "";
	var $tlp = "";
	var $fax_company = "";
	var $jml_hari = "";
	var $tgl = "";
	var $keterangan = "";
	var $kantorPst = "";
	var $alamatPst = "";
	var $alamatTambahanPst = "";
	var $cityPst = "";
	var $tlpPst = "";
	var $faxPst = "";
	var $po_no = "";
	
	function kode($kode) {
		$this->kode = $kode;	
	}
	
	function po_no($po_no) {
		$this->po_no = $po_no;	
	}
	
	function nmrekan($nmrekan) {
		$this->nmrekan = $nmrekan;	
	}
	
	function nm_outlet($nm_outlet) {
		$this->nm_outlet = $nm_outlet;	
	}
	
	function alamat_supl($alamat_supl) {
		$this->alamat_supl = $alamat_supl;	
	}
	
	function alamat($alamat) {
		$this->alamat = $alamat;	
	}
	
	function city_name_supl($city_name_supl) {
		$this->city_name_supl = $city_name_supl;	
	}
	
	function city_name($city_name) {
		$this->city_name = $city_name;	
	}
	
	function telp_1($telp_1) {
		$this->telp_1 = $telp_1;	
	}
	
	function fax($fax) {
		$this->fax = $fax;	
	}
	
	function tlp($tlp) {
		$this->tlp = $tlp;	
	}
	
	function fax_company($fax_company) {
		$this->fax_company = $fax_company;	
	}
	
	function jml_hari($jml_hari) {
		$this->jml_hari = $jml_hari;	
	}
	
	function tgl($tgl) {
		$this->tgl = $tgl;	
	}
	
	function keterangan($keterangan) {
		$this->keterangan = $keterangan;	
	}
	
	function kantorPst($kantorPst) {
		$this->kantorPst = $kantorPst;	
	}
	
	function alamatPst($alamatPst) {
		$this->alamatPst = $alamatPst;	
	}
	
	function alamatTambahanPst($alamatTambahanPst) {
		$this->alamatTambahanPst = $alamatTambahanPst;	
	}
	
	function cityPst($cityPst) {
		$this->cityPst = $cityPst;	
	}
	
	function tlpPst($tlpPst) {
		$this->tlpPst = $tlpPst;	
	}
	
	function faxPst($faxPst) {
		$this->faxPst = $faxPst;	
	}
	
	function lbr($lbr) {
		$this->lbr = $lbr;	
	}
	
	function arrSize($arrSize) {
		$this->arrSize = $arrSize;	
	}
	
	
	public function Header() {
		$lbr = $this->lbr;
		$arr = $this->arrSize; //array("36","37","38","39","40");
		$cp = count($arr);
		$width = $cp * $lbr;
		 
		// set some text to print
		$html = 
			'<table width="487" border="0">
  <tr>
    <td width="500" style="font-size:12;">'.$this->kantorPst.'</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="400" rowspan="4">'.$this->alamatPst.'<br />'.$this->alamatTambahanPst.'<br />'.$this->cityPst.' - INDONESIA</td>
    <td colspan="2" align="center" style="font-size:12;">ITEM RECEIVABLE</td>
  </tr>
  <tr>
    <td width="121">Receive Date</td>
    <td width="150">:&nbsp;'.$this->tgl.'</td>
  </tr>
  <tr>
    <td>Receive. No</td>
    <td>:&nbsp;'.$this->kode.'</td>
  </tr>
  <tr>
    <td>PO. No</td>
    <td>:&nbsp;'.$this->po_no.'</td>
  </tr>
  <tr>
    <td>Phone. '.$this->tlpPst.' - Fax. '.$this->faxPst.'</td>
    <td>Term Of Payment</td>
    <td>:&nbsp;'.$this->jml_hari.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>FROM.</td>
    <td colspan="2">SHIP TO</td>
  </tr>
  <tr>
    <td>'.$this->nmrekan.'</td>
    <td colspan="2">'.$this->nm_outlet.'</td>
  </tr>
  <tr>
    <td>'.ucwords(strtolower($this->alamat_supl)).'</td>
    <td colspan="2">'.ucwords(strtolower($this->alamat)).'</td>
  </tr>
  <tr>
    <td>'.ucwords(strtolower($this->city_name_supl)).'</td>
    <td colspan="2">'.ucwords(strtolower($this->city_name_supl)).'</td>
  </tr>
  <tr>
    <td>Telp.'.$this->telp_1.' - Fax.'.$this->fax.'</td>
    <td colspan="2">Telp. '.$this->tlp.' - Fax.'.$this->fax_company.'</td>
  </tr>
</table><br />';
		if($this->jml_hari == "") {
			$termin = "";
		} else {
			$termin = $this->jml_hari." Hari";
		}
		/* $html .= '<table width="839" border="1">
	  <tr>
		<td width="100" align="center">Tanggal</td>
		<td width="180" align="center">Permintaan</td>
		<td width="180" align="center">Kirim Via</td>
		<td width="180" align="center">Termin</td>
	  </tr>
	  <tr>
		<td>&nbsp;'.$this->tgl.'</td>
		<td>&nbsp;</td>
		<td>&nbsp;'.$this->keterangan.'</td>
		<td>&nbsp;'.$termin.'</td>
	  </tr>
	</table><br /><br />'; */
	$html .= '
	<table width="701" border="1">
	<tr>
	<td width="20" align="center" rowspan="2">No</td>
    <td width="110" align="center" rowspan="2">Gambar</td>
    <td width="120" align="center" rowspan="2">Nama Barang</td>
    <td width="'.$width.'" align="center" colspan="'.$cp.'">Size</td>
    <td width="30" align="center" rowspan="2">JML</td>
    <td width="50" align="center" rowspan="2">@Harga</td>
	<td width="45" align="center" rowspan="2">Disc</td>
	<td width="30" align="center" rowspan="2">Pajak %</td>
    <td width="70" align="center" rowspan="2">Total</td>
  </tr>
  <tr>';
		
		 foreach($arr as $size) {
			$html .= '<td width="'.$lbr.'" align="center">'.$size.'</td>';
		 }
			
		$html .=  '</tr></table>';
		$this->SetFont('times', '', 10);
		$this->writeHTML($html, true, 0, true, 0);
	}
	
	// Page footer
	public function Footer() {
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
	}
}
?>
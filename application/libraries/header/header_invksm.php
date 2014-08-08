<?php 
//require_once('application/libraries/pdf.php');
require_once('application/3rdparty/tcpdf/tcpdf.php');
class header_invksm extends TCPDF {
	
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
	var $noPesanan = "";
	
	function kode($kode) {
		$this->kode = $kode;	
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
	
	function noPesanan($noPesanan) {
		$this->noPesanan = $noPesanan;	
	}
	
	
	public function Header() {
		 
		// set some text to print
		$html = 
			'<table border="0">
				<tr style="font-weight: bold;">
					<td align="left" valign="middle" height="20" style="font-size:12;">'.$this->kantorPst.'</td>
					<td rowspan="6" align="right" height="20" valign="middle" style="font-size:15; color: #00C;">INVOICE&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-weight: bold;">
					<td align="left" valign="baseline" height="20" style="font-style:italic;">'.$this->alamatPst.'<br />'.$this->alamatTambahanPst.'<br />'.$this->cityPst.' - Indonesia</td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15" style="font-style:italic;">Phone. '.$this->tlpPst.' - Fax. '.$this->faxPst.'</td>
				</tr>
                <tr style="font-weight: bold;">
					<td align="left" valign="middle" height="15"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">Nomor : '.$this->kode.'</td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">&nbsp;</td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">Tagihan Untuk :</td>
					<td align="left" valign="middle" height="15"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">'.$this->nm_outlet.'</td>
					<td align="left" valign="middle" height="15"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">'.ucwords(strtolower($this->alamat)).'</td>
					<td align="left" valign="middle" height="15"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">'.ucwords(strtolower($this->city_name)).'</td>
					<td align="left" valign="middle" height="15"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">Telp. '.$this->tlp.' - Fax.'.$this->fax_company.'</td>
					<td align="left" valign="middle" height="15"></td>
				</tr>
			</table>';
	$html .= '<table width="701" border="1">
  <tr>
  	<td width="50" align="center">No.</td>
    <td width="80" align="center">Tanggal</td>
	<td width="80" align="center">No. Bon</td>
	<td width="80" align="center">SKU</td>
	<td width="80" align="center">Article</td>
    <td width="170" align="center">Nama Barang</td>
    <td width="80" align="center">Colour</td>
    <td width="40" align="center">Qty</td>
    <td width="70" align="center">@Harga</td>
	<td width="70" align="center">@Sales Netto</td>
	<td width="70" align="center">@Margin</td>
    <td width="80" align="center">Net Invoice</td>
  </tr></table>';
	$this->SetFont('times', '', 9);
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
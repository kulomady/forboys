<?php 
//require_once('application/libraries/pdf.php');
require_once('application/3rdparty/tcpdf/tcpdf.php');
class header_transfer_brg extends TCPDF {
	
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
	
	var $arrSize = "";
	var $lbr = "";

	
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
		
		$html = '<table border="0">
				<tr style="font-weight: bold;">
					<td width="370" height="20" align="left" valign="middle" style="font-size:12;">'.$this->kantorPst.'</td>
					<td width="150" height="-4" colspan="2" align="right" valign="middle" style="font-size:15; color: #00C;">DELIVERY ORDER&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-weight: bold;">
					<td height="20" rowspan="2" align="left" valign="baseline" style="font-style:italic;">'.$this->alamatPst.'<br />'.$this->alamatTambahanPst.'<br />'.$this->cityPst.' - Indonesia</td>
					<td width="80" height="-1" align="left" valign="middle" style="font-size:9;">Delivery Date. </td>
					<td width="100" align="left" valign="middle" style="font-size:9;">: '.$this->tgl.'</td>
				</tr>
				<tr style="font-weight: bold;">
				  <td height="-2" align="left" valign="middle" style="font-size:9;">Deliver No. </td>
				  <td height="-2" align="left" valign="middle" style="font-size:9;">: '.$this->kode.'</td>
  </tr>
                <tr>
					<td align="left" valign="middle" height="15" style="font-style:italic;">Phone. '.$this->tlpPst.' - Fax. '.$this->faxPst.'</td>
					<td height="-1" colspan="2" align="right" valign="middle" style="font-size:15; color: #00C;">&nbsp;</td>
				</tr>
                <tr style="font-weight: bold;">
					<td align="left" valign="middle" height="15"></td>
					<td height="0" colspan="2" align="right" valign="middle" style="font-size:15; color: #00C;">&nbsp;</td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">SHIP TO:</td>
					<td height="15" colspan="2" align="right" valign="middle" style="font-size:15; color: #00C;">&nbsp;</td>
					<td width="6" height="15" align="left" valign="middle"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">'.$this->nm_outlet.'</td>
					<td height="15" colspan="2" align="left" valign="middle"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">'. ucwords(strtolower($this->alamat)).'</td>
					<td height="15" colspan="2" align="left" valign="middle"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">'.ucwords(strtolower($this->city_name)).'</td>
					<td height="15" colspan="2" align="left" valign="middle"></td>
				</tr>
                <tr>
					<td align="left" valign="middle" height="15">Telp.'.$this->tlp.' - Fax.'.$this->fax_company.'</td>
					<td height="15" colspan="2" align="left" valign="middle"></td>
				</tr>
			</table><br />';
			
		$html .= '<table width="791" border="1">
		  <tr>
			<td width="20" align="center" rowspan="2">No.</td>
			<td width="50" align="center" rowspan="2">Kode Item</td>
			<td width="100" align="center" rowspan="2">Nama Item</td>
			<td width="80" align="center" rowspan="2">Warna</td>
			<td width="'.$width.'" align="center" colspan="'.$cp.'">Size</td>
			<td width="60" align="center" rowspan="2">Total</td>
		  </tr>
		  <tr>';
		
		 foreach($arr as $size) {
			$html .= '<td width="'.$lbr.'" align="center">'.$size.'</td>';
		 }
			
		$html .=  '</tr></table>';
		//<td width="50" align="center" style="border-top:1px solid #000000; border-bottom:1px solid #000000;">@ Harga</td>
		//<td width="50" align="center" style="border-top:1px solid #000000; border-bottom:1px solid #000000;">Jumlah</td>
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
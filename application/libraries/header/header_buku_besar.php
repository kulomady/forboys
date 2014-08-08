<?php 
//require_once('application/libraries/pdf.php');
require_once('application/3rdparty/tcpdf/tcpdf.php');
class header_buku_besar extends TCPDF {
		
	var $tanggal1 = "";
	var $tanggal2 = "";	
	
	function tanggal1($tanggal1) {
		$this->tanggal1 = $tanggal1;	
	}
        
        function tanggal2($tanggal2) {
		$this->tanggal2 = $tanggal2;	
	}
        
        function company($company) {
		$this->company = $company;	
	}
        
        function address($address) {
		$this->address = $address;	
	}
        
        function telp($telp) {
		$this->telp = $telp;	
	}
        
	public function Header() {				                
                $html ='
                    <table width="900" border="0">
                        <tr>
                            <td width="110" rowspan="4">LOGO</td>   
                            <td width="210">BUKU BESAR</td>  
                            <td width="250" align="right">PERIODE : '.$this->tanggal1.' sd '.$this->tanggal2.'</td> 
                        </tr>                        
                        <tr>
                            <td>'.$this->company.'</td>                           
                        </tr>
                        <tr>
                            <td>'.$this->address.'</td>                           
                        </tr>
                        <tr>
                            <td>'.$this->telp.'</td>                           
                        </tr>
                    </table>
                ';
                
		
		$this->writeHTML($html, true, 0, true, 0);
	}
	
	// Page footer
	public function Footer() {
////		// Position at 1.5 cm from bottom
		$this->SetY(-15);
////		// Set font
////		$this->SetFont('helvetica', 'I', 8);
////		// Page number
////		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
//                
//                $html = '<table width="565" border="0">                   
//		  <tr>
//			<td width="400" align="left"></td>                        
//                        <td width="100" align="center" style="border-top:1px dotted #000000;">                                                
//                        <b>SIGNATURE</b>
//                        </td>
//                        <td width="50"></td>
//		  </tr>		  
//		</table>&nbsp;';
//                $html = "aaaaaaaaaaaaaaaaaa<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
//                $this->writeHTML($html, true, 0, true, 0);
	}
}
?>
<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=pesanan_pembelian_rekap_'.$tgl1."_".$tgl2.".xls");	
endif;
error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN PESANAN PEMBELIAN REKAP</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<body>
<h2>LAPORAN PESANAN PEMBELIAN REKAP</h2>
<table width="357" border="0">
  <tr>
    <td width="82">Lokasi</td>
    <td width="8">:</td>
    <td width="245"><?php echo $nm_outlet; ?></td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td>:</td>
    <td><?php echo $tglPertama.' s.d '.$tglKedua; ?></td>
  </tr>
</table>
<br />
<table border="0">
  <tr align="center" bgcolor="#0099CC" valign="middle">
    <th width="128">No. Transaksi</th>
    <th width="78">Tanggal</th>
    <th width="153">Gudang</th>
    <th width="156">Supplier</th>
    <th width="62">Jml Item</th>
    <th width="76">Jml Terima</th>
    <th width="93">Subtotal</th>
    <th width="67">Pot</th>
    <th width="75">Pajak</th>
    <th width="97">Total Akhir</th>
  </tr>
<?php
	$qr = "";
	if($outlet != 0){
		$qr .= "and a.outlet_id = '".$outlet."'";
	}
	
	if($company != 0){
		$qr .= "and a.company_id = '".$company."'";
	}
	
	$sql = $this->db->query("SELECT
a.id,
a.kdtrans,
DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl,
a.sub_total_item,
a.sub_total_terima,
a.sub_total,
a.potongan_rupiah,
a.pajak_rupiah,
a.total_akhir,
b.nmrekan,
c.nm_outlet
FROM
trans_pesenan_beli a
LEFT JOIN master_rekan_bisnis b ON a.company_id = b.idrekan
LEFT JOIN master_company c ON a.outlet_id = c.outlet_id
WHERE a.tgl >= '".$tgl1."' and a.tgl <= '".$tgl2."' $qr");
	
	$i = 1; $J1 = 0; $J2 = 0; $J3 = 0; $J4 = 0; $J5 = 0; $J6 = 0;
	foreach($sql->result() as $rs){
		if($i%2){
			$color = '#fff';
		} else {			
			$color = '#B8E0F5';
		}
?>
	<tr bgcolor="<?php echo $color; ?>">
        <td><?php echo $rs->kdtrans; ?></td>
        <td align="center"><?php echo $rs->tgl; ?></td>
        <td><?php echo $rs->nm_outlet; ?></td>
        <td><?php echo $rs->nmrekan; ?></td>
        <td align="right"><?php echo number_format($rs->sub_total_item); ?></td>
        <td align="right"><?php echo number_format($rs->sub_total_terima); ?></td>
        <td align="right"><?php echo number_format($rs->sub_total,2,",","."); ?></td>
        <td align="right"><?php echo number_format($rs->potongan_rupiah); ?></td>
        <td align="right"><?php echo number_format($rs->pajak_rupiah); ?></td>
        <td align="right"><?php echo number_format($rs->total_akhir,2,",","."); ?></td>
  	</tr>
	
<?php
		$J1 = $J1 + $rs->sub_total_item;
		$J2 = $J2 + $rs->sub_total_terima;
		$J3 = $J3 + $rs->sub_total;
		$J4 = $J4 + $rs->potongan_rupiah;
		$J5 = $J5 + $rs->pajak_rupiah;
		$J6 = $J6 +$rs->total_akhir;
		$i++;
	}
?>
<tr>
	  <td colspan="4" bgcolor="#FFCC00"><strong>JUMLAH</strong></td>
	  <td align="right" bgcolor="#FFCC00"><?php echo number_format($J1); ?></td>
	  <td align="right" bgcolor="#FFCC00"><?php echo number_format($J1); ?></td>
	  <td align="right" bgcolor="#FFCC00"><?php echo number_format($J3,2,",","."); ?></td>
	  <td align="right" bgcolor="#FFCC00"><?php echo number_format($J4,2,",","."); ?></td>
	  <td align="right" bgcolor="#FFCC00"><?php echo number_format($J5,2,",","."); ?></td>
	  <td align="right" bgcolor="#FFCC00"><?php echo number_format($J6,2,",","."); ?></td>
  </tr>
</table>

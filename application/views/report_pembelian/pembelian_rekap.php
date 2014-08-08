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
<title>LAPORAN PEMBELIAN REKAP</title>
</head>
<link href="<?php echo base_url(); ?>css/style_doc.css" rel="stylesheet" type="text/css" />
<body>
<h2>LAPORAN PEMBELIAN REKAP</h2>
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
<table border="0" cellpadding="3" cellspacing="1">
  <tr align="center" bgcolor="#0099CC" height="40" valign="middle">
    <th width="170">No. Transaksi</th>
    <th width="100">Tanggal</th>
    <th width="200">Gudang</th>
    <th width="200">Supplier</th>
    <th width="100">Jml Beli</th>
    <th width="170">Subtotal</th>
    <th width="100">Pot(%)</th>
    <th width="100">Pajak(%)</th>
    <th width="170">Total Akhir</th>
  </tr>
<?php
	$qr = "";
	if($outlet != 0){
		$qr .= "and trans_pembelian_brg.outlet_id = '".$outlet."'";
	}
	
	if($company != 0){
		$qr .= "and trans_pembelian_brg.company_id = '".$company."'";
	}
	
	$sql = $this->db->query("SELECT
trans_pembelian_brg.id,
trans_pembelian_brg.kdtrans,
DATE_FORMAT(trans_pembelian_brg.tgl,'%d/%m/%Y') as tgl,
trans_pembelian_brg.sub_total_item,
trans_pembelian_brg.sub_total,
trans_pembelian_brg.potongan_persen,
trans_pembelian_brg.pajak_persen,
trans_pembelian_brg.total_akhir,
master_rekan_bisnis.nmrekan,
master_company.nm_outlet
FROM
trans_pembelian_brg
INNER JOIN master_rekan_bisnis ON trans_pembelian_brg.company_id = master_rekan_bisnis.idrekan
INNER JOIN master_company ON trans_pembelian_brg.outlet_id = master_company.outlet_id
WHERE trans_pembelian_brg.tgl >= '".$tgl1."' and trans_pembelian_brg.tgl <= '".$tgl2."' $qr");
	$i = 1;
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
        <td align="right"><?php echo number_format($rs->sub_total,2,",","."); ?></td>
        <td align="right"><?php echo number_format($rs->potongan_persen); ?></td>
        <td align="right"><?php echo number_format($rs->pajak_persen); ?></td>
        <td align="right"><?php echo number_format($rs->total_akhir,2,",","."); ?></td>
  	</tr>
<?php
		$i++;
	}
?>
</table>
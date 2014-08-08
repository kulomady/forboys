<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=pesanan_pembelian_detail_'.$tgl1."_".$tgl2.".xls");	
endif;
error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN RETUR PEMBELIAN DETAIL</title>
</head>
<link href="<?php echo base_url(); ?>css/style_doc.css" rel="stylesheet" type="text/css" />
<body>
<h2>LAPORAN RETUR PEMBELIAN DETAIL</h2>
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
<table border="0" cellpadding="3" cellspacing="1" width="100%">
  <tr align="center" bgcolor="#0099CC" height="40" valign="middle">
    <th width="170" colspan="2">No. Transaksi</th>
    <th width="170">Tanggal</th>
    <th width="200" colspan="3">Gudang</th>
    <th width="200" colspan="3">Supplier</th>
  </tr>
<?php
	$qr = "";
	if($outlet != 0){
		$qr .= "and trans_retur_brg.outlet_id = '".$outlet."'";
	}
	
	if($company != 0){
		$qr .= "and trans_pembelian_brg.company_id = '".$company."'";
	}
	
	$sql = $this->db->query("SELECT
trans_retur_brg.id,
trans_retur_brg.kdtrans,
DATE_FORMAT(trans_retur_brg.tgl,'%d/%m/%Y') as tgl,
trans_retur_brg.sub_total_item,
trans_retur_brg.sub_total,
trans_retur_brg.potongan_rupiah,
trans_retur_brg.pajak_rupiah,
trans_retur_brg.total_akhir,
master_rekan_bisnis.nmrekan,
master_company.nm_outlet
FROM
trans_retur_brg left join trans_pembelian_brg on trans_retur_brg.no_lpb = trans_pembelian_brg.kdtrans
INNER JOIN master_rekan_bisnis ON trans_pembelian_brg.company_id = master_rekan_bisnis.idrekan
INNER JOIN master_company ON trans_retur_brg.outlet_id = master_company.outlet_id
WHERE trans_retur_brg.tgl >= '".$tgl1."' and trans_retur_brg.tgl <= '".$tgl2."' $qr");
	
	$i = 1;
	$jml_item = 0;
	$total = 0;
	foreach($sql->result() as $rs){
		if($i%2){
			$color = '#fff';
		} else {			
			$color = '#B8E0F5';
		}
?>
	<tr bgcolor="<?php echo $color; ?>">
        <td colspan="2" align="center"><?php echo $rs->kdtrans; ?></td>
        <td align="center"><?php echo $rs->tgl; ?></td>
        <td colspan="3"><?php echo $rs->nm_outlet; ?></td>
        <td colspan="3"><?php echo $rs->nmrekan; ?></td>
  	</tr>
    <tr>
        <th><u>No.</u></th>
        <th><u>Kode Item</u></th>
        <th><u>Nama Item</u></th>
        <th><u>Jml Beli</u></th>
        <th><u>Satuan</u></th>
        <th><u>Harga</u></th>
        <th><u>Pot (%)</u></th>
        <th><u>Pajak (%)</u></th>
        <th><u>Total</u></th>
  	</tr>
<?php
	$child = $this->db->query("SELECT
trans_retur_brg_child.id,
trans_retur_brg_child.kdtrans,
trans_retur_brg_child.idbarang,
trans_retur_brg_child.qtyBeli,
trans_retur_brg_child.harga,
trans_retur_brg_child.disc,
trans_retur_brg_child.pajak,
trans_retur_brg_child.jumlah,
v_master_barang_detail.nmbarang,
v_master_barang_detail.nmsatuan
FROM
trans_retur_brg_child
INNER JOIN v_master_barang_detail ON trans_retur_brg_child.idbarang = v_master_barang_detail.idbarang
WHERE trans_retur_brg_child.kdtrans = '".$rs->kdtrans."'");
	$r = 1;
	$jml = 0;
	$num = $child->num_rows();
	foreach($child->result() as $ro){
?>
	<tr>
        <td align="center"><?php echo $r; ?></td>
        <td><?php echo $ro->idbarang; ?></td>
        <td><?php echo $ro->nmbarang; ?></td>
        <td align="right"><?php echo number_format($ro->qtyBeli); ?></td>
        <td align="center"><?php echo $ro->nmsatuan; ?></td>
        <td align="right"><?php echo number_format($ro->harga,2,",","."); ?></td>
        <td align="right"><?php echo number_format($ro->disc); ?></td>
        <td align="right"><?php echo number_format($ro->pajak); ?></td>
        <td align="right"><?php echo number_format($ro->jumlah,2,",","."); ?></td>
  	</tr>
<?php
		$jml = $jml + $ro->jumlah;	
		$r++;	
	}
?>
	<tr>
        <td colspan="9"></td>
  	</tr>
    <tr>
        <td colspan="2" align="center">Pot : <?php echo number_format($rs->potongan_rupiah,2,",","."); ?></td>
        <td colspan="2" align="center">Pajak : <?php echo number_format($rs->pajak_rupiah,2,",","."); ?></td>
        <td colspan="2"></td>
        <td align="right">Total Akhir :</td>
        <td colspan="2" align="right"><?php echo number_format($jml,2,",","."); ?></td>
  	</tr>
    <tr>
        <td colspan="9" valign="top"><hr /></td>
  	</tr>
<?php
		$jml_item = $jml_item + $num;
		$pot = $pot + $rs->potongan_rupiah;
		$pajak = $pajak + $rs->pajak_rupiah;
		$total = $total + $jml;
	}
?>
    <tr>
        <td colspan="9"></td>
  	</tr>
	<tr style="font-weight:bold;">
        <td colspan="6"></td>
        <td align="right">Jumlah Item :</td>
        <td colspan="2" align="right"><?php echo number_format($jml_item); ?></td>
  	</tr>
    <tr style="font-weight:bold;">
        <td colspan="6"></td>
        <td align="right">Subtotal :</td>
        <td colspan="2" align="right"><?php echo number_format($jml,2,",","."); ?></td>
  	</tr>
    <tr style="font-weight:bold;">
        <td colspan="6"></td>
        <td align="right">Potongan :</td>
        <td colspan="2" align="right"><?php echo number_format($pot,2,",","."); ?></td>
  	</tr>
    <tr style="font-weight:bold;">
        <td colspan="6"></td>
        <td align="right">Pajak :</td>
        <td colspan="2" align="right"><?php echo number_format($pajak,2,",","."); ?></td>
  	</tr>
    <?php $total_akhir = $total - $pot - $pajak; ?>
    <tr style="font-weight:bold;">
        <td colspan="6"></td>
        <td align="right">Total Akhir :</td>
        <td colspan="2" align="right"><?php echo number_format($total_akhir,2,",","."); ?></td>
  	</tr>
</table>
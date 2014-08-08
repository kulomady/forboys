<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>History Harga Beli</title>
</head>
<body>

<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=Rekapitulasi_Harian.xls');	
endif;
error_reporting(0);
?>
<style>
	td { font-family:Arial, Helvetica, sans-serif; font-size:12px; }
</style>
<table style="font-weight:bold; font-size:16px;">
	<tr>
		<td colspan="2"><h2>History Harga Beli</h2></td>
	</tr>
	<tr>
		<td width="100">Periode</td><td>: <?php echo $tgl_awal.' s/d '.$tgl_akhir; ?></td>
	</tr>
</table><br>

<table  width="100%" cellpadding="3" border="1" cellspacing="0">
	<tr style="font-weight:bold; background-color: #999;">
    	<td align="center" width="5%">No</td>
        <td align="center" width="20%">Kode & Nama Barang</td>
        <td align="center" colspan="4">Keterangan</td>
    </tr>
    <tr style="font-weight:bold; background-color: #999;">
    	<td align="center" width="5%">1</td>
        <td align="center" width="20%">2</td>
        <td align="center" colspan="4">3</td>
    </tr>
    <?php $sql = $this->db->query("select kd_barang, nmbarang from v_history_beli where tgl >= '".$awal."' and tgl <= '".$akhir."' group by kd_barang");
	$no = 1;
	foreach($sql->result() as $rs){
	?>
    	<tr style="font-weight:bold;">
            <td></td>
            <td></td>
            <td colspan="4"></td>
        </tr>
        <tr style="font-weight:bold; background-color: #FF9;">
            <td align="center"><?php echo $no; ?></td>
            <td colspan="5"><?php echo $rs->kd_barang.' - '.$rs->nmbarang; ?></td>
        </tr>
    	<tr style="font-weight:bold; background-color: #99F;">
            <td align="center"></td>
            <td align="center">No. Transaksi</td>
            <td align="center" width="10%">Tanggal Pembelian</td>
            <td align="center" width="25%">Nama Supplier</td>
            <td align="center" width="20%">Kode & Nama Barang</td>
            <td align="center">Harga Barang (satuan)</td>
        </tr>
    	<!-- Query Detail -->
		<?php $sql_trans = $this->db->query("select kdtrans, DATE_FORMAT(tgl,'%d/%m/%Y') as tgl, nmrekan, kd_barang, nmbarang, harga from v_history_beli where tgl >= '".$awal."' and tgl <= '".$akhir."' and kd_barang = '".$rs->kd_barang."' order by tgl asc"); 
        foreach($sql_trans->result() as $trans){
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $trans->kdtrans; ?></td>
            <td align="center"><?php echo $trans->tgl; ?></td>
            <td><?php echo $trans->nmrekan; ?></td>
            <td><?php echo $trans->kd_barang.' - '.$trans->nmbarang; ?></td>
            <td align="right" style="font-weight:bold;"><?php echo number_format($trans->harga,2,",","."); ?>&nbsp;&nbsp;</td>
        </tr>
		<?php 
		}
		$no++;
	}
	?>
</table>
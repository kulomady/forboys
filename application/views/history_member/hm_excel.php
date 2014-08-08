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
		<td colspan="2"><h2>Report Insentif</h2></td>
	</tr>
	<tr>
		<td width="100">Periode</td><td>: <?php echo $tgl_awal.' s/d '.$tgl_akhir; ?></td>
	</tr>
</table><br>

<table  width="100%" cellpadding="3" border="1" cellspacing="0">
	<tr style="font-weight:bold; background-color: #999;">
    	<td align="center" width="5%">No</td>
        <td align="center" width="20%">Kode & Nama Member</td>
        <td align="center" colspan="5">Keterangan</td>
    </tr>
    <tr style="font-weight:bold; background-color: #999;">
    	<td align="center" width="5%">1</td>
        <td align="center" width="20%">2</td>
        <td align="center" colspan="5">3</td>
    </tr>
    <?php $sql = $this->db->query("select kode_member, nama_member from v_history_member where tgl >= '".$awal."' and tgl <= '".$akhir."' group by kode_member");
	$no = 1;
	foreach($sql->result() as $rs){
		//total insentif
		
	?>
    	<tr style="font-weight:bold;">
            <td></td>
            <td></td>
            <td colspan="5"></td>
        </tr>
        <tr style="font-weight:bold; background-color: #FF9;">
            <td align="center"><?php echo $no; ?></td>
            <td colspan="6"><?php echo $rs->kode_member.' - '.$rs->nama_member; ?></td>
        </tr>
    	<tr style="font-weight:bold; background-color: #99F;">
            <td align="center"></td>
            <td align="center">No. Transaksi</td>
            <td align="center" width="10%">Tanggal Transaksi</td>
            <td align="center" width="25%">Nama Member</td>
            <td align="center" width="15%">Jumlah Transaksi</td>
            <td align="center" width="10%"><?php if($status=='1'){ echo "Treshold"; } else { echo "Persen (%)"; } ?></td>
            <td align="center">Insentif</td>
        </tr>
    	<!-- Query Detail -->
		<?php $sql_trans = $this->db->query("select no_trans, DATE_FORMAT(tgl,'%d/%m/%Y') as tgl, nama_member, nilai, persen, hasil from v_history_member where tgl >= '".$awal."' and tgl <= '".$akhir."' and kode_member = '".$rs->kode_member."' order by tgl asc"); 
        $total = 0;
		foreach($sql_trans->result() as $trans){
			if($status=='0'){
				$persen = $trans->persen;
			} else {
				$persen = number_format($trans->persen,2,",",".");
			}
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $trans->no_trans; ?></td>
            <td align="center"><?php echo $trans->tgl; ?></td>
            <td><?php echo $trans->nama_member; ?></td>
            <td align="right"><?php echo number_format($trans->nilai,2,",","."); ?>&nbsp;&nbsp;</td>
            <td align="right"><?php echo $persen; if($status=='0'){ echo "%"; } ?> &nbsp;&nbsp;</td>
            <td align="right" style="font-weight:bold;"><?php echo number_format($trans->hasil,2,",","."); ?>&nbsp;&nbsp;</td>
        </tr>
		<?php
			$total = $total + $trans->hasil; 
		}
		?>
        <tr>
            <td colspan="6" align="right" style="font-weight:bold;">Total Insentif &nbsp;&nbsp;</td>
            <td align="right" style="font-weight:bold;"><u><?php echo number_format($total,2,",","."); ?></u>&nbsp;&nbsp;</td>
        </tr>
        <?php
		$no++;
	}
	?>
</table>
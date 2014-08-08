<?php 
if($type=='EXCEL'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=kartu-stock'.$tglAwal."_".$tglAkhir.".xls");	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Kartu Stock :.</title>
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<h2>KARTU STOCK</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Periode</td>
    <td width="192">: <?php echo $tglAwal."-".$tglAkhir; ?></td>
    <td width="94">Nama Barang</td>
    <td width="321">: <?php echo str_replace('%20',' ',$nmbarang); if($size=="0") { echo ""; } else { echo " ".$size; } ?></td>
  </tr>
  <tr>
    <td>Gudang</td>
    <td>: <?php echo $nmGudang; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="958" border="0" cellspacing="0">
  <tr>
    <td width="31" bgcolor="#3399FF"><div align="center"><strong>No</strong></div></td>
    <td width="85" bgcolor="#3399FF"><div align="center"><strong>Tanggal</strong></div></td>
    <td width="144" bgcolor="#3399FF">No Trans</td>
    <td width="94" bgcolor="#3399FF"><div align="center"><strong># Kode</strong></div></td>
    <td width="220" bgcolor="#3399FF"><div align="center"><strong>Nama Barang</strong></div></td>
    <td width="56" bgcolor="#3399FF"><div align="center"><strong>Satuan</strong></div></td>
    <td width="140" bgcolor="#3399FF"><div align="center"><strong>Transaksi</strong></div></td>
    <td width="55" bgcolor="#3399FF"><div align="center"><strong>Masuk</strong></div></td>
    <td width="51" bgcolor="#3399FF"><div align="center"><strong>Keluar</strong></div></td>
    <td width="62" bgcolor="#3399FF"><div align="center"><strong>Saldo</strong></div></td>
  </tr>
  <?php 
  $qrSize = "";
  if($size != "0") {
  	$qrSize = "and b.idsize = '".$size."'";
  }
  if($tmpUkuran == '1') {
  		$group = "group by a.idbarang,a.notrans";
		$lebelBrg = "concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize)";
		$lebelID = "a.idbarang";
		$orderby = "order by a.tgl,a.idbarang asc";
  } else {
  		$group = "group by b.idgroup_barang,a.notrans";
		$lebelBrg = "concat(b.nmbarang,' ',b.nmwarna)";
		$lebelID = "b.idgroup_barang";
		$orderby = "order by a.tgl,b.idgroup_barang asc";
  }
  $no=1;
  $J1 = 0; $J2 = 0;
  $saldo = 0;
 $sql = $this->db->query("select a.tgl,a.notrans,$lebelID as idbarang,$lebelBrg as nmbarang,b.nmsatuan,
 sum(a.qty_sa) as qty_sa,
 sum(a.qty_beli_in) as qty_beli_in,
 sum(a.qty_transfer_in) as qty_transfer_in,
 sum(a.qty_retur_in) as qty_retur_in,
 sum(a.qty_transfer_out) as qty_transfer_out,
 sum(a.qty_jual_out) as qty_jual_out,
 sum(a.qty_retur_out) as qty_retur_out,
 sum(a.qty_adj_opname) as qty_adj_opname
 from rpt_stock a 
 	inner join v_master_barang_detail b on a.idbarang = b.idbarang where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' and a.outlet_id = '".$gudang."' and b.idbarang_induk = '".$idbarang."' $qrSize $group $orderby");
	// group by a.idbarang,a.notrans
  foreach($sql->result() as $rs) {
  
	  if($no%2==0) {
		$bg = "#C7E2F3";
	  } else {
		$bg = "#FFFFFF";
	  }
	  $masuk = 0; $keluar = 0; $nmTrans = "";
	  if($rs->qty_sa != ""):
	  		$nmTrans = "Stock Awal";
			$masuk = $rs->qty_sa;
	  endif;
	  if($rs->qty_beli_in != ""):
	  		$nmTrans = "Beli";
			$masuk = $rs->qty_beli_in;
	  endif;
	   if($rs->qty_transfer_in != ""):
	  		$nmTrans = "Kirim";
			$masuk = $rs->qty_transfer_in;
	  endif;
	  if($rs->qty_retur_in != ""):
	  		$nmTrans = "Retur Jual";
			$masuk = $rs->qty_retur_in;
	  endif;
	  if($rs->qty_transfer_out != ""):
	  		$nmTrans = "Transfer Barang";
			$keluar = $rs->qty_transfer_out;
	  endif;
	  if($rs->qty_jual_out != ""):
	  		$nmTrans = "Jual";
			$keluar = $rs->qty_jual_out;
	  endif;
	  if($rs->qty_retur_out != ""):
	  		$nmTrans = "Retur Beli";
			$keluar = $rs->qty_retur_out;
	  endif;
	  if($rs->qty_adj_opname != ""):
	  		$nmTrans = "Selisih Opname";
			if($rs->qty_adj_opname >=0) {
				$masuk = $rs->qty_adj_opname;
			} else {
				$keluar = $rs->qty_adj_opname * -1;
			}
	  endif;
	  $saldo = $saldo + ($masuk - $keluar);
	  
  ?>
  <tr>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $no; ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->tgl; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->notrans; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->idbarang; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmbarang; if($size=="0") { echo ""; } else { echo " ".$size; } ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmsatuan; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $nmTrans; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($masuk); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($keluar); ?>
    </div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_angka($saldo); ?></div></td>
  </tr>
  <?php 
  	$no++;
	$J1 = $J1 + $masuk; 
	$J2 = $J2 + $keluar; 
  } ?>
  <tr>
    <td colspan="5" bgcolor="#FF9933"><strong>JUMLAH</strong></td>
    <td bgcolor="#FF9933">&nbsp;</td>
    <td bgcolor="#FF9933">&nbsp;</td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J1); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J2); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

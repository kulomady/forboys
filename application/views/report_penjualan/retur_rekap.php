<?php 
if($type=='EXCEL'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=retur_rekap'.$tgl1."_".$tgl2.".xls");	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Laporan Retur Rekap :.</title>
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 11px;">
<h2>LAPORAN RETUR REKAP</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Periode</td>
    <td width="192">: <?php echo $tgl1." s.d ".$tgl2; ?></td>
    <td width="94">Gudang</td>
    <td width="321">: <?php if($pelanggan=="0") { echo "Semua"; } else { echo $gudang."-".$nmGudang; } ?></td>
  </tr>
  <tr>
    <td>Pelanggan</td>
    <td>: <?php if($pelanggan=="0") { echo "Semua"; } else { echo $pelanggan.'-'.$nmPelanggan; } ?></td>
    <td>Sales</td>
    <td>: <?php if($pelanggan=="0") { echo "Semua"; } else { echo $sales.'-'.$nmSales; } ?></td>
  </tr>
</table>
<table width="1211" border="0" cellspacing="1">
  <tr>
    <td width="28" bgcolor="#3399FF"><div align="center"><strong>No</strong></div></td>
    <td width="113" bgcolor="#3399FF"><div align="center"><strong># No.Transaksi</strong></div></td>
    <td width="62" bgcolor="#3399FF"><div align="center"><strong>Tanggal</strong></div></td>
    <td width="177" bgcolor="#3399FF"><div align="center"><strong>Gudang</strong></div></td>
    <td width="109" bgcolor="#3399FF"><div align="center"><strong>Pelanggan</strong></div></td>
    <td width="125" bgcolor="#3399FF"><div align="center"><strong>Sales</strong></div></td>
    <td width="59" bgcolor="#3399FF"><div align="center"><strong>Jml Item</strong></div></td>
    <td width="74" bgcolor="#3399FF"><div align="center"><strong>Sub Total</strong></div></td>
    <td width="39" bgcolor="#3399FF"><div align="center"><strong>Pot</strong> %</div></td>
    <td width="52" bgcolor="#3399FF"><div align="center"><strong>Pajak %</strong></div></td>
    <td width="84" bgcolor="#3399FF"><div align="center"><strong>Biaya Lain</strong></div></td>
    <td width="92" bgcolor="#3399FF"><div align="center"><strong>Total Akhir</strong></div></td>
    <td width="59" bgcolor="#3399FF"><div align="center"><strong>DP/Tunai</strong></div></td>
    <td width="95" bgcolor="#3399FF"><div align="center"><strong>Pot.Piutang</strong></div></td>
  </tr>
  <?php 
  $qr = "";
  $join = "";
  if($pelanggan != "0"):
		$qr .= " and c.idrekan = '".$pelanggan."'";
  endif;
  if($sales != "0"):
		$qr .= " and c.idsales = '".$sales."'";
  endif;
  if($gudang != "0") {
		$qr .= " and a.outlet_id = '".$gudang."'";
  } else {
  	$join = " inner join sys_hak_outlet f on a.outlet_id = f.outlet_id and group_id = '".$this->session->userdata('group_id')."'";
  }
  $no=1;
  $J1 = 0; $J2 = 0; $J3 = 0; $J4 = 0; $J5 = 0; $J6 = 0; $J7 = 0; $J8 = 0;
  $sql = $this->db->query("select 
  	a.id,
	a.kdtrans,
	a.tgl,
	a.outlet_id,
	c.idrekan,
	c.idsales,
	a.jml_qty as jmlPesan,
	a.subtotal,
	a.disc_persen,a.tax_persen,
	a.pajak_biaya,
	a.biaya_lain,
	a.grand_total,
	a.tunai,
	a.pot_piutang,
	a.created,
	a.created_by,
	b.nm_outlet,
  d.nmrekan as pelanggan,
  e.nmrekan as sales
	from tr_retur_penjualan a inner join master_company b on a.outlet_id = b.outlet_id 
	left JOIN tr_penjualan c on a.kdpenjualan = c.kdtrans
	left join master_rekan_bisnis d on c.idrekan = d.idrekan
	left join master_rekan_bisnis e on c.idsales = e.idrekan $join
	where a.tgl >= '".$tgl1."' and a.tgl <= '".$tgl2."' $qr");
  foreach($sql->result() as $rs) {
  
  if($no%2==0) {
  	$bg = "#C7E2F3";
  } else {
  	$bg = "#FFFFFF";
  }
  ?>
  <tr>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $no; ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->kdtrans; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->tgl; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->outlet_id."-".$rs->nm_outlet; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->idrekan."-".$rs->pelanggan; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->idsales."-".$rs->sales; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_angka($rs->jmlPesan); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($rs->subtotal); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_uang($rs->disc_persen); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_uang($rs->tax_persen); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($rs->biaya_lain); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($rs->grand_total); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($rs->tunai); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($rs->pot_piutang); ?></div></td>
  </tr>
  <?php 
  	$no++;
	 $J1 = $J1 + $rs->jmlPesan; 
	 $J3 = $J3 + $rs->subtotal; 
	 $J4 = $J4 + $rs->biaya_lain; 
	 $J5 = $J5 + $rs->grand_total; 
	 $J6 = $J6 + $rs->tunai; 
	 $J7 = $J7 + $rs->pot_piutang; 
	 $J8 = $J8;// + $rs->kurang; 
  } ?>
  <tr>
    <td colspan="5" bgcolor="#FF9933"><strong>JUMLAH</strong></td>
    <td bgcolor="#FF9933">&nbsp;</td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_angka($J1); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J3); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J4); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J5); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J6); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J7); ?></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

<?php 
if($type=='EXCEL'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=mutasi_stock'.$tglStock.".xls");	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Mutasi Stock :.</title>
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 11px;">
<h2>LAPORAN MUTASI STOCK Konsolidasi</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Tanggal Stock</td>
    <td width="192">: <?php echo $tglStock; ?></td>
    <td width="94">Type Harga</td>
    <td width="321">: 
    <?php echo $jnsHrg; ?></td>
  </tr>
</table>
<table width="1119" border="0" cellspacing="1">
  <tr>
    <td width="31" rowspan="3" bgcolor="#3399FF"><div align="center"><strong># No</strong></div></td>
    <td width="81" rowspan="3" bgcolor="#3399FF"><div align="center"><strong>Kode Item</strong></div></td>
    <td width="155" rowspan="3" bgcolor="#3399FF"><div align="center"><strong>Nama Item</strong></div></td>
    <td width="43" rowspan="3" bgcolor="#3399FF"><div align="center"><strong>Satuan</strong></div></td>
    <td colspan="2" rowspan="2" bgcolor="#3399FF"><div align="center"><strong>Stock Awal</strong></div></td>
    <td colspan="5" align="center" bgcolor="#3399FF"><strong>Stock Masuk</strong></td>
    <td colspan="5" align="center" bgcolor="#3399FF"><strong>Stock Keluar</strong></td>
    <td colspan="2" rowspan="2" bgcolor="#3399FF"><div align="center"><strong>Stock Akhir</strong></div></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#3399FF"><strong>Beli</strong></td>
    <td colspan="3" align="center" bgcolor="#3399FF"><div align="center"><strong>Retur Jual</strong></div></td>
    <td colspan="2" align="center" bgcolor="#3399FF"><strong>Retur Beli</strong></td>
    <td colspan="3" align="center" bgcolor="#3399FF"><div align="center"><strong>Jual</strong></div></td>
  </tr>
  <?php 
  $qr = "";
  if($tipe != "null"):
		$qr .= " and c.idtipe_item = '".$tipe."'";
  endif;
  if($jns != "null"):
		$qr .= " and c.idjns_item = '".$jns."'";
  endif;
  if($kat != "null"):
		$qr .= " and c.idkategori = '".$kat."'";
  endif;
  if($merk != "null"):
		$qr .= " and c.idmerk = '".$merk."'";
  endif;
  if($warna != "null"):
		$qr .= " and c.idwarna = '".$warna."'";
  endif;
		
  $arr = explode("-",$tglStock);
  $tglStockAwal = $arr[0].'-'.$arr[1].'-01';
  $no=1;
  $J1 = 0; $J2 = 0; $J3 = 0; $J4 = 0; $J5 = 0; $J6 = 0; $J7 = 0; $J8 = 0; $J9 = 0; $J10 = 0; $J11 = 0; $J12 = 0; $J13 = 0; $J14 = 0; $J15 = 0; $J16 = 0; $J17 = 0; $J18 = 0;
  
  ?>
  <tr>
    <td width="43" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="60" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="42" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="72" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="46" align="center" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="63" align="center" bgcolor="#3399FF"><strong>Jumlah</strong></td>
    <td width="59" align="center" bgcolor="#3399FF"><div align="center"><strong>Pot</strong></div></td>
    <td width="43" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="71" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="46" align="center" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="59" align="center" bgcolor="#3399FF"><strong>Jumlah</strong></td>
    <td width="56" align="center" bgcolor="#3399FF"><div align="center"><strong>Pot</strong></div></td>
    <td width="37" align="center" bgcolor="#3399FF"><strong>Qty</strong></td>
    <td width="57" align="center" bgcolor="#3399FF"><strong>Jumlah</strong></td>
  </tr>
  <?php 
  $sql = $this->db->query("select 
			a.idbarang,
			concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang,
			b.nmsatuan,
			sum(a.qty_sa) as qty_sa,
			sum(a.jml_sa) as jml_sa,
			sum(a.hrgjual_sa * a.qty_sa) as jml_hrgJual_sa,
			sum(a.qty_beli_in) as qty_beli_in,
			sum(a.jml_beli_in) as jml_beli_in,
			sum(a.hrgjual_beli_in * a.qty_beli_in) as jml_hrgjual_beli_in,
			sum(a.qty_retur_in) as qty_retur_in,
			sum(a.jml_retur_in) as jml_retur_in,
			sum(a.qty_retur_out) as qty_retur_out,
			sum(a.jml_retur_out) as jml_retur_out,
			sum(a.qty_retur_out * a.hrgjual_retur_out) as jml_hrgjual_retur_out,
			sum(a.qty_jual_out) as qty_jual_out,
			sum(a.jml_jual_out) as jml_jual_out,
			c.hpp as hpp
			from rpt_stock a 
			inner join v_master_barang_detail b on a.idbarang = b.idbarang left join sys_hpp c on b.idbarang_induk = c.idbarang
			where a.tgl >= '".$tglStockAwal."' and a.tgl <= '".$tglStock."' $qr group by a.idbarang");
  foreach($sql->result() as $rs) {
  
   if($no%2==0) {
  	$bg = "#C7E2F3";
  } else {
  	$bg = "#FFFFFF";
  }
  
  if($jnsHrg=='BELI') {
  		// transaksi in
  		$jml_sa = $rs->jml_sa;
		$jml_beli_in = $rs->jml_beli_in;
		$jml_retur_in = $rs->qty_retur_in * $rs->hpp;
		
		$jml_hrgjual_retur_out = $rs->jml_retur_out;
		$jml_hrgbeli_jual_out = $rs->qty_jual_out * $rs->hpp;
		
		$potJual = 0;
		$potReturJual = 0;
  } else {
  		// transaksi in
  		$jml_sa = $rs->jml_hrgJual_sa; // * $rs->hrgjual_sa;
		$jml_beli_in = $rs->jml_hrgjual_beli_in;
		$jml_retur_in = $rs->jml_retur_in;
		
		$jml_hrgjual_retur_out = $rs->jml_hrgjual_retur_out;
		$jml_hrgbeli_jual_out = $rs->jml_jual_out;
		
		if($jml_sa != "") {
			$hargaJual = $jml_sa / $rs->qty_sa;
		} else if($jml_retur_in != "") {
			$hargaJual = $jml_retur_in / $rs->qty_retur_in;	
		}
		
		$potJual = ($rs->qty_jual_out * $hargaJual) - $jml_hrgbeli_jual_out;
		$potReturJual = ($rs->qty_retur_in * $hargaJual) - $jml_retur_in;
  }
  
  $qty_akhir = ($rs->qty_sa  + $rs->qty_beli_in + $rs->qty_retur_in) - ($rs->qty_retur_out + $rs->qty_jual_out);
  $jml_akhir = ($jml_sa  + $jml_beli_in + $jml_retur_in + $potReturJual) - ($jml_hrgjual_retur_out + $jml_hrgbeli_jual_out + $potJual);
  
  ?>
  <tr>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $no; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->idbarang; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmbarang; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmsatuan; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($rs->qty_sa); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($jml_sa); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($rs->qty_beli_in); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($jml_beli_in); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($rs->qty_retur_in); ?></div></td>
    <td align="right" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_uang($jml_retur_in); ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($potReturJual); ?></div></td>
    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($rs->qty_retur_out); ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($jml_hrgjual_retur_out); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($rs->qty_jual_out); ?></div></td>
    <td align="right" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_uang($jml_hrgbeli_jual_out); ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($potJual); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($qty_akhir); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($jml_akhir); ?></div></td>
  </tr>
 
  <?php 
  	$no++;
	$J1 = $J1 + $rs->qty_sa;
	$J2 = $J2 + $jml_sa; 
	
	$J3 = $J3 + $rs->qty_beli_in;
	$J4 = $J4 + $jml_beli_in; 
	
	$J5 = $J5 + $rs->qty_retur_in;
	$J6 = $J6 + $jml_retur_in; 
	$J7 = $J7 + $potReturJual;
	
	$J8 = $J8 + $rs->qty_retur_out;
	$J9 = $J9 + $jml_hrgjual_retur_out;
	
	$J10 = $J10 + $rs->qty_jual_out;
	$J11 = $J11 + $jml_hrgbeli_jual_out;
	$J12 = $J12 + $potJual;
	
	$J13 = $J13 + $qty_akhir;
	$J14 = $J14 + $jml_akhir;
	
  } ?>
  <tr>
    <td colspan="4" bgcolor="#FF9933"><strong>JUMLAH</strong></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J1); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J2); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J3); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J4); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J5); ?></div></td>
    <td align="right" bgcolor="#FF9933"><?php echo $this->msistem->format_uang($J6); ?></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J7); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J8); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J9); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J10); ?></div></td>
    <td align="right" bgcolor="#FF9933"><?php echo $this->msistem->format_uang($J11); ?></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J12); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J13); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J14); ?></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

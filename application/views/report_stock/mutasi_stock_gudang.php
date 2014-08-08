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
<h2>LAPORAN MUTASI STOCK Gudang</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Tanggal Stock</td>
    <td width="192">: <?php echo $tglStock; ?></td>
    <td width="94">Type Harga</td>
    <td width="321">: 
    <?php echo $jnsHrg; ?></td>
  </tr>
  <tr>
    <td>Gudang Asal</td>
    <td colspan="3">: <?php if($gudangAsal=="0") { echo "Semua"; } else { echo $gudangAsal.'-'.$nmGudang; } ?></td>
  </tr>
</table>
<table width="1307" border="0" cellspacing="1">
  <tr>
    <td width="27" rowspan="3" bgcolor="#3399FF"><div align="center"><strong># No</strong></div></td>
    <td width="86" rowspan="3" bgcolor="#3399FF"><div align="center"><strong>Kode Item</strong></div></td>
    <td width="204" rowspan="3" bgcolor="#3399FF"><div align="center"><strong>Nama Item</strong></div></td>
    <td width="44" rowspan="3" bgcolor="#3399FF"><div align="center"><strong>Satuan</strong></div></td>
    <td colspan="2" rowspan="2" bgcolor="#3399FF"><div align="center"><strong>Stock Awal</strong></div></td>
    <td colspan="4" align="center" bgcolor="#3399FF"><strong>Stock Masuk</strong></td>
    <td colspan="4" align="center" bgcolor="#3399FF"><strong>Stock Keluar</strong></td>
    <td colspan="2" rowspan="2" bgcolor="#3399FF"><div align="center"><strong>Stock Akhir</strong></div></td>
    <td colspan="2" rowspan="2" align="center" bgcolor="#3399FF"><strong>Outstanding</strong></td>
    <td colspan="2" rowspan="2" align="center" bgcolor="#3399FF"><strong>Stock Akhir + Oustanding</strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#3399FF"><div align="center"><strong>Beli</strong></div></td>
    <td colspan="2" align="center" bgcolor="#3399FF"><strong>Trans Masuk</strong></td>
    <td colspan="2" align="center" bgcolor="#3399FF"><strong>Trans Keluar</strong></td>
    <td colspan="2" align="center" bgcolor="#3399FF"><div align="center"><strong>Retur Beli</strong></div></td>
  </tr>
  <?php 
  $qr = "";
  $join = "";
  if($gudangAsal != "0") {
		$qr .= " and a.outlet_id = '".$gudangAsal."'";
  } else {
  		$join = " inner join sys_hak_outlet f on a.outlet_id = f.outlet_id and f.group_id = '".$this->session->userdata('group_id')."'";
  }
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
    <td width="44" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="73" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="38" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="67" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="39" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="70" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="45" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="73" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="47" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="73" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="32" align="center" bgcolor="#3399FF"><strong>Qty</strong></td>
    <td width="70" align="center" bgcolor="#3399FF"><strong>Jumlah</strong></td>
    <td width="29" align="center" bgcolor="#3399FF"><strong>Qty</strong></td>
    <td width="67" align="center" bgcolor="#3399FF"><strong>Jumlah</strong></td>
    <td width="43" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="75" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
  </tr>
  <?php 
  $sql = $this->db->query("select rpt.*,d.hpp from (select 
			a.idbarang,
			concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang,
			b.nmsatuan,
			sum(a.qty_sa) as qty_sa,
			sum(a.jml_sa) as jml_sa,
			sum(a.hrgjual_sa * a.qty_sa) as jml_hrgJual_sa,
			sum(a.qty_beli_in) as qty_beli_in,
			sum(a.jml_beli_in) as jml_beli_in,
			sum(a.hrgjual_beli_in * a.qty_beli_in) as jml_hrgjual_beli_in,
			sum(a.qty_transfer_in) as qty_transfer_in,
			sum(a.jml_transfer_in) as jml_transfer_in,
			sum(a.hrgbeli_transfer_in * a.qty_transfer_in) as jml_hrgbeli_transfer_in,
			sum(a.qty_transfer_out) as qty_transfer_out,
			sum(a.jml_transfer_out) as jml_transfer_out,
			sum(a.qty_transfer_out * a.hrgbeli_transfer_out) as jml_hrgbeli_transfer_out,
			sum(a.qty_retur_out) as qty_retur_out,
			sum(a.jml_retur_out) as jml_retur_out,
			sum(a.qty_retur_out * a.hrgjual_retur_out) as jml_hrgjual_retur_out ,
			sum(a.outstanding) as outstanding,
			sum(a.jml_outstanding) as jml_outstanding,
			b.idbarang_induk
			from rpt_stock a 
			inner join v_master_barang_detail b on a.idbarang = b.idbarang inner join master_company mc on a.outlet_id = mc.outlet_id $join 
			where a.tgl >= '".$tglStockAwal."' and a.tgl <= '".$tglStock."' and mc.type = 'GUDANG' $qr group by a.idbarang) as rpt left join sys_hpp d on rpt.idbarang_induk = d.idbarang");
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
		$jml_transfer_in = $rs->qty_transfer_in * $rs->hpp;
		
		$jml_transfer_out = $rs->qty_transfer_out * $rs->hpp;
		$jml_hrgjual_retur_out = $rs->jml_retur_out;
		
		$jml_outstanding = $rs->outstanding * $rs->hpp;
  } else {
  		// transaksi in
  		$jml_sa = $rs->jml_hrgJual_sa; // * $rs->hrgjual_sa;
		$jml_beli_in = $rs->jml_hrgjual_beli_in;
		$jml_transfer_in = $rs->jml_transfer_in;
		
		$jml_transfer_out = $rs->jml_transfer_out;
		$jml_hrgjual_retur_out = $rs->jml_hrgjual_retur_out;
		$jml_outstanding = $rs->jml_outstanding;
  }
  
  $qty_akhir = ($rs->qty_sa + $rs->qty_beli_in + $rs->qty_transfer_in) - ($rs->qty_transfer_out + $rs->qty_retur_out);
  $jml_akhir = ($jml_sa + $jml_beli_in + $jml_transfer_in) - ($jml_transfer_out + $jml_hrgjual_retur_out);
  
  $qty_ending = $qty_akhir + $rs->outstanding;
  $jml_ending = $jml_akhir + $jml_outstanding;
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
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($rs->qty_transfer_in); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($jml_transfer_in); ?></div></td>
    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($rs->qty_transfer_out); ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($jml_transfer_out); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($rs->qty_retur_out); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($jml_hrgjual_retur_out); ?></div></td>
    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($qty_akhir); ?></td>
    <td align="right" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_uang($jml_akhir); ?></td>
    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($rs->outstanding); ?></td>
    <td align="right" bgcolor="<?php echo $bg; ?>"><?php echo $this->msistem->format_uang($jml_outstanding); ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($qty_ending); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_angka($jml_ending); ?></div></td>
  </tr>
 
  <?php 
  	$no++;
	$J1 = $J1 + $rs->qty_sa;
	$J2 = $J2 + $jml_sa; 
	$J3 = $J3 + $rs->qty_beli_in;
	$J4 = $J4 + $jml_beli_in;
	$J5 = $J5 + $rs->qty_transfer_in;
	$J6 = $J6 + $jml_transfer_in;
	$J9 = $J9 + $rs->qty_transfer_out;
	$J10 = $J10 + $jml_transfer_out;
	$J13 = $J13 + $rs->qty_retur_out;
	$J14 = $J14 + $jml_hrgjual_retur_out;
	$J15 = $J15 + $qty_akhir;
	$J16 = $J16 + $jml_akhir;
	
	$J7 = $J7 + $rs->outstanding;
	$J8 = $J8 + $jml_outstanding;
	
	$J11 = $J11 + $qty_ending;
	$J12 = $J12 + $jml_ending;
  } ?>
  <tr>
    <td colspan="4" bgcolor="#FF9933"><strong>JUMLAH</strong></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J1); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J2); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J3); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J4); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J5); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J6); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J9); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J10); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J13); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"<?php echo $this->msistem->format_uang($J14); ?>></div></td>
    <td align="center" bgcolor="#FF9933"><?php echo $this->msistem->format_angka($J15); ?></td>
    <td align="right" bgcolor="#FF9933"><?php echo $this->msistem->format_uang($J16); ?></td>
    <td align="center" bgcolor="#FF9933"><?php echo $this->msistem->format_angka($J7); ?></td>
    <td align="right" bgcolor="#FF9933"><?php echo $this->msistem->format_angka($J8); ?></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J11); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($J12); ?></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

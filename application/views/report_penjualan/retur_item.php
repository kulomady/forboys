<?php 
if($type=='EXCEL'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=retur_item'.$tgl1."_".$tgl2.".xls");	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Laporan Retur Penjualan Per-Item :.</title></head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<h2>LAPORAN RETUR PENJUALAN PER-ITEM</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Periode</td>
    <td width="192">: <?php echo $tgl1." s.d ".$tgl2; ?></td>
    <td width="94">&nbsp;</td>
    <td width="321">&nbsp;</td>
  </tr>
  <tr>
    <td>Gudang</td>
    <td>: <?php if($gudangAsal=="0") { echo "Semua"; } else { echo $gudangAsal."-".$nmGudang; } ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="824" border="0" cellspacing="1">
  <tr>
    <td width="28" bgcolor="#3399FF"><div align="center"><strong>No</strong></div></td>
    <td width="86" bgcolor="#3399FF"><div align="center"><strong>Kode Item</strong></div></td>
    <td width="215" bgcolor="#3399FF"><div align="center"><strong>Nama Item</strong></div></td>
    <td width="46" bgcolor="#3399FF"><div align="center"><strong>Satua</strong>n</div></td>
    <td width="59" bgcolor="#3399FF"><div align="center"><strong>Qty</strong></div></td>
    <td width="66" bgcolor="#3399FF"><div align="center"><strong>Harga</strong></div></td>
    <td width="49" bgcolor="#3399FF"><div align="center"><strong>Pot</strong> %</div></td>
    <td width="45" bgcolor="#3399FF"><div align="center"><strong>Pot 2 %</strong></div></td>
    <td width="48" bgcolor="#3399FF"><div align="center"><strong>Pot 3 %</strong></div></td>
    <td width="53" bgcolor="#3399FF"><div align="center"><strong>Pot 4 %</strong></div></td>
    <td width="95" bgcolor="#3399FF"><div align="center"><strong>Sub Total</strong></div></td>
  </tr>
  <?php 
  $qr = "";
  $join = "";
 
  if($gudangAsal != "0") {
		$qr .= " and b.outlet_id = '".$gudangAsal."'";
  } else {
  	$join = " inner join sys_hak_outlet f on b.outlet_id = f.outlet_id and group_id = '".$this->session->userdata('group_id')."'";
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
  
  // Group
  if($grup=='TIPE') {
  		$kode = "c.idtipe_item";
		$nm = "c.nmtipe";
  } elseif($grup=='JENIS') {
  		$kode = "c.idjns_item";
		$nm = "c.nmjenis";
  } elseif($grup=='KATEGORI') {
 		$kode = "c.idkategori";
		$nm = "c.nmkategori";
  } elseif($grup=='MERK') {
  		$kode = "c.idmerk";
		$nm = "c.nmmerk";
  } elseif($grup=='WARNA') {
  		$kode = "c.idwarna";
		$nm = "c.nmwarna";
  }
		
  $no=1;
  $T1 = 0; $T2 = 0;
  $sqlM = $this->db->query("select 
		$kode as kodeGrup,
		$nm as nmGrup
		from 
		tr_retur_penjualan_detail a inner join tr_retur_penjualan b on a.kdtrans = b.kdtrans
		left join v_master_barang_detail c on a.idbarang = c.idbarang $join 
		where b.tgl >= '".$tgl1."' and b.tgl <= '".$tgl2."' $qr group by $kode");
  foreach($sqlM->result() as $rsM) {
  ?>
   <tr>
    <td colspan="11"><strong><?php echo $rsM->kodeGrup." - ".$rsM->nmGrup; ?></strong></td>
  </tr>
  <?php
   $J1 = 0; $J2 = 0;
  if($tmpUkuran == '1') {
	  $sql = $this->db->query("select 
		a.kdtrans,
		a.idbarang,
		concat(c.nmbarang,' ',c.nmwarna,' ',c.nmsize) as nmbarang,
		c.nmsatuan,
		sum(a.qty) as qty,
		a.harga,
		a.disc_1,
		a.disc_2,
		a.disc_3,
		a.disc_4,
		sum(a.total) as total 
		from 
		tr_retur_penjualan_detail a inner join tr_retur_penjualan b on a.kdtrans = b.kdtrans
		left join v_master_barang_detail c on a.idbarang = c.idbarang $join 
		where b.tgl >= '".$tgl1."' and b.tgl <= '".$tgl2."' and $kode = '".$rsM->kodeGrup."' $qr 
		group by a.idbarang,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4 
		order by a.idbarang asc");
  } else {
  	  $sql = $this->db->query("select 
		a.kdtrans,
		c.idgroup_barang as idbarang,
		concat(c.nmbarang,' ',c.nmwarna) as nmbarang,
		c.nmsatuan,
		sum(a.qty) as qty,
		a.harga,
		a.disc_1,
		a.disc_2,
		a.disc_3,
		a.disc_4,
		sum(a.total) as total 
		from 
		tr_retur_penjualan_detail a inner join tr_retur_penjualan b on a.kdtrans = b.kdtrans
		left join v_master_barang_detail c on a.idbarang = c.idbarang $join 
		where b.tgl >= '".$tgl1."' and b.tgl <= '".$tgl2."' and $kode = '".$rsM->kodeGrup."' $qr 
		group by c.idgroup_barang,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4 
		order by c.idgroup_barang asc");	
  }
  foreach($sql->result() as $rs) {
  
	  if($no%2==0) {
		$bg = "#C7E2F3";
	  } else {
		$bg = "#FFFFFF";
	  }
  ?>
 
  <tr>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $no; ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->idbarang; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmbarang; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmsatuan; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->qty; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($rs->harga); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $rs->disc_1; ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $rs->disc_2; ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $rs->disc_3; ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $rs->disc_4; ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_uang($rs->total); ?></div></td>
  </tr>
  <?php 
  	$no++;
	 $J1 = $J1 + $rs->qty; 
	 $J2 = $J2 + $rs->total; 
  } 
  ?>
  <tr>
    <td colspan="4" bgcolor="#FFCC33"><strong>JUMLAH</strong></td>
    <td bgcolor="#FFCC33"><?php echo $J1; ?></td>
    <td bgcolor="#FFCC33"><div align="right"></div></td>
    <td bgcolor="#FFCC33"><div align="right"></div></td>
    <td bgcolor="#FFCC33"><div align="right"></div></td>
    <td bgcolor="#FFCC33"><div align="right"></div></td>
    <td bgcolor="#FFCC33"><div align="right"></div></td>
    <td bgcolor="#FFCC33"><div align="right"><?php echo $this->msistem->format_uang($J2); ?></div></td>
  </tr>
  <?php
  		$T1 = $T1 + $J1; 
		$T2 = $T2 + $J2;
  }
  ?>
  <tr>
    <td colspan="4" bgcolor="#FF9933"><strong>TOTAL</strong></td>
    <td bgcolor="#FF9933"><?php echo $T1; ?></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_uang($T2); ?></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

<?php 
if($type=='EXCEL'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=retur_detail'.$tgl1."_".$tgl2.".xls");	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Laporan Retur Detail :.</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<h2>LAPORAN RETUR DETAIL</h2>
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
<table width="881" border="0" cellspacing="1">
  <tr>
    <td width="141" bgcolor="#3399FF"><div align="center"><strong># No.Transaksi</strong></div></td>
    <td width="81" bgcolor="#3399FF"><div align="center"><strong>Tanggal</strong></div></td>
    <td width="216" bgcolor="#3399FF"><div align="center"><strong>Gudang</strong></div></td>
    <td width="168" bgcolor="#3399FF"><div align="center"><strong>Pelanggan</strong></div></td>
    <td width="134" bgcolor="#3399FF"><div align="center"></div></td>
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
	a.disc_rp,a.tax_rp,
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
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->kdtrans; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->tgl; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->outlet_id."-".$rs->nm_outlet; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->idrekan."-".$rs->pelanggan; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>">&nbsp;</td>
  </tr>
  <?php 
  	
  ?>
  <tr>
    <td colspan="5"><table width="874" border="0">
      <tr>
        <td width="22"><div align="center"><strong><u>No</u></strong></div></td>
        <td colspan="2"><div align="center"><strong><u>Kd. Item</u></strong></div></td>
        <td colspan="3"><div align="left"><strong><u>Nama Item</u></strong></div></td>
        <td width="52"><div align="left"><strong><u>Satuan</u></strong></div></td>
        <td width="32"><div align="left"><strong><u>Jml</u></strong></div></td>
        <td width="48"><div align="left"><strong><u>Terima</u></strong></div></td>
        <td width="60"><div align="right"><strong><u>Harga</u></strong></div></td>
        <td width="38"><div align="center"><strong><u>Pot %</u></strong></div></td>
        <td width="46"><div align="center"><strong>Pot 2 %</strong></div></td>
        <td width="45"><div align="center"><strong><u>Pot 3 %</u></strong></div></td>
        <td width="51"><div align="center"><strong><u>Pot 4 %</u></strong></div></td>
        <td width="86"><div align="right"><strong><u>Total</u></strong></div></td>
      </tr>
      <?php 
	  $i = 1;
	  if($tmpUkuran == 1) {
	 	 $q = $this->db->query("select a.idbarang,concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang,b.nmsatuan,a.qty,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,a.total from tr_retur_penjualan_detail a left join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$rs->kdtrans."'");
	  } else {
	   	 $q = $this->db->query("select b.idgroup_barang as idbarang,b.nmbarang,b.nmsatuan,sum(a.qty) as qty,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,sum(a.total) as total from tr_retur_penjualan_detail a left join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$rs->kdtrans."' group by b.idgroup_barang");
	  }
	  foreach($q->result() as $r) {
	  ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td colspan="2"><?php echo $r->idbarang; ?></td>
        <td colspan="3"><?php echo $r->nmbarang; ?></td>
        <td><?php echo $r->nmsatuan; ?></td>
        <td><?php echo $this->msistem->format_angka($r->qty); ?></td>
         <td>&nbsp;</td>
        <td><div align="right"><?php echo $this->msistem->format_uang($r->harga); ?></div></td>
        <td><div align="center"><?php echo $r->disc_1; ?></div></td>
        <td><div align="center"><?php echo $r->disc_2; ?></div></td>
        <td><div align="center"><?php echo $r->disc_3; ?></div></td>
        <td><div align="center"><?php echo $r->disc_4; ?></div></td>
        <td><div align="right"><?php echo $this->msistem->format_uang($r->total); ?></div></td>
      </tr>
      <?php
	  		$i++;
	   } ?>
      <tr>
        <td>&nbsp;</td>
        <td width="32"><strong>Pot : </strong></td>
        <td width="68"><div align="right"><strong><?php echo $this->msistem->format_uang($rs->disc_rp); ?></strong></div></td>
        <td width="94">&nbsp;</td>
        <td width="45"><strong>Pajak :</strong></td>
        <td width="93"><div align="right"><strong><?php echo $this->msistem->format_uang($rs->tax_rp); ?></strong></div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Biaya :</strong></td>
        <td><div align="right" class="style1"><div align="right"><?php echo $this->msistem->format_uang($rs->biaya_lain); ?></div></div></td>
        <td colspan="2"><strong>Total Akhir :</strong></td>
        <td colspan="2"><div align="right"><strong><?php echo $this->msistem->format_uang($rs->grand_total); ?></strong></div></td>
        <td>&nbsp;</td>
      </tr>

    </table></td>
  </tr>
  <?php 
  	$no++;
	 $J1 = $J1 + $rs->jmlPesan; 
	 $J2 = $J2 + $rs->subtotal;   
	 $J3 = $J3 + $rs->disc_rp; 
	 $J4 = $J4 + $rs->tax_rp; 
	 $J5 = $J5 + $rs->biaya_lain; 
	 $J6 = $J6 + $rs->grand_total; 
	 $J7 = $J7 + $rs->tunai;
	 $J8 = $J8 + $rs->pot_piutang; 
  } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>JUMLAH KESELURUHAN</strong></div></td>
    <td><div align="right"><strong>Jumlah Item :</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_angka($J1); ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Subtotal :</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_uang($J2); ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Potongan :</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_uang($J3); ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Pajak :</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_uang($J4); ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Biaya Lain :</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_uang($J5); ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Total Akhir :</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_uang($J6); ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>DP / TUNAI :</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_uang($J7); ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>POT PIUTANG</strong></div></td>
    <td><div align="right"><strong><?php echo $this->msistem->format_uang($J8); ?></strong></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

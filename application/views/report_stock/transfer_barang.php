<?php 
if($type=='EXCEL'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=transferBrg'.$tglAwal.".".$tglAkhir.".xls");	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Pesanan Penjualan Detail :.</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<h2>PESANAN PENJUALAN DETAIL</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Periode</td>
    <td width="192">: <?php echo $tglAwal." s.d ".$tglAkhir; ?></td>
    <td width="94">Gudang Tujuan</td>
    <td width="321">: <?php if($gudangTujuan=="0") { echo "Semua"; } else { echo $gudangTujuan."-".$nmTujuan; } ?></td>
  </tr>
  <tr>
    <td>Gudang Asal</td>
    <td>: <?php if($gudangAsal=="0") { echo "Semua"; } else { echo $gudangAsal.'-'.$nmGudang; } ?></td>
    <td>&nbsp;</td>
    <td>: </td>
  </tr>
</table>
<table width="881" border="0" cellspacing="1">
  <tr>
    <td width="141" bgcolor="#3399FF"><div align="center"><strong># No.Transaksi</strong></div></td>
    <td width="81" bgcolor="#3399FF"><div align="center"><strong>Tanggal</strong></div></td>
    <td width="216" bgcolor="#3399FF"><div align="center"><strong>Gudang Asal</strong></div></td>
    <td width="168" bgcolor="#3399FF"><div align="center"><strong>Gudang Tujuan</strong></div></td>
    <td width="134" bgcolor="#3399FF"><div align="center"></div></td>
  </tr>
  <?php 
   $qr = "";
  $join = "";
  if($gudangAsal != "0") {
		$qr .= " and a.outlet_id = '".$gudangAsal."'";
  } else {
  		$join .= " inner join sys_hak_outlet f on a.outlet_id = f.outlet_id and f.group_id = '".$this->session->userdata('group_id')."'";
  }
  if($gudangTujuan != "0") {
		$qr .= " and a.outlet_id = '".$gudangTujuan."'";
  } else {
  		$join .= " inner join sys_hak_outlet g on a.outlet_tujuan = g.outlet_id and g.group_id = '".$this->session->userdata('group_id')."'";
  }
  $no=1;
  $J1 = 0; $J2 = 0; $J3 = 0; $J4 = 0; $J5 = 0; $J6 = 0; $J7 = 0;
  $sql = $this->db->query("select a.id,a.kdtrans,a.tgl,a.outlet_id,a.outlet_tujuan,b.nm_outlet as gudangAsal,c.nm_outlet as gudangTujuan from tr_transfer_barang a inner join master_company b on a.outlet_id = b.outlet_id inner join master_company c on a.outlet_tujuan = c.outlet_id $join where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr");
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
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->outlet_id."-".$rs->gudangAsal; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->outlet_tujuan."-".$rs->gudangTujuan; ?></strong></td>
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
        <td width="48"><div align="left"><u><strong>#PCS</strong></u></div></td>
        <td width="60"><div align="right"><strong><u>Harga</u></strong></div></td>
        <td width="86"><div align="right"><strong><u>Total</u></strong></div></td>
      </tr>
      <?php 
	  $qrD = "";
	   if($tipe != "null"):
			$qrD .= " and b.idtipe_item = '".$tipe."'";
  	   endif;
  	   if($jns != "null"):
			$qrD .= " and b.idjns_item = '".$jns."'";
  		endif;
  		if($kat != "null"):
			$qrD .= " and b.idkategori = '".$kat."'";
  		endif;
  		if($merk != "null"):
			$qrD .= " and b.idmerk = '".$merk."'";
  		endif;
  		if($warna != "null"):
			$qrD .= " and b.idwarna = '".$warna."'";
  		endif;
  
	  $i = 1; $J1 = 0; $J2 = 0; $J3 = 0;
	  if($tmpUkuran == 1) {
	 	 $q = $this->db->query("select a.idbarang,concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang,b.nmsatuan,a.jml as qty,a.pcs,a.harga,a.total from tr_transfer_barang_detail a left join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$rs->kdtrans."' $qrD");
	  } else {
	   	 $q = $this->db->query("select b.idgroup_barang as idbarang,concat(b.nmbarang,' ',b.nmwarna) as nmbarang,b.nmsatuan,sum(a.jml) as qty,sum(a.pcs) as pcs,a.harga,sum(a.total) as total from tr_transfer_barang_detail a left join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$rs->kdtrans."' $qrD group by b.idgroup_barang");
	  }
	  foreach($q->result() as $r) {
	  ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td colspan="2"><?php echo $r->idbarang; ?></td>
        <td colspan="3"><?php echo $r->nmbarang; ?></td>
        <td><?php echo $r->nmsatuan; ?></td>
        <td><div align="center"><?php echo $this->msistem->format_angka($r->qty); ?></div></td>
         <td><div align="center"><?php echo $this->msistem->format_angka($r->pcs); ?></div></td>
        <td><div align="right"><?php echo $this->msistem->format_uang($r->harga); ?></div></td>
        <td><div align="right"><?php echo $this->msistem->format_uang($r->total); ?></div></td>
      </tr>
      <?php
	  		$i++;
			$J1 = $J1 + $r->qty;
			$J2 = $J2 + $r->pcs;
			$J3 = $J3 + $r->total;
	   } ?>
      <tr>
        <td>&nbsp;</td>
        <td width="32">&nbsp;</td>
        <td width="68">&nbsp;</td>
        <td width="94">&nbsp;</td>
        <td width="45">&nbsp;</td>
        <td width="93"><strong>Total Qty :</strong></td>
        <td>&nbsp;</td>
        <td><div align="center"><strong><?php echo $this->msistem->format_angka($J1); ?></strong></div></td>
        <td><div align="center"><strong><?php echo $this->msistem->format_angka($J2); ?></strong></div></td>
        <td><div align="right" class="style1"><div align="right">Total  :</div></div></td>
        <td><div align="right"><strong><?php echo $this->msistem->format_uang($J3); ?></strong></div></td>
      </tr>

    </table></td>
  </tr>
  <?php 
  	$no++;
	
  } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

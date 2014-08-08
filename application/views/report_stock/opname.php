<?php 
if($type=='EXCEL'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=opname'.$tglOpname.".xls");	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Pesanan Penjualan Detail :.</title>
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<h2>LAPORAN OPNAME</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Tanggal Opname</td>
    <td width="192">: <?php echo $tglOpname; ?></td>
    <td width="94">&nbsp;</td>
    <td width="321">&nbsp;</td>
  </tr>
  <tr>
    <td>Gudang Asal</td>
    <td colspan="3">: <?php if($gudangAsal=="0") { echo "Semua"; } else { echo $gudangAsal.'-'.$nmGudang; } ?></td>
  </tr>
</table>
<table width="805" border="0" cellspacing="1">
  <tr>
    <td width="138" bgcolor="#3399FF"><div align="center"><strong># No.Transaksi</strong></div></td>
    <td width="76" bgcolor="#3399FF"><div align="center"><strong>Tanggal</strong></div></td>
    <td width="98" bgcolor="#3399FF"><div align="center"><strong>Kode Item</strong></div></td>
    <td width="238" bgcolor="#3399FF"><div align="center"><strong>Nama Item</strong></div></td>
    <td width="57" bgcolor="#3399FF"><div align="center"><strong>Satuan</strong></div></td>
    <td width="63" bgcolor="#3399FF"><div align="center"><strong>Sebelum</strong></div></td>
    <td width="53" bgcolor="#3399FF"><div align="center"><strong>Fisik</strong></div></td>
    <td width="57" bgcolor="#3399FF"><div align="center"><strong>Selisih</strong></div></td>
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
		
  $arr = explode("-",$tglOpname);
  $tglStockAwal = $arr[0].'-'.$arr[1].'-01';
  $no=1;
  $J1 = 0; $J2 = 0; $J3 = 0;
  if($tmpUkuran == 1) {
	  $sql = $this->db->query("select a.id,a.kdtrans,a.tgl,b.idbarang,concat(c.nmbarang,' ',c.nmwarna,' ',c.nmsize) as nmbarang,c.nmsatuan,b.stock_fisik,
	  sum(ifnull(d.qty_sa,0)) as qty_sa,sum(ifnull(d.qty_beli_in,0)) as qty_beli_in,sum(ifnull(d.qty_transfer_in,0)) as qty_transfer_in,sum(ifnull(d.qty_retur_in,0)) as qty_retur_in,
	  sum(ifnull(d.qty_transfer_out,0)) as qty_transfer_out,sum(ifnull(d.qty_jual_out,0)) as qty_jual_out,sum(ifnull(d.qty_pakai_out,0)) as qty_pakai_out,sum(ifnull(d.qty_retur_out,0)) as qty_retur_out 
	  from tr_stock_opname a inner join tr_stock_opname_detail b on a.kdtrans = b.kdtrans inner join v_master_barang_detail c on b.idbarang = c.idbarang left join rpt_stock d on b.idbarang = d.idbarang and d.tgl >= '".$tglStockAwal."' and d.tgl <= '".$tglOpname."' $join  where a.tgl = '".$tglOpname."' $qr group by d.idbarang");
  } else {
  		 //$sql = $this->db->query("select a.id,a.kdtrans,a.tgl,c.idgroup_barang as idbarang,concat(c.nmbarang,' ',c.nmwarna) as nmbarang,c.nmsatuan,sum(b.stock_fisik) as stock_fisikfrom tr_stock_opname a inner join tr_stock_opname_detail b on a.kdtrans = b.kdtrans inner join v_master_barang_detail c on b.idbarang = c.idbarang right join rpt_stock d on b.idbarang = d.idbarang where a.tgl = '".$tglOpname."' $qr group by c.idgroup_barang");	
  }
  foreach($sql->result() as $rs) {
  
  if($no%2==0) {
  	$bg = "#C7E2F3";
  } else {
  	$bg = "#FFFFFF";
  }
  
  $stock_awal = $rs->qty_sa;
  $stock_masuk = $rs->qty_beli_in + $rs->qty_transfer_in + $rs->qty_retur_in;
  $stock_keluar = $rs->qty_transfer_out + $rs->qty_jual_out + $rs->qty_retur_out + $rs->qty_pakai_out;
  
  $stock_buku = $stock_awal + $stock_masuk - $stock_keluar;
  
  $selisih = $stock_buku - $rs->stock_fisik;
  ?>
  <tr>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->kdtrans; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->tgl; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><strong><?php echo $rs->idbarang; ?></strong></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmbarang; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmsatuan; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($stock_buku); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($rs->stock_fisik); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="center"><?php echo $this->msistem->format_angka($selisih); ?></div></td>
  </tr>
 
  <?php 
  	$no++;
	$J1 = $J1 + $stock_buku;
	$J2 = $J2 + $rs->stock_fisik; 
	$J3 = $J3 + $selisih;
  } ?>
  <tr>
    <td colspan="4" bgcolor="#FF9933"><strong>JUMLAH</strong></td>
    <td bgcolor="#FF9933">&nbsp;</td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J1); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J2); ?></div></td>
    <td bgcolor="#FF9933"><div align="center"><?php echo $this->msistem->format_angka($J3); ?></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

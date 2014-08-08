<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Persediaan Awal :.</title>
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<h2>PERSEDIAAN AWAL</h2>
<table width="734" border="0">
  <tr>
    <td width="109">Periode</td>
    <td width="192">: <?php echo $kdtrans; ?></td>
    <td width="94">Gudang</td>
    <td width="321">: <?php echo $gudang; ?></td>
  </tr>
  <tr>
    <td>Keterangan</td>
    <td>: <?php echo $keterangan; ?></td>
    <td>Kode Akun</td>
    <td>: <?php echo $idperkiraan."&nbsp;
	".$nmperkiraan; ?></td>
  </tr>
</table>
<table width="875" border="0" cellspacing="0">
  <tr>
    <td width="32" bgcolor="#3399FF"><div align="center"><strong>No</strong></div></td>
    <td width="79" bgcolor="#3399FF"><div align="center"><strong># Kode</strong></div></td>
    <td width="192" bgcolor="#3399FF"><div align="center"><strong>Nama Barang</strong></div></td>
    <td width="103" bgcolor="#3399FF"><div align="center"><strong>Warna</strong></div></td>
    <td width="99" bgcolor="#3399FF"><div align="center"><strong>Ukuran</strong></div></td>
    <td width="72" bgcolor="#3399FF"><div align="center"><strong>Satuan</strong></div></td>
    <td width="63" bgcolor="#3399FF"><div align="center"><strong>Jumlah</strong></div></td>
    <td width="44" bgcolor="#3399FF"><div align="center"><strong>PCS</strong></div></td>
    <td width="64" bgcolor="#3399FF"><div align="center"><strong>Harga</strong></div></td>
    <td width="107" bgcolor="#3399FF"><div align="center"><strong>Total</strong></div></td>
  </tr>
  <?php 
  $no=1;
  $tJml = 0; $tTotal = 0; $tPcs = 0;
  foreach($dataPA->result() as $rs) {
  
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
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmwarna; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmsize; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><?php echo $rs->nmsatuan; ?></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_angka($rs->jml); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_angka($rs->pcs); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_angka($rs->harga); ?></div></td>
    <td bgcolor="<?php echo $bg; ?>"><div align="right"><?php echo $this->msistem->format_angka($rs->total); ?></div></td>
  </tr>
  <?php 
  	$no++;
	$tJml = $tJml + $rs->jml; 
	$tTotal = $tTotal + $rs->total; 
	$tPcs = $tPcs + $rs->pcs;
  } ?>
  <tr>
    <td colspan="3" bgcolor="#FF9933"><strong>JUMLAH</strong></td>
    <td bgcolor="#FF9933">&nbsp;</td>
    <td bgcolor="#FF9933">&nbsp;</td>
    <td bgcolor="#FF9933">&nbsp;</td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_angka($tJml); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_angka($tPcs); ?></div></td>
    <td bgcolor="#FF9933"><div align="right"></div></td>
    <td bgcolor="#FF9933"><div align="right"><?php echo $this->msistem->format_angka($tTotal); ?></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

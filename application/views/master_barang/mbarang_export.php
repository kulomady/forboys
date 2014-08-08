<?php 
header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=master_barang_all.xls');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="1038" border="1">
  <tr>
    <td align="center"><strong>No</strong></td>
    <td align="center"><strong>Kode</strong></td>
    <td align="center"><strong>Nama Barang</strong></td>
    <td align="center"><strong>Tipe Item</strong></td>
    <td align="center"><strong>Jenis Item</strong></td>
    <td align="center"><strong>Satuan Dasar</strong></td>
    <td align="center"><strong>Sts Jual</strong></td>
    <td align="center"><strong>Konsinyasi</strong></td>
    <td align="center"><strong>Merk</strong></td>
    <td align="center"><strong>Kategori</strong></td>
    <td align="center"><strong>Warna</strong></td>
    <td align="center"><strong>Keterangan</strong></td>
    <td align="center"><strong>Aktif</strong></td>
  </tr>
  <?php 
  $no = 1;
  foreach($query->result() as $rs) {
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $rs->idbarang; ?></td>
    <td><?php echo $rs->nmbarang; ?></td>
    <td><?php echo $rs->nmtipe; ?></td>
    <td><?php echo $rs->nmjenis; ?></td>
    <td><?php echo $rs->nmsatuan; ?></td>
    <td><?php echo $rs->sts_jual; ?></td>
    <td><?php echo $rs->sts_konsinyasi; ?></td>
    <td><?php echo $rs->nmmerk; ?></td>
    <td><?php echo $rs->nmkategori; ?></td>
    <td><?php echo $rs->nmwarna; ?></td>
    <td><?php echo $rs->keterangan; ?></td>
    <td><?php echo $rs->is_active; ?></td>
  </tr>
  <?php 
  	$no++;
  } ?>
</table>
</body>
</html>
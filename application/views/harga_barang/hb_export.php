<?php 
header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=harga_jual-'.$kode.".xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="663" border="1">
  <tr>
    <td width="108" align="center">Kode</td>
    <td width="195" align="center">Nama Barang</td>
    <td width="69" align="center">Satuan</td>
    <td width="56" align="center">Harga</td>
    <td width="48" align="center">Disc 1</td>
    <td width="48" align="center">Disc 2</td>
    <td width="40" align="center">Disc 3</td>
    <td width="47" align="center">Disc 4</td>
  </tr>
  <?php 
  foreach($query->result() as $rs) {
  ?>
  <tr>
    <td><?php echo $rs->idbarang; ?></td>
    <td><?php echo $rs->nmbarang; ?></td>
    <td><?php echo $rs->nmsatuan; ?></td>
    <td><?php echo $rs->harga; ?></td>
    <td><?php echo $rs->disc_1; ?></td>
    <td><?php echo $rs->disc_2; ?></td>
    <td><?php echo $rs->disc_3; ?></td>
    <td><?php echo $rs->disc_4; ?></td>
  </tr>
 <?php } ?>
</table>
</body>
</html>
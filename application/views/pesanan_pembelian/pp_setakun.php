<div class="frmContainer">
<table width="244" border="0">
  <tr>
    <td width="234" align="center">Kode Akun Uang Muka Pesanan Beli</td>
  </tr>
  <tr>
    <td align="center" id="tmpAkun_pb4"></td>
  </tr>
  <tr>
    <td align="center">Kode Akun Perkiraan Uang Muka Pesanan Beli</td>
  </tr>
  <tr>
    <td id="tmpAkun2_pb4"></td>
  </tr>
</table>
</div>
<script language="javascript">
var cbAkun_pb4 = new dhtmlXCombo("tmpAkun_pb4", "cbAkun_pb4", 250);
cbAkun_pb4.enableFilteringMode(true);
cbAkun_pb4.clearAll();
cbAkun_pb4.loadXML(base_url+"index.php/master_perkiraan/cbPerkiraanKasBank",function() {
	IDcbAkun_pb4 = cbAkun_pb4.getIndexByValue('<?php echo $akun_kas; ?>');
	cbAkun_pb4.selectOption(IDcbAkun_pb4,true,true);
});
cbAkun_pb4.attachEvent("onChange", function() {
	document.frm_pb4.akun_kas.value = cbAkun_pb4.getSelectedValue();											
});

var cbAkun2_pb4 = new dhtmlXCombo("tmpAkun2_pb4", "cbAkun2_pb4", 250);
cbAkun2_pb4.enableFilteringMode(true);
cbAkun2_pb4.clearAll();
cbAkun2_pb4.loadXML(base_url+"index.php/master_perkiraan/cbPerkiraan",function() {
	IDcbAkun2_pb4 = cbAkun2_pb4.getIndexByValue('<?php echo $akun_dp; ?>');
	cbAkun2_pb4.selectOption(IDcbAkun2_pb4,true,true);
});
cbAkun2_pb4.attachEvent("onChange", function() {
	document.frm_pb4.akun_dp.value = cbAkun2_pb4.getSelectedValue();											
});
</script>
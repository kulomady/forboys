<div class="frmContainer" style="height:180px;">
<table width="244" border="0">
  <tr>
    <td width="234" align="center">Kode Akun Uang Muka Pesanan</td>
  </tr>
  <tr>
    <td align="center" id="tmpAkun_pb1"></td>
  </tr>
</table>
</div>
<script language="javascript">
var cbAkun_pb1 = new dhtmlXCombo("tmpAkun_pb1", "cbAkun_pb1", 250);
cbAkun_pb1.enableFilteringMode(true);
cbAkun_pb1.clearAll();
cbAkun_pb1.loadXML(base_url+"index.php/master_perkiraan/cbPerkiraan",function() {
	IDcbAkun_pb1 = cbAkun_pb1.getIndexByValue('<?php echo $la_akun_hd; ?>');
	cbAkun_pb1.selectOption(IDcbAkun_pb1,true,true);
});
cbAkun_pb1.attachEvent("onChange", function() {
	document.frm_pb1.akun_kredit.value = cbAkun_pb1.getSelectedValue();											
});
</script>
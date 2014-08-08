<div class="frmContainer">
<table width="244" border="0">
  <tr>
    <td width="234" align="center">Kode Akun Biaya Kirim</td>
  </tr>
  <tr>
    <td align="center" id="tmpAkun_pb1"></td>
  </tr>
  <tr>
    <td align="center">Kode Akun Pajak Biaya Kirim</td>
  </tr>
  <tr>
    <td id="tmpAkun2_pb1"></td>
  </tr>
</table>
</div>
<script language="javascript">
var cbAkun_pb1 = new dhtmlXCombo("tmpAkun_pb1", "cbAkun_pb1", 250);
cbAkun_pb1.enableFilteringMode(true);
cbAkun_pb1.clearAll();
cbAkun_pb1.loadXML(base_url+"index.php/master_perkiraan/cbPerkiraan",function() {
	IDcbAkun_pb1 = cbAkun_pb1.getIndexByValue('<?php echo $la_biaya_angkut_beli; ?>');
	cbAkun_pb1.selectOption(IDcbAkun_pb1,true,true);
});
cbAkun_pb1.attachEvent("onChange", function() {
	document.frm_pb1.akun_biayakirim.value = cbAkun_pb1.getSelectedValue();											
});

var cbAkun2_pb1 = new dhtmlXCombo("tmpAkun2_pb1", "cbAkun2_pb1", 250);
cbAkun2_pb1.enableFilteringMode(true);
cbAkun2_pb1.clearAll();
cbAkun2_pb1.loadXML(base_url+"index.php/master_perkiraan/cbPerkiraan",function() {
	IDcbAkun2_pb1 = cbAkun2_pb1.getIndexByValue('<?php echo $la_pajak_bk; ?>');
	cbAkun2_pb1.selectOption(IDcbAkun2_pb1,true,true);
});
cbAkun2_pb1.attachEvent("onChange", function() {
	document.frm_pb1.akun_pajakBk.value = cbAkun2_pb1.getSelectedValue();											
});
</script>
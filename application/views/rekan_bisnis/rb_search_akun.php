<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun" id="frmSearchAkun" onKeyDown="tandaPanahAkun(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_md1" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun').focus();

gd_w2_md1 = new dhtmlXGridObject('gridAkun_md1');
gd_w2_md1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_md1.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_md1.setInitWidths("80,180,110");
gd_w2_md1.setColAlign("left,left,left");
gd_w2_md1.setColSorting("str,str,str");
gd_w2_md1.setColTypes("ro,ro,ro");
gd_w2_md1.enableSmartRendering(true,50);
gd_w2_md1.makeSearch("frmSearchAkun",1);
gd_w2_md1.setSkin("dhx_skyblue");
gd_w2_md1.init();

gd_w2_md1.clearAll();
gd_w2_md1.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun(key) {
	if(key==13) {
		idperkiraan = gd_w2_md1.cells(gd_w2_md1.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_md1.cells(gd_w2_md1.getSelectedId(),1).getValue();
		document.frm_md1.txtidperkiraan.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_md1").innerHTML = nmPerkiraan;
		w2_md1.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_md1,'frmSearchAkun');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_md1,'frmSearchAkun');
	}
	return;
}
</script>
</div>

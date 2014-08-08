<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pr2" id="frmSearchAkun_pr2" onKeyDown="tandaPanahAkun_pr2(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pr2" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun_pr2').focus();

gd_w2_pr2 = new dhtmlXGridObject('gridAkun_pr2');
gd_w2_pr2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pr2.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pr2.setInitWidths("80,180,110");
gd_w2_pr2.setColAlign("left,left,left");
gd_w2_pr2.setColSorting("str,str,str");
gd_w2_pr2.setColTypes("ro,ro,ro");
gd_w2_pr2.enableSmartRendering(true,50);
gd_w2_pr2.makeSearch("frmSearchAkun_pr2",1);
gd_w2_pr2.setSkin("dhx_skyblue");
gd_w2_pr2.init();

gd_w2_pr2.clearAll();
gd_w2_pr2.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun_pr2(key) {
	if(key==13) {
		idperkiraan = gd_w2_pr2.cells(gd_w2_pr2.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pr2.cells(gd_w2_pr2.getSelectedId(),1).getValue();
		document.frm_pr2.kdakun.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_pr2").innerHTML = nmPerkiraan;
		w2_pr2.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pr2,'frmSearchAkun_pr2');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pr2,'frmSearchAkun_pr2');
	}
	return;
}
</script>
</div>

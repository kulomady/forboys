<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkunKas_pr8" id="frmSearchAkunKas_pr8" onKeyDown="tandaPanahAkunKas_pr8(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkunKas_pr8" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkunKas_pr8').focus();

gd_w2_pr8 = new dhtmlXGridObject('gridAkunKas_pr8');
gd_w2_pr8.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pr8.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pr8.setInitWidths("80,180,110");
gd_w2_pr8.setColAlign("left,left,left");
gd_w2_pr8.setColSorting("str,str,str");
gd_w2_pr8.setColTypes("ro,ro,ro");
gd_w2_pr8.enableSmartRendering(true,50);
gd_w2_pr8.makeSearch("frmSearchAkunKas_pr8",1);
gd_w2_pr8.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahAkunKas_pr8(13);
});
gd_w2_pr8.setSkin("dhx_skyblue");
gd_w2_pr8.init();

gd_w2_pr8.clearAll();
gd_w2_pr8.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraanKas");

function tandaPanahAkunKas_pr8(key) {
	if(key==13) {
		idperkiraan = gd_w2_pr8.cells(gd_w2_pr8.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pr8.cells(gd_w2_pr8.getSelectedId(),1).getValue();
		document.frm_pr8.kdakunKas.value = idperkiraan;
		document.getElementById("tmpNmPerkiraanKas_pr8").innerHTML = nmPerkiraan;
		w2_pr8.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pr8,'frmSearchAkunKas_pr8');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pr8,'frmSearchAkunKas_pr8');
	}
	return;
}
</script>
</div>

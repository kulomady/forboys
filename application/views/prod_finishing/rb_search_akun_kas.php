<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkunKas_pr5" id="frmSearchAkunKas_pr5" onKeyDown="tandaPanahAkunKas_pr5(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkunKas_pr5" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkunKas_pr5').focus();

gd_w2_pr5 = new dhtmlXGridObject('gridAkunKas_pr5');
gd_w2_pr5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pr5.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pr5.setInitWidths("80,180,110");
gd_w2_pr5.setColAlign("left,left,left");
gd_w2_pr5.setColSorting("str,str,str");
gd_w2_pr5.setColTypes("ro,ro,ro");
gd_w2_pr5.enableSmartRendering(true,50);
gd_w2_pr5.makeSearch("frmSearchAkunKas_pr5",1);
gd_w2_pr5.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahAkunKas_pr5(13);
});
gd_w2_pr5.setSkin("dhx_skyblue");
gd_w2_pr5.init();

gd_w2_pr5.clearAll();
gd_w2_pr5.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraanKas");

function tandaPanahAkunKas_pr5(key) {
	if(key==13) {
		idperkiraan = gd_w2_pr5.cells(gd_w2_pr5.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pr5.cells(gd_w2_pr5.getSelectedId(),1).getValue();
		document.frm_pr5.kdakunKas.value = idperkiraan;
		document.getElementById("tmpNmPerkiraanKas_pr5").innerHTML = nmPerkiraan;
		w2_pr5.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pr5,'frmSearchAkunKas_pr5');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pr5,'frmSearchAkunKas_pr5');
	}
	return;
}
</script>
</div>

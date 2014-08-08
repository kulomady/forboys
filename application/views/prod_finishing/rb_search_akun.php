<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pr5" id="frmSearchAkun_pr5" onKeyDown="tandaPanahAkun_pr5(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pr5" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun_pr5').focus();

gd_w3_pr5 = new dhtmlXGridObject('gridAkun_pr5');
gd_w3_pr5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_pr5.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w3_pr5.setInitWidths("80,180,110");
gd_w3_pr5.setColAlign("left,left,left");
gd_w3_pr5.setColSorting("str,str,str");
gd_w3_pr5.setColTypes("ro,ro,ro");
gd_w3_pr5.enableSmartRendering(true,50);
gd_w3_pr5.makeSearch("frmSearchAkun_pr5",1);
gd_w3_pr5.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahAkun_pr5(13);
});
gd_w3_pr5.setSkin("dhx_skyblue");
gd_w3_pr5.init();

gd_w3_pr5.clearAll();
gd_w3_pr5.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun_pr5(key) {
	if(key==13) {
		idperkiraan = gd_w3_pr5.cells(gd_w3_pr5.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w3_pr5.cells(gd_w3_pr5.getSelectedId(),1).getValue();
		document.frm_pr5.kdakun.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_pr5").innerHTML = nmPerkiraan;
		w3_pr5.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_pr5,'frmSearchAkun_pr5');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_pr5,'frmSearchAkun_pr5');
	}
	return;
}
</script>
</div>

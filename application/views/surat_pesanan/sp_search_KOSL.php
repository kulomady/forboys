<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchKOSL" id="frmSearchKOSL" onKeyDown="tandaPanahKOSL(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridKOSL_mk3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchKOSL').focus();

gd_KOSL_mk3 = new dhtmlXGridObject('gridKOSL_mk3');
gd_KOSL_mk3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_KOSL_mk3.setHeader("&nbsp;,ID Member,Nama Member, No. HP",null,["text-align:center","text-align:center"]);
gd_KOSL_mk3.setInitWidths("30,80,180,0");
gd_KOSL_mk3.setColAlign("right,left,left,left");
gd_KOSL_mk3.setColSorting("na,str,str,str");
gd_KOSL_mk3.setColTypes("cntr,ro,ro,ro");
gd_KOSL_mk3.enableSmartRendering(true,50);
gd_KOSL_mk3.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahKOSL(13);
});
gd_KOSL_mk3.makeSearch("frmSearchKOSL",1);
gd_KOSL_mk3.setSkin("dhx_skyblue");
gd_KOSL_mk3.init();

gd_KOSL_mk3.clearAll();
gd_KOSL_mk3.loadXML(base_url+"index.php/surat_pesanan/loadDataMember");

function tandaPanahKOSL(key) {
	if(key==13) {
		idMember = gd_KOSL_mk3.cells(gd_KOSL_mk3.getSelectedId(),1).getValue();
		nmMember = gd_KOSL_mk3.cells(gd_KOSL_mk3.getSelectedId(),2).getValue();
		document.frm_mk33.koor_selling.value = idMember;
		document.frm_mk33.nmkoor_selling.value = nmMember;
		w4_mk3.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_KOSL_mk3,'frmSearchKOSL');
	}
	if(key==40) {
		pilihGridKeBawah(gd_KOSL_mk3,'frmSearchKOSL');
	}
	return;
}
</script>
</div>
<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchSL" id="frmSearchSL" onKeyDown="tandaPanahSL(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridSL_mk3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchSL').focus();

gd_SL_mk3 = new dhtmlXGridObject('gridSL_mk3');
gd_SL_mk3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_SL_mk3.setHeader("&nbsp;,ID Member,Nama Member, No. HP",null,["text-align:center","text-align:center"]);
gd_SL_mk3.setInitWidths("30,80,180,0");
gd_SL_mk3.setColAlign("right,left,left,left");
gd_SL_mk3.setColSorting("na,str,str,str");
gd_SL_mk3.setColTypes("cntr,ro,ro,ro");
gd_SL_mk3.enableSmartRendering(true,50);
gd_SL_mk3.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahSL(13);
});
gd_SL_mk3.makeSearch("frmSearchSL",1);
gd_SL_mk3.setSkin("dhx_skyblue");
gd_SL_mk3.init();

gd_SL_mk3.clearAll();
gd_SL_mk3.loadXML(base_url+"index.php/surat_pesanan/loadDataMember");

function tandaPanahSL(key) {
	if(key==13) {
		idMember = gd_SL_mk3.cells(gd_SL_mk3.getSelectedId(),1).getValue();
		nmMember = gd_SL_mk3.cells(gd_SL_mk3.getSelectedId(),2).getValue();
		document.frm_mk33.selling.value = idMember;
		document.frm_mk33.nm_selling.value = nmMember;
		w5_mk3.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_SL_mk3,'frmSearchSL');
	}
	if(key==40) {
		pilihGridKeBawah(gd_SL_mk3,'frmSearchSL');
	}
	return;
}
</script>
</div>
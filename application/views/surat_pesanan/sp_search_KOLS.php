<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchKOLS" id="frmSearchKOLS" onKeyDown="tandaPanahKOLS(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridKOLS_mk3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchKOLS').focus();

gd_KOLS_mk3 = new dhtmlXGridObject('gridKOLS_mk3');
gd_KOLS_mk3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_KOLS_mk3.setHeader("&nbsp;,ID Member,Nama Member, No. HP",null,["text-align:center","text-align:center"]);
gd_KOLS_mk3.setInitWidths("30,80,180,0");
gd_KOLS_mk3.setColAlign("right,left,left,left");
gd_KOLS_mk3.setColSorting("na,str,str,str");
gd_KOLS_mk3.setColTypes("cntr,ro,ro,ro");
gd_KOLS_mk3.enableSmartRendering(true,50);
gd_KOLS_mk3.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahKOLS(13);
});
gd_KOLS_mk3.makeSearch("frmSearchKOLS",1);
gd_KOLS_mk3.setSkin("dhx_skyblue");
gd_KOLS_mk3.init();

gd_KOLS_mk3.clearAll();
gd_KOLS_mk3.loadXML(base_url+"index.php/surat_pesanan/loadDataMember");

function tandaPanahKOLS(key) {
	if(key==13) {
		idMember = gd_KOLS_mk3.cells(gd_KOLS_mk3.getSelectedId(),1).getValue();
		nmMember = gd_KOLS_mk3.cells(gd_KOLS_mk3.getSelectedId(),2).getValue();
		document.frm_mk33.koor_listing.value = idMember;
		document.frm_mk33.nmkoor_listing.value = nmMember;
		w6_mk3.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_KOLS_mk3,'frmSearchKOLS');
	}
	if(key==40) {
		pilihGridKeBawah(gd_KOLS_mk3,'frmSearchKOLS');
	}
	return;
}
</script>
</div>
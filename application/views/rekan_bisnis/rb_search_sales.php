<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchSales" id="frmSearchSales" onKeyDown="tandaPanahSales(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridSales_md1" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchSales').focus();

gd_w3_md1 = new dhtmlXGridObject('gridSales_md1');
gd_w3_md1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_md1.setHeader("ID Rekan,Nama Rekan",null,["text-align:center","text-align:center"]);
gd_w3_md1.setInitWidths("80,180");
gd_w3_md1.setColAlign("left,left");
gd_w3_md1.setColSorting("str,str");
gd_w3_md1.setColTypes("ro,ro");
gd_w3_md1.enableSmartRendering(true,50);
gd_w3_md1.makeSearch("frmSearchSales",1);
gd_w3_md1.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahSales(13);
});
gd_w3_md1.setSkin("dhx_skyblue");
gd_w3_md1.init();

gd_w3_md1.clearAll();
gd_w3_md1.loadXML(base_url+"index.php/rekan_bisnis/loadDataSales");

function tandaPanahSales(key) {
	if(key==13) {
		idRekan = gd_w3_md1.cells(gd_w3_md1.getSelectedId(),0).getValue();
		nmRekan = gd_w3_md1.cells(gd_w3_md1.getSelectedId(),1).getValue();
		document.frm_md1.txtidPramuniaga.value = idRekan;
		document.getElementById("tmpNmRekan_md1").innerHTML = nmRekan;
		w3_md1.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_md1,'frmSearchSales');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_md1,'frmSearchSales');
	}
	return;
}
</script>
</div>

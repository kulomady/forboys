<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchSupplier" id="frmSearchSupplier" onKeyDown="tandaPanahSupplier(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridSupplier_pb1" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchSupplier').focus();

gd_w3_pb1 = new dhtmlXGridObject('gridSupplier_pb1');
gd_w3_pb1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_pb1.setHeader("ID Supplier,Nama Supplier",null,["text-align:center","text-align:center"]);
gd_w3_pb1.setInitWidths("80,180");
gd_w3_pb1.setColAlign("left,left");
gd_w3_pb1.setColSorting("str,str");
gd_w3_pb1.setColTypes("ro,ro");
gd_w3_pb1.enableSmartRendering(true,50);
gd_w3_pb1.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahSupplier_pd1(13);
});
gd_w3_pb1.makeSearch("frmSearchSupplier",1);
gd_w3_pb1.setSkin("dhx_skyblue");
gd_w3_pb1.init();

gd_w3_pb1.clearAll();
gd_w3_pb1.loadXML(base_url+"index.php/pembelian_barang/loadDataSupplier");

function tandaPanahSupplier_pd1(key) {
	if(key==13) {
		idSupplier = gd_w3_pb1.cells(gd_w3_pb1.getSelectedId(),0).getValue();
		nmSupplier = gd_w3_pb1.cells(gd_w3_pb1.getSelectedId(),1).getValue();
		document.frm_pb1.txtidSupplier.value = idSupplier;
		document.getElementById("tmpNmSupplier_pb1").innerHTML = nmSupplier;
		w2_pb1.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_pb1,'frmSearchSupplier');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_pb1,'frmSearchSupplier');
	}
	return;
}
</script>
</div>

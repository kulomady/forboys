<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchSupplier" id="frmSearchSupplier" onKeyDown="tandaPanahSupplier(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridSupplier_pb4" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchSupplier').focus();

gd_w3_pb4 = new dhtmlXGridObject('gridSupplier_pb4');
gd_w3_pb4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_pb4.setHeader("ID Supplier,Nama Supplier",null,["text-align:center","text-align:center"]);
gd_w3_pb4.setInitWidths("80,180");
gd_w3_pb4.setColAlign("left,left");
gd_w3_pb4.setColSorting("str,str");
gd_w3_pb4.setColTypes("ro,ro");
gd_w3_pb4.enableSmartRendering(true,50);
gd_w3_pb4.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahSupplier(13);
});
gd_w3_pb4.makeSearch("frmSearchSupplier",1);
gd_w3_pb4.setSkin("dhx_skyblue");
gd_w3_pb4.init();

gd_w3_pb4.clearAll();
gd_w3_pb4.loadXML(base_url+"index.php/pesanan_pembelian/loadDataSupplier");

function tandaPanahSupplier(key) {
	if(key==13) {
		idSupplier = gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),0).getValue();
		nmSupplier = gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),1).getValue();
		document.frm_pb4.txtidSupplier.value = idSupplier;
		document.getElementById("tmpNmSupplier_pb4").innerHTML = nmSupplier;
		w2_pb4.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_pb4,'frmSearchSupplier');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_pb4,'frmSearchSupplier');
	}
	return;
}
</script>
</div>

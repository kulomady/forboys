<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchBeli" id="frmSearchBeli" onKeyDown="cariBeli(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridSupplier_pb3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchBeli').focus();

gd_w3_pb3 = new dhtmlXGridObject('gridSupplier_pb3');
gd_w3_pb3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_pb3.setHeader("No Pembelian,Nama Supplier",null,["text-align:center","text-align:center"]);
gd_w3_pb3.setInitWidths("180,180");
gd_w3_pb3.setColAlign("left,left");
gd_w3_pb3.setColSorting("str,str");
gd_w3_pb3.setColTypes("ro,ro");
gd_w3_pb3.enableSmartRendering(true,50);
gd_w3_pb3.makeSearch("frmSearchBeli",1);
gd_w3_pb3.setSkin("dhx_skyblue");
gd_w3_pb3.init();

function tandaPanahSupplier(key) {
	if(key==13) {
		idSupplier = gd_w3_pb3.cells(gd_w3_pb3.getSelectedId(),0).getValue();
		nmSupplier = gd_w3_pb3.cells(gd_w3_pb3.getSelectedId(),1).getValue();
		document.frm_pb3.no_lpb.value = idSupplier;
		document.frm_pb3.supplier.value = nmSupplier;
		w2_pb3.close();
		WinTambahBarang_pb3();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_pb3,'frmSearchBeli');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_pb3,'frmSearchBeli');
	}
	return;
}

function cariBeli(key){
	if(key==13){
		gd_w3_pb3.clearAll();
		gd_w3_pb3.loadXML(base_url+"index.php/retur_pembelian/loadDataBeli/"+document.getElementById('frmSearchBeli').value);
	}
}
</script>
</div>

<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchTransfer" id="frmSearchTransfer" onKeyDown="tandaPanahTransfer(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridTransfer_pb4" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchTransfer').focus();

gd_w3_pb4 = new dhtmlXGridObject('gridTransfer_pb4');
gd_w3_pb4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_pb4.setHeader("&nbsp;,No. Transfer,Dari Gudang,gudang,tujuan,supir,no_polisi,ket",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_w3_pb4.setInitWidths("30,180,180,0,0,0,0,0");
gd_w3_pb4.setColAlign("right,left,left,left,left,left,left,left");
gd_w3_pb4.setColSorting("na,str,str,str,str,str,str,str");
gd_w3_pb4.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
gd_w3_pb4.enableSmartRendering(true,50);
gd_w3_pb4.makeSearch("frmSearchTransfer",1);
gd_w3_pb4.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahTransfer(13);
});
gd_w3_pb4.setSkin("dhx_skyblue");
gd_w3_pb4.splitAt(1);
gd_w3_pb4.init();

gd_w3_pb4.clearAll();
gd_w3_pb4.loadXML(base_url+"index.php/penerimaan_barang/loadDataTransfer");

function tandaPanahTransfer(key) {
	if(key==13) {
		document.frm_pd4.notrans.value = gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),1).getValue();
		document.frm_pd4.gudang.value = gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),3).getValue();
		document.frm_pd4.tujuan.value = gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),4).getValue();
		document.frm_pd4.supir.value = gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),5).getValue();
		document.frm_pd4.nopol.value = gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),6).getValue();
		loadDataTransInp_pd4(gd_w3_pb4.cells(gd_w3_pb4.getSelectedId(),1).getValue());
		w2_pd4.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_pb4,'frmSearchTransfer');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_pb4,'frmSearchTransfer');
	}
	return;
}
</script>
</div>

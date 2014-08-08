<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchCust" id="frmSearchCust" onKeyDown="tandaPanahCustomer(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridCustomer_mk3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchCust').focus();

gd_w4_mk3 = new dhtmlXGridObject('gridCustomer_mk3');
gd_w4_mk3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_mk3.setHeader("&nbsp;,Kode Customer,Nama Customer,agama,alamat,tgl_lahir,kodepos,tlp_rumah,hp,tlp_kantor,fax,no_id,email,npwp",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_w4_mk3.setInitWidths("30,180,180,0,0,0,0,0,0,0,0,0,0,0");
gd_w4_mk3.setColAlign("right,left,left,left,left,left,left,left,left,left,left,left,left,left");
gd_w4_mk3.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str,str,str");
gd_w4_mk3.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_w4_mk3.enableSmartRendering(true,50);
gd_w4_mk3.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahCustomer(13);
});
gd_w4_mk3.makeSearch("frmSearchCust",1);
gd_w4_mk3.setSkin("dhx_skyblue");
gd_w4_mk3.init();

gd_w4_mk3.clearAll();
gd_w4_mk3.loadXML(base_url+"index.php/surat_pesanan/loadDataCustomer");

function tandaPanahCustomer(key) {
	if(key==13) {
		document.frm_mk31.kode_pelanggan.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),1).getValue();
		document.frm_mk31.nama_pemesan.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),2).getValue();
		document.frm_mk31.agama.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),3).getValue();
		document.frm_mk31.alamat.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),4).getValue();
		document.frm_mk31.tgl_lahir.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),5).getValue();
		document.frm_mk31.pos.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),6).getValue();
		document.frm_mk31.tlp_rumah.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),7).getValue();
		document.frm_mk31.tlp_hp.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),8).getValue();
		document.frm_mk31.tlp_kantor.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),9).getValue();
		document.frm_mk31.fax.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),10).getValue();
		document.frm_mk31.identitas.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),11).getValue();
		document.frm_mk31.email.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),12).getValue();
		document.frm_mk31.npwp.value = gd_w4_mk3.cells(gd_w4_mk3.getSelectedId(),13).getValue();
		w3_mk3.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_mk3,'frmSearchCust');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_mk3,'frmSearchCust');
	}
	return;
}
</script>
</div>
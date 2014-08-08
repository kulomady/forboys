<div class="frmContainer">
<table width="259" border="0">
  <tr>
  	<td width="100">Cari Data</td>
    <td><input type="text" name="frmSearchMember" id="frmSearchMember" onKeyDown="tandaPanahMember(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridMember_mk4" style="width:525px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchMember').focus();

gd_w3_mk4 = new dhtmlXGridObject('gridMember_mk4');
gd_w3_mk4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_mk4.setHeader("&nbsp;,Surat Pesanan,Tanggal,Nama Pemesanan,Harga Jual,kode_member,nm_member",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_w3_mk4.setInitWidths("30,100,90,120,100,0,0");
gd_w3_mk4.setColAlign("right,left,left,left,right,left,left");
gd_w3_mk4.setColSorting("na,str,str,str,str,str,str");
gd_w3_mk4.setColTypes("cntr,ro,ro,ro,ron,ro,ro");
gd_w3_mk4.enableSmartRendering(true,50);
gd_w3_mk4.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahMember(13);
});
gd_w3_mk4.makeSearch("frmSearchMember",1);
gd_w3_mk4.setSkin("dhx_skyblue");
gd_w3_mk4.init();

gd_w3_mk4.clearAll();
gd_w3_mk4.loadXML(base_url+"index.php/pembayaran_developer/loadDataSP");

function tandaPanahMember(key) {
	if(key==13) {
		sp = 
		pemesan = 
		document.frm_mk4.sp.value = gd_w3_mk4.cells(gd_w3_mk4.getSelectedId(),1).getValue();
		document.frm_mk4.nm_pemesan.value = gd_w3_mk4.cells(gd_w3_mk4.getSelectedId(),3).getValue();
		document.frm_mk4.kd_member.value = gd_w3_mk4.cells(gd_w3_mk4.getSelectedId(),5).getValue();
		document.frm_mk4.nm_member.value = gd_w3_mk4.cells(gd_w3_mk4.getSelectedId(),6).getValue();
		document.frm_mk4.jml.focus();
		w2_mk4.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_mk4,'frmSearchMember');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_mk4,'frmSearchMember');
	}
	return;
}
</script>
</div>

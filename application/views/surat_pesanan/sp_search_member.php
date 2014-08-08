<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchMember" id="frmSearchMember" onKeyDown="tandaPanahMember(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridMember_mk3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchMember').focus();

gd_w3_mk3 = new dhtmlXGridObject('gridMember_mk3');
gd_w3_mk3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w3_mk3.setHeader("&nbsp;,ID Member,Nama Member, No. HP",null,["text-align:center","text-align:center"]);
gd_w3_mk3.setInitWidths("30,80,180,0");
gd_w3_mk3.setColAlign("right,left,left,left");
gd_w3_mk3.setColSorting("na,str,str,str");
gd_w3_mk3.setColTypes("cntr,ro,ro,ro");
gd_w3_mk3.enableSmartRendering(true,50);
gd_w3_mk3.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahMember(13);
});
gd_w3_mk3.makeSearch("frmSearchMember",1);
gd_w3_mk3.setSkin("dhx_skyblue");
gd_w3_mk3.init();

gd_w3_mk3.clearAll();
gd_w3_mk3.loadXML(base_url+"index.php/surat_pesanan/loadDataMember");

function tandaPanahMember(key) {
	if(key==13) {
		idMember = gd_w3_mk3.cells(gd_w3_mk3.getSelectedId(),1).getValue();
		nmMember = gd_w3_mk3.cells(gd_w3_mk3.getSelectedId(),2).getValue();
		hpMember = gd_w3_mk3.cells(gd_w3_mk3.getSelectedId(),3).getValue();
		document.frm_mk31.kode_member.value = idMember;
		document.frm_mk31.nama_member.value = nmMember;
		document.frm_mk31.no_hp.value = hpMember;
		w2_mk3.close();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w3_mk3,'frmSearchMember');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w3_mk3,'frmSearchMember');
	}
	return;
}
</script>
</div>

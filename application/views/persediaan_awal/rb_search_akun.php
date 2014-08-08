<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pd1" id="frmSearchAkun_pd1" onKeyDown="tandaPanahAkun_pd1(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pd1" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun_pd1').focus();

gd_w2_pd1 = new dhtmlXGridObject('gridAkun_pd1');
gd_w2_pd1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pd1.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pd1.setInitWidths("80,180,110");
gd_w2_pd1.setColAlign("left,left,left");
gd_w2_pd1.setColSorting("str,str,str");
gd_w2_pd1.setColTypes("ro,ro,ro");
gd_w2_pd1.enableSmartRendering(true,50);
gd_w2_pd1.makeSearch("frmSearchAkun_pd1",1);
gd_w2_pd1.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahAkun_pd1(13);
});
gd_w2_pd1.setSkin("dhx_skyblue");
gd_w2_pd1.init();

gd_w2_pd1.clearAll();
gd_w2_pd1.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun_pd1(key) {
	if(key==13) {
		idperkiraan = gd_w2_pd1.cells(gd_w2_pd1.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pd1.cells(gd_w2_pd1.getSelectedId(),1).getValue();
		document.frm_pd1.kdakun.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_pd1").innerHTML = nmPerkiraan;
		w2_pd1.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pd1,'frmSearchAkun_pd1');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pd1,'frmSearchAkun_pd1');
	}
	return;
}
</script>
</div>

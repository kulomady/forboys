<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pr4" id="frmSearchAkun_pr4" onKeyDown="tandaPanahAkun_pr4(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pr4" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun_pr4').focus();

gd_w2_pr4 = new dhtmlXGridObject('gridAkun_pr4');
gd_w2_pr4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pr4.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pr4.setInitWidths("80,180,110");
gd_w2_pr4.setColAlign("left,left,left");
gd_w2_pr4.setColSorting("str,str,str");
gd_w2_pr4.setColTypes("ro,ro,ro");
gd_w2_pr4.enableSmartRendering(true,50);
gd_w2_pr4.makeSearch("frmSearchAkun_pr4",1);
gd_w2_pr4.setSkin("dhx_skyblue");
gd_w2_pr4.init();

gd_w2_pr4.clearAll();
gd_w2_pr4.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun_pr4(key) {
	if(key==13) {
		idperkiraan = gd_w2_pr4.cells(gd_w2_pr4.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pr4.cells(gd_w2_pr4.getSelectedId(),1).getValue();
		document.frm_pr4.kdakun.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_pr4").innerHTML = nmPerkiraan;
		w2_pr4.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pr4,'frmSearchAkun_pr4');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pr4,'frmSearchAkun_pr4');
	}
	return;
}
</script>
</div>

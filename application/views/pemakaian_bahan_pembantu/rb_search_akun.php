<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pr3" id="frmSearchAkun_pr3" onKeyDown="tandaPanahAkun_pr3(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pr3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun_pr3').focus();

gd_w2_pr3 = new dhtmlXGridObject('gridAkun_pr3');
gd_w2_pr3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pr3.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pr3.setInitWidths("80,180,110");
gd_w2_pr3.setColAlign("left,left,left");
gd_w2_pr3.setColSorting("str,str,str");
gd_w2_pr3.setColTypes("ro,ro,ro");
gd_w2_pr3.enableSmartRendering(true,50);
gd_w2_pr3.makeSearch("frmSearchAkun_pr3",1);
gd_w2_pr3.setSkin("dhx_skyblue");
gd_w2_pr3.init();

gd_w2_pr3.clearAll();
gd_w2_pr3.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun_pr3(key) {
	if(key==13) {
		idperkiraan = gd_w2_pr3.cells(gd_w2_pr3.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pr3.cells(gd_w2_pr3.getSelectedId(),1).getValue();
		document.frm_pr3.kdakun.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_pr3").innerHTML = nmPerkiraan;
		w2_pr3.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pr3,'frmSearchAkun_pr3');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pr3,'frmSearchAkun_pr3');
	}
	return;
}
</script>
</div>

<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pj2" id="frmSearchAkun_pj2" onKeyDown="tandaPanahAkun_pj2(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pj2" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun_pj2').focus();

gd_w2_pj2 = new dhtmlXGridObject('gridAkun_pj2');
gd_w2_pj2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pj2.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pj2.setInitWidths("80,180,110");
gd_w2_pj2.setColAlign("left,left,left");
gd_w2_pj2.setColSorting("str,str,str");
gd_w2_pj2.setColTypes("ro,ro,ro");
gd_w2_pj2.enableSmartRendering(true,50);
gd_w2_pj2.makeSearch("frmSearchAkun_pj2",1);
gd_w2_pj2.setSkin("dhx_skyblue");
gd_w2_pj2.init();

gd_w2_pj2.clearAll();
gd_w2_pj2.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun_pj2(key) {
	if(key==13) {
		idperkiraan = gd_w2_pj2.cells(gd_w2_pj2.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pj2.cells(gd_w2_pj2.getSelectedId(),1).getValue();
		document.frm_pj2.kdakun.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_pj2").innerHTML = nmPerkiraan;
		w2_pj2.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pj2,'frmSearchAkun_pj2');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pj2,'frmSearchAkun_pj2');
	}
	return;
}
</script>
</div>

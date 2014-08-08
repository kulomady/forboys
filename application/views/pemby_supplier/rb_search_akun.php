<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pb2" id="frmSearchAkun_pb2" onKeyDown="tandaPanahAkun_pb2(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pb2" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchAkun_pb2').focus();

gd_w2_pb2 = new dhtmlXGridObject('gridAkun_pb2');
gd_w2_pb2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pb2.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pb2.setInitWidths("80,180,110");
gd_w2_pb2.setColAlign("left,left,left");
gd_w2_pb2.setColSorting("str,str,str");
gd_w2_pb2.setColTypes("ro,ro,ro");
gd_w2_pb2.enableSmartRendering(true,50);
gd_w2_pb2.makeSearch("frmSearchAkun_pb2",1);
gd_w2_pb2.setSkin("dhx_skyblue");
gd_w2_pb2.init();

gd_w2_pb2.clearAll();
gd_w2_pb2.loadXML(base_url+"index.php/rekan_bisnis/loadDataPerkiraan");

function tandaPanahAkun_pb2(key) {
	if(key==13) {
		idperkiraan = gd_w2_pb2.cells(gd_w2_pb2.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pb2.cells(gd_w2_pb2.getSelectedId(),1).getValue();
		document.frm_pb2.kdakun.value = idperkiraan;
		document.getElementById("tmpNmPerkiraan_pb2").innerHTML = nmPerkiraan;
		w2_pb2.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pb2,'frmSearchAkun_pb2');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pb2,'frmSearchAkun_pb2');
	}
	return;
}
</script>
</div>

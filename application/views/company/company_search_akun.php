<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun_pg2" id="frmSearchAkun_pg2" onKeyDown="tandaPanahAkun_pg2(event.keyCode,input,text);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridAkun_pg2" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">

gd_w2_pg2 = new dhtmlXGridObject('gridAkun_pg2');
gd_w2_pg2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w2_pg2.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_w2_pg2.setInitWidths("80,180,110");
gd_w2_pg2.setColAlign("left,left,left");
gd_w2_pg2.setColSorting("str,str,str");
gd_w2_pg2.setColTypes("ro,ro,ro");
gd_w2_pg2.enableSmartRendering(true,50);
gd_w2_pg2.makeSearch("frmSearchAkun_pg2",1);
gd_w2_pg2.setSkin("dhx_skyblue");
gd_w2_pg2.attachEvent("onRowDblClicked",pg2Clicked);
gd_w2_pg2.init();

gd_w2_pg2.clearAll();
gd_w2_pg2.loadXML(base_url+"index.php/company/loadDataPerkiraan",function() {
	document.getElementById('frmSearchAkun_pg2').focus();																		  
});

function tandaPanahAkun_pg2(key,input,text) {
//    alert(input+"|"+text);
	if(key==13) {
		idperkiraan = gd_w2_pg2.cells(gd_w2_pg2.getSelectedId(),0).getValue();
		nmPerkiraan = gd_w2_pg2.cells(gd_w2_pg2.getSelectedId(),1).getValue();
//		document.frm_pg2.txtidperkiraan.value = idperkiraan;
                document.getElementById(input).value = idperkiraan; 
		document.getElementById(text).innerHTML = nmPerkiraan;
		w2_pg2.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w2_pg2,'frmSearchAkun');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w2_pg2,'frmSearchAkun');
	}
	return;
}

function pg2Clicked(){
    tandaPanahAkun_pg2(13,input,text);
}
</script>
</div>

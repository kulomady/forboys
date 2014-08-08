<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchSize" id="frmSearchSize" onKeyDown="cariSize(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBarang_md31" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchSize').focus();

gd_w4_md31 = new dhtmlXGridObject('gridBarang_md31');
gd_w4_md31.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_md31.setHeader("Kode Size,Nama Size",null,["text-align:center","text-align:center"]);
gd_w4_md31.setInitWidths("80,180");
gd_w4_md31.setColAlign("left,left");
gd_w4_md31.setColSorting("str,str");
gd_w4_md31.setColTypes("ro,ro");
gd_w4_md31.enableSmartRendering(true,50);
gd_w4_md31.makeSearch("frmSearchSize",5);
gd_w4_md31.setSkin("dhx_skyblue");
gd_w4_md31.init();

if(<?php echo $kode_size; ?>!=0){
	gd_w4_md31.clearAll();
	gd_w4_md31.loadXML(base_url+"index.php/ref_sizerun/loadDataSize/<?php echo $kode_size; ?>");
}

function tandaPanahBarang(key) {
	if(key==13) {
		gdBrg_md31.cells(gdBrg_md31.getSelectedId(),0).setValue(gd_w4_md31.cells(gd_w4_md31.getSelectedId(),0).getValue());
		gdBrg_md31.cells(gdBrg_md31.getSelectedId(),2).setValue(gd_w4_md31.cells(gd_w4_md31.getSelectedId(),1).getValue());
		w3_md31.close();
		
		//Pengecekan Data
		var nmSize = gd_w4_md31.cells(gd_w4_md31.getSelectedId(),0).getValue();
		var cekSize = cariData(nmSize);
		if(cekSize=='1'){
			alert("Maaf kode data sudah diinput!");
			gdBrg_md31.cells(gdBrg_md31.getSelectedId(),0).setValue("");
			gdBrg_md31.cells(gdBrg_md31.getSelectedId(),2).setValue("");
			return true;
		} else {
			WinTambahBarang_md31();
		}
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_md31,'frmSearchSize');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_md31,'frmSearchSize');
	}
	return;
}

function cariSize(key){
	if(key==13){
		gd_w4_md31.clearAll();
		gd_w4_md31.loadXML(base_url+"index.php/ref_sizerun/loadDataSize/"+document.getElementById('frmSearchSize').value);
	}
}
</script>
</div>

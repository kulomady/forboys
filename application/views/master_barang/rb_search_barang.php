<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchBrg" id="frmSearchBrg" onKeyDown="tandaPanahBrg(event.keyCode);"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBarang_md3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">
document.getElementById('frmSearchBrg').focus();

gd_w4_md3 = new dhtmlXGridObject('gridBarang_md3');
gd_w4_md3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_md3.setHeader("Kode #,Nama Barang,Satuan",null,["text-align:center","text-align:center","text-align:center"]);
gd_w4_md3.setInitWidths("80,220,100");
gd_w4_md3.setColAlign("left,left,left");
gd_w4_md3.setColSorting("str,str,str");
gd_w4_md3.setColTypes("ro,ro,ro");
gd_w4_md3.enableSmartRendering(true,50);
gd_w4_md3.makeSearch("frmSearchBrg",0);
gd_w4_md3.setSkin("dhx_skyblue");
gd_w4_md3.init();

gd_w4_md3.clearAll();
gd_w4_md3.loadXML(base_url+"index.php/master_barang/loadDataBarang/<?php echo $idbarang; ?>");

function tandaPanahBrg(key) {
	if(key==13) {
		idbarang = gd_w4_md3.cells(gd_w4_md3.getSelectedId(),0).getValue();
		nmbarang = gd_w4_md3.cells(gd_w4_md3.getSelectedId(),1).getValue();
		satuan = gd_w4_md3.cells(gd_w4_md3.getSelectedId(),2).getValue();
		//setDataBrg_md41(idbarang,nmbarang,satuan)
		<?php echo $fungsi."(idbarang,nmbaang,satuan);"; ?>
		w4_md3.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_md3,'frmSearchBrg');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_md3,'frmSearchBrg');
	}
	return;
}
</script>
</div>

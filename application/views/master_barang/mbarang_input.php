<script>

tabbar_md3 = new dhtmlXTabBar("a_tabbar_md3", "top");
tabbar_md3.setSkin('dhx_skyblue');
tabbar_md3.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
tabbar_md3.addTab("a1", "Data Umum", "100px");
tabbar_md3.addTab("a2", "Satuan &amp; Ukuran", "110px");
tabbar_md3.addTab("a3", "Gambar", "100px");
tabbar_md3.setHrefMode("ajax-html");
<?php if(!isset($id)) { ?>
	tabbar_md3.setContentHref("a1", "<?php echo base_url(); ?>index.php/master_barang/frm_input_1");
	tabbar_md3.setContentHref("a2", "<?php echo base_url(); ?>index.php/master_barang/frm_input_2");
	tabbar_md3.setContentHref("a3", "<?php echo base_url(); ?>index.php/master_barang/frm_input_3");
<?php } else { ?>
	tabbar_md3.setContentHref("a1", "<?php echo base_url(); ?>index.php/master_barang/frm_edit_1/<?php echo $id ?>");
	tabbar_md3.setContentHref("a2", "<?php echo base_url(); ?>index.php/master_barang/frm_edit_2/<?php echo $id ?>");
	tabbar_md3.setContentHref("a3", "<?php echo base_url(); ?>index.php/master_barang/frm_edit_3/<?php echo $id ?>");
<?php } ?>
tabbar_md3.setTabActive("a1");
tabbar_md3.setTabActive("a2");
tabbar_md3.setTabActive("a3");
tabbar_md3.setTabActive("a1");
</script>
<table width="803" border="0">
  <tr>
    <td><div id="a_tabbar_md3" style="width:775px; height:270px;"/></td>
  </tr>
  <tr>
    <td><div id="tmpGridSize_md3" style="height:220px; width:773px;"></div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>

<script language="javascript">


gdSize_md3 = new dhtmlXGridObject('tmpGridSize_md3');
gdSize_md3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdSize_md3.setHeader("Kode Item,Ukuran,Satuan,Barcode,idbarang,Konversi,idgroup,Harga Beli,&nbsp;",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdSize_md3.setInitWidths("100,100,100,150,0,70,0,80,30");
gdSize_md3.setColAlign("left,left,left,left,left,center,left,right,center");
gdSize_md3.setColSorting("str,str,str,str,str,str,str,str,str");
gdSize_md3.setColTypes("ro,ro,ro,ed,ro,ro,ro,ron,ro");
gdSize_md3.setNumberFormat("0,000",7,",",".");
gdSize_md3.setSkin("dhx_skyblue");
gdSize_md3.init();

function hpsSatSize_md3() {
	idselect = gdSize_md3.getRowIndex(gdSize_md3.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = confirm("Apakah Anda Yakin ?");
	if(ya) {
		document.frm1_md3.idHapus.value = document.frm1_md3.idHapus.value+","+gdSize_md3.cells(gdSize_md3.getSelectedId(),4).getValue();
		gdSize_md3.deleteSelectedItem();
	}
}

function loadGdSize_md3(idbarang_induk) {
	gdSize_md3.clearAll();
	gdSize_md3.loadXML(base_url+"index.php/master_barang/loadDataSize/"+idbarang_induk);
}
</script>

<div id="tmpTb_md7" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md7" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md7" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md7" name="frmSearch_md7" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md7();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md7 = new dhtmlXToolbarObject("tmpTb_md7");
tb_md7.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md7.setSkin("dhx_terrace");
tb_md7.attachEvent("onclick", tbClick_md7);
tb_md7.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md7.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md7 = new dhtmlXLayoutObject("tmpLayout_md7", "2E");
dhxLayout_md7.cells("a").setText("Cari Data");
dhxLayout_md7.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md7.cells("a").setHeight(60);
dhxLayout_md7.cells("a").collapse();
dhxLayout_md7.cells("a").attachObject("tmpSearch_md7");
dhxLayout_md7.cells("b").setText("Site Navigation");
dhxLayout_md7.cells("b").hideHeader();

function tbClick_md7(id) {
	if(id=='new') {
		winForm_md7('input');
	} else if(id=='edit') {
		winForm_md7('edit');
	} else if(id=='del') {
		hapus_md7();
	} else if(id=='refresh') {
		loadGd_md7();
	} else if(id=='print') {
		cetak_md7();
	} else if(id=='cari') {
		if(dhxLayout_md7.cells("a").isCollapsed()) {
			dhxLayout_md7.cells("a").expand();
		} else {
			dhxLayout_md7.cells("a").collapse();
		}
	}
}

gd_md7 = dhxLayout_md7.cells("b").attachGrid();
gd_md7.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md7.setHeader("&nbsp;,Kode,Nama Wilayah,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md7.setInitWidths("30,80,150,120,120,100,100,80");
gd_md7.setColAlign("right,left,left,left,left,left,left,center");
gd_md7.setColSorting("na,str,str,str,str,str,str,str");
gd_md7.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
//gd_md7.enableSmartRendering(true,50);
gd_md7.setColumnColor("#CCE2FE");
gd_md7.setSkin("dhx_skyblue");
gd_md7.splitAt(1);
gd_md7.init();
loadGd_md7();

function loadGd_md7() {
	if(document.frmSearch_md7.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md7.kode.value;
	}
	
	if(document.frmSearch_md7.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md7.nama.value;
	}
	
	statusLoading();
	gd_md7.clearAll();
	gd_md7.loadXML(base_url+"index.php/master_wilayah/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md7() {
	gd_md7.updateFromXML(base_url+"index.php/master_wilayah/loadMainData");
}

function winForm_md7(type) {
	idselect = gd_md7.getRowIndex(gd_md7.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md7 = dhxWins.createWindow("w1_md7",0,0,350,180);
	w1_md7.setText("Data Wilayah");
	w1_md7.button("park").hide();
	w1_md7.button("minmax1").hide();
	w1_md7.center();
	w1_md7.setModal(true);
	if(type=='input') {
		w1_md7.attachURL(base_url+"index.php/master_wilayah/frm_input", true);
	} else {
		w1_md7.attachURL(base_url+"index.php/master_wilayah/frm_edit/"+gd_md7.getSelectedId(), true);
	}
	
	tb_w1_md7 = w1_md7.attachToolbar();
	tb_w1_md7.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md7.setSkin("dhx_terrace");
	tb_w1_md7.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md7.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md7.disableItem("baru");
	tb_w1_md7.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_md7();
		} else if(id=='baru') {
			tb_w1_md7.disableItem("baru");
			tb_w1_md7.enableItem("save");
			baru_md7();
		}
	});

}

function hapus_md7() {
	idselect = gd_md7.getRowIndex(gd_md7.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md7.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_wilayah/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_md7.deleteSelectedItem();
				//loadGd_md7();
			});
		}
}

</script>
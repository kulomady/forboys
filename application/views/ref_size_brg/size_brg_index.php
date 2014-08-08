<div id="tmpTb_md27" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md27" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md27" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md27" name="frmSearch_md27" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md27();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md27 = new dhtmlXToolbarObject("tmpTb_md27");
tb_md27.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md27.setSkin("dhx_terrace");
tb_md27.attachEvent("onclick", tbClick_md27);
tb_md27.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md27.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md27 = new dhtmlXLayoutObject("tmpLayout_md27", "2E");
dhxLayout_md27.cells("a").setText("Cari Data");
dhxLayout_md27.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md27.cells("a").setHeight(60);
dhxLayout_md27.cells("a").collapse();
dhxLayout_md27.cells("a").attachObject("tmpSearch_md27");
dhxLayout_md27.cells("b").setText("Site Navigation");
dhxLayout_md27.cells("b").hideHeader();

function tbClick_md27(id) {
	if(id=='new') {
		winForm_md27('input');
	} else if(id=='edit') {
		winForm_md27('edit');
	} else if(id=='del') {
		hapus_md27();
	} else if(id=='refresh') {
		 loadGd_md27();
	} else if(id=='print') {
		cetak_md27();
	} else if(id=='cari') {
		if(dhxLayout_md27.cells("a").isCollapsed()) {
			dhxLayout_md27.cells("a").expand();
		} else {
			dhxLayout_md27.cells("a").collapse();
		}
	}
}

gd_md27 = dhxLayout_md27.cells("b").attachGrid();
gd_md27.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md27.setHeader("&nbsp;,Kode,Nama size,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md27.setInitWidths("30,80,150,120,120,100,100,80");
gd_md27.setColAlign("right,left,left,left,left,left,left,center");
gd_md27.setColSorting("na,str,str,str,str,str,str,str");
gd_md27.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
//gd_md27.enableSmartRendering(true,50);
gd_md27.setColumnColor("#CCE2FE");
gd_md27.setSkin("dhx_skyblue");
gd_md27.splitAt(1);
gd_md27.init();
loadGd_md27();

function loadGd_md27() {
	if(document.frmSearch_md27.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md27.kode.value;
	}
	
	if(document.frmSearch_md27.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md27.nama.value;
	}
	
	statusLoading();
	gd_md27.clearAll();
	gd_md27.loadXML(base_url+"index.php/ref_size_brg/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md27() {
	gd_md27.updateFromXML(base_url+"index.php/ref_size_brg/loadMainData");
}

function winForm_md27(type) {
	idselect = gd_md27.getRowIndex(gd_md27.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md27 = dhxWins.createWindow("w1_md27",0,0,350,200);
	w1_md27.setText("Tambah Data size Barang");
	w1_md27.button("park").hide();
	w1_md27.button("minmax1").hide();
	w1_md27.center();
	w1_md27.setModal(true);
	if(type=='input') {
		w1_md27.attachURL(base_url+"index.php/ref_size_brg/frm_input", true);
	} else {
		w1_md27.attachURL(base_url+"index.php/ref_size_brg/frm_edit/"+gd_md27.getSelectedId(), true);
	}
	
	tb_w1_md27 = w1_md27.attachToolbar();
	tb_w1_md27.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md27.setSkin("dhx_terrace");
	tb_w1_md27.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md27.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md27.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md27.disableItem("baru");
	tb_w1_md27.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md27.reset();
		} else if(id=='save') {
			simpan_md27();
		} else if(id=='baru') {
			tb_w1_md27.disableItem("baru");
			tb_w1_md27.enableItem("save");
			tb_w1_md27.enableItem("batal");
			baru_md27();
		}
	});

}

function hapus_md27() {
	idselect = gd_md27.getRowIndex(gd_md27.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md27.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_size_brg/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				alert(result);
				statusEnding();
				gd_md27.deleteSelectedItem();
				//loadGd_md27();
			});
		}
}

</script>
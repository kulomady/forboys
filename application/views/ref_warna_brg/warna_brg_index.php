<div id="tmpTb_md25" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md25" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md25" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md25" name="frmSearch_md25" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md25();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md25 = new dhtmlXToolbarObject("tmpTb_md25");
tb_md25.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md25.setSkin("dhx_terrace");
tb_md25.attachEvent("onclick", tbClick_md25);
tb_md25.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md25.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md25 = new dhtmlXLayoutObject("tmpLayout_md25", "2E");
dhxLayout_md25.cells("a").setText("Cari Data");
dhxLayout_md25.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md25.cells("a").setHeight(60);
dhxLayout_md25.cells("a").collapse();
dhxLayout_md25.cells("a").attachObject("tmpSearch_md25");
dhxLayout_md25.cells("b").setText("Site Navigation");
dhxLayout_md25.cells("b").hideHeader();

function tbClick_md25(id) {
	if(id=='new') {
		winForm_md25('input');
	} else if(id=='edit') {
		winForm_md25('edit');
	} else if(id=='del') {
		hapus_md25();
	} else if(id=='refresh') {
		 loadGd_md25();
	} else if(id=='print') {
		cetak_md25();
	} else if(id=='cari') {
		if(dhxLayout_md25.cells("a").isCollapsed()) {
			dhxLayout_md25.cells("a").expand();
		} else {
			dhxLayout_md25.cells("a").collapse();
		}
	}
}

gd_md25 = dhxLayout_md25.cells("b").attachGrid();
gd_md25.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md25.setHeader("&nbsp;,Kode,Nama warna,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md25.setInitWidths("30,80,150,120,120,100,100,80");
gd_md25.setColAlign("right,left,left,left,left,left,left,center");
gd_md25.setColSorting("na,str,str,str,str,str,str,str");
gd_md25.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
gd_md25.enableSmartRendering(true,50);
gd_md25.setColumnColor("#CCE2FE");
gd_md25.setSkin("dhx_skyblue");
gd_md25.splitAt(1);
gd_md25.init();
loadGd_md25();

function loadGd_md25() {
	if(document.frmSearch_md25.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md25.kode.value;
	}
	
	if(document.frmSearch_md25.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md25.nama.value;
	}
	
	statusLoading();
	gd_md25.clearAll();
	gd_md25.loadXML(base_url+"index.php/ref_warna_brg/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md25() {
	gd_md25.updateFromXML(base_url+"index.php/ref_warna_brg/loadMainData");
}

function winForm_md25(type) {
	idselect = gd_md25.getRowIndex(gd_md25.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md25 = dhxWins.createWindow("w1_md25",0,0,350,200);
	w1_md25.setText("Tambah Data warna Barang");
	w1_md25.button("park").hide();
	w1_md25.button("minmax1").hide();
	w1_md25.center();
	w1_md25.setModal(true);
	if(type=='input') {
		w1_md25.attachURL(base_url+"index.php/ref_warna_brg/frm_input", true);
	} else {
		w1_md25.attachURL(base_url+"index.php/ref_warna_brg/frm_edit/"+gd_md25.getSelectedId(), true);
	}
	
	tb_w1_md25 = w1_md25.attachToolbar();
	tb_w1_md25.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md25.setSkin("dhx_terrace");
	tb_w1_md25.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md25.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md25.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md25.disableItem("baru");
	tb_w1_md25.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md25.reset();
		} else if(id=='save') {
			simpan_md25();
		} else if(id=='baru') {
			tb_w1_md25.disableItem("baru");
			tb_w1_md25.enableItem("save");
			tb_w1_md25.enableItem("batal");
			baru_md25();
		}
	});

}

function hapus_md25() {
	idselect = gd_md25.getRowIndex(gd_md25.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md25.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_warna_brg/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_md25.deleteSelectedItem();
				} else {
					alert("Data tidak dapat dihapus");
				}
				//loadGd_md25();
			});
		}
}

</script>
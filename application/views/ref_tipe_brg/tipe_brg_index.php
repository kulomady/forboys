<div id="tmpTb_md21" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md21" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md21" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md21" name="frmSearch_md21" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md21();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md21 = new dhtmlXToolbarObject("tmpTb_md21");
tb_md21.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md21.setSkin("dhx_terrace");
tb_md21.attachEvent("onclick", tbClick_md21);
tb_md21.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md21.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md21 = new dhtmlXLayoutObject("tmpLayout_md21", "2E");
dhxLayout_md21.cells("a").setText("Cari Data");
dhxLayout_md21.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md21.cells("a").setHeight(60);
dhxLayout_md21.cells("a").collapse();
dhxLayout_md21.cells("a").attachObject("tmpSearch_md21");
dhxLayout_md21.cells("b").setText("Site Navigation");
dhxLayout_md21.cells("b").hideHeader();

function tbClick_md21(id) {
	if(id=='new') {
		winForm_md21('input');
	} else if(id=='edit') {
		winForm_md21('edit');
	} else if(id=='del') {
		hapus_md21();
	} else if(id=='refresh') {
		 loadGd_md21();
	} else if(id=='print') {
		cetak_md21();
	} else if(id=='cari') {
		if(dhxLayout_md21.cells("a").isCollapsed()) {
			dhxLayout_md21.cells("a").expand();
		} else {
			dhxLayout_md21.cells("a").collapse();
		}
	}
}

gd_md21 = dhxLayout_md21.cells("b").attachGrid();
gd_md21.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md21.setHeader("&nbsp;,Kode,Nama Tipe,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh,Is Active",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md21.setInitWidths("30,80,150,120,120,100,100,80");
gd_md21.setColAlign("right,left,left,left,left,left,left,center");
gd_md21.setColSorting("na,str,str,str,str,str,str,str");
gd_md21.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
//gd_md21.enableSmartRendering(true,50);
gd_md21.setColumnColor("#CCE2FE");
gd_md21.setSkin("dhx_skyblue");
gd_md21.splitAt(1);
gd_md21.init();
loadGd_md21();

function loadGd_md21() {
	if(document.frmSearch_md21.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md21.kode.value;
	}
	
	if(document.frmSearch_md21.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md21.nama.value;
	}
	
	statusLoading();
	gd_md21.clearAll();
	gd_md21.loadXML(base_url+"index.php/ref_tipe_brg/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md21() {
	gd_md21.updateFromXML(base_url+"index.php/ref_tipe_brg/loadMainData");
}

function winForm_md21(type) {
	idselect = gd_md21.getRowIndex(gd_md21.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md21 = dhxWins.createWindow("w1_md21",0,0,350,200);
	w1_md21.setText("Tambah Data Tipe Barang");
	w1_md21.button("park").hide();
	w1_md21.button("minmax1").hide();
	w1_md21.center();
	w1_md21.setModal(true);
	if(type=='input') {
		w1_md21.attachURL(base_url+"index.php/ref_tipe_brg/frm_input", true);
	} else {
		w1_md21.attachURL(base_url+"index.php/ref_tipe_brg/frm_edit/"+gd_md21.getSelectedId(), true);
	}
	
	tb_w1_md21 = w1_md21.attachToolbar();
	tb_w1_md21.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md21.setSkin("dhx_terrace");
	tb_w1_md21.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md21.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md21.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md21.disableItem("baru");
	tb_w1_md21.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md21.reset();
		} else if(id=='save') {
			simpan_md21();
		} else if(id=='baru') {
			tb_w1_md21.disableItem("baru");
			tb_w1_md21.enableItem("save");
			tb_w1_md21.enableItem("batal");
			baru_md21();
		}
	});

}

function hapus_md21() {
	idselect = gd_md21.getRowIndex(gd_md21.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md21.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_tipe_brg/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_md21.deleteSelectedItem();
				//loadGd_md21();
			});
		}
}

</script>
<div id="tmpTb_md22" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md22" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md22" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md22" name="frmSearch_md22" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md22();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md22 = new dhtmlXToolbarObject("tmpTb_md22");
tb_md22.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md22.setSkin("dhx_terrace");
tb_md22.attachEvent("onclick", tbClick_md22);
tb_md22.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md22.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md22 = new dhtmlXLayoutObject("tmpLayout_md22", "2E");
dhxLayout_md22.cells("a").setText("Cari Data");
dhxLayout_md22.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md22.cells("a").setHeight(60);
dhxLayout_md22.cells("a").collapse();
dhxLayout_md22.cells("a").attachObject("tmpSearch_md22");
dhxLayout_md22.cells("b").setText("Site Navigation");
dhxLayout_md22.cells("b").hideHeader();

function tbClick_md22(id) {
	if(id=='new') {
		winForm_md22('input');
	} else if(id=='edit') {
		winForm_md22('edit');
	} else if(id=='del') {
		hapus_md22();
	} else if(id=='refresh') {
		 loadGd_md22();
	} else if(id=='print') {
		cetak_md22();
	} else if(id=='cari') {
		if(dhxLayout_md22.cells("a").isCollapsed()) {
			dhxLayout_md22.cells("a").expand();
		} else {
			dhxLayout_md22.cells("a").collapse();
		}
	}
}

gd_md22 = dhxLayout_md22.cells("b").attachGrid();
gd_md22.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md22.setHeader("&nbsp;,Kode,Nama Kategori,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh,Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md22.setInitWidths("30,80,150,120,120,100,100,80");
gd_md22.setColAlign("right,left,left,left,left,left,left,center");
gd_md22.setColSorting("na,str,str,str,str,str,str,str");
gd_md22.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
//gd_md22.enableSmartRendering(true,50);
gd_md22.setColumnColor("#CCE2FE");
gd_md22.setSkin("dhx_skyblue");
gd_md22.splitAt(1);
gd_md22.init();
loadGd_md22();

function loadGd_md22() {
	if(document.frmSearch_md22.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md22.kode.value;
	}
	
	if(document.frmSearch_md22.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md22.nama.value;
	}
	
	statusLoading();
	gd_md22.clearAll();
	gd_md22.loadXML(base_url+"index.php/ref_kategori_brg/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md22() {
	gd_md22.updateFromXML(base_url+"index.php/ref_kategori_brg/loadMainData");
}

function winForm_md22(type) {
	idselect = gd_md22.getRowIndex(gd_md22.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md22 = dhxWins.createWindow("w1_md22",0,0,350,200);
	w1_md22.setText("Tambah Data Kategori Barang");
	w1_md22.button("park").hide();
	w1_md22.button("minmax1").hide();
	w1_md22.center();
	w1_md22.setModal(true);
	if(type=='input') {
		w1_md22.attachURL(base_url+"index.php/ref_kategori_brg/frm_input", true);
	} else {
		w1_md22.attachURL(base_url+"index.php/ref_kategori_brg/frm_edit/"+gd_md22.getSelectedId(), true);
	}
	
	tb_w1_md22 = w1_md22.attachToolbar();
	tb_w1_md22.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md22.setSkin("dhx_terrace");
	tb_w1_md22.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md22.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md22.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md22.disableItem("baru");
	tb_w1_md22.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md22.reset();
		} else if(id=='save') {
			simpan_md22();
		} else if(id=='baru') {
			tb_w1_md22.disableItem("baru");
			tb_w1_md22.enableItem("save");
			tb_w1_md22.enableItem("batal");
			baru_md22();
		}
	});

}

function hapus_md22() {
	idselect = gd_md22.getRowIndex(gd_md22.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md22.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_kategori_brg/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_md22.deleteSelectedItem();
				//loadGd_md22();
			});
		}
}

</script>
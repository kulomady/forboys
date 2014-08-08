<div id="tmpTb_mk2" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_mk2" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_mk2" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_mk2" name="frmSearch_mk2" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_mk2();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_mk2 = new dhtmlXToolbarObject("tmpTb_mk2");
tb_mk2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_mk2.setSkin("dhx_terrace");
tb_mk2.attachEvent("onclick", tbClick_mk2);
tb_mk2.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_mk2.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_mk2 = new dhtmlXLayoutObject("tmpLayout_mk2", "2E");
dhxLayout_mk2.cells("a").setText("Cari Data");
dhxLayout_mk2.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_mk2.cells("a").setHeight(60);
dhxLayout_mk2.cells("a").collapse();
dhxLayout_mk2.cells("a").attachObject("tmpSearch_mk2");
dhxLayout_mk2.cells("b").setText("Site Navigation");
dhxLayout_mk2.cells("b").hideHeader();

function tbClick_mk2(id) {
	if(id=='new') {
		winForm_mk2('input');
	} else if(id=='edit') {
		winForm_mk2('edit');
	} else if(id=='del') {
		hapus_mk2();
	} else if(id=='refresh') {
		 loadGd_mk2();
	} else if(id=='print') {
		cetak_mk2();
	} else if(id=='cari') {
		if(dhxLayout_mk2.cells("a").isCollapsed()) {
			dhxLayout_mk2.cells("a").expand();
		} else {
			dhxLayout_mk2.cells("a").collapse();
		}
	}
}

gd_mk2 = dhxLayout_mk2.cells("b").attachGrid();
gd_mk2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_mk2.setHeader("&nbsp;,NUP,Nama Perusahaan,Tgl Buat,Dibuat Oleh, Tgl Modifikasi, Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_mk2.setInitWidths("30,150,200,120,100,120,100");
gd_mk2.setColAlign("right,left,left,left,left,left,left");
gd_mk2.setColSorting("na,str,str,str,str,str,str");
gd_mk2.setColTypes("cntr,ro,ro,ro,ro,ro,ro");
gd_mk2.enableSmartRendering(true,50);
gd_mk2.setColumnColor("#CCE2FE");
gd_mk2.setSkin("dhx_skyblue");
gd_mk2.splitAt(1);
gd_mk2.init();
loadGd_mk2();

function loadGd_mk2() {
	gd_mk2.clearAll();
	gd_mk2.loadXML(base_url+"index.php/fps/loadMainData");
}

function refreshGd_mk2() {
	gd_mk2.updateFromXML(base_url+"index.php/fps/loadMainData");
}

function winForm_mk2(type) {
	idselect = gd_mk2.getRowIndex(gd_mk2.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_mk2 = dhxWins.createWindow("w1_mk2",0,0,650,605);
	w1_mk2.setText("Tambah Data Formulir Pemesanan Sementara");
	w1_mk2.button("park").hide();
	w1_mk2.button("minmax1").hide();
	w1_mk2.center();
	w1_mk2.setModal(true);
	if(type=='input') {
		w1_mk2.attachURL(base_url+"index.php/fps/frm_input", true);
	} else {
		w1_mk2.attachURL(base_url+"index.php/fps/frm_edit/"+gd_mk2.getSelectedId(), true);
	}
	
	tb_w1_mk2 = w1_mk2.attachToolbar();
	tb_w1_mk2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_mk2.setSkin("dhx_terrace");
	tb_w1_mk2.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_mk2.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_mk2.disableItem("baru");
	tb_w1_mk2.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_mk2();
		} else if(id=='baru') {
			tb_w1_mk2.disableItem("baru");
			tb_w1_mk2.enableItem("save");
			baru_mk2();
		}
	});

}

function hapus_mk2() {
	idselect = gd_mk2.getRowIndex(gd_mk2.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	cf = confirm("Apakah Anda Yakin ?");
	if(cf) {
		 poststr =
            	'idrec=' + gd_mk2.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/fps/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				loadGd_mk2();
			});
		}
}

</script>
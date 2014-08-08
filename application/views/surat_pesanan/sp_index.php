<div id="tmpTb_mk3" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_mk3" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_mk3" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_mk3" name="frmSearch_mk3" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_mk3();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_mk3 = new dhtmlXToolbarObject("tmpTb_mk3");
tb_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_mk3.setSkin("dhx_terrace");
tb_mk3.attachEvent("onclick", tbClick_mk3);
tb_mk3.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_mk3.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_mk3 = new dhtmlXLayoutObject("tmpLayout_mk3", "2E");
dhxLayout_mk3.cells("a").setText("Cari Data");
dhxLayout_mk3.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_mk3.cells("a").setHeight(60);
dhxLayout_mk3.cells("a").collapse();
dhxLayout_mk3.cells("a").attachObject("tmpSearch_mk3");
dhxLayout_mk3.cells("b").setText("Site Navigation");
dhxLayout_mk3.cells("b").hideHeader();

function tbClick_mk3(id) {
	if(id=='new') {
		winForm_mk3('input');
	} else if(id=='edit') {
		winForm_mk3('edit');
	} else if(id=='del') {
		hapus_mk3();
	} else if(id=='refresh') {
		 loadGd_mk3();
	} else if(id=='print') {
		cetak_mk3();
	} else if(id=='cari') {
		if(dhxLayout_mk3.cells("a").isCollapsed()) {
			dhxLayout_mk3.cells("a").expand();
		} else {
			dhxLayout_mk3.cells("a").collapse();
		}
	}
}

gd_mk3 = dhxLayout_mk3.cells("b").attachGrid();
gd_mk3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_mk3.setHeader("&nbsp;,Surat Pesanan,Tanggal,Harga Jual (No PPN), Komisi Perusahaan, Tgl Buat,Dibuat Oleh, Tgl Modifikasi, Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_mk3.setInitWidths("30,150,200,200,200,120,100,120,100");
gd_mk3.setColAlign("right,left,left,right,right,left,left,left,left");
gd_mk3.setColSorting("na,str,str,str,str,str,str,str,str");
gd_mk3.setColTypes("cntr,ro,ro,ron,ron,ro,ro,ro,ro");
gd_mk3.enableSmartRendering(true,50);
gd_mk3.setNumberFormat("0,000",3,",",".");
gd_mk3.setNumberFormat("0,000",4,",",".");
gd_mk3.setColumnColor("#CCE2FE");
gd_mk3.setSkin("dhx_skyblue");
gd_mk3.splitAt(1);
gd_mk3.init();
loadGd_mk3();

function loadGd_mk3() {
	gd_mk3.clearAll();
	gd_mk3.loadXML(base_url+"index.php/surat_pesanan/loadMainData");
}

function refreshGd_mk3() {
	gd_mk3.updateFromXML(base_url+"index.php/surat_pesanan/loadMainData");
}

function winForm_mk3(type) {
	idselect = gd_mk3.getRowIndex(gd_mk3.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_mk3 = dhxWins.createWindow("w1_mk3",0,0,950,645);
	w1_mk3.setText("Tambah Data Surat Pesanan");
	w1_mk3.button("park").hide();
	w1_mk3.button("minmax1").hide();
	w1_mk3.center();
	w1_mk3.setModal(true);
	if(type=='input') {
		w1_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_input", true);
	} else {
		w1_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_edit/"+gd_mk3.getSelectedId(), true);
	}
	
	tb_w1_mk3 = w1_mk3.attachToolbar();
	tb_w1_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_mk3.setSkin("dhx_terrace");
	tb_w1_mk3.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_mk3.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_mk3.disableItem("baru");
	tb_w1_mk3.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_mk3();
		} else if(id=='baru') {
			tb_w1_mk3.disableItem("baru");
			tb_w1_mk3.enableItem("save");
			baru_mk3();
		}
	});
}

function hapus_mk3() {
	idselect = gd_mk3.getRowIndex(gd_mk3.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	cf = confirm("Apakah Anda Yakin ?");
	if(cf) {
		 poststr =
            	'idrec=' + gd_mk3.getSelectedId();
		statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/surat_pesanan/hapus", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			loadGd_mk3();
		});
	}
}
</script>
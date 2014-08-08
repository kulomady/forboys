<div id="tmpTb_mk4" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_mk4" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_mk4" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_mk4" name="frmSearch_mk4" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_mk4();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_mk4 = new dhtmlXToolbarObject("tmpTb_mk4");
tb_mk4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_mk4.setSkin("dhx_terrace");
tb_mk4.attachEvent("onclick", tbClick_mk4);
tb_mk4.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_mk4.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_mk4 = new dhtmlXLayoutObject("tmpLayout_mk4", "2E");
dhxLayout_mk4.cells("a").setText("Cari Data");
dhxLayout_mk4.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_mk4.cells("a").setHeight(60);
dhxLayout_mk4.cells("a").collapse();
dhxLayout_mk4.cells("a").attachObject("tmpSearch_mk4");
dhxLayout_mk4.cells("b").setText("Site Navigation");
dhxLayout_mk4.cells("b").hideHeader();

function tbClick_mk4(id) {
	if(id=='new') {
		winForm_mk4('input');
	} else if(id=='edit') {
		winForm_mk4('edit');
	} else if(id=='del') {
		hapus_mk4();
	} else if(id=='refresh') {
		 loadGd_mk4();
	} else if(id=='print') {
		cetak_mk4();
	} else if(id=='cari') {
		if(dhxLayout_mk4.cells("a").isCollapsed()) {
			dhxLayout_mk4.cells("a").expand();
		} else {
			dhxLayout_mk4.cells("a").collapse();
		}
	}
}

gd_mk4 = dhxLayout_mk4.cells("b").attachGrid();
gd_mk4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_mk4.setHeader("&nbsp;,No Pembayaran,Tanggal,Pemesan,Jumlah Pembayaran,Tgl Buat,Dibuat Oleh, Tgl Modifikasi, Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_mk4.setInitWidths("30,150,100,120,100,120,100,120,100");
gd_mk4.setColAlign("right,left,left,left,right,left,left,left,left");
gd_mk4.setColSorting("na,str,str,str,str,str,str,str,str");
gd_mk4.setColTypes("cntr,ro,ro,ro,ron,ro,ro,ro,ro");
gd_mk4.enableSmartRendering(true,50);
gd_mk4.setNumberFormat("0,000",4,",",".");
gd_mk4.setColumnColor("#CCE2FE");
gd_mk4.setSkin("dhx_skyblue");
gd_mk4.splitAt(1);
gd_mk4.init();
loadGd_mk4();

function loadGd_mk4() {
	gd_mk4.clearAll();
	gd_mk4.loadXML(base_url+"index.php/pembayaran_developer/loadMainData");
}

function refreshGd_mk4() {
	gd_mk4.updateFromXML(base_url+"index.php/pembayaran_developer/loadMainData");
}

function winForm_mk4(type) {
	idselect = gd_mk4.getRowIndex(gd_mk4.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_mk4 = dhxWins.createWindow("w1_mk4",0,0,440,270);
	w1_mk4.setText("Tambah Data Pembayaran Developer");
	w1_mk4.button("park").hide();
	w1_mk4.button("minmax1").hide();
	w1_mk4.center();
	w1_mk4.setModal(true);
	if(type=='input') {
		w1_mk4.attachURL(base_url+"index.php/pembayaran_developer/frm_input", true);
	} else {
		w1_mk4.attachURL(base_url+"index.php/pembayaran_developer/frm_edit/"+gd_mk4.getSelectedId(), true);
	}
	
	tb_w1_mk4 = w1_mk4.attachToolbar();
	tb_w1_mk4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_mk4.setSkin("dhx_terrace");
	tb_w1_mk4.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_mk4.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_mk4.disableItem("baru");
	tb_w1_mk4.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_mk4();
		} else if(id=='baru') {
			tb_w1_mk4.disableItem("baru");
			tb_w1_mk4.enableItem("save");
			baru_mk4();
		}
	});

}

function hapus_mk4() {
	idselect = gd_mk4.getRowIndex(gd_mk4.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	cf = confirm("Apakah Anda Yakin ?");
	if(cf) {
		 poststr =
            	'idrec=' + gd_mk4.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pembayaran_developer/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				loadGd_mk4();
			});
		}
}

</script>
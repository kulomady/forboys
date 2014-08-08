<div id="tmpTb_md5" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md5" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md5" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md5" name="frmSearch_md5" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md5();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md5 = new dhtmlXToolbarObject("tmpTb_md5");
tb_md5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md5.setSkin("dhx_terrace");
tb_md5.attachEvent("onclick", tbClick_md5);
tb_md5.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md5.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md5 = new dhtmlXLayoutObject("tmpLayout_md5", "2E");
dhxLayout_md5.cells("a").setText("Cari Data");
dhxLayout_md5.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md5.cells("a").setHeight(60);
dhxLayout_md5.cells("a").collapse();
dhxLayout_md5.cells("a").attachObject("tmpSearch_md5");
dhxLayout_md5.cells("b").setText("Site Navigation");
dhxLayout_md5.cells("b").hideHeader();

function tbClick_md5(id) {
	if(id=='new') {
		winForm_md5('input');
	} else if(id=='edit') {
		winForm_md5('edit');
	} else if(id=='del') {
		hapus_md5();
	} else if(id=='refresh') {
		 loadGd_md5();
	} else if(id=='print') {
		cetak_md5();
	} else if(id=='cari') {
		if(dhxLayout_md5.cells("a").isCollapsed()) {
			dhxLayout_md5.cells("a").expand();
		} else {
			dhxLayout_md5.cells("a").collapse();
		}
	}
}

gd_md5 = dhxLayout_md5.cells("b").attachGrid();
gd_md5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md5.setHeader("&nbsp;,Kode,Nama Developer,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md5.setInitWidths("30,80,150,120,120,100,100,80");
gd_md5.setColAlign("right,left,left,left,left,left,left,center");
gd_md5.setColSorting("na,str,str,str,str,str,str,str");
gd_md5.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
gd_md5.enableSmartRendering(true,50);
gd_md5.setColumnColor("#CCE2FE");
gd_md5.setSkin("dhx_skyblue");
gd_md5.splitAt(1);
gd_md5.init();
loadGd_md5();

function loadGd_md5() {
	if(document.frmSearch_md5.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md5.kode.value;
	}
	
	if(document.frmSearch_md5.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md5.nama.value;
	}
	
	statusLoading();
	gd_md5.clearAll();
	gd_md5.loadXML(base_url+"index.php/master_developer/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md5() {
	gd_md5.updateFromXML(base_url+"index.php/master_developer/loadMainData");
}

function winForm_md5(type) {
	idselect = gd_md5.getRowIndex(gd_md5.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md5 = dhxWins.createWindow("w1_md5",0,0,670,390);
	w1_md5.setText("Tambah Data Developer");
	w1_md5.button("park").hide();
	w1_md5.button("minmax1").hide();
	w1_md5.center();
	w1_md5.setModal(true);
	if(type=='input') {
		w1_md5.attachURL(base_url+"index.php/master_developer/frm_utama", true);
	} else {
		w1_md5.attachURL(base_url+"index.php/master_developer/frm_edit/"+gd_md5.getSelectedId(), true);
	}
	
	tb_w1_md5 = w1_md5.attachToolbar();
	tb_w1_md5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md5.setSkin("dhx_terrace");
	tb_w1_md5.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md5.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md5.disableItem("baru");
	tb_w1_md5.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md5.reset();
		} else if(id=='save') {
			simpan_md5();
		} else if(id=='baru') {
			tb_w1_md5.disableItem("baru");
			tb_w1_md5.enableItem("save");
			baru_md5();
			baru_md52();
			baru_md53();
		}
	});

}

function hapus_md5() {
	idselect = gd_md5.getRowIndex(gd_md5.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md5.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_developer/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_md5.deleteSelectedItem();
				} else {
					alert("Data tidak dapat dihapus");
				}
				//loadGd_md5();
			});
		}
}

</script>
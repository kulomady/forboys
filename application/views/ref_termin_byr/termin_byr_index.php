<div id="tmpTb_md33" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md33" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md33" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_md33" name="frmSearch_md33" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="101">Nama Termin</td>
        <td width="174"><input type="text" name="nama" id="nama" /></td>
        <td width="75">Jml Hari</td>
        <td width="193"><input type="text" name="jmlHari" id="jmlHari" /></td>
        <td width="391"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md33();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md33 = new dhtmlXToolbarObject("tmpTb_md33");
tb_md33.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md33.setSkin("dhx_terrace");
tb_md33.attachEvent("onclick", tbClick_md33);
tb_md33.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md33.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md33 = new dhtmlXLayoutObject("tmpLayout_md33", "2E");
dhxLayout_md33.cells("a").setText("Cari Data");
dhxLayout_md33.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md33.cells("a").setHeight(60);
dhxLayout_md33.cells("a").collapse();
dhxLayout_md33.cells("a").attachObject("tmpSearch_md33");
dhxLayout_md33.cells("b").setText("Site Navigation");
dhxLayout_md33.cells("b").hideHeader();

function tbClick_md33(id) {
	if(id=='new') {
		winForm_md33('input');
	} else if(id=='edit') {
		winForm_md33('edit');
	} else if(id=='del') {
		hapus_md33();
	} else if(id=='refresh') {
		loadGd_md33();
	} else if(id=='print') {
		cetak_md33();
	} else if(id=='cari') {
		if(dhxLayout_md33.cells("a").isCollapsed()) {
			dhxLayout_md33.cells("a").expand();
		} else {
			dhxLayout_md33.cells("a").collapse();
		}
	}
}

gd_md33 = dhxLayout_md33.cells("b").attachGrid();
gd_md33.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md33.setHeader("&nbsp;,Nama Termin,Jml Hari,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md33.setInitWidths("30,150,100,120,120,100,100,80");
gd_md33.setColAlign("right,left,left,left,left,left,left,center");
gd_md33.setColSorting("na,str,str,str,str,str,str,str");
gd_md33.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
//gd_md33.enableSmartRendering(true,50);
gd_md33.setColumnColor("#CCE2FE");
gd_md33.setSkin("dhx_skyblue");
gd_md33.splitAt(1);
gd_md33.init();
loadGd_md33();

function loadGd_md33() {
	if(document.frmSearch_md33.jmlHari.value=="") {
		jmlHari = "0";
	} else {
		jmlHari = document.frmSearch_md33.jmlHari.value;
	}
	
	if(document.frmSearch_md33.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md33.nama.value;
	}
	
	statusLoading();
	gd_md33.clearAll();
	gd_md33.loadXML(base_url+"index.php/ref_termin_byr/loadMainData/"+jmlHari+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md33() {
	if(document.frmSearch_md33.jmlHari.value=="") {
		jmlHari = "0";
	} else {
		jmlHari = document.frmSearch_md33.jmlHari.value;
	}
	
	if(document.frmSearch_md33.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md33.nama.value;
	}
	gd_md33.updateFromXML(base_url+"index.php/ref_termin_byr/loadMainData/"+jmlHari+"/"+nama);
}

function winForm_md33(type) {
	idselect = gd_md33.getRowIndex(gd_md33.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md33 = dhxWins.createWindow("w1_md33",0,0,350,200);
	w1_md33.setText("Data Termin Pembayaran");
	w1_md33.button("park").hide();
	w1_md33.button("minmax1").hide();
	w1_md33.center();
	w1_md33.setModal(true);
	if(type=='input') {
		w1_md33.attachURL(base_url+"index.php/ref_termin_byr/frm_input", true);
	} else {
		w1_md33.attachURL(base_url+"index.php/ref_termin_byr/frm_edit/"+gd_md33.getSelectedId(), true);
	}
	
	tb_w1_md33 = w1_md33.attachToolbar();
	tb_w1_md33.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md33.setSkin("dhx_terrace");
	tb_w1_md33.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md33.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md33.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md33.disableItem("baru");
	tb_w1_md33.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md33.reset();
		} else if(id=='save') {
			simpan_md33();
		} else if(id=='baru') {
			tb_w1_md33.disableItem("baru");
			tb_w1_md33.enableItem("save");
			tb_w1_md33.enableItem("batal");
			baru_md33();
		}
	});

}

function hapus_md33() {
	idselect = gd_md33.getRowIndex(gd_md33.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md33.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_termin_byr/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_md33.deleteSelectedItem();
				//loadGd_md33();
			});
		}
}

</script>
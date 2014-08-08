<div id="tmpTb_md41" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md41" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md41" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md41" name="frmSearch_md41" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md41();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md41 = new dhtmlXToolbarObject("tmpTb_md41");
tb_md41.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md41.setSkin("dhx_terrace");
tb_md41.attachEvent("onclick", tbClick_md41);
tb_md41.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md41.hideItem('print');
	<?php echo $hak_toolbar; ?>
	tb_md41.addButton("export", 7, "EXPORT", "export.png", "export.png");
});

dhxLayout_md41 = new dhtmlXLayoutObject("tmpLayout_md41", "2E");
dhxLayout_md41.cells("a").setText("Cari Data");
dhxLayout_md41.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md41.cells("a").setHeight(60);
dhxLayout_md41.cells("a").collapse();
dhxLayout_md41.cells("a").attachObject("tmpSearch_md41");
dhxLayout_md41.cells("b").setText("Site Navigation");
dhxLayout_md41.cells("b").hideHeader();

function tbClick_md41(id) {
	if(id=='new') {
		winForm_md41('input');
	} else if(id=='edit') {
		winForm_md41('edit');
	} else if(id=='del') {
		hapus_md41();
	} else if(id=='refresh') {
		loadGd_md41();
	} else if(id=='print') {
		cetak_md41();
	} else if(id=='cari') {
		if(dhxLayout_md41.cells("a").isCollapsed()) {
			dhxLayout_md41.cells("a").expand();
		} else {
			dhxLayout_md41.cells("a").collapse();
		}
	} else if(id=='export') {
		idselect = gd_md41.getRowIndex(gd_md41.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		kode = gd_md41.cells(gd_md41.getSelectedId(),1).getValue()
		window.open(base_url+'index.php/harga_barang/exportExcel/'+kode,'_blank');	
	}
}

function klik() {
	gd_md41.selectCell(0,1,false,false,true);
}

gd_md41 = dhxLayout_md41.cells("b").attachGrid();
gd_md41.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md41.setHeader("&nbsp;,Kode,Keterangan,Tanggal Berlaku,Tgl Buat,Dibuat Oleh,Aktif",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md41.setInitWidths("30,60,250,120,120,100,80");
gd_md41.setColAlign("right,left,left,left,left,left,left");
gd_md41.setColSorting("na,str,str,str,str,str,str");
gd_md41.setColTypes("cntr,ro,ro,ro,ro,ro,ro");
gd_md41.enableSmartRendering(true,50);
gd_md41.setColumnColor("#CCE2FE");
gd_md41.setSkin("dhx_skyblue");
gd_md41.splitAt(1);
gd_md41.init();
loadGd_md41();


function loadGd_md41() {
	if(document.frmSearch_md41.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md41.kode.value;
	}
	
	if(document.frmSearch_md41.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md41.nama.value;
	}
	
	statusLoading();
	gd_md41.clearAll();
	gd_md41.loadXML(base_url+"index.php/harga_barang/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md41() {
	gd_md41.updateFromXML(base_url+"index.php/harga_barang/loadMainData");
}

function winForm_md41(type) {
	idselect = gd_md41.getRowIndex(gd_md41.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md41 = dhxWins.createWindow("w1_md41",0,0,1010,510);
	w1_md41.setText("Harga Barang");
	w1_md41.button("park").hide();
	w1_md41.button("minmax1").hide();
	w1_md41.center();
	w1_md41.setModal(true);
	if(type=='input') {
		w1_md41.attachURL(base_url+"index.php/harga_barang/frm_input", true);
	} else {
		w1_md41.attachURL(base_url+"index.php/harga_barang/frm_edit/"+gd_md41.getSelectedId(), true);
	}
	
	w1_md41.button("close").attachEvent("onClick", function() {
        try { w4_md41.close(); } catch(e) {}
	   	try { w1_md41.close(); } catch(e) {}
		try { wCom_md41.close(); } catch(e) {}
		return;
    });
	
	tb_w1_md41 = w1_md41.attachToolbar();
	tb_w1_md41.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md41.setSkin("dhx_terrace");
	tb_w1_md41.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md41.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md41.addButton("import", 3, "IMPORT", "import.png", "import.png");
	tb_w1_md41.addButton("export", 4, "EXPORT", "export.png", "export.png");
	tb_w1_md41.disableItem("baru");
	tb_w1_md41.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md41.reset();
			loadRpt_md41();
			loadMenu_md41();
		} else if(id=='save') {
			simpan_md41();
		} else if(id=='baru') {
			tb_w1_md41.disableItem("baru");
			tb_w1_md41.enableItem("save");
			tb_w1_md41.enableItem("batal");
			baru_md41();
			loadRpt_md41();
			loadMenu_md41();
		} else if(id=='import') {
			showWinCom_md41();
		} else if(id=='export') {
			window.open(base_url+'index.php/harga_barang/exportExcel/'+document.frm_md41.txtKode.value,'_blank');	
		}
	});

}

function hapus_md41() {
	idselect = gd_md41.getRowIndex(gd_md41.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md41.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/harga_barang/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				gd_md41.deleteSelectedItem();
				statusEnding();
			});
		}
}



</script>
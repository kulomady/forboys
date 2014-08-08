<div id="tmpTb_md30" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md30" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md30" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md30" name="frmSearch_md30" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md30();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md30 = new dhtmlXToolbarObject("tmpTb_md30");
tb_md30.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md30.setSkin("dhx_terrace");
tb_md30.attachEvent("onclick", tbClick_md30);
tb_md30.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md30.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md30 = new dhtmlXLayoutObject("tmpLayout_md30", "2E");
dhxLayout_md30.cells("a").setText("Cari Data");
dhxLayout_md30.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md30.cells("a").setHeight(60);
dhxLayout_md30.cells("a").collapse();
dhxLayout_md30.cells("a").attachObject("tmpSearch_md30");
dhxLayout_md30.cells("b").setText("Site Navigation");
dhxLayout_md30.cells("b").hideHeader();

function tbClick_md30(id) {
	if(id=='new') {
		winForm_md30('input');
	} else if(id=='edit') {
		winForm_md30('edit');
	} else if(id=='del') {
		hapus_md30();
	} else if(id=='refresh') {
		loadGd_md30();
	} else if(id=='print') {
		cetak_md30();
	} else if(id=='cari') {
		if(dhxLayout_md30.cells("a").isCollapsed()) {
			dhxLayout_md30.cells("a").expand();
		} else {
			dhxLayout_md30.cells("a").collapse();
		}
	}
}

gd_md30 = dhxLayout_md30.cells("b").attachGrid();
gd_md30.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md30.setHeader("&nbsp;,Kode,Nama Bank,No.Rek,Atas Nama,Cabang,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md30.setInitWidths("30,80,150,100,100,100,120,120,100,100,80");
gd_md30.setColAlign("right,left,left,left,left,left,left,left,left,left,center");
gd_md30.setColSorting("na,str,str,str,str,str,str,str,str,str,str");
gd_md30.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
//gd_md30.enableSmartRendering(true,50);
gd_md30.setColumnColor("#CCE2FE");
gd_md30.setSkin("dhx_skyblue");
gd_md30.splitAt(1);
gd_md30.init();
loadGd_md30();

function loadGd_md30() {
	if(document.frmSearch_md30.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md30.kode.value;
	}
	
	if(document.frmSearch_md30.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md30.nama.value;
	}
	
	statusLoading();
	gd_md30.clearAll();
	gd_md30.loadXML(base_url+"index.php/ref_bank/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md30() {
	gd_md30.updateFromXML(base_url+"index.php/ref_bank/loadMainData");
}

function winForm_md30(type) {
	idselect = gd_md30.getRowIndex(gd_md30.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md30 = dhxWins.createWindow("w1_md30",0,0,350,270);
	w1_md30.setText("Data Bank");
	w1_md30.button("park").hide();
	w1_md30.button("minmax1").hide();
	w1_md30.center();
	w1_md30.setModal(true);
	if(type=='input') {
		w1_md30.attachURL(base_url+"index.php/ref_bank/frm_input", true);
	} else {
		w1_md30.attachURL(base_url+"index.php/ref_bank/frm_edit/"+gd_md30.getSelectedId(), true);
	}
	
	tb_w1_md30 = w1_md30.attachToolbar();
	tb_w1_md30.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md30.setSkin("dhx_terrace");
	tb_w1_md30.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md30.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md30.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md30.disableItem("baru");
	tb_w1_md30.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md30.reset();
		} else if(id=='save') {
			simpan_md30();
		} else if(id=='baru') {
			tb_w1_md30.disableItem("baru");
			tb_w1_md30.enableItem("save");
			tb_w1_md30.enableItem("batal");
			baru_md30();
		}
	});

}

function hapus_md30() {
	idselect = gd_md30.getRowIndex(gd_md30.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md30.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_bank/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_md30.deleteSelectedItem();
				//loadGd_md30();
			});
		}
}

</script>
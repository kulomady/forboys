<div id="tmpTb_md26" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md26" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md26" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md26" name="frmSearch_md26" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md26();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md26 = new dhtmlXToolbarObject("tmpTb_md26");
tb_md26.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md26.setSkin("dhx_terrace");
tb_md26.attachEvent("onclick", tbClick_md26);
tb_md26.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md26.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md26 = new dhtmlXLayoutObject("tmpLayout_md26", "2E");
dhxLayout_md26.cells("a").setText("Cari Data");
dhxLayout_md26.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md26.cells("a").setHeight(60);
dhxLayout_md26.cells("a").collapse();
dhxLayout_md26.cells("a").attachObject("tmpSearch_md26");
dhxLayout_md26.cells("b").setText("Site Navigation");
dhxLayout_md26.cells("b").hideHeader();

function tbClick_md26(id) {
	if(id=='new') {
		winForm_md26('input');
	} else if(id=='edit') {
		winForm_md26('edit');
	} else if(id=='del') {
		hapus_md26();
	} else if(id=='refresh') {
		 loadGd_md26();
	} else if(id=='print') {
		cetak_md26();
	} else if(id=='cari') {
		if(dhxLayout_md26.cells("a").isCollapsed()) {
			dhxLayout_md26.cells("a").expand();
		} else {
			dhxLayout_md26.cells("a").collapse();
		}
	}
}

gd_md26 = dhxLayout_md26.cells("b").attachGrid();
gd_md26.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md26.setHeader("&nbsp;,Kode,Nama satuan,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md26.setInitWidths("30,80,150,120,120,100,100,80");
gd_md26.setColAlign("right,left,left,left,left,left,left,center");
gd_md26.setColSorting("na,str,str,str,str,str,str,str");
gd_md26.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
//gd_md26.enableSmartRendering(true,50);
gd_md26.setColumnColor("#CCE2FE");
gd_md26.setSkin("dhx_skyblue");
gd_md26.splitAt(1);
gd_md26.init();
loadGd_md26();

function loadGd_md26() {
	if(document.frmSearch_md26.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md26.kode.value;
	}
	
	if(document.frmSearch_md26.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md26.nama.value;
	}
	
	statusLoading();
	gd_md26.clearAll();
	gd_md26.loadXML(base_url+"index.php/ref_satuan_brg/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md26() {
	gd_md26.updateFromXML(base_url+"index.php/ref_satuan_brg/loadMainData");
}

function winForm_md26(type) {
	idselect = gd_md26.getRowIndex(gd_md26.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md26 = dhxWins.createWindow("w1_md26",0,0,350,200);
	w1_md26.setText("Tambah Data satuan Barang");
	w1_md26.button("park").hide();
	w1_md26.button("minmax1").hide();
	w1_md26.center();
	w1_md26.setModal(true);
	if(type=='input') {
		w1_md26.attachURL(base_url+"index.php/ref_satuan_brg/frm_input", true);
	} else {
		w1_md26.attachURL(base_url+"index.php/ref_satuan_brg/frm_edit/"+gd_md26.getSelectedId(), true);
	}
	
	tb_w1_md26 = w1_md26.attachToolbar();
	tb_w1_md26.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md26.setSkin("dhx_terrace");
	tb_w1_md26.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md26.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md26.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md26.disableItem("baru");
	tb_w1_md26.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md26.reset();
		} else if(id=='save') {
			simpan_md26();
		} else if(id=='baru') {
			tb_w1_md26.disableItem("baru");
			tb_w1_md26.enableItem("save");
			tb_w1_md26.enableItem("batal");
			baru_md26();
		}
	});

}

function hapus_md26() {
	idselect = gd_md26.getRowIndex(gd_md26.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md26.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_satuan_brg/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result=='1') {
					gd_md26.deleteSelectedItem();
				} else {
					alert("Data tidak dapat dihapus");
				}
				//loadGd_md26();
			});
		}
}

</script>
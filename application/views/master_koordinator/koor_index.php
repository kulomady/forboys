<div id="tmpTb_md6" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md6" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md6" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md6" name="frmSearch_md6" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md6();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md6 = new dhtmlXToolbarObject("tmpTb_md6");
tb_md6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md6.setSkin("dhx_terrace");
tb_md6.attachEvent("onclick", tbClick_md6);
tb_md6.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md6.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md6 = new dhtmlXLayoutObject("tmpLayout_md6", "2E");
dhxLayout_md6.cells("a").setText("Cari Data");
dhxLayout_md6.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md6.cells("a").setHeight(60);
dhxLayout_md6.cells("a").collapse();
dhxLayout_md6.cells("a").attachObject("tmpSearch_md6");
dhxLayout_md6.cells("b").setText("Site Navigation");
dhxLayout_md6.cells("b").hideHeader();

function tbClick_md6(id) {
	if(id=='new') {
		winForm_md6('input');
	} else if(id=='edit') {
		winForm_md6('edit');
	} else if(id=='del') {
		hapus_md6();
	} else if(id=='refresh') {
		loadGd_md6();
	} else if(id=='print') {
		cetak_md6();
	} else if(id=='cari') {
		if(dhxLayout_md6.cells("a").isCollapsed()) {
			dhxLayout_md6.cells("a").expand();
		} else {
			dhxLayout_md6.cells("a").collapse();
		}
	}
}

gd_md6 = dhxLayout_md6.cells("b").attachGrid();
gd_md6.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md6.setHeader("&nbsp;,Kode,Nama Koordinator,Tgl Buat,Tgl Modifikasi,Dibuat Oleh,Dimodifikasi Oleh, Is Active ?",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md6.setInitWidths("30,80,150,120,120,100,100,80");
gd_md6.setColAlign("right,left,left,left,left,left,left,center");
gd_md6.setColSorting("na,str,str,str,str,str,str,str");
gd_md6.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
//gd_md6.enableSmartRendering(true,50);
gd_md6.setColumnColor("#CCE2FE");
gd_md6.setSkin("dhx_skyblue");
gd_md6.splitAt(1);
gd_md6.init();
loadGd_md6();

function loadGd_md6() {
	if(document.frmSearch_md6.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md6.kode.value;
	}
	
	if(document.frmSearch_md6.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md6.nama.value;
	}
	
	statusLoading();
	gd_md6.clearAll();
	gd_md6.loadXML(base_url+"index.php/master_koordinator/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md6() {
	gd_md6.updateFromXML(base_url+"index.php/master_koordinator/loadMainData");
}

function winForm_md6(type) {
	idselect = gd_md6.getRowIndex(gd_md6.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md6 = dhxWins.createWindow("w1_md6",0,0,350,180);
	w1_md6.setText("Data Koordinator");
	w1_md6.button("park").hide();
	w1_md6.button("minmax1").hide();
	w1_md6.center();
	w1_md6.setModal(true);
	if(type=='input') {
		w1_md6.attachURL(base_url+"index.php/master_koordinator/frm_input", true);
	} else {
		w1_md6.attachURL(base_url+"index.php/master_koordinator/frm_edit/"+gd_md6.getSelectedId(), true);
	}
	
	tb_w1_md6 = w1_md6.attachToolbar();
	tb_w1_md6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md6.setSkin("dhx_terrace");
	tb_w1_md6.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md6.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md6.disableItem("baru");
	tb_w1_md6.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_md6();
		} else if(id=='baru') {
			tb_w1_md6.disableItem("baru");
			tb_w1_md6.enableItem("save");
			baru_md6();
		}
	});

}

function hapus_md6() {
	idselect = gd_md6.getRowIndex(gd_md6.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md6.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_koordinator/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_md6.deleteSelectedItem();
				//loadGd_md6();
			});
		}
}

</script>
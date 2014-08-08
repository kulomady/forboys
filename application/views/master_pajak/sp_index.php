<div id="tmpTb_md4" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md4" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md4" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md4" name="frmSearch_md4" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md4();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md4 = new dhtmlXToolbarObject("tmpTb_md4");
tb_md4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md4.setSkin("dhx_terrace");
tb_md4.attachEvent("onclick", tbClick_md4);
tb_md4.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md4 = new dhtmlXLayoutObject("tmpLayout_md4", "2E");
dhxLayout_md4.cells("a").setText("Cari Data");
dhxLayout_md4.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md4.cells("a").setHeight(60);
dhxLayout_md4.cells("a").collapse();
dhxLayout_md4.cells("a").attachObject("tmpSearch_md4");
dhxLayout_md4.cells("b").setText("Site Navigation");
dhxLayout_md4.cells("b").hideHeader();

function tbClick_md4(id) {
	if(id=='new') {
		winForm_md4('input');
	} else if(id=='edit') {
		winForm_md4('edit');
	} else if(id=='del') {
		hapus_md4();
	} else if(id=='refresh') {
		loadGd_md4();
	} else if(id=='print') {
		cetak_md4();
	} else if(id=='cari') {
		if(dhxLayout_md4.cells("a").isCollapsed()) {
			dhxLayout_md4.cells("a").expand();
		} else {
			dhxLayout_md4.cells("a").collapse();
		}
	}
}

gd_md4 = dhxLayout_md4.cells("b").attachGrid();
gd_md4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md4.setHeader("&nbsp;,Kode Pajak,Nama Pajak,Nilai,Status,Tgl Buat,Dibuat Oleh,Tgl Modifikasi,Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md4.setInitWidths("30,100,200,100,100,100,100,100,100,100,100");
gd_md4.setColAlign("right,left,left,left,left,left,left,left,left,left,left");
gd_md4.setColSorting("na,int,str,str,date,date,str,str,str,str,str");
gd_md4.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_md4.enableSmartRendering(true,50);
gd_md4.setColumnColor("#CCE2FE");
gd_md4.setSkin("dhx_skyblue");
gd_md4.splitAt(1);
gd_md4.init();
loadGd_md4();

function loadGd_md4(){
	if(document.frmSearch_md4.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md4.kode.value;
	}
	
	if(document.frmSearch_md4.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md4.nama.value;
	}
	
	statusLoading();
	gd_md4.clearAll();
	gd_md4.loadXML(base_url+"index.php/master_pajak/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md4() {
	gd_md4.updateFromXML(base_url+"index.php/master_pajak/loadMainData");
}

function winForm_md4(type) {
	idselect = gd_md4.getRowIndex(gd_md4.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md4 = dhxWins.createWindow("w1_md4",0,0,350,200);
	w1_md4.setText("Tambah Data Setup Pajak");
	w1_md4.button("park").hide();
	w1_md4.button("minmax1").hide();
	w1_md4.center();
	w1_md4.setModal(true);
	if(type=='input') {
		w1_md4.attachURL(base_url+"index.php/master_pajak/frm_input", true);
	} else {
		w1_md4.attachURL(base_url+"index.php/master_pajak/frm_edit/"+gd_md4.getSelectedId(), true);
	}
	
	tb_w1_md4 = w1_md4.attachToolbar();
	tb_w1_md4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md4.setSkin("dhx_terrace");
	tb_w1_md4.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md4.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md4.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md4.disableItem("baru");
	tb_w1_md4.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md4.reset();
		} else if(id=='save') {
			simpan_md4();
		} else if(id=='baru') {
			tb_w1_md4.disableItem("baru");
			tb_w1_md4.enableItem("save");
			tb_w1_md4.enableItem("batal");
			baru_md4();
		}
	});
}

function hapus_md4() {
	idselect = gd_md4.getRowIndex(gd_md4.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md4.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_pajak/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				alert(result);
				statusEnding();
				gd_md4.deleteSelectedItem();
				//loadGd_md4();
			});
		}	
}
</script>
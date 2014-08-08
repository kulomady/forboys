<div id="tmpTb_md8" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md8" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md8" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md8" name="frmSearch_md8" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md8();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md8 = new dhtmlXToolbarObject("tmpTb_md8");
tb_md8.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md8.setSkin("dhx_terrace");
tb_md8.attachEvent("onclick", tbClick_md8);
tb_md8.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_md8.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md8 = new dhtmlXLayoutObject("tmpLayout_md8", "2E");
dhxLayout_md8.cells("a").setText("Cari Data");
dhxLayout_md8.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md8.cells("a").setHeight(60);
dhxLayout_md8.cells("a").collapse();
dhxLayout_md8.cells("a").attachObject("tmpSearch_md8");
dhxLayout_md8.cells("b").setText("Site Navigation");
dhxLayout_md8.cells("b").hideHeader();

function tbClick_md8(id) {
	if(id=='new') {
		winForm_md8('input');
	} else if(id=='edit') {
		winForm_md8('edit');
	} else if(id=='del') {
		hapus_md8();
	} else if(id=='refresh') {
		 loadGd_md8();
	} else if(id=='print') {
		cetak_md8();
	} else if(id=='cari') {
		if(dhxLayout_md8.cells("a").isCollapsed()) {
			dhxLayout_md8.cells("a").expand();
		} else {
			dhxLayout_md8.cells("a").collapse();
		}
	}
}

gd_md8 = dhxLayout_md8.cells("b").attachGrid();
gd_md8.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md8.setHeader("&nbsp;,Kode Customer,Nama Customer,Alamat,No. HP,Tgl Buat,Dibuat Oleh, Tgl Modifikasi, Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md8.setInitWidths("30,100,220,320,150,120,100,120,100");
gd_md8.setColAlign("right,left,left,left,right,left,left,left,left");
gd_md8.setColSorting("na,str,str,str,str,str,str,str,str");
gd_md8.setColTypes("cntr,ro,ro,ro,ron,ro,ro,ro,ro");
gd_md8.enableSmartRendering(true,50);
gd_md8.setColumnColor("#CCE2FE");
gd_md8.setSkin("dhx_skyblue");
gd_md8.splitAt(1);
gd_md8.init();
loadGd_md8();

function loadGd_md8() {
	if(document.frmSearch_md8.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md8.kode.value;
	}
	
	if(document.frmSearch_md8.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md8.nama.value;
	}
	
	statusLoading();
	gd_md8.clearAll();
	gd_md8.loadXML(base_url+"index.php/master_customer/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_md8() {
	gd_md8.updateFromXML(base_url+"index.php/master_customer/loadMainData");
}

function winForm_md8(type) {
	idselect = gd_md8.getRowIndex(gd_md8.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	
	w1_md8 = dhxWins.createWindow("w1_md8",0,0,950,305);
	w1_md8.setText("Tambah Data Customer");
	w1_md8.button("park").hide();
	w1_md8.button("minmax1").hide();
	w1_md8.center();
	w1_md8.setModal(true);
	if(type=='input') {
		w1_md8.attachURL(base_url+"index.php/master_customer/frm_input", true);
	} else {
		w1_md8.attachURL(base_url+"index.php/master_customer/frm_edit/"+gd_md8.cells(gd_md8.getSelectedId(),1).getValue(), true);
	}
	
	tb_w1_md8 = w1_md8.attachToolbar();
	tb_w1_md8.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md8.setSkin("dhx_terrace");
	tb_w1_md8.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md8.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md8.disableItem("baru");
	tb_w1_md8.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_md8();
		} else if(id=='baru') {
			tb_w1_md8.disableItem("baru");
			tb_w1_md8.enableItem("save");
			baru_md8();
		}
	});

}

function hapus_md8() {
	idselect = gd_md8.getRowIndex(gd_md8.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	cf = confirm("Apakah Anda Yakin ?");
	if(cf) {
		 poststr2 =
            	'idrec=' + gd_md8.cells(gd_md8.getSelectedId(), 1).getValue();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_customer/hapus", encodeURI(poststr2), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				loadGd_md8();
			});
		}
}

</script>
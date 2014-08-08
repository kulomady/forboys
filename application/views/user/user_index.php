<div id="tmpTb_pg12" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pg12" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pg12">
  <form id="frmSearch_pg12" name="frmSearch_pg12" method="post" action="javascript:void(0);">
    <table width="670" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
      <tr>
        <td width="84">Username</td>
        <td width="193"><input type="text" name="username" id="username" /></td>
        <td width="80">Grup</td>
        <td width="186"><select name="group_id" id="group_id" style="width:158px;">
      	 <?php echo $userGroup; ?>
      </select></td>
        <td width="105" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pg12();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td><input type="text" name="nama" id="nama" /></td>
        <td>Lokasi</td>
        <td><select name="outlet_id" id="outlet_id" style="width:158px;">
      <?php echo $lokasi; ?>
      </select></td>
      </tr>
    </table>
  </form>
</div>


<script language="javascript">
tb_pg12 = new dhtmlXToolbarObject("tmpTb_pg12");
tb_pg12.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pg12.setSkin("dhx_terrace");
tb_pg12.attachEvent("onclick", tbClick_pg12);
tb_pg12.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pg12.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

function tbClick_pg12(id) {
	if(id=='new') {
		winForm_pg12('input');
	} else if(id=='edit') {
		winForm_pg12('edit');
	} else if(id=='del') {
		hapus_pg12();
	} else if(id=='refresh') {
		 loadGd_pg12();
	} else if(id=='cari') {
		if(dhxLayout_pg12.cells("a").isCollapsed()) {
			dhxLayout_pg12.cells("a").expand();
		} else {
			dhxLayout_pg12.cells("a").collapse();
		}
	}
}

dhxLayout_pg12 = new dhtmlXLayoutObject("tmpLayout_pg12", "2E");
dhxLayout_pg12.cells("a").setText("Cari Data");
dhxLayout_pg12.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pg12.cells("a").setHeight(85);
dhxLayout_pg12.cells("a").collapse();
dhxLayout_pg12.cells("a").attachObject("frmSearch_pg12");
dhxLayout_pg12.cells("b").setText("Site Navigation");
dhxLayout_pg12.cells("b").hideHeader();

gd_pg12 = dhxLayout_pg12.cells("b").attachGrid();
gd_pg12.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pg12.setHeader("&nbsp;,Username,Nama,Telepon,Email,Lokasi,Tgl Buat",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pg12.setInitWidths("30,110,110,110,200,180,150");
gd_pg12.setColAlign("right,left,left,left,left,left,left");
gd_pg12.setColSorting("na,str,str,str,str,str,str");
gd_pg12.setColTypes("cntr,ro,ro,ro,ro,ro,ro");
//gd_pg12.enableSmartRendering(true,50);
gd_pg12.setColumnColor("#CCE2FE");
gd_pg12.setSkin("dhx_skyblue");
gd_pg12.splitAt(1);
gd_pg12.init();
loadGd_pg12();

function loadGd_pg12() {
	if(document.frmSearch_pg12.username.value == "") {
		username = 0;
	} else {
		username = document.frmSearch_pg12.username.value
	}
	if(document.frmSearch_pg12.nama.value == "") {
		nama = 0;
	} else {
		nama = document.frmSearch_pg12.nama.value
	}
	if(document.frmSearch_pg12.group_id.value == "") {
		group_id = 0;
	} else {
		group_id = document.frmSearch_pg12.group_id.value
	}
	if(document.frmSearch_pg12.outlet_id.value == "") {
		outlet_id = 0;
	} else {
		outlet_id = document.frmSearch_pg12.outlet_id.value
	}
	statusLoading();
	gd_pg12.clearAll();
	gd_pg12.loadXML(base_url+"index.php/user/loadMainData/"+username+"/"+nama+"/"+group_id+"/"+outlet_id,function() {
		statusEnding();
	});
}

function refreshGd_pg12() {
	if(document.frmSearch_pg12.username.value == "") {
		username = 0;
	} else {
		username = document.frmSearch_pg12.username.value
	}
	if(document.frmSearch_pg12.nama.value == "") {
		nama = 0;
	} else {
		nama = document.frmSearch_pg12.nama.value
	}
	if(document.frmSearch_pg12.group_id.value == "") {
		group_id = 0;
	} else {
		group_id = document.frmSearch_pg12.group_id.value
	}
	if(document.frmSearch_pg12.outlet_id.value == "") {
		outlet_id = 0;
	} else {
		outlet_id = document.frmSearch_pg12.outlet_id.value
	}
	gd_pg12.updateFromXML(base_url+"index.php/user/loadMainData/"+username+"/"+nama+"/"+group_id+"/"+outlet_id);
}

function winForm_pg12(type) {
	idselect = gd_pg12.getRowIndex(gd_pg12.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pg12 = dhxWins.createWindow("w1_pg12",0,0,350,310);
	w1_pg12.setText("Data User");
	w1_pg12.button("park").hide();
	w1_pg12.button("minmax1").hide();
	w1_pg12.center();
	w1_pg12.setModal(true);
	if(type=='input') {
		w1_pg12.attachURL(base_url+"index.php/user/frm_input", true);
	} else {
		w1_pg12.attachURL(base_url+"index.php/user/frm_edit/"+gd_pg12.getSelectedId(), true);
	}
	
	tb_w1_pg12 = w1_pg12.attachToolbar();
	tb_w1_pg12.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pg12.setSkin("dhx_terrace");
	tb_w1_pg12.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pg12.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pg12.disableItem("baru");
	tb_w1_pg12.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_pg12.reset();
		} else if(id=='save') {
			simpan_pg12();
		} else if(id=='baru') {
			tb_w1_pg12.disableItem("baru");
			tb_w1_pg12.enableItem("save");
			baru_pg12();
		}
	});

}

function hapus_pg12() {
	idselect = gd_pg12.getRowIndex(gd_pg12.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_pg12.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/user/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_md31.deleteSelectedItem();
			});
		}
}

</script>
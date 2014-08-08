<div id="tmpTb_md1" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md1" style="position: relative; width: 100%; height: 91%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md1" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md1" name="frmSearch_md1" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="100">ID Rekan</td>
        <td width="235"><input type="text" name="idRekan" id="idRekan" /></td>
        <td width="157">Type Rekan</td>
        <td width="235"><select name="typeRekan" id="typeRekan" style="width:150px;" onchange="pilih_md1();">
		<?php echo $typeRekan; ?>
        </select></td>
        <td rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md1();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
      	<td>Nama Rekan</td>
        <td><input type="text" name="nmRekan" id="nmRekan" /></td>
        <td>Golongan Pelanggan</td>
        <td><select name="golPelanggan" id="golPelanggan" style="width:150px;">
		<?php echo $pelanggan; ?>
        </select></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_md1 = new dhtmlXToolbarObject("tmpTb_md1");
tb_md1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md1.setSkin("dhx_terrace");
tb_md1.attachEvent("onclick", tbClick_md1);
tb_md1.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_md1 = new dhtmlXLayoutObject("tmpLayout_md1", "2E");
dhxLayout_md1.cells("a").setText("Cari Data");
dhxLayout_md1.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md1.cells("a").setHeight(85);
dhxLayout_md1.cells("a").collapse();
dhxLayout_md1.cells("a").attachObject("tmpSearch_md1");
dhxLayout_md1.cells("b").setText("Site Navigation");
dhxLayout_md1.cells("b").hideHeader();

function tbClick_md1(id) {
	if(id=='new') {
		winForm_md1('input');
	} else if(id=='edit') {
		winForm_md1('edit');
	} else if(id=='del') {
		hapus_md1();
	} else if(id=='refresh') {
		 loadGd_md1();
	} else if(id=='print') {
		cetak_md1();
	} else if(id=='cari') {
		if(dhxLayout_md1.cells("a").isCollapsed()) {
			dhxLayout_md1.cells("a").expand();
		} else {
			dhxLayout_md1.cells("a").collapse();
		}
	}
}

document.frmSearch_md1.golPelanggan.disabled = true;
function pilih_md1(){
	if(document.frmSearch_md1.typeRekan.value!="1"){
		document.frmSearch_md1.golPelanggan.disabled = true;
	} else {
		document.frmSearch_md1.golPelanggan.disabled = false;
	}
}

gd_md1 = dhxLayout_md1.cells("b").attachGrid();
gd_md1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md1.setHeader("&nbsp;,ID Rekan,Nama,Telepon 1,Telepon 2,Telepon 3,Fax,Email,Website,Type,Cabang",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
//gd_md1.attachHeader("&nbsp;,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#select_filter,#text_filter");
gd_md1.setInitWidths("30,70,200,100,100,100,100,150,150,100,100");
gd_md1.setColAlign("right,left,left,left,left,left,left,left,left,left,left");
gd_md1.setColSorting("na,str,str,str,str,str,str,str,str,str,str");
gd_md1.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
//gd_md1.enableSmartRendering(true,50);
gd_md1.setColumnColor("#CCE2FE");
gd_md1.setSkin("dhx_skyblue");
gd_md1.splitAt(1);
gd_md1.init();
loadGd_md1();

function loadGd_md1() {
	if(document.frmSearch_md1.idRekan.value=="") {
		idRekan = "0";
	} else {
		idRekan = document.frmSearch_md1.idRekan.value;
	}
	
	if(document.frmSearch_md1.nmRekan.value=="") {
		nmRekan = "0";
	} else {
		nmRekan = document.frmSearch_md1.nmRekan.value;
	}
	
	if(document.frmSearch_md1.typeRekan.value=="") {
		typeRekan = "0";
	} else {
		typeRekan = document.frmSearch_md1.typeRekan.value;
	}
	
	if(document.frmSearch_md1.golPelanggan.value=="") {
		golPelanggan = "0";
	} else {
		golPelanggan = document.frmSearch_md1.golPelanggan.value;
	}
	statusLoading();
	gd_md1.clearAll();
	gd_md1.loadXML(base_url+"index.php/rekan_bisnis/loadMainData/"+idRekan+"/"+nmRekan+"/"+typeRekan+"/"+golPelanggan,function() {
		statusEnding();
	});
}

function refreshGd_md1() {
	if(document.frmSearch_md1.idRekan.value=="") {
		idRekan = "0";
	} else {
		idRekan = document.frmSearch_md1.idRekan.value;
	}
	
	if(document.frmSearch_md1.nmRekan.value=="") {
		nmRekan = "0";
	} else {
		nmRekan = document.frmSearch_md1.nmRekan.value;
	}
	
	if(document.frmSearch_md1.typeRekan.value=="") {
		typeRekan = "0";
	} else {
		typeRekan = document.frmSearch_md1.typeRekan.value;
	}
	
	if(document.frmSearch_md1.golPelanggan.value=="") {
		golPelanggan = "0";
	} else {
		golPelanggan = document.frmSearch_md1.golPelanggan.value;
	}
	gd_md1.updateFromXML(base_url+"index.php/rekan_bisnis/loadMainData/"+idRekan+"/"+nmRekan+"/"+typeRekan+"/"+golPelanggan);
}

function winForm_md1(type) {
	idselect = gd_md1.getRowIndex(gd_md1.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md1 = dhxWins.createWindow("w1_md1",0,0,700,500);
	w1_md1.setText("Rekan Kerja");
	w1_md1.button("park").hide();
	w1_md1.button("minmax1").hide();
	w1_md1.center();
	w1_md1.setModal(true);
	if(type=='input') {
		w1_md1.attachURL(base_url+"index.php/rekan_bisnis/frm_input", true);
	} else {
		w1_md1.attachURL(base_url+"index.php/rekan_bisnis/frm_edit/"+gd_md1.getSelectedId(), true);
	}
	
	tb_w1_md1 = w1_md1.attachToolbar();
	tb_w1_md1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md1.setSkin("dhx_terrace");
	tb_w1_md1.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md1.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md1.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_md1.disableItem("baru");
	tb_w1_md1.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_md1.reset();
			loadRpt_md1();
			loadMenu_md1();
		} else if(id=='save') {
			simpan_md1();
		} else if(id=='baru') {
			tb_w1_md1.disableItem("baru");
			tb_w1_md1.enableItem("save");
			tb_w1_md1.enableItem("batal");
			baru_md1();
			loadRpt_md1();
			loadMenu_md1();
		}
	});

}

function hapus_md1() {
	idselect = gd_md1.getRowIndex(gd_md1.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_md1.getSelectedId() +
				'&idrekan=' + gd_md1.cells(gd_md1.getSelectedId(),1).getValue();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/rekan_bisnis/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result=='1') {
					gd_md1.deleteSelectedItem();
				} else {
					alert("Data Tidak Dapat Dihapus");
				}
				//loadGd_md1();
			});
		}
}

</script>
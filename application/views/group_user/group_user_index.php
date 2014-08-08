<div id="tmpTb_pg11" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pg11" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pg11" style="display:none;">
  <form id="frmSearch_pg11" name="frmSearch_pg11" method="post" action="javascript:void(0);">
    <table width="670" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
      <tr>
        <td width="84">Nama Group</td>
        <td width="193"><input type="text" name="nmGroup" id="nmGroup" /></td>
        <td width="80">Keterangan</td>
        <td width="186"><input type="text" name="ket" id="ket" /></td>
        <td width="105"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pg11();" style="width:100px;" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">

tb_pg11 = new dhtmlXToolbarObject("tmpTb_pg11");
tb_pg11.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pg11.setSkin("dhx_terrace");
tb_pg11.attachEvent("onclick", tbClick_pg11);
tb_pg11.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pg11.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

function tbClick_pg11(id) {
	if(id=='new') {
		winForm_pg11('input');
	} else if(id=='edit') {
		winForm_pg11('edit');
	} else if(id=='del') {
		hapus_pg11();
	} else if(id=='refresh') {
		 loadGd_pg11();
	} else if(id=='cari') {
		if(dhxLayout_pg11.cells("a").isCollapsed()) {
			dhxLayout_pg11.cells("a").expand();
		} else {
			dhxLayout_pg11.cells("a").collapse();
		}
	}
}

dhxLayout_pg11 = new dhtmlXLayoutObject("tmpLayout_pg11", "2E");
dhxLayout_pg11.cells("a").setText("Cari Data");
dhxLayout_pg11.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pg11.cells("a").setHeight(60);
dhxLayout_pg11.cells("a").collapse();
dhxLayout_pg11.cells("a").attachObject("frmSearch_pg11");
dhxLayout_pg11.cells("b").setText("Site Navigation");
dhxLayout_pg11.cells("b").hideHeader();

gd_pg11 = dhxLayout_pg11.cells("b").attachGrid();
gd_pg11.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pg11.setHeader("&nbsp;,Nama Group,Keterangan,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pg11.setInitWidths("30,150,200,120,100");
gd_pg11.setColAlign("right,left,left,left,left");
gd_pg11.setColSorting("na,str,str,int,int");
gd_pg11.setColTypes("cntr,ro,ro,ro,ro");
//gd_pg11.enableSmartRendering(true,50);
gd_pg11.setColumnColor("#CCE2FE");
gd_pg11.setSkin("dhx_skyblue");
gd_pg11.splitAt(1);
gd_pg11.init();
loadGd_pg11();

function loadGd_pg11() {
	if(document.frmSearch_pg11.nmGroup.value == "") {
		nmGroup = 0;
	} else {
		nmGroup = document.frmSearch_pg11.nmGroup.value;
	}
	if(document.frmSearch_pg11.ket.value == "") {
		ket = 0;
	} else {
		ket = document.frmSearch_pg11.ket.value;
	}
	statusLoading();
	gd_pg11.clearAll();
	gd_pg11.loadXML(base_url+"index.php/group_user/loadMainData/"+nmGroup+"/"+ket,function() {
		statusEnding();
	});
}

function refreshGd_pg11() {
	gd_pg11.updateFromXML(base_url+"index.php/group_user/loadMainData");
}

function winForm_pg11(type) {
	idselect = gd_pg11.getRowIndex(gd_pg11.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pg11 = dhxWins.createWindow("w1_pg11",0,0,650,550);
	w1_pg11.setText("Tambah Data Group");
	w1_pg11.button("park").hide();
	w1_pg11.button("minmax1").hide();
	w1_pg11.center();
	w1_pg11.setModal(true);
	if(type=='input') {
		w1_pg11.attachURL(base_url+"index.php/group_user/frm_input", true);
	} else {
		w1_pg11.attachURL(base_url+"index.php/group_user/frm_edit/"+gd_pg11.getSelectedId(), true);
	}
	
	tb_w1_pg11 = w1_pg11.attachToolbar();
	tb_w1_pg11.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pg11.setSkin("dhx_terrace");
	tb_w1_pg11.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pg11.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pg11.disableItem("baru");
	tb_w1_pg11.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pg11();
		} else if(id=='baru') {
			tb_w1_pg11.disableItem("baru");
			tb_w1_pg11.enableItem("save");
			baru_pg11();
			loadRpt_pg11();
			loadMenu_pg11();
		}
	});

}

function hapus_pg11() {
	idselect = gd_pg11.getRowIndex(gd_pg11.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	cf = confirm("Apakah Anda Yakin ?");
	if(cf) {
		 poststr =
            	'idrec=' + gd_pg11.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/group_user/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				if(result) {
					gd_pg11.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
}

</script>
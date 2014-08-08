<div id="tmpTb_ku2" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_ku2" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_ku2" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_ku2" name="frmSearch_ku2" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Periode</td>
        <td width="200"><select name="slcBln" id="slcBln">
         <option value="0"></option>
          <?php echo $bln; ?>
        </select>
          <select name="slcThn" id="slcThn">
          <option value="0"></option>
            <?php echo $thn; ?>
        </select></td>
        <td width="50">Gudang</td>
        <td width="200"><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
          <?php echo $gudang; ?>
        </select></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_ku2();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_ku2 = new dhtmlXToolbarObject("tmpTb_ku2");
tb_ku2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_ku2.setSkin("dhx_terrace");
tb_ku2.attachEvent("onclick", tbClick_ku2);
tb_ku2.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_ku2.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_ku2 = new dhtmlXLayoutObject("tmpLayout_ku2", "2E");
dhxLayout_ku2.cells("a").setText("Cari Data");
dhxLayout_ku2.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_ku2.cells("a").setHeight(60);
dhxLayout_ku2.cells("a").collapse();
dhxLayout_ku2.cells("a").attachObject("tmpSearch_ku2");
dhxLayout_ku2.cells("b").setText("Site Navigation");
dhxLayout_ku2.cells("b").hideHeader();

function tbClick_ku2(id) {
	if(id=='new') {
		winForm_ku2('input');
	} else if(id=='edit') {
		winForm_ku2('edit');
	} else if(id=='del') {
		hapus_ku2();
	} else if(id=='refresh') {
		loadGd_ku2();
	} else if(id=='print') {
		cetak_ku2();
	} else if(id=='cari') {
		if(dhxLayout_ku2.cells("a").isCollapsed()) {
			dhxLayout_ku2.cells("a").expand();
		} else {
			dhxLayout_ku2.cells("a").collapse();
		}
	}
}

gd_ku2 = dhxLayout_ku2.cells("b").attachGrid();
gd_ku2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ku2.setHeader("&nbsp;,Gaji Bln,Cabang,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ku2.setInitWidths("30,80,100,150,100");
gd_ku2.setColAlign("right,left,left,left,left");
gd_ku2.setColSorting("na,str,str,str,str");
gd_ku2.setColTypes("cntr,ro,ro,ro,ro");
//gd_ku2.enableSmartRendering(true,50);
gd_ku2.setColumnColor("#CCE2FE");
gd_ku2.setSkin("dhx_skyblue");
gd_ku2.splitAt(1);
gd_ku2.init();
loadGd_ku2();

function loadGd_ku2() {
	
	//periode = document.frmSearch_ku2.slcThn.value+"-"+document.frmSearch_ku2.slcBln.value;
	bln = document.frmSearch_ku2.slcBln.value;
	thn = document.frmSearch_ku2.slcThn.value;
	
	if(document.frmSearch_ku2.slcOutlet_id.value != "") {
		outlet = document.frmSearch_ku2.slcOutlet_id.value;
	} else {
		outlet = 0;
	}
	
	statusLoading();
	gd_ku2.clearAll();
	gd_ku2.loadXML(base_url+"index.php/gaji_kry/loadMainData/"+bln+"/"+thn+"/"+outlet,function(){
		statusEnding();
	});
}

function refreshGd_ku2() {
	gd_ku2.updateFromXML(base_url+"index.php/gaji_kry/loadMainData");
}

function winForm_ku2(type) {
	idselect = gd_ku2.getRowIndex(gd_ku2.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_ku2 = dhxWins.createWindow("w1_ku2",0,0,1200,500);
	w1_ku2.setText("Gaji Karyawan");
	w1_ku2.button("park").hide();
	w1_ku2.button("minmax1").hide();
	w1_ku2.center();
	w1_ku2.setModal(true);
	if(type=='input') {
		w1_ku2.attachURL(base_url+"index.php/gaji_kry/frm_input", true);
	} else {
		w1_ku2.attachURL(base_url+"index.php/gaji_kry/frm_edit/"+gd_ku2.getSelectedId(), true);
	}
	
	tb_w1_ku2 = w1_ku2.attachToolbar();
	tb_w1_ku2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_ku2.setSkin("dhx_terrace");
	tb_w1_ku2.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_ku2.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_ku2.disableItem("baru");
	tb_w1_ku2.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_ku2.reset();
		} else if(id=='save') {
			simpan_ku2();
		} else if(id=='baru') {
			tb_w1_ku2.disableItem("baru");
			tb_w1_ku2.enableItem("save");
			baru_ku2();
		}
	});

}

function hapus_ku2() {
	idselect = gd_ku2.getRowIndex(gd_ku2.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_ku2.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/gaji_kry/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_ku2.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert("Data Gagal Dihapus");	
				}
				//loadGd_ku2();
			});
		}
}

</script>
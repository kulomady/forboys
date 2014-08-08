<div id="tmpTb_pd1" style="background-color:#B8E0F5; padding:2px; padding-bottom:0px;"></div>
<div id="tmpLayout_pd1" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pd1" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pd1" name="frmSearch_pd1" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="70">Periode</td>
        <td width="157"><select name="slcBln" id="slcBln">
        <?php echo $bln; ?>
        </select>
          <select name="slcThn" id="slcThn">
          	 <?php echo $thn; ?>
          </select>
        </td>
        <td width="59">Gudang</td>
        <td width="168"><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
      <?php echo $gudang; ?>
      </select></td>
        <td width="82">Keterangan</td>
        <td width="163"><input type="text" name="txtKet" id="txtKet" /></td>
        <td width="227"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pd1();" /></td>
      </tr>
    </table>
  </form>
</div>

<div id="tmpCetak_pd1" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<form id="frmCetak_pd1" name="frmCetak_pd1" method="post" action="javascript:void(0);">
  <table width="254" border="0" align="center">
    <tr>
      <td width="98">&nbsp;</td>
      <td width="146">&nbsp;</td>
    </tr>
    <tr>
      <td>Cetak</td>
      <td><select name="cetak" id="cetak" onchange="if(this.value=='PA') { document.frmCetak_pd1.jns.disabled = true; } else { document.frmCetak_pd1.jns.disabled = false; }">
        <option value="PA">Persediaan Awal</option>
        <option value="BARCODE">Barcode</option>
      </select></td>
    </tr>
    <tr>
      <td>Jenis Kertas</td>
      <td><select name="jns" id="jns" disabled="disabled">
        <option value="barcodeLine2">Kolom 2</option>
      </select></td>
    </tr>
    <tr>
      <td><input type="button" name="btnCetak" id="btnCetak" value="CETAK" onclick="cetakBarcode_pd1();" /></td>
      <td><input type="hidden" name="kdtrans" id="kdtrans" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
tb_pd1 = new dhtmlXToolbarObject("tmpTb_pd1");
tb_pd1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pd1.setSkin("dhx_terrace");
tb_pd1.attachEvent("onclick", tbClick_pd1);
tb_pd1.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pd1 = new dhtmlXLayoutObject("tmpLayout_pd1", "2E");
dhxLayout_pd1.cells("a").setText("Cari Data");
dhxLayout_pd1.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pd1.cells("a").setHeight(60);
dhxLayout_pd1.cells("a").collapse();
dhxLayout_pd1.cells("a").attachObject("tmpSearch_pd1");
dhxLayout_pd1.cells("b").setText("Site Navigation");
dhxLayout_pd1.cells("b").hideHeader();


function tbClick_pd1(id) {
	if(id=='new') {
		winForm_pd1('input');
	} else if(id=='edit') {
		winForm_pd1('edit');
	} else if(id=='del') {
		hapus_pd1();
	} else if(id=='refresh') {
		 loadGd_pd1();
	} else if(id=='print') {
		showWinCetak_pd1(gd_pd1.cells(gd_pd1.getSelectedId(),1).getValue());
	} else if(id=='cari') {
		if(dhxLayout_pd1.cells("a").isCollapsed()) {
			dhxLayout_pd1.cells("a").expand();
		} else {
			dhxLayout_pd1.cells("a").collapse();
		}
	}
}

gd_pd1 = dhxLayout_pd1.cells("b").attachGrid();
gd_pd1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pd1.setHeader("&nbsp;,Periode,ID Lokasi,Gudang,Keterangan,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pd1.setInitWidths("30,100,80,180,150,120,100");
gd_pd1.setColAlign("right,left,left,left,left,left,left");
gd_pd1.setColSorting("na,str,str,str,str,str,str");
gd_pd1.setColTypes("cntr,ro,ro,ro,ro,ro,ro");
gd_pd1.enableSmartRendering(true,50);
gd_pd1.setColumnColor("#CCE2FE");
gd_pd1.setSkin("dhx_skyblue");
gd_pd1.splitAt(1);
gd_pd1.init();
loadGd_pd1();


function loadGd_pd1() {
	periode = document.frmSearch_pd1.slcThn.value+"-"+document.frmSearch_pd1.slcBln.value;
	if(document.frmSearch_pd1.slcOutlet_id.value != "") {
		outlet = document.frmSearch_pd1.slcOutlet_id.value;
	} else {
		outlet = 0;
	}
	if(document.frmSearch_pd1.txtKet.value != "") {
		ket = document.frmSearch_pd1.txtKet.value;
	} else {
		ket = 0;
	}
	statusLoading();
	gd_pd1.clearAll();
	gd_pd1.loadXML(base_url+"index.php/persediaan_awal/loadMainData/"+periode+"/"+outlet+"/"+ket,function() {
		statusEnding();
	});
}

function refreshGd_pd1() {
	periode = document.frmSearch_pd1.slcThn.value+"-"+document.frmSearch_pd1.slcBln.value;
	if(document.frmSearch_pd1.slcOutlet_id.value != "") {
		outlet = document.frmSearch_pd1.slcOutlet_id.value;
	} else {
		outlet = 0;
	}
	if(document.frmSearch_pd1.txtKet.value != "") {
		ket = document.frmSearch_pd1.txtKet.value;
	} else {
		ket = 0;
	}
	gd_pd1.updateFromXML(base_url+"index.php/persediaan_awal/loadMainData/"+periode+"/"+outlet+"/"+ket);
}

function winForm_pd1(type) {
	idselect = gd_pd1.getRowIndex(gd_pd1.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pd1 = dhxWins.createWindow("w1_pd1",0,0,950,550);
	w1_pd1.setText("Persediaan Awal");
	w1_pd1.button("park").hide();
	w1_pd1.button("minmax1").hide();
	w1_pd1.center();
	w1_pd1.setModal(true);
	if(type=='input') {
		w1_pd1.attachURL(base_url+"index.php/persediaan_awal/frm_input", true);
	} else {
		w1_pd1.attachURL(base_url+"index.php/persediaan_awal/frm_edit/"+gd_pd1.getSelectedId(), true);
	}
	
	w1_pd1.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pd1.close();
		try { wCom_pd1.close(); } catch(e) {}
		return;
    });
	
	tb_w1_pd1 = w1_pd1.attachToolbar();
	tb_w1_pd1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pd1.setSkin("dhx_terrace");
	tb_w1_pd1.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pd1.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pd1.addButton("import", 3, "IMPORT", "import.png", "import.png");
	//tb_w1_pd1.addButton("export", 4, "EXPORT", "export.png", "export.png");
	//tb_w1_pd1.disableItem("baru");
	tb_w1_pd1.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pd1();
		} else if(id=='baru') {
			tb_w1_pd1.enableItem("baru");
			tb_w1_pd1.enableItem("save");
			baru_pd1();
		} else if(id=='import') {
			showWinCom_pd1();
		}
	});

}

function cetak_pd1() {
	idselect = gd_pd1.getRowIndex(gd_pd1.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window.open(base_url+'index.php/persediaan_awal/cetak/'+gd_pd1.getSelectedId(),'_blank');
}

function hapus_pd1() {
	idselect = gd_pd1.getRowIndex(gd_pd1.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'kdtrans=' + gd_pd1.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/persediaan_awal/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pd1.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
				
			});
		}
}

// Window Cetak
var winCetak_pd1 = dhxWins.createWindow("winCetak_pd1",0,0,300,150);
winCetak_pd1.setText("Cetak Persediaan Awal");
winCetak_pd1.button("park").hide();
winCetak_pd1.button("minmax1").hide();
winCetak_pd1.center();
winCetak_pd1.button("close").attachEvent("onClick", function() {
	winCetak_pd1.hide();
	winCetak_pd1.setModal(false);
});

winCetak_pd1.hide();

function showWinCetak_pd1(kdtrans) {
	//loadDaftarTunda_pj1();
	winCetak_pd1.bringToTop();
	winCetak_pd1.show();
	winCetak_pd1.setModal(true);
	winCetak_pd1.attachObject('tmpCetak_pd1');
	
	document.frmCetak_pd1.kdtrans.value = kdtrans;
}

function cetakBarcode_pd1() {
	if(document.frmCetak_pd1.kdtrans.value=="") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	if(document.frmCetak_pd1.cetak.value=='PA') {
		cetak_pd1();
	} else {
		jenis = document.frmCetak_pd1.jns.value;
		kdtrans = document.frmCetak_pd1.kdtrans.value;
		window.open(base_url+'index.php/persediaan_awal/'+jenis+'/'+kdtrans,'_blank');
	}
}

</script>
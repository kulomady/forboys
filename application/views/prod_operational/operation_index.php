<div id="tmpTb_pr8" style="background-color:#B8E0F5; padding:2px; padding-bottom:0px;"></div>
<div id="tmpLayout_pr8" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pr8" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pr8" name="frmSearch_pr8" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="115">Periode</td>
        <td width="262"><input name="tgl1_pr8" type="text" id="tgl1_pr8" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pr8" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pr8" type="text" id="tgl2_pr8" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pr8" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></td>
        <td width="132">Project Order</td>
        <td width="168" id="tmpPO_pr8"></td>
        <td width="257"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pr8();" /></td>
      </tr>
      <tr>
        <td>Cabang</td>
        <td><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
          <?php echo $gudang; ?>
        </select></td>
        <td>Keperluan</td>
        <td><input type="text" name="keperluan" id="keperluan" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>

<div id="tmpCetak_pr8" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<form id="frmCetak_pr8" name="frmCetak_pr8" method="post" action="javascript:void(0);">
  <table width="254" border="0" align="center">
    <tr>
      <td width="98">&nbsp;</td>
      <td width="146">&nbsp;</td>
    </tr>
    <tr>
      <td>Cetak</td>
      <td><select name="cetak" id="cetak" onchange="if(this.value=='PA') { document.frmCetak_pr8.jns.disabled = true; } else { document.frmCetak_pr8.jns.disabled = false; }">
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
      <td><input type="button" name="btnCetak" id="btnCetak" value="CETAK" onclick="cetakBarcode_pr8();" /></td>
      <td><input type="hidden" name="kdtrans" id="kdtrans" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
calTgl1_pr8 = new dhtmlXCalendarObject({
	input: "tgl1_pr8",button: "btnTgl1_pr8"
});

calTgl2_pr8 = new dhtmlXCalendarObject({
	input: "tgl2_pr8",button: "btnTgl2_pr8"
});

var cbPO_pr8 = new dhtmlXCombo("tmpPO_pr8", "cbPO_pr8", 120);
cbPO_pr8.enableFilteringMode(true);
cbPO_pr8.clearAll();
cbPO_pr8.loadXML(base_url+"index.php/pembayaran_cmt/cbPO");

tb_pr8 = new dhtmlXToolbarObject("tmpTb_pr8");
tb_pr8.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr8.setSkin("dhx_terrace");
tb_pr8.attachEvent("onclick", tbClick_pr8);
tb_pr8.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pr8.hideItem('print');																								  
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pr8 = new dhtmlXLayoutObject("tmpLayout_pr8", "2E");
dhxLayout_pr8.cells("a").setText("Cari Data");
dhxLayout_pr8.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pr8.cells("a").setHeight(80);
dhxLayout_pr8.cells("a").collapse();
dhxLayout_pr8.cells("a").attachObject("tmpSearch_pr8");
dhxLayout_pr8.cells("b").setText("Site Navigation");
dhxLayout_pr8.cells("b").hideHeader();


function tbClick_pr8(id) {
	if(id=='new') {
		winForm_pr8('input');
	} else if(id=='edit') {
		winForm_pr8('edit');
	} else if(id=='del') {
		hapus_pr8();
	} else if(id=='refresh') {
		 loadGd_pr8();
	} else if(id=='print') {
		showWinCetak_pr8(gd_pr8.cells(gd_pr8.getSelectedId(),1).getValue());
	} else if(id=='cari') {
		if(dhxLayout_pr8.cells("a").isCollapsed()) {
			dhxLayout_pr8.cells("a").expand();
		} else {
			dhxLayout_pr8.cells("a").collapse();
		}
	}
}

gd_pr8 = dhxLayout_pr8.cells("b").attachGrid();
gd_pr8.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr8.setHeader("&nbsp;,Tanggal,Cabang,Akun Kas,Akun Biaya,PO,Keperluan,Jml Biaya,Keterangan,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr8.setInitWidths("30,80,150,120,120,70,120,80,150,100,100");
gd_pr8.setColAlign("right,left,left,left,left,left,left,right,left,left,left");
gd_pr8.setColSorting("na,str,str,str,str,str,str,str,str,str,str");
gd_pr8.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ron,ro,ro,ro");
gd_pr8.setNumberFormat("0,000",7,",",".");
gd_pr8.enableSmartRendering(true,50);
gd_pr8.setColumnColor("#CCE2FE");
gd_pr8.setSkin("dhx_skyblue");
gd_pr8.splitAt(1);
gd_pr8.init();
loadGd_pr8();


function loadGd_pr8() {
	tgl1 = document.frmSearch_pr8.tgl1_pr8.value;
	tgl2 = document.frmSearch_pr8.tgl2_pr8.value;
	
	if(cbPO_pr8.getSelectedValue() != null) {
		po = cbPO_pr8.getSelectedValue();
	} else {
		po = 0;
	}
	if(document.frmSearch_pr8.slcOutlet_id.value != "") {
		outlet_id = document.frmSearch_pr8.slcOutlet_id.value;
	} else {
		outlet_id = 0;
	}
	if(document.frmSearch_pr8.keperluan.value != "") {
		keperluan = document.frmSearch_pr8.keperluan.value;
	} else {
		keperluan = 0;
	}
	statusLoading();
	gd_pr8.clearAll();
	gd_pr8.loadXML(base_url+"index.php/prod_operational/loadMainData/"+tgl1+"/"+tgl2+"/"+outlet_id+"/"+po+"/"+keperluan,function() {
		statusEnding();
	});
}

function refreshGd_pr8() {
	tgl1 = document.frmSearch_pr8.tgl1_pr8.value;
	tgl2 = document.frmSearch_pr8.tgl2_pr8.value;
	
	if(cbPO_pr8.getSelectedValue() != null) {
		po = cbPO_pr8.getSelectedValue();
	} else {
		po = 0;
	}
	if(document.frmSearch_pr8.slcOutlet_id.value != "") {
		outlet_id = document.frmSearch_pr8.slcOutlet_id.value;
	} else {
		outlet_id = 0;
	}
	if(document.frmSearch_pr8.keperluan.value != "") {
		keperluan = document.frmSearch_pr8.keperluan.value;
	} else {
		keperluan = 0;
	}
	gd_pr8.updateFromXML(base_url+"index.php/prod_operational/loadMainData/"+tgl1+"/"+tgl2+"/"+outlet_id+"/"+po+"/"+keperluan);
}

function winForm_pr8(type) {
	idselect = gd_pr8.getRowIndex(gd_pr8.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr8 = dhxWins.createWindow("w1_pr8",0,0,950,550);
	w1_pr8.setText("Biaya Operational");
	w1_pr8.button("park").hide();
	w1_pr8.button("minmax1").hide();
	w1_pr8.center();
	w1_pr8.setModal(true);
	if(type=='input') {
		w1_pr8.attachURL(base_url+"index.php/prod_operational/frm_input", true);
	} else {
		w1_pr8.attachURL(base_url+"index.php/prod_operational/frm_edit/"+gd_pr8.getSelectedId(), true);
	}
	
	w1_pr8.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pr8.close();
		try { wCom_pr8.close(); } catch(e) {}
		return;
    });
	
	tb_w1_pr8 = w1_pr8.attachToolbar();
	tb_w1_pr8.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr8.setSkin("dhx_terrace");
	tb_w1_pr8.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr8.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	//tb_w1_pr8.addButton("import", 3, "IMPORT", "import.png", "import.png");
	//tb_w1_pr8.addButton("export", 4, "EXPORT", "export.png", "export.png");
	//tb_w1_pr8.disableItem("baru");
	tb_w1_pr8.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pr8();
		} else if(id=='baru') {
			tb_w1_pr8.enableItem("baru");
			tb_w1_pr8.enableItem("save");
			baru_pr8();
		}
	});

}

function cetak_pr8() {
	idselect = gd_pr8.getRowIndex(gd_pr8.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window.open(base_url+'index.php/persediaan_awal/cetak/'+gd_pr8.getSelectedId(),'_blank');
}

function hapus_pr8() {
	idselect = gd_pr8.getRowIndex(gd_pr8.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'id=' + gd_pr8.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/prod_operational/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pr8.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
				
			});
		}
}

// Window Cetak
var winCetak_pr8 = dhxWins.createWindow("winCetak_pr8",0,0,300,150);
winCetak_pr8.setText("Cetak Persediaan Awal");
winCetak_pr8.button("park").hide();
winCetak_pr8.button("minmax1").hide();
winCetak_pr8.center();
winCetak_pr8.button("close").attachEvent("onClick", function() {
	winCetak_pr8.hide();
	winCetak_pr8.setModal(false);
});

winCetak_pr8.hide();

function showWinCetak_pr8(kdtrans) {
	//loadDaftarTunda_pj1();
	winCetak_pr8.bringToTop();
	winCetak_pr8.show();
	winCetak_pr8.setModal(true);
	winCetak_pr8.attachObject('tmpCetak_pr8');
	
	document.frmCetak_pr8.kdtrans.value = kdtrans;
}

function cetakBarcode_pr8() {
	if(document.frmCetak_pr8.kdtrans.value=="") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	if(document.frmCetak_pr8.cetak.value=='PA') {
		cetak_pr8();
	} else {
		jenis = document.frmCetak_pr8.jns.value;
		kdtrans = document.frmCetak_pr8.kdtrans.value;
		window.open(base_url+'index.php/persediaan_awal/'+jenis+'/'+kdtrans,'_blank');
	}
}

</script>
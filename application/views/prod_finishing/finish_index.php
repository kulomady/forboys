<div id="tmpTb_pr5" style="background-color:#B8E0F5; padding:2px; padding-bottom:0px;"></div>
<div id="tmpLayout_pr5" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pr5" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pr5" name="frmSearch_pr5" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="115">Periode</td>
        <td width="262"><input name="tgl1_pr5" type="text" id="tgl1_pr5" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pr5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pr5" type="text" id="tgl2_pr5" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pr5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></td>
        <td width="132">Project Order</td>
        <td width="168" id="tmpPO_pr5"></td>
        <td width="257"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pr5();" /></td>
      </tr>
      <tr>
        <td>Cabang</td>
        <td><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
          <?php echo $gudang; ?>
        </select></td>
        <td>Jenis Pekerjaan</td>
        <td><select name="jnsPekerjaan" id="jnsPekerjaan">
          <?php echo $pilihJnsPekerjaan; ?>
        </select></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>

<div id="tmpCetak_pr5" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<form id="frmCetak_pr5" name="frmCetak_pr5" method="post" action="javascript:void(0);">
  <table width="254" border="0" align="center">
    <tr>
      <td width="98">&nbsp;</td>
      <td width="146">&nbsp;</td>
    </tr>
    <tr>
      <td>Cetak</td>
      <td><select name="cetak" id="cetak" onchange="if(this.value=='PA') { document.frmCetak_pr5.jns.disabled = true; } else { document.frmCetak_pr5.jns.disabled = false; }">
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
      <td><input type="button" name="btnCetak" id="btnCetak" value="CETAK" onclick="cetakBarcode_pr5();" /></td>
      <td><input type="hidden" name="kdtrans" id="kdtrans" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
calTgl1_pr5 = new dhtmlXCalendarObject({
	input: "tgl1_pr5",button: "btnTgl1_pr5"
});

calTgl2_pr5 = new dhtmlXCalendarObject({
	input: "tgl2_pr5",button: "btnTgl2_pr5"
});

var cbPO_pr5 = new dhtmlXCombo("tmpPO_pr5", "cbPO_pr5", 120);
cbPO_pr5.enableFilteringMode(true);
cbPO_pr5.clearAll();
cbPO_pr5.loadXML(base_url+"index.php/pembayaran_cmt/cbPO");

tb_pr5 = new dhtmlXToolbarObject("tmpTb_pr5");
tb_pr5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr5.setSkin("dhx_terrace");
tb_pr5.attachEvent("onclick", tbClick_pr5);
tb_pr5.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pr5.hideItem('print');																								  	
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pr5 = new dhtmlXLayoutObject("tmpLayout_pr5", "2E");
dhxLayout_pr5.cells("a").setText("Cari Data");
dhxLayout_pr5.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pr5.cells("a").setHeight(80);
dhxLayout_pr5.cells("a").collapse();
dhxLayout_pr5.cells("a").attachObject("tmpSearch_pr5");
dhxLayout_pr5.cells("b").setText("Site Navigation");
dhxLayout_pr5.cells("b").hideHeader();


function tbClick_pr5(id) {
	if(id=='new') {
		winForm_pr5('input');
	} else if(id=='edit') {
		winForm_pr5('edit');
	} else if(id=='del') {
		hapus_pr5();
	} else if(id=='refresh') {
		 loadGd_pr5();
	} else if(id=='print') {
		showWinCetak_pr5(gd_pr5.cells(gd_pr5.getSelectedId(),1).getValue());
	} else if(id=='cari') {
		if(dhxLayout_pr5.cells("a").isCollapsed()) {
			dhxLayout_pr5.cells("a").expand();
		} else {
			dhxLayout_pr5.cells("a").collapse();
		}
	}
}

gd_pr5 = dhxLayout_pr5.cells("b").attachGrid();
gd_pr5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr5.setHeader("&nbsp;,Tanggal,Jenis Pekerjaan,Cabang,Nama,Akun Kas,Akun Biaya,PO,Jml PO,Jml Tagihan,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr5.setInitWidths("30,80,100,150,120,120,120,80,80,100,100,100");
gd_pr5.setColAlign("right,left,left,left,left,left,left,left,right,right,left,left");
gd_pr5.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str");
gd_pr5.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ron,ron,ro,ro");
gd_pr5.setNumberFormat("0,000",8,",",".");
gd_pr5.setNumberFormat("0,000",9,",",".");
gd_pr5.enableSmartRendering(true,50);
gd_pr5.setColumnColor("#CCE2FE");
gd_pr5.setSkin("dhx_skyblue");
gd_pr5.splitAt(1);
gd_pr5.init();
loadGd_pr5();


function loadGd_pr5() {
	tgl1 = document.frmSearch_pr5.tgl1_pr5.value;
	tgl2 = document.frmSearch_pr5.tgl2_pr5.value;
	
	if(cbPO_pr5.getSelectedValue() != null) {
		po = cbPO_pr5.getSelectedValue();
	} else {
		po = 0;
	}
	if(document.frmSearch_pr5.slcOutlet_id.value != "") {
		outlet_id = document.frmSearch_pr5.slcOutlet_id.value;
	} else {
		outlet_id = 0;
	}
	if(document.frmSearch_pr5.jnsPekerjaan.value != "") {
		jnsPekerjaan = document.frmSearch_pr5.jnsPekerjaan.value;
	} else {
		jnsPekerjaan = 0;
	}
	statusLoading();
	gd_pr5.clearAll();
	gd_pr5.loadXML(base_url+"index.php/prod_finishing/loadMainData/"+tgl1+"/"+tgl2+"/"+outlet_id+"/"+po+"/"+jnsPekerjaan,function() {
		statusEnding();
	});
}

function refreshGd_pr5() {
	tgl1 = document.frmSearch_pr5.tgl1_pr5.value;
	tgl2 = document.frmSearch_pr5.tgl2_pr5.value;
	
	if(cbPO_pr5.getSelectedValue() != null) {
		po = cbPO_pr5.getSelectedValue();
	} else {
		po = 0;
	}
	if(document.frmSearch_pr5.slcOutlet_id.value != "") {
		outlet_id = document.frmSearch_pr5.slcOutlet_id.value;
	} else {
		outlet_id = 0;
	}
	if(document.frmSearch_pr5.jnsPekerjaan.value != "") {
		jnsPekerjaan = document.frmSearch_pr5.jnsPekerjaan.value;
	} else {
		jnsPekerjaan = 0;
	}
	gd_pr5.updateFromXML(base_url+"index.php/prod_finishing/loadMainData/"+tgl1+"/"+tgl2+"/"+outlet_id+"/"+po+"/"+jnsPekerjaan);
}

function winForm_pr5(type) {
	idselect = gd_pr5.getRowIndex(gd_pr5.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr5 = dhxWins.createWindow("w1_pr5",0,0,950,550);
	w1_pr5.setText("Biaya finishing");
	w1_pr5.button("park").hide();
	w1_pr5.button("minmax1").hide();
	w1_pr5.center();
	w1_pr5.setModal(true);
	if(type=='input') {
		w1_pr5.attachURL(base_url+"index.php/prod_finishing/frm_input", true);
	} else {
		w1_pr5.attachURL(base_url+"index.php/prod_finishing/frm_edit/"+gd_pr5.getSelectedId(), true);
	}
	
	w1_pr5.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pr5.close();
		try { wCom_pr5.close(); } catch(e) {}
		return;
    });
	
	tb_w1_pr5 = w1_pr5.attachToolbar();
	tb_w1_pr5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr5.setSkin("dhx_terrace");
	tb_w1_pr5.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr5.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	//tb_w1_pr5.addButton("import", 3, "IMPORT", "import.png", "import.png");
	//tb_w1_pr5.addButton("export", 4, "EXPORT", "export.png", "export.png");
	//tb_w1_pr5.disableItem("baru");
	tb_w1_pr5.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pr5();
		} else if(id=='baru') {
			tb_w1_pr5.enableItem("baru");
			tb_w1_pr5.enableItem("save");
			baru_pr5();
		}
	});

}

function cetak_pr5() {
	idselect = gd_pr5.getRowIndex(gd_pr5.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window.open(base_url+'index.php/persediaan_awal/cetak/'+gd_pr5.getSelectedId(),'_blank');
}

function hapus_pr5() {
	idselect = gd_pr5.getRowIndex(gd_pr5.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'id=' + gd_pr5.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/prod_finishing/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pr5.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
				
			});
		}
}

// Window Cetak
var winCetak_pr5 = dhxWins.createWindow("winCetak_pr5",0,0,300,150);
winCetak_pr5.setText("Cetak Persediaan Awal");
winCetak_pr5.button("park").hide();
winCetak_pr5.button("minmax1").hide();
winCetak_pr5.center();
winCetak_pr5.button("close").attachEvent("onClick", function() {
	winCetak_pr5.hide();
	winCetak_pr5.setModal(false);
});

winCetak_pr5.hide();

function showWinCetak_pr5(kdtrans) {
	//loadDaftarTunda_pj1();
	winCetak_pr5.bringToTop();
	winCetak_pr5.show();
	winCetak_pr5.setModal(true);
	winCetak_pr5.attachObject('tmpCetak_pr5');
	
	document.frmCetak_pr5.kdtrans.value = kdtrans;
}

function cetakBarcode_pr5() {
	if(document.frmCetak_pr5.kdtrans.value=="") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	if(document.frmCetak_pr5.cetak.value=='PA') {
		cetak_pr5();
	} else {
		jenis = document.frmCetak_pr5.jns.value;
		kdtrans = document.frmCetak_pr5.kdtrans.value;
		window.open(base_url+'index.php/persediaan_awal/'+jenis+'/'+kdtrans,'_blank');
	}
}

</script>
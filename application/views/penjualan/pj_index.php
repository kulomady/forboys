<div id="tmpTb_pj4" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pj4" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pj4" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pj4" name="frmSearch_pj4" method="post" action="javascript:void(0);">
    <table width="1048" border="0">
      <tr>
        <td width="82">No.Transaksi</td>
        <td width="235"><input type="text" name="noTrans" id="noTrans" /></td>
        <td width="77">Gudang</td>
        <td width="176"><select name="gudang" id="gudang" style=" width:150px;">
          <?php echo $gudang; ?>
        </select></td>
        <td width="54">Sales</td>
        <td width="169"><select name="sales" id="sales" style=" width:150px;">
          <?php echo $sales; ?>
        </select></td>
        <td width="225" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pj4();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Periode</td>
        <td><input name="tgl1_pj4" type="text" id="tgl1_pj4" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pj4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pj4" type="text" id="tgl2_pj4" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pj4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td>Pelanggan</td>
        <td><select name="pelanggan" id="pelanggan" style=" width:150px;">
          <?php echo $pelanggan; ?>
        </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<div id="tmpCetak_pj4" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<form id="frmCetak_pj4" name="frmCetak_pj4" method="post" action="javascript:void(0);">
  <table width="254" border="0" align="center">
    <tr>
      <td width="98">&nbsp;</td>
      <td width="146">&nbsp;</td>
    </tr>
    <tr>
      <td>Cetak</td>
      <td><select name="cetak" id="cetak">
        <option value="SJ">Surat Jalan</option>
        <option value="INV">INVOICE</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="button" name="btnCetak" id="btnCetak" value="CETAK" onclick="cetak_pj4();" /></td>
      <td><input type="hidden" name="kdtrans" id="kdtrans" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
calTgl1_pj4 = new dhtmlXCalendarObject({
	input: "tgl1_pj4",button: "btnTgl1_pj4"
});

calTgl2_pj4 = new dhtmlXCalendarObject({
	input: "tgl2_pj4",button: "btnTgl2_pj4"
});

tb_pj4 = new dhtmlXToolbarObject("tmpTb_pj4");
tb_pj4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pj4.setSkin("dhx_terrace");
tb_pj4.attachEvent("onclick", tbClick_pj4);
tb_pj4.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pj4 = new dhtmlXLayoutObject("tmpLayout_pj4", "2E");
dhxLayout_pj4.cells("a").setText("Cari Data");
dhxLayout_pj4.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pj4.cells("a").setHeight(85);
dhxLayout_pj4.cells("a").collapse();
dhxLayout_pj4.cells("a").attachObject("tmpSearch_pj4");
dhxLayout_pj4.cells("b").setText("Site Navigation");
dhxLayout_pj4.cells("b").hideHeader();

function tbClick_pj4(id) {
	if(id=='new') {
		winForm_pj4('input');
	} else if(id=='edit') {
		winForm_pj4('edit');
	} else if(id=='del') {
		hapus_pj4();
	} else if(id=='refresh') {
		 loadGd_pj4();
	} else if(id=='print') {
		showWinCetak_pj4(gd_pj4.cells(gd_pj4.getSelectedId(),1).getValue());
	} else if(id=='cari') {
		if(dhxLayout_pj4.cells("a").isCollapsed()) {
			dhxLayout_pj4.cells("a").expand();
		} else {
			dhxLayout_pj4.cells("a").collapse();
		}
	}
}

gd_pj4 = dhxLayout_pj4.cells("b").attachGrid();
gd_pj4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pj4.setHeader("&nbsp;,No.Transaksi,Tanggal,Dari Gudang,Nama Pelanggan,Sales,Sub Total,Disc,Pajak,Sts Biaya,Biaya Lain,Total Akhir,DP SO,Titip/DP,Kekurangan,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pj4.setInitWidths("30,110,70,120,120,100,70,70,70,70,70,70,100,70,100,100");
gd_pj4.setColAlign("right,left,left,left,lef,left,right,right,right,right,left,right,right,right,right,left");
gd_pj4.setColSorting("na,int,str,str,str,int,str,date,date,str,str,str,str,str,str,str");
gd_pj4.setColTypes("cntr,ro,ro,ro,ro,ro,ron,ron,ron,ron,ro,ron,ron,ron,ron,ro");
gd_pj4.setNumberFormat("0,000",6,",",".");
gd_pj4.setNumberFormat("0,000",7,",",".");
gd_pj4.setNumberFormat("0,000",8,",",".");
gd_pj4.setNumberFormat("0,000",10,",",".");
gd_pj4.setNumberFormat("0,000",11,",",".");
gd_pj4.setNumberFormat("0,000",12,",",".");
gd_pj4.setNumberFormat("0,000",13,",",".");
gd_pj4.setNumberFormat("0,000",14,",",".");
gd_pj4.enableSmartRendering(true,50);
gd_pj4.setColumnColor("#CCE2FE");
gd_pj4.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;");
gd_pj4.setSkin("dhx_skyblue");
gd_pj4.splitAt(1);
gd_pj4.init();
loadGd_pj4();

function loadGd_pj4() {
	tglAwal = document.frmSearch_pj4.tgl1_pj4.value;
	tglAkhir = document.frmSearch_pj4.tgl2_pj4.value;
	if(document.frmSearch_pj4.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pj4.noTrans.value;
	}
	if(document.frmSearch_pj4.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pj4.gudang.value;
	}
	if(document.frmSearch_pj4.sales.value=="") {
		sales = "0";
	} else {
		sales = document.frmSearch_pj4.sales.value;
	}
	if(document.frmSearch_pj4.pelanggan.value=="") {
		pelanggan = "0";
	} else {
		pelanggan = document.frmSearch_pj4.pelanggan.value;
	}
	statusLoading();
	gd_pj4.clearAll();
	gd_pj4.loadXML(base_url+"index.php/penjualan/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+sales+"/"+pelanggan,function() {
		statusEnding();
	});
}

function refreshGd_pj4() {
	tglAwal = document.frmSearch_pj4.tgl1_pj4.value;
	tglAkhir = document.frmSearch_pj4.tgl2_pj4.value;
	if(document.frmSearch_pj4.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pj4.noTrans.value;
	}
	if(document.frmSearch_pj4.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pj4.gudang.value;
	}
	if(document.frmSearch_pj4.sales.value=="") {
		sales = "0";
	} else {
		sales = document.frmSearch_pj4.sales.value;
	}
	if(document.frmSearch_pj4.pelanggan.value=="") {
		pelanggan = "0";
	} else {
		pelanggan = document.frmSearch_pj4.pelanggan.value;
	}
	gd_pj4.updateFromXML(base_url+"index.php/penjualan/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+sales+"/"+pelanggan);
}

function winForm_pj4(type) {
	idselect = gd_pj4.getRowIndex(gd_pj4.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pj4 = dhxWins.createWindow("w1_pj4",0,0,1000,620);
	w1_pj4.setText("Penjualan");
	w1_pj4.button("park").hide();
	w1_pj4.button("minmax1").hide();
	w1_pj4.center();
	w1_pj4.setModal(true);
	if(type=='input') {
		w1_pj4.attachURL(base_url+"index.php/penjualan/frm_input", true);
	} else {
		w1_pj4.attachURL(base_url+"index.php/penjualan/frm_edit/"+gd_pj4.getSelectedId(), true);
	} 
	w1_pj4.button("close").attachEvent("onClick", function() {
		outlet_id = "";
		try { winPesanan_pj4.close(); } catch(e) {}
		w1_pj4.close();
	});
	
	tb_w1_pj4 = w1_pj4.attachToolbar();
	tb_w1_pj4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pj4.setSkin("dhx_terrace");
	tb_w1_pj4.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pj4.addButton("simpan", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pj4.addButton("cetak", 3, "CETAK", "print.gif", "print_dis.gif");
	tb_w1_pj4.disableItem("baru");
	tb_w1_pj4.attachEvent("onclick", function(id) {
		if(id=='baru') {
			tb_w1_pj4.disableItem("baru");
			tb_w1_pj4.enableItem("simpan");
			baru_pj4();
		} else if(id=='simpan') {
			simpan_pj4();
		}
	});

}

function hapus_pj4() {
		idselect = gd_pj4.getRowIndex(gd_pj4.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pj4.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/penjualan/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pj4.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}

// Window Cetak
var winCetak_pj4 = dhxWins.createWindow("winCetak_pj4",0,0,300,150);
winCetak_pj4.setText("Cetak Penjualan");
winCetak_pj4.button("park").hide();
winCetak_pj4.button("minmax1").hide();
winCetak_pj4.center();
winCetak_pj4.button("close").attachEvent("onClick", function() {
	winCetak_pj4.hide();
	winCetak_pj4.setModal(false);
});

winCetak_pj4.hide();

function showWinCetak_pj4(kdtrans) {
	//loadDaftarTunda_pj1();
	winCetak_pj4.bringToTop();
	winCetak_pj4.show();
	winCetak_pj4.setModal(true);
	winCetak_pj4.attachObject('tmpCetak_pj4');
	
	document.frmCetak_pj4.kdtrans.value = kdtrans;
}

function cetak_pj4() {
	if(document.frmCetak_pj4.kdtrans.value=="") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	
	kdtrans = document.frmCetak_pj4.kdtrans.value;
	if(document.frmCetak_pj4.cetak.value=='SJ') {
		window.open(base_url+'index.php/penjualan/cetak_sj/'+kdtrans,'_blank');
	} else {
		window.open(base_url+'index.php/penjualan/cetak_invoice/'+kdtrans,'_blank');
	}
}

</script>

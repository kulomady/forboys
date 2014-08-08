<div id="tmpTb_pb1" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pb1" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pb1" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pb1" name="frmSearch_pb1" method="post" action="javascript:void(0);">
    <table width="1048" border="0">
      <tr>
        <td width="82">No.Transaksi</td>
        <td width="235"><input type="text" name="noTrans" id="noTrans" /></td>
        <td width="77">Gudang</td>
        <td width="176"><select name="gudang" id="gudang" style=" width:150px;">
          <?php echo $gudang; ?>
        </select></td>
        <td width="54">No. PO</td>
        <td width="169"><input type="text" name="nopo" id="nopo" /></td>
        <td width="225" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pb1();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Periode</td>
        <td><input name="tgl1_pb1" type="text" id="tgl1_pb1" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pb1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pb1" type="text" id="tgl2_pb1" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pb1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td>Supplier</td>
        <td><select name="supplier" id="supplier" style=" width:150px;">
          <?php echo $supplier; ?>
        </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>

<div id="tmpCetak_pb1" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<form id="frmCetak_pb1" name="frmCetak_pb1" method="post" action="javascript:void(0);">
  <table width="254" border="0" align="center">
    <tr>
      <td width="98">&nbsp;</td>
      <td width="146">&nbsp;</td>
    </tr>
    <tr>
      <td>Cetak</td>
      <td><select name="cetak" id="cetak" onchange="if(this.value=='PB') { document.frmCetak_pb1.jns.disabled = true; } else { document.frmCetak_pb1.jns.disabled = false; }">
        <option value="PB">Pembelian Barang</option>
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
      <td><input type="button" name="btnCetak" id="btnCetak" value="CETAK" onclick="cetakBarcode_pb1();" /></td>
      <td><input type="hidden" name="kdtrans" id="kdtrans" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
calTgl1_pb1 = new dhtmlXCalendarObject({
	input: "tgl1_pb1",button: "btnTgl1_pb1"
});

calTgl2_pb1 = new dhtmlXCalendarObject({
	input: "tgl2_pb1",button: "btnTgl2_pb1"
});

tb_pb1 = new dhtmlXToolbarObject("tmpTb_pb1");
tb_pb1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pb1.setSkin("dhx_terrace");
tb_pb1.attachEvent("onclick", tbClick_pb1);
tb_pb1.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pb1 = new dhtmlXLayoutObject("tmpLayout_pb1", "2E");
dhxLayout_pb1.cells("a").setText("Cari Data");
dhxLayout_pb1.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pb1.cells("a").setHeight(85);
dhxLayout_pb1.cells("a").collapse();
dhxLayout_pb1.cells("a").attachObject("tmpSearch_pb1");
dhxLayout_pb1.cells("b").setText("Site Navigation");
dhxLayout_pb1.cells("b").hideHeader();

function tbClick_pb1(id) {
	if(id=='new') {
		winForm_pb1('input');
	} else if(id=='edit') {
		winForm_pb1('edit');
	} else if(id=='del') {
		hapus_pb1();
	} else if(id=='refresh') {
		 loadGd_pb1();
	} else if(id=='print') {
		showWinCetak_pb1(gd_pb1.cells(gd_pb1.getSelectedId(),1).getValue());
	} else if(id=='cari') {
		if(dhxLayout_pb1.cells("a").isCollapsed()) {
			dhxLayout_pb1.cells("a").expand();
		} else {
			dhxLayout_pb1.cells("a").collapse();
		}
	}
}

gd_pb1 = dhxLayout_pb1.cells("b").attachGrid();
gd_pb1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pb1.setHeader("&nbsp;,No.Transaksi,No.PO,Lokasi,Tanggal,Supplier,Jml Beli,#PCS,SubTotal,Disc,Pajak,Total,Tunai/DP,Kredit,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pb1.setInitWidths("30,120,120,130,75,120,65,0,85,65,65,75,75,75,80,80");
gd_pb1.setColAlign("right,left,left,left,left,left,center,center,right,right,right,right,right,right,left,left");
gd_pb1.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
gd_pb1.setColTypes("cntr,ro,ro,ro,ro,ro,ron,ron,ron,ron,ron,ron,ron,ron,ro,ro");
gd_pb1.setNumberFormat("0,000",6,",",".");
gd_pb1.setNumberFormat("0,000",7,",",".");
gd_pb1.setNumberFormat("0,000",8,",",".");
gd_pb1.setNumberFormat("0,000",9,",",".");
gd_pb1.setNumberFormat("0,000",10,",",".");
gd_pb1.setNumberFormat("0,000",11,",",".");
gd_pb1.setNumberFormat("0,000",12,",",".");
gd_pb1.setNumberFormat("0,000",13,",",".");
gd_pb1.enableSmartRendering(true,50);
gd_pb1.setColumnColor("#CCE2FE");
gd_pb1.setSkin("dhx_skyblue");
gd_pb1.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,&nbsp;");
gd_pb1.init();
loadGd_pb1();

function loadGd_pb1() {
	tglAwal = document.frmSearch_pb1.tgl1_pb1.value;
	tglAkhir = document.frmSearch_pb1.tgl2_pb1.value;
	if(document.frmSearch_pb1.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pb1.noTrans.value;
	}
	if(document.frmSearch_pb1.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pb1.gudang.value;
	}
	if(document.frmSearch_pb1.nopo.value=="") {
		nopo = "0";
	} else {
		nopo = document.frmSearch_pb1.nopo.value;
	}
	if(document.frmSearch_pb1.supplier.value=="") {
		supplier = "0";
	} else {
		supplier = document.frmSearch_pb1.supplier.value;
	}
	statusLoading();
	gd_pb1.clearAll();
	gd_pb1.loadXML(base_url+"index.php/pembelian_barang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+nopo+"/"+supplier,function() {
		statusEnding();
	});
}

function refreshGd_pb1() {
	tglAwal = document.frmSearch_pb1.tgl1_pb1.value;
	tglAkhir = document.frmSearch_pb1.tgl2_pb1.value;
	if(document.frmSearch_pb1.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pb1.noTrans.value;
	}
	if(document.frmSearch_pb1.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pb1.gudang.value;
	}
	if(document.frmSearch_pb1.nopo.value=="") {
		nopo = "0";
	} else {
		nopo = document.frmSearch_pb1.nopo.value;
	}
	if(document.frmSearch_pb1.supplier.value=="") {
		supplier = "0";
	} else {
		supplier = document.frmSearch_pb1.supplier.value;
	}
	gd_pb1.updateFromXML(base_url+"index.php/pembelian_barang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+nopo+"/"+supplier);
}

function winForm_pb1(type) {
	idselect = gd_pb1.getRowIndex(gd_pb1.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	
	/*if(type=='edit'){
		var flag = gd_pb1.cells(gd_pb1.getSelectedId(),10).getValue();
		if(flag!=0){
			alert("Maaf Transaksi ini sudah dilakukan Pembayaran !");
			return;
		}
	}*/
			
	w1_pb1 = dhxWins.createWindow("w1_pb1",0,0,930,580);
	w1_pb1.setText("Terima Pembelian Barang");
	w1_pb1.button("park").hide();
	w1_pb1.button("minmax1").hide();
	w1_pb1.center();
	w1_pb1.setModal(true);
	if(type=='input') {
		w1_pb1.attachURL(base_url+"index.php/pembelian_barang/frm_input", true);
	} else {
		w1_pb1.attachURL(base_url+"index.php/pembelian_barang/frm_edit/"+gd_pb1.getSelectedId(), true);
	}
	w1_pb1.button("close").attachEvent("onClick", function() {
		outlet_id = "";
		try { winPesanan_pb1.close(); } catch(e) {}
		try { winCetak_pb1.hide(); } catch(e) {}
		w1_pb1.close();
	});
	
	tb_w1_pb1 = w1_pb1.attachToolbar();
	tb_w1_pb1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pb1.setSkin("dhx_terrace");
	tb_w1_pb1.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pb1.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pb1.addButton("cetak", 2, "CETAK", "print.gif", "print_dis.gif");
	tb_w1_pb1.disableItem("cetak");
	tb_w1_pb1.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pb1();
		} else if(id=='baru') {
			tb_w1_pb1.enableItem("baru");
			tb_w1_pb1.enableItem("save");
			tb_w1_pb1.disableItem("cetak");
			baru_pb1();
		} else if(id=='open'){
			open_pb1();
		} else if(id=='cetak') {
			showWinCetak_pb1(document.frm_pb1.kdtrans.value);
		}
	});
}

function hapus_pb1() {
	/*var flag = gd_pb1.cells(gd_pb1.getSelectedId(),10).getValue();
	if(flag!=0){
		alert("Maaf Transaksi ini sudah dilakukan Pembayaran !");
		return;
	} */
	idselect = gd_pb1.getRowIndex(gd_pb1.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
           	'idrec=' + gd_pb1.getSelectedId();
		statusLoading();   
       	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pembelian_barang/hapus", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			if(result) {
				gd_pb1.deleteSelectedItem();
				alert("Data Berhasil Dihapus");
			} else {
				alert(result);
			}
		});
	}
}

function cetak_pb1() {
	if(document.frmCetak_pb1.kdtrans.value=="") {
		idselect = gd_pb1.getRowIndex(gd_pb1.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		kode = gd_pb1.cells(gd_pb1.getSelectedId(),1).getValue();
	} else {
		kode = document.frmCetak_pb1.kdtrans.value;
	}	
	window.open(base_url+'index.php/pembelian_barang/cetak_lpb/'+kode,'_blank');
}

// Window Cetak
var winCetak_pb1 = dhxWins.createWindow("winCetak_pb1",0,0,300,130);
winCetak_pb1.setText("Cetak Barcode");
winCetak_pb1.button("park").hide();
winCetak_pb1.button("minmax1").hide();
winCetak_pb1.center();
winCetak_pb1.button("close").attachEvent("onClick", function() {
	winCetak_pb1.hide();
	winCetak_pb1.setModal(false);
});

winCetak_pb1.hide();

function showWinCetak_pb1(kdtrans) {
	//loadDaftarTunda_pj1();
	winCetak_pb1.bringToTop();
	winCetak_pb1.show();
	winCetak_pb1.setModal(true);
	winCetak_pb1.attachObject('tmpCetak_pb1');
	
	document.frmCetak_pb1.kdtrans.value = kdtrans;
}

function cetakBarcode_pb1() {
	if(document.frmCetak_pb1.kdtrans.value=="") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	if(document.frmCetak_pb1.cetak.value=='PB') {
		cetak_pb1();
	} else {
		jenis = document.frmCetak_pb1.jns.value;
		kdtrans = document.frmCetak_pb1.kdtrans.value;
		window.open(base_url+'index.php/pembelian_barang/'+jenis+'/'+kdtrans,'_blank');
	}
}
</script>

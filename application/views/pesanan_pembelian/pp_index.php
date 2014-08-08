<div id="tmpTb_pb4" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pb4" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pb4">
  <form id="frmSearch_pb4" name="frmSearch_pb4" method="post" action="javascript:void(0);">
    <table width="690" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
      <tr>
        <td>No. Pesanan</td>
        <td><input type="text" name="noTrans" id="noTrans" /></td>
        <td>Supplier</td>
        <td><select name="slcSpl" id="slcSpl" style=" width:150px;">
          <?php echo $supplier; ?>
                </select></td>
        <td width="109" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pb4();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td width="84">Periode</td>
        <td width="223"><input name="tgl1_pb4" type="text" id="tgl1_pb4" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_pb4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
        <input name="tgl2_pb4" type="text" id="tgl2_pb4" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_pb4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>        </td>
        <td width="73">Gudang</td>
        <td width="179"><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
      <?php echo $gudang; ?>
      </select></td>
      </tr>
    </table>
  </form>
</div>

<div id="tmpCetak_pb4" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
<form id="frmCetak_pb4" name="frmCetak_pb4" method="post" action="javascript:void(0);">
  <table width="250" border="0" align="center">
    <tr>
      <td width="69">&nbsp;</td>
      <td width="149">&nbsp;</td>
    </tr>
    <tr>
      <td>Cetak</td>
      <td><select name="cetak" id="cetak" onchange="if(this.value=='PO') { document.frmCetak_pb4.jns.disabled = true; } else { document.frmCetak_pb4.jns.disabled = false; }">
        <option value="PO">Pesanan Pembelian</option>
        <option value="BARCODE">Barcode</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Jenis Kertas</td>
      <td><select name="jns" id="jns" disabled="disabled">
        <option value="barcodeLine2">Kolom 2</option>
      </select></td>
    </tr>
    <tr>
      <td><input type="button" name="btnCetak" id="btnCetak" value="CETAK" onclick="cetakBarcode_pb4();" /></td>
      <td><input type="hidden" name="kdtrans" id="kdtrans" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">

calTgl1_pb4 = new dhtmlXCalendarObject({
	input: "tgl1_pb4",button: "btnTgl1_pb4"
});

calTgl2_pj3 = new dhtmlXCalendarObject({
	input: "tgl2_pb4",button: "btnTgl2_pb4"
});

tb_pb4 = new dhtmlXToolbarObject("tmpTb_pb4");
tb_pb4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pb4.setSkin("dhx_terrace");
tb_pb4.attachEvent("onclick", tbClick_pb4);
tb_pb4.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

function tbClick_pb4(id) {
	if(id=='new') {
		winForm_pb4('input');
	} else if(id=='edit') {
		winForm_pb4('edit');
	} else if(id=='del') {
		hapus_pb4();
	} else if(id=='refresh') {
		 loadGd_pb4();
	} else if(id=='print') {
		showWinCetak_pb4(gd_pb4.cells(gd_pb4.getSelectedId(),1).getValue());
	} else if(id=='cari') {
		if(dhxLayout_pb4.cells("a").isCollapsed()) {
			dhxLayout_pb4.cells("a").expand();
		} else {
			dhxLayout_pb4.cells("a").collapse();
		}
	}
}

dhxLayout_pb4 = new dhtmlXLayoutObject("tmpLayout_pb4", "2E");
dhxLayout_pb4.cells("a").setText("Cari Data");
dhxLayout_pb4.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pb4.cells("a").setHeight(85);
dhxLayout_pb4.cells("a").collapse();
dhxLayout_pb4.cells("a").attachObject("frmSearch_pb4");
dhxLayout_pb4.cells("b").setText("Site Navigation");
dhxLayout_pb4.cells("b").hideHeader();

gd_pb4 = dhxLayout_pb4.cells("b").attachGrid();
gd_pb4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pb4.setHeader("&nbsp;,No.LPP,Lokasi,Tanggal,Supplier,Jml Psn,Jml Trm,Sub Total,Pot,Pajak,Total,Tunai/DP,Kurang,Dibuat Oleh,Tgl Buat",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pb4.setInitWidths("30,130,150,80,120,55,55,80,65,65,90,90,90,100,100");
gd_pb4.setColAlign("right,left,left,left,left,center,center,right,right,right,right,right,right,left,left");
gd_pb4.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
gd_pb4.setColTypes("cntr,ro,ro,ro,ro,ron,ron,ron,ron,ron,ron,ron,ron,ro,ro");
gd_pb4.setNumberFormat("0,000",5,",",".");
gd_pb4.setNumberFormat("0,000",6,",",".");
gd_pb4.setNumberFormat("0,000",7,",",".");
gd_pb4.setNumberFormat("0,000",8,",",".");
gd_pb4.setNumberFormat("0,000",9,",",".");
gd_pb4.setNumberFormat("0,000",10,",",".");
gd_pb4.setNumberFormat("0,000",11,",",".");
gd_pb4.setNumberFormat("0,000",12,",",".");
gd_pb4.setNumberFormat("0,000",13,",",".");
gd_pb4.enableSmartRendering(true,50);
gd_pb4.setColumnColor("#CCE2FE");
gd_pb4.setSkin("dhx_skyblue");
gd_pb4.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,&nbsp;");
//gd_pb4.splitAt(3);
gd_pb4.init();
loadGd_pb4();

function loadGd_pb4() {
	tglAwal = document.frmSearch_pb4.tgl1_pb4.value;
	tglAkhir = document.frmSearch_pb4.tgl2_pb4.value;
	if(document.frmSearch_pb4.noTrans.value != "") {
		noTrans = document.frmSearch_pb4.noTrans.value;
	} else {
		noTrans = 0;
	}
	if(document.frmSearch_pb4.slcSpl.value != "") {
		supplier = document.frmSearch_pb4.slcSpl.value;
	} else {
		supplier = 0;
	}
	if(document.frmSearch_pb4.slcOutlet_id.value != "") {
		gudang = document.frmSearch_pb4.slcOutlet_id.value;
	} else {
		gudang = 0;
	}
	statusLoading();
	gd_pb4.clearAll();
	gd_pb4.loadXML(base_url+"index.php/pesanan_pembelian/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+noTrans+"/"+supplier+"/"+gudang,function() {
		statusEnding();
	});
}

function refreshGd_pb4() {
	tglAwal = document.frmSearch_pb4.tgl1_pb4.value;
	tglAkhir = document.frmSearch_pb4.tgl2_pb4.value;
	if(document.frmSearch_pb4.noTrans.value != "") {
		noTrans = document.frmSearch_pb4.noTrans.value;
	} else {
		noTrans = 0;
	}
	if(document.frmSearch_pb4.slcSpl.value != "") {
		supplier = document.frmSearch_pb4.slcSpl.value;
	} else {
		supplier = 0;
	}
	if(document.frmSearch_pb4.slcOutlet_id.value != "") {
		gudang = document.frmSearch_pb4.slcOutlet_id.value;
	} else {
		gudang = 0;
	}
	gd_pb4.updateFromXML(base_url+"index.php/pesanan_pembelian/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+noTrans+"/"+supplier+"/"+gudang);
}

function winForm_pb4(type) {
	idselect = gd_pb4.getRowIndex(gd_pb4.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	
	if(type=='edit'){
		var flag = gd_pb4.cells(gd_pb4.getSelectedId(),9).getValue();
		if(flag!=0){
			alert("Maaf Transaksi ini sudah dilakukan Pembayaran !");
			return;
		}
	}
			
	w1_pb4 = dhxWins.createWindow("w1_pb4",0,0,1000,560);
	w1_pb4.setText("Tambah Data Pemesanan Pembelian");
	w1_pb4.button("park").hide();
	w1_pb4.button("minmax1").hide();
	w1_pb4.center();
	w1_pb4.setModal(true);
	if(type=='input') {
		w1_pb4.attachURL(base_url+"index.php/pesanan_pembelian/frm_input", true);
	} else {
		w1_pb4.attachURL(base_url+"index.php/pesanan_pembelian/frm_edit/"+gd_pb4.getSelectedId(), true);
	}
	
	w1_pb4.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        try { win_brg.hide(); } catch(e) {} 
		try { winCetak_pb4.hide(); } catch(e) {}
		try { w3_pb4.close(); } catch(e) {}
	   	w1_pb4.close();
		return;
    });
	
	tb_w1_pb4 = w1_pb4.attachToolbar();
	tb_w1_pb4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pb4.setSkin("dhx_terrace");
	tb_w1_pb4.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pb4.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pb4.addButton("cetak",3, "CETAK", "print.gif", "print_dis.gif");
	tb_w1_pb4.disableItem("cetak");
	tb_w1_pb4.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pb4();
		} else if(id=='baru') {
			tb_w1_pb4.enableItem("save");
			tb_w1_pb4.disableItem("cetak");
			baru_pb4();
		} else if(id=='cetak') {
			//cetakPO_pb4();
			showWinCetak_pb4(document.frm_pb4.no_lpp.value);
		}
	});
}

function hapus_pb4() {
	var flag = gd_pb4.cells(gd_pb4.getSelectedId(),9).getValue();
	if(flag!=0){
		alert("Maaf Transaksi ini sudah dilakukan Pembayaran !");
		return;
	}
	idselect = gd_pb4.getRowIndex(gd_pb4.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
           	'idrec=' + gd_pb4.getSelectedId();
		statusLoading();   
       	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pesanan_pembelian/hapus", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pb4.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
		});
	}
}

function cetak_pb4() {
	if(document.frmCetak_pb4.kdtrans.value=="") {
		idselect = gd_pb4.getRowIndex(gd_pb4.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		kode = gd_pb4.cells(gd_pb4.getSelectedId(),1).getValue();
	} else {
		kode = document.frmCetak_pb4.kdtrans.value;
	}	
	window.open(base_url+'index.php/pesanan_pembelian/cetak_pesanan/'+kode,'_blank');
}

// Window Cetak
var winCetak_pb4 = dhxWins.createWindow("winCetak_pb4",0,0,300,150);
winCetak_pb4.setText("Cetak Pesanan Beli");
winCetak_pb4.button("park").hide();
winCetak_pb4.button("minmax1").hide();
winCetak_pb4.center();
winCetak_pb4.button("close").attachEvent("onClick", function() {
	winCetak_pb4.hide();
	winCetak_pb4.setModal(false);
});

winCetak_pb4.hide();

function showWinCetak_pb4(kdtrans) {
	//loadDaftarTunda_pj1();
	winCetak_pb4.bringToTop();
	winCetak_pb4.show();
	winCetak_pb4.setModal(true);
	winCetak_pb4.attachObject('tmpCetak_pb4');
	
	document.frmCetak_pb4.kdtrans.value = kdtrans;
}

function cetakBarcode_pb4() {
	if(document.frmCetak_pb4.kdtrans.value=="") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	if(document.frmCetak_pb4.cetak.value=='PO') {
		cetak_pb4();
	} else {
		jenis = document.frmCetak_pb4.jns.value;
		kdtrans = document.frmCetak_pb4.kdtrans.value;
		window.open(base_url+'index.php/pesanan_pembelian/'+jenis+'/'+kdtrans,'_blank');
	}
}
</script>


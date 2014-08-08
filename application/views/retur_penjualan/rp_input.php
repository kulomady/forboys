<div class="frmContainer">
<form name="frm_pj5" id="frm_pj5" method="post" action="javascript:void(0);">
  <table width="950" border="0" align="center" style="padding-top:10px;">
    <tr>
      <td width="95">No. Transaksi</td>
      <td width="266"><input type="text" name="kdtrans" id="kdtrans" placeHolder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>"></td>
      <td width="97">No. Trs Jual</td>
      <td><input name="noTrsJual" type="text" id="noTrsJual" size="20" disabled="disabled" value="<?php if(isset($noTrsJual)): echo $noTrsJual; endif; ?>" />
        <img id="btnPsn" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/blue_view.png" border="0" style="cursor:pointer;" onclick="showWinPenjualan_pj5();" /></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)) { echo $tgl; } else { echo date('d/m/Y'); }?>" />
      <span id="tmpIconCal"><img id="btnTgl" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Keterangan</td>
      <td><input type="text" name="keterangan" id="keterangan" value="<?php if(isset($keterangan)): echo $keterangan; endif; ?>" /></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Gudang</td>
      <td><select name="gudang" id="gudang" style="width:150px;" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
        <?php echo $gudang; ?>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><input type="hidden" name="txtGrandTotal" id="txtGrandTotal" value="<?php if(isset($txtGrandTotal)): echo $txtGrandTotal; endif;?>" /></td>
    </tr>
    
    <tr>
      <td colspan="6"><div id="tmpGridInput_pj5" style="height:300px; width:100%;"></div></td>
      </tr>
    <tr>
      <td>Barcode</td>
      <td><input type="text" name="txtBarcode" id="txtBarcode" placeholder="Scan Barcode Disini" onkeyup="if(event.keyCode==13) { scanner_pj5(this.value);  }" />
        <input type="checkbox" name="cbShortment" id="cbShortment" />
Shortment</td>
      <td><div align="left">Sub Total</div></td>
      <td width="224" align="left"><input name="txtjml" type="text" id="txtjml" size="6" readonly="readonly" disabled="disabled" value="<?php if(isset($txtjml)): echo $txtjml; endif; ?>" />
        <input type="text" name="txtsubtotal" id="txtsubtotal"  style="text-align:right" disabled="disabled" value="<?php if(isset($txtsubtotal)): echo $txtsubtotal; endif; ?>" /></td>
      <td width="96">Total Akhir</td>
      <td width="146"><input type="text" name="txtTotalAkhir" id="txtTotalAkhir"  style="text-align:right" disabled="disabled" value="<?php if(isset($txtTotalAkhir)): echo $txtTotalAkhir; endif; ?>" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><span id="tmpInfoBarcode_pj5" style="color:#FF0000; font-weight:bold;"></span></td>
      <td><div align="left">Potongan</div></td>
      <td align="left"><input name="txtDiscPersen" type="text" id="txtDiscPersen" size="6" onkeyup="rpDisc_pj5();" value="<?php if(isset($txtDiscPersen)): echo $txtDiscPersen; endif;?>" />
        <input type="text" name="txtDiscRupiah" id="txtDiscRupiah" style="text-align:right" onkeyup="persenDisc_pj5();" value="<?php if(isset($txtDiscRupiah)): echo $txtDiscRupiah; endif; ?>" /></td>
      <td>Tunai</td> 
      <td><input type="text" name="txtTunai" id="txtTunai"  style="text-align:right" value="<?php if(isset($txtTunai)): echo $txtTunai; endif; ?>" onkeyup="hitungTotal_pj5();" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td><div align="left">Pajak</div></td>
      <td align="left"><select name="txtTaxPersen" id="txtTaxPersen" style="width:60px;" onchange="rpTax_pj5();">
                <?php echo $txtTaxPersen; ?>
              </select>
        <input type="text" name="txtTaxRupiah" id="txtTaxRupiah" style="text-align:right" disabled="disabled" value="<?php if(isset($txtTaxRupiah)): echo $txtTaxRupiah; endif; ?>" /></td>
      <td>Pot. Piutang</td>
      <td><input type="text" name="txtpot_piutang" id="txtpot_piutang"  style="text-align:right" disabled="disabled" value="<?php if(isset($txtPotPiutang)): echo $txtPotPiutang; endif; ?>" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td><div align="left">Biaya Lain</div></td>
      <td><select name="slcPajak" id="slcPajak" style="width:60px;" onchange="hitungTotal_pj5();">
                <?php echo $pilihPajak; ?>
              </select>
  <input name="txtBiayaLain" type="text" id="txtBiayaLain" style="text-align:right" onkeyup="hitungTotal_pj5();" value="<?php if(isset($txtBiayaLain)): echo $txtBiayaLain; endif; ?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div>
<div id="tmpWinPenjualan" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
<form name="frmPesan_pj5" id="frmPesan_pj5" method="post" action="javascript:void(0);">
  <table width="680" border="0" align="center">
    <tr>
      <td width="101">Kata Kunci</td>
      <td width="389"><select name="slcField" id="slcField">
        <option value="d.nmrekan">Pelanggan</option>
        <option value="a.kdtrans">No.Transaksi</option>
        <option value="c.nmrekan">Sales</option>
        <option value="a.keterangan">Keterangan</option>
                  </select>
        <input name="txtKunci" type="text" id="txtKunci" size="35" readonly="readonly" placeholder = "Masukan Kata Kunci" /></td>
      <td width="176" rowspan="2"><input type="button" name="button" id="button" value="Cari" style="width:100px; height:50px;" onclick="cariDataPenjualan_pj5();"/></td>
    </tr>
    <tr>
      <td>Periode</td>
      <td><input name="tglPesanan_1" type="text" id="tglPesanan_1" size="8" value="<?php echo date('Y-m-d'); ?>" />
        <img id="btnTglPesanan1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /> s.d
        <input name="tglPesanan_2" type="text" id="tglPesanan_2" size="8" value="<?php echo date('Y-m-d'); ?>" />
        <img id="btnTglPesanan2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></td>
    </tr>
    <tr>
      <td colspan="3"><div id="tmpGrid_jual_pj5" style="height:350px; width: 100%"></div></td>
      </tr>
  </table>
</form>
</div>

<script language="javascript">
outlet_id = document.frm_pj5.gudang.value;
gd_win_brg.clearAll();

// tanggal expired card
cal1_pj5 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTgl"
	});
cal1_pj5.setDateFormat("%d/%m/%Y");

/* cal2_pj5 = new dhtmlXCalendarObject({
			input: "tglKirim",button: "btnTglKirim"
	});
cal2_pj5.setDateFormat("%d/%m/%Y"); */

calPesanan1_pj5 = new dhtmlXCalendarObject({
			input: "tglPesanan_1",button: "btnTglPesanan1"
	});
calPesanan1_pj5.setDateFormat("%Y-%m-%d");

calPesanan2_pj5 = new dhtmlXCalendarObject({
			input: "tglPesanan_2",button: "btnTglPesanan2"
	});
calPesanan2_pj5.setDateFormat("%Y-%m-%d");

$(function() {            
        $('#txtsubtotal').number(true,0);
		$('#txtDiscRupiah').number(true,0);
		$('#txtTaxRupiah').number(true,0);
		$('#txtBiayaLain').number(true,0);
		$('#tunai').number(true,0);
		$('#kredit').number(true,0);
		$('#kartuKredit').number(true,0);
		$('#kartuDebit').number(true,0);
		$('#cekgiro').number(true,0);	
		$('#txtTotalAkhir').number(true,0);
		$('#txtTunai').number(true,0);
		$('#txtpot_piutang').number(true,0);
});


gdInp = new dhtmlXGridObject('tmpGridInput_pj5');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jumlah,Harga,Pot (%),Pot 2,Pot 3,Pot 4,Total,&nbsp;,hrgbeli",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,30,220,0,0,70,70,80,60,60,60,60,100,30,0");
gdInp.setColAlign("left,center,left,left,left,left,center,right,center,center,center,center,right,left,left");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,edn,edn,ed,ed,ed,ed,ron,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setNumberFormat("0,000",12,",",".");
gdInp.setSkin("dhx_skyblue");
gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pj5);
gdInp.init();

function loadDataInp_pj5(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/retur_penjualan/loadDataBrgDetail/"+kode,function() {
		addRowInp_pj5();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

<?php 
if(!isset($kdtrans)) { 
	echo "baru_pj5();"; 
} else { 
	echo 'loadDataInp_pj5("'.$kdtrans.'");'; 
}
?>

function doOnCellEdit_pj5(stage, rowId, cellInd) {
	
    if (stage == 2) {
	 if(cellInd == 6 || cellInd == 7 || cellInd == 8 || cellInd == 9 || cellInd == 10 || cellInd == 11) {
		qty = gdInp.cells(rowId,6).getValue();
		harga = gdInp.cells(rowId,7).getValue();
		total = qty * harga;
		// DISC 1
		if(gdInp.cells(rowId,8).getValue()!="") {
			disc_1 = total * gdInp.cells(rowId,8).getValue() / 100;
			total = total - disc_1;
		}
		// DISC 2
		if(gdInp.cells(rowId,9).getValue()!="") {
			disc_2 = total * gdInp.cells(rowId,9).getValue() / 100;
			total = total - disc_2;
		}
		// DISC 3
		if(gdInp.cells(rowId,10).getValue()!="") {
			disc_3 = total * gdInp.cells(rowId,10).getValue() / 100;
			total = total - disc_3;
		}
		// DISC 4
		if(gdInp.cells(rowId,11).getValue()!="") {
			disc_4 = total * gdInp.cells(rowId,11).getValue() / 100;
			total = total - disc_4;
		}
		total = pembulatanDisc(total);
        gdInp.cells(rowId,12).setValue(total);
	  }
	  subtotal_pj5();
	  rpDisc_pj5();
	  persenDisc_pj5();
	  rpTax_pj5();
	  addRowInp_pj5();
    }
    return true;
}

function subtotal_pj5() {
	var subtotal = 0;
	var jml = 0;
	gdInp.forEachRow(function(id){
		if(gdInp.cells(id,12).getValue() != "") {
			subtotal = subtotal + parseInt(gdInp.cells(id,12).getValue());
		}
		if(gdInp.cells(id,6).getValue() != "") {
			jml = jml + parseInt(gdInp.cells(id,6).getValue());
		}
	});
	$('#txtsubtotal').val(subtotal);
	document.frm_pj5.txtjml.value = jml;
	hitungTotal_pj5();
}

function rpDisc_pj5() {
	subtotal = $('#txtsubtotal').val();
	disc = document.frm_pj5.txtDiscPersen.value;
	if(disc != "" || disc != "0") {
		discRp = subtotal * disc/100;
		$('#txtDiscRupiah').val(discRp);
	}
	rpTax_pj5();
	hitungTotal_pj5();
}

function persenDisc_pj5() {
	subtotal = $('#txtsubtotal').val();
	disc = $('#txtDiscRupiah').val();
	if(disc != "" || disc != "0") {
		discPersen = (disc / subtotal) * 100;
		//$('#txtDiscRupiah').val(discRp);
		document.frm_pj5.txtDiscPersen.value = precise_round(discPersen,2);
	}
	rpTax_pj5();
	hitungTotal_pj5();
}

function rpTax_pj5() {
	subtotal = $('#txtsubtotal').val() - $('#txtDiscRupiah').val();
	tax = document.frm_pj5.txtTaxPersen.value;
	if(tax != "" || tax != "0") {
		txtRp = subtotal * tax/100;
		$('#txtTaxRupiah').val(txtRp);
	}
	hitungTotal_pj5();
}

function hitungTotal_pj5() {

	if($('#txtsubtotal').val() != "") {
		subtotal = $('#txtsubtotal').val();
	} else {
		subtotal = 0;
	}
	if($('#txtDiscRupiah').val() != "") {
		disc = $('#txtDiscRupiah').val();
	} else {
		disc = 0;
	}
	if($('#txtTaxRupiah').val() != "") {
		tax = $('#txtTaxRupiah').val();
	} else {
		tax = 0;
	}
	if($('#txtBiayaLain').val() != "") {
		biaya = $('#txtBiayaLain').val();
	} else {
		biaya = 0;
	}
	
	total = (subtotal - disc) + parseInt(tax);
	if(document.frm_pj5.slcPajak.value == '0') {
		grandTotal = parseInt(total) + parseInt(biaya);
	} else {
		pajakBiaya = biaya * (document.frm_pj5.slcPajak.value / 100);
		grandTotal = parseInt(total) + parseInt(biaya) + parseInt(pajakBiaya);
	}
	//document.getElementById('displayBelanja').innerHTML = format_number(grandTotal);
	//document.frm_pj5.txtGrandTotal.value = grandTotal;
	$('#txtTotalAkhir').val(grandTotal);
	tunai = $('#txtTunai').val();
	pot_piutang = grandTotal - tunai;
	$('#txtpot_piutang').val(pot_piutang);
}

function addRowInp_pj5() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; //arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','','',img_del,''],posisi);
			//gdInp.selectRow(posisi);
			//gdInp.showRow(gdInp.uid());
	}
}


function doOnEnterInp(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pj5();
	return true;
}

// Operasi Form
function simpan_pj5() {

	if(document.frm_pj5.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.frm_pj5.tgl.focus();
		return;
	}
	
	if(document.frm_pj5.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pj5.gudang.focus();
		return;
	}
	// hapus row terakhir yang kosong
	delRowInp();
	
	if(cekKosong(12)==1) {
		alert("Total salah satu barang tidak boleh kosong");
		return;
	}
	// Proses Simpan
 	var poststr =			
			'kdtrans=' + document.frm_pj5.kdtrans.value +
			'&tgl=' + document.frm_pj5.tgl.value +
			'&gudang=' + document.frm_pj5.gudang.value +
			'&noTrsJual=' + document.frm_pj5.noTrsJual.value +
			'&txtjml=' + document.frm_pj5.txtjml.value +
			'&txtsubtotal=' + $('#txtsubtotal').val() + 
			'&txtDiscPersen=' + document.frm_pj5.txtDiscPersen.value +
			'&txtDiscRupiah=' + $('#txtDiscRupiah').val() +
			'&txtTaxPersen=' + document.frm_pj5.txtTaxPersen.value +
			'&txtTaxRupiah=' + $('#txtTaxRupiah').val() +
			'&slcPajak=' + document.frm_pj5.slcPajak.value +
			'&txtBiayaLain=' + $('#txtBiayaLain').val() +
			'&txtTotalAkhir=' +  $('#txtTotalAkhir').val() +
			'&txtTunai=' +  $('#txtTunai').val() +
			'&txtpot_piutang=' +  $('#txtpot_piutang').val() +
			'&keterangan=' + document.frm_pj5.keterangan.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,13]);
        statusLoading();   
		tb_w1_pj5.disableItem("simpan");
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/retur_penjualan/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			
				document.frm_pj5.kdtrans.value = result;
				refreshGd_pj5();
				tb_w1_pj5.enableItem("simpan");
				tb_w1_pj5.enableItem("baru");
				addRowInp_pj5();
		
		});
}

function disabled_pj5() {
	document.frm_pj5.kdtrans.disabled = true;
	document.frm_pj5.tgl.disabled = true;
	document.frm_pj5.gudang.disabled = true;
	document.frm_pj5.noTrsJual.disabled = true;
	document.frm_pj5.txtjml.disabled = true;
	document.frm_pj5.txtsubtotal.disabled = true;
	document.frm_pj5.txtDiscPersen.disabled = true;
	document.frm_pj5.txtDiscRupiah.disabled = true;
	document.frm_pj5.txtTaxPersen.disabled = true;
	document.frm_pj5.txtTaxRupiah.disabled = true;
	document.frm_pj5.slcPajak.disabled = true;
	document.frm_pj5.txtBiayaLain.disabled = true; 
	document.frm_pj5.txtTotalAkhir.disabled = true; 
	document.frm_pj5.txtTunai.disabled = true; 
	document.frm_pj5.txtpot_piutang.disabled = true; 
	document.getElementById('tmpIconCal').innerHTML = "";
	document.frm_pj5.keterangan.disabled = true;
}

function enabled_pj5() {
	document.frm_pj5.kdtrans.disabled = false;
	document.frm_pj5.tgl.disabled = false;
	document.frm_pj5.gudang.disabled = false;
	document.frm_pj5.noTrsJual.disabled = false;
	document.frm_pj5.txtjml.disabled = false;
	document.frm_pj5.txtsubtotal.disabled = false;
	document.frm_pj5.txtDiscPersen.disabled = false;
	document.frm_pj5.txtDiscRupiah.disabled = false;
	document.frm_pj5.txtTaxPersen.disabled = false;
	document.frm_pj5.txtTaxRupiah.disabled = false;
	document.frm_pj5.slcPajak.disabled = false;
	document.frm_pj5.txtBiayaLain.disabled = false;
	document.frm_pj5.keterangan.disabled = false;
	document.frm_pj5.txtTotalAkhir.disabled = false;
	document.frm_pj5.txtTunai.disabled = false;
	document.frm_pj5.txtpot_piutang.disabled = false;
	//document.getElementById('tmpIconCal').innerHTML = '<img id="btnTgl" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" />';
}

function baru_pj5() {
	document.frm_pj5.kdtrans.value = "";
	document.frm_pj5.tgl.value = "<?php echo date('d/m/Y'); ?>";
	document.frm_pj5.txtBarcode.value = "";
	document.frm_pj5.gudang.value = "";
	document.frm_pj5.noTrsJual.value = "";
	document.frm_pj5.txtjml.value = "";
	document.frm_pj5.txtsubtotal.value = "";
	document.frm_pj5.txtDiscPersen.value = "";
	document.frm_pj5.txtDiscRupiah.value = "";
	document.frm_pj5.txtTaxPersen.value = "";
	document.frm_pj5.txtTaxRupiah.value = "";
	document.frm_pj5.slcPajak.value = "";
	document.frm_pj5.txtBiayaLain.value = "";
	document.frm_pj5.txtTotalAkhir.value = "";
	document.frm_pj5.txtTunai.value = "";
	document.frm_pj5.txtpot_piutang.value = "";
	document.frm_pj5.keterangan.value = "";
	outlet_id = "";
	
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','','',img_del,''],0);
	gdInp.selectRow(0);
	enabled_pj5();
	tb_w1_pj5.enableItem("simpan");
	tb_w1_pj5.enableItem("baru");
}

function pembulatanDisc(hrgDisc) {
	if(hrgDisc > 999) {
		var text = ""+hrgDisc+"";
		ratusan = text.substr(-3);
		nilai = parseInt(text);
		if(ratusan > 500) {
			tambah = 1000 - ratusan;
		} else if(ratusan < 500) {
			tambah = -1 * ratusan;	
		} else {
			tambah = 0;	
		}
		harga = nilai + tambah;
	} else {
		harga = hrgDisc;
	}
		return harga;
}

// Window Penjualan
var winPenjualan_pj5 = dhxWins.createWindow("winPenjualan_pj5",0,0,710,480);
winPenjualan_pj5.setText("Daftar Penjualan");
winPenjualan_pj5.button("park").hide();
winPenjualan_pj5.button("minmax1").hide();
winPenjualan_pj5.center();
winPenjualan_pj5.button("close").attachEvent("onClick", function() {
	winPenjualan_pj5.hide();
});

tb_winPenjualan_pj5 = winPenjualan_pj5.attachToolbar();
tb_winPenjualan_pj5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_winPenjualan_pj5.setSkin("dhx_terrace");
tb_winPenjualan_pj5.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_winPenjualan_pj5.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_winPenjualan_pj5.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			pilihPenjualan_pj5();
	} else if(id=='tutup') {
			winPenjualan_pj5.hide();
	}
});

gd_jual_pj5 = new dhtmlXGridObject('tmpGrid_jual_pj5');
gd_jual_pj5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_jual_pj5.setHeader("&nbsp;,No.Transfer,Tanggal,Nama Pelanggan,Sales,Jml Beli,Total",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_jual_pj5.setInitWidths("30,110,70,120,120,100,100");
gd_jual_pj5.setColAlign("right,left,left,left,left,left,right");
gd_jual_pj5.setColSorting("na,str,str,str,str,str,str");
gd_jual_pj5.setColTypes("cntr,ro,ro,ro,ro,ron,ron");
gd_jual_pj5.setNumberFormat("0,000",5,",",".");
gd_jual_pj5.setNumberFormat("0,000",6,",",".");
gd_jual_pj5.enableSmartRendering(true,50);
gd_jual_pj5.attachEvent("onRowDblClicked", function(rId,cInd){
	pilihPenjualan_pj5();
});
gd_jual_pj5.setColumnColor("#CCE2FE");
gd_jual_pj5.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>");
gd_jual_pj5.setSkin("dhx_skyblue");
gd_jual_pj5.splitAt(1);
gd_jual_pj5.init();

winPenjualan_pj5.hide();

function showWinPenjualan_pj5() {
	if(document.frm_pj5.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pj5.gudang.focus();
		return;
	}
	//loadDaftarTunda_pj1();
	winPenjualan_pj5.bringToTop();
	winPenjualan_pj5.show();
	winPenjualan_pj5.setModal(true);
	winPenjualan_pj5.attachObject('tmpWinPenjualan');
}

function cariDataPenjualan_pj5() {
	gudang = document.frm_pj5.gudang.value;
	slcField = document.frmPesan_pj5.slcField.value;
	if(document.frmPesan_pj5.txtKunci.value != "") {
		txtKunci = document.frmPesan_pj5.txtKunci.value;
	} else {
		txtKunci = 0;
	}
	tglAwal = document.frmPesan_pj5.tglPesanan_1.value;
	tglAkhir = document.frmPesan_pj5.tglPesanan_2.value;
	statusLoading();
	gd_jual_pj5.clearAll();
	gd_jual_pj5.loadXML(base_url+"index.php/retur_penjualan/loadDataPenjualan/"+gudang+"/"+slcField+"/"+txtKunci+"/"+tglAwal+"/"+tglAkhir,function() {
		statusEnding();
	});
}

function pilihPenjualan_pj5() {
	baru_pj5();
	document.frm_pj5.noTrsJual.value = gd_jual_pj5.cells(gd_jual_pj5.getSelectedId(),1).getValue();
	winPenjualan_pj5.hide();
}

function setDataBrgPj5(kode,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,total,hrgBeli) {

	if(adaBarang(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		grid.cells(grid.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0").click();
		return;
	}
	if(jml=="0") { jml = ""; }
	nmbarang = nmbarang+" "+warna+" "+ukuran;
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	gdInp.cells(gdInp.getSelectedId(),3).setValue(warna);
	gdInp.cells(gdInp.getSelectedId(),4).setValue(ukuran);
	gdInp.cells(gdInp.getSelectedId(),5).setValue(satuan);
	gdInp.cells(gdInp.getSelectedId(),6).setValue(jml);
	gdInp.cells(gdInp.getSelectedId(),7).setValue(hrg);
	gdInp.cells(gdInp.getSelectedId(),8).setValue(disc_1);
	gdInp.cells(gdInp.getSelectedId(),9).setValue(disc_2);
	gdInp.cells(gdInp.getSelectedId(),10).setValue(disc_3);
	gdInp.cells(gdInp.getSelectedId(),11).setValue(disc_4);
	gdInp.cells(gdInp.getSelectedId(),12).setValue(total);
	gdInp.cells(gdInp.getSelectedId(),14).setValue(hrgBeli);
	index = gdInp.getRowIndex(gdInp.getSelectedId());
	gdInp.setRowId(index,kode.toUpperCase());
	document.getElementById("pilihCell4").click();
}

function scanner_pj5(barcode) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	if(barcode=="") {
		alert("Barcode Tidak Boleh Kosong");
		return;
	}
	if(document.frm_pj5.cbShortment.checked==true) {
		scanSizeRun_pj5(barcode);
	} else {
		scanBarcode_pj5(barcode);
	}
}

function scanBarcode_pj5(barcode) {
	var poststr =
		'barcode=' + barcode +
		'&outlet_id=' + document.frm_pj5.gudang.value;
	document.getElementById('tmpInfoBarcode_pj5').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcodeJual", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pj5').innerHTML = "Barcode Tidak Ditemukan";
			return;
		} else {
			arrBrg = result.split('|');
			if(adaBarang(arrBrg[0]) == 0) {				
				posisi = 1; //gdInp.getRowsNum() - 1;
				total = arrBrg[5] * 1;
				total = kurangiDiscBrg(total,arrBrg[6]);
				total = kurangiDiscBrg(total,arrBrg[7]);
				total = kurangiDiscBrg(total,arrBrg[8]);
				total = pembulatanDisc(kurangiDiscBrg(total,arrBrg[9]));
				nmbarang = arrBrg[1]+" "+arrBrg[2]+" "+arrBrg[3];
				//Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jumlah,Harga,Pot (%),Pot 2,Pot 3,Pot 4,Total,&nbsp;,hrgBeli
				//[0]->idbarang.'|'.[1]->nmbarang.'|'.[2]->nmwarna.'|'.[3]->nmsize.'|'.[4]->nmsatuan.'|'.[5]->harga.'|'.[6]->disc_1.'|'.[7]->disc_2.'|'.[8]->disc_3.'|'.[9]->disc_4.'|'.[10]->harga_beli;
				gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,nmbarang,arrBrg[2],arrBrg[3],arrBrg[4],'1',arrBrg[5],arrBrg[6],arrBrg[7],arrBrg[8],arrBrg[9],total,img_del,arrBrg[10]],posisi);
				gdInp.selectRow(posisi);
				gdInp.showRow(arrBrg[0]);
			} else {
				if(gdInp.cells(arrBrg[0],6).getValue()=="") {
					qtyInp = 0;
				} else {
					qtyInp = gdInp.cells(arrBrg[0],6).getValue();
				}
				jmlSkrg = parseInt(qtyInp) + 1;
				total = arrBrg[5] * 1;
				total = kurangiDiscBrg(total,arrBrg[6]);
				total = kurangiDiscBrg(total,arrBrg[7]);
				total = kurangiDiscBrg(total,arrBrg[8]);
				total = pembulatanDisc(kurangiDiscBrg(total,arrBrg[9]));
				totalSkrg = parseInt(gdInp.cells(arrBrg[0],12).getValue()) + parseInt(total);
				gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
				gdInp.cells(arrBrg[0],12).setValue(totalSkrg);
				
			}
		}
		subtotal_pj5();
	 	rpDisc_pj5();
	  	persenDisc_pj5();
	  	rpTax_pj5();
		document.frm_pj5.txtBarcode.value = "";
		document.frm_pj5.txtBarcode.focus();
	});
}

function scanSizeRun_pj5(barcode) {
	var poststr =
		'sizeRun=' + barcode +
		'&outlet_id=' + document.frm_pj5.gudang.value;
	document.getElementById('tmpInfoBarcode_pj5').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRunJual", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0' || result == '') {
			document.getElementById('tmpInfoBarcode_pj5').innerHTML = "Size Run Tidak Ditemukan";
			return;
		} else {
			arrSizeRun = result.split("~");
			for(i=0;i<arrSizeRun.length;i++) {
				if(arrSizeRun[i] != "0" && arrSizeRun[i] != "") {
					arrBrg = arrSizeRun[i].split('|');
					if(adaBarang(arrBrg[0]) == 0) {				
						posisi = 1; //gdInp.getRowsNum() - 1;
						total = arrBrg[5] * arrBrg[6];
						total = kurangiDiscBrg(total,arrBrg[7]);
						total = kurangiDiscBrg(total,arrBrg[8]);
						total = kurangiDiscBrg(total,arrBrg[9]);
						total = pembulatanDisc(kurangiDiscBrg(total,arrBrg[10]));
						nmbarang = arrBrg[1]+" "+arrBrg[2]+" "+arrBrg[3];
						//Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jumlah,Harga,Pot (%),Pot 2,Pot 3,Pot 4,Total,&nbsp;,hrgBeli
						//[0]->idbarang.'|'.[1]->nmbarang.'|'.[2]->nmwarna.'|'.[3]->nmsize.'|'.[4]->nmsatuan.'|'.[5]->qty.'|'.[6]->harga.'|'.[7]->disc_1.'|'.[8]->disc_2.'|'.[9]->disc_3.'|'.[10]->disc_4.'|'.[11]->harga_beli
						gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,nmbarang,arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],arrBrg[6],arrBrg[7],arrBrg[8],arrBrg[9],arrBrg[10],total,img_del,arrBrg[11]],posisi);
						gdInp.selectRow(posisi);
						gdInp.showRow(arrBrg[0]);
					} else {
						if(gdInp.cells(arrBrg[0],6).getValue()=="") {
							qtyInp = 0;
						} else {
							qtyInp = gdInp.cells(arrBrg[0],6).getValue();
						}
						jmlSkrg = parseInt(qtyInp) + parseInt(arrBrg[5]);
						total = arrBrg[6] * arrBrg[5];
						total = kurangiDiscBrg(total,arrBrg[7]);
						total = kurangiDiscBrg(total,arrBrg[8]);
						total = kurangiDiscBrg(total,arrBrg[9]);
						total = pembulatanDisc(kurangiDiscBrg(total,arrBrg[10]));
						totalSkrg = parseInt(gdInp.cells(arrBrg[0],12).getValue()) + parseInt(total);
						gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
						gdInp.cells(arrBrg[0],12).setValue(totalSkrg);
					}
				}
			}
		}
		subtotal_pj5();
	 	rpDisc_pj5();
	  	persenDisc_pj5();
	  	rpTax_pj5();
		document.frm_pj5.txtBarcode.value = "";
		document.frm_pj5.txtBarcode.focus();
	});
}

</script>

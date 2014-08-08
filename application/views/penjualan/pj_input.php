<div class="frmContainer">
<form name="frm_pj4" id="frm_pj4" method="post" action="javascript:void(0);">
  <table width="950" border="0" align="center" style="padding-top:10px;">
    <tr>
      <td width="84">No. Transaksi</td>
      <td width="371"><input type="text" name="kdtrans" id="kdtrans" placeHolder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>"></td>
      <td width="90">Pesanan</td>
      <td><input name="noPesanan" type="text" id="noPesanan" size="20" disabled="disabled" value="<?php if(isset($noPesanan)): echo $noPesanan; endif; ?>" />
        <img id="btnPsn" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/blue_view.png" border="0" style="cursor:pointer;" onclick="showWinPesanan_pj4();" /></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)) { echo $tgl; } else { echo date('d/m/Y'); }?>" />
      <span id="tmpIconCal"><img id="btnTgl" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Project Order</td>
      <td><select name="nopo" id="nopo">
        <?php echo $pilihPO; ?>
      </select></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Pelanggan</td>
      <td><select name="pelanggan" id="pelanggan" style="width:150px;">
        <?php echo $pelanggan; ?>
      </select></td>
      <td>Sales</td>
      <td><select name="sales" id="sales" style="width:150px;" tabindex="14">
        <?php echo $sales; ?>
      </select></td>
      <td colspan="2"><input type="hidden" name="txtGrandTotal" id="txtGrandTotal" value="<?php if(isset($txtGrandTotal)): echo $txtGrandTotal; endif;?>" /></td>
    </tr>
    
    <tr>
      <td>Gudang</td>
      <td><select name="gudang" id="gudang" style="width:150px;" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
        <?php echo $gudang; ?>
      </select></td>
      <td>Keterangan</td>
      <td colspan="3"><input type="text" name="keterangan" id="keterangan" value="<?php if(isset($keterangan)): echo $keterangan; endif; ?>" /></td>
    </tr>
    <tr>
      <td colspan="6"><div id="tmpGridInput_pj4" style="height:300px; width:100%;"></div></td>
      </tr>
    <tr>
      <td>Barcode</td>
      <td><input type="text" name="txtBarcode" id="txtBarcode" placeholder="Scan Barcode Disini" onkeyup="if(event.keyCode==13) { scanner_pj4(this.value);  }" />
        <input type="checkbox" name="cbShortment" id="cbShortment" />
Shortment</td>
      <td><div align="left">Sub Total</div></td>
      <td width="202" align="left"><input name="txtjml" type="text" id="txtjml" size="6" readonly="readonly" disabled="disabled" value="<?php if(isset($txtjml)): echo $txtjml; endif; ?>" />
        <input name="txtsubtotal" type="text" disabled="disabled" id="txtsubtotal"  style="text-align:right" value="<?php if(isset($txtsubtotal)): echo $txtsubtotal; endif; ?>" size="12" /></td>
      <td width="89">Total Akhir</td>
      <td width="88"><input name="txtTotalAkhir" type="text" disabled="disabled" id="txtTotalAkhir"  style="text-align:right" value="<?php if(isset($txtTotalAkhir)): echo $txtTotalAkhir; endif; ?>" size="12" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><span id="tmpInfoBarcode_pj4" style="color:#FF0000; font-weight:bold;"></span></td>
      <td><div align="left">Potongan</div></td>
      <td align="left"><input name="txtDiscPersen" type="text" id="txtDiscPersen" size="6" onkeyup="rpDisc_pj4();" value="<?php if(isset($txtDiscPersen)): echo $txtDiscPersen; endif;?>" />
        <input name="txtDiscRupiah" type="text" id="txtDiscRupiah" style="text-align:right" onkeyup="persenDisc_pj4();" value="<?php if(isset($txtDiscRupiah)): echo $txtDiscRupiah; endif; ?>" size="12" /></td>
      <td>DP SO</td> 
      <td><input name="txtDpSO" type="text" id="txtDpSO"  style="text-align:right" onkeyup="hitungTotal_pj4();" value="<?php if(isset($txtDpSO)): echo $txtDpSO; endif; ?>" size="12" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td><div align="left">Pajak</div></td>
      <td align="left"><select name="txtTaxPersen" id="txtTaxPersen" style="width:60px;" onchange="rpTax_pj4();">
                <?php echo $txtTaxPersen; ?>
              </select>
        <input name="txtTaxRupiah" type="text" disabled="disabled" id="txtTaxRupiah" style="text-align:right" value="<?php if(isset($txtTaxRupiah)): echo $txtTaxRupiah; endif; ?>" size="12" /></td>
      <td>Tunai / DP</td>
      <td><input name="txtDp" type="text" id="txtDp"  style="text-align:right" onkeyup="hitungTotal_pj4();" value="<?php if(isset($txtDp)): echo $txtDp; endif; ?>" size="12" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td><div align="left">Biaya Lain</div></td>
      <td><select name="slcPajak" id="slcPajak" style="width:60px;" onchange="hitungTotal_pj4();">
                <?php echo $pilihPajak; ?>
              </select>
  <input name="txtBiayaLain" type="text" id="txtBiayaLain" size="12" style="text-align:right" onkeyup="hitungTotal_pj4();" value="<?php if(isset($txtBiayaLain)): echo $txtBiayaLain; endif; ?>" /></td>
      <td>Kredit</td>
      <td><input name="txtKurang" type="text" disabled="disabled" id="txtKurang"  style="text-align:right" value="<?php if(isset($txtKurang)): echo $txtKurang; endif; ?>" size="12" /></td>
    </tr>
  </table>
</form>
</div>
<div id="tmpWinPesanan" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
<form name="frmPesan_pj4" id="frmPesan_pj4" method="post" action="javascript:void(0);">
  <table width="765" border="0" align="center">
    <tr>
      <td width="101">Kata Kunci</td>
      <td width="389"><select name="slcField" id="slcField">
        <option value="a.idrekan">Pelanggan</option>
        <option value="a.kdtrans">No.Transaksi</option>
        <option value="a.tgl">Tanggal</option>
        <option value="a.tgl_kirim">Tgl Kirim</option>
        <option value="a.idsales">Sales</option>
        <option value="keterangan">Keterangan</option>
                  </select>
        <input name="txtKunci" type="text" id="txtKunci" size="35" placeholder = "Masukan Kata Kunci" /></td>
      <td width="261"><input type="button" name="button" id="button" value="Cari" style="width:100px;" onclick="cariDataPesanan_pj4();"/></td>
    </tr>
    
    <tr>
      <td colspan="3"><div id="tmpGrid_pesan_pj4" style="height:350px;width: 100%"></div></td>
      </tr>
  </table>
</form>
</div>

<script language="javascript">
outlet_id = document.frm_pj4.gudang.value;
gd_win_brg.clearAll();

// tanggal expired card
cal1_pj4 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTgl"
	});
cal1_pj4.setDateFormat("%d/%m/%Y");

cal2_pj4 = new dhtmlXCalendarObject({
			input: "tglKirim",button: "btnTglKirim"
	});
cal2_pj4.setDateFormat("%d/%m/%Y");

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
		$('#txtDp').number(true,0);
		$('#txtKurang').number(true,0);	
		$('#txtDpSO').number(true,0);
});


gdInp = new dhtmlXGridObject('tmpGridInput_pj4');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jumlah,Harga,Pot (%),Pot 2,Pot 3,Pot 4,Total,&nbsp;,hrgBeli",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,30,220,0,0,70,70,80,60,60,60,60,100,30,0");
gdInp.setColAlign("left,center,left,left,left,left,center,right,center,center,center,center,right,left,left");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,edn,edn,ed,ed,ed,ed,ron,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setNumberFormat("0,000",12,",",".");
gdInp.setSkin("dhx_skyblue");
gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pj4);
gdInp.init();

function loadDataInp_pj4(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/penjualan/loadDataBrgDetail/"+kode,function() {
		addRowInp_pj4();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

<?php 
if(!isset($kdtrans)) { 
	echo "baru_pj4();"; 
} else { 
	echo 'loadDataInp_pj4("'.$kdtrans.'");'; 
}
?>

function doOnCellEdit_pj4(stage, rowId, cellInd) {
	
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
		//total = pembulatanDisc(total);
        gdInp.cells(rowId,12).setValue(total);
	  }
	  subtotal_pj4();
	  rpDisc_pj4();
	  persenDisc_pj4();
	  rpTax_pj4();
	  addRowInp_pj4();
    }
    return true;
}

function subtotal_pj4() {
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
	document.frm_pj4.txtjml.value = jml;
	hitungTotal_pj4();
}

function rpDisc_pj4() {
	subtotal = $('#txtsubtotal').val();
	disc = document.frm_pj4.txtDiscPersen.value;
	if(disc != "" || disc != "0") {
		discRp = subtotal * disc/100;
		$('#txtDiscRupiah').val(discRp);
	}
	rpTax_pj4();
	hitungTotal_pj4();
}

function persenDisc_pj4() {
	subtotal = $('#txtsubtotal').val();
	disc = $('#txtDiscRupiah').val();
	if(disc != "" || disc != "0") {
		discPersen = (disc / subtotal) * 100;
		//$('#txtDiscRupiah').val(discRp);
		document.frm_pj4.txtDiscPersen.value = precise_round(discPersen,2);
	}
	rpTax_pj4();
	hitungTotal_pj4();
}

function rpTax_pj4() {
	subtotal = $('#txtsubtotal').val() - $('#txtDiscRupiah').val();
	tax = document.frm_pj4.txtTaxPersen.value;
	if(tax != "" || tax != "0") {
		txtRp = subtotal * tax/100;
		$('#txtTaxRupiah').val(txtRp);
	}
	hitungTotal_pj4();
}

function hitungTotal_pj4() {

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
	/* if(document.frm_pj4.slcBiaya.value=='TAMBAH') {
		grandTotal = parseInt(total) + parseInt(biaya);
	} else {
		grandTotal = total;
	} */
	
	if(document.frm_pj4.slcPajak.value == '0') {
		grandTotal = parseInt(total) + parseInt(biaya);
	} else {
		pajakBiaya = biaya * (document.frm_pj4.slcPajak.value / 100);
		grandTotal = parseInt(total) + parseInt(biaya) + parseInt(pajakBiaya);
	}
	//document.getElementById('displayBelanja').innerHTML = format_number(grandTotal);
	//document.frm_pj4.txtGrandTotal.value = grandTotal;
	$('#txtTotalAkhir').val(grandTotal);
	dpSO = $('#txtDpSO').val();
	dp = $('#txtDp').val();
	kurang = grandTotal - dpSO - dp;
	$('#txtKurang').val(kurang);
}

function addRowInp_pj4() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; //arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','','',img_del,''],posisi);
			//gdInp.selectRow(posisi);
			try { gdInp.showRow(gdInp.uid()); } catch(e) {}
	}
}


function doOnEnterInp(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pj4();
	return true;
}



// Operasi Form
function simpan_pj4(tipeSimpan) {
	
	if(document.frm_pj4.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.frm_pj4.tgl.focus();
		return;
	}
	
	if(document.frm_pj4.pelanggan.value=="") {
		alert("Pelanggan Tidak Boleh Kosong");
		document.frm_pj4.pelanggan.focus();
		return;
	}
	
	if(document.frm_pj4.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pj4.gudang.focus();
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
			'kdtrans=' + document.frm_pj4.kdtrans.value +
			'&tgl=' + document.frm_pj4.tgl.value +
			'&pelanggan=' + document.frm_pj4.pelanggan.value +
			'&gudang=' + document.frm_pj4.gudang.value +
			'&noPesanan=' + document.frm_pj4.noPesanan.value +
			'&nopo=' + document.frm_pj4.nopo.value +
			'&txtjml=' + document.frm_pj4.txtjml.value +
			'&txtsubtotal=' + $('#txtsubtotal').val() + 
			'&txtDiscPersen=' + document.frm_pj4.txtDiscPersen.value +
			'&txtDiscRupiah=' + $('#txtDiscRupiah').val() +
			'&txtTaxPersen=' + document.frm_pj4.txtTaxPersen.value +
			'&txtTaxRupiah=' + $('#txtTaxRupiah').val() +
			'&slcPajak=' + document.frm_pj4.slcPajak.value +
			'&txtBiayaLain=' + $('#txtBiayaLain').val() +
			'&txtTotalAkhir=' +  $('#txtTotalAkhir').val() +
			'&txtDp=' +  $('#txtDp').val() +
			'&txtKurang=' +  $('#txtKurang').val() +
			'&sales=' + document.frm_pj4.sales.value +
			'&keterangan=' + document.frm_pj4.keterangan.value +
			'&txtDpSO=' + $('#txtDpSO').val() +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,13]);
        statusLoading();   
		tb_w1_pj4.disableItem("simpan");
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/penjualan/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			
				document.frm_pj4.kdtrans.value = result;
				refreshGd_pj4();
				tb_w1_pj4.enableItem("simpan");
				tb_w1_pj4.enableItem("baru");
				addRowInp_pj4();
		
		});
}

function disabled_pj4() {
	document.frm_pj4.kdtrans.disabled = true;
	document.frm_pj4.tgl.disabled = true;
	document.frm_pj4.pelanggan.disabled = true;
	document.frm_pj4.gudang.disabled = true;
	document.frm_pj4.noPesanan.disabled = true;
	document.frm_pj4.nopo.disabled = true;
	document.frm_pj4.txtjml.disabled = true;
	document.frm_pj4.txtsubtotal.disabled = true;
	document.frm_pj4.txtDiscPersen.disabled = true;
	document.frm_pj4.txtDiscRupiah.disabled = true;
	document.frm_pj4.txtTaxPersen.disabled = true;
	document.frm_pj4.txtTaxRupiah.disabled = true;
	document.frm_pj4.slcPajak.disabled = true;
	document.frm_pj4.txtBiayaLain.disabled = true; 
	//document.frm_pj4.tglKirim.disabled = true; 
	document.frm_pj4.txtTotalAkhir.disabled = true; 
	document.frm_pj4.txtDp.disabled = true; 
	document.frm_pj4.txtKurang.disabled = true; 
	document.getElementById('tmpIconCal').innerHTML = "";
	document.frm_pj4.sales.disabled = true;
	document.frm_pj4.keterangan.disabled = true;
	document.frm_pj4.txtDpSO.disabled = true;
}

function enabled_pj4() {
	document.frm_pj4.kdtrans.disabled = false;
	document.frm_pj4.tgl.disabled = false;
	document.frm_pj4.pelanggan.disabled = false;
	document.frm_pj4.gudang.disabled = false;
	document.frm_pj4.noPesanan.disabled = false;
	document.frm_pj4.nopo.disabled = false;
	document.frm_pj4.txtjml.disabled = false;
	document.frm_pj4.txtsubtotal.disabled = false;
	document.frm_pj4.txtDiscPersen.disabled = false;
	document.frm_pj4.txtDiscRupiah.disabled = false;
	document.frm_pj4.txtTaxPersen.disabled = false;
	document.frm_pj4.txtTaxRupiah.disabled = false;
	document.frm_pj4.slcPajak.disabled = false;
	document.frm_pj4.txtBiayaLain.disabled = false;
	document.frm_pj4.sales.disabled = false;
	document.frm_pj4.keterangan.disabled = false;
	
	//document.frm_pj4.tglKirim.disabled = false; 
	document.frm_pj4.txtTotalAkhir.disabled = false;
	document.frm_pj4.txtDp.disabled = false;
	document.frm_pj4.txtKurang.disabled = false;
	document.frm_pj4.txtDpSO.disabled = false;
	document.getElementById('tmpIconCal').innerHTML = '<img id="btnTgl" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" />';
}

function baru_pj4() {
	document.frm_pj4.kdtrans.value = "";
	document.frm_pj4.tgl.value = "<?php echo date('d/m/Y'); ?>";
	document.frm_pj4.pelanggan.value = "";
	document.frm_pj4.txtBarcode.value = "";
	document.frm_pj4.gudang.value = "";
	document.frm_pj4.noPesanan.value = "";
	document.frm_pj4.nopo.value = "";
	document.frm_pj4.txtjml.value = "";
	document.frm_pj4.txtsubtotal.value = "";
	document.frm_pj4.txtDiscPersen.value = "";
	document.frm_pj4.txtDiscRupiah.value = "";
	document.frm_pj4.txtTaxPersen.value = "";
	document.frm_pj4.txtTaxRupiah.value = "";
	document.frm_pj4.slcPajak.value = "0";
	document.frm_pj4.txtBiayaLain.value = "";
	
	document.frm_pj4.txtTotalAkhir.value = "";
	document.frm_pj4.txtDpSO.value = "";
	document.frm_pj4.txtDp.value = "";
	document.frm_pj4.txtKurang.value = "";
	
	document.frm_pj4.sales.value = "";
	document.frm_pj4.keterangan.value = "";
	outlet_id = "";
	
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','','',img_del,''],0);
	gdInp.selectRow(0);
	enabled_pj4();
	tb_w1_pj4.enableItem("simpan");
	tb_w1_pj4.enableItem("baru");
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

// Window Pesanan
var winPesanan_pj4 = dhxWins.createWindow("winPesanan_pj4",0,0,800,480);
winPesanan_pj4.setText("Daftar Pesanan");
winPesanan_pj4.button("park").hide();
winPesanan_pj4.button("minmax1").hide();
winPesanan_pj4.center();
winPesanan_pj4.button("close").attachEvent("onClick", function() {
	winPesanan_pj4.hide();
});

tb_winPesanan_pj4 = winPesanan_pj4.attachToolbar();
tb_winPesanan_pj4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_winPesanan_pj4.setSkin("dhx_terrace");
tb_winPesanan_pj4.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_winPesanan_pj4.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_winPesanan_pj4.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			pilihPesanan_pj4();
	} else if(id=='tutup') {
			win_brg.hide();
	}
});

gd_Pesan_pj4 = new dhtmlXGridObject('tmpGrid_pesan_pj4');
gd_Pesan_pj4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_Pesan_pj4.setHeader("&nbsp;,No.Transfer,Tanggal,Nama Pelanggan,Sales,Tgl Kirim,Jml Pesan,Total,DP",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_Pesan_pj4.setInitWidths("30,110,70,120,120,70,100,100,0");
gd_Pesan_pj4.setColAlign("right,left,left,left,left,left,left,right,right,right");
gd_Pesan_pj4.setColSorting("na,str,str,str,str,str,str,str,str");
gd_Pesan_pj4.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ron,ron,ro");
gd_Pesan_pj4.setNumberFormat("0,000",7,",",".");
gd_Pesan_pj4.setNumberFormat("0,000",8,",",".");
gd_Pesan_pj4.enableSmartRendering(true,50);
gd_Pesan_pj4.attachEvent("onRowDblClicked", function(rId,cInd){
	pilihPesanan_pj4();
});
gd_Pesan_pj4.setColumnColor("#CCE2FE");
gd_Pesan_pj4.setColumnColor("#CCE2FE");
gd_Pesan_pj4.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>");
gd_Pesan_pj4.setSkin("dhx_skyblue");
gd_Pesan_pj4.splitAt(1);
gd_Pesan_pj4.init();

winPesanan_pj4.hide();

function showWinPesanan_pj4() {
	if(document.frm_pj4.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pj4.gudang.focus();
		return;
	}
	//loadDaftarTunda_pj1();
	winPesanan_pj4.bringToTop();
	winPesanan_pj4.show();
	winPesanan_pj4.setModal(true);
	winPesanan_pj4.attachObject('tmpWinPesanan');
}

function cariDataPesanan_pj4() {
	gudang = document.frm_pj4.gudang.value;
	slcField = document.frmPesan_pj4.slcField.value;
	if(document.frmPesan_pj4.txtKunci.value != "") {
		txtKunci = document.frmPesan_pj4.txtKunci.value;
	} else {
		txtKunci = 0;
	}
	gd_Pesan_pj4.clearAll();
	gd_Pesan_pj4.loadXML(base_url+"index.php/penjualan/loadDataPesanan/"+gudang+"/"+slcField+"/"+txtKunci);
}

function pilihPesanan_pj4() {
	//baru_pj4();
	document.frm_pj4.noPesanan.value = gd_Pesan_pj4.cells(gd_Pesan_pj4.getSelectedId(),1).getValue();
	dp = gd_Pesan_pj4.cells(gd_Pesan_pj4.getSelectedId(),8).getValue();
	$('#txtDpSO').val(dp);
	winPesanan_pj4.hide();
}

function setDataBrgPj4(kode,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,total,hrgBeli) {
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

function scanner_pj4(barcode) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	if(barcode=="") {
		alert("Barcode Tidak Boleh Kosong");
		return;
	}
	if(document.frm_pj4.cbShortment.checked==true) {
		scanSizeRun_pj4(barcode);
	} else {
		scanBarcode_pj4(barcode);
	}
}

function scanBarcode_pj4(barcode) {
	var poststr =
		'barcode=' + barcode +
		'&outlet_id=' + document.frm_pj4.gudang.value;
	document.getElementById('tmpInfoBarcode_pj4').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcodeJual", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pj4').innerHTML = "Barcode Tidak Ditemukan";
			return;
		} else {
			arrBrg = result.split('|');
			if(adaBarang(arrBrg[0]) == 0) {				
				posisi = gdInp.getRowsNum() - 1;
				total = arrBrg[5] * 1;
				total = kurangiDiscBrg(total,arrBrg[6]);
				total = kurangiDiscBrg(total,arrBrg[7]);
				total = kurangiDiscBrg(total,arrBrg[8]);
				total = kurangiDiscBrg(total,arrBrg[9]);
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
				total = kurangiDiscBrg(total,arrBrg[9]);
				totalSkrg = parseInt(gdInp.cells(arrBrg[0],12).getValue()) + parseInt(total);
				gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
				gdInp.cells(arrBrg[0],12).setValue(totalSkrg);
				
			}
		}
		subtotal_pj4();
	 	rpDisc_pj4();
	  	persenDisc_pj4();
	  	rpTax_pj4();
		document.frm_pj4.txtBarcode.value = "";
		document.frm_pj4.txtBarcode.focus();
	});
}

function scanSizeRun_pj4(barcode) {
	var poststr =
		'sizeRun=' + barcode +
		'&outlet_id=' + document.frm_pj4.gudang.value;
	document.getElementById('tmpInfoBarcode_pj4').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRunJual", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0' || result == '') {
			document.getElementById('tmpInfoBarcode_pj4').innerHTML = "Size Run Tidak Ditemukan";
			return;
		} else {
			arrSizeRun = result.split("~");
			for(i=0;i<arrSizeRun.length;i++) {
				if(arrSizeRun[i] != "0" && arrSizeRun[i] != "") {
					arrBrg = arrSizeRun[i].split('|');
					if(adaBarang(arrBrg[0]) == 0) {				
						posisi = gdInp.getRowsNum() - 1;
						total = arrBrg[5] * arrBrg[6];
						total = kurangiDiscBrg(total,arrBrg[7]);
						total = kurangiDiscBrg(total,arrBrg[8]);
						total = kurangiDiscBrg(total,arrBrg[9]);
						total = kurangiDiscBrg(total,arrBrg[10]);
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
						total = kurangiDiscBrg(total,arrBrg[10]);
						totalSkrg = parseInt(gdInp.cells(arrBrg[0],12).getValue()) + parseInt(total);
						gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
						gdInp.cells(arrBrg[0],12).setValue(totalSkrg);
					}
				}
			}
		}
		subtotal_pj4();
	 	rpDisc_pj4();
	  	persenDisc_pj4();
	  	rpTax_pj4();
		document.frm_pj4.txtBarcode.value = "";
		document.frm_pj4.txtBarcode.focus();
	});
}

</script>

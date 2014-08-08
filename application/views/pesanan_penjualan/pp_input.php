<div class="frmContainer">
<form name="frm_pj3" id="frm_pj3" method="post" action="javascript:void(0);">
  <table width="950" border="0" align="center" style="padding-top:10px;">
    <tr>
      <td width="95">No. Transaksi</td>
      <td width="266"><input type="text" name="kdtrans" id="kdtrans" placeHolder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>"></td>
      <td width="97">Sales</td>
      <td><select name="sales" id="sales" style="width:150px;" tabindex="14">
        <?php echo $sales; ?>
      </select></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)) { echo $tgl; } else { echo date('d/m/Y'); }?>" />
      <span id="tmpIconCal"><img id="btnTgl" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Tanggal Kirim</td>
      <td><input name="tglKirim" type="text" id="tglKirim" size="8" value="<?php if(isset($tglKirim)): echo $tglKirim; endif; ?>" />
        <span id="tmpIconCal2"><img id="btnTglKirim" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Pelanggan</td>
      <td><select name="pelanggan" id="pelanggan" style="width:150px;">
        <?php echo $pelanggan; ?>
      </select></td>
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
      <td colspan="3"><input type="hidden" name="txtGrandTotal" id="txtGrandTotal" value="<?php if(isset($txtGrandTotal)): echo $txtGrandTotal; endif;?>" /></td>
    </tr>
    <tr>
      <td colspan="6"><div id="tmpGridInput_pj3" style="height:300px; width:100%;"></div></td>
      </tr>
    <tr>
      <td>Barcode</td>
      <td><input type="text" name="txtBarcode" id="txtBarcode" placeHolder="Scan Barcode Disini" onkeyup="if(event.keyCode==13) { scanner_pj3(this.value);  }" />
        <input type="checkbox" name="cbShortment" id="cbShortment" />
        Shortment</td>
      <td><div align="left">Sub Total</div></td>
      <td width="224" align="left"><input name="txtjml" type="text" id="txtjml" size="3" readonly="readonly" disabled="disabled" value="<?php if(isset($txtjml)): echo $txtjml; endif; ?>" />
        <input type="text" name="txtsubtotal" id="txtsubtotal"  style="text-align:right" disabled="disabled" value="<?php if(isset($txtsubtotal)): echo $txtsubtotal; endif; ?>" /></td>
      <td width="96">Total Akhir</td>
      <td width="146"><input type="text" name="txtTotalAkhir" id="txtTotalAkhir"  style="text-align:right" disabled="disabled" value="<?php if(isset($txtTotalAkhir)): echo $txtTotalAkhir; endif; ?>" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><span id="tmpInfoBarcode_pj3" style="color:#FF0000; font-weight:bold;"></span></td>
      <td><div align="left">Potongan</div></td>
      <td align="left"><input name="txtDiscPersen" type="text" id="txtDiscPersen" size="3" onkeyup="rpDisc_pj3();" value="<?php if(isset($txtDiscPersen)): echo $txtDiscPersen; endif;?>" />
        <input type="text" name="txtDiscRupiah" id="txtDiscRupiah" style="text-align:right" onkeyup="persenDisc_pj3();" value="<?php if(isset($txtDiscRupiah)): echo $txtDiscRupiah; endif; ?>" /></td>
      <td>Titip / DP</td> 
      <td><input type="text" name="txtDp" id="txtDp"  style="text-align:right" value="<?php if(isset($txtDp)): echo $txtDp; endif; ?>" onkeyup="hitungTotal_pj3();" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td><div align="left">Pajak</div></td>
      <td align="left"><input name="txtTaxPersen" type="text" id="txtTaxPersen" size="3" onkeyup="rpTax_pj3();" value="<?php if(isset($txtTaxPersen)): echo $txtTaxPersen; endif; ?>" />
        <input type="text" name="txtTaxRupiah" id="txtTaxRupiah" style="text-align:right" disabled="disabled" value="<?php if(isset($txtTaxRupiah)): echo $txtTaxRupiah; endif; ?>" /></td>
      <td>Kekurangan</td>
      <td><input type="text" name="txtKurang" id="txtKurang"  style="text-align:right" disabled="disabled" value="<?php if(isset($txtKurang)): echo $txtKurang; endif; ?>" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td><div align="left">Biaya Lain</div></td>
      <td colspan="3"><select name="slcBiaya" id="slcBiaya" onchange="hitungTotal_pj3();">
        <option value="TAMBAH" <?php if(isset($slcBiaya) && $slcBiaya=='TAMBAH'): echo 'selected="selected"'; endif; ?>>Ditambahkan</option>
        <option value="NONTAMBAH" <?php if(isset($slcBiaya) && $slcBiaya=='NONTAMBAH'): echo 'selected="selected"'; endif; ?>>Diabaikan</option>
      </select>
  <input name="txtBiayaLain" type="text" id="txtBiayaLain" size="10" style="text-align:right" onkeyup="hitungTotal_pj3();" value="<?php if(isset($txtBiayaLain)): echo $txtBiayaLain; endif; ?>" /></td>
      </tr>
  </table>
</form>
</div>


<script language="javascript">

outlet_id = document.frm_pj3.gudang.value;
gd_win_brg.clearAll();
// tanggal expired card

cal1_pj3 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTgl"
	});
cal1_pj3.setDateFormat("%d/%m/%Y");

cal2_pj3 = new dhtmlXCalendarObject({
			input: "tglKirim",button: "btnTglKirim"
	});
cal2_pj3.setDateFormat("%d/%m/%Y");

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
});


gdInp = new dhtmlXGridObject('tmpGridInput_pj3');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jumlah,Harga,Pot (%),Pot 2,Pot 3,Pot 4,Total,&nbsp;,hrgBeli",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,30,220,0,0,70,70,80,60,60,60,60,100,30,0");
gdInp.setColAlign("left,center,left,left,left,left,center,right,center,center,center,center,right,left,left");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,edn,ron,ro,ro,ro,ro,ron,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setNumberFormat("0,000",12,",",".");
gdInp.setSkin("dhx_skyblue");
gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pj3);
gdInp.init();

function loadDataInp_pj3(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/pesanan_penjualan/loadDataBrgDetail/"+kode,function() {
		addRowInp_pj3();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

<?php 
if(!isset($kdtrans)) { 
	echo "baru_pj3();"; 
} else { 
	echo 'loadDataInp_pj3("'.$kdtrans.'");'; 
}
?>

function doOnCellEdit_pj3(stage, rowId, cellInd) {
	
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
	  subtotal_pj3();
	  rpDisc_pj3();
	  persenDisc_pj3();
	  rpTax_pj3();
	  addRowInp_pj3();
    }
    return true;
}

function subtotal_pj3() {
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
	document.frm_pj3.txtjml.value = jml;
	hitungTotal_pj3();
}

function rpDisc_pj3() {
	subtotal = $('#txtsubtotal').val();
	disc = document.frm_pj3.txtDiscPersen.value;
	if(disc != "" || disc != "0") {
		discRp = subtotal * disc/100;
		$('#txtDiscRupiah').val(discRp);
	}
	rpTax_pj3();
	hitungTotal_pj3();
}

function persenDisc_pj3() {
	subtotal = $('#txtsubtotal').val();
	disc = $('#txtDiscRupiah').val();
	if(disc != "" || disc != "0") {
		discPersen = (disc / subtotal) * 100;
		//$('#txtDiscRupiah').val(discRp);
		document.frm_pj3.txtDiscPersen.value = precise_round(discPersen,2);
	}
	rpTax_pj3();
	hitungTotal_pj3();
}

function rpTax_pj3() {
	subtotal = $('#txtsubtotal').val() - $('#txtDiscRupiah').val();
	tax = document.frm_pj3.txtTaxPersen.value;
	if(tax != "" || tax != "0") {
		txtRp = subtotal * tax/100;
		$('#txtTaxRupiah').val(txtRp);
	}
	hitungTotal_pj3();
}

function hitungTotal_pj3() {

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
	if(document.frm_pj3.slcBiaya.value=='TAMBAH') {
		grandTotal = parseInt(total) + parseInt(biaya);
	} else {
		grandTotal = total;
	}
	//document.getElementById('displayBelanja').innerHTML = format_number(grandTotal);
	//document.frm_pj3.txtGrandTotal.value = grandTotal;
	$('#txtTotalAkhir').val(grandTotal);
	dp = $('#txtDp').val();
	kurang = grandTotal - dp;
	$('#txtKurang').val(kurang);
}

function addRowInp_pj3() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; //arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','','',img_del],posisi);
			//gdInp.selectRow(posisi);
			try { gdInp.showRow(gdInp.uid()); } catch(e) {}
	}
}


function doOnEnterInp(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pj3();
	return true;
}



// Operasi Form
function simpan_pj3(tipeSimpan) {

	if(document.frm_pj3.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.frm_pj3.tgl.focus();
		return;
	}
	
	if(document.frm_pj3.pelanggan.value=="") {
		alert("Pelanggan Tidak Boleh Kosong");
		document.frm_pj3.pelanggan.focus();
		return;
	}
	
	if(document.frm_pj3.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pj3.gudang.focus();
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
			'kdtrans=' + document.frm_pj3.kdtrans.value +
			'&tgl=' + document.frm_pj3.tgl.value +
			'&pelanggan=' + document.frm_pj3.pelanggan.value +
			'&gudang=' + document.frm_pj3.gudang.value +
			'&txtjml=' + document.frm_pj3.txtjml.value +
			'&txtsubtotal=' + $('#txtsubtotal').val() + 
			'&txtDiscPersen=' + document.frm_pj3.txtDiscPersen.value +
			'&txtDiscRupiah=' + $('#txtDiscRupiah').val() +
			'&txtTaxPersen=' + document.frm_pj3.txtTaxPersen.value +
			'&txtTaxRupiah=' + $('#txtTaxRupiah').val() +
			'&slcBiaya=' + document.frm_pj3.slcBiaya.value +
			'&txtBiayaLain=' + $('#txtBiayaLain').val() +
			'&txtTotalAkhir=' +  $('#txtTotalAkhir').val() +
			'&txtDp=' +  $('#txtDp').val() +
			'&txtKurang=' +  $('#txtKurang').val() +
			'&sales=' + document.frm_pj3.sales.value +
			'&keterangan=' + document.frm_pj3.keterangan.value +
			'&tglKirim=' + document.frm_pj3.tglKirim.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,13]);
        statusLoading();   
		tb_w1_pj3.disableItem("simpan");
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pesanan_penjualan/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			
				document.frm_pj3.kdtrans.value = result;
				refreshGd_pj3();
				tb_w1_pj3.enableItem("simpan");
				tb_w1_pj3.enableItem("baru");
				addRowInp_pj3();
		
		});
}

function disabled_pj3() {
	document.frm_pj3.kdtrans.disabled = true;
	document.frm_pj3.tgl.disabled = true;
	document.frm_pj3.pelanggan.disabled = true;
	document.frm_pj3.gudang.disabled = true;
	document.frm_pj3.txtjml.disabled = true;
	document.frm_pj3.txtsubtotal.disabled = true;
	document.frm_pj3.txtDiscPersen.disabled = true;
	document.frm_pj3.txtDiscRupiah.disabled = true;
	document.frm_pj3.txtTaxPersen.disabled = true;
	document.frm_pj3.txtTaxRupiah.disabled = true;
	document.frm_pj3.slcBiaya.disabled = true;
	document.frm_pj3.txtBiayaLain.disabled = true; 
	document.frm_pj3.tglKirim.disabled = true; 
	document.frm_pj3.txtTotalAkhir.disabled = true; 
	document.frm_pj3.txtDp.disabled = true; 
	document.frm_pj3.txtKurang.disabled = true; 
	
	document.frm_pj3.sales.disabled = true;
	document.frm_pj3.keterangan.disabled = true;
	document.frm_pj3.txtBarcode.disabled = true;
	document.frm_pj3.cbShortment.disabled = true;
	document.getElementById('tmpIconCal').innerHTML = "";
}

function enabled_pj3() {
	document.frm_pj3.kdtrans.disabled = false;
	document.frm_pj3.tgl.disabled = false;
	document.frm_pj3.pelanggan.disabled = false;
	document.frm_pj3.gudang.disabled = false;
	document.frm_pj3.txtjml.disabled = false;
	document.frm_pj3.txtsubtotal.disabled = false;
	document.frm_pj3.txtDiscPersen.disabled = false;
	document.frm_pj3.txtDiscRupiah.disabled = false;
	document.frm_pj3.txtTaxPersen.disabled = false;
	document.frm_pj3.txtTaxRupiah.disabled = false;
	document.frm_pj3.slcBiaya.disabled = false;
	document.frm_pj3.txtBiayaLain.disabled = false;
	
	document.frm_pj3.tglKirim.disabled = false; 
	document.frm_pj3.txtTotalAkhir.disabled = false;
	document.frm_pj3.txtDp.disabled = false;
	document.frm_pj3.txtKurang.disabled = false;
	
	document.frm_pj3.sales.disabled = false;
	document.frm_pj3.keterangan.disabled = false;
	document.frm_pj3.txtBarcode.disabled = false;
	document.frm_pj3.cbShortment.disabled = false;
	//document.getElementById('tmpIconCal').innerHTML = '<img id="btnTgl" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" />';
}

function baru_pj3() {
	document.frm_pj3.kdtrans.value = "";
	document.frm_pj3.tgl.value = "<?php echo date('d/m/Y'); ?>";
	document.frm_pj3.pelanggan.value = "";
	document.frm_pj3.txtBarcode.value = "";
	document.frm_pj3.gudang.value = "";
	document.frm_pj3.txtjml.value = "";
	document.frm_pj3.txtsubtotal.value = "";
	document.frm_pj3.txtDiscPersen.value = "";
	document.frm_pj3.txtDiscRupiah.value = "";
	document.frm_pj3.txtTaxPersen.value = "";
	document.frm_pj3.txtTaxRupiah.value = "";
	document.frm_pj3.slcBiaya.value = "";
	document.frm_pj3.txtBiayaLain.value = "";
	
	document.frm_pj3.tglKirim.value = "";
	document.frm_pj3.txtTotalAkhir.value = "";
	document.frm_pj3.txtDp.value = "";
	document.frm_pj3.txtKurang.value = "";
	
	document.frm_pj3.sales.value = "";
	document.frm_pj3.keterangan.value = "";
	
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','','',img_del],0);
	gdInp.selectRow(0);
	enabled_pj3();
	outlet_id = "";
	tb_w1_pj3.enableItem("simpan");
	tb_w1_pj3.enableItem("baru");
}

function setDataBrgPj3(kode,nmbarang,warna,ukuran,satuan,harga,disc_1,disc_2,disc_3,disc_4,hrgBeli) {
	if(adaBarang(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		grid.cells(grid.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0").click();
		return;
	}
	nmbarang = nmbarang+" "+warna+" "+ukuran;
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	gdInp.cells(gdInp.getSelectedId(),3).setValue(warna);
	gdInp.cells(gdInp.getSelectedId(),4).setValue(ukuran);
	gdInp.cells(gdInp.getSelectedId(),5).setValue(satuan);
	gdInp.cells(gdInp.getSelectedId(),7).setValue(harga);
	gdInp.cells(gdInp.getSelectedId(),8).setValue(disc_1);
	gdInp.cells(gdInp.getSelectedId(),9).setValue(disc_2);
	gdInp.cells(gdInp.getSelectedId(),10).setValue(disc_3);
	gdInp.cells(gdInp.getSelectedId(),11).setValue(disc_4);
	gdInp.cells(gdInp.getSelectedId(),14).setValue(hrgBeli);
	index = gdInp.getRowIndex(gdInp.getSelectedId());
	gdInp.setRowId(index,kode.toUpperCase());
	document.getElementById("pilihCell4").click();
}

function scanner_pj3(barcode) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	if(barcode=="") {
		alert("Barcode Tidak Boleh Kosong");
		return;
	}
	if(document.frm_pj3.cbShortment.checked==true) {
		scanSizeRun_pj3(barcode);
	} else {
		scanBarcode_pj3(barcode);
	}
}

function scanBarcode_pj3(barcode) {
	var poststr =
		'barcode=' + barcode +
		'&outlet_id=' + document.frm_pj3.gudang.value;
	document.getElementById('tmpInfoBarcode_pj3').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcodeJual", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pj3').innerHTML = "Barcode Tidak Ditemukan";
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
		subtotal_pj3();
	 	rpDisc_pj3();
	  	persenDisc_pj3();
	  	rpTax_pj3();
		document.frm_pj3.txtBarcode.value = "";
		document.frm_pj3.txtBarcode.focus();
	});
}

function scanSizeRun_pj3(barcode) {
	var poststr =
		'sizeRun=' + barcode +
		'&outlet_id=' + document.frm_pj3.gudang.value;
	document.getElementById('tmpInfoBarcode_pj3').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRunJual", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0' || result == '') {
			document.getElementById('tmpInfoBarcode_pj3').innerHTML = "Size Run Tidak Ditemukan";
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
		subtotal_pj3();
	 	rpDisc_pj3();
	  	persenDisc_pj3();
	  	rpTax_pj3();
		document.frm_pj3.txtBarcode.value = "";
		document.frm_pj3.txtBarcode.focus();
	});
}
</script>

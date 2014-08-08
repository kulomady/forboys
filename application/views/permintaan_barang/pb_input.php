<div class="frmContainer">
<form name="frm_pd2" id="frm_pd2" method="post" action="javascript:void(0);">
  <table width="923" border="0" align="center">   
    <tr>
      <td width="108">No. Transfer</td>
      <td width="246"><input type="text" name="kdtrans" id="kdtrans" placeHolder = "[AUTO]" readonly value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>"></td>
      <td width="105">Tujuan</td>
      <td width="312"><select name="tujuan" id="tujuan" style="width:150px;" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
        <?php echo $tujuan; ?>
      </select></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" readonly value="<?php if(isset($tgl)): echo $tgl; endif;?>" />
      <span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Tanggal Terima</td>
      <td><input name="tgl2" type="text" id="tgl2" size="8" readonly value="<?php if(isset($tgl2)): echo $tgl2; endif;?>" />
        <span><img id="btnTg2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
    </tr>
    <tr>
      <td>Gudang</td>
      <td><select name="gudang" id="gudang" style="width:150px;">
        <?php echo $gudang; ?>
            </select></td>
      <td>Keterangan</td>
      <td><input type="text" name="keterangan" id="keterangan" value="<?php if(isset($keterangan)): echo $keterangan; endif;?>" /></td>
    </tr>
    
    <tr>
      <td colspan="4"><div id="tmpGridInput_pd2" style="height:400px; width:100%;"></div></td>
    </tr>
    <tr>
      <td>Barcode</td>
      <td><input type="text" name="txtBarcode" id="txtBarcode" placeHolder="Scan Barcode Disini" onkeyup="if(event.keyCode==13) { scanner_pd2(this.value);  }" />
        <input type="checkbox" name="cbShortment" id="cbShortment" />
        Shortment        &nbsp; <span id="tmpInfoBarcode_pd2" style="color:#FF0000; font-weight:bold;"></span></td>
      <td colspan="2" rowspan="2"><div align="right"></div></td>
      </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      </tr>
  </table>
</form>
</div>
<script language="javascript">
// tanggal expired card
outlet_id = document.frm_pd2.tujuan.value;
gd_win_brg.clearAll();

// tanggal expired card
cal1_pd2 = new dhtmlXCalendarObject({
		input: "tgl",button: "btnTg"
	});
cal1_pd2.setDateFormat("%d/%m/%Y");

cal2_pd2 = new dhtmlXCalendarObject({
		input: "tgl2",button: "btnTg2"
	});
cal2_pd2.setDateFormat("%d/%m/%Y");

gdInp = new dhtmlXGridObject('tmpGridInput_pd2');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jml Pesan,Jml Terima,#Pcs,Harga,Total,&nbsp;,HrgBeli",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,30,180,110,60,60,60,70,60,90,80,30,0");
gdInp.setColAlign("left,center,left,left,left,left,center,center,center,right,right,left,right");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,edn,ron,edn,ron,ron,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setNumberFormat("0,000",8,",",".");
gdInp.setNumberFormat("0,000",9,",",".");
gdInp.setNumberFormat("0,000",10,",",".");
gdInp.setSkin("dhx_skyblue");
gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pd2);
gdInp.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center id=tmpQty_pd2>{#stat_total}</div>,<div style=text-align:center id=tmpTerima_pd2>{#stat_total}</div>,<div style=text-align:center id=tmpPcs_pd2>{#stat_total}</div>,&nbsp;,<div style=text-align:right id=tmpTotal_pd2>{#stat_total}</div>,&nbsp;,&nbsp;");
gdInp.init();

<?php if(!isset($kdtrans)) { echo "baru_pd2();"; } else { echo 'loadDataInp_pd2("'.$kdtrans.'")'; }?>

function loadDataInp_pd2(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/permintaan_barang/loadChild/"+kode,function() {
		addRowInp_pd2();
		gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

function doOnCellEdit_pd2(stage, rowId, cellInd) {
	
    if (stage == 2) {
	 if(cellInd == 6 || cellInd == 8) {
		harga = gdInp.cells(rowId,9).getValue();
		jml = gdInp.cells(rowId,6).getValue();
		total = harga * jml;
        gdInp.cells(rowId,10).setValue(total);
		hitungTotal_pd2();
		addRowInp_pd2();
	  }
    }
    return true;
}

function addRowInp_pd2() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','',img_del,''],posisi);
			//gdInp.selectRow(posisi);
			gdInp.showRow(gdInp.uid());
	}
}


function doOnEnterInp(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pd2();
	return true;
}



// Operasi Form
function simpan_pd2() {

	// hapus row terakhir yang kosong
	delRowInp();
	
	if(cekKosong(10)==1) {
		alert("Total salah satu barang tidak boleh kosong");
		return;
	}
	
	satu = getData(gdInp,[1,2,3,4,5,11]);
	alert(satu);
	
	// Proses Simpan
 	var poststr =
			'kdtrans=' + document.frm_pd2.kdtrans.value +
            '&tgl=' + document.frm_pd2.tgl.value +
			'&outlet_id='+ document.frm_pd2.gudang.value +
			'&tujuan=' + document.frm_pd2.tujuan.value +
			'&tgl2=' + document.frm_pd2.tgl2.value +
			'&keterangan=' + document.frm_pd2.keterangan.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,11]);
			tb_w1_pd2.disableItem("save");
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/permintaan_barang/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			tb_w1_pd2.enableItem("save");
			tb_w1_pd2.enableItem("baru");
			document.frm_pd2.kdtrans.value = result;
			refreshGd_pd2();
			addRowInp_pd2();
		});
}

function baru_pd2() {
	document.frm_pd2.kdtrans.value = "";
	document.frm_pd2.tgl.value = "";
	document.frm_pd2.tujuan.value = "";
	document.frm_pd2.tgl2.value = "";
	document.frm_pd2.keterangan.value = "";
	outlet_id = "";
	document.frm_pd2.tujuan.disabled = false;
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','',img_del,''],0);
	gdInp.selectRow(0);
}

function hitungTotal_pd2() {
		jQty = 0; jTerima = 0; jTotal = 0; jPcs = 0;
		gdInp.forEachRow(function(id){
			if(gdInp.cells(id,6).getValue() != "") {
				jQty = jQty + parseInt(gdInp.cells(id,6).getValue());
			}
			if(gdInp.cells(id,7).getValue() != "") {
				jTerima = jTerima + parseInt(gdInp.cells(id,7).getValue());
			}
			if(gdInp.cells(id,8).getValue() != "") {
				jPcs = jQty + parseInt(gdInp.cells(id,8).getValue());
			}
			if(gdInp.cells(id,10).getValue() != "") {
				jTotal = jTotal + parseInt(gdInp.cells(id,10).getValue());
			}
		});
		document.getElementById("tmpQty_pd2").innerHTML = format_number(jQty);
		document.getElementById("tmpTerima_pd2").innerHTML = format_number(jTerima);
		document.getElementById("tmpPcs_pd2").innerHTML = format_number(jPcs);
		document.getElementById("tmpTotal_pd2").innerHTML = format_number(jTotal);
}

function scanner_pd2(barcode) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	if(barcode=="") {
		alert("Barcode Tidak Boleh Kosong");
		return;
	}
	if(document.frm_pd2.cbShortment.checked==true) {
		scanSizeRun_pd2(barcode);
	} else {
		scanBarcode_pd2(barcode);
	}
}

function scanBarcode_pd2(barcode) {
	var poststr =
		'barcode=' + barcode +
		'&outlet_id=' + document.frm_pd2.gudang.value;
	document.getElementById('tmpInfoBarcode_pd2').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcode", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pd2').innerHTML = "Barcode Tidak Ditemukan";
		} else {
			arrBrg = result.split('|');
			if(adaBarang(arrBrg[0]) == 0) {				
				posisi = gdInp.getRowsNum() - 1;
				total = arrBrg[5] * 1;
				// arrBrg[0]->idbarang.'|'.arrBrg[1]->nmbarang.'|'.arrBrg[2]->nmwarna.'|'.arrBrg[3]->nmsize.'|'.arrBrg[4]->nmsatuan.'|'.arrBrg[5]->harga.'|'.arrBrg[6]->harga_beli;
				gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],'1','',arrBrg[5],total,img_del,arrBrg[6]],posisi);
				gdInp.selectRow(posisi);
				gdInp.showRow(arrBrg[0]);
			} else {
				jmlSkrg = parseInt(gdInp.cells(arrBrg[0],6).getValue()) + 1;
				totalSkrg = parseInt(gdInp.cells(arrBrg[0],10).getValue()) + parseInt(arrBrg[5]);
				gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
				gdInp.cells(arrBrg[0],10).setValue(totalSkrg);
				
			}
		}
		hitungTotal_pd2();
		document.frm_pd2.txtBarcode.value = "";
		document.frm_pd2.txtBarcode.focus();
	});
}

function scanSizeRun_pd2(barcode) {
	var poststr =
		'sizeRun=' + barcode +
		'&outlet_id=' + document.frm_pd2.gudang.value;
	document.getElementById('tmpInfoBarcode_pd2').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRun", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pd2').innerHTML = "Size Run Tidak Ditemukan";
		} else {
			arrSizeRun = result.split("~");
			for(i=0;arrSizeRun.length;i++) {
				if(arrSizeRun[i] != "0" && arrSizeRun[i] != "") {
					arrBrg = arrSizeRun[i].split('|');
					if(adaBarang(arrBrg[0]) == 0) {				
						posisi = gdInp.getRowsNum() - 1;
						total = arrBrg[7] * arrBrg[5];
						// arrBrg[0]->idbarang.'|'.arrBrg[1]->nmbarang.'|'.arrBrg[2]->nmwarna.'|'.arrBrg[3]->nmsize.'|'.arrBrg[4]->nmsatuan.'|'.arrBrg[5]->harga.'|'.arrBrg[6]->harga_beli;
						gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],'',arrBrg[7],total,img_del,arrBrg[6]],posisi);
						gdInp.selectRow(posisi);
						gdInp.showRow(arrBrg[0]);
					} else {
						jmlSkrg = parseInt(gdInp.cells(arrBrg[0],6).getValue()) + parseInt(arrBrg[5]);
						total = arrBrg[7] * arrBrg[5];
						totalSkrg = parseInt(gdInp.cells(arrBrg[0],9).getValue()) + parseInt(total);
						gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
						gdInp.cells(arrBrg[0],9).setValue(totalSkrg);
					}
				}
			}
		}
		hitungTotal_pd2();
		document.frm_pd2.txtBarcode.value = "";
		document.frm_pd2.txtBarcode.focus();
	});
}
</script>
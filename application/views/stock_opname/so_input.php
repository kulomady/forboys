<div class="frmContainer">
<form name="frm_pd5" id="frm_pd5" method="post" action="javascript:void(0);">
  <table width="773" border="0" align="center">
    
    <tr>
      <td width="127">No. Transaksi</td>
      <td width="208"><input type="text" name="kdtrans" id="kdtrans" placeHolder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>" disabled="disabled"></td>
      <td width="103">Gudang</td>
      <td width="317"><select name="gudang" id="gudang" style="width:150px;" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
        <?php echo $gudang; ?>
      </select></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)): echo $tgl; endif;?>" />
      <span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Keterangan</td>
      <td><input type="text" name="keterangan" id="keterangan" value="<?php if(isset($keterangan)): echo $keterangan; endif;?>" /></td>
    </tr>
    
    <tr>
      <td colspan="4"><div id="tmpGridInput_pd5" style="height:400px; width:100%;"></div></td>
      </tr>
    <tr>
      <td>Barcode</td>
      <td colspan="3"><input type="text" name="txtBarcode" id="txtBarcode" placeholder="Scan Barcode Disini" onkeyup="if(event.keyCode==13) { scanner_pd5(this.value);  }" />
        <input type="checkbox" name="cbShortment" id="cbShortment" />
Shortment        &nbsp; <span id="tmpInfoBarcode_pd5" style="color:#FF0000; font-weight:bold;"></span></td>
      </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
outlet_id = document.frm_pd5.gudang.value;
gd_win_brg.clearAll();
// tanggal expired card
cal1_pd5 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTg"
	});
cal1_pd5.setDateFormat("%d/%m/%Y");

gdInp = new dhtmlXGridObject('tmpGridInput_pd5');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Stock Fisik,#Pcs,&nbsp;,hrgBeli,hrgJual",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,30,180,120,70,80,75,0,30,0,0");
gdInp.setColAlign("left,center,left,left,left,left,right,right,left,left,left");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,edn,edn,ro,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setSkin("dhx_skyblue");
gdInp.attachEvent("onEnter", doOnEnterInp_pd5);
gdInp.attachEvent("onEditCell", doOnCellEdit_pd5);
gdInp.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center id=tmpQty_pd5>{#stat_total}</div>,<div style=text-align:center id=tmpPcs_pd5>{#stat_total}</div>,&nbsp;,&nbsp;,&nbsp;");
gdInp.init();

<?php if(!isset($kdtrans)) { echo "baru_pd5();"; } else { echo 'loadDataInp_pd5("'.$kdtrans.'")'; }?>

function loadDataInp_pd5(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/stock_opname/loadDataBrgDetail/"+kode,function() {
		addRowInp_pd5();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}


function addRowInp_pd5() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; //arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','',img_del,'',''],posisi);
			gdInp.selectRow(posisi);
			//gdInp.showRow(gdInp.uid());
	}
}

function doOnCellEdit_pd5(stage, rowId, cellInd) {
	  if(stage == 2) {
	  		if(cellInd == 6 || cellInd == 7) {
				hitungTotal_pd5();
				 addRowInp_pd5();		
			}	
	  }
	  return true;
}

function doOnEnterInp_pd5(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pd5();
	return true;
}



// Operasi Form
function simpan_pd5() {
	
	if(document.frm_pd5.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.frm_pd5.tgl.focus();
		return;
	}
	if(document.frm_pd5.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pd5.gudang.focus();
		return;
	}
	// hapus row terakhir yang kosong
	delRowInp();
	
	if(cekKosong(6)==1) {
		alert("Total salah satu barang tidak boleh kosong");
		return;
	}
	
	// Proses Simpan
 	var poststr =
			'kdtrans=' + document.frm_pd5.kdtrans.value +
            '&tgl=' + document.frm_pd5.tgl.value +
			'&outlet_id=' + document.frm_pd5.gudang.value +
			'&keterangan=' + document.frm_pd5.keterangan.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,8]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/stock_opname/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.frm_pd5.kdtrans.value = result;
			statusEnding();
			refreshGd_pd5();
			tb_w1_pd5.disableItem("save");
			tb_w1_pd5.enableItem("baru");
		});
}

function baru_pd5() {
	document.frm_pd5.kdtrans.value = "";
	document.frm_pd5.tgl.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_pd5.gudang.value = "";
	document.frm_pd5.keterangan.value = "";
	document.frm_pd5.txtBarcode.value = "";
	
	document.frm_pd5.gudang.disabled = false;
	
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','',img_del,'',''],0);
	gdInp.selectRow(0);
}

function setDataBrgPd5(kode,nmbarang,warna,ukuran,satuan,hrgBeli,hrgJual) {
	if(adaBarang(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		gdInp.cells(grid.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0").click();
		return;
	}
	nmbarang = nmbarang+" "+warna+" "+ukuran;
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	gdInp.cells(gdInp.getSelectedId(),3).setValue(warna);
	gdInp.cells(gdInp.getSelectedId(),4).setValue(ukuran);
	gdInp.cells(gdInp.getSelectedId(),5).setValue(satuan);
	gdInp.cells(gdInp.getSelectedId(),9).setValue(hrgBeli);
	gdInp.cells(gdInp.getSelectedId(),10).setValue(hrgBeli);
	index = gdInp.getRowIndex(gdInp.getSelectedId());
	gdInp.setRowId(index,kode.toUpperCase());
	document.getElementById("pilihCell4").click();
}

function scanner_pd5(barcode) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	if(barcode=="") {
		alert("Barcode Tidak Boleh Kosong");
		return;
	}
	if(document.frm_pd5.cbShortment.checked==true) {
		scanSizeRun_pd5(barcode);
	} else {
		scanBarcode_pd5(barcode);
	}
}

function scanBarcode_pd5(barcode) {
	var poststr =
		'barcode=' + barcode +
		'&outlet_id=' + document.frm_pd5.gudang.value;
	document.getElementById('tmpInfoBarcode_pd5').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcode", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pd5').innerHTML = "Barcode Tidak Ditemukan";
		} else {
			arrBrg = result.split('|');
			if(adaBarang(arrBrg[0]) == 0) {				
				posisi = gdInp.getRowsNum() - 1;
				// arrBrg[0]->idbarang.'|'.arrBrg[1]->nmbarang.'|'.arrBrg[2]->nmwarna.'|'.arrBrg[3]->nmsize.'|'.arrBrg[4]->nmsatuan.'|'.arrBrg[5]->harga.'|'.arrBrg[6]->harga_beli;
				gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],'1','',img_del,arrBrg[6],arrBrg[5]],posisi);
				gdInp.selectRow(posisi);
				gdInp.showRow(arrBrg[0]);
			} else {
				if(gdInp.cells(arrBrg[0],6).getValue()=="") {
					qtyInp = 0;
				} else {
					qtyInp = gdInp.cells(arrBrg[0],6).getValue();
				}
				jmlSkrg = parseInt(qtyInp) + 1;
				gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);				
			}
		}
		hitungTotal_pd5();
		document.frm_pd5.txtBarcode.value = "";
		document.frm_pd5.txtBarcode.focus();
	});
}

function scanSizeRun_pd5(barcode) {
	var poststr =
		'sizeRun=' + barcode +
		'&outlet_id=' + document.frm_pd5.gudang.value;
	document.getElementById('tmpInfoBarcode_pd5').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRun", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pd5').innerHTML = "Size Run Tidak Ditemukan";
		} else {
			arrSizeRun = result.split("~");
			for(i=0;arrSizeRun.length;i++) {
				if(arrSizeRun[i] != "0" && arrSizeRun[i] != "") {
					arrBrg = arrSizeRun[i].split('|');
					if(adaBarang(arrBrg[0]) == 0) {				
						posisi = gdInp.getRowsNum() - 1;
						// arrBrg[0]->idbarang.'|'.arrBrg[1]->nmbarang.'|'.arrBrg[2]->nmwarna.'|'.arrBrg[3]->nmsize.'|'.arrBrg[4]->nmsatuan.'|'.arrBrg[5]->harga.'|'.arrBrg[6]->harga_beli;
						gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],'',img_del,arrBrg[7],arrBrg[6]],posisi);
						gdInp.selectRow(posisi);
						gdInp.showRow(arrBrg[0]);
					} else {
						if(gdInp.cells(arrBrg[0],6).getValue()=="") {
							qtyInp = 0;
						} else {
							qtyInp = gdInp.cells(arrBrg[0],6).getValue();
						}
						jmlSkrg = parseInt(qtyInp) + parseInt(arrBrg[5]);
						gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
					}
				}
			}
		}
		hitungTotal_pd5();
		document.frm_pd5.txtBarcode.value = "";
		document.frm_pd5.txtBarcode.focus();
	});
}

function hitungTotal_pd5() {
		jQty = 0; jPcs = 0;
		gdInp.forEachRow(function(id){
			if(gdInp.cells(id,6).getValue() != "") {
				jQty = jQty + parseInt(gdInp.cells(id,6).getValue());
			}
			if(gdInp.cells(id,7).getValue() != "") {
				jPcs = jQty + parseInt(gdInp.cells(id,7).getValue());
			}
		});
		document.getElementById("tmpQty_pd5").innerHTML = format_number(jQty);
		document.getElementById("tmpPcs_pd5").innerHTML = format_number(jPcs);
}
</script>

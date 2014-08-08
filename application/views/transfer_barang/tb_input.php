<div class="frmContainer">
<form name="frm_pd3" id="frm_pd3" method="post" action="javascript:void(0);">
  <table width="923" border="0" align="center">
    
    <tr>
      <td width="108">No. Transfer</td>
      <td width="246"><input type="text" name="kdtrans" id="kdtrans" placeHolder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>" disabled="disabled"></td>
      <td width="105">Supir</td>
      <td width="312"><input type="text" name="supir" id="supir" value="<?php if(isset($supir)): echo $supir; endif;?>" maxlength="25" /></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)): echo $tgl; endif;?>" />
      <span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>No. Polisi</td>
      <td><input type="text" name="nopol" id="nopol" value="<?php if(isset($nopol)): echo $nopol; endif;?>" /></td>
    </tr>
    <tr>
      <td>Gudang</td>
      <td><select name="gudang" id="gudang" style="width:150px;">
        <?php echo $gudang; ?>
            </select></td>
      <td>Keterangan</td>
      <td><input type="text" name="keterangan" id="keterangan" value="<?php if(isset($keterangan)): echo $keterangan; endif;?>" maxlength="50" /></td>
    </tr>
    <tr>
      <td>Tujuan</td>
      <td><select name="tujuan" id="tujuan" style="width:150px;" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
       <?php echo $tujuan; ?>
            </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="4"><div id="tmpGridInput_pd3" style="height:380px; width:100%;"></div></td>
      </tr>
    <tr>
      <td><span id="tmpBarcode">Barcode</span></td>
      <td><span id="tmpInpBarcode"><input type="text" name="txtBarcode" id="txtBarcode" placeHolder="Scan Barcode Disini" onkeyup="if(event.keyCode==13) { scanner_pd3(this.value);  }" />
        <input type="checkbox" name="cbShortment" id="cbShortment" />
        Shortment        &nbsp;</span> <span id="tmpInfoBarcode_pd3" style="color:#FF0000; font-weight:bold;"></span></td>
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
<?php if($setBarcode==0): ?>
document.getElementById("tmpBarcode").style.display = "none";
document.getElementById("tmpInpBarcode").style.display = "none";
<?php endif;?>

// tanggal expired card
outlet_id = document.frm_pd3.tujuan.value;
gd_win_brg.clearAll();

// tanggal expired card
cal1_pd3 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTg"
	});
cal1_pd3.setDateFormat("%d/%m/%Y");

gdInp = new dhtmlXGridObject('tmpGridInput_pd3');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jumlah,#Pcs,Harga,Total,&nbsp;,HrgBeli,ost,ostTrm,ostJmlTrm",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,30,180,120,60,70,60,60,100,100,30,0,0,0,0");
gdInp.setColAlign("left,center,left,left,left,left,center,center,right,right,left,right,right,right,right");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,edn,edn,ron,ron,ro,ro,ro,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setNumberFormat("0,000",8,",",".");
gdInp.setNumberFormat("0,000",9,",",".");
gdInp.setSkin("dhx_skyblue");
gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pd3);
gdInp.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center id=tmpQty_pd3>{#stat_total}</div>,<div style=text-align:center id=tmpPcs_pd3>{#stat_total}</div>,&nbsp;,<div style=text-align:right id=tmpTotal_pd3>{#stat_total}</div>,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
gdInp.init();

<?php if($kolomPcs==0): ?>
	gdInp.setColumnHidden(7,true);
	<?php endif; ?>

<?php if(!isset($kdtrans)) { echo "baru_pd3();"; } else { echo 'loadDataInp_pd3("'.$kdtrans.'")'; }?>

function loadDataInp_pd3(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/transfer_barang/loadDataBrgDetail/"+kode,function() {
		addRowInp_pd3();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

function doOnCellEdit_pd3(stage, rowId, cellInd) {
	
    if (stage == 2) {
	 if(cellInd == 6 || cellInd == 7) {
		harga = gdInp.cells(rowId,8).getValue();
		pcs = gdInp.cells(rowId,7).getValue();
		if(pcs=="" || pcs=="0") {
			jml = gdInp.cells(rowId,6).getValue();
		} else {
			jml = gdInp.cells(rowId,6).getValue() * pcs;	
		}
		outstanding = jml;
		ostTrm = jml * -1;
		gdInp.cells(rowId,12).setValue(outstanding);
		gdInp.cells(rowId,13).setValue(ostTrm);
		total = harga * jml;
		ostJmlTrm = total * -1;
		gdInp.cells(rowId,14).setValue(ostJmlTrm);
        gdInp.cells(rowId,9).setValue(total);
		hitungTotal_pd3();
		addRowInp_pd3();
	  }
    }
    return true;
}

function addRowInp_pd3() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; // arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','',img_del,'','','',''],posisi);
			//gdInp.selectRow(posisi);
			try { gdInp.showRow(gdInp.uid()); } catch(e) {}
	}
}


function doOnEnterInp(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pd3();
	return true;
}



// Operasi Form
function simpan_pd3() {
	if(document.frm_pd3.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.frm_pd3.tgl.focus();
		return;
	}
	if(document.frm_pd3.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pd3.gudang.focus();
		return;
	}
	if(document.frm_pd3.tujuan.value=="") {
		alert("Tujuan Tidak Boleh Kosong");
		document.frm_pd3.tujuan.focus();
		return;
	}
	// hapus row terakhir yang kosong
	delRowInp();
	
	if(cekKosong(9)==1) {
		alert("Total salah satu barang tidak boleh kosong");
		return;
	}
	
	// Proses Simpan
 	var poststr =
			'kdtrans=' + document.frm_pd3.kdtrans.value +
            '&tgl=' + document.frm_pd3.tgl.value +
			'&outlet_id='+ document.frm_pd3.gudang.value +
			'&tujuan=' + document.frm_pd3.tujuan.value +
			'&supir=' + document.frm_pd3.supir.value +
			'&nopol=' + document.frm_pd3.nopol.value +
			'&keterangan=' + document.frm_pd3.keterangan.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,10]);
			tb_w1_pd3.disableItem("save");
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/transfer_barang/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			tb_w1_pd3.enableItem("save");
			tb_w1_pd3.enableItem("baru");
			tb_w1_pd3.enableItem("cetak");
			document.frm_pd3.kdtrans.value = result;
			refreshGd_pd3();
			addRowInp_pd3();
		});
}

function baru_pd3() {
	document.frm_pd3.kdtrans.value = "";
	document.frm_pd3.tgl.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_pd3.tujuan.value = "";
	document.frm_pd3.supir.value = "";
	document.frm_pd3.nopol.value = "";
	document.frm_pd3.keterangan.value = "";
	outlet_id = "";
	document.frm_pd3.tujuan.disabled = false;
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','',img_del,'','','',''],0);
	gdInp.selectRow(0);
}

function hitungTotal_pd3() {
		jQty = 0; jTotal = 0; jPcs = 0;
		gdInp.forEachRow(function(id){
			if(gdInp.cells(id,6).getValue() != "") {
				jQty = jQty + parseInt(gdInp.cells(id,6).getValue());
			}
			if(gdInp.cells(id,7).getValue() != "") {
				jPcs = jQty + parseInt(gdInp.cells(id,7).getValue());
			}
			if(gdInp.cells(id,9).getValue() != "") {
				jTotal = jTotal + parseInt(gdInp.cells(id,9).getValue());
			}
		});
		document.getElementById("tmpQty_pd3").innerHTML = format_number(jQty);
		document.getElementById("tmpPcs_pd3").innerHTML = format_number(jPcs);
		document.getElementById("tmpTotal_pd3").innerHTML = format_number(jTotal);
}

function scanner_pd3(barcode) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	if(barcode=="") {
		alert("Barcode Tidak Boleh Kosong");
		return;
	}
	if(document.frm_pd3.cbShortment.checked==true) {
		scanSizeRun_pd3(barcode);
	} else {
		scanBarcode_pd3(barcode);
	}
}

function scanBarcode_pd3(barcode) {
	var poststr =
		'barcode=' + barcode +
		'&outlet_id=' + document.frm_pd3.gudang.value;
	document.getElementById('tmpInfoBarcode_pd3').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcode", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pd3').innerHTML = "Barcode Tidak Ditemukan";
		} else {
			arrBrg = result.split('|');
			if(adaBarang(arrBrg[0]) == 0) {				
				posisi = gdInp.getRowsNum() - 1;
				total = arrBrg[5] * 1;
				outstanding = arrBrg[5];
				ostTrm = outstanding * -1;
				// arrBrg[0]->idbarang.'|'.arrBrg[1]->nmbarang.'|'.arrBrg[2]->nmwarna.'|'.arrBrg[3]->nmsize.'|'.arrBrg[4]->nmsatuan.'|'.arrBrg[5]->harga.'|'.arrBrg[6]->harga_beli;
				gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],'1','',arrBrg[5],total,img_del,arrBrg[6],outstanding,ostTrm],posisi);
				gdInp.selectRow(posisi);
				gdInp.showRow(arrBrg[0]);
			} else {
				if(gdInp.cells(arrBrg[0],6).getValue()=="") {
					qtyInp = 0;
				} else {
					qtyInp = gdInp.cells(arrBrg[0],6).getValue();
				}
				jmlSkrg = parseInt(qtyInp) + 1;
				totalSkrg = parseInt(gdInp.cells(arrBrg[0],9).getValue()) + parseInt(arrBrg[5]);
				outstanding = jmlSkrg;
				ostTrm = outstanding * -1;
				gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
				gdInp.cells(arrBrg[0],9).setValue(totalSkrg);
				gdInp.cells(arrBrg[0],12).setValue(outstanding);
				gdInp.cells(arrBrg[0],13).setValue(ostTrm);
				
			}
		}
		hitungTotal_pd3();
		document.frm_pd3.txtBarcode.value = "";
		document.frm_pd3.txtBarcode.focus();
	});
}

function scanSizeRun_pd3(barcode) {
	var poststr =
		'sizeRun=' + barcode +
		'&outlet_id=' + document.frm_pd3.gudang.value;
	document.getElementById('tmpInfoBarcode_pd3').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRun", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pd3').innerHTML = "Size Run Tidak Ditemukan";
		} else {
			arrSizeRun = result.split("~");
			for(i=0;arrSizeRun.length;i++) {
				if(arrSizeRun[i] != "0" && arrSizeRun[i] != "") {
					arrBrg = arrSizeRun[i].split('|');
					if(adaBarang(arrBrg[0]) == 0) {				
						posisi = gdInp.getRowsNum() - 1;
						total = arrBrg[6] * arrBrg[5];
						outstanding = arrBrg[5]; // * -1;
						ostTrm = outstanding * -1;
						// arrBrg[0]->idbarang.'|'.arrBrg[1]->nmbarang.'|'.arrBrg[2]->nmwarna.'|'.arrBrg[3]->nmsize.'|'.arrBrg[4]->nmsatuan.'|'.arrBrg[5]->harga.'|'.arrBrg[6]->harga_beli;
						gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],'',arrBrg[6],total,img_del,arrBrg[7],outstanding,ostTrm],posisi);
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
						outstanding = jmlSkrg; // * -1;
						ostTrm = outstanding * -1;
						totalSkrg = parseInt(gdInp.cells(arrBrg[0],9).getValue()) + parseInt(total);
						gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
						gdInp.cells(arrBrg[0],9).setValue(totalSkrg);
						gdInp.cells(arrBrg[0],12).setValue(outstanding);
						gdInp.cells(arrBrg[0],13).setValue(ostTrm);
					}
				}
			}
		}
		hitungTotal_pd3();
		document.frm_pd3.txtBarcode.value = "";
		document.frm_pd3.txtBarcode.focus();
	});
}
</script>

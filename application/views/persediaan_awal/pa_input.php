<div class="frmContainer">
<form name="frm_pd1" id="frm_pd1" method="post" action="javascript:void(0);">
  <table width="918" border="0" align="center">
    <tr>
      <td>Periode</td>
      <td><input name="txtPeriode" type="text" id="txtPeriode" value="<?php if(isset($periode)): echo $periode; endif;?>" readonly="readonly" /></td>
      <td>Keterangan</td>
      <td colspan="2"><span style="color:#FF0000;">
        <input type="text" name="txtKet" id="txtKet" value="<?php if(isset($keterangan)): echo $keterangan; endif;?>" />
      </span></td>
      </tr>
    <tr>
      <td width="97">Gudang</td>
      <td width="253"><select name="slcOutlet_id" id="slcOutlet_id" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
        <?php echo $gudang; ?>
      </select>
        <input type="hidden" name="kdtrans" id="kdtrans" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>" /></td>
      <td width="97">Kode Akun</td>
      <td width="116"><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
        <img name="btnakun_pd1" id="btnakun_pd1" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pd1();" /></td>
      <td width="333" id="tmpNmPerkiraan_pd1" style="color:#FF0000;"><?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?></td>
      </tr>
    <tr>
      <td colspan="5"><div id="tmpGridInput_pd1" style="height:370px;width: 100%"></div></td>
      </tr>
    <tr>
      <td colspan="5"><span style="display:none;"><a href="javascript:selectCel_input_pd1(4)" id="pilihCell4_pd1">selectCell</a><a href="javascript:selectCel_input_pd1(0)" id="pilihCell0_pd1">selectCell</a></span></td>
      </tr>
    <tr>
      <td><span id="tmpBarcode">Barcode</span></td>
      <td colspan="4"><span id="tmpInpBarcode"><input type="text" name="txtBarcode" id="txtBarcode" placeHolder="Scan Barcode Disini" onkeyup="if(event.keyCode==13) { scanner_pd1(this.value);  }" />
        <input type="checkbox" name="cbShortment" id="cbShortment" />
        Shortment        &nbsp;</span><span id="tmpInfoBarcode_pd1" style="color:#FF0000; font-weight:bold;"></span></td>
      </tr>
  </table>
</form>
</div>

<div id="tmpCommand_pd1" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; padding-left:10px; padding-right:10px; display:none;">
<form action="<?php echo base_url(); ?>index.php/persediaan_awal/importData" method="post" enctype="multipart/form-data" name="frmUpload_pd1" id="frmUpload_pd1" target="tmpImport_pd1">  
   <table width="466" border="0">
     <tr>
       <td width="256"><input type="file" name="userfile" id="userfile" /></td>
       <td width="200"><input type="submit" name="button5" id="button8" value="UPLOAD" />
        <input type="hidden" name="outlet_id" id="outlet_id" /></td>
     </tr>
   </table>
   <iframe id="tmpImport_pd1" name="tmpImport_pd1" width="500" height="350" style=" border:1px solid #999; background-color:#666;"></iframe>
   <a href="<?php echo base_url(); ?>assets/import_stock_awal.xls" target="_blank"><br />
   Download Format Excel</a>
  <p><input name="code" type="hidden" value="" />
</p>
</form>
</div>
<script language="javascript">

<?php if($setBarcode==0): ?>
document.getElementById("tmpBarcode").style.display = "none";
document.getElementById("tmpInpBarcode").style.display = "none";
<?php endif;?>

// tanggal expired card
outlet_id = document.frm_pd1.slcOutlet_id.value;
gd_win_brg.clearAll();

cal1_pd1 = new dhtmlXCalendarObject({
			input: "txtTglBerlaku",button: "btnTglBerlaku_pd1"
	});
cal1_pd1.setDateFormat("%d/%m/%Y");

// Grid Barang Detail

gdInp = new dhtmlXGridObject('tmpGridInput_pd1');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jumlah,#PCS,Harga,Total,&nbsp;,hrgJual",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,30,180,120,60,70,60,60,100,100,30,0");
gdInp.setColAlign("left,center,left,left,left,left,right,right,right,right,left,left");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,edn,edn,edn,ron,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setNumberFormat("0,000",8,",",".");
gdInp.setNumberFormat("0,000",9,",",".");
gdInp.setSkin("dhx_skyblue");
gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pd1);
gdInp.attachEvent("onKeyPress", function(code,cFlag,sFlag){
	//document.frm_pd1.txtBarcode.value = code;
	return hanyaAngka(code, false);
});
gdInp.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center id=tmpQty_pd1>{#stat_total}</div>,<div style=text-align:center id=tmpPcs_pd1>{#stat_total}</div>,&nbsp;,<div style=text-align:right id=tmpTotal_pd1>{#stat_total}</div>,&nbsp;");
gdInp.init();

<?php if($kolomPcs==0): ?>
	gdInp.setColumnHidden(7,true);
	<?php endif; ?>

<?php if(!isset($kdtrans)) { echo "baru_pd1();"; } else { echo 'loadDataInp_pd1("'.$kdtrans.'")'; }?>

function loadDataInp_pd1(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/persediaan_awal/loadDataBrgDetail/"+kode,function() {
		addRowInp_pd1();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

function hanyaAngka(e, decimal) { 
		var key;
		var keychar;
		 if (window.event) {
			 key = window.event.keyCode;
		 } else
		 if (e) {
			 key = e.which;
		 } else return true;
		
		keychar = String.fromCharCode(key);
		if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
			return true;
		} else 
		if ((("0123456789").indexOf(keychar) > -1)) {
			return true; 
		} else 
		if (decimal && (keychar == ".")) {
			return true; 
		} else return false; 
    }

function doOnCellEdit_pd1(stage, rowId, cellInd) {
	
    if (stage == 2) {
	 if(cellInd == 6 || cellInd == 8 || cellInd == 7) {
		harga = gdInp.cells(rowId,6).getValue();
		pcs = gdInp.cells(rowId,7).getValue();
		if(pcs=="" || pcs==0) {
			jml = gdInp.cells(rowId,8).getValue();
		} else {
			jml = gdInp.cells(rowId,8).getValue() * pcs;	
		}
		total = harga * jml;
        gdInp.cells(rowId,9).setValue(total);
		addRowInp_pd1();
		hitungTotal_pd1();
	  }
    }
    return true;
}

function addRowInp_pd1() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; //arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','',img_del],posisi);
			gdInp.selectRow(posisi);
			//gdInp.showRow(gdInp.uid());
	}
}

function hitungTotal_pd1() {
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
		document.getElementById("tmpQty_pd1").innerHTML = format_number(jQty);
		document.getElementById("tmpPcs_pd1").innerHTML = format_number(jPcs);
		document.getElementById("tmpTotal_pd1").innerHTML = format_number(jTotal);
}

function doOnEnterInp(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pd1();
	return true;
}



// Operasi Form
function simpan_pd1() {

	if(document.frm_pd1.slcOutlet_id.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pd1.slcOutlet_id.focus();
		return;
	}
	
	if(document.frm_pd1.kdakun.value=="") {
		alert("Kode Akun Tidak Boleh Kosong");
		document.frm_pd1.kdakun.focus();
		return;
	}
	
	// hapus row terakhir yang kosong
	delRowInp();
	
	if(cekKosong(9)==1) {
		alert("Total salah satu barang tidak boleh kosong");
		return;
	}
	
	// Proses Simpan
	tb_w1_pd1.disableItem("save");
 	var poststr =
			'kdtrans=' + document.frm_pd1.kdtrans.value +
            '&txtPeriode=' + document.frm_pd1.txtPeriode.value +
			'&txtKet=' + document.frm_pd1.txtKet.value +
			'&slcOutlet_id=' + document.frm_pd1.slcOutlet_id.value +
			'&kdakun=' + document.frm_pd1.kdakun.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,10]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/persediaan_awal/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			tb_w1_pd1.enableItem("save");
			tb_w1_pd1.enableItem("baru");
			statusEnding();
			if(result=='ADA') {
				alert("Persediaan Awal untuk Periode dan Gudang ini Sudah Ada");
				return;
			}
			document.frm_pd1.kdtrans.value = result;
			refreshGd_pd1();
			addRowInp_pd1();
		});
}

function baru_pd1() {
	document.frm_pd1.txtKet.value = "";
	document.frm_pd1.slcOutlet_id.value = "";
	outlet_id = "";
	document.frm_pd1.kdakun.value = "";
	document.frm_pd1.kdtrans.value = "";
	document.getElementById("tmpNmPerkiraan_pd1").innerHTML = "";
	document.frm_pd1.slcOutlet_id.disabled = false;
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','',img_del],0);
	gdInp.selectRow(0);
}


function winAkun_pd1() {
	try {
		if(w2_pd1.isHidden()==true) {
			w2_pd1.show();
			document.getElementById('frmSearchAkun_pd1').focus();
		}
		w2_pd1.bringToTop();
		return;
	} catch(e) {}
	w2_pd1 = dhxWins.createWindow("w2_pd1",0,0,430,450);
	w2_pd1.setText("Daftar Perkiraan");
	w2_pd1.button("park").hide();
	w2_pd1.button("minmax1").hide();
	w2_pd1.center();
	
	tb_w2_pd1 = w2_pd1.attachToolbar();
	tb_w2_pd1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w2_pd1.setSkin("dhx_terrace");
	tb_w2_pd1.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w2_pd1.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahAkun_pd1(13);
		}
	});
	
	w2_pd1.attachURL(base_url+"index.php/persediaan_awal/frm_search_akun", true);
}

function scanner_pd1(barcode) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	if(barcode=="") {
		alert("Barcode Tidak Boleh Kosong");
		return;
	}
	if(document.frm_pd1.cbShortment.checked==true) {
		scanSizeRun_pd1(barcode);
	} else {
		scanBarcode_pd1(barcode);
	}
}

function scanBarcode_pd1(barcode) {
	var poststr =
		'barcode=' + barcode +
		'&outlet_id=' + document.frm_pd1.slcOutlet_id.value;
	document.getElementById('tmpInfoBarcode_pd1').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcode", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			document.getElementById('tmpInfoBarcode_pd1').innerHTML = "Barcode Tidak Ditemukan";
		} else {
			arrBrg = result.split('|');
			if(adaBarang(arrBrg[0]) == 0) {				
				posisi = gdInp.getRowsNum() - 1;
				total = arrBrg[6] * 1;
				gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],'1','',arrBrg[6],total,img_del,arrBrg[5]],posisi);
				gdInp.selectRow(posisi);
				gdInp.showRow(arrBrg[0]);
			} else {
				if(gdInp.cells(arrBrg[0],6).getValue()=="") {
					qtyInp = 0;
				} else {
					qtyInp = gdInp.cells(arrBrg[0],6).getValue();
				}
				jmlSkrg = parseInt(qtyInp) + 1;
				totalSkrg = parseInt(gdInp.cells(arrBrg[0],9).getValue()) + parseInt(arrBrg[6]);
				gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
				gdInp.cells(arrBrg[0],9).setValue(totalSkrg);
				
			}
		}
		hitungTotal_pd1();
		document.frm_pd1.txtBarcode.value = "";
		document.frm_pd1.txtBarcode.focus();
	});
}

function scanSizeRun_pd1(barcode) {
	var poststr =
		'sizeRun=' + barcode +
		'&outlet_id=' + document.frm_pd1.slcOutlet_id.value;
	document.getElementById('tmpInfoBarcode_pd1').innerHTML = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRun", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '') {
			document.getElementById('tmpInfoBarcode_pd1').innerHTML = "Size Run Tidak Ditemukan";
		} else {
			arrSizeRun = result.split("~");
			for(i=0;i<arrSizeRun.length;i++) {
				if(arrSizeRun[i] != "0" && arrSizeRun[i] != "") {
					arrBrg = arrSizeRun[i].split('|');
					if(adaBarang(arrBrg[0]) == 0) {				
						posisi = gdInp.getRowsNum() - 1;
						total = arrBrg[7] * arrBrg[5];
						gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],'',arrBrg[7],total,img_del,arrBrg[6]],posisi);
						gdInp.selectRow(posisi);
						gdInp.showRow(arrBrg[0]);
					} else {
						if(gdInp.cells(arrBrg[0],6).getValue()=="") {
							qtyInp = 0;
						} else {
							qtyInp = gdInp.cells(arrBrg[0],6).getValue();
						}
						jmlSkrg = parseInt(qtyInp) + parseInt(arrBrg[5]);
						total = arrBrg[7] * arrBrg[5];
						totalSkrg = parseInt(gdInp.cells(arrBrg[0],9).getValue()) + parseInt(total);
						gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
						gdInp.cells(arrBrg[0],9).setValue(totalSkrg);
					}
				}
			}
		}
		hitungTotal_pd1();
		document.frm_pd1.txtBarcode.value = "";
		document.frm_pd1.txtBarcode.focus();
	});
}

function setDataBrgPd1(kode,nmbarang,warna,ukuran,satuan,hrgBeli,hrgJual) {
	if(adaBarang(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		grid.cells(grid.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0").click();
		return;
	}
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	gdInp.cells(gdInp.getSelectedId(),3).setValue(warna);
	gdInp.cells(gdInp.getSelectedId(),4).setValue(ukuran);
	gdInp.cells(gdInp.getSelectedId(),5).setValue(satuan);
	gdInp.cells(gdInp.getSelectedId(),8).setValue(hrgBeli);
	gdInp.cells(gdInp.getSelectedId(),11).setValue(hrgJual);
	index = gdInp.getRowIndex(gdInp.getSelectedId());
	gdInp.setRowId(index,kode.toUpperCase());
	document.getElementById("pilihCell4").click();
}

// Window Command
wCom_pd1 = dhxWins.createWindow("wCom_pd1",0,0,540,450);
wCom_pd1.setText("Upload");
wCom_pd1.button("park").hide();
//wCom_md3.button("close").hide();
wCom_pd1.button("minmax1").hide();
wCom_pd1.button("close").attachEvent("onClick", function() {
		wCom_pd1.hide();
		wCom_pd1.setModal(false);
		return;
    });
wCom_pd1.hide();

function showWinCom_pd1() {
	if(outlet_id == '') {
		alert("Pilih Gudang Terlebih Dahulu");
		return;
	}
	wCom_pd1.show();
    wCom_pd1.setModal(true);
	wCom_pd1.bringToTop();
	wCom_pd1.center();
	document.frmUpload_pd1.outlet_id.value = outlet_id;
	wCom_pd1.attachObject('tmpCommand_pd1');
}

function actionUpload_pd1(data) {
	arrBaris = data.split("~");
	jml = arrBaris.length - 1;
	for(i=0;i<jml;i++) {
		arrBrg = arrBaris[i].split("|");
		if(adaBarang(arrBrg[0]) == 0) {				
				posisi = gdInp.getRowsNum() - 1;
				total = arrBrg[5] * arrBrg[7];
				gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],arrBrg[6],arrBrg[7],total,img_del,arrBrg[8]],posisi);
				gdInp.selectRow(posisi);
				gdInp.showRow(arrBrg[0]);
			} else {
				if(gdInp.cells(arrBrg[0],6).getValue()=="") {
					qtyInp = 0;
				} else {
					qtyInp = gdInp.cells(arrBrg[0],6).getValue();
				}
				jmlSkrg = parseInt(qtyInp) + parseInt(arrBrg[5]);
				total = arrBrg[5] * arrBrg[7];
				totalSkrg = parseInt(gdInp.cells(arrBrg[0],9).getValue()) + parseInt(total);
				gdInp.cells(arrBrg[0],6).setValue(jmlSkrg);
				gdInp.cells(arrBrg[0],9).setValue(totalSkrg);
				
			}
	}
	document.frmUpload_pd1.userfile.value = "";
}
</script>

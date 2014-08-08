<div class="frmContainer">
<form name="frm_pd4" id="frm_pd4" method="post" action="javascript:void(0);">
  <table width="865" border="0" align="center">
    
    <tr>
      <td width="129">No. Terima</td>
      <td width="293"><input type="text" name="kdtrans" id="kdtrans" placeHolder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>"></td>
      <td width="125">No. Transfer</td>
      <td width="300"><input type="text" name="notrans" id="notrans" readonly="readonly" value="<?php if(isset($notrans)): echo $notrans; endif;?>" />&nbsp;<img name="btnakun_pd4" id="btnakun_pd4" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pd4();" /></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)) { echo $tgl; } else { echo "d/m/Y"; }?>" />
      <span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Supir</td>
      <td><input type="text" name="supir" id="supir" disabled="disabled" value="<?php if(isset($supir)): echo $supir; endif;?>" /></td>
    </tr>
    <tr>
      <td>Gudang Asal</td>
      <td><select name="gudang" id="gudang" style="width:150px;" disabled="disabled">
        <?php echo $gudang; ?>
            </select></td>
      <td>No. Polisi</td>
      <td><input type="text" name="nopol" id="nopol" disabled="disabled" value="<?php if(isset($nopol)): echo $nopol; endif;?>" /></td>
    </tr>
    <tr>
      <td>Tujuan</td>
      <td><select name="tujuan" id="tujuan" style="width:150px;" disabled="disabled">
       <?php echo $tujuan; ?>
            </select></td>
      <td>Keterangan</td>
      <td><input type="text" name="keterangan" id="keterangan" value="<?php if(isset($keterangan)): echo $keterangan; endif;?>" /></td>
    </tr>
    
    <tr>
      <td colspan="4"><div id="tmpGridInput_pd4" style="height:400px; width:100%;"></div></td>
      </tr>
    <tr>
      <td style="display:none;">Barcode</td>
      <td style="display:none;"><input type="text" name="barcode" id="barcode" placeHolder="Scan Barcode Disini" /></td>
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
cal1_pd4 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTg"
	});
cal1_pd4.setDateFormat("%d/%m/%Y");

function baru_pd4() {
	document.frm_pd4.kdtrans.value = "";
	document.frm_pd4.tgl.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_pd4.notrans.value = "";
	document.frm_pd4.gudang.value = "";
	document.frm_pd4.tujuan.value = "";
	document.frm_pd4.supir.value = "";
	document.frm_pd4.nopol.value = "";
	document.frm_pd4.keterangan.value = "";
	
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','',img_del,''],0);
	gdInp.selectRow(0);
}
var outlet_id = document.frm_pd4.gudang.value;

	function winAkun_pd4() {
		try {
			if(w2_pd4.isHidden()==true) {
				w2_pd4.show();
				document.getElementById('frmSearchAkun').focus();
			}
			w2_pd4.bringToTop();
			return;
		} catch(e) {}
		w2_pd4 = dhxWins.createWindow("w2_pd4",0,0,430,450);
		w2_pd4.setText("Daftar Transfer Barang");
		w2_pd4.button("park").hide();
		w2_pd4.button("minmax1").hide();
		w2_pd4.center();
		
		tb_w2_pd4 = w2_pd4.attachToolbar();
		tb_w2_pd4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pd4.setSkin("dhx_terrace");
		tb_w2_pd4.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pd4.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahTransfer(13);
			}
		});
		
		w2_pd4.attachURL(base_url+"index.php/penerimaan_barang/frm_search_transfer", true);
	}

gdInp = new dhtmlXGridObject('tmpGridInput_pd4');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Warna,Ukuran,Satuan,Jml Kirim,Jml Terima,#PCS,Harga,HrgBeli,Total,&nbsp;,ost,jmlOst",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("80,0,180,80,70,65,65,65,65,60,0,100,0,0,0");
gdInp.setColAlign("left,center,left,left,left,left,right,right,left,right,right,right,left,left,left");
gdInp.setColTypes("ed,ro,ro,ro,ro,ro,ron,edn,edn,ron,ro,ron,ron,ro,ro,ro");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setNumberFormat("0,000",7,",",".");
gdInp.setNumberFormat("0,000",8,",",".");
gdInp.setNumberFormat("0,000",9,",",".");
gdInp.setNumberFormat("0,000",10,",",".");
gdInp.setNumberFormat("0,000",11,",",".");
gdInp.setSkin("dhx_skyblue");
//gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pd4);
gdInp.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,&nbsp;,&nbsp;,<div style=text-align:right>{#stat_total}</div>,&nbsp;,&nbsp;,&nbsp;");
gdInp.init();

<?php if($kolomPcs==0): ?>
	gdInp.setColumnHidden(8,true);
<?php endif; ?>

<?php if(!isset($kdtrans)) { echo "baru_pd4();"; } else { echo 'loadDataInp_pd4("'.$kdtrans.'")'; }?>

function loadDataInp_pd4(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/penerimaan_barang/loadDataBrgDetail/"+kode,function() {
		addRowInp_pd4();
		gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

function loadDataTransInp_pd4(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/penerimaan_barang/loadDataBrgTrans/"+kode,function() {
		addRowInp_pd4();
		gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

function doOnCellEdit_pd4(stage, rowId, cellInd) {
	
    if (stage == 2) {
	 if(cellInd == 7 || cellInd == 8) {
		harga = gdInp.cells(rowId,9).getValue();
		jml = gdInp.cells(rowId,7).getValue();
		if(gdInp.cells(rowId,8).getValue() != "" && gdInp.cells(rowId,8).getValue() != "0") {
			jml = gdInp.cells(rowId,7).getValue() * gdInp.cells(rowId,8).getValue();		
		}
		total = harga * jml;
		outstanding = jml * -1;
        gdInp.cells(rowId,11).setValue(total);
		gdInp.cells(rowId,13).setValue(outstanding);
		jmlOst = total * -1;
		gdInp.cells(rowId,14).setValue(jmlOst);
		//addRowInp_pd4();
	  }
    }
    return true;
}

function addRowInp_pd4() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','','','',img_del,''],posisi);
			gdInp.selectRow(posisi);
			//gdInp.showRow(gdInp.uid());
	}
}


function doOnEnterInp(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang();
	}
	addRowInp_pd4();
	return true;
}



// Operasi Form
function simpan_pd4() {
	
	if(document.frm_pd4.notrans.value == "") {
		alert("No Transfer Tidak Boleh Kosong");
		document.frm_pd4.notrans.focus();
		return;
	}
	// hapus row terakhir yang kosong
	delRowInp();
	
	if(cekKosong(11)==1) {
		alert("Total salah satu barang tidak boleh kosong");
		return;
	}
	
	// Proses Simpan
 	var poststr =
			'kdtrans=' + document.frm_pd4.kdtrans.value +
            '&tgl=' + document.frm_pd4.tgl.value +
			'&notrans=' + document.frm_pd4.notrans.value +
			'&outlet_id=' + document.frm_pd4.gudang.value +
			'&tujuan=' + document.frm_pd4.tujuan.value +
			'&supir=' + document.frm_pd4.supir.value +
			'&nopol=' + document.frm_pd4.nopol.value +
			'&keterangan=' + document.frm_pd4.keterangan.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,4,5,12]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/penerimaan_barang/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.frm_pd4.kdtrans.value = result;
			statusEnding();
			refreshGd_pd4();
			tb_w1_pd4.disableItem("save");
			tb_w1_pd4.enableItem("baru");
		});
}
</script>

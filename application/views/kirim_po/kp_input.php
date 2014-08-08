<div class="frmContainer">
<form name="frm_pr6" id="frm_pr6" method="post" action="javascript:void(0);">
  <table width="663" border="0" align="center">
    <tr>
      <td width="119">No. Kirim</td>
      <td width="208"><input type="text" name="kdtrans" id="kdtrans" placeholder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>" />
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
      <td width="151">CMT</td>
      <td width="167"><select name="cmt" id="cmt" disabled="disabled" style="width:140px;">
        <?php if(isset($cmt)): echo $cmt; endif; ?>
      </select></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)) { echo $tgl; } else { echo date("d/m/Y"); }?>" />
        <span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Dikirim dengan</td>
      <td><input type="text" name="dikirim_dgn" id="dikirim_dgn" value="<?php if(isset($dikirim_dgn)): echo $dikirim_dgn; endif;?>" /></td>
      </tr>
    <tr>
      <td>Dari Cabang</td>
      <td><select name="dari" id="dari" onchange="loadCMT(this.value);" style="width:140px;">
        <?php echo $dari; ?>
      </select></td>
      <td>No. Polisi</td>
      <td><input type="text" name="nopol" id="nopol" value="<?php if(isset($no_pol)): echo $no_pol; endif;?>" /></td>
    </tr>
    <tr>
      <td>Jenis Kirim</td>
      <td><select name="jnskirim" id="jnskirim" onchange="jnsKirim(this.value);">
        <option value="CABANG" <?php if(isset($jns_kirim) && $jns_kirim == 'CABANG'): echo 'selected="selected"'; endif; ?>>CABANG</option>
        <option value="CMT" <?php if(isset($jns_kirim) && $jns_kirim == 'CMT'): echo 'selected="selected"'; endif; ?>>CMT</option>
      </select></td>
      <td>Supir</td>
      <td><input type="text" name="supir" id="supir" value="<?php if(isset($supir)): echo $supir; endif;?>" /></td>
    </tr>
    <tr>
      <td>Cabang Tujuan</td>
      <td><select name="tujuan" id="tujuan" onchange="loadCMT(this.value);" style="width:140px;">
        <?php echo $tujuan; ?>
      </select></td>
      <td>Keterangan</td>
      <td><input type="text" name="keterangan" id="keterangan" value="<?php if(isset($keterangan)): echo $keterangan; endif;?>" /></td>
    </tr>
    <tr>
      <td colspan="4"><div id="tmpGridInput_pr6" style="height:300px; width:100%;"></div></td>
      </tr>
  </table>
</form>
</div>
<div id="tmpSearchBrg_pr6" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
	<table width="409" border="0">
  <tr>
    <td width="117">Cari Nama Barang</td>
    <td width="284"><input type="text" name="frmSearchBrg_pr6" id="frmSearchBrg_pr6" onKeyDown="tandaPanahBrg_pr6(event.keyCode);" tabindex="10">
      <input type="button" name="btnSaring" id="btnSaring" value="Muat Ulang" onclick="muatUlangBarang_pr6();" tabindex="11" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBarang_pr6" style="width:405px; height:365px;"/>&nbsp;<br />&nbsp;</td>
  </tr>
</table>
</div>
<script language="javascript">
img_link_pr6 = '<img id="btnTglBerlaku_pr6" src="<?php echo base_url(); ?>assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_po(0);" />';

cal1_pr6 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTg"
	});
cal1_pr6.setDateFormat("%d/%m/%Y");

function jnsKirim(jns) {
	if(jns=='CABANG') {
		document.frm_pr6.cmt.disabled = true;
		document.getElementById("cmt").innerHTML = "";
	} else {
		document.frm_pr6.cmt.disabled = false;
		loadCMT(document.frm_pr6.tujuan.value);
	}
}

function loadCMT(cabang) {
	if(document.frm_pr6.jnskirim.value == 'CABANG') {
		return;	
	}
	var poststr =
            'cabang=' + cabang;
	document.getElementById("cmt").innerHTML = "Silahkan Tunggu..";   
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_po/dataCMT", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		document.getElementById("cmt").innerHTML = result;
	});
}
	
function simpan_pr6() {
    if(document.frm_pr6.tgl.value=="") {
		alert("Tanggal tidak boleh kosong");
		document.frm_pr6.tgl.focus();
		return;
	}
	
	/* if(document.frm_pr6.po.value=="") {
		alert("PO tidak boleh kosong");
		document.frm_pr6.po.focus();
		return;
	} */
	
	if(document.frm_pr6.tujuan.value=="") {
		alert("Tujuan tidak boleh kosong");
		document.frm_pr6.tujuan.focus();
		return;
	}
	
	if(document.frm_pr6.jnskirim.value == 'CABANG' && document.frm_pr6.cmt.value=="") {
		alert("CMT tidak boleh kosong");
		document.frm_pr6.cmt.focus();
		return;
	}
	
	// hapus row terakhir yang kosong
	delRowInp();
	
	if(cekKosong(4)==1) {
		alert("Total salah satu barang tidak boleh kosong");
		return;
	}
 	var poststr =
            'kdtrans=' + document.frm_pr6.kdtrans.value +
			'&tgl=' + document.frm_pr6.tgl.value +
			'&dari=' + document.frm_pr6.dari.value +
			'&jnsKirim=' + document.frm_pr6.jnskirim.value +
			'&tujuan=' + document.frm_pr6.tujuan.value +
			'&cmt=' + document.frm_pr6.cmt.value +
			'&dikirim_dgn=' + document.frm_pr6.dikirim_dgn.value +
			'&nopol=' + document.frm_pr6.nopol.value +
			'&supir=' + document.frm_pr6.supir.value +
			'&keterangan=' + document.frm_pr6.keterangan.value +
			'&dataPO=' + getData(gdInp,[1,6]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_po/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.frm_pr6.kdtrans.value = result;
			statusEnding();
			refreshGd_pr6();
			tb_w1_pr6.disableItem("save");
			tb_w1_pr6.enableItem("baru");
		});
}

function baru_pr6() {
	document.frm_pr6.kdtrans.value = "";
	document.frm_pr6.tgl.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_pr6.jnskirim.value = "";
	//document.frm_pr6.po.value = "";
	document.frm_pr6.tujuan.value = "";
	document.frm_pr6.cmt.value = "";
	document.frm_pr6.dikirim_dgn.value = "";
	document.frm_pr6.nopol.value = "";
	document.frm_pr6.supir.value = "";
	document.frm_pr6.keterangan.value = "";
	//document.frm_pr6.jmlLusin.value = "";
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link_pr6,'','','','',img_del],0);
	gdInp.selectRow(0);
}

gdInp = new dhtmlXGridObject('tmpGridInput_pr6');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama Barang,Harga,Lusin,Keterangan,&nbsp;",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("50,30,170,80,80,200,30");
gdInp.setColAlign("left,center,left,right,center,left,center");
gdInp.setColTypes("ed,ro,txt,edn,edn,ed,ro");
gdInp.setNumberFormat("0,000",3,",",".");
gdInp.setNumberFormat("0,000",4,",",".");
gdInp.setSkin("dhx_skyblue");
//gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pr6);
gdInp.attachFooter("Jumlah,#cspan,#cspan,#cspan,<div style=text-align:center id=tmpQty_pd3>{#stat_total}</div>,&nbsp;,&nbsp;");
gdInp.init();

<?php if(isset($jns_kirim) && $jns_kirim == 'CMT'): ?>
document.frm_pr6.cmt.disabled = false;
<?php endif; ?>
if(document.frm_pr6.kdtrans.value == "") {
	baru_pr6();
} else {
	loadDataInp_pr6(document.frm_pr6.kdtrans.value);	
}
//document.frm_pr6.kdbank.focus();

function loadDataInp_pr6(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/kirim_po/loadDataBrgDetail/"+kode,function() {
		addRowInp_pr6();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

function doOnCellEdit_pr6(stage,rowId,cellInd) {
	
    if (stage == 2) {
	 if(cellInd == 3 || cellInd == 4 || cellInd == 5) {
		addRowInp_pr6();
	  }
    }
    return true;
}

function addRowInp_pr6() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; //arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link_pr6,'','','','',img_del],posisi);
			//gdInp.selectRow(posisi);
			gdInp.showRow(gdInp.uid());
	}
}

// Window Cari Barang

var w4_pr6 = dhxWins.createWindow("w4_pr6",0,0,430,450);
w4_pr6.setText("Daftar Project");
w4_pr6.button("park").hide();
w4_pr6.button("minmax1").hide();
w4_pr6.button("close").hide();
w4_pr6.center();
w4_pr6.hideHeader();
w4_pr6.hide();

tb_w4_pr6 = w4_pr6.attachToolbar();
tb_w4_pr6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w4_pr6.setSkin("dhx_terrace");
tb_w4_pr6.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_w4_pr6.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_w4_pr6.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahBrg_pr6(13);
	} else if(id=='tutup') {
			w4_pr6.hide();
	}
});

gd_w4_pr6 = new dhtmlXGridObject('gridBarang_pr6');
gd_w4_pr6.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_pr6.setHeader("Kode #,Project Order",null,["text-align:center","text-align:center"]);
gd_w4_pr6.setInitWidths("80,220");
gd_w4_pr6.setColAlign("left,left");
gd_w4_pr6.setColSorting("str,str");
gd_w4_pr6.setColTypes("ro,ro");
gd_w4_pr6.enableSmartRendering(true,50);
gd_w4_pr6.makeSearch("frmSearchBrg_pr6",1);
gd_w4_pr6.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBrg_pr6(13);
});  
gd_w4_pr6.setSkin("dhx_skyblue");
gd_w4_pr6.init();

function show_win_po() {
	w4_pr6.bringToTop();
	w4_pr6.show();
	w4_pr6.center();
	w4_pr6.attachObject('tmpSearchBrg_pr6');
	gd_w4_pr6.clearAll();
	gd_w4_pr6.loadXML(base_url+"index.php/kirim_po/dataPO",function() {
		document.getElementById('frmSearchBrg_pr6').focus();
	});	
}

function setDataBrg_pr6(kode,nmbarang) {
	if(adaBarang_pr6(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		gdInp.cells(gdInp.getSelectedId(),0).setValue('');
		//document.getElementById("pilihCell0_md41").click();
		return;
	}
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	//document.getElementById("pilihCell4_md41").click();
}

function tandaPanahBrg_pr6(key) {
	if(key==13) {
		idbarang = gd_w4_pr6.cells(gd_w4_pr6.getSelectedId(),0).getValue();
		nmbarang = gd_w4_pr6.cells(gd_w4_pr6.getSelectedId(),1).getValue();
		setDataBrg_pr6(idbarang,nmbarang);
		w4_pr6.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_pr6,'frmSearchBrg_pr6');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_pr6,'frmSearchBrg_pr6');
	}
	if(key==27) {
		w4_pr6.hide();
	}
	return;
}

function adaBarang_pr6(kode) {
	ada = 0;
	gdInp.forEachRow(function(id){
		if(gdInp.cells(id,0).getValue()==kode && gdInp.cells(id,1).getValue()!="") {
			ada = 1;
			return ada;
		}
	});
	return ada;
}
</script>

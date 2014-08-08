<div class="frmContainer">
<form name="frm_pr7" id="frm_pr7" method="post" action="javascript:void(0);">
  <table width="680" border="0" align="center">
    <tr>
      <td width="101">No. Kirim</td>
      <td width="243"><input type="text" name="kdtrans" id="kdtrans" placeholder = "[AUTO]" readonly="readonly" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>" />
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
      <td width="118">Terima Dari</td>
      <td width="200"><select name="jnskirim" id="jnskirim" onchange="jnsKirim(this.value);">
        <option value="CABANG" <?php if(isset($jns_kirim) && $jns_kirim == 'CABANG'): echo 'selected="selected"'; endif; ?>>CABANG</option>
        <option value="CMT" <?php if(isset($jns_kirim) && $jns_kirim == 'CMT'): echo 'selected="selected"'; endif; ?>>CMT</option>
      </select></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="tgl" type="text" id="tgl" size="8" value="<?php if(isset($tgl)) { echo $tgl; } else { echo date("d/m/Y"); }?>" />
        <span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Dari Cabang</td>
      <td><select name="tujuan" id="tujuan" onchange="loadCMT(this.value);" style="width:140px;">
        <?php echo $tujuan; ?>
      </select></td>
      </tr>
    <tr>
      <td>Untuk Cabang</td>
      <td><select name="dari" id="dari" onchange="loadCMT(this.value);" style="width:140px;">
        <?php echo $dari; ?>
      </select></td>
      <td>Dari CMT</td>
      <td><select name="cmt" id="cmt" disabled="disabled" style="width:140px;">
        <?php if(isset($cmt)): echo $cmt; endif; ?>
      </select></td>
    </tr>
    <tr>
      <td colspan="4"><div id="tmpGridInput_pr7" style="height:300px; width:100%;"></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div>
<div id="tmpSearchBrg_pr7" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
	<table width="409" border="0">
  <tr>
    <td width="117">Cari Nama Barang</td>
    <td width="284"><input type="text" name="frmSearchBrg_pr7" id="frmSearchBrg_pr7" onKeyDown="tandaPanahBrg_pr7(event.keyCode);" tabindex="10">
      <input type="button" name="btnSaring" id="btnSaring" value="Muat Ulang" onclick="muatUlangBarang_pr7();" tabindex="11" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBarang_pr7" style="width:405px; height:365px;"/>&nbsp;<br />&nbsp;</td>
  </tr>
</table>
</div>
<script language="javascript">

img_link_pr7 = '<img id="btnTglBerlaku_pr7" src="<?php echo base_url(); ?>assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_po_pr7(0);" />';

cal1_pr7 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTg"
	});
cal1_pr7.setDateFormat("%d/%m/%Y");

gdInp = new dhtmlXGridObject('tmpGridInput_pr7');
gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp.setHeader("Kode,#cspan,Nama PO,Jml PCS,Rusak,Jml Brg,tb,Keterangan,&nbsp;",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp.setInitWidths("50,30,150,70,70,70,0,180,30");
gdInp.setColAlign("left,center,left,center,center,center,right,left,center");
gdInp.setColTypes("ed,ro,ro,edn,edn,ron,edn,txt,ro");
gdInp.setNumberFormat("0,000",3,",",".");
gdInp.setNumberFormat("0,000",4,",",".");
gdInp.setNumberFormat("0,000",5,",",".");
gdInp.setNumberFormat("0,000",6,",",".");
gdInp.setSkin("dhx_skyblue");
//gdInp.attachEvent("onEnter", doOnEnterInp);
gdInp.attachEvent("onEditCell", doOnCellEdit_pr7);
gdInp.attachFooter("Jumlah,#cspan,#cspan,<div style=text-align:center id=tmpQty_pd3>{#stat_total}</div>,<div style=text-align:center id=tmpQty_pd3>{#stat_total}</div>,<div style=text-align:center id=tmpQty_pd3>{#stat_total}</div>,<div style=text-align:center id=tmpQty_pd3>{#stat_total}</div>,&nbsp;,&nbsp;");
gdInp.init();

function jnsKirim(jns) {
	if(jns=='CABANG') {
		document.frm_pr7.cmt.disabled = true;
		document.getElementById("cmt").innerHTML = "";
	} else {
		document.frm_pr7.cmt.disabled = false;
		loadCMT(document.frm_pr7.tujuan.value);
	}
}

function loadCMT(cabang) {
	if(document.frm_pr7.jnskirim.value == 'CABANG') {
		return;	
	}
	var poststr =
            'cabang=' + cabang;
	document.getElementById("cmt").innerHTML = "Silahkan Tunggu..";   
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/terima_po/dataCMT", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		document.getElementById("cmt").innerHTML = result;
	});
}
	
function simpan_pr7() {
    if(document.frm_pr7.tgl.value=="") {
		alert("Tanggal tidak boleh kosong");
		document.frm_pr7.tgl.focus();
		return;
	}
	
	/* if(document.frm_pr7.po.value=="") {
		alert("PO tidak boleh kosong");
		document.frm_pr7.po.focus();
		return;
	} */
	
	if(document.frm_pr7.tujuan.value=="") {
		alert("Tujuan tidak boleh kosong");
		document.frm_pr7.tujuan.focus();
		return;
	}
	
	if(document.frm_pr7.jnskirim.value == 'CMT' && document.frm_pr7.cmt.value=="") {
		alert("CMT tidak boleh kosong");
		document.frm_pr7.cmt.focus();
		return;
	}
	
	/* if(document.frm_pr7.jmlLusin.value=="") {
		alert("Jumlah lusin tidak boleh kosong");
		document.frm_pr7.jmlLusin.focus();
		return;
	} */
	delRowInp();
	
	if(cekKosong(5)==1) {
		alert("Jml Brg salah satu PO tidak boleh kosong");
		return;
	}
	/* if(cekKosong(6)==1) {
		alert("Total biaya salah satu PO tidak boleh kosong");
		return;
	} */
 	var poststr =
            'kdtrans=' + document.frm_pr7.kdtrans.value +
			'&tgl=' + document.frm_pr7.tgl.value +
			'&jnsKirim=' + document.frm_pr7.jnskirim.value +
			'&dari=' + document.frm_pr7.dari.value +
			'&tujuan=' + document.frm_pr7.tujuan.value +
			'&cmt=' + document.frm_pr7.cmt.value +
			'&dataPO=' + getData(gdInp,[1,2,8]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/terima_po/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.frm_pr7.kdtrans.value = result;
			statusEnding();
			refreshGd_pr7();
			tb_w1_pr7.disableItem("save");
			tb_w1_pr7.enableItem("baru");
		});
}

function baru_pr7() {
	document.frm_pr7.kdtrans.value = "";
	document.frm_pr7.tgl.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_pr7.dari.value = "";
	document.frm_pr7.tujuan.value = "";
	document.frm_pr7.cmt.value = "";
	document.frm_pr7.jnskirim.value = "";
	
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link_pr7,'','','','','','',img_del],0);
	gdInp.selectRow(0);
}

<?php if(isset($jns_kirim) && $jns_kirim == 'CMT'): ?>
document.frm_pr7.cmt.disabled = false;
<?php endif; ?>
if(document.frm_pr7.kdtrans.value == "") {
	baru_pr7();
} else {
	loadDataInp_pr7(document.frm_pr7.kdtrans.value);	
}

function loadDataInp_pr7(kode) {
	gdInp.clearAll();
	gdInp.loadXML(base_url+"index.php/terima_po/loadDataBrgDetail/"+kode,function() {
		addRowInp_pr7();
		//gdInp.selectRow(gdInp.getRowsNum() - 1);
	});
}

function doOnCellEdit_pr7(stage,rowId,cellInd) {
	
    if (stage == 2) {
	 if(cellInd == 3 || cellInd == 4) {
		jmlPcs = 0;
		jmlRusak = 0;
		if(gdInp.cells(rowId,3).getValue() != "") {
			jmlPcs 	= gdInp.cells(rowId,3).getValue();
		}
		if(gdInp.cells(rowId,4).getValue() != "") {
			jmlRusak 	= gdInp.cells(rowId,4).getValue();
		}
		jmlBrg = parseInt(jmlPcs) + parseInt(jmlRusak);
		gdInp.cells(rowId,5).setValue(jmlBrg);
	  }
	  if(cellInd == 7) {
	  	addRowInp_pr7();
	  }
    }
    return true;
}

function addRowInp_pr7() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1]; //arrId[0];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang != "") {
			posisi = gdInp.getRowsNum();
			gdInp.addRow(gdInp.uid(),['',img_link_pr7,'','','','','','',img_del],posisi);
			gdInp.selectRow(posisi);
			//gdInp.showRow(gdInp.uid());
	}
}
// Window Cari Barang

var w4_pr7 = dhxWins.createWindow("w4_pr7",0,0,430,450);
w4_pr7.setText("Daftar Project");
w4_pr7.button("park").hide();
w4_pr7.button("minmax1").hide();
w4_pr7.button("close").hide();
w4_pr7.center();
w4_pr7.hideHeader();
w4_pr7.hide();

tb_w4_pr7 = w4_pr7.attachToolbar();
tb_w4_pr7.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w4_pr7.setSkin("dhx_terrace");
tb_w4_pr7.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_w4_pr7.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_w4_pr7.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahBrg_pr7(13);
	} else if(id=='tutup') {
			w4_pr7.hide();
	}
});

gd_w4_pr7 = new dhtmlXGridObject('gridBarang_pr7');
gd_w4_pr7.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_pr7.setHeader("Kode #,Project Order",null,["text-align:center","text-align:center"]);
gd_w4_pr7.setInitWidths("80,220");
gd_w4_pr7.setColAlign("left,left");
gd_w4_pr7.setColSorting("str,str");
gd_w4_pr7.setColTypes("ro,ro");
gd_w4_pr7.enableSmartRendering(true,50);
gd_w4_pr7.makeSearch("frmSearchBrg_pr7",1);
gd_w4_pr7.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBrg_pr7(13);
});  
gd_w4_pr7.setSkin("dhx_skyblue");
gd_w4_pr7.init();

function show_win_po_pr7() {
	w4_pr7.bringToTop();
	w4_pr7.show();
	w4_pr7.center();
	w4_pr7.attachObject('tmpSearchBrg_pr7');
	gd_w4_pr7.clearAll();
	gd_w4_pr7.loadXML(base_url+"index.php/kirim_po/dataPO",function() {
		document.getElementById('frmSearchBrg_pr7').focus();
	});	
}

function setDataBrg_pr7(kode,nmbarang) {
	if(adaBarang_pr7(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		gdInp.cells(gdInp.getSelectedId(),0).setValue('');
		//document.getElementById("pilihCell0_md41").click();
		return;
	}
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	//document.getElementById("pilihCell4_md41").click();
}

function tandaPanahBrg_pr7(key) {
	if(key==13) {
		idbarang = gd_w4_pr7.cells(gd_w4_pr7.getSelectedId(),0).getValue();
		nmbarang = gd_w4_pr7.cells(gd_w4_pr7.getSelectedId(),1).getValue();
		setDataBrg_pr7(idbarang,nmbarang);
		w4_pr7.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_pr7,'frmSearchBrg_pr7');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_pr7,'frmSearchBrg_pr7');
	}
	if(key==27) {
		w4_pr7.hide();
	}
	return;
}

function adaBarang_pr7(kode) {
	ada = 0;
	gdInp.forEachRow(function(id){
		if(gdInp.cells(id,0).getValue()==kode && gdInp.cells(id,1).getValue()!="") {
			ada = 1;
			return ada;
		}
	});
	return ada;
}

//document.frm_pr7.kdbank.focus();
</script>

<div class="frmContainer">
<form name="frm_pr1" id="frm_pr1" method="post" action="javascript:void(0);">
  <table width="484" border="0" align="center">
    
    <tr>
      <td>Tanggal</td>
      <td colspan="2"><input name="txtTglJO" type="text" id="txtTglJO" size="8" value="<?php if(isset($tglJO)): echo $tglJO; endif;?>" />
        <span><img id="btnTglJO_pr1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
    </tr>
    <tr>
      <td width="108">Kode PO</td>
      <td colspan="2"><input name="kdPO" type="text" id="kdPO" value="<?php if(isset($kdPO)): echo $kdPO; endif; ?>" size="8" />
        <input type="hidden" name="idrec" id="idrec" value="<?php if(isset($id)): echo $id; endif; ?>"  /></td>
    </tr>
    <tr>
      <td>Nama PO</td>
      <td colspan="2"><input name="nmPO" type="text" id="nmPO" value="<?php if(isset($nmPO)): echo $nmPO; endif; ?>" size="28" /></td>
    </tr>
    <tr>
      <td>Artikel</td>
      <td width="139"><input name="idbarang" type="text" id="idbarang" size="15" readonly="readonly" value="<?php if(isset($idbarang)): echo $idbarang; endif; ?>" />&nbsp;<span><img id="btnArtikel" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/add.png" border="0" style="cursor:pointer;" onclick="show_w4_pr1('0');" /></span></td>
      <td width="223" style="color:#FF0000;" id="tmpNmBarang_pr1"><?php if(isset($nmbarang)): echo $nmbarang; endif; ?></td>
    </tr>
    <tr>
      <td>Bahan</td>
      <td><input name="txtBahan" type="text" id="txtBahan" value="<?php if(isset($bahan)): echo $bahan; endif; ?>" size="15" />
        <img src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/add.png" alt="" border="0" id="btnArtikel2" style="cursor:pointer;" onclick="show_w5_pr1('0');" /></td>
      <td style="color:#FF0000;" id="tmpNmBahan_pr1"><?php if(isset($nmbahan)): echo $nmbahan; endif; ?></td>
    </tr>
    <tr>
      <td>Jml PO</td>
      <td colspan="2"><input name="txtJmlPO" type="text" id="txtJmlPO" size="5" value="<?php if(isset($jmlPO)): echo $jmlPO; endif; ?>" /> 
        Lusin</td>
    </tr>
    <tr>
      <td>Pelanggan</td>
      <td colspan="2" id="tmpPlg_pr1"></td>
    </tr>
    <tr>
      <td>Tgl Selesai</td>
      <td colspan="2"><input name="txtTglSelesai" type="text" id="txtTglSelesai" size="8" value="<?php if(isset($tglSelesai)): echo $tglSelesai; endif;?>" />
        <span><img id="btnTglSelesai_pr2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
    </tr>
    <tr>
      <td>Status</td>
      <td colspan="2"><select name="slcStatus" id="slcStatus">
        <option value="OPEN" <?php if(isset($status) && $status == 'OPEN'): echo 'selected="selected"'; endif;?>>OPEN</option>
        <option value="CLOSE" <?php if(isset($status) && $status == 'CLOSE'): echo 'selected="selected"'; endif;?>>CLOSE</option>
      </select>
      </td>
    </tr>
  </table>
</form>
</div>
<div id="tmpSearchBrg_pr1" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
	<table width="409" border="0">
  <tr>
    <td width="117">Cari Nama Barang</td>
    <td width="284"><input type="text" name="frmSearchBrg_pr1" id="frmSearchBrg_pr1" onKeyDown="tandaPanahBrg_pr1(event.keyCode);" tabindex="10">
      <input type="button" name="btnSaring" id="btnSaring" value="Muat Ulang" onclick="muatUlangBarang_pr1();" tabindex="11" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBrgJO_pr1" style="width:405px; height:365px;"></div></td>
  </tr>
</table>
</div>

<div id="tmpSearchBahan_pr1" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
	<table width="409" border="0">
  <tr>
    <td width="117">Cari Bahan</td>
    <td width="284"><input type="text" name="frmSearchBahan_pr1" id="frmSearchBahan_pr1" onKeyDown="tandaPanahBahan_pr1(event.keyCode);" tabindex="10">
      <input type="button" name="btnSaring" id="btnSaring" value="Muat Ulang" onclick="muatUlangBahan_pr1();" tabindex="11" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBahanJO_pr1" style="width:405px; height:365px;"></div></td>
  </tr>
</table>
</div>
<script language="javascript">

// tanggal expired card
cal1_pr1 = new dhtmlXCalendarObject({
			input: "txtTglJO",button: "btnTglJO_pr1"
	});
cal1_pr1.setDateFormat("%d/%m/%Y");

// tanggal expired card
cal2_pr1 = new dhtmlXCalendarObject({
			input: "txtTglSelesai",button: "btnTglSelesai_pr2"
	});
cal2_pr1.setDateFormat("%d/%m/%Y");

// Data Pelanggan
var cbPlg_pr1 = new dhtmlXCombo("tmpPlg_pr1", "cbPlg_pr1", 200);
cbPlg_pr1.enableFilteringMode(true);
loadCbPlg_pr1();
function loadCbPlg_pr1() {
	cbPlg_pr1.clearAll();
	cbPlg_pr1.loadXML(base_url+"index.php/job_order/cbPelanggan",function() {
		<?php
			if(isset($idplg)):
				echo "IDcbPlg_pr1 = cbPlg_pr1.getIndexByValue('".$idplg."');";
				echo "cbPlg_pr1.selectOption(IDcbPlg_pr1,true,true);";
			endif;
		?>
	});
}

var w4_pr1 = dhxWins.createWindow("w4_pr1",0,0,430,450);
w4_pr1.setText("Daftar Barang");
w4_pr1.button("park").hide();
w4_pr1.button("minmax1").hide();
w4_pr1.button("close").hide();
w4_pr1.center();
w4_pr1.hideHeader();
w4_pr1.hide();

tb_w4_pr1 = w4_pr1.attachToolbar();
tb_w4_pr1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w4_pr1.setSkin("dhx_terrace");
tb_w4_pr1.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_w4_pr1.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_w4_pr1.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahBrg_pr1('13');
	} else if(id=='tutup') {
			w4_pr1.hide();
	}
});

gd_w4_pr1 = new dhtmlXGridObject('gridBrgJO_pr1');
gd_w4_pr1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_pr1.setHeader("Kode #,Nama Barang,Jenis",null,["text-align:center","text-align:center","text-align:center"]);
gd_w4_pr1.setInitWidths("100,180,100");
gd_w4_pr1.setColAlign("left,left,left");
gd_w4_pr1.setColSorting("str,str,str");
gd_w4_pr1.setColTypes("ro,ro,ro");
gd_w4_pr1.enableSmartRendering(true,50);
gd_w4_pr1.makeSearch("frmSearchBrg_pr1",1);
gd_w4_pr1.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBrg_pr1('13');
});
gd_w4_pr1.setSkin("dhx_skyblue");
gd_w4_pr1.init();

function show_w4_pr1(idbarang) {
	w4_pr1.bringToTop();
	w4_pr1.show();
	w4_pr1.attachObject('tmpSearchBrg_pr1');
	gd_w4_pr1.clearAll();
	/*gd_w4_pr1.loadXML(base_url+"index.php/master_barang/loadDataBarang_pr1/"+idbarang,function() {
		document.getElementById('frmSearchBrg_pr1').focus();
	});*/
}

function tandaPanahBrg_pr1(key) {
	if(key==13) {
		idbarang = gd_w4_pr1.cells(gd_w4_pr1.getSelectedId(),0).getValue();
		nmbarang = gd_w4_pr1.cells(gd_w4_pr1.getSelectedId(),1).getValue();
		jenis = gd_w4_pr1.cells(gd_w4_pr1.getSelectedId(),2).getValue();
		document.frm_pr1.idbarang.value = idbarang;
		document.getElementById('tmpNmBarang_pr1').innerHTML = nmbarang;
		w4_pr1.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_pr1,'frmSearchBrg_pr1');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_pr1,'frmSearchBrg_pr1');
	}
	if(key==27) {
		w4_pr1.hide();
	}
	return;
}

function muatUlangBarang_pr1() {
	gd_w4_pr1.clearAll();
	nmbarang = document.getElementById('frmSearchBrg_pr1').value;
	statusLoading();
	gd_w4_pr1.loadXML(base_url+"index.php/master_barang/cariDataBarang_pr1/"+nmbarang,function() {
		statusEnding();
		document.getElementById('frmSearchBrg_pr1').focus();
	});
}

// Cari Bahan
var w5_pr1 = dhxWins.createWindow("w5_pr1",0,0,430,450);
w5_pr1.setText("Daftar Barang");
w5_pr1.button("park").hide();
w5_pr1.button("minmax1").hide();
w5_pr1.button("close").hide();
w5_pr1.center();
w5_pr1.hideHeader();
w5_pr1.hide();

tb_w5_pr1 = w5_pr1.attachToolbar();
tb_w5_pr1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w5_pr1.setSkin("dhx_terrace");
tb_w5_pr1.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_w5_pr1.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_w5_pr1.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahBahan_pr1('13');
	} else if(id=='tutup') {
			w5_pr1.hide();
	}
});

gd_w5_pr1 = new dhtmlXGridObject('gridBahanJO_pr1');
gd_w5_pr1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w5_pr1.setHeader("Kode #,Nama Barang,Jenis",null,["text-align:center","text-align:center","text-align:center"]);
gd_w5_pr1.setInitWidths("100,180,100");
gd_w5_pr1.setColAlign("left,left,left");
gd_w5_pr1.setColSorting("str,str,str");
gd_w5_pr1.setColTypes("ro,ro,ro");
gd_w5_pr1.enableSmartRendering(true,50);
gd_w5_pr1.makeSearch("frmSearchBrg_pr1",1);
gd_w5_pr1.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBahan_pr1('13');
});
gd_w5_pr1.setSkin("dhx_skyblue");
gd_w5_pr1.init();

function show_w5_pr1(idbarang) {
	w5_pr1.bringToTop();
	w5_pr1.show();
	w5_pr1.attachObject('tmpSearchBahan_pr1');
}

function tandaPanahBahan_pr1(key) {
	if(key==13) {
		idbarang = gd_w5_pr1.cells(gd_w5_pr1.getSelectedId(),0).getValue();
		nmbarang = gd_w5_pr1.cells(gd_w5_pr1.getSelectedId(),1).getValue();
		document.frm_pr1.txtBahan.value = idbarang;
		document.getElementById('tmpNmBahan_pr1').innerHTML = nmbarang;
		w5_pr1.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w5_pr1,'frmSearchBrg_pr1');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w5_pr1,'frmSearchBrg_pr1');
	}
	if(key==27) {
		w5_pr1.hide();
	}
	return;
}

function muatUlangBahan_pr1() {
	gd_w5_pr1.clearAll();
	nmbarang = document.getElementById('frmSearchBahan_pr1').value;
	statusLoading();
	gd_w5_pr1.loadXML(base_url+"index.php/master_barang/cariDataBahan_pr1/"+nmbarang,function() {
		statusEnding();
		document.getElementById('frmSearchBahan_pr1').focus();
	});
}

// proses
function baru_pr1() {
	cbPlg_pr1.setComboText("");
	document.frm_pr1.id.value = "";
	document.frm_pr1.txtTglJO.value = "";
	document.frm_pr1.kdPO.value = "";
	document.frm_pr1.nmPO.value = "";
	document.frm_pr1.idbarang.value = "";
	document.getElementById('tmpNmBarang_pr1').innerHTML = "";
	//document.frm_pr1.txtJenis.value = "";
	document.frm_pr1.txtBahan.value = "";
	document.getElementById('tmpNmBahan_pr1').innerHTML = "";
	document.frm_pr1.txtJmlPO.value = "";
	document.frm_pr1.txtTglSelesai.value = "";
	document.frm_pr1.slcStatus.value = "";	
	
	
	// bersih Size
	jmlCekList = document.frm_pr1.slcsize.length;
	for (i = 0; i < jmlCekList; i++) {
		document.frm_pr1.slcsize[i].checked = false;
	}	
}

function simpan_pr1() {
	if(document.frm_pr1.txtTglJO.value=="") {
		alert("Tgl PO Tidak Boleh Kosong");
		document.frm_pr1.txtTglJO.focus();
		return;
	}
	if(document.frm_pr1.kdPO.value=="") {
		alert("Kode PO Tidak Boleh Kosong");
		document.frm_pr1.kdPO.focus();
		return;
	}
	if(document.frm_pr1.nmPO.value=="") {
		alert("Nama PO Tidak Boleh Kosong");
		document.frm_pr1.nmPO.focus();
		return;
	}
	if(document.frm_pr1.idbarang.value=="") {
		alert("Artikel Tidak Boleh Kosong");
		document.frm_pr1.idbarang.focus();
		return;
	}
	if(document.frm_pr1.txtBahan.value=="") {
		alert("Bahan Tidak Boleh Kosong");
		document.frm_pr1.txtBahan.focus();
		return;
	}
	if(document.frm_pr1.txtJmlPO.value=="") {
		alert("Jml PO Tidak Boleh Kosong");
		document.frm_pr1.txtJmlPO.focus();
		return;
	}
	if(document.frm_pr1.txtTglSelesai.value=="") {
		alert("Tgl Selesai Tidak Boleh Kosong");
		document.frm_pr1.txtTglSelesai.focus();
		return;
	}
		poststr =
			'id=' + document.frm_pr1.idrec.value +
            '&txtTglJO=' + document.frm_pr1.txtTglJO.value +
			'&kdPO=' + document.frm_pr1.kdPO.value +
			'&nmPO=' + document.frm_pr1.nmPO.value +
			'&idbarang=' + document.frm_pr1.idbarang.value +
			'&txtBahan=' + document.frm_pr1.txtBahan.value +
			'&txtJmlPO=' + document.frm_pr1.txtJmlPO.value +
			'&slcStatus=' + document.frm_pr1.slcStatus.value +
			'&cbPelanggan=' + cbPlg_pr1.getSelectedValue() +
			'&txtTglSelesai=' + document.frm_pr1.txtTglSelesai.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/job_order/simpan", encodeURI(poststr), outputSimpan_pr1);
	}
	
	function outputSimpan_pr1(loader) {
        result = loader.xmlDoc.responseText;
		tb_w1_pr1.disableItem("save");
		tb_w1_pr1.enableItem("baru");
		refreshGd_pr1();
		statusEnding();
    }
</script>

<div id="tmpTb_rsp5" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rsp5" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="662" border="0">
    <tr>
      <td width="142">Periode</td>
      <td width="510"><input name="tgl1_rsp5" type="text" id="tgl1_rsp5" size="8" />
      <span><img id="btnTgl1_rsp5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /> s.d <input name="tgl2_rsp5" type="text" id="tgl2_rsp5" size="8" /></span>
      <span><img id="btnTgl2_rsp5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    
    <tr>
      <td>Gudang Asal</td>
      <td><select name="gudangAsal" id="gudangAsal" style="width:200px;">
        <?php echo $gudang; ?>
      </select>
        <input type="hidden" name="nmbarang" id="nmbarang" /></td>
      </tr>
    <tr>
      <td>Nama Barang</td>
      <td><input name="idbarang" type="text" id="idbarang" size="10" />
         <img id="btnPsn" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/blue_view.png" border="0" style="cursor:pointer;" onclick="show_w4_rsp5(0);" /><span id="tmpnmbarang_rsp5"></span></td>
    </tr>
    <tr>
      <td>Ukuran</td>
      <td><select name="tmpSize_rsp5" id="tmpSize_rsp5" onchange="if(this.value=='') { document.frm_rsp5.tmpUkuran.disabled = false; } else { document.frm_rsp5.tmpUkuran.disabled = true; }">
      </select>
      </td>
    </tr>
    <tr>
      <td>Tampil Ukuran</td>
      <td><input type="checkbox" name="tmpUkuran" id="tmpUkuran" /></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onClick="tampil_rsp5('HTML');" />
        <input type="button" name="button2" id="button2" value="TO EXCEL" onClick="tampil_rsp5('EXCEL');" /></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<div id="tmpSearchBrg_rsp5" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
	<table width="409" border="0">
  <tr>
    <td width="117">Cari Nama Barang</td>
    <td width="284"><input type="text" name="frmSearchBrg_rsp5" id="frmSearchBrg_rsp5" onKeyDown="tandaPanahBrg_rsp5(event.keyCode);" tabindex="10">
      <input type="button" name="btnSaring" id="btnSaring" value="Muat Ulang" onclick="muatUlangBarang_rsp5();" tabindex="11" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBarang_rsp5" style="width:405px; height:365px;"/>&nbsp;<br />&nbsp;</td>
  </tr>
</table>
</div>
<script language="javascript">
cal1_rsp5 = new dhtmlXCalendarObject({
			input: "tgl1_rsp5",button: "btnTgl1_rsp5"
	});
cal1_rsp5.setDateFormat("%Y-%m-%d");

cal2_rsp5 = new dhtmlXCalendarObject({
			input: "tgl2_rsp5",button: "btnTgl2_rsp5"
	});
cal2_rsp5.setDateFormat("%Y-%m-%d");


function tampil_rsp5(type) {
	if(document.frm_rsp5.tgl1_rsp5.value == "") {
		alert("Tgl Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rsp5.tgl2_rsp5.value == "") {
		alert("Tgl Akhir Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rsp5.gudangAsal.value == "") {
		alert("Gudang Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rsp5.idbarang.value == "") {
		alert("Pilih Barang Terlebih Dahulu");
		return;
	}
	tglAwal = document.frm_rsp5.tgl1_rsp5.value;
	tglAkhir = document.frm_rsp5.tgl2_rsp5.value;
	gudang = document.frm_rsp5.gudangAsal.value;
	idbarang = document.frm_rsp5.idbarang.value;
	nmbarang = document.frm_rsp5.nmbarang.value;
	
	if(document.frm_rsp5.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	if(document.frm_rsp5.tmpSize_rsp5.value=="") {
		size = 0;
	} else {
		size = document.frm_rsp5.tmpSize_rsp5.value;
	}
		
	url = base_url+'index.php/report_stock/kartu_stock/'+tglAwal+"/"+tglAkhir+"/"+gudang+"/"+tmpUkuran+"/"+type+"/"+idbarang+"/"+nmbarang+"/"+size;
	
	window.open(url,'_blank');
}

// Window Cari Barang

var w4_rsp5 = dhxWins.createWindow("w4_rsp5",0,0,430,450);
w4_rsp5.setText("Daftar Barang");
w4_rsp5.button("park").hide();
w4_rsp5.button("minmax1").hide();
w4_rsp5.button("close").hide();
w4_rsp5.center();
w4_rsp5.hideHeader();

tb_w4_rsp5 = w4_rsp5.attachToolbar();
tb_w4_rsp5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w4_rsp5.setSkin("dhx_terrace");
tb_w4_rsp5.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_w4_rsp5.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_w4_rsp5.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahBrg_rsp5(13);
	} else if(id=='tutup') {
			w4_rsp5.hide();
			document.getElementById('frmSearchBrg_rsp5').value = "";
	}
});

gd_w4_rsp5 = new dhtmlXGridObject('gridBarang_rsp5');
gd_w4_rsp5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_rsp5.setHeader("Kode #,Nama Barang,Satuan",null,["text-align:center","text-align:center","text-align:center"]);
gd_w4_rsp5.setInitWidths("80,220,100");
gd_w4_rsp5.setColAlign("left,left,left");
gd_w4_rsp5.setColSorting("str,str,str");
gd_w4_rsp5.setColTypes("ro,ro,ro");
gd_w4_rsp5.enableSmartRendering(true,50);
gd_w4_rsp5.makeSearch("frmSearchBrg_rsp5",1);
gd_w4_rsp5.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBrg_rsp5(13);
});  
gd_w4_rsp5.setSkin("dhx_skyblue");
gd_w4_rsp5.init();

w4_rsp5.hide();

function show_w4_rsp5(idbarang) {
	w4_rsp5.bringToTop();
	w4_rsp5.show();
	w4_rsp5.center();
	w4_rsp5.attachObject('tmpSearchBrg_rsp5');
	gd_w4_rsp5.clearAll();
	gd_w4_rsp5.loadXML(base_url+"index.php/master_barang/cariDataBarang_md41/"+idbarang,function() {
		document.getElementById('frmSearchBrg_rsp5').focus();
	});
}
	
function tandaPanahBrg_rsp5(key) {
	if(key==13) {
		idbarang = gd_w4_rsp5.cells(gd_w4_rsp5.getSelectedId(),0).getValue();
		nmbarang = gd_w4_rsp5.cells(gd_w4_rsp5.getSelectedId(),1).getValue();
		satuan = gd_w4_rsp5.cells(gd_w4_rsp5.getSelectedId(),2).getValue();
		document.frm_rsp5.idbarang.value = idbarang;
		pilihSize(idbarang);
		document.getElementById('tmpnmbarang_rsp5').innerHTML = nmbarang;
		document.frm_rsp5.nmbarang.value = nmbarang;
		w4_rsp5.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_rsp5,'frmSearchBrg_rsp5');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_rsp5,'frmSearchBrg_rsp5');
	}
	if(key==27) {
		w4_rsp5.hide();
	}
	return;
}

function muatUlangBarang_rsp5() {
	gd_w4_rsp5.clearAll();
	nmbarang = document.getElementById('frmSearchBrg_rsp5').value;
	statusLoading();
	gd_w4_rsp5.loadXML(base_url+"index.php/master_barang/cariDataBarang_md41/"+nmbarang,function() {
		statusEnding();
		document.getElementById('frmSearchBrg_rsp5').focus();
	});
}

function pilihSize(idbarang) {
	var poststr =
			'idbarang=' + idbarang;
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/report_stock/pilihSize", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.getElementById('tmpSize_rsp5').innerHTML = result;
		});
	
}
</script>

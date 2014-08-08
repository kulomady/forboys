<div class="frmContainer">
<form name="frm_md41" id="frm_md41" method="post" action="javascript:void(0);">
  <table width="983" border="0" align="center">
    <tr>
      <td>Kode</td>
      <td><input name="txtKode" type="text" id="txtKode" size="5" value="<?php if(isset($kode)): echo $kode; endif;?>" /></td>
      <td>Tgl Berlaku</td>
      <td><input name="txtTglBerlaku" type="text" id="txtTglBerlaku" size="8" value="<?php if(isset($tgl_berlaku)): echo $tgl_berlaku; endif;?>" />
        <span><img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td style="display:none;"><a href="javascript:selectCel_input_md41(5)" id="pilihCell4_md41">selectCell</a><a href="javascript:selectCel_input_md41(0)" id="pilihCell0_md41">selectCell</a></td>
    </tr>
    <tr>
      <td width="92">Keterangan</td>
      <td width="194"><input type="text" name="txtKet" id="txtKet" value="<?php if(isset($ket)): echo $ket; endif;?>" /></td>
      <td width="90">Status</td>
      <td width="346"><select name="slcStatus" id="slcStatus">
        <option value=""></option>
        <option value="1" <?php if(isset($active) && $active == '1'): echo 'selected="selected"'; endif;?>>Aktif</option>
        <option value="0" <?php if(isset($active) && $active == '0'): echo 'selected="selected"'; endif;?>>Pasif</option>
      </select>
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
      <td width="239">Berlaku Untuk Outlet :</td>
    </tr>
    <tr>
      <td colspan="4"><div id="tmpGridInput_md41" style="height:370px;width: 100%"></div></td>
      <td><div id="tmpGridOutlet_md41" style="height:370px;width: 100%"></div></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div>
<div id="tmpSearchBrg_md41" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
	<table width="409" border="0">
  <tr>
    <td width="117">Cari Nama Barang</td>
    <td width="284"><input type="text" name="frmSearchBrg_md41" id="frmSearchBrg_md41" onKeyDown="tandaPanahBrg_md41(event.keyCode);" tabindex="10">
      <input type="button" name="btnSaring" id="btnSaring" value="Muat Ulang" onclick="muatUlangBarang_md41();" tabindex="11" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBarang_md41" style="width:405px; height:365px;"/>&nbsp;<br />&nbsp;</td>
  </tr>
</table>
</div>
<div id="tmpCommand_md41" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; padding-left:10px; padding-right:10px;">
<form action="<?php echo base_url(); ?>index.php/harga_barang/importData" method="post" enctype="multipart/form-data" name="frmUpload_pd1" id="frmUpload_pd1" target="tmpImport_pd1">  
   <table width="466" border="0">
     <tr>
       <td width="256"><input type="file" name="userfile" id="userfile" /></td>
       <td width="200"><input type="submit" name="button5" id="button8" value="UPLOAD" />
       </td>
     </tr>
   </table>
   <iframe id="tmpImport_pd1" name="tmpImport_pd1" width="500" height="350" style=" border:1px solid #999; background-color:#666;"></iframe>
   <a href="<?php echo base_url(); ?>assets/import_hrg_brg.xls" target="_blank"><br />
   Download Format Excel</a>
  <p>
</p>
</form>
</div>
<script language="javascript">
// tanggal expired card
cal1_md41 = new dhtmlXCalendarObject({
			input: "txtTglBerlaku",button: "btnTglBerlaku_md41"
	});
cal1_md41.setDateFormat("%d/%m/%Y");

// Grid Barang Detail

gdInp_md41 = new dhtmlXGridObject('tmpGridInput_md41');
gdInp_md41.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp_md41.setHeader("&nbsp;,Kode,#cspan,Nama Barang,Satuan,Harga,Disc 1,Disc 2, Disc 3, Disc 4,&nbsp;",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp_md41.setInitWidths("30,70,30,150,60,80,60,60,60,60,30");
gdInp_md41.setColAlign("right,left,center,left,left,right,center,center,center,center,left");
gdInp_md41.setColTypes("cntr,ed,ro,ro,ro,edn,ed,ed,ed,ed,ro");
gdInp_md41.setNumberFormat("0,000",5,",",".");
//gdInp_md41.enableSmartRendering(true,50);
gdInp_md41.setColumnColor("#CCE2FE");
gdInp_md41.setSkin("dhx_skyblue");
gdInp_md41.attachEvent("onEnter", doOnEnterInp_md41);
gdInp_md41.init();

img_link_md41 = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_w4_md41(0);" />';
img_del_md41 = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail_md41(0);" />';

<?php if(!isset($id)) { echo "baru_md41();"; } else { echo 'loadDataInp_md41("'.$kode.'")'; }?>

function loadDataInp_md41(kode) {
	gdInp_md41.clearAll();
	gdInp_md41.loadXML(base_url+"index.php/harga_barang/loadDataBrg_harga/"+kode,function() {
		addRowInp_md41();
	});
}

function addRowInp_md41() {
	arrId = gdInp_md41.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1];
	celIdbarang = gdInp_md41.cells(idcell,1).getValue();
	jmlrec = parseInt(gdInp_md41.getRowsNum()) + 1;
	if(celIdbarang != "") {
			posisi = gdInp_md41.getRowsNum();
			gdInp_md41.addRow(gdInp_md41.uid(),[jmlrec,'',img_link_md41,'','','','','','','',img_del_md41],posisi);
			gdInp_md41.selectRow(posisi);
	}
}

function delRowInp_md41() {
	arrId = gdInp_md41.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1];
	celIdbarang = gdInp_md41.cells(idcell,1).getValue();
	if(celIdbarang == "") {
		gdInp_md41.deleteRow(idcell);
	}
}

function doOnEnterInp_md41(rowId, cellInd) {
	if(cellInd==0) {
		cariBarang_md41();
	}
	addRowInp_md41();
	return true;
}


function cariBarang_md41() {
	idbarang = gdInp_md41.cells(gdInp_md41.getSelectedId(),0).getValue();
	var poststr =
		'idbarang=' + idbarang;
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/harga_barang/cariBarang", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			show_w4_md41(idbarang);
		} else {
			arrBrg = result.split('|');
			setDataBrg_md41(idbarang,arrBrg[0],arrBrg[1]);
		}
	});
}

function selectCel_input_md41(idcell) {
	idselect = gdInp_md41.getSelectedId();
	index = gdInp_md41.getRowIndex(idselect);
	gdInp_md41.selectCell(index,idcell,false,false,true);
}

function setDataBrg_md41(kode,nmbarang,satuan) {
	if(adaBarang_md41(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		gdInp_md41.cells(gdInp_md41.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0_md41").click();
		return;
	}
	gdInp_md41.cells(gdInp_md41.getSelectedId(),1).setValue(kode.toUpperCase());
	gdInp_md41.cells(gdInp_md41.getSelectedId(),3).setValue(nmbarang);
	gdInp_md41.cells(gdInp_md41.getSelectedId(),4).setValue(satuan);
	document.getElementById("pilihCell4_md41").click();
}

function adaBarang_md41(kode) {
	ada = 0;
	gdInp_md41.forEachRow(function(id){
		if(gdInp_md41.cells(id,1).getValue()==kode && gdInp_md41.cells(id,3).getValue()!="") {
			ada = 1;
			return ada;
		}
	});
	return ada;
}


// Window Cari Barang

var w4_md41 = dhxWins.createWindow("w4_md41",0,0,430,450);
w4_md41.setText("Daftar Pramuniaga");
w4_md41.button("park").hide();
w4_md41.button("minmax1").hide();
w4_md41.button("close").hide();
w4_md41.center();
w4_md41.hideHeader();
w4_md41.hide();

tb_w4_md41 = w4_md41.attachToolbar();
tb_w4_md41.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w4_md41.setSkin("dhx_terrace");
tb_w4_md41.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_w4_md41.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_w4_md41.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahBrg_md41(13);
	} else if(id=='tutup') {
			w4_md41.hide();
	}
});

gd_w4_md41 = new dhtmlXGridObject('gridBarang_md41');
gd_w4_md41.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_w4_md41.setHeader("Kode #,Nama Barang,Satuan",null,["text-align:center","text-align:center","text-align:center"]);
gd_w4_md41.setInitWidths("80,220,100");
gd_w4_md41.setColAlign("left,left,left");
gd_w4_md41.setColSorting("str,str,str");
gd_w4_md41.setColTypes("ro,ro,ro");
gd_w4_md41.enableSmartRendering(true,50);
gd_w4_md41.makeSearch("frmSearchBrg_md41",1);
gd_w4_md41.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBrg_md41(13);
});  
gd_w4_md41.setSkin("dhx_skyblue");
gd_w4_md41.init();

function show_w4_md41(idbarang) {
	w4_md41.bringToTop();
	w4_md41.show();
	w4_md41.center();
	w4_md41.attachObject('tmpSearchBrg_md41');
	gd_w4_md41.clearAll();
	gd_w4_md41.loadXML(base_url+"index.php/master_barang/loadDataBarang_md41/"+idbarang,function() {
		document.getElementById('frmSearchBrg_md41').focus();
	});
}
	
function tandaPanahBrg_md41(key) {
	if(key==13) {
		idbarang = gd_w4_md41.cells(gd_w4_md41.getSelectedId(),0).getValue();
		nmbarang = gd_w4_md41.cells(gd_w4_md41.getSelectedId(),1).getValue();
		satuan = gd_w4_md41.cells(gd_w4_md41.getSelectedId(),2).getValue();
		setDataBrg_md41(idbarang,nmbarang,satuan);
		w4_md41.hide();
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_md41,'frmSearchBrg_md41');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_md41,'frmSearchBrg_md41');
	}
	if(key==27) {
		w4_md41.hide();
	}
	return;
}

function muatUlangBarang_md41() {
	gd_w4_md41.clearAll();
	nmbarang = document.getElementById('frmSearchBrg_md41').value;
	statusLoading();
	gd_w4_md41.loadXML(base_url+"index.php/master_barang/cariDataBarang_md41/"+nmbarang,function() {
		statusEnding();
		document.getElementById('frmSearchBrg_md41').focus();
	});
}

// Grid Pilih Outlet
gdOutlet_md41 = new dhtmlXGridObject('tmpGridOutlet_md41');
gdOutlet_md41.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdOutlet_md41.setHeader("#master_checkbox,Nama Outlet,outlet_id",null,["text-align:center","text-align:center","text-align:center"]);
gdOutlet_md41.setInitWidths("30,180,0");
gdOutlet_md41.setColAlign("center,left,left");
gdOutlet_md41.setColSorting("str,str,str");
gdOutlet_md41.setColTypes("ch,ro,ro");
//gd_md41.enableSmartRendering(true,50);
gdOutlet_md41.setColumnColor("#CCE2FE");
gdOutlet_md41.setSkin("dhx_skyblue");
gdOutlet_md41.init();


function loadHargaOutlet_md41() {
	gdOutlet_md41.clearAll();
	gdOutlet_md41.loadXML(base_url+"index.php/harga_barang/dataHarga_outlet/"+document.frm_md41.txtKode.value);
}

loadHargaOutlet_md41();

// Operasi Form
function simpan_md41() {

	// hapus row terakhir yang kosong
	delRowInp_md41();
	
	// Proses Simpan
 	var poststr =
			'id=' + document.frm_md41.id.value +
            '&txtKode=' + document.frm_md41.txtKode.value +
			'&txtKet=' + document.frm_md41.txtKet.value +
			'&txtTglBerlaku=' + document.frm_md41.txtTglBerlaku.value +
			'&aktif=' + document.frm_md41.slcStatus.value +
			'&detailBrg=' + getData(gdInp_md41,[0,2,3,4,10]) +
			'&dataOulet=' + getData(gdOutlet_md41,[1]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/harga_barang/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			//alert(result);
			statusEnding();
			refreshGd_md41();
			tb_w1_md41.disableItem("save");
			tb_w1_md41.disableItem("batal");
			tb_w1_md41.enableItem("baru");
		});
}

function baru_md41() {
	document.frm_md41.id.value = "";
	document.frm_md41.txtKode.value = "";
	document.frm_md41.txtKet.value = "";
	document.frm_md41.txtTglBerlaku.value = "";
	document.frm_md41.slcStatus.value = "";
	
	gdInp_md41.clearAll();
	gdInp_md41.addRow(gdInp_md41.uid(),['','',img_link_md41,'','','','','','','',img_del_md41],0);
	gdInp_md41.selectRow(0);
	
	try {
		gdOutlet_md41.forEachRow(function(id){
			gdOutlet_md41.cells(id,0).setValue(0);
		});
	} catch(e) {}
}

function hapusDetail_md41() {
	kode = gdInp_md41.cells(gdInp_md41.getSelectedId(),0).getValue();
	if(kode != "") {
		y = confirm("Apakah Anda Yakin ?");
		if(y) {
				gdInp_md41.deleteSelectedItem();
		}
	}
	return;
}

// Window Command
wCom_md41 = dhxWins.createWindow("wCom_md41",0,0,540,450);
wCom_md41.setText("Upload");
wCom_md41.button("park").hide();
//wCom_md3.button("close").hide();
wCom_md41.button("minmax1").hide();
wCom_md41.button("close").attachEvent("onClick", function() {
		wCom_md41.hide();
		wCom_md41.setModal(false);
		return;
    });
wCom_md41.hide();

function showWinCom_md41() {
	wCom_md41.show();
    wCom_md41.setModal(true);
	wCom_md41.bringToTop();
	wCom_md41.center();
	wCom_md41.attachObject('tmpCommand_md41');
}

function actionUpload_md41(data) {
	delRowInp_md41();
	arrBaris = data.split("~");
	jml = arrBaris.length - 1;
	for(i=0;i<jml;i++) {
		arrBrg = arrBaris[i].split("|");
		if(adaBarang_md41(arrBrg[0]) == 1) {	
			//alert(arrBrg[0]+" Sudah Ada");
		} else {			
				posisi = gdInp_md41.getRowsNum() - 1;
				gdInp_md41.addRow(arrBrg[0],['',arrBrg[0],img_link,arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],arrBrg[6],arrBrg[7],img_del],posisi);
				gdInp_md41.selectRow(posisi);
				try { gdInp_md41.showRow(arrBrg[0]); } catch(e) {}
		}
	}
	addRowInp_md41();
	document.frmUpload_md41.userfile.value = "";
}
</script>
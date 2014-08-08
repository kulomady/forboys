<div id="tmpTb_md3" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_md3" style="position: relative; width: 100%; height: 91%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_md3" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_md3" name="frmSearch_md3" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="300">Kode Item</td>
        <td width="250"><input type="text" name="kode" id="kode" /></td>
        <td width="180">Jenis</td>
        <td width="250" id="tmpIndexJns_md3"></td>
        <td width="180">Warna</td>
        <td width="250" id="tmpIndexWarna_md3"></td>
        <td rowspan="3" valign="top"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_md3();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
      	<td>Nama Item</td>
        <td><input type="text" name="nama" id="nama" /></td>
        <td>Kategori</td>
        <td id="tmpIndexKat_md3"></td>
        <td>Supplier</td>
        <td id="tmpIndexSupplier_md3"></td>
      </tr>
      <tr>
      	<td>Tipe Barang</td>
        <td id="tmpIndexTipe_md3"></td>
        <td>Merk</td>
        <td id="tmpIndexMerk_md3"></td>
        <td>Konsinyasi</td>
        <td><input type="checkbox" id="kosinyasi" name="konsinyasi" /></td>
      </tr>
    </table>
  </form>
</div>
<div id="tmpCommand_md3" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; padding-left:10px; padding-right:10px; display:none;">
<form action="<?php echo base_url(); ?>index.php/master_barang/importData" method="post" enctype="multipart/form-data" name="frmUpload_md3" id="frmUpload_md3" target="tmpImport_md3">
  <p>
    <input type="file" name="userfile" id="userfile" /><input type="checkbox" name="cekupdate" id="cekupdate" onclick="cekUpdate_md3();" />
Update Jika Barang Sudah Ada
    <fieldset><legend> Pilih Kolom yang akan diupdate</legend>
    <table width="473" border="0">
      <tr>
        <td width="108"><input type="checkbox" name="nmbarang" id="nmbarang" disabled="disabled" />
Nama Barang</td>
        <td width="131"><input type="checkbox" name="keterangan" id="keterangan" disabled="disabled" />
Keterangan</td>
        <td width="109"><input type="checkbox" name="hrg_beli" id="hrg_beli" disabled="disabled" />
Harga Beli</td>
        <td width="107"><input type="checkbox" name="idsupplier" id="idsupplier" disabled="disabled" />
Supplier</td>
      </tr>
      <tr>
        <td><input name="idtipe_item" type="checkbox" id="idtipe_item" disabled="disabled" />
Tipe Item</td>
        <td><input type="checkbox" name="sts_jual" id="sts_jual" disabled="disabled" />
Status Jual</td>
        <td><input type="checkbox" name="idmerk" id="idmerk" disabled="disabled" />
Merk</td>
        <td><input type="checkbox" name="code_sms" id="code_sms" disabled="disabled" />
Code SMS</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="idjns_item" id="idjns_item" disabled="disabled" />
Jenis Item</td>
        <td><input type="checkbox" name="sts_konsinyasi" id="sts_konsinyasi" disabled="disabled" />
Status Konsinyasi</td>
        <td><input type="checkbox" name="idkategori" id="idkategori" disabled="disabled" />
Kategori</td>
        <td><input type="checkbox" name="idpajak" id="idpajak" disabled="disabled" />
Pajak</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="idmata_uang" id="idmata_uang" disabled="disabled" />
Mata Uang</td>
        <td><input type="checkbox" name="sts_serial" id="sts_serial" disabled="disabled" />
Status Serial</td>
        <td><input type="checkbox" name="idwarna" id="idwarna" disabled="disabled" />
Warna</td>
        <td><input type="checkbox" name="barcode" id="barcode" disabled="disabled" />
        Barcode</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="idrak" id="idrak" disabled="disabled" />
Rak</td>
        <td><input type="checkbox" name="idsat_dasar" id="idsat_dasar" disabled="disabled" />
Satuan Dasar</td>
        <td><input type="checkbox" name="stock_minimum" id="stock_minimum" disabled="disabled" />
Stock Minimum</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </fieldset>  
   
    </p>  
   <input type="submit" name="button5" id="button8" value="UPLOAD" /> 
   
   <iframe id="tmpImport_md3" name="tmpImport_md3" width="500" height="250" style=" border:1px solid #999; background-color:#666;"></iframe>
   <a href="<?php echo base_url(); ?>assets/import_data_barang.xls" target="_blank">Download Format Excel</a>
  <p><input name="code" type="hidden" value="" />
</p>
</form>
</div>

<script language="javascript">
tb_md3 = new dhtmlXToolbarObject("tmpTb_md3");
tb_md3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_md3.setSkin("dhx_terrace");
tb_md3.attachEvent("onclick", tbClick_md3);
tb_md3.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
	tb_md3.hideItem("print");
	if(tb_md3.isEnabled("new")==true) {
		tb_md3.addButton("import", 9, "Import", "import.png", "import.png");
	}
	if(tb_md3.isEnabled("print")==true) {
		tb_md3.addButton("export", 10, "Export", "export.png", "export.png");
	}
});

dhxLayout_md3 = new dhtmlXLayoutObject("tmpLayout_md3", "2E");
dhxLayout_md3.cells("a").setText("Cari Data");
dhxLayout_md3.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_md3.cells("a").setHeight(110);
dhxLayout_md3.cells("a").collapse();
dhxLayout_md3.cells("a").attachObject("tmpSearch_md3");
dhxLayout_md3.cells("b").setText("Site Navigation");
dhxLayout_md3.cells("b").hideHeader();

function tbClick_md3(id) {
	if(id=='new') {
		winForm_md3('input');
	} else if(id=='edit') {
		winForm_md3('edit');
	} else if(id=='del') {
		hapus_md3();
	} else if(id=='refresh') {
		loadGd_md3();
	} else if(id=='print') {
		cetak_md3();
	} else if(id=='cari') {
		if(dhxLayout_md3.cells("a").isCollapsed()) {
			dhxLayout_md3.cells("a").expand();
		} else {
			dhxLayout_md3.cells("a").collapse();
		}
	} else if(id=='import') {
		showWinCom_md3();
	} else if(id=='export') {
		window.open(base_url+'index.php/master_barang/exportExcel','_blank');		
	}
}

	// Combo Jenis Barang
	var cbIndexJns_md3 = new dhtmlXCombo("tmpIndexJns_md3", "cbJns_md3", 200);
	cbIndexJns_md3.enableFilteringMode(true);
	loadCbIndexJns_md3();
	function loadCbIndexJns_md3() {
		cbIndexJns_md3.clearAll();
		cbIndexJns_md3.loadXML(base_url+"index.php/master_barang/cbJenis");
	}
	
	// Combo Kategori Barang
	var cbIndexKat_md3 = new dhtmlXCombo("tmpIndexKat_md3", "cbKat_md3", 200);
	cbIndexKat_md3.enableFilteringMode(true);
	loadIndexCbKat_md3();
	function loadIndexCbKat_md3() {
		cbIndexKat_md3.clearAll();
		cbIndexKat_md3.loadXML(base_url+"index.php/master_barang/cbKategori");
	}
	
	// Combo Merk Barang
	var cbIndexMerk_md3 = new dhtmlXCombo("tmpIndexMerk_md3", "cbMerk_md3", 200);
	cbIndexMerk_md3.enableFilteringMode(true);
	loadCbIndexMerk_md3();
	function loadCbIndexMerk_md3() {
		cbIndexMerk_md3.clearAll();
		cbIndexMerk_md3.loadXML(base_url+"index.php/master_barang/cbMerk");
	}
	
	// Combo Warna Barang
	var cbIndexWarna_md3 = new dhtmlXCombo("tmpIndexWarna_md3", "cbWarna_md3", 200);
	cbIndexWarna_md3.enableFilteringMode(true);
	loadCbIndexWarna_md3();
	function loadCbIndexWarna_md3() {
		cbIndexWarna_md3.clearAll();
		cbIndexWarna_md3.loadXML(base_url+"index.php/master_barang/cbWarna");
	}
	
	// Combo Supplier
	var cbIndexSupplier_md3 = new dhtmlXCombo("tmpIndexSupplier_md3", "cbSupplier_md3", 200);
	cbIndexSupplier_md3.enableFilteringMode(true);
	loadCbIndexSupplier_md3();
	function loadCbIndexSupplier_md3() {
		cbIndexSupplier_md3.clearAll();
		cbIndexSupplier_md3.loadXML(base_url+"index.php/master_barang/cbSupplier");
	}
	
	// Combo Tipe Item
	var cbIndexTI_md3 = new dhtmlXCombo("tmpIndexTipe_md3", "cbTI_md3", 200);
	cbIndexTI_md3.enableFilteringMode(true);
	loadCbIndexTI_md3();
	function loadCbIndexTI_md3() {
		cbIndexTI_md3.clearAll();
		cbIndexTI_md3.loadXML(base_url+"index.php/master_barang/cbTipeItem");
	}

gd_md3 = dhxLayout_md3.cells("b").attachGrid();
gd_md3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_md3.setHeader("&nbsp;,Kode,Nama Barang,Tipe Item,Jenis Item,Satuan Dasar,Status Jual,Konsinyasi,Merk,Kategori,Warna,Keterangan,Aktif",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_md3.setInitWidths("30,100,200,100,100,100,100,100,100,100,100,100,100");
gd_md3.setColAlign("right,left,left,left,left,left,left,left,left,left,left,left,left");
gd_md3.setColSorting("na,int,str,str,int,int,str,date,date,str,str,str,str");
gd_md3.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_md3.enableSmartRendering(true,50);
gd_md3.setColumnColor("#CCE2FE");
gd_md3.setSkin("dhx_skyblue");
gd_md3.splitAt(3);
gd_md3.init();
loadGd_md3();

function loadGd_md3() {
	if(document.frmSearch_md3.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md3.kode.value;
	}
	
	if(document.frmSearch_md3.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md3.nama.value;
	}
	
	if(cbIndexJns_md3.getSelectedValue()==null) {
		jenis = "0";
	} else {
		jenis = cbIndexJns_md3.getSelectedValue();
	}
	
	if(cbIndexWarna_md3.getSelectedValue()==null) {
		warna = "0";
	} else {
		warna = cbIndexWarna_md3.getSelectedValue();
	}
	
	if(cbIndexKat_md3.getSelectedValue()==null) {
		kategori = "0";
	} else {
		kategori = cbIndexKat_md3.getSelectedValue();
	}
	
	if(cbIndexSupplier_md3.getSelectedValue()==null) {
		supplier = "0";
	} else {
		supplier = cbIndexSupplier_md3.getSelectedValue();
	}
	
	if(cbIndexTI_md3.getSelectedValue()==null) {
		typeBarang = "0";
	} else {
		typeBarang = cbIndexTI_md3.getSelectedValue();
	}
	
	if(cbIndexMerk_md3.getSelectedValue()==null) {
		merk = "0";
	} else {
		merk = cbIndexMerk_md3.getSelectedValue();
	}
	
	if(document.frmSearch_md3.konsinyasi.checked==true) {
		konsinyasi = 1;
	} else {
		konsinyasi = 0;
	}
	
	statusLoading();
	gd_md3.clearAll();
	gd_md3.loadXML(base_url+"index.php/master_barang/loadMainData/"+nama+"/"+kode+"/"+konsinyasi+"/"+typeBarang+"/"+jenis+"/"+kategori+"/"+merk+"/"+warna+"/"+supplier,function(){
		statusEnding();
	});
}

function refreshGd_md3() {
	if(document.frmSearch_md3.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_md3.kode.value;
	}
	
	if(document.frmSearch_md3.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_md3.nama.value;
	}
	
	if(cbIndexJns_md3.getSelectedValue()==null) {
		jenis = "0";
	} else {
		jenis = cbIndexJns_md3.getSelectedValue();
	}
	
	if(cbIndexWarna_md3.getSelectedValue()==null) {
		warna = "0";
	} else {
		warna = cbIndexWarna_md3.getSelectedValue();
	}
	
	if(cbIndexKat_md3.getSelectedValue()==null) {
		kategori = "0";
	} else {
		kategori = cbIndexKat_md3.getSelectedValue();
	}
	
	if(cbIndexSupplier_md3.getSelectedValue()==null) {
		supplier = "0";
	} else {
		supplier = cbIndexSupplier_md3.getSelectedValue();
	}
	
	if(cbIndexTI_md3.getSelectedValue()==null) {
		typeBarang = "0";
	} else {
		typeBarang = cbIndexTI_md3.getSelectedValue();
	}
	
	if(cbIndexMerk_md3.getSelectedValue()==null) {
		merk = "0";
	} else {
		merk = cbIndexMerk_md3.getSelectedValue();
	}
	
	if(document.frmSearch_md3.konsinyasi.checked==true) {
		konsinyasi = 1;
	} else {
		konsinyasi = 0;
	}
	gd_md3.updateFromXML(base_url+"index.php/master_barang/loadMainData/"+nama+"/"+kode+"/"+konsinyasi+"/"+typeBarang+"/"+jenis+"/"+kategori+"/"+merk+"/"+warna+"/"+supplier);
}

function winForm_md3(type) {

	idselect = gd_md3.getRowIndex(gd_md3.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_md3 = dhxWins.createWindow("w1_md3",0,0,800,600);
	w1_md3.setText("Master Barang");
	w1_md3.button("park").hide();
	w1_md3.button("minmax1").hide();
	w1_md3.center();
	w1_md3.setModal(true);
	if(type=='input') {
		w1_md3.attachURL(base_url+"index.php/master_barang/frm_input", true);
	} else {
		w1_md3.attachURL(base_url+"index.php/master_barang/frm_edit/"+gd_md3.getSelectedId(), true);
	}
	
	tb_w1_md3 = w1_md3.attachToolbar();
	tb_w1_md3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_md3.setSkin("dhx_terrace");
	tb_w1_md3.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_md3.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_md3.disableItem("baru");
	tb_w1_md3.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_md3 = document.frm_md3.hKp_md3.value;
			var kota_md3 = document.frm_md3.hKota_md3.value;
			document.frm_md3.reset();
			// Kantor Pusat
			IDcbKP_md3 = cbKP_md3.getIndexByValue(kp_md3);
			cbKP_md3.selectOption(IDcbKP_md3,true,true);
			// Kota
			IDcbKota_md3 = cbKota_md3.getIndexByValue(kota_md3);
			cbKota_md3.selectOption(IDcbKota_md3,true,true);
		} else if(id=='save') {
			simpan_md3();
		} else if(id=='baru') {
			tb_w1_md3.disableItem("baru");
			tb_w1_md3.enableItem("save");
			baru_md3();
		}
	});

}

function hapus_md3() {
		idselect = gd_md3.getRowIndex(gd_md3.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_md3.getSelectedId() +
				'&idbarang=' + gd_md3.cells(gd_md3.getSelectedId(),1).getValue();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result=="1") {
					gd_m13.deleteSelectedItem();
				} else {
					alert("Data tidak dapat dihapus");
				}
			});
		}
	}
	
// Window Command
wCom_md3 = dhxWins.createWindow("wCom_md3",0,0,540,540);
wCom_md3.setText("Upload");
wCom_md3.button("park").hide();
//wCom_md3.button("close").hide();
wCom_md3.button("minmax1").hide();
wCom_md3.button("close").attachEvent("onClick", function() {
		wCom_md3.hide();
		wCom_md3.setModal(false);
		return;
    });
wCom_md3.hide();

function showWinCom_md3() {
	wCom_md3.show();
    wCom_md3.setModal(true);
	wCom_md3.center();
	wCom_md3.attachObject('tmpCommand_md3');
}

function cekUpdate_md3() {
	if(document.frmUpload_md3.cekupdate.checked == true) {
		enabledFrmUpload_md3();
	} else {
		disabledFrmUpload_md3();
	}
}

function disabledFrmUpload_md3() {
	document.frmUpload_md3.nmbarang.disabled = true;
	document.frmUpload_md3.keterangan.disabled = true;
	document.frmUpload_md3.hrg_beli.disabled = true;
	document.frmUpload_md3.idsupplier.disabled = true;

	document.frmUpload_md3.idtipe_item.disabled = true;
	document.frmUpload_md3.sts_jual.disabled = true;
	document.frmUpload_md3.idmerk.disabled = true;
	document.frmUpload_md3.code_sms.disabled = true;

	document.frmUpload_md3.idjns_item.disabled = true;
	document.frmUpload_md3.sts_konsinyasi.disabled = true;
	document.frmUpload_md3.idkategori.disabled = true;
	document.frmUpload_md3.idpajak.disabled = true;

	document.frmUpload_md3.idmata_uang.disabled = true;
	document.frmUpload_md3.sts_serial.disabled = true;
	document.frmUpload_md3.idwarna.disabled = true;
	document.frmUpload_md3.barcode.disabled = true;

	document.frmUpload_md3.idrak.disabled = true;
	document.frmUpload_md3.idsat_dasar.disabled = true;
	document.frmUpload_md3.stock_minimum.disabled = true;
}

function enabledFrmUpload_md3() {
	document.frmUpload_md3.nmbarang.disabled = false;
	document.frmUpload_md3.keterangan.disabled = false;
	document.frmUpload_md3.hrg_beli.disabled = false;
	document.frmUpload_md3.idsupplier.disabled = false;

	document.frmUpload_md3.idtipe_item.disabled = false;
	document.frmUpload_md3.sts_jual.disabled = false;
	document.frmUpload_md3.idmerk.disabled = false;
	document.frmUpload_md3.code_sms.disabled = false;

	document.frmUpload_md3.idjns_item.disabled = false;
	document.frmUpload_md3.sts_konsinyasi.disabled = false;
	document.frmUpload_md3.idkategori.disabled = false;
	document.frmUpload_md3.idpajak.disabled = false;

	document.frmUpload_md3.idmata_uang.disabled = false;
	document.frmUpload_md3.sts_serial.disabled = false;
	document.frmUpload_md3.idwarna.disabled = false;
	document.frmUpload_md3.barcode.disabled = false;

	document.frmUpload_md3.idrak.disabled = false;
	document.frmUpload_md3.idsat_dasar.disabled = false;
	document.frmUpload_md3.stock_minimum.disabled = false;
}
</script>

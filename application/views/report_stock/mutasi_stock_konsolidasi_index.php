<div id="tmpTb_rsp8" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rsp8" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="483" border="0">
    <tr>
      <td width="109">Tanggal Stock Akhir</td>
      <td width="253"><span><input name="tgl2_rsp8" type="text" id="tgl2_rsp8" size="8" /></span>
        <span><img id="btnTgl2_rsp8" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
    </tr>
    
    <tr>
      <td>Tipe</td>
      <td id="tmpTipe_rsp8"></td>
    </tr>
    <tr>
      <td>Jenis</td>
      <td id="tmpJns_rsp8"></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td id="tmpKat_rsp8"></td>
    </tr>
    <tr>
      <td>Merk</td>
      <td id="tmpMerk_rsp8"></td>
    </tr>
    <tr>
      <td>Warna</td>
      <td id="tmpWarna_rsp8"></td>
    </tr>
    <tr>
      <td style="display:none;">Tampil Ukuran</td>
      <td style="display:none;"><input type="checkbox" name="tmpUkuran" id="tmpUkuran" checked="checked" /></td>
      </tr>
    <tr>
      <td style="display:none;">Grup</td>
      <td style="display:none;"><select name="grup" id="grup">
        <option value="TRANSAKSI">Transaksi</option>
        <option value="TIPE">Tipe Barang</option>
        <option value="JENIS">Jenis Barang</option>
        <option value="KATEGORI">Kategori Barang</option>
        <option value="MERK">Merk Barang</option>
        <option value="WARNA">Warna Barang</option>
      </select>      </td>
    </tr>
    <tr>
      <td>Jenis Harga</td>
      <td><select name="jnsHrg" id="jnsHrg" onchange="prosesHpp();">
        <option value="JUAL">JUAL</option>
        <?php if($this->session->userdata('type')=='KANTOR'): ?><option value="BELI">BELI</option><?php endif; ?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Hitung HPP</td>
      <td><input name="hpp" type="checkbox" id="hpp" checked="checked" disabled="disabled" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onClick="tampil_rsp8('HTML');" />
        <input type="button" name="button2" id="button2" value="TO EXCEL" onClick="tampil_rsp8('EXCEL');" /></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<script language="javascript">

cal2_rsp8 = new dhtmlXCalendarObject({
			input: "tgl2_rsp8",button: "btnTgl2_rsp8"
	});
cal2_rsp8.setDateFormat("%Y-%m-%d");

// Combo Tipe Item
var cbTI_rsp8 = new dhtmlXCombo("tmpTipe_rsp8", "cbTI_rsp8", 156);
cbTI_rsp8.enableFilteringMode(true);
cbTI_rsp8.loadXML(base_url+"index.php/master_barang/cbTipeItem");

// Combo Jenis Barang
var cbJns_rsp8 = new dhtmlXCombo("tmpJns_rsp8", "cbJns_rsp8", 156);
cbJns_rsp8.enableFilteringMode(true);
cbJns_rsp8.loadXML(base_url+"index.php/master_barang/cbJenis");

// Combo Kategori Barang
var cbKat_rsp8 = new dhtmlXCombo("tmpKat_rsp8", "cbKat_rsp8", 156);
cbKat_rsp8.enableFilteringMode(true);
cbKat_rsp8.loadXML(base_url+"index.php/master_barang/cbKategori");

// Combo Merk Barang
var cbMerk_rsp8 = new dhtmlXCombo("tmpMerk_rsp8", "cbMerk_rsp8", 156);
cbMerk_rsp8.enableFilteringMode(true);
cbMerk_rsp8.loadXML(base_url+"index.php/master_barang/cbMerk");

// Combo Warna Barang
var cbWarna_rsp8 = new dhtmlXCombo("tmpWarna_rsp8", "cbWarna_rsp8", 156);
cbWarna_rsp8.enableFilteringMode(true);
cbWarna_rsp8.loadXML(base_url+"index.php/master_barang/cbWarna");

function tampilreport_rsp8(type) {
	if(document.frm_rsp8.jnsHrg.value=='JUAL') {
		tampil_rsp8(type);	
	} else {
		if(document.frm_rsp8.hpp.checked == true) {
			hitungHpp(type);
		} else {
			tampil_rsp8(type);
		}
	}	
}

function tampil_rsp8(type) {

	if(document.frm_rsp8.tgl2_rsp8.value == "") {
		alert("Tgl Opname Tidak Boleh Kosong");
		return;
	}
	tglStock = document.frm_rsp8.tgl2_rsp8.value;
	
	if(document.frm_rsp8.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	tipe = cbTI_rsp8.getSelectedValue();
	jns = cbJns_rsp8.getSelectedValue();
	kat = cbKat_rsp8.getSelectedValue();
	merk = cbMerk_rsp8.getSelectedValue();
	warna = cbWarna_rsp8.getSelectedValue();
	jnsHrg = document.frm_rsp8.jnsHrg.value;
	hpp = 0;
	if(document.frm_rsp8.jnsHrg.value=='BELI' && document.frm_rsp8.hpp.checked==true) {
		hpp = 1;	
	}
	
	url = base_url+'index.php/report_stock/mutasi_stock_konsolidasi/'+tglStock+"/"+tipe+"/"+jns+"/"+kat+"/"+merk+"/"+warna+"/"+tmpUkuran+"/"+type+"/"+jnsHrg+"/"+hpp;
	window.open(url,'_blank');
}

function prosesHpp() {
	if(document.frm_rsp8.jnsHrg.value=='JUAL') {
		document.frm_rsp8.hpp.disabled = true;	
	} else {
		document.frm_rsp8.hpp.disabled = false;
	}
}

/* function hitungHpp(type) {
	var poststr =
			'tgl=' + document.frm_rsp8.tgl2_rsp8.value +
			'&type=' + type;
	statusLoading();
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/report_stock/hitungHPP", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		alert(result);
		statusEnding();
		//tampil_rsp8(result);
		//confirmReport(result);
		//var myVar = setInterval(function(result){ confirmReport(result)},3000);
		document.frm_rsp8.hpp.checked = false;
		tampilreport_rsp8(result);
	});
} */
</script>

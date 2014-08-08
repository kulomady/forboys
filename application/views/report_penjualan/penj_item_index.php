<div id="tmpTb_rpj4" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rpj4" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="483" border="0">
    <tr>
      <td width="109">Periode</td>
      <td width="253"><input name="tgl1_rpj4" type="text" id="tgl1_rpj4" size="8" />
      <span><img id="btnTgl1_rpj4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /> s.d <input name="tgl2_rpj4" type="text" id="tgl2_rpj4" size="8" /></span>
      <span><img id="btnTgl2_rpj4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    
    <tr>
      <td>Lokasi</td>
      <td><select name="gudangAsal" id="gudangAsal" style="width:200px;">
        <?php echo $gudang; ?>
      </select></td>
      </tr>
    <tr>
      <td>Tipe</td>
      <td id="tmpTipe_rpj4"></td>
    </tr>
    <tr>
      <td>Jenis</td>
      <td id="tmpJns_rpj4"></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td id="tmpKat_rpj4"></td>
    </tr>
    <tr>
      <td>Merk</td>
      <td id="tmpMerk_rpj4"></td>
    </tr>
    <tr>
      <td>Warna</td>
      <td id="tmpWarna_rpj4"></td>
    </tr>
    <tr>
      <td>Tampil Ukuran</td>
      <td><input type="checkbox" name="tmpUkuran" id="tmpUkuran" /></td>
      </tr>
    <tr>
      <td>Grup</td>
      <td><select name="grup" id="grup">
        <option value="TIPE">Tipe Barang</option>
        <option value="JENIS">Jenis Barang</option>
        <option value="KATEGORI">Kategori Barang</option>
        <option value="MERK">Merk Barang</option>
        <option value="WARNA">Warna Barang</option>
      </select>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onClick="tampil_rpj4('HTML');" />
        <input type="button" name="button2" id="button2" value="TO EXCEL" onClick="tampil_rpj4('EXCEL');" /></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<script language="javascript">
cal1_rpj4 = new dhtmlXCalendarObject({
			input: "tgl1_rpj4",button: "btnTgl1_rpj4"
	});
cal1_rpj4.setDateFormat("%Y-%m-%d");

cal2_rpj4 = new dhtmlXCalendarObject({
			input: "tgl2_rpj4",button: "btnTgl2_rpj4"
	});
cal2_rpj4.setDateFormat("%Y-%m-%d");

// Combo Tipe Item
var cbTI_rpj4 = new dhtmlXCombo("tmpTipe_rpj4", "cbTI_rpj4", 156);
cbTI_rpj4.enableFilteringMode(true);
cbTI_rpj4.loadXML(base_url+"index.php/master_barang/cbTipeItem");

// Combo Jenis Barang
var cbJns_rpj4 = new dhtmlXCombo("tmpJns_rpj4", "cbJns_rpj4", 156);
cbJns_rpj4.enableFilteringMode(true);
cbJns_rpj4.loadXML(base_url+"index.php/master_barang/cbJenis");

// Combo Kategori Barang
var cbKat_rpj4 = new dhtmlXCombo("tmpKat_rpj4", "cbKat_rpj4", 156);
cbKat_rpj4.enableFilteringMode(true);
cbKat_rpj4.loadXML(base_url+"index.php/master_barang/cbKategori");

// Combo Merk Barang
var cbMerk_rpj4 = new dhtmlXCombo("tmpMerk_rpj4", "cbMerk_rpj4", 156);
cbMerk_rpj4.enableFilteringMode(true);
cbMerk_rpj4.loadXML(base_url+"index.php/master_barang/cbMerk");

// Combo Warna Barang
var cbWarna_rpj4 = new dhtmlXCombo("tmpWarna_rpj4", "cbWarna_rpj4", 156);
cbWarna_rpj4.enableFilteringMode(true);
cbWarna_rpj4.loadXML(base_url+"index.php/master_barang/cbWarna");

function tampil_rpj4(type) {
	if(document.frm_rpj4.tgl1_rpj4.value == "") {
		alert("Tgl Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rpj4.tgl2_rpj4.value == "") {
		alert("Tgl Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frm_rpj4.tgl1_rpj4.value;
	tglAkhir = document.frm_rpj4.tgl2_rpj4.value;
	if(document.frm_rpj4.gudangAsal.value == "") {
		gudangAsal = 0;
	} else {
		gudangAsal = document.frm_rpj4.gudangAsal.value;
	}
	
	if(document.frm_rpj4.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	tipe = cbTI_rpj4.getSelectedValue();
	jns = cbJns_rpj4.getSelectedValue();
	kat = cbKat_rpj4.getSelectedValue();
	merk = cbMerk_rpj4.getSelectedValue();
	warna = cbWarna_rpj4.getSelectedValue();
	grup = document.frm_rpj4.grup.value;
	
	url = base_url+'index.php/report_penjualan/penj_item/'+tglAwal+"/"+tglAkhir+"/"+gudangAsal+"/"+tipe+"/"+jns+"/"+kat+"/"+merk+"/"+warna+"/"+tmpUkuran+"/"+grup;
	
	window.open(url,'_blank');
}
</script>

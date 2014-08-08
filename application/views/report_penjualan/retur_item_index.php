<div id="tmpTb_rpj5" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rpj5" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="483" border="0">
    <tr>
      <td width="109">Periode</td>
      <td width="253"><input name="tgl1_rpj5" type="text" id="tgl1_rpj5" size="8" />
      <span><img id="btnTgl1_rpj5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /> s.d <input name="tgl2_rpj5" type="text" id="tgl2_rpj5" size="8" /></span>
      <span><img id="btnTgl2_rpj5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    
    <tr>
      <td>Lokasi</td>
      <td><select name="gudangAsal" id="gudangAsal" style="width:200px;">
        <?php echo $gudang; ?>
      </select></td>
      </tr>
    <tr>
      <td>Tipe</td>
      <td id="tmpTipe_rpj5"></td>
    </tr>
    <tr>
      <td>Jenis</td>
      <td id="tmpJns_rpj5"></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td id="tmpKat_rpj5"></td>
    </tr>
    <tr>
      <td>Merk</td>
      <td id="tmpMerk_rpj5"></td>
    </tr>
    <tr>
      <td>Warna</td>
      <td id="tmpWarna_rpj5"></td>
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
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onClick="tampil_rpj5('HTML');" />
        <input type="button" name="button2" id="button2" value="TO EXCEL" onClick="tampil_rpj5('EXCEL');" /></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<script language="javascript">
cal1_rpj5 = new dhtmlXCalendarObject({
			input: "tgl1_rpj5",button: "btnTgl1_rpj5"
	});
cal1_rpj5.setDateFormat("%Y-%m-%d");

cal2_rpj5 = new dhtmlXCalendarObject({
			input: "tgl2_rpj5",button: "btnTgl2_rpj5"
	});
cal2_rpj5.setDateFormat("%Y-%m-%d");

// Combo Tipe Item
var cbTI_rpj5 = new dhtmlXCombo("tmpTipe_rpj5", "cbTI_rpj5", 156);
cbTI_rpj5.enableFilteringMode(true);
cbTI_rpj5.loadXML(base_url+"index.php/master_barang/cbTipeItem");

// Combo Jenis Barang
var cbJns_rpj5 = new dhtmlXCombo("tmpJns_rpj5", "cbJns_rpj5", 156);
cbJns_rpj5.enableFilteringMode(true);
cbJns_rpj5.loadXML(base_url+"index.php/master_barang/cbJenis");

// Combo Kategori Barang
var cbKat_rpj5 = new dhtmlXCombo("tmpKat_rpj5", "cbKat_rpj5", 156);
cbKat_rpj5.enableFilteringMode(true);
cbKat_rpj5.loadXML(base_url+"index.php/master_barang/cbKategori");

// Combo Merk Barang
var cbMerk_rpj5 = new dhtmlXCombo("tmpMerk_rpj5", "cbMerk_rpj5", 156);
cbMerk_rpj5.enableFilteringMode(true);
cbMerk_rpj5.loadXML(base_url+"index.php/master_barang/cbMerk");

// Combo Warna Barang
var cbWarna_rpj5 = new dhtmlXCombo("tmpWarna_rpj5", "cbWarna_rpj5", 156);
cbWarna_rpj5.enableFilteringMode(true);
cbWarna_rpj5.loadXML(base_url+"index.php/master_barang/cbWarna");

function tampil_rpj5(type) {
	if(document.frm_rpj5.tgl1_rpj5.value == "") {
		alert("Tgl Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rpj5.tgl2_rpj5.value == "") {
		alert("Tgl Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frm_rpj5.tgl1_rpj5.value;
	tglAkhir = document.frm_rpj5.tgl2_rpj5.value;
	if(document.frm_rpj5.gudangAsal.value == "") {
		gudangAsal = 0;
	} else {
		gudangAsal = document.frm_rpj5.gudangAsal.value;
	}
	
	if(document.frm_rpj5.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	tipe = cbTI_rpj5.getSelectedValue();
	jns = cbJns_rpj5.getSelectedValue();
	kat = cbKat_rpj5.getSelectedValue();
	merk = cbMerk_rpj5.getSelectedValue();
	warna = cbWarna_rpj5.getSelectedValue();
	grup = document.frm_rpj5.grup.value;
	
	url = base_url+'index.php/report_penjualan/retur_item/'+tglAwal+"/"+tglAkhir+"/"+gudangAsal+"/"+tipe+"/"+jns+"/"+kat+"/"+merk+"/"+warna+"/"+tmpUkuran+"/"+grup;
	
	window.open(url,'_blank');
}
</script>

<div id="tmpTb_rsp3" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rsp3" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="483" border="0">
    <tr>
      <td width="109">Tanggal Opname</td>
      <td width="253"><span><input name="tgl2_rsp3" type="text" id="tgl2_rsp3" size="8" /></span>
      <span><img id="btnTgl2_rsp3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    
    <tr>
      <td>Gudang</td>
      <td><select name="gudangAsal" id="gudangAsal" style="width:200px;">
        <?php echo $gudang; ?>
      </select></td>
      </tr>
    <tr>
      <td>Tipe</td>
      <td id="tmpTipe_rsp3"></td>
    </tr>
    <tr>
      <td>Jenis</td>
      <td id="tmpJns_rsp3"></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td id="tmpKat_rsp3"></td>
    </tr>
    <tr>
      <td>Merk</td>
      <td id="tmpMerk_rsp3"></td>
    </tr>
    <tr>
      <td>Warna</td>
      <td id="tmpWarna_rsp3"></td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onClick="tampil_rsp3('HTML');" />
        <input type="button" name="button2" id="button2" value="TO EXCEL" onClick="tampil_rsp3('EXCEL');" /></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<script language="javascript">

cal2_rsp3 = new dhtmlXCalendarObject({
			input: "tgl2_rsp3",button: "btnTgl2_rsp3"
	});
cal2_rsp3.setDateFormat("%Y-%m-%d");

// Combo Tipe Item
var cbTI_rsp3 = new dhtmlXCombo("tmpTipe_rsp3", "cbTI_rsp3", 156);
cbTI_rsp3.enableFilteringMode(true);
cbTI_rsp3.loadXML(base_url+"index.php/master_barang/cbTipeItem");

// Combo Jenis Barang
var cbJns_rsp3 = new dhtmlXCombo("tmpJns_rsp3", "cbJns_rsp3", 156);
cbJns_rsp3.enableFilteringMode(true);
cbJns_rsp3.loadXML(base_url+"index.php/master_barang/cbJenis");

// Combo Kategori Barang
var cbKat_rsp3 = new dhtmlXCombo("tmpKat_rsp3", "cbKat_rsp3", 156);
cbKat_rsp3.enableFilteringMode(true);
cbKat_rsp3.loadXML(base_url+"index.php/master_barang/cbKategori");

// Combo Merk Barang
var cbMerk_rsp3 = new dhtmlXCombo("tmpMerk_rsp3", "cbMerk_rsp3", 156);
cbMerk_rsp3.enableFilteringMode(true);
cbMerk_rsp3.loadXML(base_url+"index.php/master_barang/cbMerk");

// Combo Warna Barang
var cbWarna_rsp3 = new dhtmlXCombo("tmpWarna_rsp3", "cbWarna_rsp3", 156);
cbWarna_rsp3.enableFilteringMode(true);
cbWarna_rsp3.loadXML(base_url+"index.php/master_barang/cbWarna");

function tampil_rsp3(type) {

	if(document.frm_rsp3.tgl2_rsp3.value == "") {
		alert("Tgl Opname Tidak Boleh Kosong");
		return;
	}
	tglOpname = document.frm_rsp3.tgl2_rsp3.value;
	if(document.frm_rsp3.gudangAsal.value == "") {
		gudangAsal = 0;
	} else {
		gudangAsal = document.frm_rsp3.gudangAsal.value;
	}
	
	if(document.frm_rsp3.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	tipe = cbTI_rsp3.getSelectedValue();
	jns = cbJns_rsp3.getSelectedValue();
	kat = cbKat_rsp3.getSelectedValue();
	merk = cbMerk_rsp3.getSelectedValue();
	warna = cbWarna_rsp3.getSelectedValue();
	
	url = base_url+'index.php/report_stock/opname/'+tglOpname+"/"+gudangAsal+"/"+tipe+"/"+jns+"/"+kat+"/"+merk+"/"+warna+"/"+tmpUkuran+"/"+type;
	
	window.open(url,'_blank');
}
</script>

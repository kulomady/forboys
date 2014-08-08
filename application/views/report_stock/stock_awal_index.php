<div id="tmpTb_rsp1" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rsp1" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="483" border="0">
    <tr>
      <td width="109">Periode</td>
      <td width="253">
      		<select name="slcBln" id="slcBln">
        <?php echo $bln; ?>
        </select>
          <select name="slcThn" id="slcThn">
          	 <?php echo $thn; ?>
          </select>      </td>
      </tr>
    
    <tr>
      <td>Gudang</td>
      <td><select name="gudang" id="gudang" style="width:200px;">
        <?php echo $gudang; ?>
      </select></td>
      </tr>
    <tr>
      <td>Tipe</td>
      <td id="tmpTipe_rsp1"></td>
    </tr>
    <tr>
      <td>Jenis</td>
      <td id="tmpJns_rsp1"></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td id="tmpKat_rsp1"></td>
    </tr>
    <tr>
      <td>Merk</td>
      <td id="tmpMerk_rsp1"></td>
    </tr>
    <tr>
      <td>Warna</td>
      <td id="tmpWarna_rsp1"></td>
    </tr>
    <tr>
      <td>Tampil Ukuran</td>
      <td><input type="checkbox" name="tmpUkuran" id="tmpUkuran" /></td>
      </tr>
    <tr>
      <td>Grup</td>
      <td><select name="grup" id="grup">
        <option value="TIPE">Tipe</option>
        <option value="JENIS">Jenis</option>
        <option value="KATEGORI">Kategori</option>
        <option value="MERK">Merk</option>
        <option value="WARNA">Warna</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onclick="tampil_rsp1('HTML');" />
        <input type="button" name="button2" id="button2" value="TO EXCEL" onclick="tampil_rsp1('EXCEL');" /></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<script language="javascript">
cal1_rsp1 = new dhtmlXCalendarObject({
			input: "tgl1",button: "btnTgl1"
	});
cal1_rsp1.setDateFormat("%Y-%m-%d");

cal2_rsp1 = new dhtmlXCalendarObject({
			input: "tgl2",button: "btnTgl2"
	});
cal2_rsp1.setDateFormat("%Y-%m-%d");

// Combo Tipe Item
var cbTI_rsp1 = new dhtmlXCombo("tmpTipe_rsp1", "cbTI_rsp1", 156);
cbTI_rsp1.enableFilteringMode(true);
cbTI_rsp1.loadXML(base_url+"index.php/master_barang/cbTipeItem");

// Combo Jenis Barang
var cbJns_rsp1 = new dhtmlXCombo("tmpJns_rsp1", "cbJns_rsp1", 156);
cbJns_rsp1.enableFilteringMode(true);
cbJns_rsp1.loadXML(base_url+"index.php/master_barang/cbJenis");

// Combo Kategori Barang
var cbKat_rsp1 = new dhtmlXCombo("tmpKat_rsp1", "cbKat_rsp1", 156);
cbKat_rsp1.enableFilteringMode(true);
cbKat_rsp1.loadXML(base_url+"index.php/master_barang/cbKategori");

// Combo Merk Barang
var cbMerk_rsp1 = new dhtmlXCombo("tmpMerk_rsp1", "cbMerk_rsp1", 156);
cbMerk_rsp1.enableFilteringMode(true);
cbMerk_rsp1.loadXML(base_url+"index.php/master_barang/cbMerk");

// Combo Warna Barang
var cbWarna_rsp1 = new dhtmlXCombo("tmpWarna_rsp1", "cbWarna_rsp1", 156);
cbWarna_rsp1.enableFilteringMode(true);
cbWarna_rsp1.loadXML(base_url+"index.php/master_barang/cbWarna");

function tampil_rsp1(type) {
	if(document.frm_rsp1.slcBln.value == "") {
		alert("Periode Bulan Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rsp1.slcThn.value == "") {
		alert("Periode Tahun Tidak Boleh Kosong");
		return;
	}
	bln = document.frm_rsp1.slcBln.value;
	thn = document.frm_rsp1.slcThn.value;
	if(document.frm_rsp1.gudang.value == "") {
		gudang = 0;
	} else {
		gudang = document.frm_rsp1.gudang.value;
	}
	
	if(document.frm_rsp1.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	url = base_url+'index.php/report_stock/stock_awal/'+bln+"/"+thn+"/"+gudang+"/"+tmpUkuran;
	
	window.open(url,'_blank');
}
</script>

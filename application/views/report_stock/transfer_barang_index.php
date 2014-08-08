<div id="tmpTb_rsp1" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rsp1" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="483" border="0">
    <tr>
      <td width="109">Periode</td>
      <td width="253"><input name="tgl1_rsp1" type="text" id="tgl1_rsp1" size="8" />
      <span><img id="btnTgl1_rsp1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /> s.d <input name="tgl2_rsp1" type="text" id="tgl2_rsp1" size="8" /></span>
      <span><img id="btnTgl2_rsp1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    
    <tr>
      <td>Gudang Asal</td>
      <td><select name="gudangAsal" id="gudangAsal" style="width:200px;">
        <?php echo $gudang; ?>
      </select></td>
      </tr>
    <tr>
      <td>Gudang Tujuan</td>
      <td id="tmpTipe_rsp2"><select name="gudangTujuan" id="gudangTujuan" style="width:200px;">
        <?php echo $tujuan; ?>
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
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onClick="tampil_rsp1('HTML');" />
        <input type="button" name="button2" id="button2" value="TO EXCEL" onClick="tampil_rsp1('EXCEL');" /></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<script language="javascript">
cal1_rsp1 = new dhtmlXCalendarObject({
			input: "tgl1_rsp1",button: "btnTgl1_rsp1"
	});
cal1_rsp1.setDateFormat("%Y-%m-%d");

cal2_rsp1 = new dhtmlXCalendarObject({
			input: "tgl2_rsp1",button: "btnTgl2_rsp1"
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
	if(document.frm_rsp1.tgl1_rsp1.value == "") {
		alert("Tgl Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rsp1.tgl2_rsp1.value == "") {
		alert("Tgl Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frm_rsp1.tgl1_rsp1.value;
	tglAkhir = document.frm_rsp1.tgl2_rsp1.value;
	if(document.frm_rsp1.gudangAsal.value == "") {
		gudangAsal = 0;
	} else {
		gudangAsal = document.frm_rsp1.gudangAsal.value;
	}
	if(document.frm_rsp1.gudangTujuan.value == "") {
		gudangTujuan = 0;
	} else {
		gudangTujuan = document.frm_rsp1.gudangTujuan.value;
	}
	
	if(document.frm_rsp1.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	tipe = cbTI_rsp1.getSelectedValue();
	jns = cbJns_rsp1.getSelectedValue();
	kat = cbKat_rsp1.getSelectedValue();
	merk = cbMerk_rsp1.getSelectedValue();
	warna = cbWarna_rsp1.getSelectedValue();
	
	url = base_url+'index.php/report_stock/transfer_brg/'+tglAwal+"/"+tglAkhir+"/"+gudangAsal+"/"+gudangTujuan+"/"+tipe+"/"+jns+"/"+kat+"/"+merk+"/"+warna+"/"+tmpUkuran;
	
	window.open(url,'_blank');
}
</script>

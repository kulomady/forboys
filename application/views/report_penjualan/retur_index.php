<div id="tmpTb_rpj3" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
  <form name="frm_rpj3" method="post" action=""><fieldset><legend>Parameter</legend>
  <table width="483" border="0">
    <tr>
      <td width="109">Periode</td>
      <td width="253"><input name="tgl1" type="text" id="tgl1" size="8" />
      <span><img id="btnTgl1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /> s.d <input name="tgl2" type="text" id="tgl2" size="8" /></span>
      <span><img id="btnTgl2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    
    <tr>
      <td>Pelanggan</td>
      <td><select name="pelanggan" id="pelanggan" style="width:200px;">
      <?php echo $pelanggan; ?>
      </select>      </td>
      </tr>
    <tr>
      <td>Sales</td>
      <td><select name="sales" id="sales" style="width:200px;">
      <?php echo $sales; ?>
      </select>      </td>
      </tr>
    <tr>
      <td>Gudang</td>
      <td><select name="gudang" id="gudang" style="width:200px;">
        <?php echo $gudang; ?>
            </select></td>
      </tr>
    <tr>
      <td>Jenis Laporan</td>
      <td><select name="jnsLap" id="jnsLap" onChange="if(this.value=='REKAP') { document.frm_rpj3.tmpUkuran.disabled = true; } else { document.frm_rpj3.tmpUkuran.disabled = false; }">
        <option value="REKAP">REKAP</option>
        <option value="DETAIL">DETAIL</option>
      </select>      </td>
      </tr>
    <tr>
      <td>Tampil Ukuran</td>
      <td><input type="checkbox" name="tmpUkuran" id="tmpUkuran" disabled></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2"><input type="button" name="button" id="button" value="PREVIEW" onClick="tampil_rpj3('HTML');">
        <input type="button" name="button2" id="button2" value="TO EXCEL" onClick="tampil_rpj3('EXCEL');"></td>
      </tr>
  </table>
  </fieldset>
  </form>
</div>
<script language="javascript">
cal1_rpj3 = new dhtmlXCalendarObject({
			input: "tgl1",button: "btnTgl1"
	});
cal1_rpj3.setDateFormat("%Y-%m-%d");

cal2_rpj3 = new dhtmlXCalendarObject({
			input: "tgl2",button: "btnTgl2"
	});
cal2_rpj3.setDateFormat("%Y-%m-%d");


function tampil_rpj3(type) {
	if(document.frm_rpj3.tgl1.value == "") {
		alert("Periode Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frm_rpj3.tgl2.value == "") {
		alert("Periode Akhir Tidak Boleh Kosong");
		return;
	}
	tgl1 = document.frm_rpj3.tgl1.value;
	tgl2 = document.frm_rpj3.tgl2.value;
	if(document.frm_rpj3.pelanggan.value == "") {
		pelanggan = 0;
	} else {
		pelanggan = document.frm_rpj3.pelanggan.value;
	}
	if(document.frm_rpj3.sales.value == "") {
		sales = 0;
	} else {
		sales = document.frm_rpj3.sales.value;
	}
	if(document.frm_rpj3.gudang.value == "") {
		gudang = 0;
	} else {
		gudang = document.frm_rpj3.gudang.value;
	}
	
	if(document.frm_rpj3.tmpUkuran.checked==true) {
		tmpUkuran = 1;
	} else {
		tmpUkuran = 0;
	}
	
	url = base_url+'index.php/report_penjualan/retur/'+tgl1+"/"+tgl2+"/"+pelanggan+"/"+sales+"/"+gudang+"/"+tmpUkuran+"/"+type+"/"+document.frm_rpj3.jnsLap.value;
	
	window.open(url,'_blank');
}
</script>

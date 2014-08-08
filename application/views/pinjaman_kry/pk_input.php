<div class="frmContainer">
<form name="frm_ku1" id="frm_ku1" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Tanggal</td>
      <td width="173"><input type="text" name="tglMasuk" id="tglMasuk" readonly size="10" value="<?php if(isset($tgl)) { echo $tgl; } else { echo date("d/m/Y"); }?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="txttgl_masuk_ku1" style="cursor:pointer;" border="0" /></td>
    </tr>
    <tr>
      <td>Nama Karyawan</td>
      <td id="tmpKry_ku1"></td>
    </tr>
    <tr>
      <td>Sisa Pinjaman</td>
      <td><input type="text" name="sisaPinjaman" id="sisaPinjaman" value="<?php if(isset($sisa_pinjaman)): echo $sisa_pinjaman; endif; ?>" style="text-align:right;" disabled="disabled" /></td>
    </tr>
    <tr>
      <td>Pinjaman</td>
      <td><input type="text" name="pinjaman" id="pinjaman" value="<?php if(isset($pinjaman)): echo $pinjaman; endif; ?>" style="text-align:right;" onkeyup="hitungPinjaman_ku1();" /></td>
    </tr>
    <tr>
      <td>Total Pinjaman</td>
      <td><input type="text" name="totalPinjaman" id="totalPinjaman" value="<?php if(isset($total_pinjaman)): echo $total_pinjaman; endif; ?>" style="text-align:right;" disabled="disabled" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>">      <input type="hidden" name="ubah" id="ubah" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">

// tanggal
	cal1_ku1 = new dhtmlXCalendarObject({
			input: "tglMasuk",button: "txttgl_masuk_ku1"
	});
	cal1_ku1.setDateFormat("%d/%m/%Y");

// Combo Jenis Barang
	var cbKry_ku1 = new dhtmlXCombo("tmpKry_ku1", "cbKry_ku1", 200);
	cbKry_ku1.enableFilteringMode(true);
	cbKry_ku1.attachEvent("onChange", onChangeFunc_ku1);
	loadCbKry_ku1();
	function loadCbKry_ku1() {
		cbKry_ku1.clearAll();
		cbKry_ku1.loadXML(base_url+"index.php/pinjaman_kry/cbKaryawan",function() {
			<?php
				if(isset($idrekan)):
					echo "IDcbKry_ku1 = cbKry_ku1.getIndexByValue('".$idrekan."');";
					echo "cbKry_ku1.selectOption(IDcbKry_ku1,true,true);";
				endif;
			?>
		});
	}
	
function onChangeFunc_ku1() {
	if(document.frm_ku1.ubah.value == "") {
		var poststr =
			'idrekan=' + cbKry_ku1.getSelectedValue();
		statusLoading();
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pinjaman_kry/sisaPinjaman", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				$('#sisaPinjaman').val(result);
		});
	} else {
		document.frm_ku1.ubah.value = "";	
	}
}
	
$(function() {            
        $('#sisaPinjaman').number(true, 2); // id field txttotal dibuat number format, 2 adalah digit decimal
		$('#pinjaman').number(true, 2);
		$('#totalPinjaman').number(true, 2);
});
	
function simpan_ku1() {

 	var poststr =
			'id=' + document.frm_ku1.id.value +
            '&tglMasuk=' + document.frm_ku1.tglMasuk.value +
			'&idrekan=' + cbKry_ku1.getSelectedValue() +
			'&sisaPinjaman=' + $('#sisaPinjaman').val() +
			'&pinjaman=' + $('#pinjaman').val() +
			'&totalPinjaman=' + $('#totalPinjaman').val();
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pinjaman_kry/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_ku1();
			tb_w1_ku1.disableItem("save");
			tb_w1_ku1.disableItem("batal");
			tb_w1_ku1.enableItem("baru");
		});
}

function baru_ku1() {
	document.frm_ku1.id.value = "";
	cbKry_ku1.setComboText("");
	document.frm_ku1.tglMasuk.value = "";
	document.frm_ku1.sisaPinjaman.value = "";
	document.frm_ku1.pinjaman.value = "";
	document.frm_ku1.totalPinjaman.value = "";
}

function hitungPinjaman_ku1() {
	if(document.frm_ku1.sisaPinjaman.value == "") {
		sisa = 0;	
	} else {
		sisa = $('#sisaPinjaman').val();
	}
	if(document.frm_ku1.pinjaman.value == "") {
		pinjaman = 0;
	} else {
		pinjaman = $('#pinjaman').val();
	}
	
	total = parseInt(sisa) + parseInt(pinjaman);
	$('#totalPinjaman').val(total);
}

//document.frm_ku1.kdbank.focus();
</script>

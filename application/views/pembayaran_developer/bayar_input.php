<div class="frmContainer">
<form name="frm_mk4" id="frm_mk4" method="post" action="javascript:void(0);">
  <table width="412" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="120">No Pembayaran</td>
      <td width="193"><input name="no_bayar" type="text" id="no_bayar" readonly size="25" value="<?php if(isset($no_bayar)): echo $no_bayar; endif; ?>"><input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>"></td>
    </tr>
    <tr>
      <td>Tanggal Pembayaran</td>
      <td><input name="tgl" type="text" id="tgl" readonly size="8" value="<?php if(isset($tgl)): echo $tgl; endif; ?>" />&nbsp;<span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
    </tr>
    <tr>
      <td>Surat Pesanan</td>
      <td><input name="sp" type="text" id="sp" readonly value="<?php if(isset($sp)): echo $sp; endif; ?>" size="25" />&nbsp;<img name="btnm_mk4" id="btnakun_mk4" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_mk4();" /></td>
    </tr>
    <tr>
      <td>Nama Pemesan</td>
      <td><input name="nm_pemesan" type="text" id="nm_pemesan" readonly size="25" value="<?php if(isset($nm_pemesan)): echo $nm_pemesan; endif; ?>" /></td>
    </tr>
    <tr>
      <td>Nama Member</td>
      <td><input name="kd_member" type="hidden" id="kd_member" value="<?php if(isset($kd_member)): echo $kd_member; endif; ?>" /><input name="nm_member" type="text" id="nm_member" readonly size="25" value="<?php if(isset($nm_member)): echo $nm_member; endif; ?>" /></td>
    </tr>
    <tr>
      <td>Jumlah Pembayaran</td>
      <td><input name="jml" type="text" id="jml" style="text-align:right;" value="<?php if(isset($jml)): echo $jml; endif; ?>" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
cal1_mk4 = new dhtmlXCalendarObject({
			input: "tgl",button: "btnTg"
	});
cal1_mk4.setDateFormat("%d/%m/%Y");

	$(function() {
		$('#jml').number(true, 2);
	});

function winAkun_mk4() {
	try {
		if(w2_mk4.isHidden()==true) {
			w2_mk4.show();
			document.getElementById('frmSearchAkun').focus();
		}
		w2_mk4.bringToTop();
		return;
	} catch(e) {}
	w2_mk4 = dhxWins.createWindow("w2_mk4",0,0,550,450);
	w2_mk4.setText("Daftar Surat Pesanan");
	w2_mk4.button("park").hide();
	w2_mk4.button("minmax1").hide();
	w2_mk4.center();
	
	tb_w2_mk4 = w2_mk4.attachToolbar();
	tb_w2_mk4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w2_mk4.setSkin("dhx_terrace");
	tb_w2_mk4.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w2_mk4.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahMember(13);
		}
	});
	
	w2_mk4.attachURL(base_url+"index.php/pembayaran_developer/frm_search_sp", true);
}

function simpan_mk4() {
	if(document.frm_mk4.tgl.value==""){
		alert("Tanggal Pembayaran Tidak Boleh Kosong!");
		document.frm_mk4.tgl.focus();
		return;
	}
	
	if(document.frm_mk4.sp.value==""){
		alert("Surat Pesanan Tidak Boleh Kosong!");
		document.frm_mk4.sp.focus();
		return;
	}
	
	if(document.frm_mk4.jml.value==""){
		alert("Jumlah Pembayaran Tidak Boleh Kosong!");
		document.frm_mk4.jml.focus();
		return;
	}
	
	var jml = $('#jml').val();
 	var poststr =
			'id=' + document.frm_mk4.id.value +
            '&no_bayar=' + document.frm_mk4.no_bayar.value +
			'&tgl=' + document.frm_mk4.tgl.value +
			'&sp=' + document.frm_mk4.sp.value +
			'&kd_member=' + document.frm_mk4.kd_member.value +
			'&jml=' + jml;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pembayaran_developer/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.frm_mk4.no_bayar.value = result;
			statusEnding();
			refreshGd_mk4();
			tb_w1_mk4.disableItem("save");
			tb_w1_mk4.enableItem("baru");
		});
}

function baru_mk4() {
	document.frm_mk4.id.value = "";
	document.frm_mk4.no_bayar.value = "";
	document.frm_mk4.tgl.value = "";
	document.frm_mk4.sp.value = "";
	document.frm_mk4.nm_pemesan.value = "";
	document.frm_mk4.kd_member.value = "";
	document.frm_mk4.nm_member.value = "";
	document.frm_mk4.jml.value = "";
}
</script>
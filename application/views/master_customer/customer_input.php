<div class="frmContainer">
<form name="frm_md8" id="frm_md8" method="post" action="javascript:void(0);">
  			<table style="padding-left:15px;">
                <tr>
                	<td width="190">Kode Customer</td>
                    <td width="300"><input type="text" size="30" id="kode_pemesan" name="kode_pemesan" value="<?php if(isset($kode_pemesan)){ echo $kode_pemesan; } else { echo "[Auto]"; }?>" readonly="readonly" /><input type="hidden" size="30" id="id" name="id" value="<?php if(isset($id)): echo $id; endif;?>" /></td>
                    <td width="100">Tanggal Lahir</td>
                    <td><input type="text" id="tgl_lahir" name="tgl_lahir" size="8" readonly="readonly" value="<?php if(isset($tgl_lahir)): echo $tgl_lahir; endif;?>" />&nbsp;<span><img id="btnTg" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
                </tr>
                <tr>
                    <td>Nama Customer (Lengkap)</td>
                    <td><input type="text" size="30" id="nama_pemesan" name="nama_pemesan" value="<?php if(isset($nama_pemesan)): echo $nama_pemesan; endif;?>" /></td>
                    <td>Kode Pos</td>
                    <td><input type="text" id="pos" name="pos" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($pos)): echo $pos; endif;?>" /></td>
                </tr>
                <tr>
                	<td valign="top">Alamat</td>
                    <td><textarea name="alamat" id="alamat" cols="32" rows="2"><?php if(isset($alamat)): echo $alamat; endif;?></textarea></td>
                    <td valign="top">No. HP</td>
                    <td valign="top"><input type="text" id="tlp_hp" name="tlp_hp" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_hp)): echo $tlp_hp; endif;?>" /></td>
                </tr>
                <tr>
                	<td>No. Telp Rumah</td>
                    <td><input type="text" id="tlp_rumah" name="tlp_rumah" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_rumah)): echo $tlp_rumah; endif;?>" /></td>
                    <td>Fax</td>
                    <td><input type="text" id="fax" name="fax" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($fax)): echo $fax; endif;?>" /></td>
                </tr>
                <tr>
                	<td>No. Telp Kantor</td>
                    <td><input type="text" id="tlp_kantor" name="tlp_kantor" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_kantor)): echo $tlp_kantor; endif;?>" /></td>
                    <td>Agama</td>
                    <td><input type="text" id="agama" name="agama" value="<?php if(isset($agama)): echo $agama; endif;?>" /></td>
                </tr>
                <tr>
                	<td>No. Identitas (KTP/SIM/KIMS)</td>
                    <td><input type="text" id="identitas" name="identitas" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($identitas)): echo $identitas; endif;?>" /></td>
                    <td>No. NPWP</td>
                    <td><input type="text" size="30" id="npwp" name="npwp" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($npwp)): echo $npwp; endif;?>" /></td>
                </tr>
                <tr>
                	<td>Email</td>
                    <td><input type="text" size="30" id="email" name="email" value="<?php if(isset($email)): echo $email; endif;?>" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
</form>
</div>
<script language="javascript">
cal1_md8 = new dhtmlXCalendarObject({
			input: "tgl_lahir",button: "btnTg"
	});
cal1_md8.setDateFormat("%d/%m/%Y");

	function hanyaAngka(e, decimal) {
		var key;
		var keychar;
		 if (window.event) {
			 key = window.event.keyCode;
		 } else
		 if (e) {
			 key = e.which;
		 } else return true;
		
		//alert(key);
		keychar = String.fromCharCode(key);
		if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
			return true;
		} else 
		if ((("0123456789").indexOf(keychar) > -1)) {
			return true; 
		} else 
		if (decimal && (keychar == ".")) {
			return true; 
		} else return false; 
    }

function simpan_md8() {
	if(document.frm_md8.nama_pemesan.value==""){
		alert("Nama Customer Tidak Boleh Kosong!");
		document.frm_md8.nama_pemesan.focus();
		return;
	}
	
	if(document.frm_md8.tgl_lahir.value==""){
		alert("Tanggal Lahir Tidak Boleh Kosong!");
		document.frm_md8.tgl_lahir.focus();
		return;
	}
	
	if(document.frm_md8.identitas.value==""){
		alert("No. Identitas Tidak Boleh Kosong!");
		document.frm_md8.identitas.focus();
		return;
	}
	
	if(document.frm_md8.tlp_hp.value==""){
		alert("No. HP Tidak Boleh Kosong!");
		document.frm_md8.tlp_hp.focus();
		return;
	}
	
	if(document.frm_md8.id.value == ""){
		var postktp = 
			'no_id=' + document.frm_md8.identitas.value;
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_customer/cekNID", encodeURI(postktp), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result==0){
				simpan2_md8();
			} else {
				alert('Maaf, Customer sudah terdaftar!');
			}
		});
	} else {
		simpan2_md8();
	}
}
	
function simpan2_md8(){
	var poststr =
			'id=' + document.frm_md8.id.value +
            '&kode_customer=' + document.frm_md8.kode_pemesan.value +
			'&nama_customer=' + document.frm_md8.nama_pemesan.value +
			'&agama=' + document.frm_md8.agama.value +
			'&kodepos=' + document.frm_md8.pos.value +
			'&alamat=' + document.frm_md8.alamat.value +
			'&telp_hp=' + document.frm_md8.tlp_hp.value +
			'&telp_rumah=' + document.frm_md8.tlp_rumah.value +
			'&fax=' + document.frm_md8.fax.value +
			'&telp_kantor=' + document.frm_md8.tlp_kantor.value +
			'&tgl_lahir=' + document.frm_md8.tgl_lahir.value +
			'&identitas=' + document.frm_md8.identitas.value +
			'&npwp=' + document.frm_md8.npwp.value +
			'&email=' + document.frm_md8.email.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_customer/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.frm_md8.kode_pemesan.value = result;
			statusEnding();
			refreshGd_md8();
			tb_w1_md8.disableItem("save");
			tb_w1_md8.enableItem("baru");
		});
}

function baru_md8() {
	document.frm_md8.id.value = "";
	document.frm_md8.kode_pemesan.value = "";
	document.frm_md8.nama_pemesan.value = "";
	document.frm_md8.agama.value = "";
	document.frm_md8.pos.value = "";
	document.frm_md8.alamat.value = "";
	document.frm_md8.tlp_hp.value = "";
	document.frm_md8.tlp_rumah.value = "";
	document.frm_md8.fax.value = "";
	document.frm_md8.tlp_kantor.value = "";
	document.frm_md8.tgl_lahir.value = "";
	document.frm_md8.no_identitas.value = "";
	document.frm_md8.npwp.value = "";
	document.frm_md8.email.value = "";
}
</script>
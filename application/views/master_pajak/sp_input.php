<div class="frmContainer">
<form name="frm_md4" id="frm_md4" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode Pajak</td>
      <td width="173"><input name="kdPajak" type="text" id="kdPajak" value="<?php if(isset($kdPajak)): echo $kdPajak; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama Pajak</td>
      <td><input name="nmPajak" type="text" id="nmPajak" value="<?php if(isset($nmPajak)): echo $nmPajak; endif; ?>" size="25" /></td>
    </tr>
    <tr>
      <td>Nilai Pajak</td>
      <td><input name="nilai" type="text" id="nilai" value="<?php if(isset($nilai)): echo $nilai; endif; ?>" size="5" /></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><select name="status" id="status">
      	<option value=""></option>
        <option value="1" <?php if(isset($status) && $status == '1'): echo 'selected="selected"'; endif;?>>Aktif</option>
        <option value="0" <?php if(isset($status) && $status == '0'): echo 'selected="selected"'; endif;?>>Pasif</option>
      </select>
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>">      </td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
function simpan_md4() {
	if(document.frm_md4.kdPajak.value==""){
		alert("Kode Pajak Tidak Boleh Kosong!");
		document.frm_md4.kdPajak.focus();
		return;
	}
	
	if(document.frm_md4.nmPajak.value==""){
		alert("Nama Pajak Tidak Boleh Kosong!");
		document.frm_md4.nmPajak.focus();
		return;
	}
	
	if(document.frm_md4.nilai.value==""){
		alert("Nilai Pajak Tidak Boleh Kosong!");
		document.frm_md4.nilai.focus();
		return;
	}
	
	if(document.frm_md4.status.value==""){
		alert("Status Tidak Boleh Kosong!");
		document.frm_md4.status.focus();
		return;
	}
 	var poststr =
			'id=' + document.frm_md4.id.value +
            '&kdPajak=' + document.frm_md4.kdPajak.value +
			'&nmPajak=' + document.frm_md4.nmPajak.value +
			'&nilai=' + document.frm_md4.nilai.value +
			'&status=' + document.frm_md4.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_pajak/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md4();
			tb_w1_md4.disableItem("save");
			tb_w1_md4.disableItem("batal");
			tb_w1_md4.enableItem("baru");
		});
}

function baru_md4() {
	document.frm_md4.id.value = "";
	document.frm_md4.kdPajak.value = "";
	document.frm_md4.nmPajak.value = "";
	document.frm_md4.nilai.value = "";
	document.frm_md4.status.value = "";
}

document.frm_md4.kdPajak.focus();
</script>

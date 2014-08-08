<div class="frmContainer">
<form name="frm_md6" id="frm_md6" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode Koordinator</td>
      <td width="173"><input name="kdkoor" type="text" id="kdkoor" value="<?php if(isset($kdkoor)): echo $kdkoor; endif; ?>" size="5" mata_uang="5"></td>
    </tr>
    <tr>
      <td>Nama Koordinator</td>
      <td><input name="nmkoor" type="text" id="nmkoor" value="<?php if(isset($nmkoor)): echo $nmkoor; endif; ?>" mata_uang="25" /></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><select name="status" id="status">
      	<option value=""></option>
        <option value="1" <?php if(isset($active) && $active == '1'): echo 'selected="selected"'; endif;?>>Aktif</option>
        <option value="0" <?php if(isset($active) && $active == '0'): echo 'selected="selected"'; endif;?>>Pasif</option>
      </select>
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>">      </td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
function simpan_md6() {
	if(document.frm_md6.kdkoor.value==""){
		alert("Kode Koordinator Tidak Boleh Kosong!");
		document.frm_md6.kdkoor.focus();
		return;
	}
	
	if(document.frm_md6.nmkoor.value==""){
		alert("Nama Koordinator Tidak Boleh Kosong!");
		document.frm_md6.nmkoor.focus();
		return;
	}
	
	if(document.frm_md6.status.value==""){
		alert("Status Koordinator Tidak Boleh Kosong!");
		document.frm_md6.status.focus();
		return;
	}
	
	if(document.frm_md6.id.value==""){
	var postcek =
		'&kdkoor=' + document.frm_md6.kdkoor.value;
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_koordinator/cek", encodeURI(postcek), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result!=0){
				alert('Kode Koordinator Sudah Digunakan!');
				tb_w1_md6.disableItem("save");
				tb_w1_md6.enableItem("baru");
			} else {
				simpan2_md6();
			}
		});
	} else {
		simpan2_md6();
	}
}

function simpan2_md6(){
 	var poststr =
			'id=' + document.frm_md6.id.value +
            '&kdkoor=' + document.frm_md6.kdkoor.value +
			'&nmkoor=' + document.frm_md6.nmkoor.value +
			'&status=' + document.frm_md6.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_koordinator/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md6();
			tb_w1_md6.disableItem("save");
			tb_w1_md6.enableItem("baru");
		});
}

function baru_md6() {
	document.frm_md6.id.value = "";
	document.frm_md6.kdkoor.value = "";
	document.frm_md6.nmkoor.value = "";
	document.frm_md6.status.value = "";
	document.frm_md6.kdkoor.focus();
}

document.frm_md6.kdkoor.focus();
</script>
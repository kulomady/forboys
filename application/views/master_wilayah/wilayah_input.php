<div class="frmContainer">
<form name="frm_md7" id="frm_md7" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode Wilayah</td>
      <td width="173"><input name="kdwilayah" type="text" id="kdwilayah" value="<?php if(isset($kdwilayah)): echo $kdwilayah; endif; ?>" size="5" mata_uang="5"></td>
    </tr>
    <tr>
      <td>Nama Wilayah</td>
      <td><input name="nmwilayah" type="text" id="nmwilayah" value="<?php if(isset($nmwilayah)): echo $nmwilayah; endif; ?>" mata_uang="25" /></td>
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
function simpan_md7() {
	if(document.frm_md7.kdwilayah.value==""){
		alert("Kode Wilayah Tidak Boleh Kosong!");
		document.frm_md7.kdwilayah.focus();
		return;
	}
	
	if(document.frm_md7.nmwilayah.value==""){
		alert("Nama Wilayah Tidak Boleh Kosong!");
		document.frm_md7.nmwilayah.focus();
		return;
	}
	
	if(document.frm_md7.status.value==""){
		alert("Status Wilayah Tidak Boleh Kosong!");
		document.frm_md7.status.focus();
		return;
	}
	
	if(document.frm_md7.id.value==""){
	var postcek =
		'&kdwilayah=' + document.frm_md7.kdwilayah.value;
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_wilayah/cek", encodeURI(postcek), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result==1){
				alert('Kode Wilayah Sudah Digunakan!');
				tb_w1_md7.disableItem("save");
				tb_w1_md7.enableItem("baru");
			} else {
				simpan2_md7();
			}
		});
	} else {
		simpan2_md7();
	}
}

function simpan2_md7(){
 	var poststr =
			'id=' + document.frm_md7.id.value +
            '&kdwilayah=' + document.frm_md7.kdwilayah.value +
			'&nmwilayah=' + document.frm_md7.nmwilayah.value +
			'&status=' + document.frm_md7.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_wilayah/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md7();
			tb_w1_md7.disableItem("save");
			tb_w1_md7.enableItem("baru");
		});
}

function baru_md7() {
	document.frm_md7.id.value = "";
	document.frm_md7.kdwilayah.value = "";
	document.frm_md7.nmwilayah.value = "";
	document.frm_md7.status.value = "";
	document.frm_md7.kdwilayah.focus();
}

document.frm_md7.kdwilayah.focus();
</script>
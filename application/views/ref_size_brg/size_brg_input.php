<div class="frmContainer">
<form name="frm_md27" id="frm_md27" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode size</td>
      <td width="173"><input name="kdsize" type="text" id="kdsize" value="<?php if(isset($kdsize)): echo $kdsize; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama size</td>
      <td><input name="nmsize" type="text" id="nmsize" value="<?php if(isset($nmsize)): echo $nmsize; endif; ?>" size="25" /></td>
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
function simpan_md27() {

 	var poststr =
			'id=' + document.frm_md27.id.value +
            '&kdsize=' + document.frm_md27.kdsize.value +
			'&nmsize=' + document.frm_md27.nmsize.value +
			'&status=' + document.frm_md27.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_size_brg/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md27();
			tb_w1_md27.disableItem("save");
			tb_w1_md27.disableItem("batal");
			tb_w1_md27.enableItem("baru");
		});
}

function baru_md27() {
	document.frm_md27.id.value = "";
	document.frm_md27.kdsize.value = "";
	document.frm_md27.nmsize.value = "";
	document.frm_md27.status.value = "";
}

document.frm_md27.kdsize.focus();
</script>

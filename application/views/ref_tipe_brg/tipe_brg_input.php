<div class="frmContainer">
<form name="frm_md21" id="frm_md21" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="96">Kode Tipe</td>
      <td width="206"><input name="kdTipe" type="text" id="kdTipe" value="<?php if(isset($kdTipe)): echo $kdTipe; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama Tipe</td>
      <td><input name="nmTipe" type="text" id="nmTipe" value="<?php if(isset($nmTipe)): echo $nmTipe; endif; ?>" size="28" /></td>
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
function simpan_md21() {

 	var poststr =
			'id=' + document.frm_md21.id.value +
            '&kdTipe=' + document.frm_md21.kdTipe.value +
			'&nmTipe=' + document.frm_md21.nmTipe.value +
			'&status=' + document.frm_md21.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_tipe_brg/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md21();
			tb_w1_md21.disableItem("save");
			tb_w1_md21.disableItem("batal");
			tb_w1_md21.enableItem("baru");
		});
}

function baru_md21() {
	document.frm_md21.id.value = "";
	document.frm_md21.kdTipe.value = "";
	document.frm_md21.nmTipe.value = "";
	document.frm_md21.status.value = "";
}

document.frm_md21.kdTipe.focus();
</script>

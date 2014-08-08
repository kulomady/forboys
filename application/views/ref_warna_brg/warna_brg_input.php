<div class="frmContainer">
<form name="frm_md25" id="frm_md25" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode warna</td>
      <td width="173"><input name="kdwarna" type="text" id="kdwarna" value="<?php if(isset($kdwarna)): echo $kdwarna; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama warna</td>
      <td><input name="nmwarna" type="text" id="nmwarna" value="<?php if(isset($nmwarna)): echo $nmwarna; endif; ?>" size="25" /></td>
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
function simpan_md25() {

 	var poststr =
			'id=' + document.frm_md25.id.value +
            '&kdwarna=' + document.frm_md25.kdwarna.value +
			'&nmwarna=' + document.frm_md25.nmwarna.value +
			'&status=' + document.frm_md25.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_warna_brg/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md25();
			tb_w1_md25.disableItem("save");
			tb_w1_md25.disableItem("batal");
			tb_w1_md25.enableItem("baru");
		});
}

function baru_md25() {
	document.frm_md25.id.value = "";
	document.frm_md25.kdwarna.value = "";
	document.frm_md25.nmwarna.value = "";
	document.frm_md25.status.value = "";
}

document.frm_md25.kdwarna.focus();
</script>

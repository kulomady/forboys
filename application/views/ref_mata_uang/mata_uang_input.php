<div class="frmContainer">
<form name="frm_md28" id="frm_md28" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode mata_uang</td>
      <td width="173"><input name="kdmata_uang" type="text" id="kdmata_uang" value="<?php if(isset($kdmata_uang)): echo $kdmata_uang; endif; ?>" mata_uang="5"></td>
    </tr>
    <tr>
      <td>Nama mata_uang</td>
      <td><input name="nmmata_uang" type="text" id="nmmata_uang" value="<?php if(isset($nmmata_uang)): echo $nmmata_uang; endif; ?>" mata_uang="25" /></td>
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
function simpan_md28() {

 	var poststr =
			'id=' + document.frm_md28.id.value +
            '&kdmata_uang=' + document.frm_md28.kdmata_uang.value +
			'&nmmata_uang=' + document.frm_md28.nmmata_uang.value +
			'&status=' + document.frm_md28.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_mata_uang/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md28();
			tb_w1_md28.disableItem("save");
			tb_w1_md28.disableItem("batal");
			tb_w1_md28.enableItem("baru");
		});
}

function baru_md28() {
	document.frm_md28.id.value = "";
	document.frm_md28.kdmata_uang.value = "";
	document.frm_md28.nmmata_uang.value = "";
	document.frm_md28.status.value = "";
}

document.frm_md28.kdmata_uang.focus();
</script>

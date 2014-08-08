<div class="frmContainer">
<form name="frm_md26" id="frm_md26" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode satuan</td>
      <td width="173"><input name="kdsatuan" type="text" id="kdsatuan" value="<?php if(isset($kdsatuan)): echo $kdsatuan; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama satuan</td>
      <td><input name="nmsatuan" type="text" id="nmsatuan" value="<?php if(isset($nmsatuan)): echo $nmsatuan; endif; ?>" size="25" /></td>
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
function simpan_md26() {

 	var poststr =
			'id=' + document.frm_md26.id.value +
            '&kdsatuan=' + document.frm_md26.kdsatuan.value +
			'&nmsatuan=' + document.frm_md26.nmsatuan.value +
			'&status=' + document.frm_md26.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_satuan_brg/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md26();
			tb_w1_md26.disableItem("save");
			tb_w1_md26.disableItem("batal");
			tb_w1_md26.enableItem("baru");
		});
}

function baru_md26() {
	document.frm_md26.id.value = "";
	document.frm_md26.kdsatuan.value = "";
	document.frm_md26.nmsatuan.value = "";
	document.frm_md26.status.value = "";
}

document.frm_md26.kdsatuan.focus();
</script>

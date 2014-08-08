<div class="frmContainer">
<form name="frm_md23" id="frm_md23" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode jenis</td>
      <td width="173"><input name="kdjenis" type="text" id="kdjenis" value="<?php if(isset($kdjenis)): echo $kdjenis; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama jenis</td>
      <td><input name="nmjenis" type="text" id="nmjenis" value="<?php if(isset($nmjenis)): echo $nmjenis; endif; ?>" size="25" /></td>
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
function simpan_md23() {

 	var poststr =
			'id=' + document.frm_md23.id.value +
            '&kdjenis=' + document.frm_md23.kdjenis.value +
			'&nmjenis=' + document.frm_md23.nmjenis.value +
			'&status=' + document.frm_md23.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_jenis_brg/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md23();
			tb_w1_md23.disableItem("save");
			tb_w1_md23.disableItem("batal");
			tb_w1_md23.enableItem("baru");
		});
}

function baru_md23() {
	document.frm_md23.id.value = "";
	document.frm_md23.kdjenis.value = "";
	document.frm_md23.nmjenis.value = "";
	document.frm_md23.status.value = "";
}

document.frm_md23.kdjenis.focus();
</script>

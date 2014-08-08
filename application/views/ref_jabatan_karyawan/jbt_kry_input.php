<div class="frmContainer">
<form name="frm_md29" id="frm_md29" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode jenis</td>
      <td width="173"><input name="kdjbt" type="text" id="kdjbt" value="<?php if(isset($kdjbt)): echo $kdjbt; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama Jabatan</td>
      <td><input name="nmjbt" type="text" id="nmjbt" value="<?php if(isset($nmjbt)): echo $nmjbt; endif; ?>" size="25" /></td>
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
function simpan_md29() {

 	var poststr =
			'id=' + document.frm_md29.id.value +
            '&kdjbt=' + document.frm_md29.kdjbt.value +
			'&nmjbt=' + document.frm_md29.nmjbt.value +
			'&status=' + document.frm_md29.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_jabatan_karyawan/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md29();
			tb_w1_md29.disableItem("save");
			tb_w1_md29.disableItem("batal");
			tb_w1_md29.enableItem("baru");
		});
}

function baru_md29() {
	document.frm_md29.id.value = "";
	document.frm_md29.kdjbt.value = "";
	document.frm_md29.nmjbt.value = "";
	document.frm_md29.status.value = "";
}

document.frm_md29.kdjbt.focus();
</script>

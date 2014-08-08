<div class="frmContainer">
<form name="frm_md33" id="frm_md33" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td width="129">&nbsp;</td>
      <td width="173">&nbsp;</td>
    </tr>
    <tr>
      <td>Nama Termin</td>
      <td><input name="nmtermin" type="text" id="nmtermin" value="<?php if(isset($nmtermin)): echo $nmtermin; endif; ?>" mata_uang="25" /></td>
    </tr>
    <tr>
      <td>Jml Hari</td>
      <td><input type="text" name="jml_hari" id="jml_hari" value="<?php if(isset($jml_hari)): echo $jml_hari; endif; ?>" /></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><select name="status" id="status">
        <option value=""></option>
        <option value="1" <?php if(isset($active) && $active == '1'): echo 'selected="selected"'; endif;?>>Aktif</option>
        <option value="0" <?php if(isset($active) && $active == '0'): echo 'selected="selected"'; endif;?>>Pasif</option>
        </select>
        <input type="hidden" name="id" id="id" value="<?php if(isset($idtermin)): echo $idtermin; endif; ?>">      </td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
function simpan_md33() {

 	var poststr =
			'id=' + document.frm_md33.id.value +
			'&nmtermin=' + document.frm_md33.nmtermin.value +
			'&jml_hari=' + document.frm_md33.jml_hari.value + 
			'&status=' + document.frm_md33.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_termin_byr/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md33();
			tb_w1_md33.disableItem("save");
			tb_w1_md33.disableItem("batal");
			tb_w1_md33.enableItem("baru");
		});
}

function baru_md33() {
	document.frm_md33.id.value = "";
	document.frm_md33.nmtermin.value = "";
	document.frm_md33.jml_hari.value = "";
	document.frm_md33.status.value = "";
}

document.frm_md33.nmtermin.focus();
</script>

<div class="frmContainer">
<form name="frm_md24" id="frm_md24" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode merk</td>
      <td width="173"><input name="kdmerk" type="text" id="kdmerk" value="<?php if(isset($kdmerk)): echo $kdmerk; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama merk</td>
      <td><input name="nmmerk" type="text" id="nmmerk" value="<?php if(isset($nmmerk)): echo $nmmerk; endif; ?>" size="25" /></td>
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
function simpan_md24() {

 	var poststr =
			'id=' + document.frm_md24.id.value +
            '&kdmerk=' + document.frm_md24.kdmerk.value +
			'&nmmerk=' + document.frm_md24.nmmerk.value +
			'&status=' + document.frm_md24.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_merk_brg/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md24();
			tb_w1_md24.disableItem("save");
			tb_w1_md24.disableItem("batal");
			tb_w1_md24.enableItem("baru");
		});
}

function baru_md24() {
	document.frm_md24.id.value = "";
	document.frm_md24.kdmerk.value = "";
	document.frm_md24.nmmerk.value = "";
	document.frm_md24.status.value = "";
}

document.frm_md24.kdmerk.focus();
</script>

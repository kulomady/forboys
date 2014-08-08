<div class="frmContainer">
<form name="frm_md22" id="frm_md22" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode Kategori</td>
      <td width="173"><input name="kdKategori" type="text" id="kdKategori" value="<?php if(isset($kdKategori)): echo $kdKategori; endif; ?>" size="5"></td>
    </tr>
    <tr>
      <td>Nama Kategori</td>
      <td><input name="nmKategori" type="text" id="nmKategori" value="<?php if(isset($nmKategori)): echo $nmKategori; endif; ?>" size="25" /></td>
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
function simpan_md22() {

 	var poststr =
			'id=' + document.frm_md22.id.value +
            '&kdKategori=' + document.frm_md22.kdKategori.value +
			'&nmKategori=' + document.frm_md22.nmKategori.value +
			'&status=' + document.frm_md22.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_kategori_brg/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md22();
			tb_w1_md22.disableItem("save");
			tb_w1_md22.disableItem("batal");
			tb_w1_md22.enableItem("baru");
		});
}

function baru_md22() {
	document.frm_md22.id.value = "";
	document.frm_md22.kdKategori.value = "";
	document.frm_md22.nmKategori.value = "";
	document.frm_md22.status.value = "";
}

document.frm_md22.kdKategori.focus();
</script>

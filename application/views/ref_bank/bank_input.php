<div class="frmContainer">
<form name="frm_md30" id="frm_md30" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode Bank</td>
      <td width="173"><input name="kdbank" type="text" id="kdbank" value="<?php if(isset($kdbank)): echo $kdbank; endif; ?>" size="5" mata_uang="5"></td>
    </tr>
    <tr>
      <td>Nama Bank</td>
      <td><input name="nmbank" type="text" id="nmbank" value="<?php if(isset($nmbank)): echo $nmbank; endif; ?>" mata_uang="25" /></td>
    </tr>
    <tr>
      <td>No.Rek</td>
      <td><input type="text" name="norek" id="norek" value="<?php if(isset($norek)): echo $norek; endif; ?>" /></td>
    </tr>
    <tr>
      <td>Atas Nama</td>
      <td><input type="text" name="atas_nama" id="atas_nama" value="<?php if(isset($atas_nama)): echo $atas_nama; endif; ?>" /></td>
    </tr>
    <tr>
      <td>Cabang</td>
      <td><input type="text" name="cabang" id="cabang" value="<?php if(isset($cabang)): echo $cabang; endif; ?>" /></td>
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
function simpan_md30() {

 	var poststr =
			'id=' + document.frm_md30.id.value +
            '&kdbank=' + document.frm_md30.kdbank.value +
			'&nmbank=' + document.frm_md30.nmbank.value +
			'&norek=' + document.frm_md30.norek.value +
			'&atas_nama=' + document.frm_md30.atas_nama.value +
			'&cabang=' + document.frm_md30.cabang.value +
			'&status=' + document.frm_md30.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_bank/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md30();
			tb_w1_md30.disableItem("save");
			tb_w1_md30.disableItem("batal");
			tb_w1_md30.enableItem("baru");
		});
}

function baru_md30() {
	document.frm_md30.id.value = "";
	document.frm_md30.kdbank.value = "";
	document.frm_md30.nmbank.value = "";
	document.frm_md30.norek.value = "";
	document.frm_md30.atas_nama.value = "";
	document.frm_md30.cabang.value = "";
	document.frm_md30.status.value = "";
}

document.frm_md30.kdbank.focus();
</script>

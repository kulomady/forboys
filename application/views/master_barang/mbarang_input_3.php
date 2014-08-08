<div class="frmContainer">
<form action="<?php echo base_url()."index.php/master_barang/uploadFoto"; ?>" method="post" enctype="multipart/form-data" name="frm3_md3" target="tmpFoto">
  <table width="432" border="0">
    <tr>
      <td width="94">Pilih Gambar</td>
      <td width="328"><input type="file" name="gambar" id="gambar">
        <input type="submit" name="btnUpload" id="btnUpload" value="UPLOAD" /></td>
    </tr>
    <tr>
      <td height="175" colspan="2" style="border:1px solid #999999;" id="tmpFrame"><iframe id="tmpFoto" name="tmpFoto" width="300px" height="150px" style="border:0px;" src="<?php if(isset($gambar)): echo $gambar; endif;?>"></iframe></td>
      </tr>
    <tr>
      <td colspan="2"><input type="button" name="button" id="button" value="Hapus Gambar" onclick="hapusFoto();" />
        <input name="hpsFoto" type="hidden" id="hpsFoto" value="" />
        <input type="hidden" name="nmfile" id="nmfile" value="<?php if(isset($nmfile)): echo $nmfile; endif; ?>" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">

function hapusFoto() {
	/* poststr =
		'gambar=' + document.frm3_md3.gambar.value +
		'&txtKdItem=' + document.frm1_md3.txtKdItem.value;
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/hapusFoto", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText; */
		document.getElementById("tmpFrame").innerHTML = '<iframe id="tmpFoto" name="tmpFoto" width="300px" height="150px" style="border:0px;"></iframe>';
		document.frm3_md3.hpsFoto.value = document.frm3_md3.nmfile.value;
	//});
}
</script>


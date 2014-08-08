<div id="tmpTb_pd6" style="background-color:#B8E0F5; height:100%; padding:3px; padding-bottom:0px;">
  <form id="frm_pd6" name="frm_pd6" method="post" action="javascript:void(0);">
    <table width="460" border="0">
      <tr>
        <td colspan="3">Tutup Persediaan Akan Membuat Stock Awal Bulan Berikutnya.</td>
      </tr>
      <tr>
        <td width="75">Periode</td>
        <td width="180"><select name="slcBln" id="slcBln">
      	<option value="<?php echo $bln; ?>"><?php echo $this->msistem->bulannya($bln); ?></option>
        </select>
          <select name="slcThn" id="slcThn">
          	 <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
          </select></td>
        <td width="191">&nbsp;</td>
      </tr>
      <tr>
        <td><input type="button" name="button" id="button" value="TUTUP" onclick="tutupPersediaan();" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<script language="javascript">

function tutupPersediaan() {

	// Proses Simpan
 	var poststr =
			'bln=' + document.frm_pd6.slcBln.value +
            '&thn=' + document.frm_pd6.slcThn.value;
		statusLoading();
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/tutup_persediaan/tutupStock", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			alert(result);
		});
}

</script>

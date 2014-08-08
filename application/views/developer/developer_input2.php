<div class="frmContainer">
<table>
	<tr>
    	<td>
<fieldset>
	<legend>Primary</legend>
  <table border="0" align="center">
    <tr>
      <td width="115">Komisi Marketing</td>
      <td width="80"><input name="marketing_new" type="text" id="marketing_new" style="text-align:right;" value="<?php if(isset($marketing_new)): echo $marketing_new; endif; ?>" size="5">&nbsp;%</td>
      <td width="120">Komisi Koordinator</td>
      <td width="80"><input name="koor_new" type="text" id="koor_new" style="text-align:right;" value="<?php if(isset($koor_new)): echo $koor_new; endif; ?>" size="5" />        &nbsp;%</td>
      <td width="100">Komisi Kantor</td>
      <td width="80"><input name="kantor_new" type="text" id="kantor_new" style="text-align:right;" value="<?php if(isset($kantor_new)): echo $kantor_new; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
  </table>
</fieldset>
	</td>
</tr>
<tr>
    <td>
<fieldset>
	<legend>Secondary</legend>
  <table width="" border="0" align="center">
    <tr>
      <td width="120">Komisi Listing</td>
      <td width="80"><input name="listing_sec" type="text" id="listing_sec" style="text-align:right;" value="<?php if(isset($listing_sec)): echo $listing_sec; endif; ?>" size="5">&nbsp;%</td>
      <td width="120">Komisi Selling</td>
      <td width="80"><input name="selling_sec" type="text" id="selling_sec" style="text-align:right;" value="<?php if(isset($selling_sec)): echo $selling_sec; endif; ?>" size="5" />&nbsp;%</td>
      <td width="100">Komisi Kantor</td>
      <td width="80"><input name="kantor_sec" type="text" id="kantor_sec" style="text-align:right;" value="<?php if(isset($kantor_sec)): echo $kantor_sec; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
      <td>Komisi Koor Listing</td>
      <td><input name="klisting_sec" type="text" id="klisting_sec" style="text-align:right;" value="<?php if(isset($klisting_sec)): echo $klisting_sec; endif; ?>" size="5" />&nbsp;%</td>
      <td>Komisi Koor Selling</td>
      <td><input name="kselling_sec" type="text" id="kselling_sec" style="text-align:right;" value="<?php if(isset($kselling_sec)): echo $kselling_sec; endif; ?>" size="5" />&nbsp;%</td>
      <td>Komisi Reward</td>
      <td><input name="reward_sec" type="text" id="reward_sec" style="text-align:right;" value="<?php if(isset($reward_sec)): echo $reward_sec; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
       <td>Komisi Koordinator</td>
      <td><input name="koor_sec" type="text" id="koor_sec" style="text-align:right;" value="<?php if(isset($koor_sec)): echo $koor_sec; endif; ?>" size="5" />&nbsp;%</td>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>
</fieldset>
	</td>
  </tr>
</table>
</div>
<script language="javascript">
<?php if(!isset($marketing_new)){ ?>baru_md52();<?php } ?>
function baru_md52(){
	document.frm_md5.marketing_new.value = "0";
	document.frm_md5.kantor_new.value = "0";
	document.frm_md5.koor_new.value = "0";
	
	document.frm_md5.listing_sec.value = "0";
	document.frm_md5.kantor_sec.value = "0";
	document.frm_md5.selling_sec.value = "0";
	document.frm_md5.reward_sec.value = "0";
	document.frm_md5.kselling_sec.value = "0";
	document.frm_md5.klisting_sec.value = "0";
	document.frm_md5.koor_sec.value = "0";
}
</script>
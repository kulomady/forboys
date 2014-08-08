<div class="frmContainer">
<table border="0">
	<tr>
    	<td>
<fieldset>
	<legend>Jaringan</legend>
    <table width="295" border="0" align="center">
    <tr>
      <td width="139">Komisi Upline 1</td>
      <td width="113"><input name="upline1" type="text" id="upline1" style="text-align:right;" value="<?php if(isset($upline1)): echo $upline1; endif; ?>" size="5">&nbsp;%</td>
    </tr>
    <tr>
      <td>Komisi Upline 2</td>
      <td><input name="upline2" type="text" id="upline2" style="text-align:right;" value="<?php if(isset($upline2)): echo $upline2; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
      <td>Komisi Upline 3</td>
      <td><input name="upline3" type="text" id="upline3" style="text-align:right;" value="<?php if(isset($upline3)): echo $upline3; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
      <td>Komisi Upline 4</td>
      <td><input name="upline4" type="text" id="upline4" style="text-align:right;" value="<?php if(isset($upline4)): echo $upline4; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
      <td>Komisi Upline 5</td>
      <td><input name="upline5" type="text" id="upline5" style="text-align:right;" value="<?php if(isset($upline5)): echo $upline5; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
  </table>
</fieldset>
</td>
<td>
<fieldset>
	<legend>Bonus</legend>
    <table width="295" border="0" align="center">
    <tr>
      <td width="139">Komisi 15 Org Line</td>
      <td width="113"><input name="l15org" type="text" id="l15org" style="text-align:right;" value="<?php if(isset($l15org)): echo $l15org; endif; ?>" size="5">&nbsp;%</td>
    </tr>
    <tr>
      <td>Komisi 5 Org (5 Miliar)</td>
      <td><input name="l5org" type="text" id="l5org" style="text-align:right;" value="<?php if(isset($l5org)): echo $l5org; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
      <td>Komisi 35 Org Line</td>
      <td><input name="l35org" type="text" id="l35org" style="text-align:right;" value="<?php if(isset($l35org)): echo $l35org; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
    	<td>Point</td>
        <td><input type="text" id="point" name="point" style="text-align:right;" value="<?php if(isset($point)): echo $point; endif; ?>" size="5" ></td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td><input type="hidden"></td>
    </tr>
  </table>
</fieldset>
</td>
</tr>
</table>
</div>
<script language="javascript">
<?php if(!isset($upline1)){ ?>baru_md53();<?php } ?>
function baru_md53(){
	document.frm_md5.upline1.value = "0";
	document.frm_md5.upline2.value = "0";
	document.frm_md5.upline3.value = "0";
	document.frm_md5.upline4.value = "0";
	document.frm_md5.upline5.value = "0";
	
	document.frm_md5.l15org.value = "0";
	document.frm_md5.l5org.value = "0";
	document.frm_md5.l35org.value = "0";
	document.frm_md5.point.value = "0";
}
</script>
<script>

tabbar_md5 = new dhtmlXTabBar("a_tabbar_md5", "top");
tabbar_md5.setSkin('dhx_skyblue');
tabbar_md5.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
//tabbar_md5.addTab("a1", "Master Data", "100px");
tabbar_md5.addTab("a2", "Komisi", "110px");
tabbar_md5.addTab("a3", "Jaringan", "110px");
tabbar_md5.setHrefMode("ajax-html");
<?php if(!isset($id)) { ?>
//tabbar_md5.setContentHref("a1", "<?php echo base_url(); ?>index.php/master_developer/frm_input_1");
tabbar_md5.setContentHref("a2", "<?php echo base_url(); ?>index.php/master_developer/frm_input_2");
tabbar_md5.setContentHref("a3", "<?php echo base_url(); ?>index.php/master_developer/frm_input_3");
<?php } else { ?>
//tabbar_md5.setContentHref("a1", "<?php echo base_url(); ?>index.php/master_developer/frm_edit_1/<?//php echo $id ?>");
tabbar_md5.setContentHref("a2", "<?php echo base_url(); ?>index.php/master_developer/frm_edit_2/<?php echo $id ?>"); 
tabbar_md5.setContentHref("a3", "<?php echo base_url(); ?>index.php/master_developer/frm_edit_3/<?php echo $id ?>");    
<?php } ?>    
//tabbar_md5.setTabActive("a1");
tabbar_md5.setTabActive("a2");
tabbar_md5.setTabActive("a3");
tabbar_md5.setTabActive("a2");
</script>
<div class="frmContainer">
<form name="frm_md5" id="frm_md5" method="post" action="javascript:void(0);">
  <table width="670" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="129">Kode Developer</td>
      <td width="133"><input name="kddeveloper" type="text" id="kddeveloper" value="<?php if(isset($kddeveloper)): echo $kddeveloper; endif; ?>" size="5"><input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>"></td>
      <td width="129">Komisi</td>
      <td width="133"><input name="komisi" type="text" id="komisi" style="text-align:right;" value="<?php if(isset($komisi)): echo $komisi; endif; ?>" size="5" />&nbsp;%</td>
    </tr>
    <tr>
      <td>Nama Developer</td>
      <td><input name="nmdeveloper" type="text" id="nmdeveloper" value="<?php if(isset($nmdeveloper)): echo $nmdeveloper; endif; ?>" size="25" /></td>
      <td>Status</td>
      <td><select name="status" id="status">
      	<option value=""></option>
        <option value="1" <?php if(isset($active) && $active == '1'): echo 'selected="selected"'; endif;?>>Aktif</option>
        <option value="0" <?php if(isset($active) && $active == '0'): echo 'selected="selected"'; endif;?>>Pasif</option>
      </select></td>
    </tr>
    <tr>
      <td>Jenis Developer</td>
      <td><select name="jns" id="jns">
      	<option value=""></option>
        <option value="1" <?php if(isset($jns) && $jns == '1'): echo 'selected="selected"'; endif;?>>Apartemen</option>
        <option value="0" <?php if(isset($jns) && $jns == '0'): echo 'selected="selected"'; endif;?>>Landed</option>
      </select></td>
    </tr>
  </table>
<br />
<table width="670">
  <tr>
    <td><div id="a_tabbar_md5" style="width:670px; height:590px;"/></td>
  </tr>
</table>
</div>
</form>
<script language="javascript">
function simpan_md5() {
	var poststr =
			'id=' + document.frm_md5.id.value +
            '&kddeveloper=' + document.frm_md5.kddeveloper.value +
			'&nmdeveloper=' + document.frm_md5.nmdeveloper.value +
			'&komisi=' + document.frm_md5.komisi.value +
			'&status=' + document.frm_md5.status.value +
			'&jns=' + document.frm_md5.jns.value +
			'&marketing_new=' + document.frm_md5.marketing_new.value +
			'&kantor_new=' + document.frm_md5.kantor_new.value +
			'&koor_new=' + document.frm_md5.koor_new.value +
			'&listing_sec=' + document.frm_md5.listing_sec.value +
			'&kantor_sec=' + document.frm_md5.kantor_sec.value +
			'&selling_sec=' + document.frm_md5.selling_sec.value +
			'&reward_sec=' + document.frm_md5.reward_sec.value +
			'&kselling_sec=' + document.frm_md5.kselling_sec.value +
			'&klisting_sec=' + document.frm_md5.klisting_sec.value +
			'&koor_sec=' + document.frm_md5.koor_sec.value +
			'&upline1=' + document.frm_md5.upline1.value +
			'&upline2=' + document.frm_md5.upline2.value +
			'&upline3=' + document.frm_md5.upline3.value +
			'&upline4=' + document.frm_md5.upline4.value +
			'&upline5=' + document.frm_md5.upline5.value +
			'&l15org=' + document.frm_md5.l15org.value +
			'&l5org=' + document.frm_md5.l5org.value +
			'&l35org=' + document.frm_md5.l35org.value +
			'&point=' + document.frm_md5.point.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_developer/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md5();
			tb_w1_md5.disableItem("save");
			tb_w1_md5.enableItem("baru");
		});
}
document.frm_md5.kddeveloper.focus();
<?php if(!isset($kddeveloper)){ ?>baru_md5();<?php } ?>
function baru_md5() {
	document.frm_md5.id.value = "";
	document.frm_md5.kddeveloper.value = "";
	document.frm_md5.nmdeveloper.value = "";
	document.frm_md5.komisi.value = "0";
	document.frm_md5.status.value = "";
}
</script>
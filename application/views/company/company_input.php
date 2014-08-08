<script>

tabbar_pg2 = new dhtmlXTabBar("a_tabbar_pg2", "top");
tabbar_pg2.setSkin('dhx_skyblue');
tabbar_pg2.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
tabbar_pg2.addTab("a1", "Data Umum", "100px");
tabbar_pg2.addTab("a2", "Akuntansi", "110px");
tabbar_pg2.setHrefMode("ajax-html");
<?php if(!isset($id)) { ?>
tabbar_pg2.setContentHref("a1", "<?php echo base_url(); ?>index.php/company/frm_input_1");
tabbar_pg2.setContentHref("a2", "<?php echo base_url(); ?>index.php/company/frm_input_2");
<?php } else { ?>
tabbar_pg2.setContentHref("a1", "<?php echo base_url(); ?>index.php/company/frm_edit_1/<?php echo $id ?>");
tabbar_pg2.setContentHref("a2", "<?php echo base_url(); ?>index.php/company/frm_edit_2/<?php echo $id ?>");    
<?php } ?>    
tabbar_pg2.setTabActive("a1");
tabbar_pg2.setTabActive("a2");
tabbar_pg2.setTabActive("a1");

function winAkun_pg2(idx) { 
        input = 'txt'+idx;
        text = 'tmp'+idx;
//        alert(input+"|"+text);
	try {
		if(w2_pg2.isHidden()==true) {
			w2_pg2.show();
			document.getElementById('frmSearchAkun').focus();
		}
		w2_pg2.bringToTop();
		return;
	} catch(e) {}
	w2_pg2 = dhxWins.createWindow("w2_pg2",0,0,430,450);
	w2_pg2.setText("Daftar Perkiraan");
	w2_pg2.button("park").hide();
	w2_pg2.button("minmax1").hide();
	w2_pg2.center();
	
	tb_w2_pg2 = w2_pg2.attachToolbar();
	tb_w2_pg2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w2_pg2.setSkin("dhx_terrace");
	tb_w2_pg2.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w2_pg2.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahAkun_pg2(13,input,text);
		}
	});
	
	w2_pg2.attachURL(base_url+"index.php/company/frm_search_akun", true);
}

</script>
<table width="803" border="0">
  <tr>
    <td><div id="a_tabbar_pg2" style="width:1000px; height:520px;"/></td>
  </tr>
  <tr>
    <td><div id="tmpGridSize_md" style="height:220px; width:773px;"></div></td>
  </tr>
  <tr>
    <td><input type="button" name="button" id="button" value="HAPUS"></td>
  </tr>
</table>

<div class="frmContainer">
<form name="frm_pr8" method="post" action="javascript:void(0);">
  <table width="443" border="0" align="center">
    <tr>
      <td width="121">Tanggal</td>
      <td colspan="2"><input name="txttgl_pr8" type="text" id="txttgl_pr8" size="8" value="<?php if(isset($txttgl)) { echo $txttgl; } else { echo date("d/m/Y"); } ?>" readonly="readonly" />
        <span><img id="btntgl_pr8" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" />
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif;?>" />
        </span></td>
    </tr>
    <tr>
      <td>Cabang</td>
      <td colspan="2"><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
        <?php echo $gudang; ?>
      </select></td>
    </tr>
    <tr>
      <td>Kode Akun Kas</td>
      <td width="94"><input name="kdakunKas" type="text" id="kdakunKas" size="8" value="<?php if(isset($idperkiraan_kas)): echo $idperkiraan_kas; endif;?>" />
        <img name="btnakunKas_pr8" id="btnakunKas_pr8" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkunKas_pr8();" /></td>
      <td width="214" id="tmpNmPerkiraanKas_pr8"><?php if(isset($nmperkiraan_kas)): echo $nmperkiraan_kas; endif;?></td>
    </tr>
    <tr>
      <td>Kode Akun Biaya</td>
      <td><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
        <img name="btnakun_pr8" id="btnakun_pr8" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pr8();" /></td>
      <td id="tmpNmPerkiraan_pr8"><?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?></td>
    </tr>
    <tr>
      <td>Project Order</td>
      <td colspan="2"><select name="po" id="po">
      <?php echo $pilihPO; ?>
      </select></td>
    </tr>
    <tr>
      <td>Keperluan</td>
      <td colspan="2"><input type="text" name="keperluan" id="keperluan" value="<?php if(isset($keperluan)): echo $keperluan; endif;?>" /></td>
    </tr>
    <tr>
      <td>Jumlah Biaya</td>
      <td colspan="2"><input name="jml" type="text" id="jml" style="text-align:right;" value="<?php if(isset($jml_biaya)): echo $jml_biaya; endif;?>"></td>
    </tr>
    <tr>
      <td valign="top">Keterangan</td>
      <td colspan="2"><textarea name="ket" id="ket" cols="20" rows="2"><?php if(isset($keterangan)): echo $keterangan; endif;?></textarea></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
cal1_pg2 = new dhtmlXCalendarObject({
		input: "txttgl_pr8",button: "btntgl_pr8"
});
cal1_pg2.setDateFormat("%d/%m/%Y");

$(function() {         
	$('#jml').number(true, 2);
});

function baru_pr8() {
	document.frm_pr8.slcOutlet_id.value = "";
	document.frm_pr8.txttgl_pr8.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_pr8.kdakunKas.value = "";
	document.frm_pr8.kdakun.value = "";	
	document.frm_pr8.po.value = "";
	document.frm_pr8.jml.value = "";
	document.frm_pr8.keperluan.value = "";
	document.frm_pr8.ket.value = "";
	document.getElementById('tmpNmPerkiraanKas_pr8').innerHTML = "";
	document.getElementById('tmpNmPerkiraan_pr8').innerHTML = "";
}

function winAkunKas_pr8() {
		try {
			if(w2_pr8.isHidden()==true) {
				w2_pr8.show();
				document.getElementById('frmSearchAkunKas_pr8').focus();
			}
			w2_pr8.bringToTop();
			return;
		} catch(e) {}
		w2_pr8 = dhxWins.createWindow("w2_pr8",0,0,430,450);
		w2_pr8.setText("Daftar Perkiraan Kas");
		w2_pr8.button("park").hide();
		w2_pr8.button("minmax1").hide();
		w2_pr8.center();
		
		tb_w2_pr8 = w2_pr8.attachToolbar();
		tb_w2_pr8.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pr8.setSkin("dhx_terrace");
		tb_w2_pr8.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pr8.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahAkun_pr8(13);
			}
		});
		
		w2_pr8.attachURL(base_url+"index.php/prod_operational/frm_search_akun_kas", true);
}

function winAkun_pr8() {
		try {
			if(w3_pr8.isHidden()==true) {
				w3_pr8.show();
				document.getElementById('frmSearchAkun_pr8').focus();
			}
			w3_pr8.bringToTop();
			return;
		} catch(e) {}
		w3_pr8 = dhxWins.createWindow("w3_pr8",0,0,430,450);
		w3_pr8.setText("Daftar Perkiraan");
		w3_pr8.button("park").hide();
		w3_pr8.button("minmax1").hide();
		w3_pr8.center();
		
		tb_w3_pr8 = w3_pr8.attachToolbar();
		tb_w3_pr8.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w3_pr8.setSkin("dhx_terrace");
		tb_w3_pr8.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w3_pr8.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahAkun_pr8(13);
			}
		});
		
		w3_pr8.attachURL(base_url+"index.php/prod_operational/frm_search_akun", true);
}



function simpan_pr8(){
		
		if(document.frm_pr8.txttgl_pr8.value == ""){
			alert("Tanggal Tidak Boleh Kosong !");
			document.frm_pr8.txttgl_pr8.focus();
			return;
		}
		
		if(document.frm_pr8.kdakunKas.value == ""){
			alert("Kode Akun Kas Tidak Boleh Kosong !");
			document.frm_pr8.kdakunKas.focus();
			return;
		}
		
		if(document.frm_pr8.kdakun.value == ""){
			alert("Kode Akun Biaya Tidak Boleh Kosong !");
			document.frm_pr8.kdakun.focus();
			return;
		}
		
		if(document.frm_pr8.jml.value == "" || document.frm_pr8.jml.value < 1){
			alert("Total Bayar Tidak Boleh Kosong !");
			document.frm_pr8.jml.focus();
			return;
		}
		
		var totalBayar = $('#jml').val();
		var postpr8 = 
			'id=' + document.frm_pr8.id.value +
			'&outlet_id=' + document.frm_pr8.slcOutlet_id.value +
			'&tgl=' + document.frm_pr8.txttgl_pr8.value +
			'&kdakunKas=' + document.frm_pr8.kdakunKas.value +
			'&kdakun=' + document.frm_pr8.kdakun.value +
			'&idjo=' + document.frm_pr8.po.value +
			'&keperluan=' + document.frm_pr8.keperluan.value + 
			'&totalBayar=' + totalBayar +
			'&ket=' + document.frm_pr8.ket.value;
			
		statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/prod_operational/simpan", encodeURI(postpr8), function(loader) {
			result = loader.xmlDoc.responseText;
			alert(result);
			statusEnding();
			refreshGd_pr8();	
		});			
	}
</script>

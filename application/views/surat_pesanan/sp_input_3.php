<style>
	legend {
		font-weight:bold;
	}
	body {
		background-color: #FFFFCC;
	}
</style>
<div class="frmContainer"><br>
<form name="frm_mk33" id="frm_mk33" method="post" action="javascript:void(0);">
    <fieldset>
    	<legend>TANDA TERIMA:</legend>
        <table>    
            <tr>
            	<td>Pemesan menyatakan telah membayar sebesar: Rp. <input type="text" name="tanda_terima" id="tanda_terima" style="text-align:right;" value="<?php if(isset($tanda_terima)): echo $tanda_terima; endif;?>"/> dalam bentuk :</td>
            </tr>
            <tr>
            	<td><input type="radio" id="tunai_tt" name="tunai_tt" value="tunai" <?php if(isset($chec_tt)){ if($chec_tt=='tunai_tt'){ echo 'checked="checked"'; } }?> /> Tunai &nbsp;
                <input type="radio" id="credit_cart_tt" name="chec_tt" value="credit_cart_tt" onchange="check_credit();" <?php if(isset($chec_tt)){ if($chec_tt=='credit_cart'){ echo 'checked="checked"'; } }?> /> Credit Cart No. &nbsp;
                <input type="text" id="txt_no_credit" name="txt_no_credit" disabled="disabled" value="<?php if(isset($txt_no_credit)): echo $txt_no_credit; endif;?>"/></td>
           	</tr>
            <tr>
            	<td><input type="radio" id="setor_tt" name="chec_tt" value="setor_tt" onchange="check_setor();" <?php if(isset($chec_tt)){ if($chec_tt=='setor_tt'){ echo 'checked="checked"'; } }?> /> Setor/Transfer: &nbsp;&nbsp;
                Bank &nbsp;<input type="text" id="setor_bank" name="setor_bank" disabled="disabled" value="<?php if(isset($setor_bank)): echo $setor_bank; endif;?>"/> &nbsp;&nbsp;
                Tanggal &nbsp;<input type="text" id="setor_tgl" name="setor_tgl" size="8" readonly="readonly" disabled="disabled" value="<?php if(isset($setor_tgl)): echo $setor_tgl; endif;?>"/>&nbsp;<span><img id="btnTg_setor" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;"/></span>&nbsp;&nbsp;
                No. Slip &nbsp;<input type="text" id="setor_no" name="setor_no" disabled value="<?php if(isset($setor_no)): echo $setor_no; endif;?>"/></td>
           	</tr>
            <tr>
            	<td><input type="radio" id="lain_tt" name="chec_tt" value="lain_tt" onchange="check_lain_tt();" <?php if(isset($chec_tt)){ if($chec_tt=='lain_tt'){ echo 'checked="checked"'; } }?> /> Lainnya &nbsp;
                <input type="text" id="txt_lain_tt" name="txt_lain_tt" disabled="disabled" value="<?php if(isset($txt_lain_tt)): echo $txt_lain_tt; endif;?>" />
            </tr>
      	</table>
   	</fieldset>
    <fieldset>
    	<legend>MARKETING:</legend>
        <table>    
            <tr>
            	<td width="100">Koor Selling</td>
                <td width="300"><input type="hidden" id="koor_selling" name="koor_selling" readonly="readonly" value="<?php if(isset($koor_selling)): echo $koor_selling; endif;?>" /><input type="text" size="30"  id="nmkoor_selling" onfocus="winKOSL_mk3();" disabled="disabled" name="nmkoor_selling" readonly="readonly" value="<?php if(isset($nmkoor_selling)): echo $nmkoor_selling; endif;?>" /></td>
                <td width="50">Selling</td>
                <td width="300"><input type="hidden" id="selling" name="selling" readonly="readonly" value="<?php if(isset($selling)): echo $selling; endif;?>" /><input type="text" id="nm_selling" name="nm_selling" size="30" onfocus="winSL_mk3();" disabled="disabled" readonly="readonly" value="<?php if(isset($nm_selling)): echo $nm_selling; endif;?>" /></td>
            </tr>
            <tr>
            	<td>Koor Listing</td>
                <td><input type="hidden" id="koor_listing" name="koor_listing" onmousedown="" readonly="readonly" value="<?php if(isset($koor_listing)): echo $koor_listing; endif;?>" /><input type="text" size="30"  id="nmkoor_listing" onfocus="winKOLS_mk3();" disabled="disabled" name="nmkoor_listing" readonly="readonly" value="<?php if(isset($nmkoor_listing)): echo $nmkoor_listing; endif;?>" /></td>
                <td>Listing</td>
                <td><input type="hidden" id="listing" name="listing" readonly="readonly" value="<?php if(isset($listing)): echo $listing; endif;?>" /><input type="text" id="nm_listing" name="nm_listing" size="30" readonly="readonly" onfocus="winLS_mk3();" disabled="disabled" value="<?php if(isset($nm_listing)): echo $nm_listing; endif;?>" /></td>
            </tr>
      	</table>
   	</fieldset><br><br><br><br><br><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</form>
</div>
<script language="javascript">
// tanggal expired card
cal1_mk33 = new dhtmlXCalendarObject({
			input: "setor_tgl",button: "btnTg_setor"
	});
cal1_mk33.setDateFormat("%d/%m/%Y");

	$(function() {
		$('#tanda_terima').number(true, 2);
	});

function winKOSL_mk3() {
	try {
		if(w4_mk3.isHidden()==true) {
			w4_mk3.show();
			document.getElementById('frmSearchKOSL').focus();
		}
		w4_mk3.bringToTop();
		return;
	} catch(e) {}
	w4_mk3 = dhxWins.createWindow("w4_mk3",0,0,430,450);
	w4_mk3.setText("Daftar Member");
	w4_mk3.button("park").hide();
	w4_mk3.button("minmax1").hide();
	w4_mk3.center();
	
	tb_w4_mk3 = w4_mk3.attachToolbar();
	tb_w4_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w4_mk3.setSkin("dhx_terrace");
	tb_w4_mk3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w4_mk3.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahKOSL(13);
		}
	});
	
	w4_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_search_KOSL", true);
}

function winSL_mk3() {
	try {
		if(w5_mk3.isHidden()==true) {
			w5_mk3.show();
			document.getElementById('frmSearchSL').focus();
		}
		w5_mk3.bringToTop();
		return;
	} catch(e) {}
	w5_mk3 = dhxWins.createWindow("w5_mk3",0,0,430,450);
	w5_mk3.setText("Daftar Member");
	w5_mk3.button("park").hide();
	w5_mk3.button("minmax1").hide();
	w5_mk3.center();
	
	tb_w5_mk3 = w5_mk3.attachToolbar();
	tb_w5_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w5_mk3.setSkin("dhx_terrace");
	tb_w5_mk3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w5_mk3.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahSL(13);
		}
	});
	
	w5_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_search_SL", true);
}

function winKOLS_mk3() {
	try {
		if(w6_mk3.isHidden()==true) {
			w6_mk3.show();
			document.getElementById('frmSearchKOLS').focus();
		}
		w6_mk3.bringToTop();
		return;
	} catch(e) {}
	w6_mk3 = dhxWins.createWindow("w6_mk3",0,0,430,450);
	w6_mk3.setText("Daftar Member");
	w6_mk3.button("park").hide();
	w6_mk3.button("minmax1").hide();
	w6_mk3.center();
	
	tb_w6_mk3 = w6_mk3.attachToolbar();
	tb_w6_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w6_mk3.setSkin("dhx_terrace");
	tb_w6_mk3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w6_mk3.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahKOLS(13);
		}
	});
	
	w6_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_search_KOLS", true);
}

function winLS_mk3() {
	try {
		if(w7_mk3.isHidden()==true) {
			w7_mk3.show();
			document.getElementById('frmSearchLS').focus();
		}
		w7_mk3.bringToTop();
		return;
	} catch(e) {}
	w7_mk3 = dhxWins.createWindow("w7_mk3",0,0,430,450);
	w7_mk3.setText("Daftar Member");
	w7_mk3.button("park").hide();
	w7_mk3.button("minmax1").hide();
	w7_mk3.center();
	
	tb_w7_mk3 = w7_mk3.attachToolbar();
	tb_w7_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w7_mk3.setSkin("dhx_terrace");
	tb_w7_mk3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w7_mk3.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahLS(13);
		}
	});
	
	w7_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_search_LS", true);
}

	<?php if(isset($sts)){ if($sts=='0'){?>
		document.frm_mk33.nmkoor_selling.disabled = false;
		document.frm_mk33.nm_selling.disabled = false;
		document.frm_mk33.nmkoor_listing.disabled = false;
		document.frm_mk33.nm_listing.disabled = false;
	<?php } else { ?>
		document.frm_mk33.nmkoor_selling.disabled = true;
		document.frm_mk33.nm_selling.disabled = true;
		document.frm_mk33.nmkoor_listing.disabled = true;
		document.frm_mk33.nm_listing.disabled = true;
	<?php } } ?> 
	
	<?php if(isset($sts_landed)){ if($sts_landed=='0'){?>
		document.frm_mk33.nmkoor_selling.disabled = false;
		document.frm_mk33.nm_selling.disabled = false;
		document.frm_mk33.nmkoor_listing.disabled = false;
		document.frm_mk33.nm_listing.disabled = false;
	<?php } else { ?>
		document.frm_mk33.nmkoor_selling.disabled = true;
		document.frm_mk33.nm_selling.disabled = true;
		document.frm_mk33.nmkoor_listing.disabled = true;
		document.frm_mk33.nm_listing.disabled = true;
	<?php } } ?> 

	<?php if(isset($chec_tt)){ if($chec_tt=='credit_cart'){?> 
		document.frm_mk33.txt_no_credit.disabled = false;
	<?php } else { ?> 
		document.frm_mk33.txt_no_credit.disabled = true;
	<?php } } ?>

	<?php if(isset($chec_tt)){ if($chec_tt=='setor_tt'){?> 
		document.frm_mk33.setor_bank.disabled = false; 
		document.frm_mk33.setor_tgl.disabled = false;
		document.frm_mk33.setor_no.disabled = false;
	<?php } else { ?> 
		document.frm_mk33.setor_bank.disabled = true;
		document.frm_mk33.setor_tgl.disabled = true;
		document.frm_mk33.setor_no.disabled = true;
	<?php } } ?>
	
	<?php if(isset($chec_tt)){ if($chec_tt=='lain_tt'){?> 
		document.frm_mk33.txt_lain_tt.disabled = false;
	<?php } else { ?> 
		document.frm_mk33.txt_lain_tt.disabled = true;
	<?php } } ?>
	
	<?php if(isset($uang_muka)){ if($uang_muka=='0'){?> document.frm_mk33.txt_uang_muka.disabled = false; <?php } else { ?> document.frm_mk33.txt_uang_muka.disabled = true; <?php } } ?>

function check_credit(){
	if(document.frm_mk33.credit_cart.checked == true){
		document.frm_mk33.txt_no_credit.disabled = false;
	} else {
		document.frm_mk33.txt_no_credit.disabled = true;
	}
}

function check_setor(){
	if(document.frm_mk33.setor_tt.checked == true){
		document.frm_mk33.setor_bank.disabled = false;
		document.frm_mk33.setor_tgl.disabled = false;
		document.frm_mk33.setor_no.disabled = false;
	} else {
		document.frm_mk33.setor_bank.disabled = true;
		document.frm_mk33.setor_tgl.disabled = true;
		document.frm_mk33.setor_no.disabled = true;
	}
}

function check_lain_tt(){
	if(document.frm_mk33.lain_tt.checked == true){
		document.frm_mk33.txt_lain_tt.disabled = false;
	} else {
		document.frm_mk33.txt_lain_tt.disabled = true;
	}
}
</script>
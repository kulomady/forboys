<style>
	legend {
		font-weight:bold;
	}
</style>
<div class="frmContainer">
<form name="frm_mk31" id="frm_mk31" method="post" action="javascript:void(0);">
	<table style="padding-left:15px;">
    	<tr>
        	<td width="200">No. Surat Pesanan</td>
            <td width="300"><input type="text" size="30" id="no" name="no" readonly="readonly" value="<?php if(isset($no)){ echo $no; } else { echo "[Auto]"; }?>" />
            <input type="hidden" size="30" id="id" name="id" value="<?php if(isset($id)): echo $id; endif;?>" /></td>
            <td width="100">Kode Customer</td>
            <td><input type="text" id="kode_pelanggan" name="kode_pelanggan" readonly="readonly" value="<?php if(isset($kode_pelanggan)): echo $kode_pelanggan; endif;?>" />&nbsp;<img name="btnc_mk3" id="btnc_mk3" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winCust_mk3();" /></td>
        </tr>
        	<td>Kode Member</td>
            <td><input type="hidden" id="kode_member" name="kode_member" readonly="readonly" value="<?php if(isset($kode_member)): echo $kode_member; endif;?>" /><input type="text" id="nama_member" name="nama_member" readonly="readonly" value="<?php if(isset($nama_member)): echo $nama_member; endif;?>" />&nbsp;<img name="btnm_mk3" id="btnakun_mk3" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_mk3();" /></td>
            <td>No. Hp</td>
            <td><input type="text" id="no_hp" name="no_hp" readonly="readonly" value="<?php if(isset($no_hp)): echo $no_hp; endif;?>" /></td>
        <tr>
        </tr>
    </table>
  	</table>
    	<fieldset>
        	<legend>SECTION A:</legend>
        	<table style="padding-left:15px;">
                <tr>
                	<td width="190">Nama Pemesan (Lengkap)</td>
                    <td width="300"><input type="text" size="30" readonly="readonly" id="nama_pemesan" name="nama_pemesan" value="<?php if(isset($nama_pemesan)): echo $nama_pemesan; endif;?>" /></td>
                    <td width="100">Agama</td>
                    <td><input type="text" id="agama" name="agama" readonly="readonly" value="<?php if(isset($agama)): echo $agama; endif;?>" /></td>
                </tr>
                <tr>
                    <td valign="top">Alamat</td>
                    <td><textarea name="alamat" id="alamat" cols="32" readonly="readonly" rows="2"><?php if(isset($alamat)): echo $alamat; endif;?></textarea></td>
                    <td valign="top">Kode Pos</td>
                    <td valign="top"><input type="text" id="pos" readonly="readonly" name="pos" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($pos)): echo $pos; endif;?>" /></td>
                </tr>
                <tr>
                	<td>No. Telp Rumah</td>
                    <td><input type="text" id="tlp_rumah" name="tlp_rumah" readonly="readonly" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_rumah)): echo $tlp_rumah; endif;?>" /></td>
                    <td>No. HP</td>
                    <td><input type="text" id="tlp_hp" name="tlp_hp" readonly="readonly" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_hp)): echo $tlp_hp; endif;?>" /></td>
                </tr>
                <tr>
                	<td>No. Telp Kantor</td>
                    <td><input type="text" id="tlp_kantor" name="tlp_kantor" readonly="readonly" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_kantor)): echo $tlp_kantor; endif;?>" /></td>
                    <td>Fax</td>
                    <td><input type="text" id="fax" name="fax" readonly="readonly" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($fax)): echo $fax; endif;?>" /></td>
                </tr>
                <tr>
                	<td>No. Identitas (KTP/SIM/KIMS)</td>
                    <td><input type="text" id="identitas" name="identitas" readonly="readonly" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($identitas)): echo $identitas; endif;?>" /></td>
                    <td>Tanggal Lahir</td>
                    <td><input type="text" id="tgl_lahir" name="tgl_lahir" size="8" readonly="readonly" value="<?php if(isset($tgl_lahir)): echo $tgl_lahir; endif;?>" /></td>
                </tr>
                <tr>
                	<td>Email</td>
                    <td><input type="text" size="30" id="email" readonly="readonly" name="email" value="<?php if(isset($email)): echo $email; endif;?>" /></td>
                    <td>No. NPWP</td>
                    <td><input type="text" size="30" id="npwp" readonly="readonly" name="npwp" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($npwp)): echo $npwp; endif;?>" /></td>
                </tr>
                <tr>
                    <td rowspan="2" valign="top">Alamat Surat</td>
                    <td rowspan="2"><textarea name="alamat_surat" id="alamat_surat" cols="32" rows="2"><?php if(isset($alamat_surat)): echo $alamat_surat; endif;?></textarea></td>
                    <td valign="top">Kode Pos Surat</td>
                    <td valign="top"><input type="text" id="pos_surat" name="pos_surat" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($pos_surat)): echo $pos_surat; endif;?>" /></td>
                </tr>
                <tr>
                    <td valign="top">Unit Pesanan</td>
                    <td valign="top"><select name="unit_pesan" id="unit_pesan" onchange="upesan();">
                        <option value="" <?php if(isset($unit_pesan)){ if($unit_pesan==""){ echo "selected='selected'"; } else { echo ""; } } ?>></option>
                        <option value="1" <?php if(isset($unit_pesan)){ if($unit_pesan=='1'){ echo "selected='selected'"; } else { echo ""; } } ?>>APARTEMEN</option>
                        <option value="0" <?php if(isset($unit_pesan)){ if($unit_pesan=='0'){ echo "selected='selected'"; } else { echo ""; } } ?>>LANDED</option>
                    </select></td>
                </tr>
            </table>
        </fieldset>
	<fieldset>
        	<legend>SECTION B1: UNIT PESANAN - APARTEMEN</legend>
        	<table style="padding-left:15px;">
            	<tr>
                	<td width="150">1. Developer</td>
                    <td width="200"><select name="develop" id="develop"><?php echo $dev; ?></select></td>
                    <td width="110">4. No. Unit</td>
                    <td width="110"><input type="text" size="10" name="no_unit" id="no_unit" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($no_unit)): echo $no_unit; endif;?>" ></td>
                    <td width="90">5. Status</td>
                    <td><select name="status_unit" id="status_unit" onchange="pilsu();">
                    	<option value="" <?php if(isset($sts)){ if($sts==''){ echo "selected='selected'"; } else { echo ""; }} ?>></option>
                    	<option value="1" <?php if(isset($sts)){ if($sts=='1'){ echo "selected='selected'"; } else { echo ""; }} ?>>Primary</option>
                        <option value="0" <?php if(isset($sts)){ if($sts=='0'){ echo "selected='selected'"; } else { echo ""; }} ?>>Secondary</option>
                    </select></td>
                </tr>
                <tr>
                	<td>2. Type Bedroom</td>
                    <td><input type="text" size="20" name="type_badroom" id="type_badroom" value="<?php if(isset($type_badroom)): echo $type_badroom; endif;?>"></td>
                    <td>6. Luas Unit (m<sup>2</sup>)</td>
                    <td><input type="text" id="luas" name="luas" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" size="10" value="<?php if(isset($luas)): echo $luas; endif;?>" /></td>
                    <td>7. Tower</td>
                    <td><input type="text" id="tower" name="tower" size="20" value="<?php if(isset($tower)): echo $tower; endif;?>" /></td>
                </tr>
                <tr>
                	<td>3. Marketing Floor No.</td>
                    <td><input type="text" size="10" name="floor_no" id="floor_no" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($floor_no)): echo $floor_no; endif;?>" ></td>
                    <td>8. Spesifikasi</td>
                    <td colspan="3">
                    <input type="radio" id="unfurnished" name="spek" value="unfurnished" <?php if(isset($spek)){ if($spek=='unfurnished'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Unfurnished&nbsp;
                    <input type="radio" id="semifurnished" name="spek" value="semifurnished" <?php if(isset($spek)){ if($spek=='semifurnished'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Semi Furnished&nbsp;
                    <input type="radio" id="fullfurnished" name="spek" value="fullfurnished" <?php if(isset($spek)){ if($spek=='fullfurnished'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Full Furnished&nbsp;
                    <input type="radio" id="bare" name="spek" value="bare" <?php if(isset($spek)){ if($spek=='bare'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Bare</td>
                </tr>
            </table>
       	</fieldset>
        <fieldset>
        	<legend>SECTION B2: UNIT PESANAN - LANDED</legend>
        	<table style="padding-left:15px;">
            	<tr>
                	<td width="150">1. Developer</td>
                    <td width="200"><select name="develop_landed" id="develop_landed"><?php echo $landed; ?></select></td>
                    <td width="150">4. Status</td>
                    <td><select name="status_landed" id="status_landed" onchange="pilsu();">
                    	<option value="" <?php if(isset($sts_landed)){ if($sts_landed==''){ echo "selected='selected'"; } else { echo ""; }} ?>></option>
                    	<option value="1" <?php if(isset($sts_landed)){ if($sts_landed=='1'){ echo "selected='selected'"; } else { echo ""; }} ?>>Primary</option>
                        <option value="0" <?php if(isset($sts_landed)){ if($sts_landed=='0'){ echo "selected='selected'"; } else { echo ""; }} ?>>Secondary</option>
                    </select></td>
                </tr>
                <tr>
                	<td>2. Type</td>
                    <td><input type="text" size="20" name="type_landed" id="type_landed" value="<?php if(isset($type_landed)): echo $type_landed; endif;?>"></td>
                    <td>5. Luas Tanah/Bangunan</td>
                    <td><input type="text" id="ltlb" name="ltlb" size="10" value="<?php if(isset($ltlb)): echo $ltlb; endif;?>" style="text-align:right;" /></td>
                </tr>
                <tr>
                	<td>3. No. Unit</td>
                    <td width="110"><input type="text" size="10" name="no_unit_landed" id="no_unit_landed" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($no_unit_landed)): echo $no_unit_landed; endif;?>" ></td>
                    <td colspan="2">6. Spesifikasi&nbsp;&nbsp;&nbsp;<input type="radio" id="unfurnished2" name="spek2" value="unfurnished2" <?php if(isset($spek2)){ if($spek2=='unfurnished2'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Unfurnished&nbsp;
                    <input type="radio" id="semifurnished2" name="spek2" value="semifurnished2" <?php if(isset($spek2)){ if($spek2=='semifurnished2'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Semi Furnished&nbsp;
                    <input type="radio" id="fullfurnished2" name="spek2" value="fullfurnished2" <?php if(isset($spek2)){ if($spek2=='fullfurnished2'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Full Furnished&nbsp;
                    <input type="radio" id="bare2" name="spek2" value="bare2" <?php if(isset($spek2)){ if($spek2=='bare2'){ echo "checked='checked'"; } else { echo ""; }} ?>>&nbsp;Bare</td>
                </tr>
            </table>
        </fieldset>
</form>
</div>
<script language="javascript">
	function hanyaAngka(e, decimal) {
		var key;
		var keychar;
		 if (window.event) {
			 key = window.event.keyCode;
		 } else
		 if (e) {
			 key = e.which;
		 } else return true;
		
		//alert(key);
		keychar = String.fromCharCode(key);
		if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
			return true;
		} else 
		if ((("0123456789").indexOf(keychar) > -1)) {
			return true; 
		} else 
		if (decimal && (keychar == ".")) {
			return true; 
		} else return false; 
    }
	
// tanggal expired card
cal1_mk31 = new dhtmlXCalendarObject({
			input: "tgl_lahir",button: "btnTg"
	});
cal1_mk31.setDateFormat("%d/%m/%Y");

	<?php if(isset($unit_pesan)){ if($unit_pesan=='0'){?>
		kosong_Apart();
		document.frm_mk31.develop.disabled = true;
		document.frm_mk31.type_badroom.disabled = true;
		document.frm_mk31.floor_no.disabled = true;
		document.frm_mk31.no_unit.disabled = true;
		document.frm_mk31.status_unit.disabled = true;
		document.frm_mk31.luas.disabled = true;
		document.frm_mk31.tower.disabled = true;
		document.frm_mk31.unfurnished.disabled = true;
		document.frm_mk31.semifurnished.disabled = true;
		document.frm_mk31.fullfurnished.disabled = true;
		document.frm_mk31.bare.disabled = true;
		
		document.frm_mk31.develop_landed.disabled = false;
		document.frm_mk31.type_landed.disabled = false;
		document.frm_mk31.no_unit_landed.disabled = false;
		document.frm_mk31.status_landed.disabled = false;
		document.frm_mk31.ltlb.disabled = false;
		document.frm_mk31.unfurnished2.disabled = false;
		document.frm_mk31.semifurnished2.disabled = false;
		document.frm_mk31.fullfurnished2.disabled = false;
		document.frm_mk31.bare2.disabled = false; 
	<?php } else if($unit_pesan=='1'){ ?>
		kosong_Landed();
		document.frm_mk31.develop.disabled = false;
		document.frm_mk31.type_badroom.disabled = false;
		document.frm_mk31.floor_no.disabled = false;
		document.frm_mk31.no_unit.disabled = false;
		document.frm_mk31.status_unit.disabled = false;
		document.frm_mk31.luas.disabled = false;
		document.frm_mk31.tower.disabled = false;
		document.frm_mk31.unfurnished.disabled = false;
		document.frm_mk31.semifurnished.disabled = false;
		document.frm_mk31.fullfurnished.disabled = false;
		document.frm_mk31.bare.disabled = false;
		
		document.frm_mk31.develop_landed.disabled = true;
		document.frm_mk31.type_landed.disabled = true;
		document.frm_mk31.no_unit_landed.disabled = true;
		document.frm_mk31.status_landed.disabled = true;
		document.frm_mk31.ltlb.disabled = true;
		document.frm_mk31.unfurnished2.disabled = true;
		document.frm_mk31.semifurnished2.disabled = true;
		document.frm_mk31.fullfurnished2.disabled = true;
		document.frm_mk31.bare2.disabled = true;
	<?php } } else { ?>
		disabledForm();
		kosong_Apart();
		kosong_Landed();
	<?php } ?>
	function disabledForm(){
		document.frm_mk31.develop.disabled = true;
		document.frm_mk31.type_badroom.disabled = true;
		document.frm_mk31.floor_no.disabled = true;
		document.frm_mk31.no_unit.disabled = true;
		document.frm_mk31.status_unit.disabled = true;
		document.frm_mk31.luas.disabled = true;
		document.frm_mk31.tower.disabled = true;
		document.frm_mk31.unfurnished.disabled = true;
		document.frm_mk31.semifurnished.disabled = true;
		document.frm_mk31.fullfurnished.disabled = true;
		document.frm_mk31.bare.disabled = true;
		
		document.frm_mk31.develop_landed.disabled = true;
		document.frm_mk31.type_landed.disabled = true;
		document.frm_mk31.no_unit_landed.disabled = true;
		document.frm_mk31.status_landed.disabled = true;
		document.frm_mk31.ltlb.disabled = true;
		document.frm_mk31.unfurnished2.disabled = true;
		document.frm_mk31.semifurnished2.disabled = true;
		document.frm_mk31.fullfurnished2.disabled = true;
		document.frm_mk31.bare2.disabled = true;
	}

function winAkun_mk3() {
	try {
		if(w2_mk3.isHidden()==true) {
			w2_mk3.show();
			document.getElementById('frmSearchMember').focus();
		}
		w2_mk3.bringToTop();
		return;
	} catch(e) {}
	w2_mk3 = dhxWins.createWindow("w2_mk3",0,0,430,450);
	w2_mk3.setText("Daftar Member");
	w2_mk3.button("park").hide();
	w2_mk3.button("minmax1").hide();
	w2_mk3.center();
	
	tb_w2_mk3 = w2_mk3.attachToolbar();
	tb_w2_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w2_mk3.setSkin("dhx_terrace");
	tb_w2_mk3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w2_mk3.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahMember(13);
		}
	});
	
	w2_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_search_member", true);
}

function winCust_mk3() {
	try {
		if(w3_mk3.isHidden()==true) {
			w3_mk3.show();
			document.getElementById('frmSearchCust').focus();
		}
		w3_mk3.bringToTop();
		return;
	} catch(e) {}
	w3_mk3 = dhxWins.createWindow("w3_mk3",0,0,430,450);
	w3_mk3.setText("Daftar Member");
	w3_mk3.button("park").hide();
	w3_mk3.button("minmax1").hide();
	w3_mk3.center();
	
	tb_w3_mk3 = w3_mk3.attachToolbar();
	tb_w3_mk3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w3_mk3.setSkin("dhx_terrace");
	tb_w3_mk3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w3_mk3.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahCustomer(13);
		}
	});
	
	w3_mk3.attachURL(base_url+"index.php/surat_pesanan/frm_search_customer", true);
}

function pilsu(){
	document.frm_mk33.koor_selling.value = "";
	document.frm_mk33.nmkoor_selling.value = "";
	document.frm_mk33.selling.value = "";
	document.frm_mk33.nm_selling.value = "";
	document.frm_mk33.koor_listing.value = "";
	document.frm_mk33.nmkoor_listing.value = "";
	document.frm_mk33.listing.value = "";
	document.frm_mk33.nm_listing.value = "";
		
	if(document.frm_mk31.status_unit.value == 0){
		document.frm_mk33.nmkoor_selling.disabled = false;
		document.frm_mk33.nm_selling.disabled = false;
		document.frm_mk33.nmkoor_listing.disabled = false;
		document.frm_mk33.nm_listing.disabled = false;
	} else if(document.frm_mk31.status_landed.value == 0){
		document.frm_mk33.nmkoor_selling.disabled = false;
		document.frm_mk33.nm_selling.disabled = false;
		document.frm_mk33.nmkoor_listing.disabled = false;
		document.frm_mk33.nm_listing.disabled = false;
	} else {
		document.frm_mk33.nmkoor_selling.disabled = true;
		document.frm_mk33.nm_selling.disabled = true;
		document.frm_mk33.nmkoor_listing.disabled = true;
		document.frm_mk33.nm_listing.disabled = true;
	}
}

function upesan(){
	if(document.frm_mk31.unit_pesan.value == 0){
		kosong_Apart();
		document.frm_mk31.develop.disabled = true;
		document.frm_mk31.type_badroom.disabled = true;
		document.frm_mk31.floor_no.disabled = true;
		document.frm_mk31.no_unit.disabled = true;
		document.frm_mk31.status_unit.disabled = true;
		document.frm_mk31.luas.disabled = true;
		document.frm_mk31.tower.disabled = true;
		document.frm_mk31.unfurnished.disabled = true;
		document.frm_mk31.semifurnished.disabled = true;
		document.frm_mk31.fullfurnished.disabled = true;
		document.frm_mk31.bare.disabled = true;
		
		document.frm_mk31.develop_landed.disabled = false;
		document.frm_mk31.type_landed.disabled = false;
		document.frm_mk31.no_unit_landed.disabled = false;
		document.frm_mk31.status_landed.disabled = false;
		document.frm_mk31.ltlb.disabled = false;
		document.frm_mk31.unfurnished2.disabled = false;
		document.frm_mk31.semifurnished2.disabled = false;
		document.frm_mk31.fullfurnished2.disabled = false;
		document.frm_mk31.bare2.disabled = false;
	} else if(document.frm_mk31.unit_pesan.value == 1){
		kosong_Landed();
		document.frm_mk31.develop.disabled = false;
		document.frm_mk31.type_badroom.disabled = false;
		document.frm_mk31.floor_no.disabled = false;
		document.frm_mk31.no_unit.disabled = false;
		document.frm_mk31.status_unit.disabled = false;
		document.frm_mk31.luas.disabled = false;
		document.frm_mk31.tower.disabled = false;
		document.frm_mk31.unfurnished.disabled = false;
		document.frm_mk31.semifurnished.disabled = false;
		document.frm_mk31.fullfurnished.disabled = false;
		document.frm_mk31.bare.disabled = false;
		
		document.frm_mk31.develop_landed.disabled = true;
		document.frm_mk31.type_landed.disabled = true;
		document.frm_mk31.no_unit_landed.disabled = true;
		document.frm_mk31.status_landed.disabled = true;
		document.frm_mk31.ltlb.disabled = true;
		document.frm_mk31.unfurnished2.disabled = true;
		document.frm_mk31.semifurnished2.disabled = true;
		document.frm_mk31.fullfurnished2.disabled = true;
		document.frm_mk31.bare2.disabled = true;
	}
}

function kosong_Apart(){
	document.frm_mk31.develop.value = "0";
	document.frm_mk31.type_badroom.value = "";
	document.frm_mk31.floor_no.value = "";
	document.frm_mk31.no_unit.value = "";
	document.frm_mk31.status_unit.value = "";
	document.frm_mk31.luas.value = "";
	document.frm_mk31.tower.value = "";
	document.frm_mk31.unfurnished.checked = false;
	document.frm_mk31.semifurnished.checked = false;
	document.frm_mk31.fullfurnished.checked = false;
	document.frm_mk31.bare.checked = false;
}

function kosong_Landed(){
	document.frm_mk31.develop_landed.value = "0";
	document.frm_mk31.type_landed.value = "";
	document.frm_mk31.no_unit_landed.value = "";
	document.frm_mk31.status_landed.value = "";
	document.frm_mk31.ltlb.value = "";
	document.frm_mk31.unfurnished2.checked = false;
	document.frm_mk31.semifurnished2.checked = false;
	document.frm_mk31.fullfurnished2.checked = false;
	document.frm_mk31.bare2.checked = false;
}

function pil_credit(){
	document.frm_mk31.no_credit.disabled = false;
	document.frm_mk31.no_debit.disabled = true;
}

function pil_debit(){
	document.frm_mk31.no_credit.disabled = true;
	document.frm_mk31.no_debit.disabled = false;
}

function pil(){
	document.frm_mk31.no_credit.disabled = true;
	document.frm_mk31.no_debit.disabled = true;
}
</script>
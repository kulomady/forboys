<div class="frmContainer">
<form action="<?php echo base_url()."index.php/company/uploadFoto"; ?>" method="post" enctype="multipart/form-data" name="frm_pg2" id="frm_pg2" target="tmpFoto">
  <table width="918" border="0" align="left">
    <tr>
      <td width="142">Kode #</td>
      <td width="342"><input name="txtkode" type="text" id="txtkode" size="5" value="<?php if(isset($outlet_id)): echo $outlet_id; endif; ?>" placeholder="[AUTO]" />
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
      <td colspan="2"><strong>Logo Perusahaan</strong></td>
      </tr>
    <tr>
      <td>Nama Perusahaan</td>
      <td><input type="text" name="txtnmperusahaan" id="txtnmperusahaan" value="<?php if(isset($nm_outlet)): echo $nm_outlet; endif; ?>" /></td>
      <td colspan="2"><input type="file" name="gambar" id="gambar" />
        <input type="submit" name="btnUploadLogo" id="btnUploadLogo" value="UPLOAD" /></td>
      </tr>
    <tr>
      <td>Alamat</td>
      <td><input name="txtalamat1" type="text" id="txtalamat1" size="40" value="<?php if(isset($alamat)): echo $alamat; endif; ?>" /></td>
      <td colspan="2" rowspan="6" style="border:1px solid #999999;" id="tmpFrame"><iframe id="tmpFoto" name="tmpFoto" width="300px" height="150px" style="border:0px;" src="<?php if(isset($gambar)): echo $gambar; endif;?>"></iframe></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="txtalamat2" type="text" id="txtalamat2" size="40" value="<?php if(isset($alamat_tambahan)): echo $alamat_tambahan; endif; ?>" /></td>
      </tr>
    <tr>
      <td>Telepon</td>
      <td><input name="txttlp" type="text" id="txttlp" size="10" value="<?php if(isset($tlp)): echo $tlp; endif; ?>" /></td>
      </tr>
    <tr>
      <td>Fax</td>
      <td><input name="txtfax" type="text" id="txtfax" size="10" value="<?php if(isset($fax)): echo $fax; endif; ?>" /></td>
      </tr>
    <tr>
      <td>NPWP</td>
      <td><input type="text" name="txtnpwp" id="txtnpwp" value="<?php if(isset($npwp)): echo $npwp; endif; ?>" /></td>
      </tr>
    <tr>
      <td>Tgl PKP</td>
      <td><input name="txttgl_pkp" type="text" id="txttgl_pkp" size="10" value="<?php if(isset($tgl_pkp)): echo $tgl_pkp; endif; ?>" />
        <span><img id="txttgl_pkp_pg2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    <tr>
      <td>Tgl Buka</td>
      <td><input name="txttgl_buka" type="text" id="txttgl_buka" size="10" value="<?php if(isset($tgl_buka)): echo $tgl_buka; endif; ?>" />
        <span><img id="txttgl_buka_pg2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td colspan="2">
          <input type="button" name="btnHpsLogo" id="btnHpsLogo" value="HAPUS LOGO" onclick="hapusLogo();" />
          <input name="hpsFoto" type="hidden" id="hpsFoto" value="" />
            <input type="hidden" name="nmfile" id="nmfile" value="<?php if(isset($nmfile)): echo $nmfile; endif; ?>" />
      </td>
      </tr>
    <tr>
      <td>Type</td>
      <td><select name="slctype" id="slctype">
<option value="KANTOR" <?php if(isset($type) && $type=='KANTOR'): echo 'selected="selected"'; endif; ?>>KANTOR</option>
        <option value="GUDANG" <?php if(isset($type) && $type=='GUDANG'): echo 'selected="selected"'; endif; ?>>GUDANG</option>
        <option value="TOKO" <?php if(isset($type) && $type=='TOKO'): echo 'selected="selected"'; endif; ?>>TOKO</option>
        <option value="KONSINYASI" <?php if(isset($type) && $type=='KONSINYASI'): echo 'selected="selected"'; endif; ?>>KONSINYASI</option>
      </select></td>
      <td colspan="2" valign="top">&nbsp;</td>
      </tr>
    <tr style="display:none;">
      <td>Kantor Pusat
        <input type="hidden" name="hKp_pg2" id="hKp_pg2" value="<?php if(isset($id_induk)): echo $id_induk; endif; ?>" /></td>
      <td id="tmpComboKP_pg2"></td>
      <td colspan="2" valign="top">&nbsp;</td>
      </tr>
    <tr>
      <td>Kota
        <input type="hidden" name="hKota_pg2" id="hKota_pg2" value="<?php if(isset($city_code)): echo $city_code; endif; ?>" /></td>
      <td id="tmpComboKota_pg2"></td>
      <td colspan="2" valign="top">&nbsp;</td>
      </tr>
    <tr>
      <td>Aktif</td>
      <td><select name="slcaktif" id="slcaktif">
        <option value=""></option>
        <option value="1" <?php if(isset($is_active) && $is_active == '1'): echo 'selected="selected"'; endif;?>>YA</option>
        <option value="0" <?php if(isset($is_active) && $is_active == '0'): echo 'selected="selected"'; endif;?>>TIDAK</option>
      </select></td>
      <td colspan="2" valign="top">&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="top">&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="top">&nbsp;</td>
      </tr>
    <tr>
      <td height="120">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="177">&nbsp;</td>
      <td width="239">&nbsp;</td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
	// Call Tgl PKP
	cal1_pg2 = new dhtmlXCalendarObject({
			input: "txttgl_pkp",button: "txttgl_pkp_pg2"
	});
	cal1_pg2.setDateFormat("%d/%m/%Y");
	// Call Tgl Buka
	cal2_pg2 = new dhtmlXCalendarObject({
			input: "txttgl_buka",button: "txttgl_buka_pg2"
	});
	cal2_pg2.setDateFormat("%d/%m/%Y");
	
	// Combo Kantor Pusat
	var cbKP_pg2 = new dhtmlXCombo("tmpComboKP_pg2", "cbKp_pg2", 200);
	cbKP_pg2.enableFilteringMode(true);
	loadCbKP_pg2();
	function loadCbKP_pg2() {
		cbKP_pg2.clearAll();
		cbKP_pg2.loadXML(base_url+"index.php/company/cbKantorPusat",function() {
			<?php
				if(isset($id_induk)):
					echo "IDcbKP_pg2 = cbKP_pg2.getIndexByValue('".$id_induk."');";
					echo "cbKP_pg2.selectOption(IDcbKP_pg2,true,true);";
				endif;
			?>
		});
	}
	// Combo Kota
	var cbKota_pg2 = new dhtmlXCombo("tmpComboKota_pg2", "cbKota_pg2", 200);
	cbKota_pg2.enableFilteringMode(true);
	loadCbKota_pg2();
	function loadCbKota_pg2() {
		cbKota_pg2.clearAll();
		cbKota_pg2.loadXML(base_url+"index.php/company/cbKota",function() {
			<?php
				if(isset($city_code)):
					echo "IDcbKota_pg2 = cbKota_pg2.getIndexByValue('".$city_code."');";
					echo "cbKota_pg2.selectOption(IDcbKota_pg2,true,true);";
				endif;
			?>
		});
	}
	
	function baru_pg2() {
		 document.frm_pg2.id.value = "";
		 document.frm_pg2.txtkode.value = "";
		 document.frm_pg2.txtnmperusahaan.value = "";
		 document.frm_pg2.txtalamat1.value = "";
		 document.frm_pg2.txtalamat2.value = "";
		 document.frm_pg2.txttlp.value = "";
		 document.frm_pg2.txtfax.value = "";
		 document.frm_pg2.txtnpwp.value = "";
		 document.frm_pg2.txttgl_pkp.value = "";
		 document.frm_pg2.txttgl_buka.value = "";
		 cbKP_pg2.setComboText("");
		 cbKota_pg2.setComboText("");
		 document.frm_pg2.slctype.value = "";
		 document.frm_pg2.slcaktif.value = "";
	}
	
	// simpan
	function simpan_pg2() {
            if(document.frm_pg2.gambar.value!=""){
                var g = document.getElementById('gambar').files[0].name;            
                var gbr = g.replace(" ", "-");
            } else {
                var gbr = "";            
            }
		poststr =
			'id=' + document.frm_pg2.id.value +
            '&txtkode=' + document.frm_pg2.txtkode.value +
			'&txtnmperusahaan=' + document.frm_pg2.txtnmperusahaan.value +
			'&txtalamat1=' + document.frm_pg2.txtalamat1.value +
			'&txtalamat2=' + document.frm_pg2.txtalamat2.value +
			'&txttlp=' + document.frm_pg2.txttlp.value +
			'&txtfax=' + document.frm_pg2.txtfax.value +
			'&txtnpwp=' + document.frm_pg2.txtnpwp.value +
			'&txttgl_pkp=' + document.frm_pg2.txttgl_pkp.value +
			'&txttgl_buka=' + document.frm_pg2.txttgl_buka.value +
			'&slcKantorPusat=' + cbKP_pg2.getSelectedValue() +
			'&slcKota=' + cbKota_pg2.getSelectedValue()  +
			'&slctype=' + document.frm_pg2.slctype.value +
			'&slcaktif=' + document.frm_pg2.slcaktif.value+
            '&gambar=' + gbr +
			'&hpsFoto=' + document.frm_pg2.hpsFoto.value+  
                        '&txtidperkiraan1=' + document.frm2_pg2.txtidperkiraan1.value+
                        '&txtidperkiraan2=' + document.frm2_pg2.txtidperkiraan2.value+
                        '&txtidperkiraan3=' + document.frm2_pg2.txtidperkiraan3.value+
                        '&txtidperkiraan4=' + document.frm2_pg2.txtidperkiraan4.value+
                        '&txtidperkiraan5=' + document.frm2_pg2.txtidperkiraan5.value+
                        '&txtidperkiraan6=' + document.frm2_pg2.txtidperkiraan6.value+
                        '&txtidperkiraan7=' + document.frm2_pg2.txtidperkiraan7.value+
                        '&txtidperkiraan8=' + document.frm2_pg2.txtidperkiraan8.value+
                        '&txtidperkiraan9=' + document.frm2_pg2.txtidperkiraan9.value+
                        '&txtidperkiraan10=' + document.frm2_pg2.txtidperkiraan10.value+
                        '&txtidperkiraan11=' + document.frm2_pg2.txtidperkiraan11.value+
                        '&txtidperkiraan12=' + document.frm2_pg2.txtidperkiraan12.value+
                        '&txtidperkiraan13=' + document.frm2_pg2.txtidperkiraan13.value+
                        '&txtidperkiraan14=' + document.frm2_pg2.txtidperkiraan14.value+
                        '&txtidperkiraan15=' + document.frm2_pg2.txtidperkiraan15.value+
                        '&txtidperkiraan16=' + document.frm2_pg2.txtidperkiraan16.value+
                        '&txtidperkiraan17=' + document.frm2_pg2.txtidperkiraan17.value+
                        '&txtidperkiraan18=' + document.frm2_pg2.txtidperkiraan18.value+
                        '&txtidperkiraan19=' + document.frm2_pg2.txtidperkiraan19.value+
                        '&txtidperkiraan20=' + document.frm2_pg2.txtidperkiraan20.value+
						'&txtidperkiraan21=' + document.frm2_pg2.txtidperkiraan21.value+
						'&txtidperkiraan22=' + document.frm2_pg2.txtidperkiraan22.value+
						'&txtidperkiraan23=' + document.frm2_pg2.txtidperkiraan23.value+
						'&txtidperkiraan24=' + document.frm2_pg2.txtidperkiraan24.value+
						'&txtidperkiraan25=' + document.frm2_pg2.txtidperkiraan25.value+
						'&txtidperkiraan26=' + document.frm2_pg2.txtidperkiraan26.value+
						'&txtidperkiraan27=' + document.frm2_pg2.txtidperkiraan27.value+
						'&txtidperkiraan28=' + document.frm2_pg2.txtidperkiraan28.value+
						'&txtidperkiraan29=' + document.frm2_pg2.txtidperkiraan29.value+
						'&txtidperkiraan30=' + document.frm2_pg2.txtidperkiraan30.value+
						'&txtidperkiraan31=' + document.frm2_pg2.txtidperkiraan31.value+
						'&txtidperkiraan32=' + document.frm2_pg2.txtidperkiraan32.value+
						'&txtidperkiraan33=' + document.frm2_pg2.txtidperkiraan33.value+
						'&txtidperkiraan34=' + document.frm2_pg2.txtidperkiraan34.value+
						'&txtidperkiraan35=' + document.frm2_pg2.txtidperkiraan35.value+
						'&txtidperkiraan36=' + document.frm2_pg2.txtidperkiraan36.value+
						'&txtidperkiraan37=' + document.frm2_pg2.txtidperkiraan37.value+
						'&txtidperkiraan38=' + document.frm2_pg2.txtidperkiraan38.value+
						'&txtidperkiraan39=' + document.frm2_pg2.txtidperkiraan39.value+
						'&txtidperkiraan40=' + document.frm2_pg2.txtidperkiraan40.value+
						'&txtidperkiraan41=' + document.frm2_pg2.txtidperkiraan41.value+
						'&txtidperkiraan42=' + document.frm2_pg2.txtidperkiraan42.value+
						'&txtidperkiraan43=' + document.frm2_pg2.txtidperkiraan43.value+
						'&txtidperkiraan44=' + document.frm2_pg2.txtidperkiraan44.value+
						'&txtidperkiraan45=' + document.frm2_pg2.txtidperkiraan45.value+
						'&txtidperkiraan46=' + document.frm2_pg2.txtidperkiraan46.value+
						'&txtidperkiraan47=' + document.frm2_pg2.txtidperkiraan47.value+
						'&txtidperkiraan48=' + document.frm2_pg2.txtidperkiraan48.value+
						'&txtidperkiraan49=' + document.frm2_pg2.txtidperkiraan49.value+
						'&txtidperkiraan50=' + document.frm2_pg2.txtidperkiraan50.value+
						'&txtidperkiraan51=' + document.frm2_pg2.txtidperkiraan51.value+
						'&txtidperkiraan52=' + document.frm2_pg2.txtidperkiraan52.value+
						'&txtidperkiraan53=' + document.frm2_pg2.txtidperkiraan53.value+
						'&txtidperkiraan54=' + document.frm2_pg2.txtidperkiraan54.value+
						'&txtidperkiraan55=' + document.frm2_pg2.txtidperkiraan55.value+
						'&txtidperkiraan56=' + document.frm2_pg2.txtidperkiraan56.value+
						'&txtidperkiraan57=' + document.frm2_pg2.txtidperkiraan57.value+
						'&txtidperkiraan58=' + document.frm2_pg2.txtidperkiraan58.value+
						'&txtidperkiraan59=' + document.frm2_pg2.txtidperkiraan59.value+
						'&txtidperkiraan60=' + document.frm2_pg2.txtidperkiraan60.value+
						'&txtidperkiraan61=' + document.frm2_pg2.txtidperkiraan61.value+
						'&txtidperkiraan62=' + document.frm2_pg2.txtidperkiraan62.value+
						'&txtidperkiraan63=' + document.frm2_pg2.txtidperkiraan63.value+
						'&txtidperkiraan64=' + document.frm2_pg2.txtidperkiraan64.value+
						'&txtidperkiraan65=' + document.frm2_pg2.txtidperkiraan65.value+
						'&txtidperkiraan66=' + document.frm2_pg2.txtidperkiraan66.value+
						'&txtidperkiraan67=' + document.frm2_pg2.txtidperkiraan67.value+
						'&txtidperkiraan68=' + document.frm2_pg2.txtidperkiraan68.value+
						'&txtidperkiraan69=' + document.frm2_pg2.txtidperkiraan69.value+
						'&txtidperkiraan70=' + document.frm2_pg2.txtidperkiraan70.value;
						
						
						
						
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/company/simpan", encodeURI(poststr), outputSimpan_pg2);
	}
	
	function outputSimpan_pg2(loader) {
        result = loader.xmlDoc.responseText;
		document.frm_pg2.txtkode.value = result;
		tb_w1_pg2.disableItem("save");
		tb_w1_pg2.disableItem("batal");
		tb_w1_pg2.enableItem("baru");
		if(document.frm_pg2.slctype.value=='PUSAT') {
			loadCbKP_pg2();
		}
		refreshGd_pg2();
		statusEnding();
    }
    
    function hapusLogo() {
	/* poststr =
		'gambar=' + document.frm_pg2.gambar.value +
		'&txtKdItem=' + document.frm_pg2.txtKdItem.value;
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/hapusFoto", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText; */
		document.getElementById("tmpFrame").innerHTML = '<iframe id="tmpFoto" name="tmpFoto" width="300px" height="150px" style="border:0px;"></iframe>';
		document.frm_pg2.hpsFoto.value = document.frm_pg2.nmfile.value;
	//});
}
</script>
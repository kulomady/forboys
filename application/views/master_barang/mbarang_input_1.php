<div class="frmContainer">
<form action="javascript:void(0);" method="post" name="frm1_md3" id="frm1_md3">
  <table width="744" border="0" align="left">
    <tr>
      <td width="109">Tipe Item</td>
      <td colspan="3" id="tmpTipe_md3"></td>
      <td width="128">Rak</td>
      <td width="270"><input name="txtRak" type="text" id="txtRak" size="5" value="<?php if(isset($idrak)): echo $idrak; endif; ?>" />
        <input type="hidden" name="idHapus" id="idHapus" /></td>
    </tr>
    <tr>
      <td>Kode Item</td>
      <td colspan="3"><input type="text" name="txtKdItem" id="txtKdItem" value="<?php if(isset($idbarang)): echo $idbarang; endif; ?>" onblur="buatBarang_md3();" /></td>
      <td>Stock Minimum</td>
      <td><input name="txtStockMin" type="text" id="txtStockMin" size="5" value="<?php if(isset($stock_minimum)): echo $stock_minimum; endif; ?>" /></td>
    </tr>
    <tr>
      <td>Nama Item</td>
      <td colspan="3"><input type="text" name="txtNmItem" id="txtNmItem" value="<?php if(isset($nmbarang)): echo $nmbarang; endif; ?>" /></td>
      <td valign="top">Supplier</td>
      <td valign="top" id="tmpSupplier_md3"></td>
    </tr>
    <tr>
      <td>Jenis</td>
      <td colspan="3" id="tmpJns_md3"></td>
      <td valign="top">Keterangan</td>
      <td valign="top"><input type="text" name="txtKet" id="txtKet" value="<?php if(isset($keterangan)): echo $keterangan; endif; ?>" /></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td colspan="3" id="tmpKat_md3"></td>
      <td valign="top">Status Jual</td>
      <td valign="top"><input type="radio" name="rdStsJual" id="rdStsJual1" <?php if(isset($sts_jual) && $sts_jual == '1'): echo 'checked="checked"'; endif; ?> />
Ya
  <input type="radio" name="rdStsJual" id="rdStsJual2" <?php if(isset($sts_jual) && $sts_jual == '0'): echo 'checked="checked"'; endif; ?> />
Tidak</td>
    </tr>
    <tr>
      <td>Merk</td>
      <td colspan="3" id="tmpMerk_md3"></td>
      <td rowspan="2" valign="middle">Konsinyasi</td>
      <td rowspan="2" valign="top"><input type="checkbox" name="cbSerial" id="cbSerial" <?php if(isset($sts_serial) && $sts_serial == '1'): echo 'checked="checked"'; endif; ?> />
Serial<br />
<input type="checkbox" name="cbKonsinyasi" id="cbKonsinyasi" <?php if(isset($sts_konsinyasi) && $sts_konsinyasi == '1'): echo 'checked="checked"'; endif; ?>  />
Konsinyasi</td>
    </tr>
    <tr>
      <td>Warna</td>
      <td colspan="3" id="tmpWarna_md3"></td>
      </tr>
    <tr>
      <td>Mata uang</td>
      <td colspan="3" id="tmpMataUang_md3"></td>
      <td>Pajak</td>
      <td><select name="slcPajak" id="slcPajak">
      <?php echo $pajak; ?>
      </select>      </td>
    </tr>
    <tr>
      <td>Code SMS</td>
      <td width="62" id="tmpMataUang_md"><input name="txtCodeSms" type="text" id="txtCodeSms" size="5" value="<?php if(isset($code_sms)): echo $code_sms; endif; ?>" />
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>"  /></td>
      <td width="51" id="tmpMataUang_md">Aktif</td>
      <td width="98" id="tmpMataUang_md"><select name="slcaktif" id="slcaktif">
        <option value="1" <?php if(isset($is_active) && $is_active == '1'): echo 'selected="selected"'; endif;?>>YA</option>
        <option value="0" <?php if(isset($is_active) && $is_active == '0'): echo 'selected="selected"'; endif;?>>TIDAK</option>
      </select></td>
      <td>Barcode</td>
      <td><input type="checkbox" name="cbBarcode" id="cbBarcode" checked="checked" />
        Sama dengan Kode Item</td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
	// Call Tgl PKP
	cal1_md3 = new dhtmlXCalendarObject({
			input: "txttgl_pkp",button: "txttgl_pkp_md3"
	});
	cal1_md3.setDateFormat("%d/%m/%Y");
	// Call Tgl Buka
	cal2_md3 = new dhtmlXCalendarObject({
			input: "txttgl_buka",button: "txttgl_buka_md3"
	});
	cal2_md3.setDateFormat("%d/%m/%Y");
	
	// Combo Tipe Item
	var cbTI_md3 = new dhtmlXCombo("tmpTipe_md3", "cbTI_md3", 200);
	cbTI_md3.enableFilteringMode(true);
	loadCbTI_md3();
	function loadCbTI_md3() {
		cbTI_md3.clearAll();
		cbTI_md3.loadXML(base_url+"index.php/master_barang/cbTipeItem",function() {
			<?php
				if(isset($tipeItem)):
					echo "IDcbTI_md3 = cbTI_md3.getIndexByValue('".$tipeItem."');";
					echo "cbTI_md3.selectOption(IDcbTI_md3,true,true);";
				endif;
			?>
		});
	}
	// Combo Jenis Barang
	var cbJns_md3 = new dhtmlXCombo("tmpJns_md3", "cbJns_md3", 200);
	cbJns_md3.enableFilteringMode(true);
	loadCbJns_md3();
	function loadCbJns_md3() {
		cbJns_md3.clearAll();
		cbJns_md3.loadXML(base_url+"index.php/master_barang/cbJenis",function() {
			<?php
				if(isset($jnsItem)):
					echo "IDcbJns_md3 = cbJns_md3.getIndexByValue('".$jnsItem."');";
					echo "cbJns_md3.selectOption(IDcbJns_md3,true,true);";
				endif;
			?>
		});
	}
	// Combo Kategori Barang
	var cbKat_md3 = new dhtmlXCombo("tmpKat_md3", "cbKat_md3", 200);
	cbKat_md3.enableFilteringMode(true);
	loadCbKat_md3();
	function loadCbKat_md3() {
		cbKat_md3.clearAll();
		cbKat_md3.loadXML(base_url+"index.php/master_barang/cbKategori",function() {
			<?php
				if(isset($katItem)):
					echo "IDcbKat_md3 = cbKat_md3.getIndexByValue('".$katItem."');";
					echo "cbKat_md3.selectOption(IDcbKat_md3,true,true);";
				endif;
			?>
		});
	}
	
	// Combo Merk Barang
	var cbMerk_md3 = new dhtmlXCombo("tmpMerk_md3", "cbMerk_md3", 200);
	cbMerk_md3.enableFilteringMode(true);
	loadCbMerk_md3();
	function loadCbMerk_md3() {
		cbMerk_md3.clearAll();
		cbMerk_md3.loadXML(base_url+"index.php/master_barang/cbMerk",function() {
			<?php
				if(isset($merkItem)):
					echo "IDcbMerk_md3 = cbMerk_md3.getIndexByValue('".$merkItem."');";
					echo "cbMerk_md3.selectOption(IDcbMerk_md3,true,true);";
				endif;
			?>
		});
	}
	
	// Combo Warna Barang
	var cbWarna_md3 = new dhtmlXCombo("tmpWarna_md3", "cbWarna_md3", 200);
	cbWarna_md3.enableFilteringMode(true);
	loadCbWarna_md3();
	function loadCbWarna_md3() {
		cbWarna_md3.clearAll();
		cbWarna_md3.loadXML(base_url+"index.php/master_barang/cbWarna",function() {
			<?php
				if(isset($warnaItem)):
					echo "IDcbWarna_md3 = cbWarna_md3.getIndexByValue('".$warnaItem."');";
					echo "cbWarna_md3.selectOption(IDcbWarna_md3,true,true);";
				endif;
			?>
		});
	}
	
	// Combo Mata Uang
	var cbMU_md3 = new dhtmlXCombo("tmpMataUang_md3", "cbMataUang_md3", 200);
	cbMU_md3.enableFilteringMode(true);
	loadCbMU_md3();
	function loadCbMU_md3() {
		cbMU_md3.clearAll();
		cbMU_md3.loadXML(base_url+"index.php/master_barang/cbMataUang",function() {
			<?php
				if(isset($mataUang)):
					echo "IDcbMU_md3 = cbMU_md3.getIndexByValue('".$mataUang."');";
					echo "cbMU_md3.selectOption(IDcbMU_md3,true,true);";
				endif;
			?>
		});
	}
	
	// Combo Supplier
	var cbSupplier_md3 = new dhtmlXCombo("tmpSupplier_md3", "cbSupplier_md3", 200);
	cbSupplier_md3.enableFilteringMode(true);
	loadCbSupplier_md3();
	function loadCbSupplier_md3() {
		cbSupplier_md3.clearAll();
		cbSupplier_md3.loadXML(base_url+"index.php/master_barang/cbSupplier",function() {
			<?php
				if(isset($supplier)):
					echo "IDcbSupplier_md3 = cbSupplier_md3.getIndexByValue('".$supplier."');";
					echo "cbSupplier_md3.selectOption(IDcbSupplier_md3,true,true);";
				endif;
			?>
		});
	}
	
	function baru_md3() {
		 cbTI_md3.setComboText("");
		 document.frm1_md3.txtKdItem.value = "";
		 document.frm1_md3.txtNmItem.value = "";
		 cbJns_md3.setComboText("");
		 cbKat_md3.setComboText("");
		 cbMerk_md3.setComboText("");
		 cbWarna_md3.setComboText("");
		 cbMU_md3.setComboText("");
		 document.frm1_md3.txtCodeSms.value = "";
		 document.frm1_md3.txtRak.value = "";
		 document.frm1_md3.txtStockMin.value = "";
		 cbSupplier_md3.setComboText("");
		 document.frm1_md3.txtKet.value = "";
		 document.frm1_md3.rdStsJual1.checked = false;
		 document.frm1_md3.rdStsJual2.checked = false;
		 document.frm1_md3.cbSerial.checked = false;
		 document.frm1_md3.cbKonsinyasi.checked = false;
		 document.frm1_md3.slcPajak.value = "";
		 document.frm1_md3.cbBarcode.checked = true;
		 cbSatDasar_md3.setComboText("");
		 document.frm1_md3.slcaktif.value = "";
		 document.frm3_md3.hpsFoto.value = "";
		 document.frm1_md3.slcPajak.value = "";
		 document.frm2_md3.hrgBeli.value = "";
		 gdSize_md3.clearAll();
		 for(n=0;n<arrSize.length;n++) {
				if(arrSize[n] != "") {
					document.getElementById(arrSize[n]).checked = false;
				}
			}
	}
	
	// simpan
	function simpan_md3() {
	
		if(document.frm1_md3.rdStsJual1.checked==true) {
			rdStsJual = 1;
		} else if(document.frm1_md3.rdStsJual2.checked==true) {
			rdStsJual = 0;
		}
		
		cdSerial = 0;
		if(document.frm1_md3.cbSerial.checked==true) {
			cdSerial = 1;
		}
		
		cbKonsinyasi = 0;
		if(document.frm1_md3.cbKonsinyasi.checked==true) {
			cbKonsinyasi = 1;
		}
		
		cbBarcode = 0;
		if(document.frm1_md3.cbBarcode.checked==true) {
			cbBarcode = 1;
		}
		//alert(getData(gdSize_md3,[0,1,2,4,5,6,7,8]));
		// CekBarcode
		if(cekBarcode()==1) {
			alert("Barcode Tidak Boleh > 12 Karakter");
			return;
		}
		poststr =
			'id=' + document.frm1_md3.id.value +
            '&cbTI_md3=' + cbTI_md3.getSelectedValue() +
			'&txtKdItem=' + document.frm1_md3.txtKdItem.value +
			'&txtNmItem=' + document.frm1_md3.txtNmItem.value +
			'&cbJns_md3=' + cbJns_md3.getSelectedValue() +
			'&cbKat_md3=' + cbKat_md3.getSelectedValue() +
			'&cbMerk_md3=' + cbMerk_md3.getSelectedValue() +
			'&cbWarna_md3=' + cbWarna_md3.getSelectedValue() +
			'&cbMU_md3=' + cbMU_md3.getSelectedValue() +
			'&txtCodeSms=' + document.frm1_md3.txtCodeSms.value +
			'&txtRak=' + document.frm1_md3.txtRak.value +
			'&txtStockMin=' + document.frm1_md3.txtStockMin.value +
			'&cbSupplier_md3=' + cbSupplier_md3.getSelectedValue() +
			'&txtKet=' + document.frm1_md3.txtKet.value +
			'&rdStsJual=' + rdStsJual +
			'&cbSerial=' + cdSerial +
			'&cbKonsinyasi=' + cbKonsinyasi +
			'&slcPajak=' + document.frm1_md3.slcPajak.value +
			'&cbBarcode=' + cbBarcode +
			'&cbSatDasar_md3=' + cbSatDasar_md3.getSelectedValue() +
			'&txtHrg_beli=' + $('#hrgBeli').val() +
			'&slcaktif=' + document.frm1_md3.slcaktif.value +
			'&item_detail=' + getData(gdSize_md3,[0]) +
			'&code_barcode=' + getData(gdSize_md3,[0,1,2,4,5,6,7,8]) +
			'&gambar=' + document.frm3_md3.gambar.value +
			'&hpsFoto=' + document.frm3_md3.hpsFoto.value +
			'&slcPajak=' + document.frm1_md3.slcPajak.value +
			'&idHapus=' + document.frm1_md3.idHapus.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/simpan", encodeURI(poststr), outputSimpan_md3);
	}
	
	function outputSimpan_md3(loader) {
        result = loader.xmlDoc.responseText;
		statusEnding();
		if(result == 1) {
			tb_w1_md3.disableItem("save");
			tb_w1_md3.enableItem("baru");
			refreshGd_md3();
		} else {
			alert(result);	
		}
    }
	
	function cekBarcode() {
		ada = 0;		
		gdSize_md3.forEachRow(function(id){
			barcode = gdSize_md3.cells(id,3).getValue();
			panjang = barcode.length;
			if(panjang > 13) {
				ada = 1;
				return ada;
			}
		});
		return ada;
	}
</script>
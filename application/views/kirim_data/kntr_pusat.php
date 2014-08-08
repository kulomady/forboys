<form id="frm_al1" name="frm_al1" method="post" action="javascript:void(0);">
  <table width="508" border="0" cellpadding="0" cellspacing="0" style="font-family:Tahoma, Geneva, sans-serif; font-size: 12px;">
    <tr>
      <td colspan="2"><strong>Tentukan Tgl Buat / Ubah Data Yang akan Dikirim</strong></td>
    </tr>
    <tr>
      <td width="92"><strong>Dari Tanggal</strong></td>
      <td width="416"><strong>
        <input name="tgl1_al1" type="text" id="tgl1_al1" size="8" value="<?php echo $tglKirim; ?>" />
      <img id="btnTgl1_al1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" />
      <input type="button" name="button" id="button" value="KIRIM DATA" onClick="mulai()" />
      </strong></td>
    </tr>
     <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoHapus" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoSize" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoTipe" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoKat" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoJns" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoMerk" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoWarna" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoSat" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoMataUang" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoJabatan" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoPajak" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoBank" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoUser" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoCompany" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoGroupUser" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoSizeRun" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoPerkiraan" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoBarang" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoHarga" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoReportStock" style="color:#00F;">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top" id="tmpInfoRekanBisnis" style="color:#00F;">&nbsp;</td>
    </tr>
  </table>
</form>

<script language="javascript">
cal1_al1 = new dhtmlXCalendarObject({
			input: "tgl1_al1",button: "btnTgl1_al1"
	});
cal1_al1.setDateFormat("%Y-%m-%d");
// Mulai
function mulai() {
	document.getElementById('tmpInfoHapus').innerHTML = "";
	document.getElementById('tmpInfoSize').innerHTML = "";
	document.getElementById('tmpInfoTipe').innerHTML = "";
	document.getElementById('tmpInfoKat').innerHTML = "";
	document.getElementById('tmpInfoJns').innerHTML = "";
	document.getElementById('tmpInfoMerk').innerHTML = "";
	document.getElementById('tmpInfoWarna').innerHTML = "";
	document.getElementById('tmpInfoSat').innerHTML = "";
	document.getElementById('tmpInfoMataUang').innerHTML = "";
	document.getElementById('tmpInfoJabatan').innerHTML = "";
	document.getElementById('tmpInfoPajak').innerHTML = "";
	document.getElementById('tmpInfoBank').innerHTML = "";
	document.getElementById('tmpInfoUser').innerHTML = "";
	document.getElementById('tmpInfoCompany').innerHTML = "";
	document.getElementById('tmpInfoGroupUser').innerHTML = "";
	document.getElementById('tmpInfoSizeRun').innerHTML = "";
	document.getElementById('tmpInfoPerkiraan').innerHTML = "";
	document.getElementById('tmpInfoBarang').innerHTML = "";
	document.getElementById('tmpInfoHarga').innerHTML = "";
	document.getElementById('tmpInfoReportStock').innerHTML = "";
	document.getElementById('tmpInfoRekanBisnis').innerHTML = "";
	hapusData(0,0);
}
// Hapus Data
function hapusData(baris,jml) {
     if(baris==0) {
			document.getElementById('tmpInfoHapus').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/hapusData", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoHapus').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="hapusData(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoHapus').innerHTML = "Menjalankan Perintah Hapus Data, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_size_barang(0,0);
				return
			} else {
				hapusData(barisRec,jmlRec);
			}
		});
}

// Operasi Form
function ref_size_barang(baris,jml) {
	
	if(baris==0) {
			document.getElementById('tmpInfoSize').innerHTML = ""; 
	 }

	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/size_barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoSize').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_size_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoSize').innerHTML = "Sedang Mengirim Data Size Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_tipe_barang(0,0);
				return
			} else {
				ref_size_barang(barisRec,jmlRec);
			}
		});
}

function ref_tipe_barang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoTipe').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/tipe_barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoTipe').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_tipe_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoTipe').innerHTML = "Sedang Mengirim Data Tipe Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_kat_barang(0,0);
				return;	
			} else {
				ref_tipe_barang(barisRec,jmlRec);
			}
		});
}

function ref_kat_barang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoKat').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/kat_barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoKat').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_kat_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoKat').innerHTML = "Sedang Mengirim Data Kategori Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_jns_barang(0,0);
				return;	
			} else {
				ref_kat_barang(barisRec,jmlRec);
			}
		});
}

function ref_jns_barang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoJns').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/jns_barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoJns').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_jns_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoJns').innerHTML = "Sedang Mengirim Data Jenis Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_merk_barang(0,0);
				return;	
			} else {
				ref_jns_barang(barisRec,jmlRec);
			}
		});
}

function ref_merk_barang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoMerk').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/merk_barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoMerk').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_merk_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoMerk').innerHTML = "Sedang Mengirim Data Merk Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_warna_barang(0,0);
				return;	
			} else {
				ref_merk_barang(barisRec,jmlRec);
			}
		});
}

function ref_warna_barang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoWarna').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/warna_barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoWarna').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_warna_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoWarna').innerHTML = "Sedang Mengirim Data Warna Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_sat_barang(0,0);
				return;	
			} else {
				ref_warna_barang(barisRec,jmlRec);
			}
		});
}

function ref_sat_barang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoSat').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/sat_barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoSat').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_sat_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoSat').innerHTML = "Sedang Mengirim Data Satuan Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_mataUang(0,0);
				return;	
			} else {
				ref_sat_barang(barisRec,jmlRec);
			}
		});
}

function ref_mataUang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoMataUang').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/mata_uang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoMataUang').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_mataUang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoMataUang').innerHTML = "Sedang Mengirim Data Mata Uang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_jabatan(0,0);
				return;	
			} else {
				ref_mataUang(barisRec,jmlRec);
			}
		});
}

function ref_jabatan(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoJabatan').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/jabatan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoJabatan').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_jabatan(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoJabatan').innerHTML = "Sedang Mengirim Data Jabatan, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_pajak(0,0)
				return;	
			} else {
				ref_jabatan(barisRec,jmlRec);
			}
		});
}

function ref_pajak(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoPajak').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/pajak", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoPajak').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_pajak(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoPajak').innerHTML = "Sedang Mengirim Data Pajak, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_bank(0,0)
				return;	
			} else {
				ref_pajak(barisRec,jmlRec);
			}
		});
}

function ref_bank(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoBank').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/bank", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoBank').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_bank(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoBank').innerHTML = "Sedang Mengirim Data Bank, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_user(0,0);
				return;	
			} else {
				ref_bank(barisRec,jmlRec);
			}
		});
}

function ref_user(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoUser').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/user", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoUser').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_user(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoUser').innerHTML = "Sedang Mengirim Data User, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_company(0,0);
				return;	
			} else {
				ref_user(barisRec,jmlRec);
			}
		});
}

function ref_company(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoCompany').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
			
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/company", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoCompany').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_company(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoCompany').innerHTML = "Sedang Mengirim Data Company, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_groups_user(0,0);
				return;	
			} else {
				ref_company(barisRec,jmlRec);
			}
		});
}

function ref_groups_user(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoGroupUser').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
		if(baris==0) {
			document.getElementById('tmpInfoGroupUser').innerHTML = "Persiapan Mengambil Data Groups User.....";
		}
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/groups_user", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoGroupUser').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_groups_user(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoGroupUser').innerHTML = "Sedang Mengirim Data Group User, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				ref_sizeRun(0,0);
				return;	
			} else {
				ref_groups_user(barisRec,jmlRec);
			}
		});
}

function ref_sizeRun(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoSizeRun').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
		if(baris==0) {
			document.getElementById('tmpInfoSizeRun').innerHTML = "Persiapan Mengambil Data Shortment.....";
		}
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/size_run", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoSizeRun').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="ref_sizeRun(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoSizeRun').innerHTML = "Sedang Mengirim Data Shortment, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				perkiraan(0,0);
				return;	
			} else {
				ref_sizeRun(barisRec,jmlRec);
			}
		});
}

function perkiraan(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoPerkiraan').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
		if(baris==0) {
			document.getElementById('tmpInfoPerkiraan').innerHTML = "Persiapan Mengambil Data Perkiraan.....";
		}
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/perkiraan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoPerkiraan').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="perkiraan(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoPerkiraan').innerHTML = "Sedang Mengirim Data Perkiraan, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				master_barang(0,0);
				return;	
			} else {
				perkiraan(barisRec,jmlRec);
			}
		});
}

function master_barang(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoBarang').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
		if(baris==0) {
			document.getElementById('tmpInfoBarang').innerHTML = "Persiapan Mengambil Data Barang.....";
		}
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/barang", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoBarang').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="master_barang(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoBarang').innerHTML = "Sedang Mengirim Data Barang, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				harga_jual(0,0);
				return;	
			} else {
				master_barang(barisRec,jmlRec);
			}
		});
}

function harga_jual(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoHarga').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
		if(baris==0) {
			document.getElementById('tmpInfoHarga').innerHTML = "Persiapan Mengambil Data Harga Jual.....";
		}
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/harga_jual", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoHarga').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="harga_jual(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoHarga').innerHTML = "Sedang Mengirim Data Harga Jual, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				report_stock(0,0);
				return;	
			} else {
				harga_jual(barisRec,jmlRec);
			}
		});
}

function report_stock(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoReportStock').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
		if(baris==0) {
			document.getElementById('tmpInfoReportStock').innerHTML = "Persiapan Mengambil Data Report Stock.....";
		}
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/report_stock", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoReportStock').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="report_stock(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoReportStock').innerHTML = "Sedang Mengirim Data Report Stock, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				rekan_bisnis(0,0);
				return;	
			} else {
				report_stock(barisRec,jmlRec);
			}
		});
}

function rekan_bisnis(baris,jml) {
	if(baris==0) {
			document.getElementById('tmpInfoRekanBisnis').innerHTML = ""; 
	 }
	// Proses Simpan
 	var poststr =
			'baris=' + baris +
            '&jml=' + jml +
			'&tgl_1=' + document.frm_al1.tgl1_al1.value;
		if(baris==0) {
			document.getElementById('tmpInfoRekanBisnis').innerHTML = "Persiapan Mengirim Data Rekan Bisnis.....";
		}
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/rekan_bisnis", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result=='0') {
				document.getElementById('tmpInfoRekanBisnis').innerHTML = 'Koneksi Terputus <a href="javascript:void(0);" onClick="rekan_bisnis(0,0);">Muat Ulang</a>';
				return;
			}
			arr = result.split("|");
			barisRec = arr[0];
			jmlRec = arr[1];
			document.getElementById('tmpInfoRekanBisnis').innerHTML = "Sedang Mengirim Data Rekan Bisnis, Proses : "+barisRec+" Dari :"+jmlRec;
			if(barisRec == jmlRec) {
				terakhir_kirim();
				return;	
			} else {
				rekan_bisnis(barisRec,jmlRec);
			}
		});
}

function terakhir_kirim() {
	baris = "";
	var poststr =
			'baris=' + baris;	
	 dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_data/updateTglKirim", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			 document.frm_al1.tgl1_al1.value = result;
			alert("Pengiriman Data Sudah Selesai");
			
	 });
}

</script>
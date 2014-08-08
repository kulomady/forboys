<script language="javascript">
tabbar_mk3 = new dhtmlXTabBar("a_tabbar_mk3", "top");
tabbar_mk3.setSkin('dhx_skyblue');
tabbar_mk3.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
tabbar_mk3.addTab("a1", "Data 1", "100px");
tabbar_mk3.addTab("a2", "Data 2", "110px");
tabbar_mk3.addTab("a3", "Data 3", "110px");
tabbar_mk3.setHrefMode("ajax-html");
<?php if(!isset($id)) { ?>
tabbar_mk3.setContentHref("a1", "<?php echo base_url(); ?>index.php/surat_pesanan/frm_input_1");
tabbar_mk3.setContentHref("a2", "<?php echo base_url(); ?>index.php/surat_pesanan/frm_input_2");
tabbar_mk3.setContentHref("a3", "<?php echo base_url(); ?>index.php/surat_pesanan/frm_input_3");
<?php } else { ?>
tabbar_mk3.setContentHref("a1", "<?php echo base_url(); ?>index.php/surat_pesanan/frm_edit_1/<?php echo $id ?>");
tabbar_mk3.setContentHref("a2", "<?php echo base_url(); ?>index.php/surat_pesanan/frm_edit_2/<?php echo $id ?>"); 
tabbar_mk3.setContentHref("a3", "<?php echo base_url(); ?>index.php/surat_pesanan/frm_edit_3/<?php echo $id ?>");    
<?php } ?>    
tabbar_mk3.setTabActive("a1");
tabbar_mk3.setTabActive("a2");
tabbar_mk3.setTabActive("a3");
tabbar_mk3.setTabActive("a1");

</script>
<table width="603">
  <tr>
    <td><div id="a_tabbar_mk3" style="width:930px; height:590px; background-color:#FFFFCC;"/></td>
  </tr>
</table>

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
	
	function baru_mk3(){
		document.frm_mk31.id.value = "";
		document.frm_mk31.no.value = "";
		document.frm_mk31.kode_pelanggan.value = "";
		document.frm_mk31.kode_member.value = "";
		document.frm_mk31.nama_member.value = "";
		document.frm_mk31.nama_pemesan.value = "";
		document.frm_mk31.agama.value = "";
		document.frm_mk31.alamat.value = "";
		document.frm_mk31.pos.value = "";
		document.frm_mk31.tlp_rumah.value = "";
		document.frm_mk31.tlp_hp.value = "";
		document.frm_mk31.tlp_kantor.value = "";
		document.frm_mk31.fax.value = "";
		document.frm_mk31.identitas.value = "";
		document.frm_mk31.tgl_lahir.value = "";
		document.frm_mk31.email.value = "";
		document.frm_mk31.npwp.value = "";		
		document.frm_mk31.alamat_surat.value = "";
		document.frm_mk31.pos_surat.value = "";
		document.frm_mk31.unit_pesan.value = "";
		document.frm_mk31.develop.value = "0";
		document.frm_mk31.no_unit.value = "";
		document.frm_mk31.status_unit.value = "";
		document.frm_mk31.type_badroom.value = "";
		document.frm_mk31.luas.value = "";
		document.frm_mk31.tower.value = "";
		document.frm_mk31.floor_no.value = "";
		document.frm_mk31.unfurnished.checked = false;
		document.frm_mk31.semifurnished.checked = false;
		document.frm_mk31.semifurnished.checked = false;
		document.frm_mk31.fullfurnished.checked = false;
		document.frm_mk31.bare.checked = false;
		document.frm_mk31.develop_landed.value = "0";
		document.frm_mk31.status_landed.value = "";
		document.frm_mk31.type_landed.value = "";
		document.frm_mk31.ltlb.value = "";
		document.frm_mk31.no_unit_landed.value = "";
		document.frm_mk31.unfurnished2.checked = false;
		document.frm_mk31.semifurnished2.checked = false;
		document.frm_mk31.fullfurnished2.checked = false;
		document.frm_mk31.bare2.checked = false;
		document.frm_mk32.harga_jual.value = "";
		document.frm_mk32.harga_jual2.value = "";
		document.frm_mk32.tunai.checked = false;
		document.frm_mk32.cicilan_bertahap.checked = false;
		document.frm_mk32.kpr_kpa.checked = false;
		document.frm_mk32.ready.checked = false;
		document.frm_mk32.lain_booking.checked = false;
		document.frm_mk32.txt_lain_booking.value = "";
		document.frm_mk32.um24.checked = false;
		document.frm_mk32.um36.checked = false;
		document.frm_mk32.umLain.checked = false;
		document.frm_mk32.txt_uang_muka.value = "";
		document.frm_mk32.tgl1.value = "";
		document.frm_mk32.uang1.value = "";
		document.frm_mk32.tgl2.value = "";
		document.frm_mk32.uang2.value = "";
		document.frm_mk32.tgl3.value = "";
		document.frm_mk32.uang3.value = "";
		document.frm_mk32.tgl4.value = "";
		document.frm_mk32.uang4.value = "";
		document.frm_mk32.check_loan.value = "";
		document.frm_mk32.lunas_cair.value = "";
		document.frm_mk32.nm_lembaga.value = "";
		document.frm_mk32.koran.checked = false;
		document.frm_mk32.billboard.checked = false;
		document.frm_mk32.undangan.checked = false;
		document.frm_mk32.majalah.checked = false;
		document.frm_mk32.tv_radio.checked = false;
		document.frm_mk32.pager_grafis.checked = false;
		document.frm_mk32.lisan.checked = false;
		document.frm_mk32.lain.checked = false;
		document.frm_mk32.lain_promosi.value = "";
		document.frm_mk32.kantor_pusat.checked = false;
		document.frm_mk32.exhibition.checked = false;
		document.frm_mk32.sales.checked = false;
		document.frm_mk32.events.checked = false;
		document.frm_mk32.daily.checked = false;
		document.frm_mk32.lain_pos.checked = false;
		document.frm_mk32.txt_lain_pos.value = "";
		document.frm_mk32.txt_exhibition.value = "";
		document.frm_mk32.txt_event.value = "";
		document.frm_mk32.ftb.checked = false;
		document.frm_mk32.eb.checked = false;
		document.frm_mk32.eu.checked = false;
		document.frm_mk32.invest.checked = false;
		document.frm_mk33.tanda_terima.value = "";
		document.frm_mk33.setor_tt.checked = false;
		document.frm_mk33.credit_cart_tt.checked = false;
		document.frm_mk33.lain_tt.checked = false;
		document.frm_mk33.txt_no_credit.value = "";
		document.frm_mk33.setor_bank.value = "";
		document.frm_mk33.setor_tgl.value = "";
		document.frm_mk33.setor_no.value = "";
		document.frm_mk33.txt_lain_tt.value = "";		
		document.frm_mk33.koor_selling.value = "";
		document.frm_mk33.selling.value = "";
		document.frm_mk33.koor_listing.value = "";
		document.frm_mk33.listing.value = "";
		disabledForm();
		document.frm_mk32.txt_lain_booking.disabled = true;
		document.frm_mk32.txt_uang_muka.disabled = true;
		document.frm_mk32.lunas_cair.disabled = true;
		document.frm_mk32.nm_lembaga.disabled = true;
		document.frm_mk32.lain_promosi.disabled = true;
		document.frm_mk32.txt_exhibition.disabled = true;
		document.frm_mk32.txt_event.disabled = true;
		document.frm_mk32.txt_lain_pos.disabled = true;
		document.frm_mk33.txt_no_credit.disabled = true;
		document.frm_mk33.setor_bank.disabled = true;
		document.frm_mk33.setor_tgl.disabled = true;
		document.frm_mk33.setor_no.disabled = true;
		document.frm_mk33.txt_lain_tt.disabled = true;
		document.frm_mk33.nmkoor_selling.disabled = true;
		document.frm_mk33.nm_selling.disabled = true;
		document.frm_mk33.nmkoor_listing.disabled = true;
		document.frm_mk33.nm_listing.disabled = true;
	}
	
function simpan_mk3(){
	if(document.frm_mk31.kode_pelanggan.value==""){
		alert("Kode Pelanggan Tidak Boleh Kosong!");
		tabbar_mk3.setTabActive("a1");
		document.frm_mk31.kode_pelanggan.focus();
		return false;
	}
	
	if(document.frm_mk31.kode_member.value==""){
		alert("Kode Member Tidak Boleh Kosong!");
		tabbar_mk3.setTabActive("a1");
		document.frm_mk31.kode_member.focus();
		return false;
	}
	
	if(document.frm_mk31.tlp_hp.value==""){
		alert("No. Telp Tidak Boleh Kosong!");
		tabbar_mk3.setTabActive("a1");
		document.frm_mk31.tlp_hp.focus();
		return false;
	}
	
	if(document.frm_mk31.identitas.value==""){
		alert("No. Identitas Tidak Boleh Kosong!");
		tabbar_mk3.setTabActive("a1");
		document.frm_mk31.identitas.focus();
		return false;
	}
	
	if(document.frm_mk32.harga_jual.value==""){
		alert("Harga Jual Sebelum PPN Tidak Boleh Kosong!");
		tabbar_mk3.setTabActive("a2");
		document.frm_mk32.harga_jual.focus();
		return false;
	}
	
	if(document.frm_mk32.harga_jual2.value==""){
		alert("Harga Jual Setelah PPN Tidak Boleh Kosong!");
		tabbar_mk3.setTabActive("a2");
		document.frm_mk32.harga_jual2.focus();
		return false;
	}
	
	if(document.frm_mk31.status_unit.value != ""){
		if(document.frm_mk31.status_unit.value == 0){
			if(document.frm_mk33.nmkoor_selling.value==""){
				alert("Koordinator Selling Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nmkoor_selling.focus();
				return false;
			}
			
			if(document.frm_mk33.nm_selling.value==""){
				alert("Selling Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nm_selling.focus();
				return false;
			}
			
			if(document.frm_mk33.nmkoor_listing.value==""){
				alert("Koordinator Listing Setelah PPN Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nmkoor_listing.focus();
				return false;
			}
			
			if(document.frm_mk33.nm_listing.value==""){
				alert("Listing Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nm_listing.focus();
				return false;
			}
		}
	} else if(document.frm_mk31.status_landed.value != ""){
		if(document.frm_mk31.status_landed.value == 0){
			if(document.frm_mk33.nmkoor_selling.value==""){
				alert("Koordinator Selling Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nmkoor_selling.focus();
				return false;
			}
			
			if(document.frm_mk33.nm_selling.value==""){
				alert("Selling Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nm_selling.focus();
				return false;
			}
			
			if(document.frm_mk33.nmkoor_listing.value==""){
				alert("Koordinator Listing Setelah PPN Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nmkoor_listing.focus();
				return false;
			}
			
			if(document.frm_mk33.nm_listing.value==""){
				alert("Listing Tidak Boleh Kosong!");
				tabbar_mk3.setTabActive("a3");
				document.frm_mk33.nm_listing.focus();
				return false;
			}
		}
	}
	
	if(document.frm_mk31.unfurnished.checked == true){
		spek = document.frm_mk31.unfurnished.value;
	} else if(document.frm_mk31.semifurnished.checked == true){
		spek = document.frm_mk31.semifurnished.value;
	} else if(document.frm_mk31.fullfurnished.checked == true){
		spek = document.frm_mk31.fullfurnished.value;
	} else if(document.frm_mk31.bare.checked == true){
		spek = document.frm_mk31.bare.value;
	} else {
		spek = 0;
	}
	
	if(document.frm_mk31.unfurnished2.checked == true){
		spek2 = document.frm_mk31.unfurnished2.value;
	} else if(document.frm_mk31.semifurnished2.checked == true){
		spek2 = document.frm_mk31.semifurnished2.value;
	} else if(document.frm_mk31.fullfurnished2.checked == true){
		spek2 = document.frm_mk31.fullfurnished2.value;
	} else if(document.frm_mk31.bare2.checked == true){
		spek2 = document.frm_mk31.bare2.value;
	} else {
		spek2 = 0;
	}
	
	if(document.frm_mk32.tunai.checked == true){
		cara = document.frm_mk32.tunai.value;
	} else if(document.frm_mk32.cicilan_bertahap.checked == true){
		cara = document.frm_mk32.cicilan_bertahap.value;
	} else if(document.frm_mk32.kpr_kpa.checked == true){
		cara = document.frm_mk32.kpr_kpa.value;
	}
	
	if(document.frm_mk32.ready.checked == true){
		booking = document.frm_mk32.ready.value;
	} else if(document.frm_mk32.lain_booking.checked == true){
		booking = document.frm_mk32.lain_booking.value;
	}
	
	if(document.frm_mk32.um24.checked == true){
		uangmuka = document.frm_mk32.um24.value;
	} else if(document.frm_mk32.um36.checked == true){
		uangmuka = document.frm_mk32.um36.value;
	} else if(document.frm_mk32.umLain.checked == true){
		uangmuka = document.frm_mk32.umLain.value;
	}
	
	if(document.frm_mk32.koran.checked == true){ koran = 'koran'; } else { koran = 0; }
	if(document.frm_mk32.billboard.checked == true){ billboard = 'billboard'; } else { billboard = 0; }
	if(document.frm_mk32.undangan.checked == true){ undangan = 'undangan'; } else { undangan = 0; }
	if(document.frm_mk32.majalah.checked == true){ majalah = 'majalah'; } else { majalah = 0; }
	if(document.frm_mk32.tv_radio.checked == true){ tv_radio = 'tv_radio'; } else { tv_radio = 0; }
	if(document.frm_mk32.pager_grafis.checked == true){ pager_grafis = 'pager_grafis'; } else { pager_grafis = 0; }
	if(document.frm_mk32.lisan.checked == true){ lisan = 'lisan'; } else { lisan = 0; }
	if(document.frm_mk32.lain.checked == true){ lain = 'lain'; } else { lain = 0; }
	var promosi = koran+'|'+billboard+'|'+undangan+'|'+majalah+'|'+tv_radio+'|'+pager_grafis+'|'+lisan+'|'+lain;
	
	if(document.frm_mk32.kantor_pusat.checked == true){ kantor_pusat = 'kantor_pusat'; } else { kantor_pusat = 0; }
	if(document.frm_mk32.exhibition.checked == true){ exhibition = 'exhibition'; } else { exhibition = 0; }
	if(document.frm_mk32.sales.checked == true){ sales = 'sales'; } else { sales = 0; }
	if(document.frm_mk32.events.checked == true){ events = 'events'; } else { events = 0; }
	if(document.frm_mk32.daily.checked == true){ daily = 'daily'; } else { daily = 0; }
	if(document.frm_mk32.lain_pos.checked == true){ lain_pos = 'lain_pos'; } else { lain_pos = 0; }
	var pos = kantor_pusat+'|'+exhibition+'|'+sales+'|'+events+'|'+daily+'|'+lain_pos;
	
	if(document.frm_mk32.ftb.checked == true){ ftb = 'ftb'; } else { ftb = 0; }
	if(document.frm_mk32.eb.checked == true){ eb = 'eb'; } else { eb = 0; }
	if(document.frm_mk32.eu.checked == true){ eu = 'eu'; } else { eu = 0; }
	if(document.frm_mk32.invest.checked == true){ invest = 'invest'; } else { invest = 0; }
	var pos2 = ftb+'|'+eb+'|'+eu+'|'+invest;
	
	if(document.frm_mk33.setor_tt.checked == true){
		jtt = document.frm_mk33.setor_tt.value;
	} else if(document.frm_mk33.credit_cart_tt.checked == true){
		jtt = document.frm_mk33.credit_cart_tt.value;
	} else if(document.frm_mk33.lain_tt.checked == true){
		jtt = document.frm_mk33.lain_tt.value;
	}
	
	var harga_jual = $('#harga_jual').val();
	var harga_jual2 = $('#harga_jual2').val();
	var tanda_terima = $('#tanda_terima').val();
	var poststr =
		'id=' + document.frm_mk31.id.value +
		'&sp=' + document.frm_mk31.no.value +
		'&kode_pelanggan=' + document.frm_mk31.kode_pelanggan.value +
		'&kode_member=' + document.frm_mk31.kode_member.value +
		'&alamat_surat=' + document.frm_mk31.alamat_surat.value +
		'&pos_surat=' + document.frm_mk31.pos_surat.value +
		'&unit_pesan=' + document.frm_mk31.unit_pesan.value +
		'&develop=' + document.frm_mk31.develop.value +
		'&no_unit=' + document.frm_mk31.no_unit.value +
		'&status_unit=' + document.frm_mk31.status_unit.value +
		'&type_badroom=' + document.frm_mk31.type_badroom.value +
		'&luas=' + document.frm_mk31.luas.value +
		'&tower=' + document.frm_mk31.tower.value +
		'&floor_no=' + document.frm_mk31.floor_no.value +
		'&spek=' + spek +
		'&develop_landed=' + document.frm_mk31.develop_landed.value +
		'&status_landed=' + document.frm_mk31.status_landed.value +
		'&type_landed=' + document.frm_mk31.type_landed.value +
		'&ltlb=' + document.frm_mk31.ltlb.value +
		'&no_unit_landed=' + document.frm_mk31.no_unit_landed.value +
		'&spek2=' + spek2 +
		'&harga_jual=' + harga_jual +
		'&harga_jual2=' + harga_jual2 +
		'&cara=' + cara +
		'&booking=' + booking +
		'&txt_lain_booking=' + document.frm_mk32.txt_lain_booking.value +
		'&uangmuka=' + uangmuka +
		'&txt_uang_muka=' + document.frm_mk32.txt_uang_muka.value +
		'&tgl1=' + document.frm_mk32.tgl1.value +
		'&uang1=' + document.frm_mk32.uang1.value +
		'&tgl2=' + document.frm_mk32.tgl2.value +
		'&uang2=' + document.frm_mk32.uang2.value +
		'&tgl3=' + document.frm_mk32.tgl3.value +
		'&uang3=' + document.frm_mk32.uang3.value +
		'&tgl4=' + document.frm_mk32.tgl4.value +
		'&uang4=' + document.frm_mk32.uang4.value +
		'&check_loan=' + document.frm_mk32.check_loan.value +
		'&lunas_cair=' + document.frm_mk32.lunas_cair.value +
		'&nm_lembaga=' + document.frm_mk32.nm_lembaga.value +
		'&promosi=' + promosi +
		'&txt_promosi=' + document.frm_mk32.lain_promosi.value +
		'&pos=' + pos +
		'&txt_pos=' + document.frm_mk32.txt_lain_pos.value +
		'&txt_exhibition=' + document.frm_mk32.txt_exhibition.value +
		'&txt_event=' + document.frm_mk32.txt_event.value +
		'&pos2=' + pos2 +
		'&tanda_terima=' + tanda_terima +
		'&jns_tanda_terima=' + jtt +
		'&no_credit=' + document.frm_mk33.txt_no_credit.value +
		'&setor_bank=' + document.frm_mk33.setor_bank.value +
		'&setor_tgl=' + document.frm_mk33.setor_tgl.value +
		'&setor_noslip=' + document.frm_mk33.setor_no.value +
		'&txt_tanda_terima=' + document.frm_mk33.txt_lain_tt.value +		
		'&koor_selling=' + document.frm_mk33.koor_selling.value +
		'&selling=' + document.frm_mk33.selling.value +
		'&koor_listing=' + document.frm_mk33.koor_listing.value +
		'&listing=' + document.frm_mk33.listing.value;
	statusLoading();   
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/surat_pesanan/simpan", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		document.frm_mk31.no.value = result;
		statusEnding();
		refreshGd_mk3();
		tb_w1_mk3.disableItem("save");
		tb_w1_mk3.enableItem("baru");
	});		
}
</script>
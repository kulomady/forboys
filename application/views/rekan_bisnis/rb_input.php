<div class="frmContainer">
<form name="frm_md1" id="frm_md1" method="post" action="javascript:void(0);">
<div id="a_tabbar_md1" style="width:685px; height:426px;"/>

<div id='content_a1_md1' class="frmContainer">
  <table width="670" border="0" align="center">
    <tr>
      <td width="112">Rekan ID</td>
      <td width="223"><input name="txtIdRekan" type="text" id="txtIdRekan" size="5" readonly="readonly" value="<?php if(isset($idrekan)): echo $idrekan; endif; ?>" placeholder="[AUTO]"></td>
      <td width="100"><input type="hidden" name="idrec" id="idrec" value="<?php if(isset($idrec)): echo $idrec; endif; ?>" /></td>
      <td width="217">&nbsp;</td>
    </tr>
    <tr>
      <td>Type Rekan</td>
      <td><select name="txtTypeRekan" id="txtTypeRekan" onchange="blokTypeRekan(this.value);">
      	<?php echo $pilihTypeRekan; ?>
      </select></td>
      <td style="display:none;">&nbsp;</td>
      <td style="display:none;">&nbsp;</td>
    </tr>
    <tr>
      <td>Nama Rekan</td>
      <td><input type="text" name="txtNmRekan" id="txtNmRekan" value="<?php if(isset($nmrekan)): echo $nmrekan; endif;?>"></td>
      <td style="display:none;">&nbsp;</td>
      <td style="display:none;">&nbsp;</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><a href="javascript:void(0);" onclick="WinTambahAlamat_md1();">[Tambah]</a> <a href="javascript:void(0);" onclick="hapusAlamat_md1();">[Hapus]</a></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" valign="top"><div id="gridAlamat_md1" style="width:625px; height:150px;"/></td>
      </tr>
    
    <tr>
      <td valign="top">Mewakili</td>
      <td valign="top"><select name="slcMewakili" id="slcMewakili">
      	<?php echo $pilihMewakili; ?>
      </select></td>
      <td>Fax</td>
      <td><input type="text" name="txtFax" id="txtFax"  value="<?php if(isset($fax)): echo $fax; endif;?>"></td>
    </tr>
    <tr>
      <td valign="top">Telepon 1</td>
      <td valign="top"><input type="text" name="txtTlp_1" id="txtTlp_1" value="<?php if(isset($telp_1)): echo $telp_1; endif;?>"></td>
      <td>E-mail</td>
      <td><input type="text" name="txtEmail" id="txtEmail" style="text-transform:none;" value="<?php if(isset($email)): echo $email; endif;?>"></td>
    </tr>
    <tr>
      <td valign="top">Telepon 2</td>
      <td valign="top"><input type="text" name="txtTlp_2" id="txtTlp_2" value="<?php if(isset($telp_2)): echo $telp_2; endif;?>"></td>
      <td>Website</td>
      <td><input type="text" name="txtWebsite" id="txtWebsite" style="text-transform:none;" value="<?php if(isset($website)): echo $website; endif;?>"></td>
    </tr>
    <tr>
      <td valign="top">Telepon 3</td>
      <td valign="top"><input type="text" name="txtTlp_3" id="txtTlp_3" value="<?php if(isset($telp_3)): echo $telp_3; endif;?>"></td>
      <td>Nama Kontak</td>
      <td><select name="slcPanggilan" id="slcPanggilan">
      	<?php echo $pilihPanggilan; ?>
      </select>
        <input type="text" name="txtNamaKontak" id="txtNamaKontak" value="<?php if(isset($kotak_orang)): echo $kotak_orang; endif;?>" /></td>
    </tr>
    <tr>
      <td valign="top">PIN BB</td>
      <td valign="top"><input type="text" name="txtTlp_4" id="txtTlp_4" value="<?php if(isset($telp_3)): echo $telp_3; endif;?>" /></td>
      <td>Cabang</td>
      <td><select name="cabang" id="cabang" style="width:150px;">
        <?php echo $cabang; ?>
            </select></td>
    </tr>
  </table>
</div>
<!-- Transaksi -->
<div id='content_a2_md1' class="frmContainer" style="height:670px;">
  <table width="670" border="0" align="center">
    <tr>
      <td width="130">Akun Pendapatan</td>
      <td width="78"><input name="txtidperkiraan" type="text" id="txtidperkiraan" size="5" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>"  />&nbsp;<span id="tmpTblPerkiraan"><img name="btnakun_md1" id="btnakun_md1" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_md1();" /></span></td>
      <td width="126" id="tmpNmPerkiraan_md1" style="color:#0000FF;"><?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?></td>
      <td width="140">Batas Piutang</td>
      <td width="174"><input name="txtBatasPiutang" type="text" id="txtBatasPiutang" size="10" value="<?php if(isset($limit_hutang_piutang)): echo $limit_hutang_piutang; endif;?>"></td>
    </tr>
    <tr>
      <td>Catatan</td>
      <td colspan="2"><input type="text" name="txtCatatan" id="txtCatatan" value="<?php if(isset($cat_transaksi)): echo $cat_transaksi; endif;?>"></td>
      <td>SIUP</td>
      <td><input type="text" name="txtSiup" id="txtSiup" value="<?php if(isset($siup)): echo $siup; endif;?>"></td>
    </tr>
    <tr>
      <td>Pramuniaga</td>
      <td><input name="txtidPramuniaga" type="text" id="txtidPramuniaga" size="5" value="<?php if(isset($idpramuniaga)): echo $idpramuniaga; endif;?>" />
&nbsp;<span id="tmpPramuniaga"><img name="btnakun_md1" id="btnakun_md2" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winSales_md1();" /></span></td>
      <td id="tmpNmRekan_md1" style="color:#0000FF;"><?php if(isset($nmpramuniaga)): echo $nmpramuniaga; endif;?></td>
      <td>NPWP</td>
      <td><input type="text" name="txtNpwp" id="txtNpwp" value="<?php if(isset($npwp)): echo $npwp; endif;?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Termin Pembayaran</td>
      <td colspan="2" valign="top"><select name="slcTermin" id="slcTermin">
      	<?php echo $pilihTerminPembayaran; ?>
      </select>      </td>
      <td valign="top">Disc Bayar Lebih Awal </td>
      <td valign="top"><input name="txtDiscByrLbhAwal" type="text" id="txtDiscByrLbhAwal" size="5" value="<?php if(isset($diskon_pemb_lbh_awal)): echo $diskon_pemb_lbh_awal; endif;?>">
        %</td>
    </tr>
    <tr>
      <td valign="top">Diskon Sampai</td>
      <td colspan="2" valign="top"><input name="txtDiscSampai" type="text" id="txtDiscSampai" size="5" value="<?php if(isset($diskon_hari)): echo $diskon_hari; endif;?>">
        Hari</td>
      <td valign="top">Denda Keterlambatan</td>
      <td valign="top"><input name="txtDendaKeterlambatan" type="text" id="txtDendaKeterlambatan" size="5" value="<?php if(isset($denda_terlambat_byr)): echo $denda_terlambat_byr; endif;?>">
        %</td>
    </tr>
    <tr>
      <td valign="top">Jatuh Tempo</td>
      <td colspan="2" valign="top"><input name="txtJatuhTempo" type="text" id="textfield15" size="5" value="<?php if(isset($jth_tempo_hari)): echo $jth_tempo_hari; endif;?>">
        Hari</td>
      <td valign="top">Disc </td>
      <td valign="top"><input name="txtDiscVol" type="text" id="txtDiscVol" size="2" value="<?php if(isset($disc_volume)): echo $disc_volume; endif;?>">
        %, Volume
          <input name="txtVol" type="text" id="txtVol" size="2" value="<?php if(isset($volume_beli)): echo $volume_beli; endif;?>"></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td colspan="2" valign="top">&nbsp;</td>
      <td valign="top">Group Pelanggan</td>
      <td valign="top"><select name="slcGrupPelanggan" id="slcGrupPelanggan">
      <?php echo $pilihGrupPelanggan; ?>
        </select>      </td>
    </tr>
    <tr>
      <td valign="top">Gaji Karyawan</td>
      <td colspan="2" valign="top"><input type="text" name="txtGajiKry" id="txtGajiKry" value="<?php if(isset($gaji_rate)): echo $gaji_rate; endif;?>" style="text-align:right;" /></td>
      <td valign="top">Tipe Potongan</td>
      <td valign="top"><select name="slcTipePotongan" id="slcTipePotongan">
      <?php echo $pilihTipePotongan; ?>
        </select>      </td>
    </tr>
    <tr>
      <td valign="top">Ongkos Per Hari</td>
      <td colspan="2" valign="top"><input type="text" name="txtOngkosJam" id="txtOngkosJam" value="<?php if(isset($gaji_jam)): echo $gaji_jam; endif;?>" style="text-align:right;" /></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Referensi Oleh</td>
      <td colspan="2" valign="top"><select name="slcUpline" id="slcUpline">
        <?php echo $pilihKaryawan; ?>
      </select></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Tanggal Masuk</td>
      <td colspan="2" valign="top"><input type="text" name="tglMasuk" id="tglMasuk" readonly size="10" value="<?php if(isset($tglMasuk)): echo $tglMasuk; endif;?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="txttgl_masuk_md1" style="cursor:pointer;" border="0" /></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
  </table>
</div>

<div id='content_a3_md1' class="frmContainer" style="height:670px;">
  <table width="670" border="0" align="center">
    <tr>
      <td width="127">&nbsp;</td>
      <td width="159">Metode Pembayaran</td>
      <td width="218"><select name="slcMetodePembayaran" id="slcMetodePembayaran">
      	<?php echo $pilihMtdPembayaran; ?>
        </select>
      </td>
      <td width="148">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>No. Kartu</td>
      <td><input type="text" name="txtNoKartu" id="txtNoKartu" value="<?php if(isset($no_kartu)): echo $no_kartu; endif;?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tgl Kadaluarsa</td>
      <td><input name="txtKadaluarsa" type="text" id="txtKadaluarsa" size="8" value="<?php if(isset($tgl_kadaluarsa)): echo $tgl_kadaluarsa; endif;?>"> 
      <span id="tmpTglKadaluarsa"><img id="txttgl_exp_md1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Pada Kartu</td>
      <td><input type="text" name="txtNmKartu" id="txtNmKartu" value="<?php if(isset($nama_pdkartu)): echo $nama_pdkartu; endif;?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">Catatan</td>
      <td rowspan="4" valign="top"><textarea name="txtCatPembayaran" id="txtCatPembayaran" cols="30" rows="5"><?php if(isset($cat_pembayaran)): echo $cat_pembayaran; endif;?></textarea></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
  </table>
</div>
</form>
</div>
<script language="javascript">

// tanggal pesen
	cal1_md1 = new dhtmlXCalendarObject({
			input: "tglMasuk",button: "txttgl_masuk_md1"
	});
	cal1_md1.setDateFormat("%d/%m/%Y");
	
$(function() {            
        $('#txtGajiKry').number(true, 2); // id field txttotal dibuat number format, 2 adalah digit decimal
		$('#txtOngkosJam').number(true, 2);
});

tbinput_md1 = new dhtmlXTabBar("a_tabbar_md1", "top");
tbinput_md1.setSkin('dhx_skyblue');
tbinput_md1.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
tbinput_md1.addTab("a1", "Profil", "100px");
tbinput_md1.addTab("a2", "Transaksi", "100px");
tbinput_md1.addTab("a3", "Pembayaran", "100px");
tbinput_md1.setContent("a1", "content_a1_md1");
tbinput_md1.setContent("a2", "content_a2_md1");
tbinput_md1.setContent("a3", "content_a3_md1");
tbinput_md1.setTabActive("a1");

gdAlamat_md1 = new dhtmlXGridObject('gridAlamat_md1');
gdAlamat_md1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdAlamat_md1.setHeader("Lokasi,Alamat,Kota,Kode Pos,idjnsalamat,city_code");
gdAlamat_md1.setInitWidths("170,220,120,80,0,0");
gdAlamat_md1.setColAlign("left,left,left,left,left,left");
gdAlamat_md1.setColTypes("ro,ro,ro,ro,ro,ro");
gdAlamat_md1.setSkin("dhx_skyblue");
gdAlamat_md1.init();

<?php if(isset($idrec)): ?>
	gdAlamat_md1.clearAll();
	gdAlamat_md1.loadXML(base_url+"index.php/rekan_bisnis/loadDataAlamat/<?php echo $idrekan; ?>");
<?php endif; ?>

// tanggal expired card
cal1_md1 = new dhtmlXCalendarObject({
			input: "txtKadaluarsa",button: "txttgl_exp_md1"
	});
cal1_md1.setDateFormat("%d/%m/%Y");

function winAkun_md1() {
	try {
		if(w2_md1.isHidden()==true) {
			w2_md1.show();
			document.getElementById('frmSearchAkun').focus();
		}
		w2_md1.bringToTop();
		return;
	} catch(e) {}
	w2_md1 = dhxWins.createWindow("w2_md1",0,0,430,450);
	w2_md1.setText("Daftar Perkiraan");
	w2_md1.button("park").hide();
	w2_md1.button("minmax1").hide();
	w2_md1.center();
	
	tb_w2_md1 = w2_md1.attachToolbar();
	tb_w2_md1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w2_md1.setSkin("dhx_terrace");
	tb_w2_md1.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w2_md1.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahAkun(13);
		}
	});
	
	w2_md1.attachURL(base_url+"index.php/rekan_bisnis/frm_search_akun", true);
}

function winSales_md1() {
	try {
		if(w3_md1.isHidden()==true) {
			w3_md1.show();
			document.getElementById('frmSearchSales').focus();
		}
		w3_md1.bringToTop();
		return;
	} catch(e) {}
	w3_md1 = dhxWins.createWindow("w3_md1",0,0,430,450);
	w3_md1.setText("Daftar Pramuniaga");
	w3_md1.button("park").hide();
	w3_md1.button("minmax1").hide();
	w3_md1.center();
	
	tb_w3_md1 = w3_md1.attachToolbar();
	tb_w3_md1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w3_md1.setSkin("dhx_terrace");
	tb_w3_md1.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w3_md1.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahSales(13);
		}
	});
	
	w3_md1.attachURL(base_url+"index.php/rekan_bisnis/frm_search_sales", true);
}

function WinTambahAlamat_md1() {
	w4_md1 = dhxWins.createWindow("w4_md1",0,0,350,280);
	w4_md1.setText("Data Alamat");
	w4_md1.button("park").hide();
	w4_md1.button("minmax1").hide();
	w4_md1.center();
	
	tb_w4_md1 = w4_md1.attachToolbar();
	tb_w4_md1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w4_md1.setSkin("dhx_terrace");
	tb_w4_md1.addButton("tambah", 1, "TAMBAH", "add.gif", "add_dis.gif");
	tb_w4_md1.attachEvent("onclick", function(id) {
		if(id=='tambah') {
			tambahAlamat();
		}
	});
	
	w4_md1.attachURL(base_url+"index.php/rekan_bisnis/frm_input_alamat", true);
}

function hapusAlamat_md1() {
	idselect = gdAlamat_md1.getRowIndex(gdAlamat_md1.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
			gdAlamat_md1.deleteSelectedItem();
	}
}

function simpan_md1() {
	arr_idmp = document.frm_md1.slcMetodePembayaran.value.split("-");
 	var poststr =			
			'idrec=' + document.frm_md1.idrec.value +
			'&txtIdRekan=' + document.frm_md1.txtIdRekan.value +
			'&txtTypeRekan=' + document.frm_md1.txtTypeRekan.value +
			'&txtNmRekan=' + document.frm_md1.txtNmRekan.value +
			'&slcMewakili=' + document.frm_md1.slcMewakili.value +
			'&txtTlp_1=' + document.frm_md1.txtTlp_1.value +
			'&txtTlp_2=' + document.frm_md1.txtTlp_2.value +
			'&txtTlp_3=' + document.frm_md1.txtTlp_3.value +
			'&txtFax=' + document.frm_md1.txtFax.value +
			'&txtEmail=' + document.frm_md1.txtEmail.value +
			'&txtWebsite=' + document.frm_md1.txtWebsite.value +
			'&slcPanggilan=' + document.frm_md1.slcPanggilan.value +
			'&txtNamaKontak=' + document.frm_md1.txtNamaKontak.value +
			'&txtidperkiraan=' + document.frm_md1.txtidperkiraan.value +
			'&txtCatatan=' + document.frm_md1.txtCatatan.value +
			'&txtidPramuniaga=' + document.frm_md1.txtidPramuniaga.value +
			'&slcTermin=' + document.frm_md1.slcTermin.value +
			'&txtDiscSampai=' + document.frm_md1.txtDiscSampai.value +
			'&txtJatuhTempo=' + document.frm_md1.txtJatuhTempo.value +
			'&txtBatasPiutang=' + document.frm_md1.txtBatasPiutang.value +
			'&txtSiup=' + document.frm_md1.txtSiup.value +
			'&txtNpwp=' + document.frm_md1.txtNpwp.value +
			'&txtDiscByrLbhAwal=' + document.frm_md1.txtDiscByrLbhAwal.value +
			'&txtDendaKeterlambatan=' + document.frm_md1.txtDendaKeterlambatan.value +
			'&txtDiscVol=' + document.frm_md1.txtDiscVol.value +
			'&txtVol=' + document.frm_md1.txtVol.value +
			'&slcGrupPelanggan=' + document.frm_md1.slcGrupPelanggan.value +
			'&slcTipePotongan=' + document.frm_md1.slcTipePotongan.value +
			'&slcMetodePembayaran=' + arr_idmp[0] +
			'&txtNoKartu=' + document.frm_md1.txtNoKartu.value +
			'&txtKadaluarsa=' + document.frm_md1.txtKadaluarsa.value +
			'&txtNmKartu=' + document.frm_md1.txtNmKartu.value +
			'&txtCatPembayaran=' + document.frm_md1.txtCatPembayaran.value +
			'&txtGajiKry=' + $('#txtGajiKry').val() +
			'&txtOngkosJam=' + $('#txtOngkosJam').val() +
			'&slcUpline=' + document.frm_md1.slcUpline.value +
			'&tglMasuk=' + document.frm_md1.tglMasuk.value +
			'&dataAlamat=' + getData(gdAlamat_md1,[0,2]) +
			'&cabang=' + document.frm_md1.cabang.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/rekan_bisnis/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			arrResult = result.split("|");
			if(arrResult[0] == 1) {
				document.frm_md1.txtIdRekan.value = arrResult[1];
				statusEnding();
				refreshGd_md1();
				tb_w1_md1.disableItem("save");
				tb_w1_md1.disableItem("batal");
				tb_w1_md1.enableItem("baru");
			} else {
				statusEnding();
				alert(result);
			}
		});
}

function baru_md1() {
	document.frm_md1.idrec.value = "";
	document.frm_md1.txtIdRekan.value = "[AUTO]";
	document.frm_md1.txtTypeRekan.value = "";
	document.frm_md1.txtNmRekan.value = "";
	document.frm_md1.slcMewakili.value = "";
	document.frm_md1.txtTlp_1.value = "";
	document.frm_md1.txtTlp_2.value = "";
	document.frm_md1.txtTlp_3.value = "";
	document.frm_md1.txtFax.value = "";
	document.frm_md1.txtEmail.value = "";
	document.frm_md1.txtWebsite.value = "";
	document.frm_md1.slcPanggilan.value = "";
	document.frm_md1.txtNamaKontak.value = "";
	document.frm_md1.txtidperkiraan.value = "";
	document.frm_md1.txtCatatan.value = "";
	document.frm_md1.txtidPramuniaga.value = "";
	document.frm_md1.slcTermin.value = "";
	document.frm_md1.txtDiscSampai.value = "";
	document.frm_md1.txtJatuhTempo.value = "";
	document.frm_md1.txtBatasPiutang.value = "";
	document.frm_md1.txtSiup.value = "";
	document.frm_md1.txtNpwp.value = "";
	document.frm_md1.txtDiscByrLbhAwal.value = "";
	document.frm_md1.txtDendaKeterlambatan.value = "";
	document.frm_md1.txtDiscVol.value = "";
	document.frm_md1.txtVol.value = "";
	document.frm_md1.slcGrupPelanggan.value = "";
	document.frm_md1.slcTipePotongan.value = "";
	document.frm_md1.slcMetodePembayaran.value = "";
	document.frm_md1.txtNoKartu.value = "";
	document.frm_md1.txtKadaluarsa.value = "";
	document.frm_md1.txtNmKartu.value = "";
	document.frm_md1.txtCatPembayaran.value = "";
	document.frm_md1.txtGajiKry.value = "";
	document.frm_md1.txtOngkosJam.value = "";
	document.frm_md1.slcUpline.value = ""; 
	document.frm_md1.tglMasuk.value = "";
	document.getElementById("tmpNmPerkiraan_md1").innerHTML = "";
	document.getElementById("tmpNmRekan_md1").innerHTML = "";
	document.frm_md1.cabang.value = "";
	
	gdAlamat_md1.clearAll();
	
	var poststr = "";
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/rekan_bisnis/reloadDataKry", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			document.getElementById('slcUpline').innerHTML = result;
	});
}

function enabledFrm_md1() {
	document.frm_md1.idrec.disabled = false;
	document.frm_md1.txtIdRekan.disabled = false;
	document.frm_md1.txtTypeRekan.disabled = false;
	document.frm_md1.txtNmRekan.disabled = false;
	document.frm_md1.slcMewakili.disabled = false;
	document.frm_md1.txtTlp_1.disabled = false;
	document.frm_md1.txtTlp_2.disabled = false;
	document.frm_md1.txtTlp_3.disabled = false;
	document.frm_md1.txtFax.disabled = false;
	document.frm_md1.txtEmail.disabled = false;
	document.frm_md1.txtWebsite.disabled = false;
	document.frm_md1.slcPanggilan.disabled = false;
	document.frm_md1.txtNamaKontak.disabled = false;
	document.frm_md1.txtidperkiraan.disabled = false;
	document.frm_md1.txtCatatan.disabled = false;
	document.frm_md1.txtidPramuniaga.disabled = false;
	document.frm_md1.slcTermin.disabled = false;
	document.frm_md1.txtDiscSampai.disabled = false;
	document.frm_md1.txtJatuhTempo.disabled = false;
	document.frm_md1.txtBatasPiutang.disabled = false;
	document.frm_md1.txtSiup.disabled = false;
	document.frm_md1.txtNpwp.disabled = false;
	document.frm_md1.txtDiscByrLbhAwal.disabled = false;
	document.frm_md1.txtDendaKeterlambatan.disabled = false;
	document.frm_md1.txtDiscVol.disabled = false;
	document.frm_md1.txtVol.disabled = false;
	document.frm_md1.slcGrupPelanggan.disabled = false;
	document.frm_md1.slcTipePotongan.disabled = false;
	document.frm_md1.slcMetodePembayaran.disabled = false;
	document.frm_md1.txtNoKartu.disabled = false;
	document.frm_md1.txtKadaluarsa.disabled = false;
	document.frm_md1.txtNmKartu.disabled = false;
	document.frm_md1.txtCatPembayaran.disabled = false;
	document.frm_md1.txtGajiKry.disabled = false;
	document.frm_md1.txtOngkosJam.disabled = false;
	document.frm_md1.slcUpline.disabled = false;
	document.frm_md1.tglMasuk.disabled = false;
	document.frm_md1.cabang.disabled = false;
	
	document.getElementById('tmpTblPerkiraan').innerHTML = '<img name="btnakun_md1" id="btnakun_md1" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_md1();" />';
	document.getElementById('tmpPramuniaga').innerHTML = '<img name="btnakun_md1" id="btnakun_md2" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winSales_md1();" />'; 
	document.getElementById('tmpTglKadaluarsa').innerHTML = '<img id="txttgl_exp_md1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" />';
}

function blokTypeRekan(type) {
	enabledFrm_md1();
	if(type=='3') {
		document.frm_md1.slcMewakili.disabled = true;
		document.frm_md1.slcPanggilan.disabled = true;
		document.frm_md1.txtNamaKontak.disabled = true;
		
		document.frm_md1.txtidperkiraan.disabled = true;
		document.frm_md1.txtidPramuniaga.disabled = true;
		document.frm_md1.slcTermin.disabled = true;
		document.frm_md1.txtDiscSampai.disabled = true;
		document.frm_md1.txtJatuhTempo.disabled = true;
		document.frm_md1.txtDiscByrLbhAwal.disabled = true;
		document.frm_md1.txtDiscVol.disabled = true;
		document.frm_md1.txtVol.disabled = true;
		document.frm_md1.slcGrupPelanggan.disabled = true;
		document.frm_md1.slcTipePotongan.disabled = true;
		
		document.frm_md1.slcMetodePembayaran.disabled = true;
		document.frm_md1.txtNoKartu.disabled = true;
		document.frm_md1.txtKadaluarsa.disabled = true;
		document.frm_md1.txtNmKartu.disabled = true;
		document.frm_md1.txtCatPembayaran.disabled = true;
		
		document.frm_md1.txtCatatan.disabled = true;
		document.frm_md1.txtBatasPiutang.disabled = true;
		document.frm_md1.txtSiup.disabled = true;
		document.frm_md1.txtNpwp.disabled = true;
		document.frm_md1.txtDendaKeterlambatan.disabled = true;
		
		document.getElementById('tmpTblPerkiraan').innerHTML = "";
		document.getElementById('tmpPramuniaga').innerHTML = ""; 
		document.getElementById('tmpTglKadaluarsa').innerHTML = "";
	} else if(type=='2') {
		document.frm_md1.txtidperkiraan.disabled = true;
		document.frm_md1.txtCatatan.disabled = true;
		document.frm_md1.txtidPramuniaga.disabled = true;
		document.frm_md1.txtDendaKeterlambatan.disabled = true;
		document.frm_md1.slcGrupPelanggan.disabled = true;
		document.frm_md1.slcTipePotongan.disabled = true;
		document.frm_md1.txtGajiKry.disabled = true;
		document.frm_md1.txtOngkosJam.disabled = true;
		document.frm_md1.slcUpline.disabled = true;
		document.frm_md1.slcMetodePembayaran.disabled = true;
		document.frm_md1.txtKadaluarsa.disabled = true;
		document.frm_md1.txtNmKartu.disabled = true;
		document.frm_md1.txtCatPembayaran.disabled = true;
		document.frm_md1.txtBatasPiutang.disabled = true;	
		document.frm_md1.txtSiup.disabled = true;
		document.frm_md1.txtNpwp.disabled = true;
		document.getElementById('tmpTblPerkiraan').innerHTML = "";
		document.getElementById('tmpPramuniaga').innerHTML = ""; 
		document.getElementById('tmpTglKadaluarsa').innerHTML = "";
	} else if(type=='1' || type=='4') {
		document.frm_md1.txtGajiKry.disabled = true;
		document.frm_md1.txtOngkosJam.disabled = true;
		document.frm_md1.slcUpline.disabled = true;
		document.frm_md1.tglMasuk.disabled = true;
	}
}

blokTypeRekan(document.frm_md1.txtTypeRekan.value);
</script>

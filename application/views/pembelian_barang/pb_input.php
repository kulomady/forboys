<div class="frmContainer">
<form action="javascript:void(0);" method="post" enctype="multipart/form-data" name="frm_pb1" id="frm_pb1">
  <table border="0" align="center">
    
    <tr>
      <td width="95">No. Transaksi</td>
      <td width="213"><input type="text" name="kdtrans" id="kdtrans" value="<?php if(isset($kdtrans)): echo $kdtrans; endif; ?>" placeHolder = "[AUTO]" disabled="disabled" />
      <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif;?>" /></td>
      <td width="127">No. PO</td>
      <td colspan="2"><input type="text" name="no_po" id="no_po" value="<?php if(isset($no_po)): echo $no_po; endif;?>" disabled="disabled" />
        <img id="btnPsn" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/blue_view.png" border="0" style="cursor:pointer;" onclick="showWinPesanan_pb1();" /></td>
      <td width="76">Keterangan</td>
      <td width="245" colspan="2" rowspan="3" valign="top"><textarea name="ket" id="ket" cols="20" rows="3"><?php if(isset($ket)): echo $ket; endif;?></textarea></td>
      </tr>
    <tr>
      <td>Tanggal</td>
      <td><input type="text" name="tglBeli" id="tglBeli" readonly size="10" value="<?php if(isset($tglBeli)): echo $tglBeli; endif;?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="txttgl_beli_pb1" style="cursor:pointer;" border="0" /></td>
      <td>Supplier</td>
      <td width="97"><input name="txtidSupplier" type="text" id="txtidSupplier" size="5" value="<?php if(isset($txtidSupplier)): echo $txtidSupplier; endif;?>" />
&nbsp;<img name="btnakun_pb1" id="btnakun_pb1" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winSpl_pb1();" /></td>
      <td width="103" id="tmpNmSupplier_pb1"><span style="color:#0000FF;">
        <?php if(isset($nmSupplier)): echo $nmSupplier; endif;?>
      </span></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>Lokasi</td>
      <td><select name="gudang" id="gudang" style="width:150px;" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
        <?php echo $gudang; ?>
      </select></td>
      <td>Termin Pembayaran</td>
      <td colspan="2"><select name="termin" id="termin">
        <?php echo $top; ?>
      </select></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="8"><div id="tmpGridBrg_pb1" style="height:300px; width:100%;"></div></td>
      </tr>
    <tr>
      <td colspan="2" style="color:#00F"><span id="tmpSB_pb1"><strong>Scan Barcode</strong></span></td>
      <td colspan="6" rowspan="5" align="right" valign="top"><table width="529" border="0">
            <tr>
              <td width="93">Total Item</td>
              <td width="70">: <input style="text-align:right;" name="sub_total_item" type="text" id="sub_total_item" size="5" value="<?php if(isset($sub_total_item)){ echo $sub_total_item; } else { echo 0; }?>" disabled="disabled" /></td>
              <td width="37"><span id="tmpTxtPcs_pb1">#PCS</span></td>
              <td width="74"><span id="tmpInpPcs_pb1">:
              <input style="text-align:right;" name="sub_total_terima" type="text" id="sub_total_terima" size="3" value="<?php if(isset($sub_total_terima)){ echo $sub_total_terima; } else { echo 0; }?>" disabled="disabled" /></span></td>
              <td width="91">Total Akhir</td>
              <td width="138">:
              <input style="text-align:right;" name="total_akhir" type="text" id="total_akhir" size="14" value="<?php if(isset($total_akhir)){ echo $total_akhir; } else { echo 0; }?>" disabled="disabled" /></td>
            </tr>
            <tr>
              <td>Sub Total</td>
              <td colspan="3">:
              <input style="text-align:right;" name="sub_total" type="text" id="sub_total" size="22" value="<?php if(isset($sub_total)){ echo $sub_total; } else { echo 0; }?>" disabled="disabled" /></td>
              <td>DP SO</td>
              <td>:
                <input style="text-align:right;" name="tunai" type="text" id="tunai" size="14" value="<?php if(isset($tunai)){ echo $tunai; } else { echo 0; }?>" disabled="disabled" />
              <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb5" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunDpSo');" /></td>
            </tr>
            <tr>
              <td>Potongan</td>
              <td colspan="3">:
                <input style="text-align:right;" name="potongan" type="text" id="potongan" onkeyup="persenPot_pb1();" size="6" value="<?php if(isset($potongan)){ echo $potongan; } else { echo 0; }?>" />
                <input style="text-align:right;" name="potongan2" type="text" id="potongan2" size="11" value="<?php if(isset($potongan2)){ echo $potongan2; } else { echo 0; }?>" onkeyup="rupiahPot_pb1();" onblur="if(this.value=='') { this.value='0'; }" />
              <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb1" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunPotBeli');" /></td>
              <td>Tunai / DP</td>
              <td>:
                <input style="text-align:right;" name="tunai2" type="text" id="tunai2" size="14" value="<?php if(isset($tunai2)){ echo $tunai2; } else { echo 0; }?>" onkeyup="tunai_pb1();" onblur="if(this.value=='') { this.value='0'; }" />
              <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb7" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunDp');" /></td>
            </tr>
            <tr>
              <td>Pajak</td>
              <td colspan="3">:
                <select name="pajak" id="pajak" style="width:60px;" onchange="persenTax_pb1();">
                  <?php echo $pajak; ?>
                </select>
                <input style="text-align:right;" name="pajak2" type="text" id="pajak2" onkeyup="rupiahTax();" size="11" value="<?php if(isset($pajak2)){ echo $pajak2; } else { echo 0; }?>" disabled="disabled" />
              <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunPajak');" /></td>
              <td>Kredit</td>
              <td>:
                <input style="text-align:right;" name="kredit" type="text" id="kredit" size="14" value="<?php if(isset($kredit)){ echo $kredit; } else { echo 0; }?>" disabled="disabled" />
              <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb6" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunHd');" /></td>
            </tr>
            <tr>
              <td>Biaya Kirim</td>
              <td colspan="3">:
                <select name="slcPajak" id="slcPajak" style="width:60px;" onchange="hitungGrid_pb1();">
                  <?php echo $pilihPajakBarcode; ?>
                </select>
                <input style="text-align:right;" name="biaya_kirim" type="text" id="biaya_kirim" onkeyup="hitungGrid_pb1();" size="11" value="<?php if(isset($biaya_kirim)){ echo $biaya_kirim; } else { echo 0; }?>" onblur="if(this.value=='') { this.value = '0.00'; }" />
              <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb2" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunBiayaKirim');" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    <tr>
      <td valign="top" style="color:#00F"><span id="tmpPot_pb1"><strong>Potongan</strong></span></td>
      <td height="21" valign="top" style="color:#00F"><span style="color:#00F" id="tmpInpBarocde_pb1"><input name="discpBarcode" type="text" id="discpBarcode" size="2" onkeyup="hitungDiscpBarcode_pb1(this.value);" />
        %, Rp.
        <input name="discr_barcode" type="text" id="discr_barcode" size="8" onkeyup="hitungDiscrBarcode_pb1(this.value);" style="text-align:right" /></span></td>
      </tr>
    <tr>
      <td valign="top" style="color:#00F"><span id="tmpPjkBarcode_pb1"><strong>Pajak</strong></span></td>
      <td height="24" valign="top"><span id="tmpInpPjkBarcode_pb1"><strong>
        <select name="slcPajakBrg" id="slcPajakBrg" style="width:41px;">
          <?php echo $pilihPajak; ?>
        </select>
      </strong></span></td>
    </tr>
    <tr>
      <td valign="top" style="color:#00F"><span id="tmpTxtBarcode"><strong>Barcode</strong></span></td>
      <td valign="top" style="color:#00F"><span id="tmpInpBarcode">
<input type="text" name="txtBarcode" id="txtBarcode" size="15" onkeyup="if(event.keyCode==13) { scanner_pb1(this.value);  }" placeholder = "Scan Barcode" />
<input type="checkbox" id="cbShortment" name="cbShortment" />
&nbsp;Shortment</span></td>
    </tr>
    <tr>
      <td height="21" valign="top"></td>
      <td valign="top" id="tmpInfoBarcode_pb1" style="color:#F00;">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="akun_pot" id="akun_pot" value="<?php if(isset($la_disc_beli)): echo $la_disc_beli; endif;?>" />
  <input type="hidden" name="akun_pajak" id="akun_pajak" value="<?php if(isset($la_pajak_beli)): echo $la_pajak_beli; endif;?>" />
  <input type="hidden" name="akun_pajakBk" id="akun_pajakBk" value="<?php if(isset($la_pajak_bk)): echo $la_pajak_bk; endif;?>" />
  <input type="hidden" name="akun_biayakirim" id="akun_biayakirim" value="<?php if(isset($la_biaya_angkut_beli)): echo $la_biaya_angkut_beli; endif;?>" />
  <input type="hidden" name="akun_dp_so" id="akun_dp_so" value="<?php if(isset($la_dp_pesen_beli)): echo $la_dp_pesen_beli; endif;?>"  />
  <input type="hidden" name="akun_dp" id="akun_dp" value="<?php if(isset($la_uang_muka_beli)): echo $la_uang_muka_beli; endif;?>"  />
  <input type="hidden" name="akun_kredit" id="akun_kredit" value="<?php if(isset($la_akun_hd)): echo $la_akun_hd; endif;?>"  />
</form>
</div>
<div id="tmpWinPesanan_pb1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
<form name="frmPesan_pb1" id="frmPesan_pb1" method="post" action="javascript:void(0);">
  <table width="765" border="0" align="center">
    <tr>
      <td width="101">Periode</td>
      <td width="389"><input type="text" name="tglPesan1_pb1" id="tglPesan1_pb1" readonly size="10" value="<?php echo date("Y-m-d"); ?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="btnPesan1_pb1" style="cursor:pointer;" border="0" /> s.d 
        <input type="text" name="tglPesan2_pb1" id="tglPesan2_pb1" readonly="readonly" size="10" value="<?php echo date("Y-m-d"); ?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="btnPesan2_pb1" style="cursor:pointer;" border="0" /></td>
      <td width="261">&nbsp;</td>
    </tr>
    <tr>
      <td>Kata Kunci</td>
      <td><select name="slcField" id="slcField">
        <option value="c.nmrekan">Supplier</option>
        <option value="a.kdtrans">No.Transaksi</option>
        <option value="a.keterangan">Keterangan</option>
                  </select>
        <input name="txtKunci" type="text" id="txtKunci" size="35" placeholder = "Masukan Kata Kunci" /></td>
      <td><input type="button" name="button" id="button" value="Cari" style="width:100px;" onclick="cariDataPesanan_pb1();"/></td>
    </tr>
    
    <tr>
      <td colspan="3"><div id="tmpGrid_pesan_pb1" style="height:350px; width: 100%"></div></td>
      </tr>
  </table>
</form>
</div>
<div style="display:none;">
<iframe name="tmpUpload_pb1" id="tmpUpload_pb1" style="height:120px; width:150px;"></iframe>
</div>

<script language="javascript">

<?php if($setBarcode==0): ?>
document.getElementById("tmpSB_pb1").style.display = "none";
document.getElementById("tmpPot_pb1").style.display = "none";
document.getElementById("tmpInpBarocde_pb1").style.display = "none";
document.getElementById("tmpPjkBarcode_pb1").style.display = "none";
document.getElementById("tmpInpPjkBarcode_pb1").style.display = "none";
document.getElementById("tmpInpBarcode").style.display = "none";
document.getElementById("tmpTxtBarcode").style.display = "none"; 
<?php endif;?>

function upload_pb1() {
	document.frm_pb1.action = "<?php echo base_url(); ?>index.php/pembelian_barang/upload";
	document.frm_pb1.target = "tmpUpload_pb1";
	document.frm_pb1.submit();
}
	// tanggal expired card
calPesan1_pb1 = new dhtmlXCalendarObject({
			input: "tglPesan1_pb1",button: "btnPesan1_pb1"
	});
calPesan1_pb1.setDateFormat("%Y-%m-%d");

calPesan2_pb1 = new dhtmlXCalendarObject({
			input: "tglPesan2_pb1",button: "btnPesan2_pb1"
	});
calPesan2_pb1.setDateFormat("%Y-%m-%d");

	$(function() {
		$('#sub_total_item').number(true, 2);
		$('#sub_total_terima').number(true, 2);
		$('#sub_total').number(true, 2);
		$('#pajak2').number(true, 2);
		$('#potongan2').number(true, 2);
		$('#biaya_kirim').number(true, 2);
		$('#total_akhir').number(true, 2);
		$('#tunai').number(true, 2);
		$('#tunai2').number(true, 2);
		$('#kredit').number(true, 2);
		$('#discr_barcode').number(true, 2);
	});
	
	function baru_pb1(){
		document.frm_pb1.id.value = "";
		document.frm_pb1.kdtrans.value = "";
		document.frm_pb1.tglBeli.value = "<?php echo date("d/m/Y"); ?>";
		document.frm_pb1.no_po.value = "";
		document.frm_pb1.txtidSupplier.value = "";
		document.getElementById('tmpNmSupplier_pb1').innerHTML = "";
		document.getElementById('tmpInfoBarcode_pb1').innerHTML = "";
		document.frm_pb1.txtBarcode.value = "";
		document.frm_pb1.ket.value = "";
		document.frm_pb1.termin.value = "";
		document.frm_pb1.sub_total_item.value = "0";
		document.frm_pb1.sub_total_terima.value = "0";
		document.frm_pb1.sub_total.value = "0";
		document.frm_pb1.total_akhir.value = "0";
		document.frm_pb1.potongan.value = "0";
		document.frm_pb1.potongan2.value = "0";
		document.frm_pb1.biaya_kirim.value = "0.00";
		document.frm_pb1.slcPajak.value = "0";
		document.frm_pb1.tunai.value = "0";
		document.frm_pb1.pajak.value = "0";
		document.frm_pb1.pajak2.value = "0";
		document.frm_pb1.kredit.value = "0";
		document.frm_pb1.gudang.disabled = false;
		document.frm_pb1.gudang.value = "";
		outlet_id = "";
		
		gdInp.clearAll();
		gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','0','',img_del,''],0);
		gdInp.selectRow(0);
		
		// scan barcode
		document.frm_pb1.discpBarcode.value = "";
		document.frm_pb1.discr_barcode.value = "";
		document.frm_pb1.slcPajakBrg.value = "0";
		document.frm_pb1.txtBarcode.value = "";
		document.frm_pb1.cbShortment.checked = false;
	}
	
	var outlet_id = document.frm_pb1.gudang.value;
	gd_win_brg.clearAll();
	
	// tanggal pesen
	cal1_pb1 = new dhtmlXCalendarObject({
			input: "tglBeli",button: "txttgl_beli_pb1"
	});
	cal1_pb1.setDateFormat("%d/%m/%Y");
	cal1_pb1.setSensitiveRange("<?php echo $periodeAwal; ?>", "<?php echo date("d/m/Y"); ?>");
	
	
	function winSpl_pb1() {
		try {
			if(w2_pb1.isHidden()==true) {
				w2_pb1.show();
				document.getElementById('frmSearchAkun').focus();
			}
			w2_pb1.bringToTop();
			return;
		} catch(e) {}
		w2_pb1 = dhxWins.createWindow("w2_pb1",0,0,430,450);
		w2_pb1.setText("Daftar Supplier");
		w2_pb1.button("park").hide();
		w2_pb1.button("minmax1").hide();
		w2_pb1.center();
		
		tb_w2_pb1 = w2_pb1.attachToolbar();
		tb_w2_pb1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pb1.setSkin("dhx_terrace");
		tb_w2_pb1.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pb1.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahSupplier(13);
			}
		});
		
		w2_pb1.attachURL(base_url+"index.php/pembelian_barang/frm_search_supplier", true);
	}
	
	gdInp = new dhtmlXGridObject('tmpGridBrg_pb1');
	gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gdInp.setHeader("Kode Item,#cspan,Nama Barang,Satuan,Jml Beli,#PCS,Harga,Pot (%),Pot Rp,Pajak,Total,&nbsp;,hrgjual",null,
	["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gdInp.setInitWidths("80,30,200,70,65,50,80,60,65,60,100,30,0");
	gdInp.setColAlign("left,right,left,left,right,right,right,right,right,left,right,center,right");
	gdInp.setColTypes("ed,ro,ro,ro,edn,edn,edn,edn,edn,coro,ron,ro,ro");
	gdInp.attachEvent("onEnter", doOnEnterInp_pb1);
	gdInp.attachEvent("onEditCell", doOnCellEdit_pb1);
	gdInp.setNumberFormat("0,000",4,",",".");
	gdInp.setNumberFormat("0,000",5,",",".");
	gdInp.setNumberFormat("0,000.00",6,",",".");
	gdInp.setNumberFormat("0,000.00",7,",",".");
	gdInp.setNumberFormat("0,000.00",8,",",".");
	gdInp.setNumberFormat("0,000",9,",",".");
	gdInp.setNumberFormat("0,000.00",10,",",".");
	<?php foreach($qPajak->result() as $rP) { ?>
	gdInp.getCombo(9).put(<?php echo $rP->nilai; ?>, '<?php echo $rP->kode_pajak; ?>');
	<?php } ?>
	gdInp.setSkin("dhx_skyblue");
	gdInp.init();
	
	<?php if($kolomPcs==0): ?>
	gdInp.setColumnHidden(5,true);
	document.getElementById("tmpTxtPcs_pb1").style.display = "none";
	document.getElementById("tmpInpPcs_pb1").style.display = "none";
	<?php endif; ?>
	
	<?php if(isset($kdtrans)){ ?> 
		tb_w1_pb1.enableItem("cetak");
		loadChild();
	<?php } else { ?>
		baru_pb1();
	<?php }?>
	
	function loadChild(){
		gdInp.clearAll();
		gdInp.loadXML(base_url+"index.php/pembelian_barang/loadChild/"+document.frm_pb1.kdtrans.value,function(){
			addRowInp_pb1();
			//gdInp.selectRow(gdInp.getRowsNum() - 1);
		});
	}

	
	function addRowInp_pb1() {
		arrId = gdInp.getAllItemIds().split(",");
		idcell = arrId[arrId.length - 1];
		celIdbarang = gdInp.cells(idcell,0).getValue();
		if(celIdbarang != "") {
				posisi = gdInp.getRowsNum();
				gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','0','',img_del,''],posisi);
				//gdInp.selectRow(posisi);
				try { gdInp.showRow(gdInp.uid()); } catch(e) {}
		}
	}
	
	function doOnEnterInp_pb1(rowId, cellInd) {
		if(cellInd==0) {
			cariBarang();
		}
		addRowInp_pb1();
		return true;
	}
	
	function scanner_pb1(barcode){
		if(outlet_id==""){
			alert("Pilih Dahulu Gudang / Lokasi Barang");
			return;
		}
		if(barcode==""){
			alert("Barcode Tidak Boleh Kosong");
			return;
		}
		if(document.frm_pb1.cbShortment.checked==true){
			scanSizeRun_pb1(barcode);
		} else {
			scanBarcode_pb1(barcode);
		}
	}
	
	function scanBarcode_pb1(barcode){
		var poststr = 
			'barcode=' + barcode +
			'&outlet_id=' + outlet_id;
		document.getElementById('tmpInfoBarcode_pb1').innerHTML = "";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcode", encodeURI(poststr), function(loader){
			result = loader.xmlDoc.responseText;
			if(result == '0'){
				document.getElementById('tmpInfoBarcode_pb1').innerHTML = "Barcode Tidak Ditemukan";
			} else {
				arrBrg = result.split('|');
				if(adaBarang(arrBrg[0]) == 0){
					// disc
					discBarcodeP = "";
					discBarcodeR = "";
					pajakBarcode = document.frm_pb1.slcPajakBrg.value;
					if(document.frm_pb1.discpBarcode.value != "") {
						discBarcodeP = 	document.frm_pb1.discpBarcode.value;
						discBarcodeR = arrBrg[6] * discBarcodeP/100;
					}
					if(document.frm_pb1.discr_barcode.value != "") {
						discBarcodeR = 	$('#discr_barcode').val();
						discBarcodeP = discBarcodeR / arrBrg[6] * 100;
						discBarcodeP = precise_round(discBarcodeP,2);
					}
					//
					
					posisi = gdInp.getRowsNum() - 1;
					total = (arrBrg[6] - discBarcodeR) * 1;
					if(pajakBarcode != "0") {
						nilaiPajak = total * (pajakBarcode/100);
						total = parseInt(total) + parseFloat(nilaiPajak);	
					}
					nmbarang = arrBrg[1]+" "+arrBrg[2]+" "+arrBrg[3];
					
					gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,nmbarang,arrBrg[4],'1','',arrBrg[6],discBarcodeP,discBarcodeR,pajakBarcode,total,img_del,arrBrg[5]],posisi);
					gdInp.selectRow(posisi);
					gdInp.showRow(arrBrg[0]);
				} else {
					if(gdInp.cells(arrBrg[0],4).getValue()=="") {
						qtyInp = 0;
					} else {
						qtyInp = gdInp.cells(arrBrg[0],4).getValue();
					}
					jmlSkrg = parseInt(qtyInp) + 1;
					harga = arrBrg[6];
					totalSkrg = jmlSkrg * (harga - gdInp.cells(arrBrg[0],8).getValue());
					if(gdInp.cells(arrBrg[0],9).getValue() != "") {
						tax = totalSkrg * (gdInp.cells(arrBrg[0],9).getValue() / 100);
						totalSkrg = totalSkrg + tax;
					}
					gdInp.cells(arrBrg[0],4).setValue(jmlSkrg);
					gdInp.cells(arrBrg[0],10).setValue(totalSkrg);
				}
			}
			
			//hitungTotal_pb1();
			hitungGrid_pb1();
			persenPot_pb1();
			persenTax_pb1();
			document.frm_pb1.txtBarcode.value = "";
			document.frm_pb1.txtBarcode.focus();
		});
	}
	
	function scanSizeRun_pb1(barcode){
		var poststr = 
			'sizeRun=' + barcode +
			'&outlet_id=' + outlet_id;
		document.getElementById('tmpInfoBarcode_pb1').innerHTML = "";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRun", encodeURI(poststr), function(loader){
			result = loader.xmlDoc.responseText;
			if(result == ''){
				document.getElementById('tmpInfoBarcode_pb1').innerHTML = "Size Run Tidak Ditemukan";
				return;
			} else {
				arrSizeRun = result.split('~');
				for(i=0; i<arrSizeRun.length;i++){
					if(arrSizeRun[i] != "0" && arrSizeRun[i] != ""){
						arrBrg = arrSizeRun[i].split('|');
						if(adaBarang(arrBrg[0]) == 0) {
							// disc
							discBarcodeP = "";
							discBarcodeR = "";
							pajakBarcode = document.frm_pb1.slcPajakBrg.value;
							if(document.frm_pb1.discpBarcode.value != "") {
								discBarcodeP = 	document.frm_pb1.discpBarcode.value;
								discBarcodeR = arrBrg[7] * discBarcodeP/100;
							}
							if(document.frm_pb1.discr_barcode.value != "") {
								discBarcodeR = 	$('#discr_barcode').val();
								discBarcodeP = discBarcodeR / arrBrg[7] * 100;
								discBarcodeP = precise_round(discBarcodeP,2);
							}
							//
							posisi = gdInp.getRowsNum() - 1;
							total = (arrBrg[7] - discBarcodeR) * arrBrg[5];
							if(pajakBarcode != "0") {
								nilaiPajak = total * (pajakBarcode/100);
								total = parseInt(total) + parseFloat(nilaiPajak);	
							}
							
							nmbarang = arrBrg[1]+" "+arrBrg[2]+" "+arrBrg[3];
							gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,nmbarang,arrBrg[4],arrBrg[5],'',arrBrg[7],discBarcodeP,discBarcodeR,pajakBarcode,total,img_del,arrBrg[6]],posisi);
							gdInp.selectRow(posisi);
							gdInp.showRow(arrBrg[0]);
						} else {
							if(gdInp.cells(arrBrg[0],4).getValue()=="") {
								qtyInp = 0;
							} else {
								qtyInp = gdInp.cells(arrBrg[0],4).getValue();
							}
							jmlSkrg = parseInt(qtyInp) + parseInt(arrBrg[5]);
							harga = arrBrg[7];
							totalSkrg = jmlSkrg * (harga - gdInp.cells(arrBrg[0],8).getValue());
							if(gdInp.cells(arrBrg[0],9).getValue() != "") {
								tax = totalSkrg * (gdInp.cells(arrBrg[0],9).getValue() / 100);
								totalSkrg = totalSkrg + tax;
							}
							gdInp.cells(arrBrg[0],4).setValue(jmlSkrg);
							gdInp.cells(arrBrg[0],10).setValue(totalSkrg);
						}
					}
				}
			}
			hitungGrid_pb1();
			persenPot_pb1();
			persenTax_pb1();
			document.frm_pb1.txtBarcode.value = "";
			document.frm_pb1.txtBarcode.focus();
		});
	}
	
	function doOnCellEdit_pb1(stage, rowId, cellInd){
		if(stage == 2){
			var pcs = gdInp.cells(gdInp.getSelectedId(), 5).getValue();
			if(pcs == "") {
				var qtyItem = gdInp.cells(gdInp.getSelectedId(),4).getValue();
			} else {
				var qtyItem = gdInp.cells(gdInp.getSelectedId(),4).getValue() * pcs;
			}
			var harga = gdInp.cells(gdInp.getSelectedId(),6).getValue();
			
			// Hitung Disc Rupiah
			var harga = gdInp.cells(gdInp.getSelectedId(), 6).getValue();
			if(cellInd==7) {
				if(gdInp.cells(gdInp.getSelectedId(),7).getValue() != "") {
					discRp = harga * (gdInp.cells(gdInp.getSelectedId(),7).getValue() / 100);
					gdInp.cells(gdInp.getSelectedId(), 8).setValue(discRp);
				} else {
					gdInp.cells(gdInp.getSelectedId(), 8).setValue("");	
				}
			}
			// Hitung Disc Persen
			if(cellInd==8) {
				if(gdInp.cells(gdInp.getSelectedId(),8).getValue() != "") {
					discP = (gdInp.cells(gdInp.getSelectedId(),8).getValue() / harga) *  100;
					discP = precise_round(discP,2);
					gdInp.cells(gdInp.getSelectedId(),7).setValue(discP);
				} else {
					gdInp.cells(gdInp.getSelectedId(),7).setValue("");
				}
			}
			
			var disc = gdInp.cells(gdInp.getSelectedId(), 8).getValue();
			var pajak = gdInp.cells(gdInp.getSelectedId(), 9).getValue();
			
			
			var jumlah = qtyItem * harga;
			if(disc!="" || disc!=0){
				var hitung = qtyItem * disc;
				jumlah = parseInt(jumlah)-parseInt(hitung);
			}
			if(pajak!="" || pajak!=0){
				var hitung = ((parseInt(jumlah)*parseInt(pajak))/100)
			} else {
				var hitung = 0;
			}
			var total = parseInt(jumlah) + parseInt(hitung);
			
			if(total!='NaN' || total!=0){
				gdInp.cells(gdInp.getSelectedId(),10).setValue(total);
			} else {
				gdInp.cells(gdInp.getSelectedId(),10).setValue(0);
			}
			hitungGrid_pb1();
			persenPot_pb1();
			persenTax_pb1();
			addRowInp_pb1();
		}
		return true;
	}
	
	function subtotal_pj1(){
		hitungGrid_pb1();
		persenPot_pb1();
		persenTax_pb1();
	}
	
	function persenPot_pb1(){
		var subtotal2 = $('#sub_total').val();
		var pot = $('#potongan').val();
		var pot2 = (parseInt(pot)*parseInt(subtotal2))/100;
		$('#potongan2').val(pot2);
		//hitungGrid_pb1();
		persenTax_pb1();
	}
	
	function rupiahPot_pb1() {
		subtotal = $('#sub_total').val();
		if(subtotal == 0) {
			$('#potongan2').val(0);
			return;
		}
		disc = $('#potongan2').val();
		if(disc != "" || disc != "0") {
			discPersen = (disc / subtotal) * 100;
			//$('#txtDiscRupiah').val(discRp);
			document.frm_pb1.potongan.value = precise_round(discPersen,2);
		}
		persenTax_pb1();
	}
	
	function persenTax_pb1(){
		var subtotal2 = $('#sub_total').val();
		var pot2 = $('#potongan2').val();
		var tax = $('#pajak').val();
		var tax2 = ((parseInt(subtotal2)-parseInt(pot2))*tax)/100;
		$('#pajak2').val(tax2);
		hitungGrid_pb1();
	}
	
	function hitungPajakKirim(pjk) {
		if(pjk == '0') {
				
		}
	}
	
	function hitungGrid_pb1(){
		SubTotalItem = 0;
		SubTotalTerima = 0;
		totalPriceItem = 0;
		totalPriceTerima = 0
		subTotal = 0;
		var arr = gdInp.getAllItemIds().split(',');
		for (var i = 0; i < arr.length; i++) {
			id = arr[i];
			var qtyItem = gdInp.cells(id, 4).getValue();
			if(qtyItem==""){
				qtyItem = 0;
			}
			SubTotalItem = parseInt(SubTotalItem) + parseInt(qtyItem);
			
			var qtyTerima = gdInp.cells(id, 5).getValue();
			if(qtyTerima==""){
				qtyTerima = 0;
			}
			SubTotalTerima = parseInt(SubTotalTerima) + parseInt(qtyTerima);
			//priceItem = parseFloat(gdInp.cells(id, 4).getValue()) * parseFloat(gdInp.cells(id, 6).getValue());
			//totalPriceItem = parseInt(totalPriceItem) + parseInt(priceItem);
			//priceTerima = parseFloat(gdInp.cells(id, 5).getValue()) * parseFloat(gdInp.cells(id, 6).getValue());
			//totalPriceTerima = parseInt(totalPriceTerima) + parseInt(priceTerima);
			
			var qtyTotal = gdInp.cells(id, 10).getValue();
			if(qtyTotal==""){
				qtyTotal = 0;
			}
			subTotal = parseInt(subTotal) + parseInt(qtyTotal);
		}
		//subTotal = parseInt(totalPriceItem) - parseInt(totalPriceTerima);
		$('#sub_total_item').val(SubTotalItem);
		$('#sub_total_terima').val(SubTotalTerima);
		$('#sub_total').val(subTotal);
		
		if($('#potongan2').val() != "") {
			var potRupiah = $('#potongan2').val();
		} else {
			var potRupiah = 0;
		}
		if($('#pajak2').val() != "") {
			var pajakRupiah = $('#pajak2').val();
		} else {
			var pajakRupiah = 0;
		}
		var total = parseInt(subTotal)-parseInt(potRupiah)+parseInt(pajakRupiah);
			
		if($('#tunai').val() != "") {
			tunai = $('#tunai').val();
		} else {
			tunai = 0;
		}
		
		if($('#tunai2').val() != "") {
			tunai2 = $('#tunai2').val();
		} else {
			tunai2 = 0;
		}
		
		if($('#biaya_kirim').val() != "") {
			biaya_kirim = $('#biaya_kirim').val();
			pajakKirim = document.frm_pb1.slcPajak.value;
			if(pajakKirim != '0') {
				nilaiPajakKirim = biaya_kirim * (pajakKirim / 100);
				biaya_kirim = parseInt(biaya_kirim) + parseFloat(nilaiPajakKirim);
				biaya_kirim = precise_round(biaya_kirim,2);
			}
		} else {
			biaya_kirim = 0;
		}
		
		total = parseInt(total) + parseInt(biaya_kirim);
		var kredit = parseInt(total)-parseInt(tunai)-parseInt(tunai2);
		$('#total_akhir').val(total);
		$('#kredit').val(kredit);
	}
	
	function tunai_pb1(){
		var total = $('#total_akhir').val();
		var tunai = $('#tunai').val();
		var tunai2 = $('#tunai2').val();
		var total = parseInt(total);
		var tunai = parseInt(tunai) + parseInt(tunai2);
		if(tunai>total){
			alert("Maaf Nilai Tunai / DP Melebihi Total Akhir !");
			return;
		} else {
			var kredit = parseInt(total)-parseInt(tunai);
			$('#kredit').val(kredit);
		}
	}
	
	function simpan_pb1(){
		if(document.frm_pb1.tglBeli.value == ""){
			alert("Tanggal Pesanan Tidak Boleh Kosong!");
			document.frm_pb1.tglBeli.focus();
			return;
		}
		
		if(document.frm_pb1.txtidSupplier.value == ""){
			alert("Supplier Tidak Boleh Kosong!");
			document.frm_pb1.txtidSupplier.focus();
			return;
		}
		
		if(document.frm_pb1.gudang.value == ""){
			alert("Gudang Tidak Boleh Kosong!");
			document.frm_pb1.gudang.focus();
			return;
		}
		
		if(document.frm_pb1.sub_total.value == ""){
			alert("Sub total Tidak Boleh Kosong!");
			document.frm_pb1.sub_total.focus();
			return;
		}
		
		if(gdInp.getRowsNum()==1){
			alert("Isi Data Pembelian Tidak Boleh Kosong !");
			return;
		}
		
		if(document.frm_pb1.tunai.value == ""){
			alert("Tunai Tidak Boleh Kosong!");
			document.frm_pb1.tunai.focus();
			return;
		}
		
		//delete 1 baris paling bawah :)
		delgridChild();
		
		if(cekKosong(10)==1) {
			alert("Total salah satu barang tidak boleh kosong");
			return;
		}
		
		var subTotalItem = $('#sub_total_item').val();
		var subTotalTerima = $('#sub_total_terima').val();
		var subtotal = $('#sub_total').val();
		var potongan = $('#potongan2').val();
		var pajak2 = $('#pajak2').val();
		var total_akhir = $('#total_akhir').val();
		var tunai = $('#tunai').val();
		var tunai2 = $('#tunai2').val();
		var kredit = $('#kredit').val();
		var biaya_kirim = $('#biaya_kirim').val();
		
		var postPb1 = 
			'id=' + document.frm_pb1.id.value +
			'&no_lpb=' + document.frm_pb1.kdtrans.value +
			'&tglBeli=' + document.frm_pb1.tglBeli.value +
			'&no_po=' + document.frm_pb1.no_po.value +
			'&supplier=' + document.frm_pb1.txtidSupplier.value +
			'&gudang=' + document.frm_pb1.gudang.value +
			'&ket=' + document.frm_pb1.ket.value +
			'&termin=' + document.frm_pb1.termin.value +
			'&sub_total_item=' + subTotalItem +
			'&sub_total_terima=' + subTotalTerima +
			'&sub_total=' + subtotal +
			'&total_akhir=' + total_akhir +
			'&potongan=' + document.frm_pb1.potongan.value +
			'&potongan2=' + potongan +
			'&tunai=' + tunai +
			'&tunai2=' + tunai2 +
			'&pajak=' + document.frm_pb1.pajak.value +
			'&pajak2=' + pajak2 +
			'&slcPajak=' + document.frm_pb1.slcPajak.value +
			'&biaya_kirim=' + biaya_kirim +
			'&kredit=' + kredit +
			'&dataBeli=' + getData(gdInp,[1,2,3,11]) +
			'&akun_pot=' + document.frm_pb1.akun_pot.value +
			'&akun_pajak=' + document.frm_pb1.akun_pajak.value +
			'&akun_pajakBk=' + document.frm_pb1.akun_pajakBk.value + 
			'&akun_biayakirim=' + document.frm_pb1.akun_biayakirim.value +
			'&akun_dp_so=' + document.frm_pb1.akun_dp_so.value +
			'&akun_dp=' + document.frm_pb1.akun_dp.value +
			'&akun_kredit=' + document.frm_pb1.akun_kredit.value;
			
		statusLoading();   
		tb_w1_pb1.disableItem("save");
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pembelian_barang/simpan", encodeURI(postPb1), function(loader) {
			result = loader.xmlDoc.responseText;
			alert(result);
			statusEnding();
			if(result=='ERR') { alert("Tgl Pesanan Diluar Dari Periode Akuntansi \n Tidak Diizinkan"); return; }
			
			document.frm_pb1.kdtrans.value = result;
			document.frmCetak_pb1.kdtrans.value = result;
			tb_w1_pb1.enableItem("cetak");
			refreshGd_pb1();
			addRowInp_pb1();
			tb_w1_pb1.enableItem("save");
			tb_w1_pb1.enableItem("baru");
			
		});
	}
	
	function delgridChild(){
		if(gdInp.getRowsNum() != '0') {
			var arr = gdInp.getAllItemIds().split(',');
			for(i=0;i < arr.length;i++) {
				id = arr[i];
				var gdBrg = gdInp.cells(id,0).getValue();
				if(gdBrg==""){
					gdInp.deleteRow(id);
				}
			}             
		}
	}
	
	function gridrpt(){
		var rpt = getData(gdInp,[1,2,3,5,7,8,9,10]);
		return rpt;
	}
	
	function setDataBrgPb1(kode,nmbarang,warna,ukuran,satuan,hrgBeli,hrgJual) {
		if(adaBarang(kode) != 0) {
			alert("Barang Yang Anda Input Sudah Ada");
			gdInp.cells(gdInp.getSelectedId(),0).setValue('');
			document.getElementById("pilihCell0").click();
			return;
		}
		nmbarang = nmbarang+" "+warna+" "+ukuran;
		gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
		gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
		gdInp.cells(gdInp.getSelectedId(),3).setValue(satuan);
		gdInp.cells(gdInp.getSelectedId(),6).setValue(hrgBeli);
		gdInp.cells(gdInp.getSelectedId(),12).setValue(hrgJual);
		index = gdInp.getRowIndex(gdInp.getSelectedId());
		gdInp.setRowId(index,kode.toUpperCase());
		document.getElementById("pilihCell5").click();
	}
	
	function setDataBrgImportPb1(kode,nmbarang,warna,ukuran,satuan,jml,hrgBeli,disc_1,disc_2,total,discrp,tax,hrgJual) {
		if(adaBarang(kode) != '0') {
			alert("Barang Yang Anda Input Sudah Ada");
			gdInp.cells(gdInp.getSelectedId(),0).setValue('');
			document.getElementById("pilihCell0").click();
			return;
		}
		if(tax=="") {
			tax = '0';	
		}
		if(discrp < 1) {
			discrp = "";	
		}
		nmbarang = nmbarang+" "+warna+" "+ukuran;
		gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
		gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
		gdInp.cells(gdInp.getSelectedId(),3).setValue(satuan);
		gdInp.cells(gdInp.getSelectedId(),4).setValue(jml);
		gdInp.cells(gdInp.getSelectedId(),6).setValue(hrgBeli);
		gdInp.cells(gdInp.getSelectedId(),7).setValue(disc_1);
		gdInp.cells(gdInp.getSelectedId(),8).setValue(discrp);
		gdInp.cells(gdInp.getSelectedId(),9).setValue(tax);
		gdInp.cells(gdInp.getSelectedId(),10).setValue(total);
		gdInp.cells(gdInp.getSelectedId(),12).setValue(hrgJual);
		index = gdInp.getRowIndex(gdInp.getSelectedId());
		gdInp.setRowId(index,kode.toUpperCase());
		document.getElementById("pilihCell5").click();
	}
	
// Window Pesanan
var winPesanan_pb1 = dhxWins.createWindow("winPesanan_pb1",0,0,800,480);
winPesanan_pb1.setText("Daftar Pesanan");
winPesanan_pb1.button("park").hide();
winPesanan_pb1.button("minmax1").hide();
winPesanan_pb1.center();
winPesanan_pb1.button("close").attachEvent("onClick", function() {
	winPesanan_pb1.hide();
});

tb_winPesanan_pb1 = winPesanan_pb1.attachToolbar();
tb_winPesanan_pb1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_winPesanan_pb1.setSkin("dhx_terrace");
tb_winPesanan_pb1.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_winPesanan_pb1.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_winPesanan_pb1.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			pilihPesanan_pb1();
	} else if(id=='tutup') {
			winPesanan_pb1.hide();
	}
});

gd_Pesan_pb1 = new dhtmlXGridObject('tmpGrid_pesan_pb1');
gd_Pesan_pb1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_Pesan_pb1.setHeader("&nbsp;,No.Transfer,Tanggal,Supplier,Tgl Kirim,Jml Pesan,Total,DP,outletid,idrekan,tax,taxRp,idtermin",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_Pesan_pb1.setInitWidths("30,110,80,120,80,100,100,80,0,0,0,0,0");
gd_Pesan_pb1.setColAlign("right,left,left,left,left,left,right,right,right,right,right,right,right");
gd_Pesan_pb1.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str,str");
gd_Pesan_pb1.setColTypes("cntr,ro,ro,ro,ro,ro,ron,ron,ro,ro,ro,ro,ro");
gd_Pesan_pb1.setNumberFormat("0,000",6,",",".");
gd_Pesan_pb1.setNumberFormat("0,000",7,",",".");
gd_Pesan_pb1.attachEvent("onRowDblClicked", function(rId,cInd){
	pilihPesanan_pb1();
});
gd_Pesan_pb1.setColumnColor("#CCE2FE");
gd_Pesan_pb1.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,&nbsp;,&nbsp;");
gd_Pesan_pb1.splitAt(0);
gd_Pesan_pb1.setSkin("dhx_skyblue");
gd_Pesan_pb1.init();

winPesanan_pb1.hide();

function showWinPesanan_pb1() {
	if(document.frm_pb1.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pb1.gudang.focus();
		return;
	}
	//loadDaftarTunda_pj1();
	winPesanan_pb1.bringToTop();
	winPesanan_pb1.setModal(true);
	winPesanan_pb1.show();
	winPesanan_pb1.attachObject('tmpWinPesanan_pb1');
}

function cariDataPesanan_pb1() {
	gudang = document.frm_pb1.gudang.value;
	slcField = document.frmPesan_pb1.slcField.value;
	if(document.frmPesan_pb1.txtKunci.value != "") {
		txtKunci = document.frmPesan_pb1.txtKunci.value;
	} else {
		txtKunci = 0;
	}
	tglAwal = document.frmPesan_pb1.tglPesan1_pb1.value;
	tglAkhir = document.frmPesan_pb1.tglPesan2_pb1.value;
	gd_Pesan_pb1.clearAll();
	statusLoading();
	gd_Pesan_pb1.loadXML(base_url+"index.php/pembelian_barang/loadDataPesanan/"+gudang+"/"+slcField+"/"+txtKunci+"/"+tglAwal+"/"+tglAkhir,function() {
		statusEnding();
	});
}

function pilihPesanan_pb1() {
	//baru_pb1();
	gd_win_brg.clearAll();
	baru_pb1();
	document.frm_pb1.gudang.value = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),8).getValue();
	outlet_id = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),8).getValue();
	document.frm_pb1.gudang.disabled = true;
	document.frm_pb1.no_po.value = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),1).getValue();
	document.frm_pb1.txtidSupplier.value = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),9).getValue();
	document.getElementById('tmpNmSupplier_pb1').innerHTML = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),3).getValue();
	dp = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),7).getValue();
	$('#tunai').val(dp);
	document.frm_pb1.pajak.value = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),10).getValue();
	$('#pajak2').val(gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),11).getValue());
	document.frm_pb1.termin.value = gd_Pesan_pb1.cells(gd_Pesan_pb1.getSelectedId(),12).getValue();
	winPesanan_pb1.hide();
}

function hitungDiscpBarcode_pb1(disc) {
	if(disc != "" && disc != "0") {
		document.frm_pb1.discr_barcode.disabled = true; 
		document.frm_pb1.discr_barcode.value = "";
	} else {
		document.frm_pb1.discr_barcode.disabled = false; 	
	}
}

function hitungDiscrBarcode_pb1(disc) {
	if(disc != "" && disc != "0") {
		document.frm_pb1.discpBarcode.disabled = true; 
		document.frm_pb1.discpBarcode.value = "";
	} else {
		document.frm_pb1.discpBarcode.disabled = false; 	
	}
}

function winAkun_pb1(url) {
		
		if(outlet_id=="") {
			alert("Pilih Lokasi Terlebih Dahulu");
			return;
		}
		try {
			if(w3_pb1.isHidden()==true) {
				w3_pb1.show();
			}
			w3_pb1.bringToTop();
			return;
		} catch(e) {}
		w3_pb1 = dhxWins.createWindow("w3_pb1",0,0,280,180);
		w3_pb1.setText("Kode Perkiraan");
		w3_pb1.button("park").hide();
		w3_pb1.button("minmax1").hide();
		w3_pb1.center();		
		w3_pb1.attachURL(base_url+"index.php/pembelian_barang/"+url+"/"+outlet_id+"/"+document.frm_pb1.kdtrans.value, true);
		
	}


</script>

<div class="frmContainer">
<form name="frm_pb4" id="frm_pb4" method="post" action="javascript:void(0);">
  <table border="0" align="center">
    
    <tr>
      <td width="84">No. Transaksi</td>
      <td width="198"><input type="text" name="no_lpp" id="no_lpp" value="<?php if(isset($no_lpp)): echo $no_lpp; endif;?>" placeHolder="[AUTO]" readonly="readonly" disabled="disabled" />
      <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif;?>" /></td>
      <td width="141">Supplier</td>
      <td width="80"><input name="txtidSupplier" type="text" id="txtidSupplier" size="5" value="<?php if(isset($txtidSupplier)): echo $txtidSupplier; endif;?>" />
&nbsp;<img name="btnakun_pb4" id="btnakun_pb4" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pb4();" /></td>
      <td width="134" id="tmpNmSupplier_pb4"><span style="color:#0000FF;">
        <?php if(isset($nmSupplier)): echo $nmSupplier; endif;?>
      </span></td>
      <td width="73">Keterangan</td>
      <td width="258" rowspan="3" valign="top"><textarea name="ket" id="ket" cols="30" rows="3"><?php if(isset($ket)): echo $ket; endif;?></textarea></td>
      </tr>
    <tr>
      <td>Tanggal</td>
      <td><input type="text" name="tglPesen" id="tglPesen" readonly size="10" value="<?php if(isset($tglPesen)) { echo $tglPesen; } else { echo date("d/m/Y"); }?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="txttgl_pesen_pb4" style="cursor:pointer;" border="0" /></td>
      <td>Tanggal Kirim</td>
      <td colspan="2" align="left"><input type="text" name="tglKirim" id="tglKirim" readonly size="10" value="<?php if(isset($tglKirim)): echo $tglKirim; endif;?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="txttgl_kirim_pb4" style="cursor:pointer;" border="0" /><span style="color:#0000FF;">
        <input type="hidden" name="akun_kas" id="akun_kas" value="<?php if(isset($akun_kas)): echo $akun_kas; endif;?>" />
        <input type="hidden" name="akun_dp" id="akun_dp" value="<?php if(isset($akun_dp)): echo $akun_dp; endif;?>" />
        </span></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>Lokasi</td>
      <td><select name="gudang" id="gudang" style="width:150px;" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll(); setAkun_pb4();">
        <?php echo $gudang; ?>
      </select></td>
      <td>Termin Pembayaran</td>
      <td colspan="2"><select name="termin" id="termin">
      <?php echo $top; ?>
      </select></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td colspan="7"><div id="tmpGridBrg_pb4" style="height:300px; width:100%;"></div></td>
      </tr>
    <tr>
      <td colspan="3" style="color:#00F;"><span id="tmpSB_pb4"><strong>Scan Barcode</strong></span></td>
      <td colspan="4" rowspan="5" align="right"><table width="561" border="0">
        <tr>
          <td width="111">Sub Total Item</td>
          <td width="188">:
            <input style="text-align:right;" name="sub_total_item" type="text" id="sub_total_item" size="21" value="<?php if(isset($sub_total_item)){ echo $sub_total_item; } else { echo 0; }?>" disabled="disabled" /></td>
          <td width="92">Sub Total</td>
          <td width="152">:
            <input style="text-align:right;" name="sub_total" type="text" id="sub_total" size="15" value="<?php if(isset($sub_total)){ echo $sub_total; } else { echo 0; }?>" disabled="disabled" /></td>
          </tr>
        <tr>
          <td>Sub Total Terima</td>
          <td>:
            <input style="text-align:right;" name="sub_total_terima" type="text" id="sub_total_terima" size="21" value="<?php if(isset($sub_total_terima)){ echo $sub_total_terima; } else { echo 0; }?>" disabled="disabled" /></td>
          <td>Total Akhir</td>
          <td>:
            <input style="text-align:right;" name="total_akhir" type="text" id="total_akhir" size="15" value="<?php if(isset($total_akhir)){ echo $total_akhir; } else { echo 0; }?>" disabled="disabled" /></td>
          </tr>
        <tr>
          <td>Potongan</td>
          <td>:
            <input style="text-align:right;" name="potongan" type="text" id="potongan" onkeyup="persenPot();" size="6" value="<?php if(isset($potongan)){ echo $potongan; } else { echo 0; }?>" />
            <input style="text-align:right;" name="potongan2" type="text" id="potongan2" size="10" value="<?php if(isset($potongan2)){ echo $potongan2; } else { echo 0; }?>" onkeyup="rupiahPot_pb4();" onblur="if(this.value=='') { this.value='0'; }" /></td>
          <td>Tunai / DP</td>
          <td>:
            <input style="text-align:right;" name="tunai" type="text" id="tunai" size="15" value="<?php if(isset($tunai)){ echo $tunai; } else { echo 0; }?>" onkeyup="tunai_pb4();" onblur="if(this.value=='') { this.value='0'; }" /> 
            <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txtakun_pb4" style="cursor:pointer;" border="0" onclick="winSetAkun_pb4();" /></td>
          </tr>
        <tr>
          <td>Pajak</td>
          <td>:
             <select name="pajak" id="pajak" style="width:60px;" onchange="persenTax();">
          <?php echo $pajak; ?>
        </select>
            <input style="text-align:right;" name="pajak2" type="text" id="pajak2" onkeyup="rupiahTax();" size="10" value="<?php if(isset($pajak2)){ echo $pajak2; } else { echo 0; }?>" disabled="disabled" /></td>
          <td>Kekurangan</td>
          <td>:
            <input style="text-align:right;" name="kredit" type="text" id="kredit" size="15" value="<?php if(isset($kredit)){ echo $kredit; } else { echo 0; }?>" disabled="disabled" /></td>
        </tr>
        </table></td>
      </tr>
    <tr>
      <td valign="top" style="color:#00F;"><span id="tmpPot_pb4"><strong>Potongan</strong></span></td>
      <td valign="top"><span style="color:#00F" id="tmpInpBarocde_pb4">
        <input name="discpBarcode" type="text" id="discpBarcode" size="2" onkeyup="hitungDiscpBarcode_pb4(this.value);" />
%, Rp.
<input name="discr_barcode" type="text" id="discr_barcode" size="8" onkeyup="hitungDiscrBarcode_pb4(this.value);" style="text-align:right" />
      </span></td>
      <td align="right">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" style="color:#00F;"><span id="tmpPjkBarcode_pb4"><strong>Pajak</strong></span></td>
      <td valign="top"><span id="tmpInpPjkBarcode_pb4"><strong>
        <select name="slcPajakBrg" id="slcPajakBrg" style="width:41px;">
          <?php echo $pilihPajak; ?>
        </select>
      </strong></span></td>
      <td align="right">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" style="color:#00F;"><span id="tmpTxtBarcode"><strong>Barcode</strong></span></td>
      <td colspan="2" valign="top" style="color:#00F;"><span id="tmpInpBarcode"><strong>
        <input type="text" name="txtBarcode" placeholder="Scan Barcode Disini" id="txtBarcode" size="15" onkeyup="if(event.keyCode==13) { scanner_pb4(this.value);  }" />
        &nbsp;
        <input type="checkbox" id="cbShortment" name="cbShortment" />
        &nbsp;Shortment</strong></span></td>
      </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top" id="tmpInfoBarcode_pb4">&nbsp;</td>
      <td align="right">&nbsp;</td>
    </tr>
  </table>
</form>
</div>

<script language="javascript">

<?php if($setBarcode==0): ?>
document.getElementById("tmpSB_pb4").style.display = "none";
document.getElementById("tmpPot_pb4").style.display = "none";
document.getElementById("tmpInpBarocde_pb4").style.display = "none";
document.getElementById("tmpPjkBarcode_pb4").style.display = "none";
document.getElementById("tmpInpPjkBarcode_pb4").style.display = "none";
document.getElementById("tmpInpBarcode").style.display = "none";
document.getElementById("tmpTxtBarcode").style.display = "none"; 
<?php endif;?>



	$(function() {
		$('#sub_total_item').number(true, 0);
		$('#sub_total_terima').number(true, 0);
		$('#sub_total').number(true, 0);
		$('#pajak2').number(true, 0);
		$('#potongan2').number(true, 0);
		$('#biaya_lain2').number(true, 0);
		$('#total_akhir').number(true, 0);
		$('#tunai').number(true, 0);
		$('#kredit').number(true, 0);
		$('#discr_barcode').number(true, 2);
	});
	
	function baru_pb4(){
		document.frm_pb4.id.value = "";
		document.frm_pb4.no_lpp.value = "";
		document.frm_pb4.tglPesen.value = "<?php echo date("d/m/Y"); ?>";
		document.frm_pb4.gudang.value = "";
		document.frm_pb4.tglKirim.value = "";
		document.frm_pb4.txtidSupplier.value = "";
		document.getElementById('tmpNmSupplier_pb4').innerHTML = "";
		document.getElementById('tmpInfoBarcode_pb4').innerHTML = "";
		document.frm_pb4.txtBarcode.value = "";
		document.frm_pb4.ket.value = "";
		document.frm_pb4.termin.value = "";
		document.frm_pb4.sub_total_item.value = "0";
		document.frm_pb4.sub_total_terima.value = "0";
		document.frm_pb4.sub_total.value = "0";
		document.frm_pb4.total_akhir.value = "0";
		document.frm_pb4.potongan.value = "0";
		document.frm_pb4.potongan2.value = "0";
		document.frm_pb4.tunai.value = "0";
		document.frm_pb4.pajak.value = "0";
		document.frm_pb4.pajak2.value = "0";
		document.frm_pb4.kredit.value = "0";
		document.frm_pb4.gudang.disabled = false;
		outlet_id = "";
		gdInp.clearAll();
		gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','0','',img_del],0);
		gdInp.selectRow(0);
		
		// scan barcode
		document.frm_pb4.discpBarcode.value = "";
		document.frm_pb4.discr_barcode.value = "";
		document.frm_pb4.slcPajakBrg.value = "0";
		document.frm_pb4.txtBarcode.value = "";
		document.frm_pb4.cbShortment.checked = false;
	}
	
	outlet_id = document.frm_pb4.gudang.value;
	gd_win_brg.clearAll();
	
	// tanggal pesen
	cal1_pb4 = new dhtmlXCalendarObject({
			input: "tglPesen",button: "txttgl_pesen_pb4"
	});
	cal1_pb4.setDateFormat("%d/%m/%Y");
	cal1_pb4.setSensitiveRange("<?php echo $periodeAwal; ?>", "<?php echo date("d/m/Y"); ?>");
	
	// tanggal kirim
	cal2_pb4 = new dhtmlXCalendarObject({
			input: "tglKirim",button: "txttgl_kirim_pb4"
	});
	cal2_pb4.setDateFormat("%d/%m/%Y");
	cal2_pb4.setSensitiveRange("<?php echo date("d/m/Y"); ?>",null);
	
	function winAkun_pb4() {
		try {
			if(w2_pb4.isHidden()==true) {
				w2_pb4.show();
				document.getElementById('frmSearchAkun').focus();
			}
			w2_pb4.bringToTop();
			return;
		} catch(e) {}
		w2_pb4 = dhxWins.createWindow("w2_pb4",0,0,430,450);
		w2_pb4.setText("Daftar Supplier");
		w2_pb4.button("park").hide();
		w2_pb4.button("minmax1").hide();
		w2_pb4.center();
		
		tb_w2_pb4 = w2_pb4.attachToolbar();
		tb_w2_pb4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pb4.setSkin("dhx_terrace");
		tb_w2_pb4.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pb4.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahSupplier(13);
			}
		});
		
		w2_pb4.attachURL(base_url+"index.php/pesanan_pembelian/frm_search_supplier", true);
	}
	
	gdInp = new dhtmlXGridObject('tmpGridBrg_pb4');
	gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gdInp.setHeader("Kode Item,#cspan,Nama Barang,Satuan,Jml Pesan,Jml Terima,Harga,Pot %,Pot Rp,Pajak,Total,&nbsp;",null,
	["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gdInp.setInitWidths("80,30,180,70,80,80,80,50,70,65,100,30");
	gdInp.setColAlign("left,right,left,left,right,right,right,right,right,right,right,center");
	gdInp.setColTypes("ed,ro,ro,ro,edn,ron,ron,edn,edn,coro,ron,ro");
	gdInp.setSkin("dhx_skyblue");
	gdInp.attachEvent("onEnter", doOnEnterInp_pd4);
	gdInp.attachEvent("onEditCell", doOnCellEdit_pd4);
	gdInp.setSkin("dhx_skyblue");
	gdInp.setNumberFormat("0,000",4,",",".");
	gdInp.setNumberFormat("0,000",5,",",".");
	gdInp.setNumberFormat("0,000",6,",",".");
	gdInp.setNumberFormat("0,000.00",7,",",".");
	gdInp.setNumberFormat("0,000.00",8,",",".");
	gdInp.setNumberFormat("0,000",9,",",".");
	gdInp.setNumberFormat("0,000.00",10,",",".");
	<?php foreach($qPajak->result() as $rP) { ?>
	gdInp.getCombo(9).put(<?php echo $rP->nilai; ?>, '<?php echo $rP->kode_pajak; ?>');
	<?php } ?>
	gdInp.init();
	//WinTambahBarang_pb4();
	
	<?php if(isset($no_lpp)){ ?> 
		tb_w1_pb4.enableItem("cetak");
		loadChild();
	<?php } else { ?>
		baru_pb4();
	<?php }?>
	
	function loadChild(){
		gdInp.clearAll();
		gdInp.loadXML(base_url+"index.php/pesanan_pembelian/loadChild/"+document.frm_pb4.no_lpp.value,function(){
			addRowInp_pd4();
			//gdInp.selectRow(gdInp.getRowsNum() - 1);
		});
	}
	
	function addRowInp_pd4() {
		arrId = gdInp.getAllItemIds().split(",");
		idcell = arrId[arrId.length - 1];
		celIdbarang = gdInp.cells(idcell,0).getValue();
		if(celIdbarang != "") {
				posisi = gdInp.getRowsNum();
				gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','0','',img_del],posisi);
				//gdInp.selectRow(posisi);
				try { gdInp.showRow(gdInp.uid()); } catch(e) {}
		}
	}
	
	function doOnEnterInp_pd4(rowId, cellInd) {
		if(cellInd==0) {
			cariBarang();
		}
		addRowInp_pd4();
		return true;
	}
	
	function scanner_pb4(barcode){
		if(outlet_id==""){
			alert("Pilih Dahulu Gudang / Lokasi Barang");
			return;
		}
		if(barcode==""){
			alert("Barcode Tidak Boleh Kosong");
			return;
		}
		if(document.frm_pb4.cbShortment.checked==true){
			scanSizeRun_pb4(barcode);
		} else {
			scanBarcode_pb4(barcode);
		}
	}
	
	function scanBarcode_pb4(barcode){
		var poststr = 
			'barcode=' + barcode +
			'&outlet_id=' + outlet_id;
		document.getElementById('tmpInfoBarcode_pb4').innerHTML = "";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcode", encodeURI(poststr), function(loader){
			result = loader.xmlDoc.responseText;
			if(result == '0'){
				document.getElementById('tmpInfoBarcode_pb4').innerHTML = "Barcode Tidak Ditemukan";
			} else {
				arrBrg = result.split('|');
				if(adaBarang(arrBrg[0]) == 0){
					
					// disc
					discBarcodeP = "";
					discBarcodeR = "";
					pajakBarcode = document.frm_pb4.slcPajakBrg.value;
					if(document.frm_pb4.discpBarcode.value != "") {
						discBarcodeP = 	document.frm_pb4.discpBarcode.value;
						discBarcodeR = arrBrg[6] * discBarcodeP/100;
					}
					if(document.frm_pb4.discr_barcode.value != "") {
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
					gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,nmbarang,arrBrg[4],'1','',arrBrg[6],discBarcodeP,discBarcodeR,pajakBarcode,total,img_del],posisi);
					gdInp.selectRow(posisi);
					//gdInp.showRow(arrBrg[0]);
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
			
			//hitungTotal_pb4();
			hitungGrid();
			persenPot();
			persenTax();
			document.frm_pb4.txtBarcode.value = "";
			document.frm_pb4.txtBarcode.focus();
		});
	}
	
	function scanSizeRun_pb4(barcode){
		
		var poststr = 
			'sizeRun=' + barcode +
			'&outlet_id=' + outlet_id;
		
		document.getElementById('tmpInfoBarcode_pb4').innerHTML = "";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRun", encodeURI(poststr), function(loader){
			result = loader.xmlDoc.responseText;
			if(result == '0'){
				document.getElementById('tmpInfoBarcode_pb4').innerHTML = "Size Run Tidak Ditemukan";
				return;
			} else {
				arrSizeRun = result.split('~');
				for(i=0; i<arrSizeRun.length;i++){
					if(arrSizeRun[i] != "0" && arrSizeRun[i] != ""){
						arrBrg = arrSizeRun[i].split('|');
						if(adaBarang(arrBrg[0]) == 0){
							// disc
							discBarcodeP = "";
							discBarcodeR = "";
							pajakBarcode = document.frm_pb4.slcPajakBrg.value;
							if(document.frm_pb4.discpBarcode.value != "") {
								discBarcodeP = 	document.frm_pb4.discpBarcode.value;
								discBarcodeR = arrBrg[6] * discBarcodeP/100;
							}
							if(document.frm_pb4.discr_barcode.value != "") {
								discBarcodeR = 	$('#discr_barcode').val();
								discBarcodeP = discBarcodeR / arrBrg[6] * 100;
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
							gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,nmbarang,arrBrg[4],arrBrg[5],'',arrBrg[7],discBarcodeP,discBarcodeR,pajakBarcode,total,img_del],posisi);
							gdInp.selectRow(posisi);
							//gdInp.showRow(arrBrg[0]);
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
			hitungGrid();
			persenPot();
			persenTax();
			document.frm_pb4.txtBarcode.value = "";
			document.frm_pb4.txtBarcode.focus();
		});
	}
	
	function doOnCellEdit_pd4(stage, rowId, cellInd){
		if(stage == 2){
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
			var qtyItem = gdInp.cells(gdInp.getSelectedId(), 4).getValue();
			var qty = gdInp.cells(gdInp.getSelectedId(), 5).getValue();
			
			if(parseInt(qtyItem) < parseInt(qty)){
				alert("Maaf, Jml Terima Tidak Boleh Lebih dari Jml Pesan!");
				return;
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
			hitungGrid();
			persenPot();
			persenTax();
			addRowInp_pd4();
			
		}
		return true;
	}
	
	function subtotal_pj1(){
		hitungGrid();
		persenPot();
		persenTax();
	}
	
	function persenPot(){
		var subtotal2 = $('#sub_total').val();
		var pot = $('#potongan').val();
		var pot2 = (parseInt(pot)*parseInt(subtotal2))/100;
		$('#potongan2').val(pot2);
		hitungGrid();
	}
	
	function rupiahPot_pb4() {
		subtotal = $('#sub_total').val();
		if(subtotal == 0) {
			$('#potongan2').val(0);
			return;
		}
		disc = $('#potongan2').val();
		if(disc != "" || disc != "0") {
			discPersen = (disc / subtotal) * 100;
			//$('#txtDiscRupiah').val(discRp);
			document.frm_pb4.potongan.value = precise_round(discPersen,2);
		}
		hitungGrid();
	}
	
	function persenTax(){
		var subtotal2 = $('#sub_total').val();
		var pot2 = $('#potongan2').val();
		var tax = $('#pajak').val();
		var tax2 = ((parseInt(subtotal2)-parseInt(pot2))*tax)/100;
		$('#pajak2').val(tax2);
		hitungGrid();
	}
	
	function hitungGrid(){
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
			potRupiah = $('#potongan2').val();
		} else {
			potRupiah = 0;
		}
		if($('#pajak2').val() != "") {
			pajakRupiah = $('#pajak2').val();
		} else {
			pajakRupiah = 0;
		}
		var total = parseInt(subTotal)-parseInt(potRupiah)+parseInt(pajakRupiah);
			
		if($('#tunai').val() != "") {
			tunai = $('#tunai').val();
		} else {
			tunai = 0;
		}
		var kredit = parseInt(total)-parseInt(tunai);
		$('#total_akhir').val(total);
		$('#kredit').val(kredit);
	}
	
	function tunai_pb4(){
		var total = $('#total_akhir').val();
		if($('#tunai').val() != "") {
			tunai = $('#tunai').val();
		} else {
			tunai = 0;
		}
		var total = parseInt(total);
		var tunai = parseInt(tunai);
		if(tunai>total){
			alert("Maaf Nilai Tunai / DP Melebihi Total Akhir !");
			return;
		} else {
			var kredit = parseInt(total)-parseInt(tunai);
			$('#kredit').val(kredit);
		}
	}
	
	function simpan_pb4(){
		if(document.frm_pb4.tglPesen.value == ""){
			alert("Tanggal Pesanan Tidak Boleh Kosong!");
			document.frm_pb4.tglPesen.focus();
			return;
		}
		
		if(document.frm_pb4.txtidSupplier.value == ""){
			alert("Supplier Tidak Boleh Kosong!");
			document.frm_pb4.txtidSupplier.focus();
			return;
		}
		
		if(document.frm_pb4.gudang.value == ""){
			alert("Gudang Tidak Boleh Kosong!");
			document.frm_pb4.gudang.focus();
			return;
		}
		
		if(document.frm_pb4.tglKirim.value == ""){
			alert("Tanggal Pengiriman Tidak Boleh Kosong!");
			document.frm_pb4.tglKirim.focus();
			return;
		}
		
		if(document.frm_pb4.sub_total.value == ""){
			alert("Sub total Tidak Boleh Kosong!");
			document.frm_pb4.sub_total.focus();
			return;
		}
		
		if(gdInp.getRowsNum()==1){
			alert("Isi Data Pembelian Tidak Boleh Kosong !");
			return;
		}
		
		if(document.frm_pb4.tunai.value == ""){
			alert("Tunai Tidak Boleh Kosong!");
			document.frm_pb4.tunai.focus();
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
		var kredit = $('#kredit').val();
		
		var postPb4 = 
			'id=' + document.frm_pb4.id.value +
			'&kdtrans=' + document.frm_pb4.no_lpp.value +
			'&tglPesan=' + document.frm_pb4.tglPesen.value +
			'&tglKirim=' + document.frm_pb4.tglKirim.value +
			'&supplier=' + document.frm_pb4.txtidSupplier.value +
			'&gudang=' + document.frm_pb4.gudang.value +
			'&termin=' + document.frm_pb4.termin.value +
			'&ket=' + document.frm_pb4.ket.value +
			'&sub_total_item=' + subTotalItem +
			'&sub_total_terima=' + subTotalTerima +
			'&sub_total=' + subtotal +
			'&total_akhir=' + total_akhir +
			'&potongan=' + document.frm_pb4.potongan.value +
			'&potongan2=' + potongan +
			'&tunai=' + tunai +
			'&pajak=' + document.frm_pb4.pajak.value +
			'&pajak2=' + pajak2 +
			'&kredit=' + kredit +
			'&akun_kas=' + document.frm_pb4.akun_kas.value +
			'&akun_dp=' + document.frm_pb4.akun_dp.value +
			'&dataBeli=' + getData(gdInp,[1,2,3,5,11]);
		statusLoading();   
		tb_w1_pb4.disableItem("save");
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pesanan_pembelian/simpan", encodeURI(postPb4), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			if(result=='ERR') { alert("Tgl Pesanan Diluar Dari Periode Akuntansi \n Tidak Diizinkan"); return; }
			document.frm_pb4.no_lpp.value = result;
			document.frmCetak_pb4.kdtrans.value = result;
			refreshGd_pb4();
			addRowInp_pd4();
			tb_w1_pb4.enableItem("save");
			tb_w1_pb4.enableItem("baru");
			tb_w1_pb4.enableItem("cetak");
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
	
	function setDataBrgPb4(kode,nmbarang,warna,ukuran,satuan,hrgBeli) {
		if(adaBarang(kode) != 0) {
			alert("Barang Yang Anda Input Sudah Ada");
			grid.cells(grid.getSelectedId(),0).setValue('');
			document.getElementById("pilihCell0").click();
			return;
		}
		nmbarang = nmbarang+" "+warna+" "+ukuran;
		gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
		gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
		gdInp.cells(gdInp.getSelectedId(),3).setValue(satuan);
		gdInp.cells(gdInp.getSelectedId(),6).setValue(hrgBeli);
		index = gdInp.getRowIndex(gdInp.getSelectedId());
		gdInp.setRowId(index,kode.toUpperCase());
		document.getElementById("pilihCell5").click();
	}
	
	function cetakPO_pb4() {
		if(document.frm_pb4.no_lpp.value=="") {
			return;
		}
		kode = document.frm_pb4.no_lpp.value;
		window.open(base_url+'index.php/pesanan_pembelian/cetak_pesanan/'+kode,'_blank');
	}
	
	function hitungDiscpBarcode_pb4(disc) {
		if(disc != "" && disc != "0") {
			document.frm_pb4.discr_barcode.disabled = true; 
			document.frm_pb4.discr_barcode.value = "";
		} else {
			document.frm_pb4.discr_barcode.disabled = false; 	
		}
	}

	function hitungDiscrBarcode_pb4(disc) {
		if(disc != "" && disc != "0") {
			document.frm_pb4.discpBarcode.disabled = true; 
			document.frm_pb4.discpBarcode.value = "";
		} else {
			document.frm_pb4.discpBarcode.disabled = false; 	
		}
	}
	
	function winSetAkun_pb4() {
		
		if(outlet_id=="") {
			alert("Pilih Lokasi Terlebih Dahulu");
			return;
		}
		try {
			if(w3_pb4.isHidden()==true) {
				w3_pb4.show();
			}
			w3_pb4.bringToTop();
			return;
		} catch(e) {}
		w3_pb4 = dhxWins.createWindow("w3_pb4",0,0,280,175);
		w3_pb4.setText("Kode Perkiraan");
		w3_pb4.button("park").hide();
		w3_pb4.button("minmax1").hide();
		w3_pb4.center();		
		w3_pb4.attachURL(base_url+"index.php/pesanan_pembelian/setAkun/"+outlet_id+"/"+document.frm_pb4.no_lpp.value, true);
		
	}

</script>
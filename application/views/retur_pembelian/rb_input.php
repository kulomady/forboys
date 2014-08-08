<div class="frmContainer">
<form name="frm_pb3" id="frm_pb3" method="post" action="javascript:void(0);">
  <table width="915" border="0" align="center">
    <tr>
      <td width="86">No. Transaksi</td>
      <td width="225"><input type="text" name="kdtrans" id="kdtrans" value="<?php if(isset($kdtrans)): echo $kdtrans; endif; ?>" placeholder = "[AUTO]" disabled="disabled" />
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif;?>" /></td>
      <td width="94">Gudang</td>
      <td width="183"><span style="color:#FF0000;">
        <select name="gudang" id="gudang" style="width:150px;" onchange="initOutlet(this.value); gd_win_brg.clearAll();">
          <?php echo $gudang; ?>
        </select>
      </span></td>
      <td width="86">Supplier</td>
      <td width="215"><input name="supplier" type="text" id="supplier" value="<?php if(isset($supplier)): echo $supplier; endif;?>" size="5" readonly="readonly" />&nbsp;<span id="tmpSupplier_pb3" style="color:#FF0000;"></span></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input type="text" name="tglRetur" id="tglRetur" readonly="readonly" size="10" value="<?php if(isset($tglRetur)) { echo $tglRetur; } else { echo "d/m/Y"; }?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="txttgl_beli_pb3" style="cursor:pointer;" border="0" /></td>
      <td>No. Pembelian</td>
      <td><input name="no_lpb" type="text" id="no_lpb" size="15" value="<?php if(isset($no_lpb)): echo $no_lpb; endif;?>" disabled="disabled" />
&nbsp;<img id="btnPsn" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/blue_view.png" border="0" style="cursor:pointer;" onclick="showWinBeli_pb3();" /></td>
      <td>Keterangan</td>
      <td><input type="text" name="ket" id="ket" value="<?php if(isset($ket)): echo $ket; endif;?>" /></td>
    </tr>
    <tr>
      <td colspan="6"><div id="tmpGridBrg_pb3" style="height:300px; width:100%;"></div></td>
      </tr>
    <tr>
      <td colspan="2" valign="top" style="color:#00F;"><span id="tmpSB_pb3"><strong>Scan Barcode<br />      
      </strong></span></td>
      <td colspan="4" rowspan="5" align="right"><table width="540" border="0" align="right">
        <tr>
          <td width="102">Sub Total Item</td>
          <td width="76">:
            <input name="sub_total_item" type="text" id="sub_total_item" style="text-align:right;" value="<?php if(isset($sub_total_item)){ echo $sub_total_item; } else { echo 0; }?>" size="6" readonly="readonly" /></td>
          <td width="41"><span id="tmpTxtPcs_pb3"># PCS</span></td>
          <td width="83"><span id="tmpInpPcs_pb3"><input style="text-align:right;" name="sub_total_terima" type="text" id="sub_total_terima" size="3" value="<?php if(isset($sub_total_terima)){ echo $sub_total_terima; } else { echo 0; }?>" readonly="readonly" /></span></td>
          <td width="79">Sub Total</td>
          <td width="133">:
            <input style="text-align:right;" name="sub_total" type="text" id="sub_total" size="12" value="<?php if(isset($sub_total)){ echo $sub_total; } else { echo 0; }?>" disabled="disabled" /></td>
          </tr>
        <tr>
          <td>Potongan</td>
          <td colspan="3">:            
            <input style="text-align:right;" name="potongan" type="text" id="potongan" onkeyup="persenPot_pb3();" size="6" value="<?php if(isset($potongan)){ echo $potongan; } else { echo 0; }?>" />
            <input style="text-align:right;" name="potongan2" type="text" id="potongan2" size="12" value="<?php if(isset($potongan2)){ echo $potongan2; } else { echo 0; }?>" onkeyup="rupiahPot();" />
            <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb2" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunDpSo');" /></td>
          <td>Total Akhir</td>
          <td>:
            <input style="text-align:right;" name="total_akhir" type="text" id="total_akhir" size="12" value="<?php if(isset($total_akhir)){ echo $total_akhir; } else { echo 0; }?>" disabled="disabled" /></td>
          </tr>
        <tr>
          <td>Pajak</td>
          <td colspan="3">:
             <select name="pajak" id="pajak" style="width:60px;" onchange="persenTax_pb3();">
                  <?php echo $pajak; ?>
                </select>
            <input style="text-align:right;" name="pajak2" type="text" id="pajak2" onkeyup="rupiahTax();" size="12" value="<?php if(isset($pajak2)){ echo $pajak2; } else { echo 0; }?>" disabled="disabled" />
            <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb3" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunDpSo');" /></td>
          <td>Tunai / DP</td>
          <td>:
            <input style="text-align:right;" name="tunai" type="text" id="tunai" size="12" value="<?php if(isset($tunai)){ echo $tunai; } else { echo 0; }?>" onKeyUp="tunai_pb3();" />
            <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb5" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunDpSo');" /></td>
          </tr>
        <tr>
          <td>Biaya Kirim</td>
          <td colspan="3">: 
            <select name="slcPajak" id="slcPajak" style="width:60px;" onchange="hitungGrid_pb3();">
              <?php echo $pilihPajakBarcode; ?>
              </select>
            <input style="text-align:right;" name="biaya_kirim" type="text" id="biaya_kirim" onkeyup="hitungGrid_pb3();" size="12" value="<?php if(isset($biaya_kirim)){ echo $biaya_kirim; } else { echo 0; }?>" onblur="if(this.value=='') { this.value = '0.00'; }" />
            <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb4" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunDpSo');" /></td>
          <td>Pot Hutang</td>
          <td>:
            <input style="text-align:right;" name="kredit" type="text" id="kredit" size="12" value="<?php if(isset($kredit)){ echo $kredit; } else { echo 0; }?>" disabled="disabled" />
            <img src="<?php echo base_url(); ?>assets/img/icon/pensil.jpg" alt="" id="txttgl_kirim_pb" style="cursor:pointer;" border="0" onclick="winAkun_pb1('akunDpSo');" /></td>
          </tr>
      </table></td>
      </tr>
    <tr>
      <td valign="top" style="color:#00F;"><span id="tmpPot_pb3"><strong>Potongan</strong></span></td>
      <td valign="middle"><strong><span style="color:#00F" id="tmpInpBarocde_pb3">
        <input name="discpBarcode" type="text" id="discpBarcode" size="2" onkeyup="hitungDiscpBarcode_pb3(this.value);" />
%, Rp.
<input name="discr_barcode" type="text" id="discr_barcode" size="8" onkeyup="hitungDiscrBarcode_pb3(this.value);" style="text-align:right" />
      </span></strong></td>
    </tr>
    <tr>
      <td valign="top" style="color:#00F;"><span id="tmpPjkBarcode_pb3"><strong>Pajak</strong></span></td>
      <td valign="middle"><span id="tmpInpPjkBarcode_pb3"><strong>
        <select name="slcPajakBrg" id="slcPajakBrg" style="width:41px;">
          <?php echo $pilihPajak; ?>
        </select>
      </strong></span></td>
    </tr>
    <tr>
      <td valign="top" style="color:#00F;"><span id="tmpTxtBarcode"><strong>Barcode</strong></span></td>
      <td valign="middle" style="color:#00F;"><span id="tmpInpBarcode"><strong>
        <input type="text" name="txtBarcode" id="txtBarcode" size="15" onkeyup="if(event.keyCode==13) { scanner_pb3(this.value);  }" />
&nbsp;
<input type="checkbox" id="cbShortment" name="cbShortment" />
&nbsp;Shortment</strong></span></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td id="tmpInfoBarcode_pb3">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</div>

<div id="tmpWinBeli_pb3" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
<form name="frmBeli_pb3" id="frmBeli_pb3" method="post" action="javascript:void(0);">
  <table width="765" border="0" align="center">
    <tr>
      <td width="101">Periode</td>
      <td width="389"><input type="text" name="tglBeli1_pb3" id="tglBeli1_pb3" readonly size="10" value="<?php echo date("Y-m-d"); ?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="btnBeli1_pb3" style="cursor:pointer;" border="0" /> s.d 
        <input type="text" name="tglBeli2_pb3" id="tglBeli2_pb3" readonly="readonly" size="10" value="<?php echo date("Y-m-d"); ?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="" id="btnBeli2_pb3" style="cursor:pointer;" border="0" /></td>
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
      <td><input type="button" name="button" id="button" value="Cari" style="width:100px;" onclick="cariDataPesanan_pb3();"/></td>
    </tr>
    
    <tr>
      <td colspan="3"><div id="tmpGrid_beli_pb3" style="height:350px;width: 100%"></div></td>
      </tr>
  </table>
</form>
</div>

<script language="javascript">

<?php if($setBarcode==0): ?>
document.getElementById("tmpSB_pb3").style.display = "none";
document.getElementById("tmpPot_pb3").style.display = "none";
document.getElementById("tmpInpBarocde_pb3").style.display = "none";
document.getElementById("tmpPjkBarcode_pb3").style.display = "none";
document.getElementById("tmpInpPjkBarcode_pb3").style.display = "none";
document.getElementById("tmpInpBarcode").style.display = "none";
document.getElementById("tmpTxtBarcode").style.display = "none"; 
<?php endif;?>

calBeli1_pb3 = new dhtmlXCalendarObject({
			input: "tglBeli1_pb3",button: "btnBeli1_pb3"
	});
calBeli1_pb3.setDateFormat("%Y-%m-%d");

calBeli2_pb3 = new dhtmlXCalendarObject({
			input: "tglBeli2_pb3",button: "btnBeli2_pb3"
	});
calBeli2_pb3.setDateFormat("%Y-%m-%d");
	
	$(function() {
		$('#sub_total_item').number(true,0);
		$('#sub_total_terima').number(true,0);
		$('#sub_total').number(true,2);
		$('#pajak2').number(true,2);
		$('#potongan2').number(true,2);
		$('#biaya_lain2').number(true,2);
		$('#total_akhir').number(true,2);
		$('#tunai').number(true,2);
		$('#kredit').number(true,2);
		$('#biaya_kirim').number(true,2);
		$('#discr_barcode').number(true,2);
	});
	
	function baru_pb3(){
		document.frm_pb3.id.value = "";
		document.frm_pb3.kdtrans.value = "";
		document.frm_pb3.tglRetur.value = "<?php echo date('d/m/Y'); ?>";
		document.frm_pb3.supplier.value = "";
		document.frm_pb3.no_lpb.value = "";
		document.getElementById('tmpInfoBarcode_pb3').innerHTML = "";
		document.frm_pb3.txtBarcode.value = "";
		document.frm_pb3.ket.value = "";
		document.frm_pb3.sub_total_item.value = "0";
		document.frm_pb3.sub_total_terima.value = "0";
		document.frm_pb3.sub_total.value = "0";
		document.frm_pb3.total_akhir.value = "0";
		document.frm_pb3.potongan.value = "0";
		document.frm_pb3.potongan2.value = "0";
		document.frm_pb3.tunai.value = "0";
		document.frm_pb3.pajak.value = "0";
		document.frm_pb3.pajak2.value = "0";
		document.frm_pb3.kredit.value = "0";
		outlet_id = "";
		document.frm_pb3.gudang.value = "";
		document.getElementById('tmpSupplier_pb3').innerHTML = "";
		gdInp.clearAll();
		/* gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','0','',img_del],0);
		gdInp.selectRow(0); */
		
		// scan barcode
		document.frm_pb3.discpBarcode.value = "";
		document.frm_pb3.discr_barcode.value = "";
		document.frm_pb3.slcPajakBrg.value = "0";
		document.frm_pb3.txtBarcode.value = "";
		document.frm_pb3.cbShortment.checked = false;
	}
	
	//img_link_md41 = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="openWinBrg_pb3(document.frm_pb3.no_lpb.value);" />';
	//img_del_md41 = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail();" />';
	
	function openWinBrg_pb3(kodeBrg) {
		if(kodeBrg=="") {
			alert("Pilih Dahulu No. PB");
			return;
		}
		try {
			if(w3_pb3.isHidden()==true) {
				w3_pb3.show();
				document.getElementById('frmSearchBrg').focus();
			}
			w3_pb3.bringToTop();
			return;
		} catch(e) {}
		w3_pb3 = dhxWins.createWindow("w3_pb3",0,0,430,450);
		w3_pb3.setText("Daftar Barang");
		w3_pb3.button("park").hide();
		w3_pb3.button("minmax1").hide();
		w3_pb3.center();
		
		tb_w3_pb3 = w3_pb3.attachToolbar();
		tb_w3_pb3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w3_pb3.setSkin("dhx_terrace");
		tb_w3_pb3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w3_pb3.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahBarang(13);
			}
		});
		
		w3_pb3.attachURL(base_url+"index.php/retur_pembelian/frm_search_barang/"+kodeBrg, true);
	}
	
	var outlet_id = document.frm_pb3.gudang.value;
	gd_win_brg.clearAll();
	var barcode = document.frm_pb3.txtBarcode.value;
	
	// tanggal pesen
	cal1_pb3 = new dhtmlXCalendarObject({
			input: "tglRetur",button: "txttgl_beli_pb3"
	});
	cal1_pb3.setDateFormat("%d/%m/%Y");
	
	
	function winAkun_pb3() {
		try {
			if(w2_pb3.isHidden()==true) {
				w2_pb3.show();
				document.getElementById('frmSearchAkun').focus();
			}
			w2_pb3.bringToTop();
			return;
		} catch(e) {}
		w2_pb3 = dhxWins.createWindow("w2_pb3",0,0,430,450);
		w2_pb3.setText("Daftar Supplier");
		w2_pb3.button("park").hide();
		w2_pb3.button("minmax1").hide();
		w2_pb3.center();
		
		tb_w2_pb3 = w2_pb3.attachToolbar();
		tb_w2_pb3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pb3.setSkin("dhx_terrace");
		tb_w2_pb3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pb3.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahSupplier(13);
			}
		});
		
		w2_pb3.attachURL(base_url+"index.php/retur_pembelian/frm_search_supplier", true);
	}
	
	gdInp = new dhtmlXGridObject('tmpGridBrg_pb3');
	gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gdInp.setHeader("Kode Item,#cspan,Nama Barang,Satuan,Jml Beli,#PCS,Harga,Pot(%),Pot Rp,Pajak,Total,&nbsp;",null,
	["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gdInp.setInitWidths("80,30,200,65,65,55,80,50,65,60,100,30");
	gdInp.setColAlign("left,right,left,left,right,right,right,right,right,right,right,center");
	gdInp.setColTypes("ed,ro,ro,ro,edn,edn,ron,edn,edn,coro,ron,ro");
	gdInp.attachEvent("onEnter", doOnEnterInp_pb3);
	gdInp.attachEvent("onEditCell", doOnCellEdit_pb3);
	gdInp.setSkin("dhx_skyblue");
	gdInp.setNumberFormat("0,000",4,",",".");
	gdInp.setNumberFormat("0,000",5,",",".");
	gdInp.setNumberFormat("0,000",6,",",".");
	gdInp.setNumberFormat("0,000.00",7,",",".");
	gdInp.setNumberFormat("0,000.00",8,",",".");
	gdInp.setNumberFormat("0,000.00",10,",",".");
	gdInp.setNumberFormat("0,000.00",11,",",".");
	<?php foreach($qPajak->result() as $rP) { ?>
	gdInp.getCombo(9).put(<?php echo $rP->nilai; ?>, '<?php echo $rP->kode_pajak; ?>');
	<?php } ?>
	gdInp.init();
	
	<?php if($kolomPcs==0): ?>
	gdInp.setColumnHidden(5,true);
	document.getElementById("tmpTxtPcs_pb3").style.display = "none";
	document.getElementById("tmpInpPcs_pb3").style.display = "none";
	<?php endif; ?>
	
	function winAkun_pb3() {
		try {
			if(w2_pb3.isHidden()==true) {
				w2_pb3.show();
				document.getElementById('frmSearchAkun').focus();
			}
			w2_pb3.bringToTop();
			return;
		} catch(e) {}
		w2_pb3 = dhxWins.createWindow("w2_pb3",0,0,430,450);
		w2_pb3.setText("Daftar Pembelian");
		w2_pb3.button("park").hide();
		w2_pb3.button("minmax1").hide();
		w2_pb3.center();
		
		tb_w2_pb3 = w2_pb3.attachToolbar();
		tb_w2_pb3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pb3.setSkin("dhx_terrace");
		tb_w2_pb3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pb3.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahSupplier(13);
			}
		});
		
		w2_pb3.attachURL(base_url+"index.php/retur_pembelian/frm_search_beli", true);
	}
	
	<?php if(isset($kdtrans)){ ?> 
		loadChild();
	<?php } else { ?>
		baru_pb3();
	<?php }?>
	
	function loadChild(){
		gdInp.clearAll();
		gdInp.loadXML(base_url+"index.php/retur_pembelian/loadChild/"+document.frm_pb3.kdtrans.value,function(){
			addRowInp_pb3();
			//gdInp.selectRow(gdInp.getRowsNum() - 1);
		});
	}

	function cariData(idBrg) {
		var idBrg = idBrg.toUpperCase();
		var ada = '0';
		var jml = 0;
		if(gdInp.getRowsNum() != '0') {
			var arr = gdInp.getAllItemIds().split(',');
			//alert(arr.length);
            for(i=0;i < arr.length;i++) {
            	id = arr[i];
				var gdBrg = gdInp.cells(id,0).getValue().toUpperCase();
				if(gdBrg==idBrg){
					jml = jml + 1;
					if(jml>1){
						//alert(jml);
						ada = '1';
				    	break;
					}
				}
			}             
		}
        return ada;
	}
	
	function addRowInp_pb3() {
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
	
	function doOnEnterInp_pb3(rowId, cellInd) {
		if(cellInd==0) {
			cariBarang();
		}
		addRowInp_pb3();
		return true;
	}
	
	function scanner_pb3(barcode){
		if(outlet_id==""){
			alert("Pilih Dahulu Gudang / Lokasi Barang");
			return;
		}
		if(barcode==""){
			alert("Barcode Tidak Boleh Kosong");
			return;
		}
		if(document.frm_pb3.cbShortment.checked==true){
			scanSizeRun_pb3(barcode);
		} else {
			scanBarcode_pb3(barcode);
		}
	}
	
	function scanBarcode_pb3(barcode){
		var poststr = 
			'barcode=' + barcode +
			'&outlet_id=' + outlet_id;
		document.getElementById('tmpInfoBarcode_pb3').innerHTML = "";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/scanBarcode", encodeURI(poststr), function(loader){
			result = loader.xmlDoc.responseText;
			if(result == '0'){
				document.getElementById('tmpInfoBarcode_pb3').innerHTML = "Barcode Tidak Ditemukan";
			} else {
				arrBrg = result.split('|');
				if(adaBarang(arrBrg[0]) == 0){
					// disc
					discBarcodeP = "";
					discBarcodeR = "";
					pajakBarcode = document.frm_pb3.slcPajakBrg.value;
					if(document.frm_pb3.discpBarcode.value != "") {
						discBarcodeP = 	document.frm_pb3.discpBarcode.value;
						discBarcodeR = arrBrg[6] * discBarcodeP/100;
					}
					if(document.frm_pb3.discr_barcode.value != "") {
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
			
			//hitungTotal_pb3();
			hitungGrid_pb3();
			persenPot_pb3();
			persenTax_pb3();
			document.frm_pb3.txtBarcode.value = "";
			document.frm_pb3.txtBarcode.focus();
		});
	}
	
	function scanSizeRun_pb3(barcode){
		var poststr = 
			'sizeRun=' + barcode +
			'&outlet_id=' + outlet_id;
		document.getElementById('tmpInfoBarcode_pb3').innerHTML = "";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/sizeRun", encodeURI(poststr), function(loader){
			result = loader.xmlDoc.responseText;
			if(result == '0'){
				document.getElementById('tmpInfoBarcode_pb3').innerHTML = "Size Run Tidak Ditemukan";
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
							pajakBarcode = document.frm_pb3.slcPajakBrg.value;
							if(document.frm_pb3.discpBarcode.value != "") {
								discBarcodeP = 	document.frm_pb3.discpBarcode.value;
								discBarcodeR = arrBrg[7] * discBarcodeP/100;
							}
							if(document.frm_pb3.discr_barcode.value != "") {
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
							gdInp.addRow(arrBrg[0],[arrBrg[0],img_link,nmbarang,arrBrg[4],arrBrg[5],'',arrBrg[7],discBarcodeP,discBarcodeR,pajakBarcode,total,img_del],posisi);
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
			hitungGrid_pb3();
			persenPot_pb3();
			persenTax_pb3();
			document.frm_pb3.txtBarcode.value = "";
			document.frm_pb3.txtBarcode.focus();
		});
	}
	
	function doOnCellEdit_pb3(stage, rowId, cellInd){
	
		if(stage == 2){
			//var qtyItem = gdInp.cells(gdInp.getSelectedId(), 4).getValue();
			var pcs = gdInp.cells(gdInp.getSelectedId(), 5).getValue();
			if(pcs == "") {
				var qty = gdInp.cells(gdInp.getSelectedId(), 4).getValue();
			} else {
				var qty = gdInp.cells(gdInp.getSelectedId(), 4).getValue() * pcs;	
			}
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
			
			var jumlah = qty * harga;
			if(disc!="" || disc!=0){
				var hitung = qty * disc;
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
			hitungGrid_pb3();
			persenPot_pb3();
			persenTax_pb3();
			addRowInp_pb3();
		}
		return true;
	}
	
	function subtotal_pb3(){
		hitungGrid_pb3();
		persenPot_pb3();
		persenTax_pb3();
	}
	
	function persenPot_pb3(){
		var subtotal2 = $('#sub_total').val();
		var pot = $('#potongan').val();
		var pot2 = (parseInt(pot)*parseInt(subtotal2))/100;
		$('#potongan2').val(pot2);
		hitungGrid_pb3();
	}
	
	function persenTax_pb3(){
		var subtotal2 = $('#sub_total').val();
		var pot2 = $('#potongan2').val();
		var tax = $('#pajak').val();
		var tax2 = ((parseInt(subtotal2)-parseInt(pot2))*tax)/100;
		$('#pajak2').val(tax2);
		hitungGrid_pb3();
	}
	
	function hitungGrid_pb3(){
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
		
		if($('#biaya_kirim').val() != "") {
			biaya_kirim = $('#biaya_kirim').val();
			pajakKirim = document.frm_pb3.slcPajak.value;
			if(pajakKirim != '0') {
				nilaiPajakKirim = biaya_kirim * (pajakKirim / 100);
				biaya_kirim = parseInt(biaya_kirim) + parseFloat(nilaiPajakKirim);
				biaya_kirim = precise_round(biaya_kirim,2);
			}
		} else {
			biaya_kirim = 0;
		}
		total = parseInt(total) + parseInt(biaya_kirim);
		
		var kredit = parseInt(total)-parseInt(tunai);
		$('#total_akhir').val(total);
		$('#kredit').val(kredit);
	}
	
	function tunai_pb3(){
		var total = $('#total_akhir').val();
		var tunai = $('#tunai').val();
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
	
	function simpan_pb3(){
		if(document.frm_pb3.tglRetur.value == ""){
			alert("Tanggal Retur Tidak Boleh Kosong!");
			document.frm_pb3.tglRetur.focus();
			return;
		}
		
		/*if(document.frm_pb3.no_lpb.value == ""){
			alert("No. Pembelian Tidak Boleh Kosong!");
			document.frm_pb3.no_lpb.focus();
			return;
		}*/
		
		if(document.frm_pb3.gudang.value == ""){
			alert("Gudang Tidak Boleh Kosong!");
			document.frm_pb3.gudang.focus();
			return;
		}
		
		if(document.frm_pb3.sub_total.value == ""){
			alert("Sub total Tidak Boleh Kosong!");
			document.frm_pb3.sub_total.focus();
			return;
		}
		
		if(gdInp.getRowsNum()==1){
			alert("Isi Data Pembelian Tidak Boleh Kosong !");
			return;
		}
		
		if(document.frm_pb3.tunai.value == ""){
			alert("Tunai Tidak Boleh Kosong!");
			document.frm_pb3.tunai.focus();
			return;
		}
		delgridChild();
		if(cekKosong(10)==1) {
			alert("Total salah satu barang tidak boleh kosong");
			return;
		}
		
		//delete 1 baris paling bawah :)
		var subTotalItem = $('#sub_total_item').val();
		var subTotalTerima = $('#sub_total_terima').val();
		var subtotal = $('#sub_total').val();
		var potongan = $('#potongan2').val();
		var pajak2 = $('#pajak2').val();
		var total_akhir = $('#total_akhir').val();
		var tunai = $('#tunai').val();
		var kredit = $('#kredit').val();
		var biaya_kirim = $('#biaya_kirim').val();
		
		var postpb3 = 
			'id=' + document.frm_pb3.id.value +
			'&no_retur=' + document.frm_pb3.kdtrans.value +
			'&tglRetur=' + document.frm_pb3.tglRetur.value +
			'&no_lpb=' + document.frm_pb3.no_lpb.value +
			'&gudang=' + document.frm_pb3.gudang.value +
			'&ket=' + document.frm_pb3.ket.value +
			'&sub_total_item=' + subTotalItem +
			'&sub_total_terima=' + subTotalTerima +
			'&sub_total=' + subtotal +
			'&total_akhir=' + total_akhir +
			'&potongan=' + document.frm_pb3.potongan.value +
			'&potongan2=' + potongan +
			'&tunai=' + tunai +
			'&pajak=' + document.frm_pb3.pajak.value +
			'&pajak2=' + pajak2 +
			'&slcPajak=' + document.frm_pb3.slcPajak.value +
			'&biaya_kirim=' + biaya_kirim +
			'&kredit=' + kredit +
			'&dataRetur=' + getData(gdInp,[1,2,3,11]);
		statusLoading();   
		tb_w1_pb3.disableItem("save");
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/retur_pembelian/simpan", encodeURI(postpb3), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			document.frm_pb3.kdtrans.value = result;
			refreshGd_pb3();
			addRowInp_pb3();
			tb_w1_pb3.enableItem("save");
			tb_w1_pb3.enableItem("baru");
			
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
	
	function setDataBrgPb3(kode,nmbarang,warna,ukuran,satuan,hrgBeli) {
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
		index = gdInp.getRowIndex(gdInp.getSelectedId());
		gdInp.setRowId(index,kode.toUpperCase());
		document.getElementById("pilihCell5").click();
	}
	
	function setDataBrgImportPb3(kode,nmbarang,warna,ukuran,satuan,jml,pcs,hrgBeli,disc,pajak,total,discrp,tax) {
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
		gdInp.cells(gdInp.getSelectedId(),4).setValue(jml);
		gdInp.cells(gdInp.getSelectedId(),5).setValue(pcs);
		gdInp.cells(gdInp.getSelectedId(),6).setValue(hrgBeli);
		gdInp.cells(gdInp.getSelectedId(),7).setValue(disc);
		gdInp.cells(gdInp.getSelectedId(),8).setValue(discrp);
		gdInp.cells(gdInp.getSelectedId(),9).setValue(pajak);
		gdInp.cells(gdInp.getSelectedId(),10).setValue(total);
		index = gdInp.getRowIndex(gdInp.getSelectedId());
		gdInp.setRowId(index,kode.toUpperCase());
		document.getElementById("pilihCell5").click();
		hitungGrid_pb3();
		persenPot_pb3();
		persenTax_pb3();
	}
	
// Window Pesanan
var winBeli_pb3 = dhxWins.createWindow("winBeli_pb3",0,0,800,480);
winBeli_pb3.setText("Daftar Pembelian");
winBeli_pb3.button("park").hide();
winBeli_pb3.button("minmax1").hide();
winBeli_pb3.center();
winBeli_pb3.button("close").attachEvent("onClick", function() {
	winBeli_pb3.hide();
});

tb_winBeli_pb3 = winBeli_pb3.attachToolbar();
tb_winBeli_pb3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_winBeli_pb3.setSkin("dhx_terrace");
tb_winBeli_pb3.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_winBeli_pb3.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_winBeli_pb3.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			pilihBeli_pb3();
	} else if(id=='tutup') {
			winBeli_pb3.hide();
	}
});

gd_Beli_pb3 = new dhtmlXGridObject('tmpGrid_beli_pb3');
gd_Beli_pb3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_Beli_pb3.setHeader("&nbsp;,No.Transaksi,Tanggal,#Kode,Supplier,No.PO,Jml Beli,Total,DP,pajak",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_Beli_pb3.setInitWidths("30,110,80,65,120,80,70,100,80,0");
gd_Beli_pb3.setColAlign("right,left,left,left,left,left,left,right,right,right,right");
gd_Beli_pb3.setColSorting("na,str,str,str,str,str,str,str,str,str");
gd_Beli_pb3.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ron,ron,ron,ro,ro");
gd_Beli_pb3.setNumberFormat("0,000.00",6,",",".");
gd_Beli_pb3.setNumberFormat("0,000.00",7,",",".");
gd_Beli_pb3.setNumberFormat("0,000.00",8,",",".");
gd_Beli_pb3.enableSmartRendering(true,50);
gd_Beli_pb3.attachEvent("onRowDblClicked", function(rId,cInd){
	pilihBeli_pb3();
});
gd_Beli_pb3.setColumnColor("#CCE2FE");
gd_Beli_pb3.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;");
gd_Beli_pb3.setSkin("dhx_skyblue");
gd_Beli_pb3.splitAt(1);
gd_Beli_pb3.init();
winBeli_pb3.hide();

function showWinBeli_pb3() {
	if(document.frm_pb3.gudang.value=="") {
		alert("Gudang Tidak Boleh Kosong");
		document.frm_pb3.gudang.focus();
		return;
	}
	//loadDaftarTunda_pj1();
	winBeli_pb3.bringToTop();
	winBeli_pb3.show();
	winBeli_pb3.setModal(true);
	winBeli_pb3.attachObject('tmpWinBeli_pb3');
}

function cariDataPesanan_pb3() {
	gudang = document.frm_pb3.gudang.value;
	slcField = document.frmBeli_pb3.slcField.value;
	if(document.frmBeli_pb3.txtKunci.value != "") {
		txtKunci = document.frmBeli_pb3.txtKunci.value;
	} else {
		txtKunci = 0;
	}
	tglAwal = document.frmBeli_pb3.tglBeli1_pb3.value;
	tglAkhir = document.frmBeli_pb3.tglBeli2_pb3.value;
	gd_Beli_pb3.clearAll();
	statusLoading();
	gd_Beli_pb3.loadXML(base_url+"index.php/retur_pembelian/loadDataBeli/"+gudang+"/"+slcField+"/"+txtKunci+"/"+tglAwal+"/"+tglAkhir,function() {
		statusEnding();
	});
}

function pilihBeli_pb3() {
	//baru_pb3();
	gd_win_brg.clearAll();
	document.frm_pb3.no_lpb.value = gd_Beli_pb3.cells(gd_Beli_pb3.getSelectedId(),1).getValue();
	document.frm_pb3.supplier.value = gd_Beli_pb3.cells(gd_Beli_pb3.getSelectedId(),3).getValue();
	document.frm_pb3.pajak.value = gd_Beli_pb3.cells(gd_Beli_pb3.getSelectedId(),9).getValue();
	document.getElementById("tmpSupplier_pb3").innerHTML = gd_Beli_pb3.cells(gd_Beli_pb3.getSelectedId(),4).getValue();
	dp = gd_Beli_pb3.cells(gd_Beli_pb3.getSelectedId(),8).getValue();
	$('#tunai').val(dp);
	winBeli_pb3.hide();
	gdInp.clearAll();
	gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','','','0','',img_del],0);
	gdInp.selectRow(0);
}

function hitungDiscpBarcode_pb3(disc) {
	if(disc != "" && disc != "0") {
		document.frm_pb3.discr_barcode.disabled = true; 
		document.frm_pb3.discr_barcode.value = "";
	} else {
		document.frm_pb3.discr_barcode.disabled = false; 	
	}
}

function hitungDiscrBarcode_pb3(disc) {
	if(disc != "" && disc != "0") {
		document.frm_pb3.discpBarcode.disabled = true; 
		document.frm_pb3.discpBarcode.value = "";
	} else {
		document.frm_pb3.discpBarcode.disabled = false; 	
	}
}
</script>

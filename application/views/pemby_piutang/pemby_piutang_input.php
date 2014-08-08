<div class="frmContainer">
<form name="frm_pj2" id="frm_pj2" method="post" action="javascript:void(0);">
  <table width="918" border="0" align="center" style="padding-top:10px;">    
    <tr>
      <td width="104">No. Transaksi</td>
      <td width="287"><input type="text" name="txtNoTrans" id="txtNoTrans" value="<?php if(isset($txtNoTrans)): echo $txtNoTrans; endif;?>" disabled="disabled" placeholder="[AUTO]" ><input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
      <td width="98">Cara Bayar</td>
      <td colspan="2"><select name="slcMetodePembayaran" id="slcMetodePembayaran" onchange="if(this.value == '1') { document.frm_pj2.txtNomor.disabled = true; } else { document.frm_pj2.txtNomor.disabled = false; }">
      	<?php echo $pilihCaraBayar; ?>
        </select></td>
    </tr> 
    <tr>
      <td>Pelanggan</td>
      <td><select name="slcPelanggan" id="slcPelanggan" style="width:150px;" onchange="pelanggan();">
      <?php echo $pilihPelanggan; ?>
      </select>      </td>
      <td>Nomor</td>
      <td colspan="2"><input type="text" name="txtNomor" id="txtNomor" disabled="disabled" value="<?php if(isset($txtNomor)): echo $txtNomor; endif;?>" /></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="txttgl" type="text" id="txttgl" size="16" value="<?php if(isset($txttgl)): echo $txttgl; endif;?>" readonly="readonly"> 
      <span><img id="txttgl_pj2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Kode Akun</td>
      <td width="107"><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
        <img name="btnakun_pj2" id="btnakun_pj2" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pj2();" /></td>
      <td width="300"><span style="color:#FF0000;" id="tmpNmPerkiraan_pj2">
        <?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?>
      </span></td>
    </tr> 
    <tr>
      <td colspan="5"><div id="tmpGridBrg_pj2" style="height:250px; width:100%;"></div></td>
      </tr>
    <tr>
      <td>Keterangan</td>
      <td rowspan="2"><textarea name="txtKet" id="txtKet" cols="45" rows="2"><?php if(isset($txtKet)): echo $txtKet; endif;?></textarea></td>
      <td>&nbsp;</td>
      <td colspan="2" align="right">Total Bayar : 
        <input type="text" name="txtTotalByr" id="txtTotalByr" value="<?php if(isset($txtTotalByr)): echo $txtTotalByr; endif;?>" style="text-align:right;" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" align="right" style="display:none;">Lunas :
        <input type="checkbox" name="cbLunas" id="cbLunas" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
$(function() {         
	$('#txtTotalByr').number(true, 2);
});
// Call Tgl PKP
cal1_pg2 = new dhtmlXCalendarObject({
		input: "txttgl",button: "txttgl_pj2"
});
cal1_pg2.setDateFormat("%d/%m/%Y");

	function baru_pj2(){
		document.frm_pj2.id.value = "";
		document.frm_pj2.txtNoTrans.value = "";
		document.frm_pj2.slcMetodePembayaran.value = "";
		document.frm_pj2.slcPelanggan.value = "";
		document.frm_pj2.txtNomor.value = "";
		document.frm_pj2.txttgl.value = "";
		document.frm_pj2.txtTotalByr.value = "";
		document.frm_pj2.txtKet.value = "";
		document.frm_pj2.kdakun.value = "";
		document.getElementById("tmpNmPerkiraan_pj2").innerHTML = "";
		gdBrg_pj2.clearAll();
	}

gdBrg_pj2 = new dhtmlXGridObject('tmpGridBrg_pj2');
gdBrg_pj2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdBrg_pj2.setHeader("No.Transaksi,Tanggal,Tanggal JT,Sisa,Potongan,Total,Jumlah Bayar",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdBrg_pj2.setInitWidths("120,100,100,100,100,120,120");
gdBrg_pj2.setColAlign("left,left,left,right,right,right,right");
gdBrg_pj2.setColSorting("str,str,str,str,str,str,str");
gdBrg_pj2.setColTypes("ro,ro,ro,ron,edn,ron,edn");
gdBrg_pj2.setNumberFormat("0,000",3,",",".");
gdBrg_pj2.setNumberFormat("0,000",4,",",".");
gdBrg_pj2.setNumberFormat("0,000",5,",",".");
gdBrg_pj2.setNumberFormat("0,000",6,",",".");
gdBrg_pj2.attachEvent("onEditCell", doOnCellEdit);
gdBrg_pj2.setSkin("dhx_skyblue");
gdBrg_pj2.init();

	function doOnCellEdit(stage, rowId, cellInd){
		if(stage == 2){
			//hitung row
			var total = parseInt(gdBrg_pj2.cells(gdBrg_pj2.getSelectedId(), 3).getValue()) - parseInt(gdBrg_pj2.cells(gdBrg_pj2.getSelectedId(), 4).getValue());
			gdBrg_pj2.cells(gdBrg_pj2.getSelectedId(), 5).setValue(total);			
			
			//sub total
			total_bayar = 0;
			var arr = gdBrg_pj2.getAllItemIds().split(',');
			for (var i = 0; i < arr.length; i++) {
				id = arr[i];
				if(gdBrg_pj2.cells(id, 6).getValue()==""){
					total = 0;
				} else {
					total = gdBrg_pj2.cells(id, 6).getValue();
				}
				total_bayar = parseFloat(total_bayar) + parseFloat(total);
			}
			$('#txtTotalByr').val(total_bayar);
		}
		return true;
	}

	function pelanggan(){
		if(document.frm_pj2.slcPelanggan.value==""){
			var plg = 0;
		} else {
			var plg = document.frm_pj2.slcPelanggan.value;
		}
		gdBrg_pj2.clearAll();
		gdBrg_pj2.loadXML(base_url+"index.php/pemby_piutang/loadChild/"+plg);		
	}
	
	function simpan_pj2(){
		if(document.frm_pj2.slcPelanggan.value == ""){
			alert("Supplier Tidak Boleh Kosong !");
			document.frm_pj2.slcPelanggan.focus();
			return;
		}
		
		if(document.frm_pj2.txttgl.value == ""){
			alert("Tanggal Tidak Boleh Kosong !");
			document.frm_pj2.txttgl.focus();
			return;
		}
		
		if(document.frm_pj2.slcMetodePembayaran.value == ""){
			alert("Cara Bayar Tidak Boleh Kosong !");
			document.frm_pj2.slcMetodePembayaran.focus();
			return;
		}
		
		if(document.frm_pj2.txtTotalByr.value == 0){
			alert("Total Bayar Tidak Boleh Kosong !");
			document.frm_pj2.txtTotalByr.focus();
			return;
		}
		
		var dataBeli = gridBeli();
		
		var totalBayar = $('#txtTotalByr').val();
		var postpj2 = 
			'id=' + document.frm_pj2.id.value +
			'&no_bayar=' + document.frm_pj2.txtNoTrans.value +
			'&pelanggan=' + document.frm_pj2.slcPelanggan.value +
			'&tgl=' + document.frm_pj2.txttgl.value +
			'&caraBayar=' + document.frm_pj2.slcMetodePembayaran.value +
			'&no=' + document.frm_pj2.txtNomor.value +
			'&total=' + totalBayar +
			'&dataBayar=' + getData(gdBrg_pj2,0) +
			'&kdakun=' + document.frm_pj2.kdakun.value + 
			'&dataBeli=' + dataBeli;
		statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemby_piutang/simpan", encodeURI(postpj2), function(loader) {
			result = loader.xmlDoc.responseText;
			arrResult = result.split("|");
			if(arrResult[0] == 1) {
				document.frm_pj2.txtNoTrans.value = arrResult[1];
				statusEnding();
				refreshGd_pj2();
				tb_w1_pj2.disableItem("save");
				tb_w1_pj2.disableItem("batal");
				tb_w1_pj2.enableItem("baru");
			} else {
				statusEnding();
				alert(result);
			}
		});			
	}
	
	function gridBeli(){
		var beli = getData(gdBrg_pj2,[1,2,3,4,5]);
		return beli;
	}
	
	<?php if(isset($txtNoTrans)){ ?> 
		loadChild();
	<?php } ?>
	
	function loadChild(){
		gdBrg_pj2.clearAll();
		gdBrg_pj2.loadXML(base_url+"index.php/pemby_piutang/loadChild2/"+document.frm_pj2.txtNoTrans.value);
	}
	
	function winAkun_pj2() {
		try {
			if(w2_pj2.isHidden()==true) {
				w2_pj2.show();
				document.getElementById('frmSearchAkun_pj2').focus();
			}
			w2_pj2.bringToTop();
			return;
		} catch(e) {}
		w2_pj2 = dhxWins.createWindow("w2_pj2",0,0,430,450);
		w2_pj2.setText("Daftar Perkiraan");
		w2_pj2.button("park").hide();
		w2_pj2.button("minmax1").hide();
		w2_pj2.center();
		
		tb_w2_pj2 = w2_pj2.attachToolbar();
		tb_w2_pj2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pj2.setSkin("dhx_terrace");
		tb_w2_pj2.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pj2.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahAkun_pj2(13);
			}
		});
		
		w2_pj2.attachURL(base_url+"index.php/pemby_piutang/frm_search_akun", true);
}
</script>

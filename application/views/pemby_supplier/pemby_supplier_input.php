<div class="frmContainer">
<form name="frm_pb2" id="frm_pb2" method="post" action="javascript:void(0);">
  <table width="918" border="0" align="center" style="padding-top:10px;">    
    <tr>
      <td width="104">No. Transaksi</td>
      <td width="287"><input type="text" name="txtNoTrans" id="txtNoTrans" value="<?php if(isset($txtNoTrans)): echo $txtNoTrans; endif;?>" disabled="disabled" placeholder="[AUTO]" ><input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
      <td width="98">Cara Bayar</td>
      <td colspan="2"><select name="slcMetodePembayaran" id="slcMetodePembayaran" onchange="if(this.value == '1') { document.frm_pb2.txtNomor.disabled = true; } else { document.frm_pb2.txtNomor.disabled = false; }">
      	<?php echo $pilihCaraBayar; ?>
        </select></td>
    </tr> 
    <tr>
      <td>Supplier</td>
      <td><select name="slcSupplier" id="slcSupplier" style="width:150px;" onchange="Supplier();">
      <?php echo $pilihSupplier; ?>
      </select>      </td>
      <td>Nomor</td>
      <td colspan="2"><input type="text" name="txtNomor" id="txtNomor" disabled="disabled" value="<?php if(isset($txtNomor)): echo $txtNomor; endif;?>" /></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input name="txttgl" type="text" id="txttgl" size="16" value="<?php if(isset($txttgl)): echo $txttgl; endif;?>" readonly="readonly"> 
      <span><img id="txttgl_pb2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      <td>Kode Akun</td>
      <td width="107"><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
        <img name="btnakun_pb2" id="btnakun_pb2" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pb2();" /></td>
      <td width="300"><span style="color:#FF0000;" id="tmpNmPerkiraan_pb2">
        <?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?>
      </span></td>
    </tr> 
    <tr>
      <td colspan="5"><div id="tmpGridBrg_pb2" style="height:250px; width:100%;"></div></td>
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
		input: "txttgl",button: "txttgl_pb2"
});
cal1_pg2.setDateFormat("%d/%m/%Y");

	function baru_pb2(){
		document.frm_pb2.id.value = "";
		document.frm_pb2.txtNoTrans.value = "";
		document.frm_pb2.slcMetodePembayaran.value = "";
		document.frm_pb2.slcSupplier.value = "";
		document.frm_pb2.txtNomor.value = "";
		document.frm_pb2.txttgl.value = "";
		document.frm_pb2.txtTotalByr.value = "";
		document.frm_pb2.txtKet.value = "";
		document.frm_pb2.kdakun.value = "";
		document.getElementById("tmpNmPerkiraan_pb2").innerHTML = "";
		gdBrg_pb2.clearAll();
	}

gdBrg_pb2 = new dhtmlXGridObject('tmpGridBrg_pb2');
gdBrg_pb2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdBrg_pb2.setHeader("No.Transaksi,Tanggal,Tanggal JT,Sisa,Potongan,Total,Jumlah Bayar",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdBrg_pb2.setInitWidths("100,100,100,100,100,120,120");
gdBrg_pb2.setColAlign("left,left,left,right,right,right,right");
gdBrg_pb2.setColSorting("str,str,str,str,str,str,str");
gdBrg_pb2.setColTypes("ro,ro,ro,ron,edn,ron,edn");
gdBrg_pb2.setNumberFormat("0,000",3,",",".");
gdBrg_pb2.setNumberFormat("0,000",4,",",".");
gdBrg_pb2.setNumberFormat("0,000",5,",",".");
gdBrg_pb2.setNumberFormat("0,000",6,",",".");
gdBrg_pb2.attachEvent("onEditCell", doOnCellEdit);
gdBrg_pb2.setSkin("dhx_skyblue");
gdBrg_pb2.init();

	function doOnCellEdit(stage, rowId, cellInd){
		if(stage == 2){
			//hitung row
			var total = parseInt(gdBrg_pb2.cells(gdBrg_pb2.getSelectedId(), 3).getValue()) - parseInt(gdBrg_pb2.cells(gdBrg_pb2.getSelectedId(), 4).getValue());
			gdBrg_pb2.cells(gdBrg_pb2.getSelectedId(), 5).setValue(total);			
			
			//sub total
			total_bayar = 0;
			var arr = gdBrg_pb2.getAllItemIds().split(',');
			for (var i = 0; i < arr.length; i++) {
				id = arr[i];
				if(gdBrg_pb2.cells(id, 6).getValue()==""){
					total = 0;
				} else {
					total = gdBrg_pb2.cells(id, 6).getValue();
				}
				total_bayar = parseFloat(total_bayar) + parseFloat(total);
			}
			$('#txtTotalByr').val(total_bayar);
		}
		return true;
	}

	function Supplier(){
		if(document.frm_pb2.slcSupplier.value==""){
			var suppl = 0;
		} else {
			var suppl = document.frm_pb2.slcSupplier.value;
		}
		gdBrg_pb2.clearAll();
		gdBrg_pb2.loadXML(base_url+"index.php/pemby_supplier/loadChild/"+suppl);		
	}
	
	function simpan_pb2(){
		if(document.frm_pb2.slcSupplier.value == ""){
			alert("Supplier Tidak Boleh Kosong !");
			document.frm_pb2.slcSupplier.focus();
			return;
		}
		
		if(document.frm_pb2.txttgl.value == ""){
			alert("Tanggal Tidak Boleh Kosong !");
			document.frm_pb2.txttgl.focus();
			return;
		}
		
		if(document.frm_pb2.slcMetodePembayaran.value == ""){
			alert("Cara Bayar Tidak Boleh Kosong !");
			document.frm_pb2.slcMetodePembayaran.focus();
			return;
		}
		
		if(document.frm_pb2.txtTotalByr.value == 0){
			alert("Total Bayar Tidak Boleh Kosong !");
			document.frm_pb2.txtTotalByr.focus();
			return;
		}
		
		var dataBeli = gridBeli();
		
		var totalBayar = $('#txtTotalByr').val();
		var postPb2 = 
			'id=' + document.frm_pb2.id.value +
			'&no_bayar=' + document.frm_pb2.txtNoTrans.value +
			'&supplier=' + document.frm_pb2.slcSupplier.value +
			'&tgl=' + document.frm_pb2.txttgl.value +
			'&caraBayar=' + document.frm_pb2.slcMetodePembayaran.value +
			'&no=' + document.frm_pb2.txtNomor.value +
			'&total=' + totalBayar +
			'&dataBayar=' + getData(gdBrg_pb2,0) +
			'&kdakun=' + document.frm_pb2.kdakun.value + 
			'&dataBeli=' + dataBeli;
		statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemby_supplier/simpan", encodeURI(postPb2), function(loader) {
			result = loader.xmlDoc.responseText;
			arrResult = result.split("|");
			if(arrResult[0] == 1) {
				document.frm_pb2.txtNoTrans.value = arrResult[1];
				statusEnding();
				refreshGd_pb2();
				tb_w1_pb2.disableItem("save");
				tb_w1_pb2.disableItem("batal");
				tb_w1_pb2.enableItem("baru");
			} else {
				statusEnding();
				alert(result);
			}
		});			
	}
	
	function gridBeli(){
		var beli = getData(gdBrg_pb2,[1,2,3,4,5]);
		return beli;
	}
	
	<?php if(isset($txtNoTrans)){ ?> 
		loadChild();
	<?php } ?>
	
	function loadChild(){
		gdBrg_pb2.clearAll();
		gdBrg_pb2.loadXML(base_url+"index.php/pemby_supplier/loadChild2/"+document.frm_pb2.txtNoTrans.value);
	}
	
	function winAkun_pb2() {
		try {
			if(w2_pb2.isHidden()==true) {
				w2_pb2.show();
				document.getElementById('frmSearchAkun_pb2').focus();
			}
			w2_pb2.bringToTop();
			return;
		} catch(e) {}
		w2_pb2 = dhxWins.createWindow("w2_pb2",0,0,430,450);
		w2_pb2.setText("Daftar Perkiraan");
		w2_pb2.button("park").hide();
		w2_pb2.button("minmax1").hide();
		w2_pb2.center();
		
		tb_w2_pb2 = w2_pb2.attachToolbar();
		tb_w2_pb2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pb2.setSkin("dhx_terrace");
		tb_w2_pb2.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pb2.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahAkun_pb2(13);
			}
		});
		
		w2_pb2.attachURL(base_url+"index.php/pemby_supplier/frm_search_akun", true);
}
</script>

<div class="frmContainer">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchBeli" id="frmSearchBeli" onkeydown="cariBarang(event.key);">
    <input type="hidden" name="kode_brg" id="kode_brg" value="<?php if(isset($kode_brg)): echo $kode_brg; endif;?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gridBarang_pb3" style="width:405px; height:345px;"/></td>
  </tr>
</table>

<script language="javascript">

	gd_w4_pb3 = new dhtmlXGridObject('gridBarang_pb3');
	gd_w4_pb3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gd_w4_pb3.setHeader("Kode Item,Nama Barang,Satuan,Jml Beli,Jml Terima,Harga,Pot,Pajak,Total",null,
	["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gd_w4_pb3.setInitWidths("80,180,70,90,90,100,100,70,100");
	gd_w4_pb3.setColAlign("left,left,left,right,right,right,right,right,right");
	gd_w4_pb3.setColTypes("ed,ro,ro,edn,edn,ron,edn,edn,ron");
	gd_w4_pb3.setSkin("dhx_skyblue");
	gd_w4_pb3.setNumberFormat("0,000",3,",",".");
	gd_w4_pb3.setNumberFormat("0,000",4,",",".");
	gd_w4_pb3.setNumberFormat("0,000",5,",",".");
	gd_w4_pb3.setNumberFormat("0,000",6,",",".");
	gd_w4_pb3.setNumberFormat("0,000",7,",",".");
	gd_w4_pb3.setNumberFormat("0,000",8,",",".");
	gd_w4_pb3.init();

function tandaPanahBarang(key) {
	if(key==13) {
		var idBrg = gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),0).getValue();
		gdInp.cells(gdInp.getSelectedId(),0).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),0).getValue());
		gdInp.cells(gdInp.getSelectedId(),2).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),1).getValue());
		gdInp.cells(gdInp.getSelectedId(),3).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),2).getValue());
		gdInp.cells(gdInp.getSelectedId(),4).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),3).getValue());
		gdInp.cells(gdInp.getSelectedId(),5).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),4).getValue());
		gdInp.cells(gdInp.getSelectedId(),6).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),5).getValue());
		gdInp.cells(gdInp.getSelectedId(),7).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),6).getValue());
		gdInp.cells(gdInp.getSelectedId(),8).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),7).getValue());
		gdInp.cells(gdInp.getSelectedId(),9).setValue(gd_w4_pb3.cells(gd_w4_pb3.getSelectedId(),8).getValue());
		w3_pb3.close();
		
		//Pengecekan Data
		var cekBrg = cariData(idBrg);
		if(cekBrg=='1'){
			alert("Maaf kode data sudah diinput!");
			gdInp.cells(gdInp.getSelectedId(),0).setValue("");
			gdInp.cells(gdInp.getSelectedId(),2).setValue("");
			gdInp.cells(gdInp.getSelectedId(),3).setValue("");
			gdInp.cells(gdInp.getSelectedId(),4).setValue("");
			gdInp.cells(gdInp.getSelectedId(),5).setValue("");
			gdInp.cells(gdInp.getSelectedId(),6).setValue("");
			gdInp.cells(gdInp.getSelectedId(),7).setValue("");
			gdInp.cells(gdInp.getSelectedId(),8).setValue("");
			return true;
		} else {
			subtotal_pj1();
			addRowInp_pb3();
		}
	}
	if(key==38) {
		pilihGridKeAtas(gd_w4_pb3,'frmSearchBarang');
	}
	if(key==40) {
		pilihGridKeBawah(gd_w4_pb3,'frmSearchBarang');
	}
	return;
}

	<?php if(isset($kode_brg)){ ?> 
		loadBarang();
	<?php } ?>
function loadBarang(){
	//gd_w4_pb3.clearAll();
	gd_w4_pb3.loadXML(base_url+"index.php/retur_pembelian/loadDataBarang/"+document.getElementById('kode_brg').value);
}

function cariBarang(key){
	if(key==13){
		gd_w4_pb3.clearAll();
		gd_w4_pb3.loadXML(base_url+"index.php/retur_pembelian/loadDataBarang/"+document.getElementById('frmSearchBeli').value);
	}
}
</script>
</div>

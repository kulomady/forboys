<div class="frmContainer">
<form name="frm_md31" id="frm_md31" method="post" action="javascript:void(0);">
  <table width="412" border="0" align="center">
    <tr>
      <td width="96">Kode Size</td>
      <td width="206">
      	<input name="kdSize" type="text" id="kdSize" onblur="cekKode();" value="<?php if(isset($kdSize)): echo $kdSize; endif; ?>" size="5">
        <input name="id" type="hidden" id="id" value="<?php if(isset($id)): echo $id; endif; ?>" size="5">
      </td>
    </tr>
    <tr>
      <td>Nama Size</td>
      <td><input name="nmSize" type="text" id="nmSize" value="<?php if(isset($nmSize)): echo $nmSize; endif; ?>" size="28" /></td>
    </tr>
    <tr>
      <td colspan="2"><div id="tmpGridBrg_md31" style="height:150px; width:100%;"></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
	img_link_md31 = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="openWinSize_md31(0);" />';
	img_del_md31 = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/dis_delete.png" border="0" style="cursor:pointer;" onclick="delRow_md31(0);" />';
	
	function cekKode(){
		if(document.frm_md31.id.value==""){
			if(document.frm_md31.kdSize.value!=""){
				var postKode =
					'kdSize='+ document.frm_md31.kdSize.value;
				dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_sizerun/cekKode", encodeURI(postKode), function(loader) {
					result = loader.xmlDoc.responseText;
					if(result==1){
						alert("Maaf Kode Size Run sudah digunakan !");
						document.frm_md31.kdSize.focus();
						return;
					}
				});
			}
		}
	}
	
	gdBrg_md31 = new dhtmlXGridObject('tmpGridBrg_md31');
	gdBrg_md31.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gdBrg_md31.setHeader("Nama Size,#cspan,Kode,Qty,&nbsp;",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);
	gdBrg_md31.setInitWidths("100,30,0,100,50");
	gdBrg_md31.setColAlign("center,center,center,center,center");
	gdBrg_md31.setColSorting("str,str,str,str,str");
	gdBrg_md31.attachEvent("onEnter", doOnEnter);
	gdBrg_md31.setColTypes("edn,ro,ro,edn,ro");
	gdBrg_md31.setSkin("dhx_skyblue");
	gdBrg_md31.init();
	WinTambahBarang_md31();
	
	function openWinSize_md31(nmSize) {
		try {
			if(w3_md31.isHidden()==true) {
				w3_md31.show();
				document.getElementById('frmSearchBrg').focus();
			}
			w3_md31.bringToTop();
			return;
		} catch(e) {}
		w3_md31 = dhxWins.createWindow("w3_md31",0,0,430,450);
		w3_md31.setText("Daftar Size");
		w3_md31.button("park").hide();
		w3_md31.button("minmax1").hide();
		w3_md31.center();
		
		tb_w3_md31 = w3_md31.attachToolbar();
		tb_w3_md31.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w3_md31.setSkin("dhx_terrace");
		tb_w3_md31.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w3_md31.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahBarang(13);
			}
		});
		
		w3_md31.attachURL(base_url+"index.php/ref_sizerun/frm_search_size/"+nmSize, true);
	}
	
	function doOnEnter(id,cInd) {
		if(gdBrg_md31.cells(id,2).getValue()==""){
			var nmSize = gdBrg_md31.cells(id,0).getValue();
			var cekSize = cariData(nmSize);
			if(cekSize=='1'){
				alert("Maaf kode data sudah diinput!");
				return true;
			} else {
				var postCari = 
					'nmSize=' + nmSize;
				dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_sizerun/cariBarang", encodeURI(postCari), function(loader) {
					result = loader.xmlDoc.responseText;
					if(result==0){
						openWinSize_md31(nmSize);
					} else {
						arrResult = result.split("|");
						gdBrg_md31.cells(gdBrg_md31.getSelectedId(),0).setValue(arrResult[0]);
						gdBrg_md31.cells(gdBrg_md31.getSelectedId(),2).setValue(arrResult[1]);
						WinTambahBarang_md31();
					}
				});
			}
		}
	}
	
	//Pengecekan Data Pada Grid (not double)
	function cariData(idSize) {
		var idSize = idSize.toUpperCase();
		var ada = '0';
		var jml = 0;
		if(gdBrg_md31.getRowsNum() != '0') {
			var arr = gdBrg_md31.getAllItemIds().split(',');
			for(i=0;i < arr.length;i++) {
            	id = arr[i];
				var gdBrg = gdBrg_md31.cells(id,0).getValue().toUpperCase();
				if(gdBrg==idSize){
					jml = jml + 1;
					if(jml>1){
						ada = '1';
				    	break;
					}
				}
			}             
		}
		return ada;
	}
	
	function WinTambahBarang_md31() {
		var id = gdBrg_md31.uid(); 
		var posisi = gdBrg_md31.getRowsNum(); //gridPOS.uid(); 
		gdBrg_md31.addRow(id,['',img_link_md31,'','',img_del_md31],posisi);
		gdBrg_md31.selectRow(posisi)
		gdBrg_md31.showRow(id);
	}
	
	function delRow_md31(){
		var gdBrg = gdBrg_md31.cells(gdBrg_md31.getSelectedId(),0).getValue();
		if(gdBrg!=""){
			gdBrg_md31.deleteRow(gdBrg_md31.getSelectedId());
		}
	}
	
function simpan_md31() {
	if(document.frm_md31.kdSize.value==""){
		alert("Kode Size Run Tidak Boleh Kosong !");
		document.frm_md31.kdSize.focus();
		return;
	}
	
	if(document.frm_md31.nmSize.value==""){
		alert("Nama Size Run Tidak Boleh Kosong !");
		document.frm_md31.nmSize.focus();
		return;
	}
	
	if(gdBrg_md31.getRowsNum()==1){
		alert("Isi Size Run Tidak Boleh Kosong !");
		return;
	}
	
	//delete 1 baris paling bawah :)
	delgridChild();
	
 	var poststr =
			'id=' + document.frm_md31.id.value +
            '&kdSize=' + document.frm_md31.kdSize.value +
			'&nmSize=' + document.frm_md31.nmSize.value +
			'&dataSize=' + getData(gdBrg_md31,[0,1]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/ref_sizerun/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_md31();
			tb_w1_md31.disableItem("save");
			tb_w1_md31.disableItem("batal");
			tb_w1_md31.enableItem("baru");
		});
}

function delgridChild(){
	if(gdBrg_md31.getRowsNum() != '0') {
		var arr = gdBrg_md31.getAllItemIds().split(',');
		for(i=0;i < arr.length;i++) {
           	id = arr[i];
			var gdBrg = gdBrg_md31.cells(id,0).getValue();
			if(gdBrg==""){
				gdBrg_md31.deleteRow(id);
			}
		}             
	}
}

function baru_md31() {
	document.frm_md31.id.value = "";
	document.frm_md31.kdSize.value = "";
	document.frm_md31.nmSize.value = "";
	gdBrg_md31.clearAll();
}

document.frm_md31.kdSize.focus();

	<?php if(isset($id)){ ?> 
		loadChild();
	<?php } ?>
	
	function loadChild(){
		gdBrg_md31.clearAll();
		gdBrg_md31.loadXML(base_url+"index.php/ref_sizerun/loadChild/"+document.frm_md31.kdSize.value,function(){
			WinTambahBarang_md31();
		});
	}
</script>

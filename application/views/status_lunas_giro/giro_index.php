<div id="tmpTb_pb6" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<form id="frm_pb6" name="frm_pb6" method="post" action="javascript:void(0);" style=" background-color:#B8E0F5;">
 <fieldset> <table width="533">
    <tr>
      <td width="101">Pembayaran</td>
      <td width="222"><select name="pembayaran" id="pembayaran" onchange="loadrekanbisnis(this.value);">
        <option value="HUTANG">HUTANG</option>
        <option value="PIUTANG">PIUTANG</option>
      </select></td>
      <td width="194">&nbsp;</td>
    </tr>
    <tr>
      <td id="tmpTxtBP">Supplier</td>
      <td><select name="idrekan" id="idrekan" style="width:145px;" onchange="gd_pb6.clearAll();"></select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Nomor</td>
      <td><input type="text" name="nobg" id="nobg" />
      <input type="button" name="button" id="button" value="CARI" onclick="loadGd_pb6();" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </fieldset>
</form>
<div id="tmpGrid_pb6" style="height:72%;width: 100%"></div>

<script language="javascript">
tb_pb6 = new dhtmlXToolbarObject("tmpTb_pb6");
tb_pb6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pb6.setSkin("dhx_terrace");
tb_pb6.attachEvent("onclick", tbClick_pb6);
tb_pb6.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
tb_pb6.addButton("cetak", 2, "CETAK", "print.gif", "print_dis.gif");

function tbClick_pb6(id) {
	if(id=='save') {
		simpan_pb6();
	} else if(id=='cetak') {
	
	}
}

gd_pb6 = new dhtmlXGridObject('tmpGrid_pb6');
gd_pb6.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pb6.setHeader("&nbsp;,No.Transaksi,Tanggal,Nama Pelanggan,Jumlah Bayar,No Cek/BG,Status Lunas,Tgl Lunas",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pb6.setInitWidths("30,120,100,150,110,150,100,150");
gd_pb6.setColAlign("right,left,left,left,right,left,center,left");
gd_pb6.setColSorting("na,int,str,str,int,str,str,str");
gd_pb6.setColTypes("cntr,ro,ro,ro,ron,ro,ch,dhxCalendar");
gd_pb6.enableSmartRendering(true,50);
gd_pb6.setNumberFormat("0,000.00",4,",",".");
gd_pb6.setColumnColor("#CCE2FE");
gd_pb6.setSkin("dhx_skyblue");
gd_pb6.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,<div style=text-align:right>{#stat_total}</div>,&nbsp;,#cspan,#cspan");
gd_pb6.init();
//loadGd_pb6();

function loadGd_pb6() {
	if(document.frm_pb6.pembayaran.value == "HUTANG" && document.frm_pb6.idrekan.value == "") {
		alert("Supplier tidak boleh kosong");
		document.frm_pb6.idrekan.focus();
		return;
	}
	if(document.frm_pb6.pembayaran.value == "PIUTANG" && document.frm_pb6.idrekan.value == "") {
		alert("Pelanggan tidak boleh kosong");
		document.frm_pb6.idrekan.focus();
		return;
	}
	if(document.frm_pb6.nobg.value == "") {
		nobg = "0";	
	} else {
		nobg = document.frm_pb6.nobg.value;
	}
	
	if(document.frm_pb6.pembayaran.value == "HUTANG") {
		url = "loadMainDataHutang";
	} 
	
	if(document.frm_pb6.pembayaran.value == "PIUTANG") {
		url = "loadMainDataPiutang";
	}
	
	gd_pb6.clearAll();
	statusLoading();
	gd_pb6.loadXML(base_url+"index.php/status_lunas_giro/"+url+"/"+document.frm_pb6.idrekan.value+"/"+nobg,function() {
		statusEnding();																													 
	});
}

function simpan_pb6() {
	var poststr = 
			'pembayaran=' + document.frm_pb6.pembayaran.value +
			'&data=' +  getData(gd_pb6,[0,2,3,4,5]);	
	statusLoading();
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/status_lunas_giro/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
	});
}

function loadrekanbisnis(type) {
	gd_pb6.clearAll();
	if(type=="HUTANG") {
		document.getElementById("tmpTxtBP").innerHTML = "Supplier";
		var postpj = 
			'id=' + "0";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/status_lunas_giro/dataSupplier", encodeURI(postpj), function(loader) {
			result = loader.xmlDoc.responseText;
			document.getElementById("idrekan").innerHTML = result;
		});
	} else {
		document.getElementById("tmpTxtBP").innerHTML = "Pelanggan";
		var postpj = 
			'id=' + "0";
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/status_lunas_giro/dataPelanggan", encodeURI(postpj), function(loader) {
			result = loader.xmlDoc.responseText;
			document.getElementById("idrekan").innerHTML = result;
		});
	}
		
}

loadrekanbisnis("HUTANG");
</script>

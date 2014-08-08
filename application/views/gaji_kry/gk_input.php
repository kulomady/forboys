<div class="frmContainer">
<form name="frm_ku2" id="frm_ku2" method="post" action="javascript:void(0);">
  <table width="1158" border="0" align="center">
    <tr>
      <td width="79">Periode</td>
      <td width="835"><select name="bln" id="bln" disabled="disabled">
        <?php echo $bln; ?>
        </select>
        <select name="thn" id="thn" disabled="disabled">
          <?php echo $thn; ?>
        </select></td>
    </tr>
    <tr>
      <td colspan="2"><div id="tmpGridInput_ku2" style="height:400px;width: 100%"></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>">      </td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">

gdInp_ku2 =  new dhtmlXGridObject('tmpGridInput_ku2');
gdInp_ku2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdInp_ku2.setHeader("&nbsp;,ID,Nama,Tgl Masuk,Masa Kerja (BLN),Gaji/Bln,Upah/Hari,Max Kasbon/Minggu,Jml Hari Tdk Hadir,Pot Absen,Late Charge,Kas Bon,Sisa Pinjaman,Cicilan Pinjaman,Gaji Yg Dibayar,Keterangan,outlet_id,user",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdInp_ku2.setInitWidths("30,0,120,70,70,80,65,90,80,65,65,65,65,80,80,100,0,0");
gdInp_ku2.setColAlign("right,left,left,center,right,right,right,right,right,right,right,right,right,right,right,left,left,left");
gdInp_ku2.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
gdInp_ku2.setColTypes("cntr,ro,ro,ro,ro,ron,ron,ron,edn,ron,edn,edn,ron,edn,ron,ed,ed,ed");
//gd_ku2.enableSmartRendering(true,50);
gdInp_ku2.setColumnColor("#CCE2FE,,,,,#CCE2FE,#CCE2FE,#CCE2FE,,,,,,,#CCE2FE");
gdInp_ku2.setSkin("dhx_skyblue");
gdInp_ku2.setNumberFormat("0,000",5,",",".");
gdInp_ku2.setNumberFormat("0,000",6,",",".");
gdInp_ku2.setNumberFormat("0,000",7,",",".");
gdInp_ku2.setNumberFormat("0,000",8,",",".");
gdInp_ku2.setNumberFormat("0,000",9,",",".");
gdInp_ku2.setNumberFormat("0,000",10,",",".");
gdInp_ku2.setNumberFormat("0,000",11,",",".");
gdInp_ku2.setNumberFormat("0,000",12,",",".");
gdInp_ku2.setNumberFormat("0,000",13,",",".");
gdInp_ku2.setNumberFormat("0,000",14,",",".");
gdInp_ku2.attachEvent("onEditCell", doOnCellEdit_ku2);
gdInp_ku2.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,&nbsp;");
gdInp_ku2.splitAt(1);
gdInp_ku2.init();

loadDataInp_ku2();

<?php if(isset($periode)) { ?> 
		document.frm_ku2.bln.value = "<?php echo $setbln; ?>";
		document.frm_ku2.thn.value = "<?php echo $setthn; ?>";
		loadDataDetail_ku2('<?php echo $periode; ?>');
	<?php } else { ?>
		loadDataInp_ku2();
	<?php }?>

function loadDataInp_ku2() {
	gdInp_ku2.clearAll();
	statusLoading();
	gdInp_ku2.loadXML(base_url+"index.php/gaji_kry/loadDataGaji",function() {
		statusEnding();
	});
}

function loadDataDetail_ku2(periode) {
	gdInp_ku2.clearAll();
	statusLoading();
	gdInp_ku2.loadXML(base_url+"index.php/gaji_kry/loadDataDetail/"+periode,function() {
		statusEnding();
	});	
}

function doOnCellEdit_ku2(stage, rowId, cellInd){
	if(stage==2) {
		if(cellInd==8) {
			jmlHari = gdInp_ku2.cells(rowId,8).getValue();
			upahHari = gdInp_ku2.cells(rowId,6).getValue();
			potAbsen = jmlHari * upahHari;
			gdInp_ku2.cells(rowId,9).setValue(potAbsen);
				
		}
		if(gdInp_ku2.cells(rowId,5).getValue() == "") {
			gajiBln = 0;
		} else {
			gajiBln =  gdInp_ku2.cells(rowId,5).getValue();
		}
		if(gdInp_ku2.cells(rowId,9).getValue() == "") {
			potAbsen = 0;	
		} else {
			potAbsen = gdInp_ku2.cells(rowId,9).getValue();
		}
		if(gdInp_ku2.cells(rowId,10).getValue() == "") {
			lateCharge = 0;	
		} else {
			lateCharge = gdInp_ku2.cells(rowId,10).getValue();
		}
		if(gdInp_ku2.cells(rowId,11).getValue() == "") {
			kasbon = 0;	
		} else {
			kasbon = gdInp_ku2.cells(rowId,11).getValue();
		}
		if(gdInp_ku2.cells(rowId,13).getValue() == "") {
			cicilan = 0;	
		} else {
			cicilan = gdInp_ku2.cells(rowId,13).getValue();
		}
		
		thp = gajiBln - (parseInt(potAbsen) + parseInt(lateCharge) + parseInt(kasbon) + parseInt(cicilan));
		gdInp_ku2.cells(rowId,14).setValue(thp);
	}
	return true;
}
	
function simpan_ku2() {

 	var poststr =
            'bln=' + document.frm_ku2.bln.value +
			'&thn=' + document.frm_ku2.thn.value +
			'&data=' + getData(gdInp_ku2,[0,2,3,4,16]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/gaji_kry/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_ku2();
			tb_w1_ku2.disableItem("save");
			tb_w1_ku2.enableItem("baru");
		});
}

function baru_ku2() {
	document.frm_ku2.id.value = "";
	cbKry_ku2.setComboText("");
	document.frm_ku2.tglMasuk.value = "";
	document.frm_ku2.sisaPinjaman.value = "";
	document.frm_ku2.pinjaman.value = "";
	document.frm_ku2.totalPinjaman.value = "";
}

<?php if(isset($dataGaji) && $dataGaji != '0'): ?>
tb_w1_ku2.disableItem("save");
statusEnding();
alert("Gaji Periode Saat ini sudah dibuat");
<?php endif; ?>
//document.frm_ku2.kdbank.focus();
</script>

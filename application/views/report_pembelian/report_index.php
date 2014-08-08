<style>
	body{
		background-color: #B8E0F5;
	}
</style>
<body>
<div id="tmpTb_<?php echo $kode; ?>" style="background-color:#B8E0F5; height:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px">
<form id="frmReport_<?php echo $kode; ?>" name="frmReport_<?php echo $kode; ?>" method="post" action="javascript:void(0);" style="padding:5px;">
	<fieldset>
    <legend>Parameter</legend>
    <table width="704" border="0">
    	<tr>
            <td width="73">Periode</td>
            <td width="242"><input name="tgl1_<?php echo $kode; ?>" type="text" id="tgl1_<?php echo $kode; ?>" size="8" readonly value="<?php echo date("d/m/Y"); ?>" /><span>&nbsp;<img id="btnTgl1_<?php echo $kode; ?>" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
          <input name="tgl2_<?php echo $kode; ?>" type="text" id="tgl2_<?php echo $kode; ?>" size="8" readonly value="<?php echo date("d/m/Y"); ?>" /><span>&nbsp;<img id="btnTgl2_<?php echo $kode; ?>" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
		</tr>
        <tr>
        	<td>Supplier</td>
            <td><select name="supplier" id="supplier">
            	<?php echo $supplier; ?>
            </select></td>
        </tr>
        <tr>
        	<td>Gudang</td>
            <td><select name="gudang" id="gudang">
            	<?php echo $gudang; ?>
            </select></td>
        </tr>
        <tr>
        	<td>Jenis Laporan</td>
            <td><select name="jns" id="jns">
            	<option value="rekap">Rekap</option>
                <option value="detail">Detail</option>
            </select>
            <input name="kode" type="hidden" id="kode" size="8" value="<?php echo $kode; ?>" /></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td align="right"><input type="button" value="Preview" onClick="printToPDF_<?php echo $kode; ?>();">&nbsp;</td>
            <td align="left">&nbsp;<input type="button" value="To Excel" onClick="printToExcel_<?php echo $kode; ?>();"></td>
        </tr>
  	</table>
    </fieldset>
</form>   	
</div>
</body>
<script language="javascript">
var kode = '<?php echo $kode; ?>';

cal1_<?php echo $kode; ?> = new dhtmlXCalendarObject({
		input: "tgl1_<?php echo $kode; ?>",button: "btnTgl1_<?php echo $kode; ?>"
	});
cal1_<?php echo $kode; ?>.setDateFormat("%d/%m/%Y");

cal2_<?php echo $kode; ?> = new dhtmlXCalendarObject({
		input: "tgl2_<?php echo $kode; ?>",button: "btnTgl2_<?php echo $kode; ?>"
	});
cal2_<?php echo $kode; ?>.setDateFormat("%d/%m/%Y");

	function laporan_<?php echo $kode; ?>(){
		if(document.frmReport_<?php echo $kode; ?>.jns.value=='rekap'){
			if(document.frmReport_<?php echo $kode; ?>.kode.value=='rpb1'){
				var url = 'report_pembelian/pesanan_pembelian_rekap';
			} else if(document.frmReport_<?php echo $kode; ?>.kode.value=='rpb2'){
				var url = 'report_pembelian/pembelian_rekap';
			} else if(document.frmReport_<?php echo $kode; ?>.kode.value=='rpb3'){
				var url = 'report_pembelian/retur_pembelian_rekap';
			}
		} else if(document.frmReport_<?php echo $kode; ?>.jns.value=='detail'){
			if(document.frmReport_<?php echo $kode; ?>.kode.value=='rpb1'){
				var url = 'report_pembelian/pesanan_pembelian_detail';
			} else if(document.frmReport_<?php echo $kode; ?>.kode.value=='rpb2'){
				var url = 'report_pembelian/pembelian_detail';
			} else if(document.frmReport_<?php echo $kode; ?>.kode.value=='rpb3'){
				var url = 'report_pembelian/retur_pembelian_detail';
			}
		}
		return url;
	}
	
	function parameter_<?php echo $kode; ?>(){
		var tgl1 = document.frmReport_<?php echo $kode; ?>.tgl1_<?php echo $kode; ?>.value;
		pTgl1 = tgl1.split('/');
		tgl1 = pTgl1[2]+'-'+pTgl1[1]+'-'+pTgl1[0];
		
		var tgl2 = document.frmReport_<?php echo $kode; ?>.tgl2_<?php echo $kode; ?>.value;
		pTgl2 = tgl2.split('/');
		tgl2 = pTgl2[2]+'-'+pTgl2[1]+'-'+pTgl2[0];
		
		if(document.frmReport_<?php echo $kode; ?>.gudang.value == ""){
			var gudang = 0;
		} else {
			var gudang = document.frmReport_<?php echo $kode; ?>.gudang.value;
		}
		
		if(document.frmReport_<?php echo $kode; ?>.supplier.value == ""){
			var supplier = 0;
		} else {
			var supplier = document.frmReport_<?php echo $kode; ?>.supplier.value;
		}
		
		param = tgl1+'/'+tgl2+'/'+gudang+'/'+supplier;
		return param;
	}

	function printToPDF_<?php echo $kode; ?>(){
		var tgl1 = document.frmReport_<?php echo $kode; ?>.tgl1_<?php echo $kode; ?>.value;
		tgl1 = new Date(tgl1);
		var tglPertama = Date.parse(tgl1);
		
		var tgl2 = document.frmReport_<?php echo $kode; ?>.tgl2_<?php echo $kode; ?>.value;		
		tgl2 = new Date(tgl2);
		var tglKedua = Date.parse(tgl2);
		
		if(tglPertama > tglKedua){
			alert("Periode Salah!");
			return;
		}
		 
		var url = laporan_<?php echo $kode; ?>();
		var param = parameter_<?php echo $kode; ?>();
		window.open(base_url+"index.php/"+url+"/view/"+param,"_blank");
	}
	
	function printToExcel_<?php echo $kode; ?>(){
		var tgl1 = document.frmReport_<?php echo $kode; ?>.tgl1_<?php echo $kode; ?>.value;
		tgl1 = new Date(tgl1);
		var tglPertama = Date.parse(tgl1);
		
		var tgl2 = document.frmReport_<?php echo $kode; ?>.tgl2_<?php echo $kode; ?>.value;		
		tgl2 = new Date(tgl2);
		var tglKedua = Date.parse(tgl2);
		
		if(tglPertama > tglKedua){
			alert("Periode Salah!");
			return;
		}
		 
		var url = laporan_<?php echo $kode; ?>();
		var param = parameter_<?php echo $kode; ?>();
		window.open(base_url+"index.php/"+url+"/excel/"+param,"_blank");
	}
</script>
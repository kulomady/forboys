<div class="frmContain" style="background-color: #FFFFCC; font-family: Verdana, Arial, Helvetica, sans-serif; 
			font-size:11px;
			overflow:auto;">
<fieldset>
<form name="frm_cs2" id="frm_cs2">
	<table style="font-weight:bold;">
    	<tr>
        	<td>Periode</td>
            <td>:</td>
            <td><input type="text" name="awal" id="awal" size="10" />&nbsp;s/d&nbsp;<input type="text" name="akhir" id="akhir" size="10" /></td>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
            <td><input type="button" onclick="preview_cs2();" value="Preview" />&nbsp;
            <input type="button" onclick="excel_cs2();" value="Download Excel" /></td>
        </tr>
    </table>
</form>
</fieldset>
</div>
<div id="report" style="position: relative; width: 100%; height: 82%; padding-top:20px; border: #B5CDE4 1px solid;"></div>
<script language="javascript">
	cal1 = new dhtmlxCalendarObject('awal');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal2 = new dhtmlxCalendarObject('akhir');
	cal2.setDateFormat('%d/%m/%Y');
	
	dhxLayout3 = new dhtmlXLayoutObject("report", "1C");
	dhxLayout3.cells("a").hideHeader();
	
	function preview_cs2(){
		if(document.frm_cs2.awal.value == ""){
			alert("Tanggal Periode Tidak Boleh Kosong !");
			document.frm_cs2.awal.focus();
			return;
		}
		
		if(document.frm_cs2.akhir.value == ""){
			alert("Tanggal Periode Tidak Boleh Kosong !");
			document.frm_cs2.akhir.focus();
			return;
		}
		
		var awal = document.frm_cs2.awal.value.split('/');
		var awal1 = awal[2]+'-'+awal[1]+'-'+awal[0];
		
		var akhir = document.frm_cs2.akhir.value.split('/');
		var akhir1 = akhir[2]+'-'+akhir[1]+'-'+akhir[0];
		var param2 = awal1+'/'+akhir1;
		dhxLayout3.cells("a").attachURL("<?php echo site_url(); ?>/history_member/preview/view/"+param2);
	}
	
	function excel_cs2(){
		if(document.frm_cs2.awal.value == ""){
			alert("Tanggal Periode Tidak Boleh Kosong !");
			document.frm_cs2.awal.focus();
			return;
		}
		
		if(document.frm_cs2.akhir.value == ""){
			alert("Tanggal Periode Tidak Boleh Kosong !");
			document.frm_cs2.akhir.focus();
			return;
		}
		
		var param2 = document.frm_cs2.awal.value+'/'+document.frm_cs2.akhir.value;
		dhxLayout3.cells("a").attachURL("<?php echo site_url(); ?>/history_member/preview/excel/"+param2);
	}
</script>
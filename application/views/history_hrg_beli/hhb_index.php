<div class="frmContain" style="background-color: #FFFFCC; font-family: Verdana, Arial, Helvetica, sans-serif; 
			font-size:11px;
			overflow:auto;">
<fieldset>
<form name="frm_pb5" id="frm_pb5">
	<table style="font-weight:bold;">
    	<tr>
        	<td>Periode</td>
            <td>:</td>
            <td><input type="text" name="awal" id="awal" />&nbsp;s/d&nbsp;<input type="text" name="akhir" id="akhir" /></td>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
            <td><input type="button" onclick="preview();" value="Preview" />&nbsp;
            <input type="button" onclick="excel();" value="Download Excel" /></td>
        </tr>
    </table>
</form>
</fieldset>
</div>
<div id="report" style="position: relative; width: 100%; height: 100%; padding-top:20px; border: #B5CDE4 1px solid;"></div>
<script language="javascript">
	cal1 = new dhtmlxCalendarObject('awal');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal2 = new dhtmlxCalendarObject('akhir');
	cal2.setDateFormat('%d/%m/%Y');
	
	dhxLayout3 = new dhtmlXLayoutObject("report", "1C");
	dhxLayout3.cells("a").hideHeader();
	
	function preview(){
		var awal = document.frm_pb5.awal.value.split('/');
		var awal1 = awal[2]+'-'+awal[1]+'-'+awal[0];
		
		var akhir = document.frm_pb5.akhir.value.split('/');
		var akhir1 = akhir[2]+'-'+akhir[1]+'-'+akhir[0];
		var param2 = awal1+'/'+akhir1;
		dhxLayout3.cells("a").attachURL("<?php echo site_url(); ?>/history_hrg_beli/preview/view/"+param2);
	}
	
	function excel(){
		var param2 = document.frm_pb5.awal.value+'/'+document.frm_pb5.akhir.value;
		dhxLayout3.cells("a").attachURL("<?php echo site_url(); ?>/history_hrg_beli/preview/excel/"+param2);
	}
</script>
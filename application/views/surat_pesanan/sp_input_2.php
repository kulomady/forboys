<style>
	legend {
		font-weight:bold;
	}
</style>
<div class="frmContainer"><br>
<form name="frm_mk32" id="frm_mk32" method="post" action="javascript:void(0);">
   	<fieldset>
       	<legend>SECTION C: PERHITUNGAN "HARGA JUAL" UNIT PESANAN</legend>
    	<table style="padding-left:15px;">
        	<tr>
               	<td width="160">Harga Jual sebelum PPN</td>
            	<td width="250">Rp. <input type="text" size="25" name="harga_jual" id="harga_jual" style="text-align:right;" onblur="harga();" value="<?php if(isset($harga_jual)): echo $harga_jual; endif;?>"></td>
           		<td width="160">Harga Jual setelah PPN</td>
                <td>Rp. <input type="text" size="25" name="harga_jual2" id="harga_jual2" onfocus="digit();" style="text-align:right;" readonly="readonly" value="<?php if(isset($harga_jual2)): echo $harga_jual2; endif;?>"></td>
            </tr>
        </table>
 	</fieldset>
    <fieldset>
     	<legend>SECTION D: CARA PEMBAYARAN UNIT PESANAN</legend>
       	<table style="padding-left:15px;">
        	<tr>
              	<td width="220">1. Cara Pembayaran</td>
                <td><input type="radio" id="tunai" name="cara" value="tunai" <?php if(isset($cara)){ if($cara=='tunai'){ echo "checked"; } else { echo ""; }} ?>>&nbsp;Tunai&nbsp;
                    <input type="radio" id="cicilan_bertahap" name="cara" value="cicilan_bertahap" <?php if(isset($cara)){ if($cara=='cicilan_bertahap'){ echo "checked"; } else { echo ""; }} ?>>&nbsp;Cicilan Bertahap&nbsp;
                   <input type="radio" id="kpr_kpa" name="cara" value="kpr_kpa" <?php if(isset($cara)){ if($cara=='kpr_kpa'){ echo "checked"; } else { echo ""; }} ?>>&nbsp;KPR/KPA&nbsp;</td>
           	</tr>
            <tr>
                <td>2. Tanda Jadi (Booking Fee) </td>
                <td><input type="radio" id="ready" name="booking" value="10000000" onchange="check_lain_booking2();" <?php if(isset($booking)){ if($booking=='10000000'){ echo "checked"; } else { echo ""; } } ?>>&nbsp;Rp. 10.000.000,-&nbsp;
                    <input type="radio" id="lain_booking" name="booking" value="0" onchange="check_lain_booking();" <?php if(isset($booking)){ if($booking=='0'){ echo "checked"; } else { echo ""; } } ?>>&nbsp;Lainnya&nbsp;
                    <input type="text" size="30" id="txt_lain_booking" name="txt_lain_booking" value="<?php if(isset($txt_lain_booking)): echo $txt_lain_booking; endif;?>" disabled="disabled" style="text-align:right;" /></td>
            </tr>
            <tr>
            	<td rowspan="5" valign="top">3. Uang Muka Dicicil</td>
                <td><input type="radio" id="um24" name="uang_muka" value="24" onchange="check_umLain2();" <?php if(isset($uang_muka)){ if($uang_muka=='24'){ echo "checked"; } else { echo ""; } } ?>>&nbsp;24 X&nbsp;
                    <input type="radio" id="um36" name="uang_muka" value="36" onchange="check_umLain2();" <?php if(isset($uang_muka)){ if($uang_muka=='36'){ echo "checked"; } else { echo ""; } } ?>>&nbsp;36 X&nbsp;
                    <input type="radio" id="umLain" name="uang_muka" value="0" onchange="check_umLain();" <?php if(isset($uang_muka)){ if($uang_muka=='0'){ echo "checked"; } else { echo ""; } } ?>>&nbsp;Lainnya&nbsp;
                    <input type="text" size="5" id="txt_uang_muka" name="txt_uang_muka" disabled="disabled" value="<?php if(isset($txt_uang_muka)): echo $txt_uang_muka; endif;?>" style="text-align:right;" /> X<br></td>
           	</tr>
            <tr>
            	<td>Uang Muka ke-1 Tgl: <input type="text" name="tgl1" id="tgl1" readonly="readonly" size="8" value="<?php if(isset($tgl1)): echo $tgl1; endif;?>">&nbsp;<span><img id="btnTg1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>&nbsp;&nbsp; Rp. <input type="text" id="uang1" name="uang1" style="text-align:right;" value="<?php if(isset($uang1)): echo $uang1; endif;?>" ></td>
            </tr>
            <tr>
            	<td>Uang Muka ke-2 Tgl: <input type="text" name="tgl2" id="tgl2" readonly="readonly" size="8" value="<?php if(isset($tgl2)): echo $tgl2; endif;?>">&nbsp;<span><img id="btnTg2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>&nbsp;&nbsp; Rp. <input type="text" id="uang2" name="uang2" style="text-align:right;" value="<?php if(isset($uang2)): echo $uang2; endif;?>" ></td>
            </tr>
            <tr>
            	<td>Uang Muka ke-3 Tgl: <input type="text" name="tgl3" id="tgl3" readonly="readonly" size="8" value="<?php if(isset($tgl3)): echo $tgl3; endif;?>">&nbsp;<span><img id="btnTg3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>&nbsp;&nbsp; Rp. <input type="text" id="uang3" name="uang3" style="text-align:right;" value="<?php if(isset($uang3)): echo $uang3; endif;?>" ></td>
            </tr>
            <tr>
            	<td>Uang Muka ke-4 Tgl: <input type="text" name="tgl4" id="tgl4" readonly="readonly" size="8" value="<?php if(isset($tgl4)): echo $tgl4; endif;?>">&nbsp;<span><img id="btnTg4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>&nbsp;&nbsp; Rp. <input type="text" id="uang4" name="uang4" style="text-align:right;" value="<?php if(isset($uang4)): echo $uang4; endif;?>" > DST Sesuai jadwal terlampir</td>
            </tr>
            <tr>
            	<td colspan="2"><input type="checkbox" id="check_loan" name="check_loan" value="1" onchange="ch_loan();" <?php if(isset($check_loan)){ if($check_loan=='1'){ echo "checked"; } else { echo ""; } } ?> /> <b>Pinjaman (Lembaga Keuangan) / Loan :</b></td>
            </tr>
            <tr>
                <td colspan="2">Pelunasan/Pencairan &nbsp;&nbsp; <input type="text" id="lunas_cair" name="lunas_cair" disabled="disabled" style="text-align:right;" value="<?php if(isset($lunas_cair)): echo $lunas_cair; endif;?>" /> &nbsp;&nbsp;&nbsp;
                Nama Lembaga Keuangan &nbsp; <input type="text" id="nm_lembaga" name="nm_lembaga" disabled="disabled" value="<?php if(isset($nm_lembaga)): echo $nm_lembaga; endif;?>" /></td>
            </tr>
     	</table>
  	</fieldset>
    <fieldset>
    	<legend>SECTION E:</legend>
        <table>    
            <tr style="font-weight:bold;">
            	<td width="330">Promosi :</td><td>Tempat Penjualan (Point of Sales) :</td>
            </tr>
            <tr>
            	<td><input type="checkbox" id="koran" name="promosi" value="koran" /> Koran &nbsp;&nbsp;
                <input type="checkbox" id="billboard" name="promosi" value="billboard" /> Billboard &nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="undangan" name="promosi" value="undangan" /> Undangan<br />
                <input type="checkbox" id="majalah" name="promosi" value="majalah" /> Majalah 
                <input type="checkbox" id="tv_radio" name="promosi" value="tv_radio" /> TV / Radio &nbsp;
                <input type="checkbox" id="pager_grafis" name="promosi" value="pager_grafis" /> Pager Grafis<br />
                <input type="checkbox" id="lisan" name="promosi" value="lisan" /> Lisan &nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="lain" name="promosi" value="lain" onchange="check_promo_lain();" /> Lainnya &nbsp;&nbsp;
                <input type="text" id="lain_promosi" name="lain_promosi" disabled="disabled" value="<?php if(isset($lain_promosi)): echo $lain_promosi; endif;?>"/></td>
                
                <td><input type="checkbox" id="kantor_pusat" name="pos" value="kantor_pusat" /> Kantor Pusat &nbsp;&nbsp;
                <input type="checkbox" id="exhibition" name="pos" value="exhibition" onchange="check_exhibition();" /> Exhibition &nbsp;&nbsp;&nbsp;
                <input type="text" id="txt_exhibition" name="txt_exhibition" disabled="disabled" value="<?php if(isset($txt_exhibition)): echo $txt_exhibition; endif;?>"/><br />
                <input type="checkbox" id="sales" name="pos" value="sales" /> Sales 
                <input type="checkbox" id="events" name="pos" value="eventss" onchange="check_events();" /> Name Event &nbsp;
                <input type="text" id="txt_event" name="txt_event" disabled="disabled" value="<?php if(isset($txt_event)): echo $txt_event; endif;?>"/><br />
                <input type="checkbox" id="daily" name="pos" value="daily" /> Daily/Personal Selling &nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="lain_pos" name="pos" value="lain_pos" onchange="check_lain_pos();" /> Lainnya &nbsp;&nbsp;
                <input type="text" id="txt_lain_pos" name="txt_lain_pos" disabled="disabled" value="<?php if(isset($txt_lain_pos)): echo $txt_lain_pos; endif;?>"/>
            </tr>
            <tr>
            	<td colspan="2"><input type="checkbox" id="ftb" name="pos2" value="ftb" /> First Time Buyer &nbsp;
                <input type="checkbox" id="eb" name="pos2" value="eb" /> Existing Buyer &nbsp;
                <input type="checkbox" id="eu" name="pos2" value="eu" /> End User &nbsp;
                <input type="checkbox" id="invest" name="pos2" value="invest" /> Investor</td>
            </tr>
      	</table>
   	</fieldset><br /><br /><br /><br /><br />
</form>
</div>
<script language="javascript">
	function harga(){
		var harga_jual = $('#harga_jual').val();
		var ppn = harga_jual*0.1;
		jual = parseInt(harga_jual) + parseInt(ppn);
		document.frm_mk32.harga_jual2.value = jual;
		document.frm_mk32.harga_jual2.focus();
	}
	
	function digit(){
		$('#harga_jual2').number(true, 2);
	}
// tanggal expired card
cal1_mk32 = new dhtmlXCalendarObject({
			input: "tgl1",button: "btnTg1"
	});
cal1_mk32.setDateFormat("%d/%m/%Y");

cal1_mk32 = new dhtmlXCalendarObject({
			input: "tgl2",button: "btnTg2"
	});
cal1_mk32.setDateFormat("%d/%m/%Y");

cal1_mk32 = new dhtmlXCalendarObject({
			input: "tgl3",button: "btnTg3"
	});
cal1_mk32.setDateFormat("%d/%m/%Y");

cal1_mk32 = new dhtmlXCalendarObject({
			input: "tgl4",button: "btnTg4"
	});
cal1_mk32.setDateFormat("%d/%m/%Y");

cal1_mk32 = new dhtmlXCalendarObject({
			input: "tgl_lunas",button: "btnTg1_lunas"
	});
cal1_mk32.setDateFormat("%d/%m/%Y");

	$(function() {
		$('#harga_jual').number(true, 2);
		$('#harga_jual2').number(true, 2);
		$('#txt_lain_booking').number(true, 2);
	});
	
	<?php if(isset($booking)){ if($booking=='0'){?> document.frm_mk32.txt_lain_booking.disabled = false; <?php } else { ?> document.frm_mk32.txt_lain_booking.disabled = true; <?php } } ?>
	<?php if(isset($uang_muka)){ if($uang_muka=='0'){?> document.frm_mk32.txt_uang_muka.disabled = false; <?php } else { ?> document.frm_mk32.txt_uang_muka.disabled = true; <?php } } ?>
	
	<?php if(isset($lain)){ if($lain=='lain'){?> document.frm_mk32.lain_promosi.disabled = false; <?php } else { ?> document.frm_mk32.lain_promosi.disabled = true; <?php } } ?>
	<?php if(isset($promosi)){ if($promosi=='promosi'){?> document.frm_mk32.lain_promosi.disabled = false; <?php } else { ?> document.frm_mk32.lain_promosi.disabled = true; <?php } } ?>
	<?php if(isset($exhibition)){ if($exhibition=='exhibition'){?> document.frm_mk32.txt_exhibition.disabled = false; <?php } else { ?> document.frm_mk32.txt_exhibition.disabled = true; <?php } } ?>
	<?php if(isset($events)){ if($events=='events'){?> document.frm_mk32.txt_event.disabled = false; <?php } else { ?> document.frm_mk32.txt_event.disabled = true; <?php } } ?>
	<?php if(isset($lain_pos)){ if($lain_pos=='lain_pos'){?> document.frm_mk32.txt_lain_pos.disabled = false; <?php } else { ?> document.frm_mk32.txt_lain_pos.disabled = true; <?php } } ?>
	
	<?php if(isset($check_loan)){ if($check_loan=='1'){?>
		document.frm_mk32.lunas_cair.disabled = false;
		document.frm_mk32.nm_lembaga.disabled = false;
	<?php } else { ?>
		document.frm_mk32.lunas_cair.disabled = true;
		document.frm_mk32.nm_lembaga.disabled = true;
	<?php } } ?>
	
	<?php if(isset($koran)){ if($koran=='koran'){?> document.frm_mk32.koran.checked = true; <?php } } ?>
	<?php if(isset($billboard)){ if($billboard=='billboard'){?> document.frm_mk32.billboard.checked = true; <?php } } ?>
	<?php if(isset($undangan)){ if($undangan=='undangan'){?> document.frm_mk32.undangan.checked = true; <?php } } ?>
	<?php if(isset($majalah)){ if($majalah=='majalah'){?> document.frm_mk32.majalah.checked = true; <?php } } ?>
	<?php if(isset($tv_radio)){ if($tv_radio=='tv_radio'){?> document.frm_mk32.tv_radio.checked = true; <?php } } ?>
	<?php if(isset($pager_grafis)){ if($pager_grafis=='pager_grafis'){?> document.frm_mk32.pager_grafis.checked = true; <?php } } ?>
	<?php if(isset($lisan)){ if($lisan=='lisan'){?> document.frm_mk32.lisan.checked = true; <?php } } ?>
	<?php if(isset($lain)){ if($lain=='lain'){?> document.frm_mk32.lain.checked = true; <?php } } ?>
	
	<?php if(isset($kantor_pusat)){ if($kantor_pusat=='kantor_pusat'){?> document.frm_mk32.kantor_pusat.checked = true; <?php } } ?>
	<?php if(isset($exhibition)){ if($exhibition=='exhibition'){?> document.frm_mk32.exhibition.checked = true; <?php } } ?>
	<?php if(isset($sales)){ if($sales=='sales'){?> document.frm_mk32.sales.checked = true; <?php } } ?>
	<?php if(isset($events)){ if($events=='events'){?> document.frm_mk32.events.checked = true; <?php } } ?>
	<?php if(isset($daily)){ if($daily=='daily'){?> document.frm_mk32.daily.checked = true; <?php } } ?>
	<?php if(isset($lain_pos)){ if($lain_pos=='lain_pos'){?> document.frm_mk32.lain_pos.checked = true; <?php } } ?>
	
	<?php if(isset($ftb)){ if($ftb=='ftb'){?> document.frm_mk32.ftb.checked = true; <?php } } ?>
	<?php if(isset($eb)){ if($eb=='eb'){?> document.frm_mk32.eb.checked = true; <?php } } ?>
	<?php if(isset($eu)){ if($eu=='eu'){?> document.frm_mk32.eu.checked = true; <?php } } ?>
	<?php if(isset($invest)){ if($invest=='invest'){?> document.frm_mk32.invest.checked = true; <?php } } ?>

if(document.frm_mk32.txt_lain_booking.value != ""){
	document.frm_mk32.txt_lain_booking.disabled = false;
}

function check_lain_booking(){
	if(document.frm_mk32.lain_booking.checked == true){
		document.frm_mk32.txt_lain_booking.disabled = false;
	}
}

function check_lain_booking2(){
	if(document.frm_mk32.ready.checked == true){
		document.frm_mk32.txt_lain_booking.disabled = true;
	}
}

function check_umLain(){
	if(document.frm_mk32.umLain.checked == true){
		document.frm_mk32.txt_uang_muka.disabled = false;
	}
}

function check_umLain2(){
	if(document.frm_mk32.umLain.checked == false){
		document.frm_mk32.txt_uang_muka.disabled = true;
	}
}

function check_unit(){
	if(document.frm_mk32.tunai_lain.checked == true){
		document.frm_mk32.txt_lain_unit.disabled = false;
	}
}

function check_unit2(){
	if(document.frm_mk32.tunai_lain.checked == false){
		document.frm_mk32.txt_lain_unit.disabled = true;
	}
}

function ch_loan(){
	if(document.frm_mk32.check_loan.checked == true){
		document.frm_mk32.lunas_cair.disabled = false;
		document.frm_mk32.nm_lembaga.disabled = false;
	} else {
		document.frm_mk32.lunas_cair.disabled = true;
		document.frm_mk32.nm_lembaga.disabled = true;
	}
}

function in_uang_muka(){
	document.frm_mk32.um24.checked = false;
	document.frm_mk32.um36.checked = false;
}

function check_promo_lain(){
	if(document.frm_mk32.lain.checked == true){
		document.frm_mk32.lain_promosi.disabled = false;
	}
}

function ch_stor(){
	if(document.frm_mk32.setor.checked == false){
		document.frm_mk32.setor_tgl.value == "";
	}
}

function check_exhibition(){
	if(document.frm_mk32.exhibition.checked == true){
		document.frm_mk32.txt_exhibition.disabled = false;
	} else {
		document.frm_mk32.txt_exhibition.disabled = true;
	}
}

function check_events(){
	if(document.frm_mk32.events.checked == true){
		document.frm_mk32.txt_event.disabled = false;
	} else {
		document.frm_mk32.txt_event.disabled = true;
	}
}

function check_lain_pos(){
	if(document.frm_mk32.lain_pos.checked == true){
		document.frm_mk32.txt_lain_pos.disabled = false;
	} else {
		document.frm_mk32.txt_lain_pos.disabled = true;
	}
}
</script>
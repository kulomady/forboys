<?php

/*
 * kas_input.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>

<div class="frmContainer">
    <form name="frm_ak72" method="post" action="javascript:void(0);">                
        <!--<fieldset>-->                                                                   
        <table width="450" border="0" cellpadding="1" cellspacing="1">
            <tr>
                <td width="100" align="right">No. Transaksi</td>
                <td width="10">:</td>
                <td width="400">
                    <input type="input" name="txtno_transaksi" id="txtno_transaksi" tabindex="1" readonly <?php if (isset($txtno_transaksi)): echo 'value="' . $txtno_transaksi . '"'; endif; ?> placeholder="AUTO" />
                </td>   
                
            </tr> 
            <tr>
                <td align="right">Tanggal</td>
                <td width="10">:</td>
                <td>
                    <input type="input" name="txttgl" id="txttgl" tabindex="2" <?php if (isset($txttgl)): echo 'value="' . $txttgl . '"'; endif; ?> />
                    <span><img id="btntgl" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>                        
                </td>  
               <td style="display:none;"></td>                
            </tr>
            <tr>
                <td width="" align="right">Kas/Bank</td>
                <td width="10">:</td>
                <td width="">
                    <div id="bank_ak72"></div>
                </td> 
            </tr>            
            <tr>
                <td align="right">Jumlah</td>
                <td width="10">:</td>
                <td>
                    <input type="text" name="txtjumlah" id="txtjumlah" tabindex="2" style="text-align: right;" onkeyup="" <?php if (isset($txtjumlah)): echo 'value="' . $txtjumlah . '"'; endif; ?> />
                </td> 
            </tr>
            <tr>                
                <td align="right">Keterangan</td>
                <td width="10">:</td>
                <td>                   
                    <textarea id="txtketerangan" name="txtketerangan" rows="3" cols="20"><?php if (isset($txtketerangan)): echo $txtketerangan; endif; ?></textarea>
                </td>  
            </tr> 
            <tr>
                <td width="" align="right">Cabang</td>
                <td width="10">:</td>
                <td width="">
                    <div id="cbCabang_ak72"></div>
                </td> 
            </tr>
            <input type="hidden" name="id" id="id" <?php if (isset($id)): echo $id; endif; ?> />                                  
        </table>    
        <!--</fieldset>-->
    </form>
</div>
<script>
    $(function() {             
             $('#txtjumlah').number(true, 2);             
    });
            
    // Call Tgl jurnal
    cal1_ak72 = new dhtmlXCalendarObject({
        input: "txttgl",button: "btntgl"
    });
    cal1_ak72.setDateFormat("%d/%m/%Y");
    
    // Combo Bank
	var cbBank_ak72 = new dhtmlXCombo("bank_ak72", "bank_ak72", 200);
	cbBank_ak72.enableFilteringMode(true);
	loadCbKas_ak72();
	function loadCbKas_ak72() {
		cbBank_ak72.clearAll();
		cbBank_ak72.loadXML(base_url+"index.php/saldo_awal/cb_bank",function() {                    
			<?php                        
				if(isset($bank_ak72)):
					echo "IDcbBank_ak72 = cbBank_ak72.getIndexByValue('".$bank_ak72."');";
					echo "cbBank_ak72.selectOption(IDcbBank_ak72,true,true);";
				endif;
			?>
		});
	}
        
        // Combo Cabang
	var cbCabang_ak72 = new dhtmlXCombo("cbCabang_ak72", "cbCabang_ak72", 200);
	cbCabang_ak72.enableFilteringMode(true);
	loadcbCabang_ak72();
	function loadcbCabang_ak72() {
		cbCabang_ak72.clearAll();
		cbCabang_ak72.loadXML(base_url+"index.php/saldo_awal/cb_cabang",function() {                    
			<?php                        
				if(isset($cbCabang_ak72)):
					echo "IDcbCabang_ak72 = cbCabang_ak72.getIndexByValue('".$cbCabang_ak72."');";
					echo "cbCabang_ak72.selectOption(IDcbCabang_ak72,true,true);";
				endif;
			?>
		});
	}
    
    function baru_ak72() {
        document.frm_ak72.txtno_transaksi.value = "";        
        document.frm_ak72.txttgl.value = "";
        document.frm_ak72.txtjumlah.value = "";        
        document.frm_ak72.txtketerangan.value = "";
        
        cbBank_ak72.setComboValue("");
        cbCabang_ak72.setComboValue("");
    }
    
    function simpan_ak72() { 
        var jml = $('#txtjumlah').val();                         
        if(document.frm_ak72.txttgl.value == ""){
            alert("Tanggal tidak boleh kosong");
            return;
        }
        if(cbBank_ak72.getSelectedValue()==null){
            alert("Kas/Bank tidak boleh kosong");
            return;
        }        
        if(jml == ""){
            alert("Jumlah tidak boleh kosong");
            return;
        }
                
        poststr =
            'txtno_transaksi=' + document.frm_ak72.txtno_transaksi.value +        
            '&txttgl=' + document.frm_ak72.txttgl.value +
            '&txtkasbank=' + cbBank_ak72.getSelectedValue() + 
            '&cbCabang_ak72=' + cbCabang_ak72.getSelectedValue() + 
            '&txtjumlah=' + jml +            
            '&txtketerangan=' + document.frm_ak72.txtketerangan.value;                        
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/saldo_awal/simpan_kas", encodeURI(poststr), outputSimpan_ak72);
    }
    
    function outputSimpan_ak72(loader) {
        result = loader.xmlDoc.responseText;
        document.frm_ak72.txtno_transaksi.value = result;
        tb_w1_ak72.disableItem("save");
        tb_w1_ak72.disableItem("batal");
        tb_w1_ak72.enableItem("baru");
        refreshGd_ak72();
        statusEnding();
    }
    
</script>
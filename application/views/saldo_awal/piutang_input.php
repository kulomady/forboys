<?php

/*
 * piutang_input.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>

<div class="frmContainer">
    <form name="frm_ak74" method="post" action="javascript:void(0);">                
        <!--<fieldset>-->                                                                   
        <table width="450" border="0" cellpadding="1" cellspacing="1">
            <tr>
                <td width="150" align="right">No. Transaksi</td>
                <td width="10">:</td>
                <td width="400">
                    <input type="input" name="txtno_transaksi" id="txtno_transaksi" tabindex="1" readonly <?php if (isset($txtno_transaksi)): echo 'value="' . $txtno_transaksi . '"'; endif; ?> placeholder="AUTO" />
                </td>                   
            </tr>
            <tr>
                <td width="100" align="right">Nama Customer</td>
                <td width="10">:</td>
                <td width="400">
                    <input type="input" name="txtcustomer" id="txtcustomer" tabindex="1" size="8" style="text-align: right;" readonly <?php if (isset($txtcustomer)): echo 'value="' . $txtcustomer . '"'; endif; ?> />
                    &nbsp;<span><img id="btncustomer" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="showCustomer()" /></span>
                    &nbsp;<span id="tmpcustomer"><?php if (isset($tmpcustomer)): echo $tmpcustomer; endif; ?></span>
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
                <td align="right">No. Penjualan</td>
                <td width="10">:</td>
                <td>
                    <input type="text" name="txtnopenjualan" id="txtnopenjualan" tabindex="2" style="text-align: left;" onkeyup="" <?php if (isset($txtnopenjualan)): echo 'value="' . $txtnopenjualan . '"'; endif; ?> />
                </td> 
            </tr>
            <tr>
                <td align="right">Jatuh Tempo</td>
                <td width="10">:</td>
                <td>
                    <input type="input" name="txtjatuhtempo" id="txtjatuhtempo" tabindex="2" <?php if (isset($txtjatuhtempo)): echo 'value="' . $txtjatuhtempo . '"'; endif; ?> />
                    <span><img id="btntgljt" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>                        
                </td>  
               <td style="display:none;"></td>                
            </tr> 
            <tr>
                <td align="right">Jumlah Piutang</td>
                <td width="10">:</td>
                <td>
                    <input type="text" name="txtjumlah" id="txtjumlah" tabindex="2" style="text-align: right;" onkeyup="" <?php if (isset($txtjumlah)): echo 'value="' . $txtjumlah . '"'; endif; ?> />
                </td> 
            </tr>
            <tr>                
                <td align="right">Keterangan</td>
                <td width="10">:</td>
                <td>                   
                    <textarea id="txtketerangan" name="txtketerangan" rows="3" cols="25"><?php if (isset($txtketerangan)): echo $txtketerangan; endif; ?></textarea>
                </td>  
            </tr> 
            <tr>
                <td align="right">Akun</td>
                <td width="10">:</td>
                <td>
                    <input type="text" name="txtnoakun" id="txtnoakun" tabindex="2" size="8" readonly style="text-align: right;" onkeyup="" <?php if (isset($txtnoakun)): echo 'value="' . $txtnoakun . '"'; endif; ?> />
                    &nbsp;<span id="tmpakun"><?php if (isset($tmpakun)): echo $tmpakun; endif; ?></span>
                </td> 
            </tr>
            <tr>
                <td width="" align="right">Cabang</td>
                <td width="10">:</td>
                <td width="">
                    <div id="cbCabang_ak74"></div>
                </td> 
            </tr>
            <input type="hidden" name="txtid" id="txtid" <?php if (isset($txtid)): echo $txtid; endif; ?> />                                  
        </table>    
        <!--</fieldset>-->
    </form>
</div>

<div id="gridcusx" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
    <table width="409" border="0">
        <tr>
            <td width="69">Cari Data</td>
            <td width="336"><input type="text" name="frmSearchCus" id="frmSearchCus" onKeyDown=""></td>
        </tr> 
        <tr>
            <td colspan="2"><div id="gridcus" style="width:405px; height:345px;" /></td>
        </tr>
    </table>    
</div>
<script>
    $(function() {             
             $('#txtjumlah').number(true, 2);             
    });
            
    // Call Tgl jurnal
    cal1_ak74 = new dhtmlXCalendarObject({
        input: "txttgl",button: "btntgl"
    });
    cal1_ak74.setDateFormat("%d/%m/%Y");
    
    // Call Tgl Jatuh Tempo
    cal2_ak74 = new dhtmlXCalendarObject({
        input: "txtjatuhtempo",button: "btntgljt"
    });
    cal2_ak74.setDateFormat("%d/%m/%Y");
    
    // Combo Cabang
	var cbCabang_ak74 = new dhtmlXCombo("cbCabang_ak74", "cbCabang_ak74", 200);
	cbCabang_ak74.enableFilteringMode(true);
	loadcbCabang_ak74();
	function loadcbCabang_ak74() {
		cbCabang_ak74.clearAll();
		cbCabang_ak74.loadXML(base_url+"index.php/saldo_awal/cb_cabang",function() {                    
			<?php                        
				if(isset($cbCabang_ak74)):
					echo "IDcbCabang_ak74 = cbCabang_ak74.getIndexByValue('".$cbCabang_ak74."');";
					echo "cbCabang_ak74.selectOption(IDcbCabang_ak74,true,true);";
				endif;
			?>
		});
	}
    
    function baru_ak74() {        
        document.frm_ak74.txtno_transaksi.value = "";        
        document.frm_ak74.txtcustomer.value = "";        
        document.frm_ak74.txttgl.value = "";
        document.frm_ak74.txtnopenjualan.value = "";        
        document.frm_ak74.txtjatuhtempo.value = "";
        document.frm_ak74.txtjumlah.value = "";
        document.frm_ak74.txtketerangan.value = "";
        document.frm_ak74.txtnoakun.value = "";
        document.getElementById("tmpcustomer").innerHTML = "";
        document.getElementById("tmpakun").innerHTML = "";
        cbCabang_ak74.setComboValue("");
    }
    
    function simpan_ak74() { 
        var jml = $('#txtjumlah').val(); 
        if(document.frm_ak74.txtcustomer.value == ""){
            alert("Customer tidak boleh kosong");
            return;
        } 
        if(document.frm_ak74.txttgl.value == ""){
            alert("Tanggal tidak boleh kosong");
            return;
        }                
        if(jml == ""){
            alert("Jumlah tidak boleh kosong");
            return;
        }
                
        poststr =
            'txtno_transaksi=' + document.frm_ak74.txtno_transaksi.value + 
            '&txtcustomer=' + document.frm_ak74.txtcustomer.value +        
            '&txttgl=' + document.frm_ak74.txttgl.value +
            '&txtnopenjualan=' + document.frm_ak74.txtnopenjualan.value +
            '&txtjatuhtempo=' + document.frm_ak74.txtjatuhtempo.value +
            '&cbCabang_ak74=' + cbCabang_ak74.getSelectedValue() + 
            '&txtjumlah=' + jml +            
            '&txtketerangan=' + document.frm_ak74.txtketerangan.value +
            '&txtnoakun=' + document.frm_ak74.txtnoakun.value+
            '&txtid=' + document.frm_ak74.txtid.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/saldo_awal/simpan_piutang", encodeURI(poststr), outputSimpan_ak74);
    }
    
    function outputSimpan_ak74(loader) {
        result = loader.xmlDoc.responseText;        
        tb_w1_ak74.disableItem("save");
        tb_w1_ak74.disableItem("batal");
        tb_w1_ak74.enableItem("baru");
        refreshGd_ak74();
        statusEnding();
    }
    
    var w1_customer_ak74 = dhxWins.createWindow("w1_customer_ak74",0,0,430,430);
    w1_customer_ak74.setText("Daftar Akun");
    w1_customer_ak74.button("park").hide();
    w1_customer_ak74.button("minmax1").hide();
    w1_customer_ak74.button("close").hide();
    w1_customer_ak74.center();
    w1_customer_ak74.hideHeader();
    w1_customer_ak74.hide();
    
    tb_win_cus_ak74 = w1_customer_ak74.attachToolbar();
    tb_win_cus_ak74.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
    tb_win_cus_ak74.setSkin("dhx_terrace");
    tb_win_cus_ak74.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
    tb_win_cus_ak74.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
    tb_win_cus_ak74.attachEvent("onclick", function(id) {
	if(id=='pakai') {
            select_gridCus(id);                        
	} else if(id=='tutup') {
            w1_customer_ak74.hide();
	}
    });
    
    grid_cus_ak74 = new dhtmlXGridObject('gridcus');
    grid_cus_ak74.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
    grid_cus_ak74.setHeader("Kode #,Nama Customer,idperkiraan,nmperkiraan",null,["text-align:center","text-align:center","text-align:center"]);
    grid_cus_ak74.setInitWidths("80,180,0,0");
    grid_cus_ak74.setColAlign("left,left,left,left");
    grid_cus_ak74.setColSorting("str,str,str,str");
    grid_cus_ak74.setColTypes("ro,ro,ro,ro");
    grid_cus_ak74.enableSmartRendering(true,50);
    grid_cus_ak74.makeSearch("frmSearchCus",1);
    grid_cus_ak74.attachEvent("onRowDblClicked",select_gridCus);
    grid_cus_ak74.setSkin("dhx_skyblue");
    grid_cus_ak74.init();
    
    function showCustomer() {        
	w1_customer_ak74.show();
	w1_customer_ak74.bringToTop();
	w1_customer_ak74.attachObject('gridcusx');
        grid_cus_ak74.clearAll();        
        grid_cus_ak74.loadXML(base_url+"index.php/saldo_awal/loadData_customer",function() {
            
        });        
    }
    
    function select_gridCus(id){
        document.frm_ak74.txtcustomer.value = grid_cus_ak74.cells(id,0).getValue();
        document.getElementById("tmpcustomer").innerHTML = grid_cus_ak74.cells(id,1).getValue();
        document.frm_ak74.txtnoakun.value = grid_cus_ak74.cells(id,2).getValue();
        document.getElementById("tmpakun").innerHTML = grid_cus_ak74.cells(id,3).getValue();
        w1_customer_ak74.hide();
    }
    
</script>

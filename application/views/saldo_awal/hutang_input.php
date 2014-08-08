<?php

/*
 * hutang_input.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>


<div class="frmContainer">
    <form name="frm_ak73" method="post" action="javascript:void(0);">                
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
                <td width="100" align="right">Nama Supplier</td>
                <td width="10">:</td>
                <td width="400">
                    <input type="input" name="txtsupplier" id="txtsupplier" tabindex="1" size="8" style="text-align: right;" readonly <?php if (isset($txtsupplier)): echo 'value="' . $txtsupplier . '"'; endif; ?> />
                    &nbsp;<span><img id="btnsupplier" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="showSupplier()" /></span>
                    &nbsp;<span id="tmpsupplier"><?php if (isset($tmpsupplier)): echo $tmpsupplier; endif; ?></span>
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
                <td align="right">No. Pembelian</td>
                <td width="10">:</td>
                <td>
                    <input type="text" name="txtnopembelian" id="txtnopembelian" tabindex="2" style="text-align: left;" onkeyup="" <?php if (isset($txtnopembelian)): echo 'value="' . $txtnopembelian . '"'; endif; ?> />
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
                <td align="right">Jumlah Hutang</td>
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
                    <div id="cbCabang_ak73"></div>
                </td> 
            </tr>
            <input type="hidden" name="txtid" id="txtid" <?php if (isset($txtid)): echo $txtid; endif; ?> />                                  
        </table>    
        <!--</fieldset>-->
    </form>
</div>

<div id="gridsupx" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
    <table width="409" border="0">
        <tr>
            <td width="69">Cari Data</td>
            <td width="336"><input type="text" name="frmSearchSup" id="frmSearchSup" onKeyDown=""></td>
        </tr> 
        <tr>
            <td colspan="2"><div id="gridsup" style="width:405px; height:345px;" /></td>
        </tr>
    </table>    
</div>
<script>
    $(function() {             
             $('#txtjumlah').number(true, 2);             
    });
            
    // Call Tgl jurnal
    cal1_ak73 = new dhtmlXCalendarObject({
        input: "txttgl",button: "btntgl"
    });
    cal1_ak73.setDateFormat("%d/%m/%Y");
    
    // Call Tgl Jatuh Tempo
    cal2_ak73 = new dhtmlXCalendarObject({
        input: "txtjatuhtempo",button: "btntgljt"
    });
    cal2_ak73.setDateFormat("%d/%m/%Y");
    
    // Combo Cabang
	var cbCabang_ak73 = new dhtmlXCombo("cbCabang_ak73", "cbCabang_ak73", 200);
	cbCabang_ak73.enableFilteringMode(true);
	loadcbCabang_ak73();
	function loadcbCabang_ak73() {
		cbCabang_ak73.clearAll();
		cbCabang_ak73.loadXML(base_url+"index.php/saldo_awal/cb_cabang",function() {                    
			<?php                        
				if(isset($cbCabang_ak73)):
					echo "IDcbCabang_ak73 = cbCabang_ak73.getIndexByValue('".$cbCabang_ak73."');";
					echo "cbCabang_ak73.selectOption(IDcbCabang_ak73,true,true);";
				endif;
			?>
		});
	}
    
    function baru_ak73() {        
        document.frm_ak73.txtno_transaksi.value = "";        
        document.frm_ak73.txtsupplier.value = "";        
        document.frm_ak73.txttgl.value = "";
        document.frm_ak73.txtnopembelian.value = "";        
        document.frm_ak73.txtjatuhtempo.value = "";
        document.frm_ak73.txtjumlah.value = "";
        document.frm_ak73.txtketerangan.value = "";
        document.frm_ak73.txtnoakun.value = "";
        document.getElementById("tmpsupplier").innerHTML = "";
        document.getElementById("tmpakun").innerHTML = "";
        cbCabang_ak73.setComboValue("");
    }
    
    function simpan_ak73() { 
        var jml = $('#txtjumlah').val(); 
        if(document.frm_ak73.txtsupplier.value == ""){
            alert("Supplier tidak boleh kosong");
            return;
        } 
        if(document.frm_ak73.txttgl.value == ""){
            alert("Tanggal tidak boleh kosong");
            return;
        }                
        if(jml == ""){
            alert("Jumlah tidak boleh kosong");
            return;
        }
                
        poststr =
            'txtno_transaksi=' + document.frm_ak73.txtno_transaksi.value + 
            '&txtsupplier=' + document.frm_ak73.txtsupplier.value +        
            '&txttgl=' + document.frm_ak73.txttgl.value +
            '&txtnopembelian=' + document.frm_ak73.txtnopembelian.value +
            '&txtjatuhtempo=' + document.frm_ak73.txtjatuhtempo.value +
            '&cbCabang_ak73=' + cbCabang_ak73.getSelectedValue() + 
            '&txtjumlah=' + jml +            
            '&txtketerangan=' + document.frm_ak73.txtketerangan.value +
            '&txtnoakun=' + document.frm_ak73.txtnoakun.value+
            '&txtid=' + document.frm_ak73.txtid.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/saldo_awal/simpan_hutang", encodeURI(poststr), outputSimpan_ak73);
    }
    
    function outputSimpan_ak73(loader) {
        result = loader.xmlDoc.responseText;        
        tb_w1_ak73.disableItem("save");
        tb_w1_ak73.disableItem("batal");
        tb_w1_ak73.enableItem("baru");
        refreshGd_ak73();
        statusEnding();
    }
    
    var w1_supplier_ak73 = dhxWins.createWindow("w1_supplier_ak73",0,0,430,430);
    w1_supplier_ak73.setText("Daftar Akun");
    w1_supplier_ak73.button("park").hide();
    w1_supplier_ak73.button("minmax1").hide();
    w1_supplier_ak73.button("close").hide();
    w1_supplier_ak73.center();
    w1_supplier_ak73.hideHeader();
    w1_supplier_ak73.hide();
    
    tb_win_sup_ak73 = w1_supplier_ak73.attachToolbar();
    tb_win_sup_ak73.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
    tb_win_sup_ak73.setSkin("dhx_terrace");
    tb_win_sup_ak73.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
    tb_win_sup_ak73.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
    tb_win_sup_ak73.attachEvent("onclick", function(id) {
	if(id=='pakai') {
            select_gridSup(id);                        
	} else if(id=='tutup') {
            w1_supplier_ak73.hide();
	}
    });
    
    grid_sup_ak73 = new dhtmlXGridObject('gridsup');
    grid_sup_ak73.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
    grid_sup_ak73.setHeader("Kode #,Nama Supplier,idperkiraan,nmperkiraan",null,["text-align:center","text-align:center","text-align:center"]);
    grid_sup_ak73.setInitWidths("80,180,0,0");
    grid_sup_ak73.setColAlign("left,left,left,left");
    grid_sup_ak73.setColSorting("str,str,str,str");
    grid_sup_ak73.setColTypes("ro,ro,ro,ro");
    grid_sup_ak73.enableSmartRendering(true,50);
    grid_sup_ak73.makeSearch("frmSearchSup",1);
    grid_sup_ak73.attachEvent("onRowDblClicked",select_gridSup);
    grid_sup_ak73.setSkin("dhx_skyblue");
    grid_sup_ak73.init();
    
    function showSupplier() {        
	w1_supplier_ak73.show();
	w1_supplier_ak73.bringToTop();
	w1_supplier_ak73.attachObject('gridsupx');
        grid_sup_ak73.clearAll();        
        grid_sup_ak73.loadXML(base_url+"index.php/saldo_awal/loadData_supplier",function() {
            
        });        
    }
    
    function select_gridSup(id){
        document.frm_ak73.txtsupplier.value = grid_sup_ak73.cells(id,0).getValue();
        document.getElementById("tmpsupplier").innerHTML = grid_sup_ak73.cells(id,1).getValue();
        document.frm_ak73.txtnoakun.value = grid_sup_ak73.cells(id,2).getValue();
        document.getElementById("tmpakun").innerHTML = grid_sup_ak73.cells(id,3).getValue();
        w1_supplier_ak73.hide();
    }
    
</script>
<?php

/*
 * kasbank_index.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>

<div id="tmpTb_ak72" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<!--<div id="tmpGrid_ak72" style="height:400px;width: 100%"></div>-->
<!--<div id="tmpInfoGrid_ak72" style="background-color:#B8E0F5; padding-top:5px;"></div>-->
<div id="tmpLayout_ak72" style="position: relative; width: 100%; height: 92%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_ak72" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_ak72" name="frmSearch_ak72" method="post" action="javascript:void(0);">
    <table width="1200" border="0">
      <tr>
        <td width="70">Periode</td>
        <td width="300">
            <input type="input" name="flt_tgl1_ak72" id="flt_tgl1_ak72" tabindex="1" size="10" />
            <span><img id="btntgl1_ak72" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> 
            s/d
            <input type="input" name="flt_tgl2_ak72" id="flt_tgl2_ak72" tabindex="2" size="10" />
            <span><img id="btntgl2_ak72" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>                        
        </td>
        <td width="70">No Transaksi</td>
        <td width="168"><input type="text" name="flt_no_voucher_ak72" id="flt_no_voucher_ak72" /></td>
        <td width="82">Keterangan</td>
        <td width="200"><input type="text" name="flt_ket_ak72" id="flt_ket_ak72" size="40" /></td>
        <td width="100"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_ak72();" />
        <input type="button" name="button" id="button" value="RESET" onclick="frmSearch_ak72.reset();" />
        </td>        
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
cal1_ak72 = new dhtmlXCalendarObject({
    input: "flt_tgl1_ak72",button: "btntgl1_ak72"
});
cal1_ak72.setDateFormat("%d/%m/%Y");   

cal2_ak72 = new dhtmlXCalendarObject({
    input: "flt_tgl2_ak72",button: "btntgl2_ak72"
});
cal2_ak72.setDateFormat("%d/%m/%Y"); 

tb_ak72 = new dhtmlXToolbarObject("tmpTb_ak72");
tb_ak72.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_ak72.setSkin("dhx_terrace");
tb_ak72.attachEvent("onclick", tbClick_ak72);
tb_ak72.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_ak72 = new dhtmlXLayoutObject("tmpLayout_ak72", "2E");
dhxLayout_ak72.cells("a").setText("Cari Data");
dhxLayout_ak72.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_ak72.cells("a").setHeight(60);
dhxLayout_ak72.cells("a").collapse();
dhxLayout_ak72.cells("a").attachObject("tmpSearch_ak72");
dhxLayout_ak72.cells("b").setText("Site Navigation");
dhxLayout_ak72.cells("b").hideHeader();

function tbClick_ak72(id) {
	if(id=='new') {
		winForm_ak72('input');
	} else if(id=='edit') {
		winForm_ak72('edit');
	} else if(id=='del') {
		hapus_ak72();
	} else if(id=='cari') {
		if(dhxLayout_ak72.cells("a").isCollapsed()) {
			dhxLayout_ak72.cells("a").expand();
		} else {
			dhxLayout_ak72.cells("a").collapse();
		}
	}
}

//gd_ak72 = new dhtmlXGridObject('tmpGrid_ak72');
gd_ak72 = dhxLayout_ak72.cells("b").attachGrid();
gd_ak72.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ak72.setHeader("&nbsp;,No Transaksi,Tgl,Kas/Bank,Jumlah,Keterangan",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ak72.setInitWidths("30,150,100,200,150,*");
gd_ak72.setColAlign("right,left,center,left,right,left");
gd_ak72.setColSorting("na,str,str,str,str,str");
gd_ak72.setColTypes("cntr,ro,ro,ro,ron,ro");
//gd_ak72.enableSmartRendering(true,50);
gd_ak72.setColumnColor("#CCE2FE");
gd_ak72.setSkin("dhx_skyblue");
gd_ak72.setNumberFormat("0,000.00", 4, ".", ",");
//gd_ak72.splitAt(3);
gd_ak72.init();
gd_ak72.attachFooter("&nbsp;,Total,&nbsp;,&nbsp;,{#stat_total},&nbsp;");
loadGd_ak72();

function loadGd_ak72() {
        if(document.frmSearch_ak72.flt_tgl1_ak72.value != "") {
                tgl1 = replaceall(document.frmSearch_ak72.flt_tgl1_ak72.value,'/','-'); 		
	} else {
		tgl1 = 0;
	}
        if(document.frmSearch_ak72.flt_tgl2_ak72.value != "") {
                tgl2 = replaceall(document.frmSearch_ak72.flt_tgl2_ak72.value,'/','-'); 		
	} else {
		tgl2 = 0;
	}
	if(document.frmSearch_ak72.flt_no_voucher_ak72.value != "") {
		noVoucher = document.frmSearch_ak72.flt_no_voucher_ak72.value;
	} else {
		noVoucher = 0;
	}
        if(document.frmSearch_ak72.flt_ket_ak72.value != "") {
		ket = document.frmSearch_ak72.flt_ket_ak72.value;
	} else {
		ket = 0;
	}
	statusLoading();
        
	gd_ak72.clearAll();
	gd_ak72.loadXML(base_url+"index.php/saldo_awal/loadData_kasbank/"+tgl1+"/"+tgl2+"/"+noVoucher+"/"+ket,function(){            
            statusEnding();
        });
}

function refreshGd_ak72() {
	gd_ak72.updateFromXML(base_url+"index.php/saldo_awal/loadData_kasbank", function(){
//            gd_ak72.groupBy(1);
        });
}



function window_ak72() {
w1_ak72 = dhxWins.createWindow("w1_ak72",0,0,500,280);
w1_ak72.setText("Saldo Awal Kas");
w1_ak72.button("park").hide();
w1_ak72.button("minmax1").hide();
w1_ak72.center();       
w1_ak72.button("close").attachEvent("onClick", function() {
            w1_ak72.setModal(false);             
            w1_ak72.close();
            return;
});
w1_ak72.setModal(true);
        
tb_w1_ak72 = w1_ak72.attachToolbar();
tb_w1_ak72.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w1_ak72.setSkin("dhx_terrace");
tb_w1_ak72.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
tb_w1_ak72.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
tb_w1_ak72.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
tb_w1_ak72.disableItem("baru");
tb_w1_ak72.attachEvent("onclick", function(id) {
    if(id=='batal') {			
        document.frm_ak72.reset();			
    } else if(id=='save') {
        simpan_ak72();
    } else if(id=='baru') {
        tb_w1_ak72.disableItem("baru");
        tb_w1_ak72.enableItem("save");
        tb_w1_ak72.enableItem("batal");
        baru_ak72();
    }
});
}
        
function winForm_ak72(type) {
	idselect = gd_ak72.getRowIndex(gd_ak72.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window_ak72();
	if(type=='input') {
		w1_ak72.attachURL(base_url+"index.php/saldo_awal/form_kasbank", true);
	} else {
                var rid = gd_ak72.cells(gd_ak72.getSelectedId(),1).getValue();                
		w1_ak72.attachURL(base_url+"index.php/saldo_awal/form_kasbank_edit/"+rid, true);
	}
	
	

}

function hapus_ak72() {
		idselect = gd_ak72.getRowIndex(gd_ak72.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
                    var rid = gd_ak72.cells(gd_ak72.getSelectedId(),1).getValue();
			 poststr =
            	'id=' + rid
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/saldo_awal/hapus_kas", encodeURI(poststr), function(loader) {
                                var resultdel = loader.xmlDoc.responseText;                                
				loadGd_ak72();
                                statusEnding();                                
			});
		}
	}

</script>

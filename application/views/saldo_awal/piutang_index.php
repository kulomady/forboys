<?php

/*
 * piutang_index.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>

<div id="tmpTb_ak74" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<!--<div id="tmpGrid_ak74" style="height:485px;width: 100%"></div>-->
<div id="tmpLayout_ak74" style="position: relative; width: 100%; height: 92%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_ak74" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_ak74" name="frmSearch_ak74" method="post" action="javascript:void(0);">
    <table width="1100" border="0">
      <tr>
        <td width="70">Periode</td>
        <td width="300">
            <input type="input" name="flt_tgl1_ak74" id="flt_tgl1_ak74" tabindex="1" size="10" />
            <span><img id="btntgl1_ak74" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> 
            s/d
            <input type="input" name="flt_tgl2_ak74" id="flt_tgl2_ak74" tabindex="2" size="10" />
            <span><img id="btntgl2_ak74" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>                        
        </td>
        <td width="70">No Transaksi</td>
        <td width="168"><input type="text" name="flt_no_voucher_ak74" id="flt_no_voucher_ak74" /></td>       
      </tr>
      <tr>
        <td width="82">Keterangan</td>
        <td width="200"><input type="text" name="flt_ket_ak74" id="flt_ket_ak74" size="40" /></td>
         <td width="70">Customer</td>
        <td width="168"><input type="text" name="flt_customer_ak74" id="flt_customer_ak74" /></td>
        <td width="100" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_ak74();" />
        <input type="button" name="button" id="button" value="RESET" onclick="frmSearch_ak74.reset();" />
        </td>        
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
cal1_ak74 = new dhtmlXCalendarObject({
    input: "flt_tgl1_ak74",button: "btntgl1_ak74"
});
cal1_ak74.setDateFormat("%d/%m/%Y");   

cal2_ak74 = new dhtmlXCalendarObject({
    input: "flt_tgl2_ak74",button: "btntgl2_ak74"
});
cal2_ak74.setDateFormat("%d/%m/%Y"); 

tb_ak74 = new dhtmlXToolbarObject("tmpTb_ak74");
tb_ak74.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_ak74.setSkin("dhx_terrace");
tb_ak74.attachEvent("onclick", tbClick_ak74);
tb_ak74.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_ak74 = new dhtmlXLayoutObject("tmpLayout_ak74", "2E");
dhxLayout_ak74.cells("a").setText("Cari Data");
dhxLayout_ak74.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_ak74.cells("a").setHeight(90);
dhxLayout_ak74.cells("a").collapse();
dhxLayout_ak74.cells("a").attachObject("tmpSearch_ak74");
dhxLayout_ak74.cells("b").setText("Site Navigation");
dhxLayout_ak74.cells("b").hideHeader();

function tbClick_ak74(id) {
	if(id=='new') {
		winForm_ak74('input');
	} else if(id=='edit') {
		winForm_ak74('edit');
	} else if(id=='del') {
		hapus_ak74();
	} else if(id=='cari') {
		if(dhxLayout_ak74.cells("a").isCollapsed()) {
			dhxLayout_ak74.cells("a").expand();
		} else {
			dhxLayout_ak74.cells("a").collapse();
		}
	}
}

//gd_ak74 = new dhtmlXGridObject('tmpGrid_ak74');
gd_ak74 = dhxLayout_ak74.cells("b").attachGrid();
gd_ak74.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ak74.setHeader("&nbsp;,No Transaksi,Customer,Tgl,No Penjualan,Jatuh Tempo,Saldo,Keterangan",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ak74.setInitWidths("30,150,250,120,150,120,150,*");
gd_ak74.setColAlign("right,left,left,center,left,center,right,left");
gd_ak74.setColSorting("na,str,str,str,str,str,int,str");
gd_ak74.setColTypes("cntr,ro,ro,ro,ro,ro,ron,ro");
//gd_ak74.enableSmartRendering(true,50);
gd_ak74.setColumnColor("#CCE2FE");
gd_ak74.setSkin("dhx_skyblue");
gd_ak74.setNumberFormat("0,000.00", 6, ".", ",");
gd_ak74.attachFooter("&nbsp;,Total Records,#cspan,#stat_count,&nbsp;,&nbsp;,{#stat_total},&nbsp;");
//gd_ak74.splitAt(3);
gd_ak74.init();
loadGd_ak74();

function loadGd_ak74() {
         if(document.frmSearch_ak74.flt_tgl1_ak74.value != "") {
                tgl1 = replaceall(document.frmSearch_ak74.flt_tgl1_ak74.value,'/','-'); 		
	} else {
		tgl1 = 0;
	}
        if(document.frmSearch_ak74.flt_tgl2_ak74.value != "") {
                tgl2 = replaceall(document.frmSearch_ak74.flt_tgl2_ak74.value,'/','-'); 		
	} else {
		tgl2 = 0;
	}
	if(document.frmSearch_ak74.flt_no_voucher_ak74.value != "") {
		noVoucher = document.frmSearch_ak74.flt_no_voucher_ak74.value;
	} else {
		noVoucher = 0;
	}
        if(document.frmSearch_ak74.flt_customer_ak74.value != "") {
		customer = document.frmSearch_ak74.flt_customer_ak74.value;
	} else {
		customer = 0;
	}
        if(document.frmSearch_ak74.flt_ket_ak74.value != "") {
		ket = document.frmSearch_ak74.flt_ket_ak74.value;
	} else {
		ket = 0;
	}
	statusLoading();
        
	gd_ak74.clearAll();
	gd_ak74.loadXML(base_url+"index.php/saldo_awal/loadData_piutang/"+tgl1+"/"+tgl2+"/"+noVoucher+"/"+customer+"/"+ket,function(){            
            statusEnding();
        });
}

function refreshGd_ak74() {
	gd_ak74.updateFromXML(base_url+"index.php/saldo_awal/loadData_piutang", function(){
//            gd_ak74.groupBy(1);
        });
}



function window_ak74() {
w1_ak74 = dhxWins.createWindow("w1_ak74",0,0,500,350);
w1_ak74.setText("Saldo Awal Piutang");
w1_ak74.button("park").hide();
w1_ak74.button("minmax1").hide();
w1_ak74.center();       
w1_ak74.button("close").attachEvent("onClick", function() {
            w1_ak74.setModal(false);             
            w1_ak74.close();
            return;
});
w1_ak74.setModal(true);
        
tb_w1_ak74 = w1_ak74.attachToolbar();
tb_w1_ak74.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w1_ak74.setSkin("dhx_terrace");
tb_w1_ak74.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
tb_w1_ak74.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
tb_w1_ak74.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
tb_w1_ak74.disableItem("baru");
tb_w1_ak74.attachEvent("onclick", function(id) {
    if(id=='batal') {			
        document.frm_ak74.reset();			
    } else if(id=='save') {
        simpan_ak74();
    } else if(id=='baru') {
        tb_w1_ak74.disableItem("baru");
        tb_w1_ak74.enableItem("save");
        tb_w1_ak74.enableItem("batal");
        baru_ak74();
    }
});
}
        
function winForm_ak74(type) {
	idselect = gd_ak74.getRowIndex(gd_ak74.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window_ak74();
	if(type=='input') {
		w1_ak74.attachURL(base_url+"index.php/saldo_awal/form_piutang", true);
	} else {
                var rid = gd_ak74.cells(gd_ak74.getSelectedId(),1).getValue();                
		w1_ak74.attachURL(base_url+"index.php/saldo_awal/form_piutang_edit/"+rid, true);
	}
	
	

}

function hapus_ak74() {
		idselect = gd_ak74.getRowIndex(gd_ak74.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
                    var rid = gd_ak74.cells(gd_ak74.getSelectedId(),1).getValue();
			 poststr =
            	'id=' + rid
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/saldo_awal/hapus_piutang", encodeURI(poststr), function(loader) {
                                var resultdel = loader.xmlDoc.responseText;                                
				loadGd_ak74();
                                statusEnding();                                
			});
		}
	}

</script>


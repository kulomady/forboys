<?php

/*
 * hutang_index.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>

<div id="tmpTb_ak73" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<!--<div id="tmpGrid_ak73" style="height:485px;width: 100%"></div>-->
<div id="tmpLayout_ak73" style="position: relative; width: 100%; height: 92%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_ak73" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_ak73" name="frmSearch_ak73" method="post" action="javascript:void(0);">
    <table width="1100" border="0">
      <tr>
        <td width="70">Periode</td>
        <td width="300">
            <input type="input" name="flt_tgl1_ak73" id="flt_tgl1_ak73" tabindex="1" size="10" />
            <span><img id="btntgl1_ak73" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> 
            s/d
            <input type="input" name="flt_tgl2_ak73" id="flt_tgl2_ak73" tabindex="2" size="10" />
            <span><img id="btntgl2_ak73" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>                        
        </td>
        <td width="70">No Transaksi</td>
        <td width="168"><input type="text" name="flt_no_voucher_ak73" id="flt_no_voucher_ak73" /></td>       
      </tr>
      <tr>
        <td width="82">Keterangan</td>
        <td width="200"><input type="text" name="flt_ket_ak73" id="flt_ket_ak73" size="40" /></td>
         <td width="70">Supplier</td>
        <td width="168"><input type="text" name="flt_supplier_ak73" id="flt_supplier_ak73" /></td>
        <td width="100" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_ak73();" />
        <input type="button" name="button" id="button" value="RESET" onclick="frmSearch_ak73.reset();" />
        </td>        
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
cal1_ak73 = new dhtmlXCalendarObject({
    input: "flt_tgl1_ak73",button: "btntgl1_ak73"
});
cal1_ak73.setDateFormat("%d/%m/%Y");   

cal2_ak73 = new dhtmlXCalendarObject({
    input: "flt_tgl2_ak73",button: "btntgl2_ak73"
});
cal2_ak73.setDateFormat("%d/%m/%Y"); 

tb_ak73 = new dhtmlXToolbarObject("tmpTb_ak73");
tb_ak73.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_ak73.setSkin("dhx_terrace");
tb_ak73.attachEvent("onclick", tbClick_ak73);
tb_ak73.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_ak73 = new dhtmlXLayoutObject("tmpLayout_ak73", "2E");
dhxLayout_ak73.cells("a").setText("Cari Data");
dhxLayout_ak73.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_ak73.cells("a").setHeight(90);
dhxLayout_ak73.cells("a").collapse();
dhxLayout_ak73.cells("a").attachObject("tmpSearch_ak73");
dhxLayout_ak73.cells("b").setText("Site Navigation");
dhxLayout_ak73.cells("b").hideHeader();

function tbClick_ak73(id) {
	if(id=='new') {
		winForm_ak73('input');
	} else if(id=='edit') {
		winForm_ak73('edit');
	} else if(id=='del') {
		hapus_ak73();
	} else if(id=='cari') {
		if(dhxLayout_ak73.cells("a").isCollapsed()) {
			dhxLayout_ak73.cells("a").expand();
		} else {
			dhxLayout_ak73.cells("a").collapse();
		}
	}
}

//gd_ak73 = new dhtmlXGridObject('tmpGrid_ak73');
gd_ak73 = dhxLayout_ak73.cells("b").attachGrid();
gd_ak73.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ak73.setHeader("&nbsp;,No Transaksi,Supplier,Tgl,No Pembelian,Jatuh Tempo,Saldo,Keterangan",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ak73.setInitWidths("30,150,250,120,150,120,150,*");
gd_ak73.setColAlign("right,left,left,center,left,center,right,left");
gd_ak73.setColSorting("na,str,str,str,str,str,int,str");
gd_ak73.setColTypes("cntr,ro,ro,ro,ro,ro,ron,ro");
//gd_ak73.enableSmartRendering(true,50);
gd_ak73.setColumnColor("#CCE2FE");
gd_ak73.setSkin("dhx_skyblue");
gd_ak73.setNumberFormat("0,000.00", 6, ".", ",");
gd_ak73.attachFooter("&nbsp;,Total Records,#cspan,#stat_count,&nbsp;,&nbsp;,{#stat_total},&nbsp;");
//gd_ak73.splitAt(3);
gd_ak73.init();
loadGd_ak73();

function loadGd_ak73() {
         if(document.frmSearch_ak73.flt_tgl1_ak73.value != "") {
                tgl1 = replaceall(document.frmSearch_ak73.flt_tgl1_ak73.value,'/','-'); 		
	} else {
		tgl1 = 0;
	}
        if(document.frmSearch_ak73.flt_tgl2_ak73.value != "") {
                tgl2 = replaceall(document.frmSearch_ak73.flt_tgl2_ak73.value,'/','-'); 		
	} else {
		tgl2 = 0;
	}
	if(document.frmSearch_ak73.flt_no_voucher_ak73.value != "") {
		noVoucher = document.frmSearch_ak73.flt_no_voucher_ak73.value;
	} else {
		noVoucher = 0;
	}
        if(document.frmSearch_ak73.flt_supplier_ak73.value != "") {
		supplier = document.frmSearch_ak73.flt_supplier_ak73.value;
	} else {
		supplier = 0;
	}
        if(document.frmSearch_ak73.flt_ket_ak73.value != "") {
		ket = document.frmSearch_ak73.flt_ket_ak73.value;
	} else {
		ket = 0;
	}
	statusLoading();
        
	gd_ak73.clearAll();
	gd_ak73.loadXML(base_url+"index.php/saldo_awal/loadData_hutang/"+tgl1+"/"+tgl2+"/"+noVoucher+"/"+supplier+"/"+ket,function(){            
            statusEnding();
        });
}

function refreshGd_ak73() {
	gd_ak73.updateFromXML(base_url+"index.php/saldo_awal/loadData_hutang", function(){
//            gd_ak73.groupBy(1);
        });
}



function window_ak73() {
w1_ak73 = dhxWins.createWindow("w1_ak73",0,0,500,350);
w1_ak73.setText("Saldo Awal Hutang");
w1_ak73.button("park").hide();
w1_ak73.button("minmax1").hide();
w1_ak73.center();       
w1_ak73.button("close").attachEvent("onClick", function() {
            w1_ak73.setModal(false);             
            w1_ak73.close();
            return;
});
w1_ak73.setModal(true);
        
tb_w1_ak73 = w1_ak73.attachToolbar();
tb_w1_ak73.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_w1_ak73.setSkin("dhx_terrace");
tb_w1_ak73.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
tb_w1_ak73.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
tb_w1_ak73.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
tb_w1_ak73.disableItem("baru");
tb_w1_ak73.attachEvent("onclick", function(id) {
    if(id=='batal') {			
        document.frm_ak73.reset();			
    } else if(id=='save') {
        simpan_ak73();
    } else if(id=='baru') {
        tb_w1_ak73.disableItem("baru");
        tb_w1_ak73.enableItem("save");
        tb_w1_ak73.enableItem("batal");
        baru_ak73();
    }
});
}
        
function winForm_ak73(type) {
	idselect = gd_ak73.getRowIndex(gd_ak73.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window_ak73();
	if(type=='input') {
		w1_ak73.attachURL(base_url+"index.php/saldo_awal/form_hutang", true);
	} else {
                var rid = gd_ak73.cells(gd_ak73.getSelectedId(),1).getValue();                
		w1_ak73.attachURL(base_url+"index.php/saldo_awal/form_hutang_edit/"+rid, true);
	}
	
	

}

function hapus_ak73() {
		idselect = gd_ak73.getRowIndex(gd_ak73.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
                    var rid = gd_ak73.cells(gd_ak73.getSelectedId(),1).getValue();
			 poststr =
            	'id=' + rid
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/saldo_awal/hapus_hutang", encodeURI(poststr), function(loader) {
                                var resultdel = loader.xmlDoc.responseText;                                
				loadGd_ak73();
                                statusEnding();                                
			});
		}
	}

</script>

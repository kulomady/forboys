<?php

/*
 * akun_index.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>
<html>
    <body style="">
<div id="tmpTb_ak71" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="layout_group" style="position: relative; width:100%; height:80%; background-color:#B8E0F5;"></div>

<div id="obj_ak71_1" style="display: none;">            
    <div id="tmpGrid_ak71_1" style="width:100%; height: 510px;"></div>
</div> 
            
<div id="obj_ak71_2" style="display: none;">            
    <div id="tmpGrid_ak71_2" style="width:100%; height: 510px;"></div>
</div>

<table border="0" width="100%" style="background-color:#B8E0F5;">
    <tr>
        <td width="100px" align="right">
            <label><strong>TOTAL</strong></label> : 
            <input type="text" id="total_aktiva" name="total_aktiva" readonly="readonly" style="text-align: right;" />
        </td>
        <td width="100px" align="right">
            <label><strong>TOTAL</strong></label> : 
            <input type="text" id="total_modal_kewajiban" name="total_modal_kewajiban" readonly="readonly" style="text-align: right;" />
        </td>
    </tr>
</table>

<script language="javascript">
$(function() {             
    $('#total_aktiva').number(true, 0);
    $('#total_modal_kewajiban').number(true, 0);
});
        
var dhxLayout_ak71 = new dhtmlXLayoutObject("layout_group", "2U");
//dhxLayout_ak71.cells("a").hideHeader();
dhxLayout_ak71.cells("a").setText("Aktiva");
dhxLayout_ak71.cells("a").attachObject("obj_ak71_1");
dhxLayout_ak71.cells("a").fixSize(true, false);
//dhxLayout_ak71.cells("b").hideHeader();
dhxLayout_ak71.cells("b").setText("Kewajiban + Modal");
dhxLayout_ak71.cells("b").attachObject("obj_ak71_2");

            
tb_ak71 = new dhtmlXToolbarObject("tmpTb_ak71");
tb_ak71.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_ak71.setSkin("dhx_terrace");
tb_ak71.attachEvent("onclick", tbClick_ak71);
//tb_ak71.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php //echo $hak_toolbar; ?>
        tb_ak71.addButton("save", 0, "Save", "save.gif", "save_dis.gif");        
        tb_ak71.addButton("hitung", 1, "Cek Saldo Awal", "save.gif", "save_dis.gif");
//});

function tbClick_ak71(id) {
	if(id=='new') {
		winForm_ak71('input');
	} else if(id=='edit') {
		winForm_ak71('edit');
	} else if(id=='del') {
		hapus_ak71();
	} else if(id=='save') {
		save_ak71();
	} else if(id=='hitung') {
		hitung_ak71();
	}
}


var gd_ak71_1 = new dhtmlXGridObject('tmpGrid_ak71_1');
gd_ak71_1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ak71_1.setHeader("Kode,Nama Akun,Mata Uang,Saldo",null,
["text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ak71_1.setInitWidths("120,*,100,150");
gd_ak71_1.setColAlign("center,left,center,right");
gd_ak71_1.setColSorting("str,str,str,str");
gd_ak71_1.setColTypes("ro,ro,ro,edn");
//gd_ak71_1.enableSmartRendering(true,50);
gd_ak71_1.attachEvent("onEditCell",editCell1);
gd_ak71_1.setSkin("dhx_skyblue");
gd_ak71_1.setNumberFormat("0,000", 3, ".", ",");
gd_ak71_1.init();
loadGd_ak71_1();

function loadGd_ak71_1() {
	gd_ak71_1.clearAll();
	gd_ak71_1.loadXML(base_url+"index.php/saldo_awal/loadData_akun_aktiva",function(){            
            gd_ak71_1.forEachRow(function(id){
                if(gd_ak71_1.cells(id,3).getValue()==""){
                    gd_ak71_1.cells(id,3).setValue('0');
                }
            });
            total_ak71_1();
        });
}

function refreshGd_ak71_1() {
	gd_ak71_1.updateFromXML(base_url+"index.php/saldo_awal/loadData_akun_aktiva", function(){
            gd_ak71_1.forEachRow(function(id){
                if(gd_ak71_1.cells(id,3).getValue()==""){
                    gd_ak71_1.cells(id,3).setValue('0');
                }
            });
            total_ak71_1();
        });
}

function editCell1(stage,rId,cInd){
    if(stage=='2'){
        if(cInd=='3'){
            total_ak71_1();            
        }
    }
      return true;
}

var gd_ak71_2 = new dhtmlXGridObject('tmpGrid_ak71_2');
gd_ak71_2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ak71_2.setHeader("Kode,Nama Akun,Mata Uang,Saldo",null,
["text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ak71_2.setInitWidths("120,*,100,150");
gd_ak71_2.setColAlign("center,left,center,right");
gd_ak71_2.setColSorting("str,str,str,str");
gd_ak71_2.setColTypes("ro,ro,ro,edn");
//gd_ak71_2.enableSmartRendering(true,50);
gd_ak71_2.attachEvent("onEditCell",editCell2);
gd_ak71_2.setSkin("dhx_skyblue");
gd_ak71_2.setNumberFormat("0,000", 3, ".", ",");
gd_ak71_2.init();
loadGd_ak71_2();

function loadGd_ak71_2() {
	gd_ak71_2.clearAll();
	gd_ak71_2.loadXML(base_url+"index.php/saldo_awal/loadData_akun_modal_kewajiban",function(){            
            gd_ak71_2.forEachRow(function(id){
                if(gd_ak71_2.cells(id,3).getValue()==""){
                    gd_ak71_2.cells(id,3).setValue('0');
                }
            });
            total_ak71_2();
        });
}

function refreshGd_ak71_2() {
	gd_ak71_2.updateFromXML(base_url+"index.php/saldo_awal/loadData_akun_modal_kewajiban", function(){
            gd_ak71_2.forEachRow(function(id){
                if(gd_ak71_2.cells(id,3).getValue()==""){
                    gd_ak71_2.cells(id,3).setValue('0');
                }
            });
            total_ak71_2();
        });
}

function editCell2(stage,rId,cInd){
//    alert(rId);
    if(stage=='2' && cInd=='3'){
//        if(){
            total_ak71_2();            
//        }
    }
      return true;
}


function total_ak71_1(){
    var total = 0;      
    for (var i = 0; i < gd_ak71_1.getRowsNum(); i++) {        
        total += parseInt(gd_ak71_1.cells2(i,3).getValue());   
    }     
   $("#total_aktiva").val(total);    
}

function total_ak71_2(){
    var total = 0;      
    for (var i = 0; i < gd_ak71_2.getRowsNum(); i++) {        
        total += parseInt(gd_ak71_2.cells2(i,3).getValue());   
    }
    $("#total_modal_kewajiban").val(total);     
}

function save_ak71(){
    var ta = $('#total_aktiva').val();
    var tmk = $("#total_modal_kewajiban").val(); 
    if(ta != tmk){
        alert("Total Aktiva harus sama dengan Kewajiban ditambah Modal");
        return;
    }
    dataGrid = getData(gd_ak71_1,[1])+'~'+getData(gd_ak71_2,[1]);
    poststr = 'dataaktiva=' + dataGrid;
    statusLoading();
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/saldo_awal/simpan_akun", encodeURI(poststr), outputSimpan_ak71);
}

function outputSimpan_ak71(loader){
    result = loader.xmlDoc.responseText;    		
    refreshGd_ak71_1();
    refreshGd_ak71_2();
    alert("Saldo Awal Akun berhasil disimpan");
    statusEnding();
}

function hitung_ak71(){
    loadGd_ak71_1();
    loadGd_ak71_2();
}

</script>
    </body>
</html>
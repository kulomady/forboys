<div id="tmpTb_ku3" style="background-color:#B8E0F5; padding:2px; padding-bottom:0px;"></div>
<div id="tmpLayout_ku3" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_ku3" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_ku3" name="frmSearch_ku3" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="93">Tanggal</td>
        <td width="270"><input name="tgl1_ku3" type="text" id="tgl1_ku3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_ku3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
        <input name="tgl2_ku3" type="text" id="tgl2_ku3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_ku3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></td>
        <td width="93">CMT Cabang</td>
        <td width="182"><select name="slcOutlet_id" id="slcOutlet_id" style="width:150px;" onchange="loadCMT(this.value);">
      <?php echo $gudang; ?>
      </select></td>
        <td width="112"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_ku3();" />
        <input type="hidden" name="idselect" id="idselect" /></td>
        <td width="180">&nbsp;</td>
      </tr>
      <tr>
        <td>Project Order</td>
        <td id="tmpPO_ku3"></td>
        <td>CMT</td>
        <td><select name="cmt" id="cmt" style="width:140px;">
          <?php if(isset($cmt)): echo $cmt; endif; ?>
        </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" style="color:#F00;">Pilih Cabang untuk load CMT</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<script language="javascript">
calTgl1_ku3 = new dhtmlXCalendarObject({
	input: "tgl1_ku3",button: "btnTgl1_ku3"
});

calTgl2_ku3 = new dhtmlXCalendarObject({
	input: "tgl2_ku3",button: "btnTgl2_ku3"
});

var cbPO_ku3 = new dhtmlXCombo("tmpPO_ku3", "cbPO_ku3", 120);
cbPO_ku3.enableFilteringMode(true);
cbPO_ku3.clearAll();
cbPO_ku3.loadXML(base_url+"index.php/pembayaran_cmt/cbPO");


tb_ku3 = new dhtmlXToolbarObject("tmpTb_ku3");
tb_ku3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_ku3.setSkin("dhx_terrace");
tb_ku3.attachEvent("onclick", tbClick_ku3);
tb_ku3.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_ku3 = new dhtmlXLayoutObject("tmpLayout_ku3", "2E");
dhxLayout_ku3.cells("a").setText("Cari Data");
dhxLayout_ku3.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_ku3.cells("a").setHeight(100);
dhxLayout_ku3.cells("a").collapse();
dhxLayout_ku3.cells("a").attachObject("tmpSearch_ku3");
dhxLayout_ku3.cells("b").setText("Site Navigation");
dhxLayout_ku3.cells("b").hideHeader();


function tbClick_ku3(id) {
	if(id=='new') {
		winForm_ku3('input');
	} else if(id=='edit') {
		winForm_ku3('edit');
		//alert(gd_ku3.cells(gd_ku3.getSelectedId(),0).getSubGrid().getSelectedRowId());
		//alert(gd_ku3.cells(gd_ku3.getSelectedId(),0).getSubGrid().cells('A1',1).getValue());
	} else if(id=='del') {
		hapus_ku3();
	} else if(id=='refresh') {
		 loadGd_ku3();
	} else if(id=='print') {
		showWinCetak_ku3(gd_ku3.cells(gd_ku3.getSelectedId(),1).getValue());
	} else if(id=='cari') {
		if(dhxLayout_ku3.cells("a").isCollapsed()) {
			dhxLayout_ku3.cells("a").expand();
		} else {
			dhxLayout_ku3.cells("a").collapse();
		}
	}
}

function hapus_ku3() {
	idselect = gd_ku3.cells(gd_ku3.getSelectedId(),0).getSubGrid().getSelectedRowId();
	if(idselect == null) {
		alert("Tidak ada data pembayaran yang dipilih");
		return;
	}
		
	str = idselect.substr(0,1); 
	if(str=='C') {
		idrec = idselect.substr(1);
	} else {
		alert("Hanya Transaksi Pembayaran yang dapat dihapus");
		return;
	}
	
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		var postku3 = 
				'idrec=' + idrec;
		statusLoading();
		dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pembayaran_cmt/hapus", encodeURI(postku3), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_ku3.cells(gd_ku3.getSelectedId(),0).getSubGrid().deleteSelectedItem();			
				}
		});
	}
}

gd_ku3 = dhxLayout_ku3.cells("b").attachGrid();
gd_ku3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ku3.setHeader("&nbsp;,PO,Nama PO,Cabang,CMT,Lusin,Harga,Total,idcmt",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ku3.setInitWidths("30,80,120,180,150,120,100,100,0");
gd_ku3.setColAlign("right,left,left,left,left,right,right,right,right");
gd_ku3.setColTypes("sub_row,ro,ro,ro,ro,ron,ron,ron,ro");
gd_ku3.setNumberFormat("0,000",5,",",".");
gd_ku3.setNumberFormat("0,000",6,",",".");
gd_ku3.setNumberFormat("0,000",7,",",".");
gd_ku3.enableSmartRendering(true,50);
gd_ku3.setColumnColor("#CCE2FE");
gd_ku3.setSkin("dhx_skyblue");
gd_ku3.attachEvent("onSubGridLoaded",function(subgrid,id,index){
    this.setSelectedRow(id);
	document.frmSearch_ku3.idselect.value = id;
});
//gd_ku3.splitAt(1);
gd_ku3.init();

/* gd_ku3.attachEvent("onSubGridCreated",function(subgrid){
    subgrid.enableMultiselect(true);
    subgrid.enableEditEvents(false,false,false);
    return true; // mandatory!
}); */

loadGd_ku3();


function loadCMT(cabang) {
	var poststr =
            'cabang=' + cabang;
	document.getElementById("cmt").innerHTML = "Silahkan Tunggu..";   
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/terima_po/dataCMT", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		document.getElementById("cmt").innerHTML = "<option value=''></option>"+result;
	});
}
loadCMT(document.frmSearch_ku3.slcOutlet_id.value);

function loadGd_ku3() {
	
	tgl1 = document.frmSearch_ku3.tgl1_ku3.value;
	tgl2 = document.frmSearch_ku3.tgl2_ku3.value;
	
	if(cbPO_ku3.getSelectedValue() != null) {
		po = cbPO_ku3.getSelectedValue();
	} else {
		po = 0;
	}
	if(document.frmSearch_ku3.slcOutlet_id.value != "") {
		outlet_id = document.frmSearch_ku3.slcOutlet_id.value;
	} else {
		outlet_id = 0;
	}
	if(document.frmSearch_ku3.cmt.value != "") {
		cmt = document.frmSearch_ku3.cmt.value;
	} else {
		cmt = 0;
	}
	statusLoading();
	gd_ku3.clearAll();
	gd_ku3.loadXML(base_url+"index.php/pembayaran_cmt/loadMainData/"+tgl1+"/"+tgl2+"/"+po+"/"+outlet_id+"/"+cmt,function() {
		statusEnding();
	});
}

function loadSubGd_ku3() {
	idjo = gd_ku3.cells(gd_ku3.getSelectedId(),1).getValue();
	idrekan = gd_ku3.cells(gd_ku3.getSelectedId(),8).getValue();
	gd_ku3.cells(gd_ku3.getSelectedId(),0).getSubGrid().loadXML(base_url+"index.php/pembayaran_cmt/subGrid/"+idjo+"/"+idrekan);
}

function refreshSubGd_ku3() {
	idjo = gd_ku3.cells(gd_ku3.getSelectedId(),1).getValue();
	idrekan = gd_ku3.cells(gd_ku3.getSelectedId(),8).getValue();
	gd_ku3.cells(gd_ku3.getSelectedId(),0).getSubGrid().updateFromXML(base_url+"index.php/pembayaran_cmt/subGrid/"+idjo+"/"+idrekan);
}

function winForm_ku3(type) {
	idselect = gd_ku3.getRowIndex(gd_ku3.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	
	if(type=='edit') {
		idselect = gd_ku3.cells(gd_ku3.getSelectedId(),0).getSubGrid().getSelectedRowId();
		str = idselect.substr(0,1); 
		if(str=='C') {
				idrec = idselect.substr(1);
		} else {
				alert("Hanya Data Pembayaran yang dapat diubah");
				return;
		}	
	}
	w1_ku3 = dhxWins.createWindow("w1_ku3",0,0,470,250);
	w1_ku3.setText("Pembayaran CMT");
	w1_ku3.button("park").hide();
	w1_ku3.button("minmax1").hide();
	w1_ku3.center();
	w1_ku3.setModal(true);
	
	if(type=='input') {
		idjo = gd_ku3.cells(gd_ku3.getSelectedId(),1).getValue();
		w1_ku3.attachURL(base_url+"index.php/pembayaran_cmt/frm_input/"+gd_ku3.getSelectedId()+"/"+idjo, true);
	} else {
		w1_ku3.attachURL(base_url+"index.php/pembayaran_cmt/frm_edit/"+idrec, true);
	}
	
	w1_ku3.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_ku3.close();
		try { wCom_ku3.close(); } catch(e) {}
		return;
    });
	
	tb_w1_ku3 = w1_ku3.attachToolbar();
	tb_w1_ku3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_ku3.setSkin("dhx_terrace");
	//tb_w1_ku3.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_ku3.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	//tb_w1_ku3.disableItem("baru");
	tb_w1_ku3.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_ku3();
		} else if(id=='baru') {
			tb_w1_ku3.enableItem("baru");
			tb_w1_ku3.enableItem("save");
			baru_ku3();
		}
	});

}

</script>
<div id="tmpTb_pr6" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pr6" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pr6" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pr6" name="frmSearch_pr6" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="73">Periode</td>
        <td width="233"><input name="tgl1_pr6" type="text" id="tgl1_pr6" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pr6" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pr6" type="text" id="tgl2_pr6" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pr6" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td width="77">Tujuan</td>
        <td width="149"><select name="tujuan" id="tujuan" onchange="loadCMTIndex(this.value);" style="width:140px;">
      <?php echo $tujuan; ?>
      </select></td>
        <td width="402" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pr6();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Nama PO</td>
        <td><select name="po" id="po" style="width:140px;">
        <?php echo $pilihPO; ?>
      </select></td>
        <td>CMT</td>
        <td><select name="cmtIndex" id="cmtIndex" style="width:140px;">
        </select></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
function loadCMTIndex(cabang) {
	var poststr =
            'cabang=' + cabang;
	document.getElementById("cmtIndex").innerHTML = "Silahkan Tunggu..";   
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_po/dataCMT", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		document.getElementById("cmtIndex").innerHTML = result;
	});
}

calTgl1_pr6 = new dhtmlXCalendarObject({
	input: "tgl1_pr6",button: "btnTgl1_pr6"
});

calTgl2_pr6 = new dhtmlXCalendarObject({
	input: "tgl2_pr6",button: "btnTgl2_pr6"
});

tb_pr6 = new dhtmlXToolbarObject("tmpTb_pr6");
tb_pr6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr6.setSkin("dhx_terrace");
tb_pr6.attachEvent("onclick", tbClick_pr6);
tb_pr6.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pr6.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pr6 = new dhtmlXLayoutObject("tmpLayout_pr6", "2E");
dhxLayout_pr6.cells("a").setText("Cari Data");
dhxLayout_pr6.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pr6.cells("a").setHeight(85);
dhxLayout_pr6.cells("a").collapse();
dhxLayout_pr6.cells("a").attachObject("tmpSearch_pr6");
dhxLayout_pr6.cells("b").setText("Site Navigation");
dhxLayout_pr6.cells("b").hideHeader();

function tbClick_pr6(id) {
	if(id=='new') {
		winForm_pr6('input');
	} else if(id=='edit') {
		winForm_pr6('edit');
	} else if(id=='del') {
		hapus_pr6();
	} else if(id=='refresh') {
		loadGd_pr6();
	} else if(id=='print') {
		cetak_pr6();
	} else if(id=='cari') {
		if(dhxLayout_pr6.cells("a").isCollapsed()) {
			dhxLayout_pr6.cells("a").expand();
		} else {
			dhxLayout_pr6.cells("a").collapse();
		}
	}
}

gd_pr6 = dhxLayout_pr6.cells("b").attachGrid();
gd_pr6.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr6.setHeader("&nbsp;,No.Kirim,Tgl Kirim,Jenis Kirim,Dari,Tujuan,CMT,Jumlah,Dibuat Oleh,Tgl Buat",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr6.setInitWidths("30,100,80,100,100,150,150,80,120,120");
gd_pr6.setColAlign("right,left,left,left,left,left,left,left,left,left");
gd_pr6.setColSorting("na,str,str,str,str,str,str,str,str,str");
gd_pr6.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro");
//gd_pr6.enableSmartRendering(true,50);
gd_pr6.setColumnColor("#CCE2FE");
gd_pr6.setSkin("dhx_skyblue");
gd_pr6.splitAt(1);
gd_pr6.init();
loadGd_pr6();

function loadGd_pr6() {
	if(document.frmSearch_pr6.po.value=="") {
		po = "0";
	} else {
		po = document.frmSearch_pr6.po.value;
	}
	
	if(document.frmSearch_pr6.tujuan.value=="") {
		tujuan = "0";
	} else {
		tujuan = document.frmSearch_pr6.tujuan.value;
	}
	
	if(document.frmSearch_pr6.cmtIndex.value=="") {
		cmtIndex = "0";
	} else {
		cmtIndex = document.frmSearch_pr6.cmtIndex.value;
	}
	
	tglAwal = document.frmSearch_pr6.tgl1_pr6.value;
	tglAkhir = document.frmSearch_pr6.tgl2_pr6.value;
	statusLoading();
	gd_pr6.clearAll();
	gd_pr6.loadXML(base_url+"index.php/kirim_po/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+po+"/"+tujuan+"/"+cmtIndex,function(){
		statusEnding();
	});
}

function refreshGd_pr6() {
	if(document.frmSearch_pr6.po.value=="") {
		po = "0";
	} else {
		po = document.frmSearch_pr6.po.value;
	}
	
	if(document.frmSearch_pr6.tujuan.value=="") {
		tujuan = "0";
	} else {
		tujuan = document.frmSearch_pr6.tujuan.value;
	}
	
	if(document.frmSearch_pr6.cmtIndex.value=="") {
		cmtIndex = "0";
	} else {
		cmtIndex = document.frmSearch_pr6.cmtIndex.value;
	}
	
	tglAwal = document.frmSearch_pr6.tgl1_pr6.value;
	tglAkhir = document.frmSearch_pr6.tgl2_pr6.value;
	gd_pr6.updateFromXML(base_url+"index.php/kirim_po/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+po+"/"+tujuan+"/"+cmtIndex);
}

function winForm_pr6(type) {
	idselect = gd_pr6.getRowIndex(gd_pr6.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr6 = dhxWins.createWindow("w1_pr6",0,0,700,500);
	w1_pr6.setText("Kirim PO");
	w1_pr6.button("park").hide();
	w1_pr6.button("minmax1").hide();
	w1_pr6.center();
	w1_pr6.setModal(true);
	if(type=='input') {
		w1_pr6.attachURL(base_url+"index.php/kirim_po/frm_input", true);
	} else {
		w1_pr6.attachURL(base_url+"index.php/kirim_po/frm_edit/"+gd_pr6.getSelectedId(), true);
	}
	
	w1_pr6.button("close").attachEvent("onClick", function() {
	   	w1_pr6.close();
		try { w4_pr6.close(); } catch(e) { }
		return;
    });
	
	tb_w1_pr6 = w1_pr6.attachToolbar();
	tb_w1_pr6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr6.setSkin("dhx_terrace");
	tb_w1_pr6.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr6.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr6.disableItem("baru");
	tb_w1_pr6.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_pr6.reset();
		} else if(id=='save') {
			simpan_pr6();
		} else if(id=='baru') {
			tb_w1_pr6.disableItem("baru");
			tb_w1_pr6.enableItem("save");
			baru_pr6();
		}
	});

}

function hapus_pr6() {
	idselect = gd_pr6.getRowIndex(gd_pr6.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_pr6.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/kirim_po/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_pr6.deleteSelectedItem();
				//loadGd_pr6();
			});
		}
}

</script>
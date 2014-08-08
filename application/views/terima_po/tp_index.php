<div id="tmpTb_pr7" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pr7" style="position: relative; width: 100%; height: 100%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pr7" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pr7" name="frmSearch_pr7" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="73">Periode</td>
        <td width="233"><input name="tgl1_pr7" type="text" id="tgl1_pr7" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pr7" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pr7" type="text" id="tgl2_pr7" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pr7" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td width="77">Dari Cabang</td>
        <td width="149"><select name="tujuan" id="tujuan" onchange="loadCMTIndex(this.value);" style="width:140px;">
      <?php echo $tujuan; ?>
      </select></td>
        <td width="402" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pr7();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Nama PO</td>
        <td><select name="po" id="po" style="width:140px;">
        <option value=""></option>
        <?php echo $pilihPO; ?>
      </select></td>
        <td>Dari CMT</td>
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
    dhtmlxAjax.post("<?php echo base_url(); ?>index.php/terima_po/dataCMT", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		result = '<option value = ""></option>'+result;
		document.getElementById("cmtIndex").innerHTML = result;
	});
}

calTgl1_pr7 = new dhtmlXCalendarObject({
	input: "tgl1_pr7",button: "btnTgl1_pr7"
});

calTgl2_pr7 = new dhtmlXCalendarObject({
	input: "tgl2_pr7",button: "btnTgl2_pr7"
});

tb_pr7 = new dhtmlXToolbarObject("tmpTb_pr7");
tb_pr7.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr7.setSkin("dhx_terrace");
tb_pr7.attachEvent("onclick", tbClick_pr7);
tb_pr7.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pr7.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pr7 = new dhtmlXLayoutObject("tmpLayout_pr7", "2E");
dhxLayout_pr7.cells("a").setText("Cari Data");
dhxLayout_pr7.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pr7.cells("a").setHeight(85);
dhxLayout_pr7.cells("a").collapse();
dhxLayout_pr7.cells("a").attachObject("tmpSearch_pr7");
dhxLayout_pr7.cells("b").setText("Site Navigation");
dhxLayout_pr7.cells("b").hideHeader();

function tbClick_pr7(id) {
	if(id=='new') {
		winForm_pr7('input');
	} else if(id=='edit') {
		winForm_pr7('edit');
	} else if(id=='del') {
		hapus_pr7();
	} else if(id=='refresh') {
		loadGd_pr7();
	} else if(id=='print') {
		cetak_pr7();
	} else if(id=='cari') {
		if(dhxLayout_pr7.cells("a").isCollapsed()) {
			dhxLayout_pr7.cells("a").expand();
		} else {
			dhxLayout_pr7.cells("a").collapse();
		}
	}
}

gd_pr7 = dhxLayout_pr7.cells("b").attachGrid();
gd_pr7.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr7.setHeader("&nbsp;,No.Kirim,Tgl Kirim,Tujuan,Jenis Kirim,Dari Cabang,Dari CMT,Jml Pcs,Dibuat Oleh,Tgl Buat",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr7.setInitWidths("30,100,80,100,100,150,150,80,120,120");
gd_pr7.setColAlign("right,left,left,left,left,left,left,left,left,left");
gd_pr7.setColSorting("na,str,str,str,str,str,str,str,str,str");
gd_pr7.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro");
//gd_pr7.enableSmartRendering(true,50);
gd_pr7.setColumnColor("#CCE2FE");
gd_pr7.setSkin("dhx_skyblue");
gd_pr7.splitAt(1);
gd_pr7.init();
loadGd_pr7();

function loadGd_pr7() {
	if(document.frmSearch_pr7.po.value=="") {
		po = "0";
	} else {
		po = document.frmSearch_pr7.po.value;
	}
	
	if(document.frmSearch_pr7.tujuan.value=="") {
		tujuan = "0";
	} else {
		tujuan = document.frmSearch_pr7.tujuan.value;
	}
	
	if(document.frmSearch_pr7.cmtIndex.value=="") {
		cmtIndex = "0";
	} else {
		cmtIndex = document.frmSearch_pr7.cmtIndex.value;
	}
	
	tglAwal = document.frmSearch_pr7.tgl1_pr7.value;
	tglAkhir = document.frmSearch_pr7.tgl2_pr7.value;
	statusLoading();
	gd_pr7.clearAll();
	gd_pr7.loadXML(base_url+"index.php/terima_po/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+po+"/"+tujuan+"/"+cmtIndex,function(){
		statusEnding();
	});
}

function refreshGd_pr7() {
	if(document.frmSearch_pr7.po.value=="") {
		po = "0";
	} else {
		po = document.frmSearch_pr7.po.value;
	}
	
	if(document.frmSearch_pr7.tujuan.value=="") {
		tujuan = "0";
	} else {
		tujuan = document.frmSearch_pr7.tujuan.value;
	}
	
	if(document.frmSearch_pr7.cmtIndex.value=="") {
		cmtIndex = "0";
	} else {
		cmtIndex = document.frmSearch_pr7.cmtIndex.value;
	}
	
	tglAwal = document.frmSearch_pr7.tgl1_pr7.value;
	tglAkhir = document.frmSearch_pr7.tgl2_pr7.value;
	gd_pr7.updateFromXML(base_url+"index.php/terima_po/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+po+"/"+tujuan+"/"+cmtIndex);
}

function winForm_pr7(type) {
	idselect = gd_pr7.getRowIndex(gd_pr7.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr7 = dhxWins.createWindow("w1_pr7",0,0,710,460);
	w1_pr7.setText("Terima PO");
	w1_pr7.button("park").hide();
	w1_pr7.button("minmax1").hide();
	w1_pr7.center();
	w1_pr7.setModal(true);
	if(type=='input') {
		w1_pr7.attachURL(base_url+"index.php/terima_po/frm_input", true);
	} else {
		w1_pr7.attachURL(base_url+"index.php/terima_po/frm_edit/"+gd_pr7.getSelectedId(), true);
	}
	
	w1_pr7.button("close").attachEvent("onClick", function() {
	   	w1_pr7.close();
		try { w4_pr7.close(); } catch(e) { }
		return;
    });
	
	tb_w1_pr7 = w1_pr7.attachToolbar();
	tb_w1_pr7.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr7.setSkin("dhx_terrace");
	tb_w1_pr7.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr7.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr7.disableItem("baru");
	tb_w1_pr7.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_pr7.reset();
		} else if(id=='save') {
			simpan_pr7();
		} else if(id=='baru') {
			tb_w1_pr7.disableItem("baru");
			tb_w1_pr7.enableItem("save");
			baru_pr7();
		}
	});

}

function hapus_pr7() {
	idselect = gd_pr7.getRowIndex(gd_pr7.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_pr7.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/terima_po/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_pr7.deleteSelectedItem();
				//loadGd_pr7();
			});
		}
}

</script>
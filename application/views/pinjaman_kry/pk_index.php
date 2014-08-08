<div id="tmpTb_ku1" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_ku1" style="position: relative; width: 100%; height: 91%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_ku1" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_ku1" name="frmSearch_ku1" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="64">Periode</td>
        <td width="243"><input name="tgl1_ku1" type="text" id="tgl1_ku1" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_ku1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d 
          <input name="tgl2_ku1" type="text" id="tgl2_ku1" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_ku1" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></td>
        <td width="85">Karyawan</td>
        <td width="207" id="tmpIndexKry_ku1"></td>
        <td width="335"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_ku1();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_ku1 = new dhtmlXCalendarObject({
	input: "tgl1_ku1",button: "btnTgl1_ku1"
});

calTgl2_ku1 = new dhtmlXCalendarObject({
	input: "tgl2_ku1",button: "btnTgl2_ku1"
});

var cbIndKry_ku1 = new dhtmlXCombo("tmpIndexKry_ku1", "cbIndKry_ku1", 200);
cbIndKry_ku1.enableFilteringMode(true);
cbIndKry_ku1.clearAll();
cbIndKry_ku1.loadXML(base_url+"index.php/pinjaman_kry/cbKaryawan");
	
	
tb_ku1 = new dhtmlXToolbarObject("tmpTb_ku1");
tb_ku1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_ku1.setSkin("dhx_terrace");
tb_ku1.attachEvent("onclick", tbClick_ku1);
tb_ku1.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_ku1.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_ku1 = new dhtmlXLayoutObject("tmpLayout_ku1", "2E");
dhxLayout_ku1.cells("a").setText("Cari Data");
dhxLayout_ku1.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_ku1.cells("a").setHeight(60);
dhxLayout_ku1.cells("a").collapse();
dhxLayout_ku1.cells("a").attachObject("tmpSearch_ku1");
dhxLayout_ku1.cells("b").setText("Site Navigation");
dhxLayout_ku1.cells("b").hideHeader();

function tbClick_ku1(id) {
	if(id=='new') {
		winForm_ku1('input');
	} else if(id=='edit') {
		winForm_ku1('edit');
	} else if(id=='del') {
		hapus_ku1();
	} else if(id=='refresh') {
		loadGd_ku1();
	} else if(id=='print') {
		cetak_ku1();
	} else if(id=='cari') {
		if(dhxLayout_ku1.cells("a").isCollapsed()) {
			dhxLayout_ku1.cells("a").expand();
		} else {
			dhxLayout_ku1.cells("a").collapse();
		}
	}
}

gd_ku1 = dhxLayout_ku1.cells("b").attachGrid();
gd_ku1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_ku1.setHeader("&nbsp;,Kode,Nama Karyawan,Tanggal,Sisa Pinjaman,Pinjaman,Total Pinjaman,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_ku1.setInitWidths("30,80,150,100,100,100,120,120,100");
gd_ku1.setColAlign("right,left,left,left,right,right,right,left,left");
gd_ku1.setColSorting("na,str,str,str,str,str,str,str,str");
gd_ku1.setColTypes("cntr,ro,ro,ro,ron,ron,ron,ro,ro");
gd_ku1.setNumberFormat("0,000",4,",",".");
gd_ku1.setNumberFormat("0,000",5,",",".");
gd_ku1.setNumberFormat("0,000",6,",",".");
//gd_ku1.enableSmartRendering(true,50);
gd_ku1.setColumnColor("#CCE2FE");
gd_ku1.setSkin("dhx_skyblue");
gd_ku1.splitAt(1);
gd_ku1.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,#cspan");
gd_ku1.init();
loadGd_ku1();

function loadGd_ku1() {
	
	tgl1 = document.frmSearch_ku1.tgl1_ku1.value;
	tgl2 = document.frmSearch_ku1.tgl2_ku1.value;
	
	if(cbIndKry_ku1.getSelectedValue() == null) {
		idrekan = "0";
	} else {
		idrekan = cbIndKry_ku1.getSelectedValue();
	}
	
	statusLoading();
	gd_ku1.clearAll();
	gd_ku1.loadXML(base_url+"index.php/pinjaman_kry/loadMainData/"+tgl1+"/"+tgl2+"/"+idrekan,function(){
		statusEnding();
	});
}

function refreshGd_ku1() {
	tgl1 = document.frmSearch_ku1.tgl1_ku1.value;
	tgl2 = document.frmSearch_ku1.tgl2_ku1.value;
	
	if(cbIndKry_ku1.getSelectedValue() == null) {
		idrekan = "0";
	} else {
		idrekan = cbIndKry_ku1.getSelectedValue();
	}
	gd_ku1.updateFromXML(base_url+"index.php/pinjaman_kry/loadMainData/"+tgl1+"/"+tgl2+"/"+idrekan);
}

function winForm_ku1(type) {
	idselect = gd_ku1.getRowIndex(gd_ku1.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_ku1 = dhxWins.createWindow("w1_ku1",0,0,350,270);
	w1_ku1.setText("Pinjaman Karyawan");
	w1_ku1.button("park").hide();
	w1_ku1.button("minmax1").hide();
	w1_ku1.center();
	w1_ku1.setModal(true);
	if(type=='input') {
		w1_ku1.attachURL(base_url+"index.php/pinjaman_kry/frm_input", true);
	} else {
		w1_ku1.attachURL(base_url+"index.php/pinjaman_kry/frm_edit/"+gd_ku1.getSelectedId(), true);
	}
	
	tb_w1_ku1 = w1_ku1.attachToolbar();
	tb_w1_ku1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_ku1.setSkin("dhx_terrace");
	tb_w1_ku1.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_ku1.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_ku1.disableItem("baru");
	tb_w1_ku1.attachEvent("onclick", function(id) {
		if(id=='batal') {
			document.frm_ku1.reset();
		} else if(id=='save') {
			simpan_ku1();
		} else if(id=='baru') {
			tb_w1_ku1.disableItem("baru");
			tb_w1_ku1.enableItem("save");
			baru_ku1();
		}
	});

}

function hapus_ku1() {
	idselect = gd_ku1.getRowIndex(gd_ku1.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_ku1.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pinjaman_kry/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_ku1.deleteSelectedItem();
				//loadGd_ku1();
			});
		}
}

</script>
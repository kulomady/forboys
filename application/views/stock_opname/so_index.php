<div id="tmpTb_pd5" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pd5" style="position: relative; width: 100%; height: 100%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pd5" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pd5" name="frmSearch_pd5" method="post" action="javascript:void(0);">
    <table width="704" border="0">
      <tr>
        <td width="83">No. Opname</td>
        <td width="242"><input type="text" name="no_opname" id="no_opname" /></td>
        <td width="103">Gudang Asal</td>
        <td width="168"><select name="slcAsal" id="slcAsal" style=" width:150px;">
          <?php echo $gudang; ?>
                </select></td>
        <td width="86" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pd5();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Periode</td>
        <td><input name="tgl1_pd5" type="text" id="tgl1_pd5" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pd5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pd5" type="text" id="tgl2_pd5" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pd5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td>Keterangan</td>
        <td><input type="text" name="ket" id="ket" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_pd5 = new dhtmlXCalendarObject({
	input: "tgl1_pd5",button: "btnTgl1_pd5"
});

calTgl2_pd5 = new dhtmlXCalendarObject({
	input: "tgl2_pd5",button: "btnTgl2_pd5"
});


tb_pd5 = new dhtmlXToolbarObject("tmpTb_pd5");
tb_pd5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pd5.setSkin("dhx_terrace");
tb_pd5.attachEvent("onclick", tbClick_pd5);
tb_pd5.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pd5 = new dhtmlXLayoutObject("tmpLayout_pd5", "2E");
dhxLayout_pd5.cells("a").setText("Cari Data");
dhxLayout_pd5.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pd5.cells("a").setHeight(85);
dhxLayout_pd5.cells("a").collapse();
dhxLayout_pd5.cells("a").attachObject("tmpSearch_pd5");
dhxLayout_pd5.cells("b").setText("Site Navigation");
dhxLayout_pd5.cells("b").hideHeader();

function tbClick_pd5(id) {
	if(id=='new') {
		winForm_pd5('input');
	} else if(id=='edit') {
		winForm_pd5('edit');
	} else if(id=='del') {
		hapus_pd5();
	} else if(id=='refresh') {
		 loadGd_pd5();
	} else if(id=='print') {
		cetak_pd5();
	} else if(id=='cari') {
		if(dhxLayout_pd5.cells("a").isCollapsed()) {
			dhxLayout_pd5.cells("a").expand();
		} else {
			dhxLayout_pd5.cells("a").collapse();
		}
	}
}

gd_pd5 = dhxLayout_pd5.cells("b").attachGrid();
gd_pd5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pd5.setHeader("&nbsp;,No.Transfer,Tanggal,ID Gudang,Nama Gudang,Keterangan,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pd5.setInitWidths("30,100,70,80,150,180,100,100");
gd_pd5.setColAlign("right,left,left,left,left,left,left,left");
gd_pd5.setColSorting("na,int,str,str,int,int,date,str,str");
gd_pd5.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pd5.enableSmartRendering(true,50);
gd_pd5.setColumnColor("#CCE2FE");
gd_pd5.setSkin("dhx_skyblue");
gd_pd5.splitAt(1);
gd_pd5.init();
loadGd_pd5();

function loadGd_pd5() {
	tglAwal = document.frmSearch_pd5.tgl1_pd5.value;
	tglAkhir = document.frmSearch_pd5.tgl2_pd5.value;
	
	if(document.frmSearch_pd5.slcAsal.value=="") {
		asal = 0;
	} else {
		asal = document.frmSearch_pd5.slcAsal.value;
	}
	if(document.frmSearch_pd5.no_opname.value=="") {
		no_opname = 0;
	} else {
		no_opname = document.frmSearch_pd5.no_opname.value;
	}
	if(document.frmSearch_pd5.ket.value=="") {
		ket = 0;
	} else {
		ket = document.frmSearch_pd5.ket.value;
	}
	gd_pd5.clearAll();
	statusLoading();
	gd_pd5.clearAll();
	gd_pd5.loadXML(base_url+"index.php/stock_opname/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+asal+"/"+no_opname+"/"+ket,function() {
		statusEnding();
	});
}

function refreshGd_pd5() {
	tglAwal = document.frmSearch_pd5.tgl1_pd5.value;
	tglAkhir = document.frmSearch_pd5.tgl2_pd5.value;
	
	if(document.frmSearch_pd5.slcAsal.value=="") {
		asal = 0;
	} else {
		asal = document.frmSearch_pd5.slcAsal.value;
	}
	if(document.frmSearch_pd5.no_opname.value=="") {
		no_opname = 0;
	} else {
		no_opname = document.frmSearch_pd5.no_opname.value;
	}
	if(document.frmSearch_pd5.ket.value=="") {
		ket = 0;
	} else {
		ket = document.frmSearch_pd5.ket.value;
	}
	gd_pd5.updateFromXML(base_url+"index.php/stock_opname/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+asal+"/"+no_opname+"/"+ket);
}

function winForm_pd5(type) {
	idselect = gd_pd5.getRowIndex(gd_pd5.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pd5 = dhxWins.createWindow("w1_pd5",0,0,800,580);
	w1_pd5.setText("Stock Opname");
	w1_pd5.button("park").hide();
	w1_pd5.button("minmax1").hide();
	w1_pd5.center();
	w1_pd5.setModal(true);
	if(type=='input') {
		w1_pd5.attachURL(base_url+"index.php/stock_opname/frm_input", true);
	} else {
		w1_pd5.attachURL(base_url+"index.php/stock_opname/frm_edit/"+gd_pd5.getSelectedId(), true);
	}
	
	w1_pd5.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pd5.close();
		return;
    });
	
	tb_w1_pd5 = w1_pd5.attachToolbar();
	tb_w1_pd5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pd5.setSkin("dhx_terrace");
	tb_w1_pd5.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pd5.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pd5.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pd5();
		} else if(id=='baru') {
			tb_w1_pd5.enableItem("baru");
			tb_w1_pd5.enableItem("save");
			baru_pd5();
		}
	});

}

function hapus_pd5() {
		idselect = gd_pd5.getRowIndex(gd_pd5.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pd5.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/stock_opname/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pd5.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}
	
function cetak_pd5() {
	
	tglOpname = gd_pd5.cells(gd_pd5.getSelectedId(),2).getValue();
	gudangAsal = gd_pd5.cells(gd_pd5.getSelectedId(),3).getValue();
	tipe = null;
	jns = null;
	kat = null;
	merk = null;
	warna = null;
	tmpUkuran = 1;
	type = "HTML";
	
	url = base_url+'index.php/report_stock/opname/'+tglOpname+"/"+gudangAsal+"/"+tipe+"/"+jns+"/"+kat+"/"+merk+"/"+warna+"/"+tmpUkuran+"/"+type;
	
	window.open(url,'_blank');
}

</script>

<div id="tmpTb_pd4" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pd4" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pd4" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pd4" name="frmSearch_pd4" method="post" action="javascript:void(0);">
    <table width="704" border="0">
      <tr>
        <td width="83">Periode</td>
        <td width="242"><input name="tgl1_pd4" type="text" id="tgl1_pd4" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_pd4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
          <input name="tgl2_pd4" type="text" id="tgl2_pd4" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_pd4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td width="103">Gudang Asal</td>
        <td width="168"><select name="slcAsal" id="slcAsal" style=" width:150px;">
          <?php echo $dari; ?>
                </select></td>
        <td width="86" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pd4();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td><input type="text" name="txtKet" id="txtKet" /></td>
        <td>Gudang Tujuan</td>
        <td><select name="slcTujuan" id="slcTujuan" style=" width:150px;">
          <?php echo $tujuan; ?>
                </select></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_pd4 = new dhtmlXCalendarObject({
	input: "tgl1_pd4",button: "btnTgl1_pd4"
});

calTgl2_pd4 = new dhtmlXCalendarObject({
	input: "tgl2_pd4",button: "btnTgl2_pd4"
});
	
tb_pd4 = new dhtmlXToolbarObject("tmpTb_pd4");
tb_pd4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pd4.setSkin("dhx_terrace");
tb_pd4.attachEvent("onclick", tbClick_pd4);
tb_pd4.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
	tb_pd4.hideItem("print");
});

dhxLayout_pd4 = new dhtmlXLayoutObject("tmpLayout_pd4", "2E");
dhxLayout_pd4.cells("a").setText("Cari Data");
dhxLayout_pd4.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pd4.cells("a").setHeight(85);
dhxLayout_pd4.cells("a").collapse();
dhxLayout_pd4.cells("a").attachObject("tmpSearch_pd4");
dhxLayout_pd4.cells("b").setText("Site Navigation");
dhxLayout_pd4.cells("b").hideHeader();

function tbClick_pd4(id) {
	if(id=='new') {
		winForm_pd4('input');
	} else if(id=='edit') {
		winForm_pd4('edit');
	} else if(id=='del') {
		hapus_pd4();
	}  else if(id=='refresh') {
		 loadGd_pd4();
	} else if(id=='print') {
		cetak_pd4();
	} else if(id=='cari') {
		if(dhxLayout_pd4.cells("a").isCollapsed()) {
			dhxLayout_pd4.cells("a").expand();
		} else {
			dhxLayout_pd4.cells("a").collapse();
		}
	}
}

gd_pd4 = dhxLayout_pd4.cells("b").attachGrid();
gd_pd4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pd4.setHeader("&nbsp;,No.Terima,Tanggal,ID Gudang,Nama Gudang,ID Tujuan,Nama Tujuan,Keterangan,Supir,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pd4.setInitWidths("30,100,70,80,150,80,150,150,100,100,100");
gd_pd4.setColAlign("right,left,left,left,left,left,left,left,left,left,left");
gd_pd4.setColSorting("na,int,str,str,int,int,str,date,date,str,str");
gd_pd4.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pd4.enableSmartRendering(true,50);
gd_pd4.setColumnColor("#CCE2FE");
gd_pd4.setSkin("dhx_skyblue");
gd_pd4.splitAt(1);
gd_pd4.init();
loadGd_pd4();

function loadGd_pd4() {
	if(document.frmSearch_pd4.tgl1_pd4.value=="") {
		alert("Tanggal Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frmSearch_pd4.tgl2_pd4.value=="") {
		alert("Tanggal Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frmSearch_pd4.tgl1_pd4.value;
	tglAkhir = document.frmSearch_pd4.tgl2_pd4.value;
	
	if(document.frmSearch_pd4.slcAsal.value=="") {
		asal = 0;
	} else {
		asal = document.frmSearch_pd4.slcAsal.value;
	}
	if(document.frmSearch_pd4.slcTujuan.value=="") {
		tujuan = 0;
	} else {
		tujuan = document.frmSearch_pd4.slcTujuan.value;
	}
	if(document.frmSearch_pd4.txtKet.value=="") {
		ket = 0;
	} else {
		ket = document.frmSearch_pd4.txtKet.value;
	}
	gd_pd4.clearAll();
	statusLoading();
	gd_pd4.loadXML(base_url+"index.php/penerimaan_barang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+asal+"/"+tujuan+"/"+ket,function() {
		statusEnding();
	});
}

function refreshGd_pd4() {
	if(document.frmSearch_pd4.tgl1_pd4.value=="") {
		alert("Tanggal Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frmSearch_pd4.tgl2_pd4.value=="") {
		alert("Tanggal Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frmSearch_pd4.tgl1_pd4.value;
	tglAkhir = document.frmSearch_pd4.tgl2_pd4.value;
	
	if(document.frmSearch_pd4.slcAsal.value=="") {
		asal = 0;
	} else {
		asal = document.frmSearch_pd4.slcAsal.value;
	}
	if(document.frmSearch_pd4.slcTujuan.value=="") {
		tujuan = 0;
	} else {
		tujuan = document.frmSearch_pd4.slcTujuan.value;
	}
	if(document.frmSearch_pd4.txtKet.value=="") {
		ket = 0;
	} else {
		ket = document.frmSearch_pd4.txtKet.value;
	}
	gd_pd4.updateFromXML(base_url+"index.php/penerimaan_barang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+asal+"/"+tujuan+"/"+ket);
}

function winForm_pd4(type) {
	idselect = gd_pd4.getRowIndex(gd_pd4.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pd4 = dhxWins.createWindow("w1_pd4",0,0,900,610);
	w1_pd4.setText("Penerimaan Barang");
	w1_pd4.button("park").hide();
	w1_pd4.button("minmax1").hide();
	w1_pd4.center();
	w1_pd4.setModal(true);
	if(type=='input') {
		w1_pd4.attachURL(base_url+"index.php/penerimaan_barang/frm_input", true);
	} else {
		w1_pd4.attachURL(base_url+"index.php/penerimaan_barang/frm_edit/"+gd_pd4.getSelectedId(), true);
	}
	
	w1_pd4.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pd4.close();
		return;
    });
	
	tb_w1_pd4 = w1_pd4.attachToolbar();
	tb_w1_pd4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pd4.setSkin("dhx_terrace");
	tb_w1_pd4.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pd4.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	//tb_w1_pd4.disableItem("baru");
	tb_w1_pd4.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_pd4 = document.frm_pd4.hKp_pd4.value;
			var kota_pd4 = document.frm_pd4.hKota_pd4.value;
			document.frm_pd4.reset();
			// Kantor Pusat
			IDcbKP_pd4 = cbKP_pd4.getIndexByValue(kp_pd4);
			cbKP_pd4.selectOption(IDcbKP_pd4,true,true);
			// Kota
			IDcbKota_pd4 = cbKota_pd4.getIndexByValue(kota_pd4);
			cbKota_pd4.selectOption(IDcbKota_pd4,true,true);
		} else if(id=='save') {
			simpan_pd4();
		} else if(id=='baru') {
			tb_w1_pd4.disableItem("baru");
			tb_w1_pd4.enableItem("save");
			baru_pd4();
		}
	});

}

function hapus_pd4() {
		idselect = gd_pd4.getRowIndex(gd_pd4.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pd4.cells(gd_pd4.getSelectedId(),1).getValue();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/penerimaan_barang/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pd4.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}
	
function cetak_pd4() {
	idselect = gd_pd4.getRowIndex(gd_pd4.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window.open(base_url+'index.php/penerimaan_barang/cetak_sj/'+gd_pd4.getSelectedId(),'_blank');
}

</script>
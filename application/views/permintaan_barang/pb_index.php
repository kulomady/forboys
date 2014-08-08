<div id="tmpTb_pd2" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pd2" style="position: relative; width: 100%; height: 100%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pd2" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pd2" name="frmSearch_pd2" method="post" action="javascript:void(0);">
    <table width="704" border="0">
      <tr>
        <td width="83">Periode</td>
        <td width="242"><input name="tgl1_pd2" type="text" id="tgl1_pd2" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_pd2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
          <input name="tgl2_pd2" type="text" id="tgl2_pd2" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_pd2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td width="103">Gudang Asal</td>
        <td width="168"><select name="slcAsal" id="slcAsal" style=" width:150px;">
          <?php echo $gudang; ?>
                </select></td>
        <td width="86" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pd2();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td><input type="text" name="txtKet" id="txtKet" /></td>
        <td>Gudang Tujuan</td>
        <td><select name="slcTujuan" id="slcTujuan" style=" width:150px;">
          <?php echo $gudang; ?>
                </select></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_pd2 = new dhtmlXCalendarObject({
	input: "tgl1_pd2",button: "btnTgl1_pd2"
});

calTgl2_pd2 = new dhtmlXCalendarObject({
	input: "tgl2_pd2",button: "btnTgl2_pd2"
});
	
tb_pd2 = new dhtmlXToolbarObject("tmpTb_pd2");
tb_pd2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pd2.setSkin("dhx_terrace");
tb_pd2.attachEvent("onclick", tbClick_pd2);
tb_pd2.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pd2 = new dhtmlXLayoutObject("tmpLayout_pd2", "2E");
dhxLayout_pd2.cells("a").setText("Cari Data");
dhxLayout_pd2.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pd2.cells("a").setHeight(85);
dhxLayout_pd2.cells("a").collapse();
dhxLayout_pd2.cells("a").attachObject("tmpSearch_pd2");
dhxLayout_pd2.cells("b").setText("Site Navigation");
dhxLayout_pd2.cells("b").hideHeader();

function tbClick_pd2(id) {
	if(id=='new') {
		winForm_pd2('input');
	} else if(id=='edit') {
		winForm_pd2('edit');
	} else if(id=='del') {
		hapus_pd2();
	}  else if(id=='refresh') {
		 loadGd_pd2();
	} else if(id=='print') {
		cetak_pd2();
	} else if(id=='cari') {
		if(dhxLayout_pd2.cells("a").isCollapsed()) {
			dhxLayout_pd2.cells("a").expand();
		} else {
			dhxLayout_pd2.cells("a").collapse();
		}
	}
}

gd_pd2 = dhxLayout_pd2.cells("b").attachGrid();
gd_pd2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pd2.setHeader("&nbsp;,No.LPP,Lokasi,Tanggal,Supplier,Tgl Buat,Dibuat Oleh,Tgl Modifikasi,Dimodifikasi Oleh,flag",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pd2.setInitWidths("30,130,150,100,150,130,130,150,130,0");
gd_pd2.setColAlign("right,left,left,left,left,left,left,left,left,left,left");
gd_pd2.setColSorting("na,int,str,int,str,date,date,str,str,str,str");
gd_pd2.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pd2.enableSmartRendering(true,50);
gd_pd2.setColumnColor("#CCE2FE");
gd_pd2.setSkin("dhx_skyblue");
gd_pd2.splitAt(1);
gd_pd2.init();
loadGd_pd2();

function loadGd_pd2() {
	if(document.frmSearch_pd2.tgl1_pd2.value=="") {
		alert("Tanggal Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frmSearch_pd2.tgl2_pd2.value=="") {
		alert("Tanggal Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frmSearch_pd2.tgl1_pd2.value;
	tglAkhir = document.frmSearch_pd2.tgl2_pd2.value;
	
	if(document.frmSearch_pd2.slcAsal.value=="") {
		asal = 0;
	} else {
		asal = document.frmSearch_pd2.slcAsal.value;
	}
	if(document.frmSearch_pd2.slcTujuan.value=="") {
		tujuan = 0;
	} else {
		tujuan = document.frmSearch_pd2.slcTujuan.value;
	}
	if(document.frmSearch_pd2.txtKet.value=="") {
		ket = 0;
	} else {
		ket = document.frmSearch_pd2.txtKet.value;
	}
	gd_pd2.clearAll();
	statusLoading();
	gd_pd2.loadXML(base_url+"index.php/permintaan_barang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+asal+"/"+tujuan+"/"+ket,function() {
		statusEnding();
	});
}

function refreshGd_pd2() {
	gd_pd2.updateFromXML(base_url+"index.php/permintaan_barang/loadMainData");
}

function winForm_pd2(type) {
	idselect = gd_pd2.getRowIndex(gd_pd2.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pd2 = dhxWins.createWindow("w1_pd2",0,0,1000,610);
	w1_pd2.setText("Transfer Barang");
	w1_pd2.button("park").hide();
	w1_pd2.button("minmax1").hide();
	w1_pd2.center();
	w1_pd2.setModal(true);
	if(type=='input') {
		w1_pd2.attachURL(base_url+"index.php/permintaan_barang/frm_input", true);
	} else {
		w1_pd2.attachURL(base_url+"index.php/permintaan_barang/frm_edit/"+gd_pd2.getSelectedId(), true);
	}
	
	w1_pd2.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pd2.close();
		return;
    });
	
	tb_w1_pd2 = w1_pd2.attachToolbar();
	tb_w1_pd2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pd2.setSkin("dhx_terrace");
	tb_w1_pd2.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pd2.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pd2.disableItem("baru");
	tb_w1_pd2.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_pd2 = document.frm_pd2.hKp_pd2.value;
			var kota_pd2 = document.frm_pd2.hKota_pd2.value;
			document.frm_pd2.reset();
			// Kantor Pusat
			IDcbKP_pd2 = cbKP_pd2.getIndexByValue(kp_pd2);
			cbKP_pd2.selectOption(IDcbKP_pd2,true,true);
			// Kota
			IDcbKota_pd2 = cbKota_pd2.getIndexByValue(kota_pd2);
			cbKota_pd2.selectOption(IDcbKota_pd2,true,true);
		} else if(id=='save') {
			simpan_pd2();
		} else if(id=='baru') {
			tb_w1_pd2.disableItem("baru");
			tb_w1_pd2.enableItem("save");
			baru_pd2();
		}
	});

}

function hapus_pd2() {
		idselect = gd_pd2.getRowIndex(gd_pd2.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pd2.cells(gd_pd2.getSelectedId(),1).getValue();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/permintaan_barang/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pd2.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}
	
function cetak_pd2() {
	idselect = gd_pd2.getRowIndex(gd_pd2.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window.open(base_url+'index.php/permintaan_barang/cetak_sj/'+gd_pd2.getSelectedId(),'_blank');
}

</script>
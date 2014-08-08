<div id="tmpTb_pd3" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pd3" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pd3" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pd3" name="frmSearch_pd3" method="post" action="javascript:void(0);">
    <table width="704" border="0">
      <tr>
        <td width="83">Periode</td>
        <td width="242"><input name="tgl1_pd3" type="text" id="tgl1_pd3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_pd3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
          <input name="tgl2_pd3" type="text" id="tgl2_pd3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_pd3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td width="103">Gudang Asal</td>
        <td width="168"><select name="slcAsal" id="slcAsal" style=" width:150px;">
          <?php echo $gudang; ?>
                </select></td>
        <td width="86" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pd3();" style="width:100px; height:40px;" /></td>
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
calTgl1_pd3 = new dhtmlXCalendarObject({
	input: "tgl1_pd3",button: "btnTgl1_pd3"
});

calTgl2_pd3 = new dhtmlXCalendarObject({
	input: "tgl2_pd3",button: "btnTgl2_pd3"
});
	
tb_pd3 = new dhtmlXToolbarObject("tmpTb_pd3");
tb_pd3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pd3.setSkin("dhx_terrace");
tb_pd3.attachEvent("onclick", tbClick_pd3);
tb_pd3.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pd3 = new dhtmlXLayoutObject("tmpLayout_pd3", "2E");
dhxLayout_pd3.cells("a").setText("Cari Data");
dhxLayout_pd3.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pd3.cells("a").setHeight(85);
dhxLayout_pd3.cells("a").collapse();
dhxLayout_pd3.cells("a").attachObject("tmpSearch_pd3");
dhxLayout_pd3.cells("b").setText("Site Navigation");
dhxLayout_pd3.cells("b").hideHeader();

function tbClick_pd3(id) {
	if(id=='new') {
		winForm_pd3('input');
	} else if(id=='edit') {
		winForm_pd3('edit');
	} else if(id=='del') {
		hapus_pd3();
	}  else if(id=='refresh') {
		 loadGd_pd3();
	} else if(id=='print') {
		cetak_pd3();
	} else if(id=='cari') {
		if(dhxLayout_pd3.cells("a").isCollapsed()) {
			dhxLayout_pd3.cells("a").expand();
		} else {
			dhxLayout_pd3.cells("a").collapse();
		}
	}
}

gd_pd3 = dhxLayout_pd3.cells("b").attachGrid();
gd_pd3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pd3.setHeader("&nbsp;,No.Transfer,Tanggal,ID Gudang,Nama Gudang,ID Tujuan,Nama Tujuan,Keterangan,Supir,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pd3.setInitWidths("30,100,70,80,150,80,150,150,100,100,100");
gd_pd3.setColAlign("right,left,left,left,left,left,left,left,left,left,left");
gd_pd3.setColSorting("na,int,str,str,int,int,str,date,date,str,str");
gd_pd3.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pd3.enableSmartRendering(true,50);
gd_pd3.setColumnColor("#CCE2FE");
gd_pd3.setSkin("dhx_skyblue");
gd_pd3.splitAt(1);
gd_pd3.init();
loadGd_pd3();

function loadGd_pd3() {
	if(document.frmSearch_pd3.tgl1_pd3.value=="") {
		alert("Tanggal Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frmSearch_pd3.tgl2_pd3.value=="") {
		alert("Tanggal Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frmSearch_pd3.tgl1_pd3.value;
	tglAkhir = document.frmSearch_pd3.tgl2_pd3.value;
	
	if(document.frmSearch_pd3.slcAsal.value=="") {
		asal = 0;
	} else {
		asal = document.frmSearch_pd3.slcAsal.value;
	}
	if(document.frmSearch_pd3.slcTujuan.value=="") {
		tujuan = 0;
	} else {
		tujuan = document.frmSearch_pd3.slcTujuan.value;
	}
	if(document.frmSearch_pd3.txtKet.value=="") {
		ket = 0;
	} else {
		ket = document.frmSearch_pd3.txtKet.value;
	}
	gd_pd3.clearAll();
	statusLoading();
	gd_pd3.loadXML(base_url+"index.php/transfer_barang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+asal+"/"+tujuan+"/"+ket,function() {
		statusEnding();
	});
}

function refreshGd_pd3() {
	if(document.frmSearch_pd3.tgl1_pd3.value=="") {
		alert("Tanggal Awal Tidak Boleh Kosong");
		return;
	}
	if(document.frmSearch_pd3.tgl2_pd3.value=="") {
		alert("Tanggal Akhir Tidak Boleh Kosong");
		return;
	}
	tglAwal = document.frmSearch_pd3.tgl1_pd3.value;
	tglAkhir = document.frmSearch_pd3.tgl2_pd3.value;
	
	if(document.frmSearch_pd3.slcAsal.value=="") {
		asal = 0;
	} else {
		asal = document.frmSearch_pd3.slcAsal.value;
	}
	if(document.frmSearch_pd3.slcTujuan.value=="") {
		tujuan = 0;
	} else {
		tujuan = document.frmSearch_pd3.slcTujuan.value;
	}
	if(document.frmSearch_pd3.txtKet.value=="") {
		ket = 0;
	} else {
		ket = document.frmSearch_pd3.txtKet.value;
	}
	gd_pd3.updateFromXML(base_url+"index.php/transfer_barang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+asal+"/"+tujuan+"/"+ket);
}

function winForm_pd3(type) {
	idselect = gd_pd3.getRowIndex(gd_pd3.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pd3 = dhxWins.createWindow("w1_pd3",0,0,1000,610);
	w1_pd3.setText("Transfer Barang");
	w1_pd3.button("park").hide();
	w1_pd3.button("minmax1").hide();
	w1_pd3.center();
	w1_pd3.setModal(true);
	if(type=='input') {
		w1_pd3.attachURL(base_url+"index.php/transfer_barang/frm_input", true);
	} else {
		w1_pd3.attachURL(base_url+"index.php/transfer_barang/frm_edit/"+gd_pd3.getSelectedId(), true);
	}
	
	w1_pd3.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pd3.close();
		return;
    });
	
	tb_w1_pd3 = w1_pd3.attachToolbar();
	tb_w1_pd3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pd3.setSkin("dhx_terrace");
	tb_w1_pd3.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pd3.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pd3.addButton("cetak", 3, "CETAK", "print.gif", "print_dis.gif");
	//tb_w1_pd3.disableItem("cetak");
	tb_w1_pd3.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pd3();
		} else if(id=='baru') {
			tb_w1_pd3.disableItem("baru");
			tb_w1_pd3.enableItem("save");
			baru_pd3();
		} else if(id=='cetak') {
			window.open(base_url+'index.php/transfer_barang/cetak_sj/'+document.frm_pd3.kdtrans.value,'_blank');
		}
	});

}

function hapus_pd3() {
		idselect = gd_pd3.getRowIndex(gd_pd3.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pd3.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/transfer_barang/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pd3.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}
	
function cetak_pd3() {
	idselect = gd_pd3.getRowIndex(gd_pd3.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window.open(base_url+'index.php/transfer_barang/cetak_sj/'+gd_pd3.getSelectedId(),'_blank');
}

</script>

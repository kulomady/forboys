<div id="tmpTb_pb3" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pb3" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pb3" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pb3" name="frmSearch_pb3" method="post" action="javascript:void(0);">
    <table width="1048" border="0">
      <tr>
        <td width="81">No.Transaksi</td>
        <td width="232"><input type="text" name="noTrans" id="noTrans" /></td>
        <td width="75">Gudang</td>
        <td width="175"><select name="gudang" id="gudang" style=" width:150px;">
          <?php echo $gudang; ?>
        </select></td>
        <td width="97">No. Pembelian</td>
        <td width="172"><input type="text" name="nobeli" id="nobeli" /></td>
        <td width="186" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pb3();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Periode</td>
        <td><input name="tgl1_pb3" type="text" id="tgl1_pb3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pb3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pb3" type="text" id="tgl2_pb3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pb3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td>Supplier</td>
        <td><select name="supplier" id="supplier" style=" width:150px;">
          <?php echo $supplier; ?>
        </select></td>
        <td>Keterangan</td>
        <td><input type="text" name="ket" id="ket" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_pb3 = new dhtmlXCalendarObject({
	input: "tgl1_pb3",button: "btnTgl1_pb3"
});

calTgl2_pb3 = new dhtmlXCalendarObject({
	input: "tgl2_pb3",button: "btnTgl2_pb3"
});

tb_pb3 = new dhtmlXToolbarObject("tmpTb_pb3");
tb_pb3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pb3.setSkin("dhx_terrace");
tb_pb3.attachEvent("onclick", tbClick_pb3);
tb_pb3.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pb3.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pb3 = new dhtmlXLayoutObject("tmpLayout_pb3", "2E");
dhxLayout_pb3.cells("a").setText("Cari Data");
dhxLayout_pb3.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pb3.cells("a").setHeight(85);
dhxLayout_pb3.cells("a").collapse();
dhxLayout_pb3.cells("a").attachObject("tmpSearch_pb3");
dhxLayout_pb3.cells("b").setText("Site Navigation");
dhxLayout_pb3.cells("b").hideHeader();

function tbClick_pb3(id) {
	if(id=='new') {
		winForm_pb3('input');
	} else if(id=='edit') {
		winForm_pb3('edit');
	} else if(id=='del') {
		hapus_pb3();
	} else if(id=='refresh') {
		 loadGd_pb3();
	} else if(id=='print') {
		cetak_pd3();
	} else if(id=='cari') {
		if(dhxLayout_pb3.cells("a").isCollapsed()) {
			dhxLayout_pb3.cells("a").expand();
		} else {
			dhxLayout_pb3.cells("a").collapse();
		}
	}
}

gd_pb3 = dhxLayout_pb3.cells("b").attachGrid();
gd_pb3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pb3.setHeader("&nbsp;,No.Transaksi,No.Beli,Lokasi,Tanggal,Supplier,Jml Retur,#PCS,SubTotal,Disc,Pajak,Total,Tunai/DP,Kredit,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pb3.setInitWidths("30,120,120,130,75,120,65,65,85,65,65,75,75,75,80,80");
gd_pb3.setColAlign("right,left,left,left,left,left,center,center,right,right,right,right,right,right,left,left");
gd_pb3.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
gd_pb3.setColTypes("cntr,ro,ro,ro,ro,ro,ron,ron,ron,ron,ron,ron,ron,ron,ro,ro");
gd_pb3.setNumberFormat("0,000",6,",",".");
gd_pb3.setNumberFormat("0,000",7,",",".");
gd_pb3.setNumberFormat("0,000",8,",",".");
gd_pb3.setNumberFormat("0,000",9,",",".");
gd_pb3.setNumberFormat("0,000",10,",",".");
gd_pb3.setNumberFormat("0,000",11,",",".");
gd_pb3.setNumberFormat("0,000",12,",",".");
gd_pb3.setNumberFormat("0,000",13,",",".");
gd_pb3.enableSmartRendering(true,50);
gd_pb3.setColumnColor("#CCE2FE");
gd_pb3.setSkin("dhx_skyblue");
gd_pb3.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,&nbsp;");
gd_pb3.init();
loadGd_pb3();

function loadGd_pb3() {
	tglAwal = document.frmSearch_pb3.tgl1_pb3.value;
	tglAkhir = document.frmSearch_pb3.tgl2_pb3.value;
	if(document.frmSearch_pb3.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pb3.noTrans.value;
	}
	if(document.frmSearch_pb3.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pb3.gudang.value;
	}
	if(document.frmSearch_pb3.nobeli.value=="") {
		nobeli = "0";
	} else {
		nobeli = document.frmSearch_pb3.nobeli.value;
	}
	if(document.frmSearch_pb3.supplier.value=="") {
		supplier = "0";
	} else {
		supplier = document.frmSearch_pb3.supplier.value;
	}
	if(document.frmSearch_pb3.ket.value=="") {
		ket = "0";
	} else {
		ket = document.frmSearch_pb3.ket.value;
	}
	statusLoading();
	gd_pb3.clearAll();
	gd_pb3.loadXML(base_url+"index.php/retur_pembelian/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+nobeli+"/"+supplier+"/"+ket,function() {
		statusEnding();
	});
}

function refreshGd_pb3() {
	tglAwal = document.frmSearch_pb3.tgl1_pb3.value;
	tglAkhir = document.frmSearch_pb3.tgl2_pb3.value;
	if(document.frmSearch_pb3.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pb3.noTrans.value;
	}
	if(document.frmSearch_pb3.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pb3.gudang.value;
	}
	if(document.frmSearch_pb3.nobeli.value=="") {
		nobeli = "0";
	} else {
		nobeli = document.frmSearch_pb3.nobeli.value;
	}
	if(document.frmSearch_pb3.supplier.value=="") {
		supplier = "0";
	} else {
		supplier = document.frmSearch_pb3.supplier.value;
	}
	if(document.frmSearch_pb3.ket.value=="") {
		ket = "0";
	} else {
		ket = document.frmSearch_pb3.ket.value;
	}
	gd_pb3.updateFromXML(base_url+"index.php/retur_pembelian/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+nobeli+"/"+supplier+"/"+ket);
}


function winForm_pb3(type) {
	idselect = gd_pb3.getRowIndex(gd_pb3.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pb3 = dhxWins.createWindow("w1_pb3",0,0,950,550);
	w1_pb3.setText("Tambah Data Retur Pembelian");
	w1_pb3.button("park").hide();
	w1_pb3.button("minmax1").hide();
	w1_pb3.center();
	w1_pb3.setModal(true);
	if(type=='input') {
		w1_pb3.attachURL(base_url+"index.php/retur_pembelian/frm_input", true);
	} else {
		w1_pb3.attachURL(base_url+"index.php/retur_pembelian/frm_edit/"+gd_pb3.getSelectedId(), true);
	}
	
	w1_pb3.button("close").attachEvent("onClick", function() {
		outlet_id = "";
		try { winBeli_pb3.close(); } catch(e) { }
		try { w1_pb3.close(); } catch(e) { }
	});
	
	tb_w1_pb3 = w1_pb3.attachToolbar();
	tb_w1_pb3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pb3.setSkin("dhx_terrace");
	tb_w1_pb3.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pb3.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pb3.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pb3();
		} else if(id=='baru') {
			tb_w1_pb3.enableItem("baru");
			tb_w1_pb3.enableItem("save");
			baru_pb3();
		}
	});
}

function hapus_pb3() {
		idselect = gd_pb3.getRowIndex(gd_pb3.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pb3.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/retur_pembelian/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pb3.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}

			});
		}
	}

</script>

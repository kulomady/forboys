<div id="tmpTb_pj5" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pj5" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pj5" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
  <form id="frmSearch_pj5" name="frmSearch_pj5" method="post" action="javascript:void(0);">
    <table width="1048" border="0">
      <tr>
        <td width="82">No.Transaksi</td>
        <td width="235"><input type="text" name="noTrans" id="noTrans" /></td>
        <td width="77">Gudang</td>
        <td width="176"><select name="gudang" id="gudang" style=" width:150px;">
          <?php echo $gudang; ?>
        </select></td>
        <td width="54">Sales</td>
        <td width="169"><select name="sales" id="sales" style=" width:150px;">
          <?php echo $sales; ?>
        </select></td>
        <td width="225" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pj5();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td>Periode</td>
        <td><input name="tgl1_pj5" type="text" id="tgl1_pj5" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
          <span>&nbsp;<img id="btnTgl1_pj5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tgl2_pj5" type="text" id="tgl2_pj5" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" />
        <span>&nbsp;<img id="btnTgl2_pj5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
        <td>Pelanggan</td>
        <td><select name="pelanggan" id="pelanggan" style=" width:150px;">
          <?php echo $pelanggan; ?>
        </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_pj5 = new dhtmlXCalendarObject({
	input: "tgl1_pj5",button: "btnTgl1_pj5"
});

calTgl2_pj5 = new dhtmlXCalendarObject({
	input: "tgl2_pj5",button: "btnTgl2_pj5"
});

tb_pj5 = new dhtmlXToolbarObject("tmpTb_pj5");
tb_pj5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pj5.setSkin("dhx_terrace");
tb_pj5.attachEvent("onclick", tbClick_pj5);
tb_pj5.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pj5 = new dhtmlXLayoutObject("tmpLayout_pj5", "2E");
dhxLayout_pj5.cells("a").setText("Cari Data");
dhxLayout_pj5.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pj5.cells("a").setHeight(85);
dhxLayout_pj5.cells("a").collapse();
dhxLayout_pj5.cells("a").attachObject("tmpSearch_pj5");
dhxLayout_pj5.cells("b").setText("Site Navigation");
dhxLayout_pj5.cells("b").hideHeader();

function tbClick_pj5(id) {
	if(id=='new') {
		winForm_pj5('input');
	} else if(id=='edit') {
		winForm_pj5('edit');
	} else if(id=='del') {
		hapus_pj5();
	} else if(id=='refresh') {
		 loadGd_pj5();
	} else if(id=='print') {
		cetak_pd3();
	} else if(id=='cari') {
		if(dhxLayout_pj5.cells("a").isCollapsed()) {
			dhxLayout_pj5.cells("a").expand();
		} else {
			dhxLayout_pj5.cells("a").collapse();
		}
	}
}

gd_pj5 = dhxLayout_pj5.cells("b").attachGrid();
gd_pj5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pj5.setHeader("&nbsp;,No.Transfer,Tanggal,Masuk Gudang,Nama Pelanggan,Sales,Sub Total,Disc,Pajak,Biaya Lain,Pajak Biaya,Total Akhir,Tunai,Pot.Piutang,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pj5.setInitWidths("30,110,70,120,120,100,70,70,70,70,70,100,70,100,100");
gd_pj5.setColAlign("right,left,left,left,lef,left,right,right,right,right,center,right,right,right,left");
gd_pj5.setColSorting("na,int,str,str,str,int,str,date,date,str,str,str,str,str,str,str");
gd_pj5.setColTypes("cntr,ro,ro,ro,ro,ro,ron,ron,ron,ron,ro,ron,ron,ron,ron,ro");
gd_pj5.setNumberFormat("0,000",6,",",".");
gd_pj5.setNumberFormat("0,000",7,",",".");
gd_pj5.setNumberFormat("0,000",8,",",".");
gd_pj5.setNumberFormat("0,000",9,",",".");
gd_pj5.setNumberFormat("0,000",11,",",".");
gd_pj5.setNumberFormat("0,000",12,",",".");
gd_pj5.setNumberFormat("0,000",13,",",".");
gd_pj5.enableSmartRendering(true,50);
gd_pj5.setColumnColor("#CCE2FE");
gd_pj5.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;");
gd_pj5.setSkin("dhx_skyblue");
gd_pj5.splitAt(1);
gd_pj5.init();
loadGd_pj5();

function loadGd_pj5() {
	tglAwal = document.frmSearch_pj5.tgl1_pj5.value;
	tglAkhir = document.frmSearch_pj5.tgl2_pj5.value;
	if(document.frmSearch_pj5.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pj5.noTrans.value;
	}
	if(document.frmSearch_pj5.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pj5.gudang.value;
	}
	if(document.frmSearch_pj5.sales.value=="") {
		sales = "0";
	} else {
		sales = document.frmSearch_pj5.sales.value;
	}
	if(document.frmSearch_pj5.pelanggan.value=="") {
		pelanggan = "0";
	} else {
		pelanggan = document.frmSearch_pj5.pelanggan.value;
	}
	statusLoading();
	gd_pj5.clearAll();
	gd_pj5.loadXML(base_url+"index.php/retur_penjualan/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+sales+"/"+pelanggan,function() {
		statusEnding();
	});
}

function refreshGd_pj5() {
	tglAwal = document.frmSearch_pj5.tgl1_pj5.value;
	tglAkhir = document.frmSearch_pj5.tgl2_pj5.value;
	if(document.frmSearch_pj5.noTrans.value=="") {
		notrans = "0";
	} else {
		notrans = document.frmSearch_pj5.noTrans.value;
	}
	if(document.frmSearch_pj5.gudang.value=="") {
		gudang = "0";
	} else {
		gudang = document.frmSearch_pj5.gudang.value;
	}
	if(document.frmSearch_pj5.sales.value=="") {
		sales = "0";
	} else {
		sales = document.frmSearch_pj5.sales.value;
	}
	if(document.frmSearch_pj5.pelanggan.value=="") {
		pelanggan = "0";
	} else {
		pelanggan = document.frmSearch_pj5.pelanggan.value;
	}
	gd_pj5.updateFromXML(base_url+"index.php/retur_penjualan/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+notrans+"/"+gudang+"/"+sales+"/"+pelanggan);
}

function winForm_pj5(type) {
	idselect = gd_pj5.getRowIndex(gd_pj5.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pj5 = dhxWins.createWindow("w1_pj5",0,0,1000,580);
	w1_pj5.setText("Retur Penjualan");
	w1_pj5.button("park").hide();
	w1_pj5.button("minmax1").hide();
	w1_pj5.center();
	w1_pj5.setModal(true);
	if(type=='input') {
		w1_pj5.attachURL(base_url+"index.php/retur_penjualan/frm_input", true);
	} else {
		w1_pj5.attachURL(base_url+"index.php/retur_penjualan/frm_edit/"+gd_pj5.getSelectedId(), true);
	} 
	w1_pj5.button("close").attachEvent("onClick", function() {
		try { winPenjualan_pj5.close(); } catch(e) {}
		w1_pj5.close();
		outlet_id = "";
	});
	
	tb_w1_pj5 = w1_pj5.attachToolbar();
	tb_w1_pj5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pj5.setSkin("dhx_terrace");
	tb_w1_pj5.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pj5.addButton("simpan", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pj5.addButton("cetak", 3, "CETAK", "print.gif", "print_dis.gif");
	tb_w1_pj5.disableItem("baru");
	tb_w1_pj5.attachEvent("onclick", function(id) {
		if(id=='baru') {
			tb_w1_pj5.disableItem("baru");
			tb_w1_pj5.enableItem("simpan");
			baru_pj5();
		} else if(id=='simpan') {
			simpan_pj5();
		}
	});

}

function hapus_pj5() {
		idselect = gd_pj5.getRowIndex(gd_pj5.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pj5.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/retur_penjualan/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				if(result) {
					gd_pj5.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}

</script>

<div id="tmpTb_pj3" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pj3" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pj3">
  <form id="frmSearch_pj3" name="frmSearch_pj3" method="post" action="javascript:void(0);">
    <table width="1035" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
      <tr>
        <td>No. Pesanan</td>
        <td><input type="text" name="noTrans" id="noTrans" /></td>
        <td>Pelanggan</td>
        <td><select name="slcPlg" id="slcPlg" style=" width:150px;">
          <?php echo $pelanggan; ?>
                </select></td>
        <td>Sales</td>
        <td><select name="slcSales" id="slcSales" style=" width:150px;">
          <?php echo $sales; ?>
                </select></td>
        <td width="109" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pj3();" style="width:100px; height:40px;" /></td>
      </tr>
      <tr>
        <td width="84">Periode</td>
        <td width="223"><input name="tgl1_pj3" type="text" id="tgl1_pj3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_pj3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
        <input name="tgl2_pj3" type="text" id="tgl2_pj3" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_pj3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>        </td>
        <td width="73">Gudang</td>
        <td width="179"><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
      <?php echo $gudang; ?>
      </select></td>
        <td width="87">Tgl Kirim</td>
        <td width="250"><input name="tglKirim1_pj3" type="text" id="tglKirim1_pj3" size="8" readonly="readonly" />
          <span>&nbsp;<img id="btnTglKirim1_pj3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span> s.d
          <input name="tglKirim2_pj3" type="text" id="tglKirim2_pj3" size="8" readonly="readonly" />
        <span>&nbsp;<img id="btnTglKirim2_pj3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_pj3 = new dhtmlXCalendarObject({
	input: "tgl1_pj3",button: "btnTgl1_pj3"
});

calTgl2_pj3 = new dhtmlXCalendarObject({
	input: "tgl2_pj3",button: "btnTgl2_pj3"
});

calTglKirim1_pj3 = new dhtmlXCalendarObject({
	input: "tglKirim1_pj3",button: "btnTglKirim1_pj3"
});

calTglKirim2_pj3 = new dhtmlXCalendarObject({
	input: "tglKirim2_pj3",button: "btnTglKirim2_pj3"
});

tb_pj3 = new dhtmlXToolbarObject("tmpTb_pj3");
tb_pj3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pj3.setSkin("dhx_terrace");
tb_pj3.attachEvent("onclick", tbClick_pj3);
tb_pj3.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pj3 = new dhtmlXLayoutObject("tmpLayout_pj3", "2E");
dhxLayout_pj3.cells("a").setText("Cari Data");
dhxLayout_pj3.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pj3.cells("a").setHeight(85);
dhxLayout_pj3.cells("a").collapse();
dhxLayout_pj3.cells("a").attachObject("frmSearch_pj3");
dhxLayout_pj3.cells("b").setText("Site Navigation");
dhxLayout_pj3.cells("b").hideHeader();

function tbClick_pj3(id) {
	if(id=='new') {
		winForm_pj3('input');
	} else if(id=='edit') {
		winForm_pj3('edit');
	} else if(id=='del') {
		hapus_pj3();
	} else if(id=='refresh') {
		 loadGd_pj3();
	} else if(id=='print') {
		cetak_pj3();
	} else if(id=='cari') {
		if(dhxLayout_pj3.cells("a").isCollapsed()) {
			dhxLayout_pj3.cells("a").expand();
		} else {
			dhxLayout_pj3.cells("a").collapse();
		}
	}
}

gd_pj3 = dhxLayout_pj3.cells("b").attachGrid();
gd_pj3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pj3.setHeader("&nbsp;,No.Pesanan,Tanggal,Dari Gudang,Nama Pelanggan,Sales,Tgl Kirim,Sub Total,Disc,Pajak,Sts Biaya,Biaya Lain,Total Akhir,Titip/DP,Kekurangan,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pj3.setInitWidths("30,110,70,120,120,100,70,70,70,70,70,70,100,70,100,100");
gd_pj3.setColAlign("right,left,left,left,lef,left,left,right,right,right,left,right,right,right,right,left");
gd_pj3.setColSorting("na,int,str,str,str,int,str,date,date,str,str,str,str,str,str,str");
gd_pj3.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ron,ron,ron,ro,ron,ron,ron,ron,ro");
gd_pj3.setNumberFormat("0,000",7,",",".");
gd_pj3.setNumberFormat("0,000",8,",",".");
gd_pj3.setNumberFormat("0,000",9,",",".");
gd_pj3.setNumberFormat("0,000",11,",",".");
gd_pj3.setNumberFormat("0,000",12,",",".");
gd_pj3.setNumberFormat("0,000",13,",",".");
gd_pj3.setNumberFormat("0,000",14,",",".");
gd_pj3.enableSmartRendering(true,50);
gd_pj3.setColumnColor("#CCE2FE");
gd_pj3.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,&nbsp;");
gd_pj3.setSkin("dhx_skyblue");
gd_pj3.splitAt(1);
gd_pj3.init();
loadGd_pj3();

function loadGd_pj3() {
	tglAwal = document.frmSearch_pj3.tgl1_pj3.value;
	tglAkhir = document.frmSearch_pj3.tgl2_pj3.value;
	
	if(document.frmSearch_pj3.noTrans.value=="") {
		noTrans = 0;
	} else {
		noTrans = document.frmSearch_pj3.noTrans.value;
	}
	if(document.frmSearch_pj3.slcPlg.value=="") {
		pelanggan = 0;
	} else {
		pelanggan = document.frmSearch_pj3.slcPlg.value;
	}
	if(document.frmSearch_pj3.slcOutlet_id.value=="") {
		outlet = 0;
	} else {
		outlet = document.frmSearch_pj3.slcOutlet_id.value;
	}
	if(document.frmSearch_pj3.slcSales.value=="") {
		sales = 0;
	} else {
		sales = document.frmSearch_pj3.slcSales.value;
	}
	if(document.frmSearch_pj3.tglKirim1_pj3.value=="") {
		tglKirim1 = 0;
	} else {
		tglKirim1 = document.frmSearch_pj3.tglKirim1_pj3.value;
	}
	if(document.frmSearch_pj3.tglKirim2_pj3.value=="") {
		tglKirim2 = 0;
	} else {
		tglKirim2 = document.frmSearch_pj3.tglKirim2_pj3.value;
	}
	gd_pj3.clearAll();
	statusLoading();
	gd_pj3.loadXML(base_url+"index.php/pesanan_penjualan/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+noTrans+"/"+pelanggan+"/"+outlet+"/"+sales+"/"+tglKirim1+"/"+tglKirim2,function() {
		statusEnding();
	});
}

function refreshGd_pj3() {
	tglAwal = document.frmSearch_pj3.tgl1_pj3.value;
	tglAkhir = document.frmSearch_pj3.tgl2_pj3.value;
	
	if(document.frmSearch_pj3.noTrans.value=="") {
		noTrans = 0;
	} else {
		noTrans = document.frmSearch_pj3.noTrans.value;
	}
	if(document.frmSearch_pj3.slcPlg.value=="") {
		pelanggan = 0;
	} else {
		pelanggan = document.frmSearch_pj3.slcPlg.value;
	}
	if(document.frmSearch_pj3.slcOutlet_id.value=="") {
		outlet = 0;
	} else {
		outlet = document.frmSearch_pj3.slcOutlet_id.value;
	}
	if(document.frmSearch_pj3.slcSales.value=="") {
		sales = 0;
	} else {
		sales = document.frmSearch_pj3.slcSales.value;
	}
	if(document.frmSearch_pj3.tglKirim1_pj3.value=="") {
		tglKirim1 = 0;
	} else {
		tglKirim1 = document.frmSearch_pj3.tglKirim1_pj3.value;
	}
	if(document.frmSearch_pj3.tglKirim2_pj3.value=="") {
		tglKirim2 = 0;
	} else {
		tglKirim2 = document.frmSearch_pj3.tglKirim2_pj3.value;
	}
	gd_pj3.updateFromXML(base_url+"index.php/pesanan_penjualan/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+noTrans+"/"+pelanggan+"/"+outlet+"/"+sales+"/"+tglKirim1+"/"+tglKirim2);
}

function winForm_pj3(type) {
	idselect = gd_pj3.getRowIndex(gd_pj3.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pj3 = dhxWins.createWindow("w1_pj3",0,0,1000,620);
	w1_pj3.setText("Pesanan Penjualan");
	w1_pj3.button("park").hide();
	w1_pj3.button("minmax1").hide();
	w1_pj3.center();
	w1_pj3.setModal(true);
	if(type=='input') {
		w1_pj3.attachURL(base_url+"index.php/pesanan_penjualan/frm_input", true);
	} else {
		w1_pj3.attachURL(base_url+"index.php/pesanan_penjualan/frm_edit/"+gd_pj3.getSelectedId(), true);
	}
	
	w1_pj3.button("close").attachEvent("onClick", function() {
		outlet_id = "";
        win_brg.hide(); 
	   	w1_pj3.close();
		return;
    });
	
	tb_w1_pj3 = w1_pj3.attachToolbar();
	tb_w1_pj3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pj3.setSkin("dhx_terrace");
	tb_w1_pj3.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pj3.addButton("simpan", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pj3.addButton("cetak", 3, "CETAK", "print.gif", "print_dis.gif");
	tb_w1_pj3.disableItem("baru");
	tb_w1_pj3.attachEvent("onclick", function(id) {
		if(id=='baru') {
			tb_w1_pj3.disableItem("baru");
			tb_w1_pj3.enableItem("simpan");
			baru_pj3();
		} else if(id=='simpan') {
			simpan_pj3();
		}
	});

}

function hapus_pj3() {
		idselect = gd_pj3.getRowIndex(gd_pj3.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	    if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pj3.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pesanan_penjualan/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				result = loader.xmlDoc.responseText;
				if(result) {
					gd_pj3.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}
	
function cetak_pj3() {
	idselect = gd_pj3.getRowIndex(gd_pj3.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	window.open(base_url+'index.php/pesanan_penjualan/cetak_pesanan/'+gd_pj3.getSelectedId(),'_blank');
}



</script>

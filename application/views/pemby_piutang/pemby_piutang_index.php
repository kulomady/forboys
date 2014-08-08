<div id="tmpTb_pj2" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pj2" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pj2">
  <form id="frmSearch_pj2" name="frmSearch_pj2" method="post" action="javascript:void(0);">
    <table width="1035" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
      <tr>
        <td>No. Transaksi</td>
        <td><input type="text" name="noTrans" id="noTrans" /></td>
        <td>Pelanggan</td>
        <td><select name="slcPlg" id="slcPlg" style=" width:150px;">
          <?php echo $pilihPelanggan; ?>
                </select></td>
        <td width="182" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pj2();" style="width:100px; height:40px;" /></td>
        <td>&nbsp;</td>
        <td width="109" rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="84">Periode</td>
        <td width="223"><input name="tgl1_pj2" type="text" id="tgl1_pj2" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_pj2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
        <input name="tgl2_pj2" type="text" id="tgl2_pj2" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_pj2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>        </td>
        <td width="73">Cara bayar</td>
        <td width="179"><select name="slcBayar" id="slcBayar" style=" width:150px;">
          <?php echo $pilihCaraBayar; ?>
        </select></td>
        <td width="155">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
calTgl1_pj2 = new dhtmlXCalendarObject({
	input: "tgl1_pj2",button: "btnTgl1_pj2"
});

calTgl2_pj2 = new dhtmlXCalendarObject({
	input: "tgl2_pj2",button: "btnTgl2_pj2"
});

tb_pj2 = new dhtmlXToolbarObject("tmpTb_pj2");
tb_pj2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pj2.setSkin("dhx_terrace");
tb_pj2.attachEvent("onclick", tbClick_pj2);
tb_pj2.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pj2 = new dhtmlXLayoutObject("tmpLayout_pj2", "2E");
dhxLayout_pj2.cells("a").setText("Cari Data");
dhxLayout_pj2.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pj2.cells("a").setHeight(85);
dhxLayout_pj2.cells("a").collapse();
dhxLayout_pj2.cells("a").attachObject("frmSearch_pj2");
dhxLayout_pj2.cells("b").setText("Site Navigation");
dhxLayout_pj2.cells("b").hideHeader();

function tbClick_pj2(id) {
	if(id=='new') {
		winForm_pj2('input');
	} else if(id=='edit') {
		winForm_pj2('edit');
	} else if(id=='del') {
		hapus_pj2();
	} else if(id=='refresh') {
		 loadGd_pj2();
	} else if(id=='cari') {
		if(dhxLayout_pj2.cells("a").isCollapsed()) {
			dhxLayout_pj2.cells("a").expand();
		} else {
			dhxLayout_pj2.cells("a").collapse();
		}
	}
}

gd_pj2 = dhxLayout_pj2.cells("b").attachGrid();
gd_pj2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pj2.setHeader("&nbsp;,No.Transaksi,Tanggal,Cara Bayar,Kd.Plg,Nama Pelanggan,Keterangan,Total,Dibuat Oleh,Tgl Buat",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pj2.setInitWidths("30,120,120,100,80,120,150,150,100,100");
gd_pj2.setColAlign("right,left,left,left,left,left,left,right,left,left");
gd_pj2.setColSorting("na,int,str,str,int,str,str,str,str,str");
gd_pj2.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ron,ro,ro");
gd_pj2.enableSmartRendering(true,50);
gd_pj2.setNumberFormat("0,000.00",7,",",".");
gd_pj2.setColumnColor("#CCE2FE");
gd_pj2.setSkin("dhx_skyblue");
gd_pj2.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right>{#stat_total}</div>,&nbsp;,#cspan");
gd_pj2.init();
loadGd_pj2();

function loadGd_pj2() {
	tglAwal = document.frmSearch_pj2.tgl1_pj2.value;
	tglAkhir = document.frmSearch_pj2.tgl2_pj2.value;
	
	if(document.frmSearch_pj2.noTrans.value=="") {
		noTrans = 0;
	} else {
		noTrans = document.frmSearch_pj2.noTrans.value;
	}
	if(document.frmSearch_pj2.slcPlg.value=="") {
		pelanggan = 0;
	} else {
		pelanggan = document.frmSearch_pj2.slcPlg.value;
	}
	if(document.frmSearch_pj2.slcBayar.value=="") {
		bayar = 0;
	} else {
		bayar = document.frmSearch_pj2.slcBayar.value;
	}
	
	gd_pj2.clearAll();
	gd_pj2.loadXML(base_url+"index.php/pemby_piutang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+noTrans+"/"+pelanggan+"/"+bayar);
}

function refreshGd_pj2() {
	tglAwal = document.frmSearch_pj2.tgl1_pj2.value;
	tglAkhir = document.frmSearch_pj2.tgl2_pj2.value;
	
	if(document.frmSearch_pj2.noTrans.value=="") {
		noTrans = 0;
	} else {
		noTrans = document.frmSearch_pj2.noTrans.value;
	}
	if(document.frmSearch_pj2.slcPlg.value=="") {
		pelanggan = 0;
	} else {
		pelanggan = document.frmSearch_pj2.slcPlg.value;
	}
	if(document.frmSearch_pj2.slcBayar.value=="") {
		bayar = 0;
	} else {
		bayar = document.frmSearch_pj2.slcBayar.value;
	}
	gd_pj2.updateFromXML(base_url+"index.php/pemby_piutang/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+noTrans+"/"+pelanggan+"/"+bayar);
}


function winForm_pj2(type) {
	idselect = gd_pj2.getRowIndex(gd_pj2.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pj2 = dhxWins.createWindow("w1_pj2",0,0,965,500);
	w1_pj2.setText("Pembayaran Piutang");
	w1_pj2.button("park").hide();
	w1_pj2.button("minmax1").hide();
	w1_pj2.center();
	w1_pj2.setModal(true);
	if(type=='input') {
		w1_pj2.attachURL(base_url+"index.php/pemby_piutang/frm_input", true);
	} else {
		w1_pj2.attachURL(base_url+"index.php/pemby_piutang/frm_edit/"+gd_pj2.getSelectedId(), true);
	}
	w1_pj2.button("close").attachEvent("onClick", function() {
		outlet_id = "";
		try { w2_pj2.close(); } catch(e) {}
		w1_pj2.close();
	});
	
	tb_w1_pj2 = w1_pj2.attachToolbar();
	tb_w1_pj2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pj2.setSkin("dhx_terrace");
	tb_w1_pj2.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pj2.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pj2.disableItem("baru");
	tb_w1_pj2.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pj2();
		} else if(id=='baru') {
			tb_w1_pj2.disableItem("baru");
			tb_w1_pj2.enableItem("save");
			tb_w1_pj2.enableItem("batal");
			baru_pj2();
		}
	});

}

function hapus_pj2() {
		idselect = gd_pj2.getRowIndex(gd_pj2.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
			 poststr =
            	'idrec=' + gd_pj2.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemby_piutang/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				loadGd_pj2();
			});
		}
	}

</script>

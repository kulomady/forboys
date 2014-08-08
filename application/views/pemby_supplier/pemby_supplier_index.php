<div id="tmpTb_pb2" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pb2" style="position: relative; width: 100%; height: 91%; aborder: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pb2">
  <form id="frmSearch_pb2" name="frmSearch_pb2" method="post" action="javascript:void(0);">
    <table width="1035" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
      <tr>
        <td>No. Transaksi</td>
        <td><input type="text" name="noTrans" id="noTrans" /></td>
        <td>Supplier</td>
        <td><select name="slcSpl" id="slcSpl" style=" width:150px;">
          <?php echo $pilihSupplier; ?>
                </select></td>
        <td width="182" rowspan="2"><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pb2();" style="width:100px; height:40px;" /></td>
        <td>&nbsp;</td>
        <td width="109" rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="84">Periode</td>
        <td width="223"><input name="tgl1_pb2" type="text" id="tgl1_pb2" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl1_pb2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>
          s.d 
        <input name="tgl2_pb2" type="text" id="tgl2_pb2" size="8" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /><span>&nbsp;<img id="btnTgl2_pb2" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span>        </td>
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
calTgl1_pb2 = new dhtmlXCalendarObject({
	input: "tgl1_pb2",button: "btnTgl1_pb2"
});

calTgl2_pb2 = new dhtmlXCalendarObject({
	input: "tgl2_pb2",button: "btnTgl2_pb2"
});

tb_pb2 = new dhtmlXToolbarObject("tmpTb_pb2");
tb_pb2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pb2.setSkin("dhx_terrace");
tb_pb2.attachEvent("onclick", tbClick_pb2);
tb_pb2.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pb2 = new dhtmlXLayoutObject("tmpLayout_pb2", "2E");
dhxLayout_pb2.cells("a").setText("Cari Data");
dhxLayout_pb2.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pb2.cells("a").setHeight(85);
dhxLayout_pb2.cells("a").collapse();
dhxLayout_pb2.cells("a").attachObject("frmSearch_pb2");
dhxLayout_pb2.cells("b").setText("Site Navigation");
dhxLayout_pb2.cells("b").hideHeader();

function tbClick_pb2(id) {
	if(id=='new') {
		winForm_pb2('input');
	} else if(id=='edit') {
		winForm_pb2('edit');
	} else if(id=='del') {
		hapus_pb2();
	} else if(id=='refresh') {
		 loadGd_pb2();
	} else if(id=='cari') {
		if(dhxLayout_pb2.cells("a").isCollapsed()) {
			dhxLayout_pb2.cells("a").expand();
		} else {
			dhxLayout_pb2.cells("a").collapse();
		}
	}
}

gd_pb2 = dhxLayout_pb2.cells("b").attachGrid();
gd_pb2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pb2.setHeader("&nbsp;,No.Transaksi,Tanggal,Cara Bayar,Kd.Supp,Nama Supplier,Keterangan,Total,Dibuat Oleh,Tgl Buat",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pb2.setInitWidths("30,120,120,100,80,150,80,150,100,100");
gd_pb2.setColAlign("right,left,left,left,left,left,left,right,left,left");
gd_pb2.setColSorting("na,int,str,str,int,str,str,str,str,str");
gd_pb2.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ron,ro,ro");
gd_pb2.enableSmartRendering(true,50);
gd_pb2.setNumberFormat("0,000",7,",",".");
gd_pb2.setColumnColor("#CCE2FE");
gd_pb2.setSkin("dhx_skyblue");
gd_pb2.init();
loadGd_pb2();

function loadGd_pb2() {
	tglAwal = document.frmSearch_pb2.tgl1_pb2.value;
	tglAkhir = document.frmSearch_pb2.tgl2_pb2.value;
	
	if(document.frmSearch_pb2.noTrans.value=="") {
		noTrans = 0;
	} else {
		noTrans = document.frmSearch_pb2.noTrans.value;
	}
	if(document.frmSearch_pb2.slcSpl.value=="") {
		supplier = 0;
	} else {
		supplier = document.frmSearch_pb2.slcSpl.value;
	}
	if(document.frmSearch_pb2.slcBayar.value=="") {
		bayar = 0;
	} else {
		bayar = document.frmSearch_pb2.slcBayar.value;
	}
	gd_pb2.clearAll();
	gd_pb2.loadXML(base_url+"index.php/pemby_supplier/loadMainData/"+tglAwal+"/"+tglAkhir+"/"+noTrans+"/"+supplier+"/"+bayar);
}

function refreshGd_pb2() {
	gd_pb2.updateFromXML(base_url+"index.php/pemby_supplier/loadMainData");
}


function winForm_pb2(type) {
	idselect = gd_pb2.getRowIndex(gd_pb2.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pb2 = dhxWins.createWindow("w1_pb2",0,0,965,500);
	w1_pb2.setText("Pembayaran Supplier");
	w1_pb2.button("park").hide();
	w1_pb2.button("minmax1").hide();
	w1_pb2.center();
	w1_pb2.setModal(true);
	if(type=='input') {
		w1_pb2.attachURL(base_url+"index.php/pemby_supplier/frm_input", true);
	} else {
		w1_pb2.attachURL(base_url+"index.php/pemby_supplier/frm_edit/"+gd_pb2.getSelectedId(), true);
	}
	w1_pb2.button("close").attachEvent("onClick", function() {
		outlet_id = "";
		try { w2_pb2.close(); } catch(e) {}
		w1_pb2.close();
	});
	
	tb_w1_pb2 = w1_pb2.attachToolbar();
	tb_w1_pb2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pb2.setSkin("dhx_terrace");
	tb_w1_pb2.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pb2.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pb2.disableItem("baru");
	tb_w1_pb2.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pb2();
		} else if(id=='baru') {
			tb_w1_pb2.disableItem("baru");
			tb_w1_pb2.enableItem("save");
			tb_w1_pb2.enableItem("batal");
			baru_pb2();
		}
	});

}

function hapus_pb2() {
		idselect = gd_pb2.getRowIndex(gd_pb2.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
			 poststr =
            	'idrec=' + gd_pb2.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemby_supplier/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				loadGd_pb2();
			});
		}
	}

</script>

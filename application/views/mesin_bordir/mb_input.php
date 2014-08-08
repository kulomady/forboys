<div class="frmContainer">
<form name="frm_pr4" id="frm_pr4" method="post" action="javascript:void(0);">
  <table width="800" border="0" align="center">
    
    <tr>
      <td width="90">No. Trans</td>
      <td width="224"><input type="text" name="kdtrans" id="kdtrans" placeholder="[AUTO]" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>"></td>
      <td width="77">No. PO</td>
      <td colspan="2"><select name="nopo" id="nopo">
      <?php echo $pilihPO; ?>
      </select></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td><input type="text" name="tgl" id="tgl" readonly size="10" value="<?php if(isset($tgl)): echo $tgl; endif;?>" />
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="Pilih Tgl" id="txttgl_pr4" style="cursor:pointer;" border="0" /></td>
      <td>Mesin / Shift</td>
      <td colspan="2"><select name="mesin" id="mesin">
       <?php echo $pilihMesin; ?>
      </select> 
        / 
        <select name="kdshift" id="kdshift">
          <?php echo $pilihShift; ?>
        </select></td>
      </tr>
    <tr>
      <td>Lokasi</td>
      <td><select name="gudang" id="gudang" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
      <?php echo $gudang; ?>
      </select></td>
      <td>Kode Akun</td>
      <td width="111"><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
        <img name="btnakun_pr4" id="btnakun_pr4" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pr4();" /></td>
      <td width="276" id="tmpNmPerkiraan_pr4"><?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?></td>
    </tr>
    
    <tr>
      <td colspan="5"><div id="tmpGridBrg_pr4" style="height:300px; width:100%;"></div></td>
      </tr>
  </table>
</form>
</div>
<script language="javascript">
outlet_id = document.frm_pr4.gudang.value;
gd_win_brg.clearAll();
// tanggal pesen
cal1_pr4 = new dhtmlXCalendarObject({
		input: "tgl",button: "txttgl_pr4"
});
cal1_pr4.setDateFormat("%d/%m/%Y");

function winAkun_pr4() {
	try {
		if(w2_pr4.isHidden()==true) {
			w2_pr4.show();
			document.getElementById('frmSearchAkun_pr4').focus();
		}
		w2_pr4.bringToTop();
		return;
	} catch(e) {}
	w2_pr4 = dhxWins.createWindow("w2_pr4",0,0,430,450);
	w2_pr4.setText("Daftar Perkiraan");
	w2_pr4.button("park").hide();
	w2_pr4.button("minmax1").hide();
	w2_pr4.center();
	
	tb_w2_pr4 = w2_pr4.attachToolbar();
	tb_w2_pr4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w2_pr4.setSkin("dhx_terrace");
	tb_w2_pr4.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w2_pr4.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahAkun_pr4(13);
		}
	});
	
	w2_pr4.attachURL(base_url+"index.php/mesin_bordir/frm_search_akun", true);
}

	gdInp = new dhtmlXGridObject('tmpGridBrg_pr4');
	gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gdInp.setHeader("Keterangan,Posisi,S s.d L,3 s.d 5,6 s.d 8,10 s.d 12,Jml Stick,Tarif,Total,&nbsp;",null,
	["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gdInp.setInitWidths("150,100,70,70,70,70,70,70,70,30");
	gdInp.setColAlign("left,left,right,right,right,right,right,right,right,center");
	gdInp.setColTypes("ed,ed,edn,edn,edn,edn,ron,ed,ron,ro");
	gdInp.setSkin("dhx_skyblue");
	gdInp.attachEvent("onEnter", doOnEnterInp_pr4);
	gdInp.attachEvent("onEditCell", doOnCellEdit_pr4);
	gdInp.setSkin("dhx_skyblue");
	gdInp.setNumberFormat("0,000",2,",",".");
	gdInp.setNumberFormat("0,000",3,",",".");
	gdInp.setNumberFormat("0,000",4,",",".");
	gdInp.setNumberFormat("0,000",5,",",".");
	gdInp.setNumberFormat("0,000",6,",",".");
	gdInp.setNumberFormat("0,000",7,",",".");
	gdInp.setNumberFormat("0,000.00",8,",",".");
	gdInp.attachFooter("Jumlah,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right id=tmpTotal_pd1>{#stat_total}</div>,<div style=text-align:right id=tmpTotal_pd1>{#stat_total}</div>,<div style=text-align:right id=tmpTotal_pd1>{#stat_total}</div>,&nbsp;");
	gdInp.init();
	
	<?php if(isset($kdtrans)){ ?> 
		loadChild_pr4();
	<?php } else { ?>
		baru_pr4();
	<?php }?>
	
	function loadChild_pr4() {
		gdInp.clearAll();
		gdInp.loadXML(base_url+"index.php/mesin_bordir/loadDataBrgDetail/"+document.frm_pr4.kdtrans.value,function() {
			addRowInp_pr4();
		});
	}
	
	function baru_pr4(){
		document.frm_pr4.kdtrans.value = "";
		document.frm_pr4.tgl.value = "";
		document.frm_pr4.gudang.value = "";
		document.frm_pr4.nopo.value = "";
		document.frm_pr4.kdakun.value = "";
		document.frm_pr4.mesin.value = "";
		document.frm_pr4.kdshift.value = "";
		document.getElementById('tmpNmPerkiraan_pr4').innerHTML = "";
		
		document.frm_pr4.gudang.disabled = false;
		outlet_id = "";
		gdInp.clearAll();
		gdInp.addRow(gdInp.uid(),['','','','','','','','','',img_del],0);
		gdInp.selectRow(0);
	}
	
	function addRowInp_pr4() {
		arrId = gdInp.getAllItemIds().split(",");
		idcell = arrId[0];
		celIdbarang = gdInp.cells(idcell,0).getValue();
		if(celIdbarang != "") {
				posisi = 0;
				gdInp.addRow(gdInp.uid(),['','','','','','','','','',img_del],0);
				gdInp.showRow(gdInp.uid());
		}
	}
	
	function doOnEnterInp_pr4(rowId, cellInd) {
		addRowInp_pr4();
		return true;
	}
	
	function doOnCellEdit_pr4(stage, rowId, cellInd) {

		if (stage == 2) {
			 if(cellInd==0 || cellInd==1) {
				gdInp.setCellTextStyle(rowId,cellInd, "text-transform:uppercase;"); 
			 }
			 if(cellInd == 2 || cellInd == 3 || cellInd == 4 || cellInd == 5) {
				if(gdInp.cells(rowId,2).getValue()=="") {
					stick_1 = 0;	
				} else {
					stick_1 = gdInp.cells(rowId,2).getValue();	
				}
				if(gdInp.cells(rowId,3).getValue()=="") {
					stick_2 = 0;	
				} else {
					stick_2 = gdInp.cells(rowId,3).getValue();	
				}
				if(gdInp.cells(rowId,4).getValue()=="") {
					stick_3 = 0;	
				} else {
					stick_3 = gdInp.cells(rowId,4).getValue();	
				}
				if(gdInp.cells(rowId,5).getValue()=="") {
					stick_4 = 0;	
				} else {
					stick_4 = gdInp.cells(rowId,5).getValue();	
				}
				jml = parseInt(stick_1) + parseInt(stick_2) + parseInt(stick_3) + parseInt(stick_4); 
				gdInp.cells(rowId,6).setValue(jml);
			 }
			 if(cellInd == 7) {
				jml = gdInp.cells(rowId,6).getValue();
				harga = gdInp.cells(rowId,7).getValue();
				total = harga * jml;
				gdInp.cells(rowId,8).setValue(total);
				addRowInp_pr4();
			  }
		}
		return true;
	}
	
	function simpan_pr4() {
		if(document.frm_pr4.tgl.value=="") {
			alert("Tanggal Tidak Boleh Kosong");
			return;
		}
		if(document.frm_pr4.nopo.value=="") {
			alert("No.PO Tidak Boleh Kosong");
			document.frm_pr4.nopo.focus();
			return;
		}
		if(document.frm_pr4.kdakun.value=="") {
			alert("Kode Akun Tidak Boleh Kosong");
			document.frm_pr4.kdakun.focus();
			return;
		}
		if(document.frm_pr4.mesin.value=="") {
			alert("Mesin Tidak Boleh Kosong");
			document.frm_pr4.mesin.focus();
			return;
		}
		if(document.frm_pr4.kdshift.value=="") {
			alert("Shift Tidak Boleh Kosong");
			document.frm_pr4.kdshift.focus();
			return;
		}
		delRowInp();
	
		if(cekKosong(8)==1) {
			alert("Total salah satu data tidak boleh kosong");
			return;
		}
		
		// Proses Simpan
		tb_w1_pr4.disableItem("save");
		var poststr =
			'kdtrans=' + document.frm_pr4.kdtrans.value +
            '&tgl=' + document.frm_pr4.tgl.value +
			'&gudang=' + document.frm_pr4.gudang.value +
			'&nopo=' + document.frm_pr4.nopo.value +
			'&kdakun=' + document.frm_pr4.kdakun.value +
			'&mesin=' + document.frm_pr4.mesin.value +
			'&shift=' + document.frm_pr4.kdshift.value +
			'&data=' + getData(gdInp,[9]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/mesin_bordir/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			tb_w1_pr4.enableItem("save");
			tb_w1_pr4.enableItem("baru");
			statusEnding();
			document.frm_pr4.kdtrans.value = result;
			refreshGd_pr4();
			addRowInp_pr4();
		});
	}
</script>

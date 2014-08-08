<div class="frmContainer">
<form name="frm_pr3" id="frm_pr3" method="post" action="javascript:void(0);">
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
        <img src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" alt="Pilih Tgl" id="txttgl_pr3" style="cursor:pointer;" border="0" /></td>
      <td>Kode Akun</td>
      <td width="111"><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
        <img name="btnakun_pr3" id="btnakun_pr3" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pr3();" /></td>
      <td width="276" id="tmpNmPerkiraan_pr3"><?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?></td>
    </tr>
    <tr>
      <td>Gudang</td>
      <td><select name="gudang" id="gudang" onchange="initOutlet(this.value); this.disabled=true; gd_win_brg.clearAll();">
      <?php echo $gudang; ?>
      </select></td>
      <td>Keterangan</td>
      <td colspan="2"><input name="keterangan" type="text" id="keterangan" size="35" value="<?php if(isset($keterangan)): echo $keterangan; endif;?>" /></td>
    </tr>
    
    <tr>
      <td colspan="5"><div id="tmpGridBrg_pr3" style="height:300px; width:100%;"></div></td>
      </tr>
  </table>
</form>
</div>
<script language="javascript">
outlet_id = document.frm_pr3.gudang.value;
gd_win_brg.clearAll();
// tanggal pesen
cal1_pr3 = new dhtmlXCalendarObject({
		input: "tgl",button: "txttgl_pr3"
});
cal1_pr3.setDateFormat("%d/%m/%Y");

function winAkun_pr3() {
	try {
		if(w2_pr3.isHidden()==true) {
			w2_pr3.show();
			document.getElementById('frmSearchAkun_pr3').focus();
		}
		w2_pr3.bringToTop();
		return;
	} catch(e) {}
	w2_pr3 = dhxWins.createWindow("w2_pr3",0,0,430,450);
	w2_pr3.setText("Daftar Perkiraan");
	w2_pr3.button("park").hide();
	w2_pr3.button("minmax1").hide();
	w2_pr3.center();
	
	tb_w2_pr3 = w2_pr3.attachToolbar();
	tb_w2_pr3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w2_pr3.setSkin("dhx_terrace");
	tb_w2_pr3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
	tb_w2_pr3.attachEvent("onclick", function(id) {
		if(id=='pakai') {
			tandaPanahAkun_pr3(13);
		}
	});
	
	w2_pr3.attachURL(base_url+"index.php/pemakaian_bahan_pembantu/frm_search_akun", true);
}

	gdInp = new dhtmlXGridObject('tmpGridBrg_pr3');
	gdInp.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gdInp.setHeader("Kode Item,#cspan,Nama Barang,Satuan,Qty Pakai,Pcs,Harga,Total,&nbsp;",null,
	["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gdInp.setInitWidths("80,30,220,70,70,70,100,100,30");
	gdInp.setColAlign("left,right,left,left,right,right,right,right,center");
	gdInp.setColTypes("ed,ro,ro,ro,edn,edn,ron,ron,ro");
	gdInp.setSkin("dhx_skyblue");
	gdInp.attachEvent("onEnter", doOnEnterInp_pr3);
	gdInp.attachEvent("onEditCell", doOnCellEdit_pr3);
	gdInp.setSkin("dhx_skyblue");
	gdInp.setNumberFormat("0,000",4,",",".");
	gdInp.setNumberFormat("0,000",5,",",".");
	gdInp.setNumberFormat("0,000",6,",",".");
	gdInp.setNumberFormat("0,000",7,",",".");
	gdInp.attachFooter("Jumlah,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,&nbsp;,<div style=text-align:right id=tmpTotal_pd1>{#stat_total}</div>,&nbsp;");
	gdInp.init();
	
	<?php if(isset($kdtrans)){ ?> 
		loadChild_pr3();
	<?php } else { ?>
		baru_pr3();
	<?php }?>
	
	function loadChild_pr3() {
		gdInp.clearAll();
		gdInp.loadXML(base_url+"index.php/pemakaian_bahan_pembantu/loadDataBrgDetail/"+document.frm_pr3.kdtrans.value,function() {
			addRowInp_pr3();
		});
	}
	
	function baru_pr3(){
		document.frm_pr3.kdtrans.value = "";
		document.frm_pr3.tgl.value = "";
		document.frm_pr3.gudang.value = "";
		document.frm_pr3.nopo.value = "";
		document.frm_pr3.kdakun.value = "";
		document.frm_pr3.keterangan.value = "";
		document.getElementById('tmpNmPerkiraan_pr3').innerHTML = "";
		
		document.frm_pr3.gudang.disabled = false;
		outlet_id = "";
		gdInp.clearAll();
		gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','',img_del],0);
		gdInp.selectRow(0);
	}
	
	function addRowInp_pr3() {
		arrId = gdInp.getAllItemIds().split(",");
		idcell = arrId[0];
		celIdbarang = gdInp.cells(idcell,0).getValue();
		if(celIdbarang != "") {
				posisi = 0;
				gdInp.addRow(gdInp.uid(),['',img_link,'','','','','','',img_del],posisi);
				gdInp.showRow(gdInp.uid());
		}
	}
	
	function doOnEnterInp_pr3(rowId, cellInd) {
		if(cellInd==0) {
			cariBarang();
		}
		addRowInp_pr3();
		return true;
	}
	
	function doOnCellEdit_pr3(stage, rowId, cellInd) {
	
		if (stage == 2) {
		 if(cellInd == 4) {
			harga = gdInp.cells(rowId,6).getValue();
			jml = gdInp.cells(rowId,4).getValue();
			pcs = gdInp.cells(rowId,5).getValue();
			total = harga * (jml * pcs);
			gdInp.cells(rowId,7).setValue(total);
			addRowInp_pr3();
		  }
		}
		return true;
	}
	
	function setDataBrgPr3(kode,nmbarang,warna,ukuran,satuan,hrgBeli) {
		nmbarang = nmbarang+" "+warna+" "+ukuran;
		gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
		gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
		gdInp.cells(gdInp.getSelectedId(),3).setValue(satuan);
		gdInp.cells(gdInp.getSelectedId(),6).setValue(hrgBeli);
		//index = gdInp.getRowIndex(gdInp.getSelectedId());
		//gdInp.setRowId(index,kode.toUpperCase());
		document.getElementById("pilihCell5").click();
	}
	
	function simpan_pr3() {
		if(document.frm_pr3.tgl.value=="") {
			alert("Tanggal Tidak Boleh Kosong");
			return;
		}
		if(document.frm_pr3.nopo.value=="") {
			alert("No.PO Tidak Boleh Kosong");
			document.frm_pr3.nopo.focus();
			return;
		}
		if(document.frm_pr3.kdakun.value=="") {
			alert("Kode Akun Tidak Boleh Kosong");
			document.frm_pr3.kdakun.focus();
			return;
		}
		delRowInp();
	
		if(cekKosong(7)==1) {
			alert("Total salah satu barang tidak boleh kosong");
			return;
		}
		
		// Proses Simpan
		tb_w1_pr3.disableItem("save");
		var poststr =
			'kdtrans=' + document.frm_pr3.kdtrans.value +
            '&tgl=' + document.frm_pr3.tgl.value +
			'&gudang=' + document.frm_pr3.gudang.value +
			'&nopo=' + document.frm_pr3.nopo.value +
			'&kdakun=' + document.frm_pr3.kdakun.value +
			'&keterangan=' + document.frm_pr3.keterangan.value +
			'&dataBrg=' + getData(gdInp,[1,2,3,8]);
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemakaian_bahan_pembantu/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			tb_w1_pr3.enableItem("save");
			tb_w1_pr3.enableItem("baru");
			statusEnding();
			document.frm_pr3.kdtrans.value = result;
			refreshGd_pr3();
			addRowInp_pr3();
		});
	}
</script>

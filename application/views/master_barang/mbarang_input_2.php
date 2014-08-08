<div class="frmContainer">
<form action="javascript:void(0);" method="post" name="frm2_md3" id="frm2_md3">
  <table width="746" border="0">
    <tr>
      <td colspan="2">SATUAN KONVERSI</td>
      <td>UKURAN</td>
    </tr>
    <tr>
      <td width="94">Satuan Dasar</td>
      <td width="183" id="tmpSatDasar_md3"></td>
      <td width="455" rowspan="3" valign="top">
	  <?php 
	  	  $arrSize = "";
		  $arrCeklist = "";
		  foreach($size->result() as $rs) {
		  	 $check = 'checked="checked"';
		  	 if(isset($arrUkuran)):
		  	 	if(in_array($rs->idsize, $arrUkuran)): $arrCeklist .= $rs->idsize."|"; endif;
			 endif;
			 echo '<input type="checkbox" name="'.$rs->idsize.'" id="'.$rs->idsize.'" onclick="cekSize_md3(this.id);" />'.$rs->nmsize;
			 $arrSize .= $rs->idsize."|";
		  }
	  ?>       </td>
    </tr>
    <tr>
      <td height="21" valign="top">Harga Beli</td>
      <td height="21" valign="top"><input name="hrgBeli" type="text" id="hrgBeli" size="10" style="text-align:right;" onkeyup="gantiHargaBeli();" value="<?php if(isset($hrgBeli)): echo $hrgBeli; endif; ?>" /></td>
    </tr>
    <tr>
      <td height="127" colspan="2" valign="top"><div id="tmpGridSat_md3" style="height:150px; width:280px;"></div>
        </td>
    </tr>
  </table>
</form>
</div>

<script language="javascript">
var imgDelSat = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusSatuan_md3();" />';
var imgDelSize = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hpsSatSize_md3();" />';

$(function() {            
		$('#hrgBeli').number(true,0);	
});

// tmpSatDasar_md3
	var cbSatDasar_md3 = new dhtmlXCombo("tmpSatDasar_md3", "cbSatDasar_md3", 100);
	cbSatDasar_md3.enableFilteringMode(true);
	cbSatDasar_md3.attachEvent("onChange", onChangecbSatDasar_md3);
	loadCbSatDasar_md3();
	function loadCbSatDasar_md3() {
		cbSatDasar_md3.clearAll();
		cbSatDasar_md3.loadXML(base_url+"index.php/master_barang/cbSatDasar",function() {
			<?php
				if(isset($satDasar)):
					echo "IDcbSatDasar_md3 = cbSatDasar_md3.getIndexByValue('".$satDasar."');";
					echo "cbSatDasar_md3.selectOption(IDcbSatDasar_md3,true,true);";
					echo "loadGdSat_md3('".$idbarang."');";
					echo "loadGdSize_md3('".$idbarang."');";
				endif;
			?>
			// ceklist ukuran
			var txtCeklist = "<?php echo $arrCeklist; ?>";
			var arrCeklist = txtCeklist.split("|");
			
			for(n=0;n<arrCeklist.length;n++) {
				if(arrCeklist[n] != "") {
					document.getElementById(arrCeklist[n]).checked = true;
				}
			}
		});
	}
	
	gdSat_md3 = new dhtmlXGridObject('tmpGridSat_md3');
	gdSat_md3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
	gdSat_md3.setHeader("Satuan,Konversi,Harga Beli,&nbsp;",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);
	gdSat_md3.setInitWidths("70,70,80,30");
	gdSat_md3.setColAlign("left,left,right,center");
	gdSat_md3.setColSorting("str,int,str,str");
	gdSat_md3.setColTypes("coro,ed,edn,ro");
	gdSat_md3.setNumberFormat("0,000",2,",",".");
	gdSat_md3.setSkin("dhx_skyblue");
	gdSat_md3.attachEvent("onEditCell", doOnCellEditgdSat_md3);
	gdSat_md3.init();
	<?php 
	foreach($satuan->result() as $r) {
		echo "gdSat_md3.getCombo(0).put('".$r->idsatuan."', '".$r->nmsatuan."');";
	}
	?>
	
	function loadGdSat_md3(idbarang_induk) {
		gdSat_md3.clearAll();
		gdSat_md3.loadXML(base_url+"index.php/master_barang/loadDataSat/"+idbarang_induk);
	}
	
	var txtSize = "<?php echo $arrSize; ?>";
	var arrSize = txtSize.split("|");
	
	function buatBarang_md3() {
		if(gdSize_md3.getRowsNum()==0) {
			onChangecbSatDasar_md3();
		}
		return;
	}
	function onChangecbSatDasar_md3() {
	
		if(document.frm1_md3.txtKdItem.value == "") {
			alert("Isi terlebih dahulu Kode Barang");
			tabbar_md3.setTabActive("a1");
			document.frm1_md3.txtKdItem.focus();
			return;
		}
		gdSat_md3.clearAll();
		gdSat_md3.addRow(gdSat_md3.uid(),['','','',imgDelSat],0);
		gdSat_md3.selectRow(0);
		gdSize_md3.clearAll();
		// clear ceklist
		for(n=0;n<arrSize.length;n++) {
			if(arrSize[n] != "") {
				document.getElementById(arrSize[n]).checked = false;
			}
		}
		
		if(cbSatDasar_md3.getSelectedValue() == null) {
			kdbrg = document.frm1_md3.txtKdItem.value;
			idgroup = document.frm1_md3.txtKdItem.value;
		} else {
			kdbrg = document.frm1_md3.txtKdItem.value+"."+cbSatDasar_md3.getSelectedValue();
			idgroup = document.frm1_md3.txtKdItem.value;
		}
		
		var row1 = document.frm1_md3.txtKdItem.value;
		var row2 = "";
		var row3 = cbSatDasar_md3.getSelectedValue();
		var row5 = kdbrg;
		var row6 = "1";
		var row7 = idgroup;
		var row8 = $('#hrgBeli').val();
		if(document.frm1_md3.cbBarcode.checked == true) {
			row4 = row5
		} else {
			row4 = "";
		}
		
		// input data barang
		var uid = gdSize_md3.uid(); 
		var posisi = gdSize_md3.getRowsNum();
		gdSize_md3.addRow(uid,[row1,row2,row3,row4,row5,row6,row7,row8,imgDelSize],posisi);
	}
	
	function gantiHargaBeli() {
		if(cbSatDasar_md3.getSelectedValue()==null) {
			cbSat = "";
		} else {
			cbSat = cbSatDasar_md3.getSelectedValue();
		}
		gdSize_md3.forEachRow(function(id){
			sat = gdSize_md3.cells(id,2).getValue();
			if(cbSat==sat) {
				gdSize_md3.cells(id,7).setValue($('#hrgBeli').val());
			}
		});
	}
	
	function cekDataBrg(idbarang,size,sat) {
		ada = 0;
		gdSize_md3.forEachRow(function(id){
			kdbrg = gdSize_md3.cells(id,0).getValue();
			kdsize = gdSize_md3.cells(id,1).getValue();
			kdsat = gdSize_md3.cells(id,2).getValue();
			if(idbarang == kdbrg && size == kdsize && sat == kdsat) {
				ada = 1;
				return ada;
			}
		});
		return ada;
	}
	
	function doOnCellEditgdSat_md3(stage, rowId, cellInd) {
	
		if(stage == 2 && cellInd == 2) {
			gdSize_md3.forEachRow(function(id){
				sat = gdSize_md3.cells(id,2).getValue();
				if(gdSat_md3.cells(rowId,0).getValue()==sat) {
					hrgBeli = gdSat_md3.cells(rowId,2).getValue();
					gdSize_md3.cells(id,7).setValue(hrgBeli);
				}
			});
			return true;
		}
	
		if(stage == 2 && cellInd == 1) {
			var id = gdSat_md3.uid(); 
			var posisi = gdSat_md3.getRowsNum();
			
			arrId = gdSat_md3.getAllItemIds().split(",");
			idcell = arrId[arrId.length - 1];
			celI = gdSat_md3.cells(idcell,0).getValue();
			if(celI != "") {
				gdSat_md3.addRow(id,['','','',imgDelSat],posisi);
				//gdSat_md3.selectRow(posisi);
			}
			
			jml = 0;
			for(n=0;n<arrSize.length;n++) {
				// input dari looping size
				uid = gdSize_md3.uid(); 
				posisi = gdSize_md3.getRowsNum();
				
				row1 = document.frm1_md3.txtKdItem.value;
				row2 = arrSize[n];
				row3 = gdSat_md3.cells(rowId,0).getValue();
				row5 = document.frm1_md3.txtKdItem.value+"."+row3+"."+row2;
				row6 = gdSat_md3.cells(rowId,1).getValue();
				row7 = document.frm1_md3.txtKdItem.value+"."+row3;
				row8 = gdSat_md3.cells(rowId,2).getValue();
				if(document.frm1_md3.cbBarcode.checked == true) {
					row4 = row5
				} else {
					row4 = "";
				}
				if(row2 != "") {
					if(document.getElementById(row2).checked == true && gdSat_md3.cells(rowId,0).getValue() != "") {
							if(cekDataBrg(row1,row2,row3)==0) {
								gdSize_md3.addRow(uid,[row1,row2,row3,row4,row5,row6,row7,row8,imgDelSize],posisi);
							}
								jml = 1;
							
					}
				}
				
			}
			// input jika size tidak dipilih
			if(jml==0) {
				uid = gdSize_md3.uid(); 
				posisi = gdSize_md3.getRowsNum();
				
				row1 = document.frm1_md3.txtKdItem.value;
				row2 = "";
				row3 = gdSat_md3.cells(rowId,0).getValue();
				row5 = document.frm1_md3.txtKdItem.value+"."+row3;
				row6 = gdSat_md3.cells(rowId,1).getValue();
				row7 = document.frm1_md3.txtKdItem.value+"."+row3;
				row8 = gdSat_md3.cells(rowId,2).getValue();
				if(document.frm1_md3.cbBarcode.checked == true) {
					row4 = row5
				} else {
					row4 = "";
				}
				if(gdSat_md3.cells(rowId,0).getValue() != "") {
					if(cekDataBrg(row1,row2,row3)==0) {
						gdSize_md3.addRow(uid,[row1,row2,row3,row4,row5,row6,row7,row8,imgDelSize],posisi);
					}
				}
			}
		}
		return true;
	}
	
	function cekSize_md3(idsize) {
		if(document.getElementById(idsize).checked == true) {
			tambahDataBrg_md3(idsize);
		} else {
			hapusDataBrg_md3(idsize);
		}
	}
	
	function tambahDataBrg_md3(idsize) {
	
		// hapus yang sizenya kosong
		gdSize_md3.forEachRow(function(id){
			if(gdSize_md3.cells(id,1).getValue() == "") {
				gdSize_md3.deleteRow(id);
			}
		});
	
		var uid = gdSize_md3.uid(); 
		var posisi = gdSize_md3.getRowsNum();
		
		if(cbSatDasar_md3.getSelectedValue() == null) {
			kdbrg = document.frm1_md3.txtKdItem.value+"."+idsize;
			idgroup = document.frm1_md3.txtKdItem.value;
		} else {
			kdbrg = document.frm1_md3.txtKdItem.value+"."+cbSatDasar_md3.getSelectedValue()+"."+idsize;
			idgroup = document.frm1_md3.txtKdItem.value+"."+cbSatDasar_md3.getSelectedValue();
		}
		
		var row1 = document.frm1_md3.txtKdItem.value;
		var row2 = idsize;
		var row3 = cbSatDasar_md3.getSelectedValue();
		var row5 = kdbrg;
		var row6 = "1";
		var row7 = idgroup;
		var row8 = $('#hrgBeli').val();
		if(document.frm1_md3.cbBarcode.checked == true) {
			row4 = row5
		} else {
			row4 = "";
		}
		
		gdSize_md3.addRow(uid,[row1,row2,row3,row4,row5,row6,row7,row8,imgDelSize],posisi);
		
		gdSat_md3.forEachRow(function(id){
		
			uid = gdSize_md3.uid(); 
			posisi = gdSize_md3.getRowsNum();
			
			row1 = document.frm1_md3.txtKdItem.value;
			row2 = idsize;
			row3 = gdSat_md3.cells(id,0).getValue();
			row5 = document.frm1_md3.txtKdItem.value+"."+row3+"."+idsize;
			row6 = gdSat_md3.cells(id,1).getValue();
			row7 = document.frm1_md3.txtKdItem.value+"."+row3;
			row8 = gdSat_md3.cells(id,2).getValue();
			if(document.frm1_md3.cbBarcode.checked == true) {
					row4 = row5
				} else {
					row4 = "";
				}
			
			if(row3 != "") {
				gdSize_md3.addRow(uid,[row1,row2,row3,row4,row5,row6,row7,row8,imgDelSize],posisi);
			}
		});
	}
	
	function hapusDataBrg_md3(idsize) {
		gdSize_md3.forEachRow(function(id){
			if(idsize == gdSize_md3.cells(id,1).getValue()) {
				gdSize_md3.deleteRow(id);
			}
		});
		if(gdSize_md3.getRowsNum()==0) {
			onChangecbSatDasar_md3();
		}
	}
	
	function hapusSatuan_md3() {
		idselect = gdSat_md3.getRowIndex(gdSat_md3.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = confirm("Apakah Anda Yakin ?");
		if(ya) {
			idrec = gdSat_md3.cells(gdSat_md3.getSelectedId(),0).getValue();
			gdSat_md3.deleteSelectedRows();
			gdSize_md3.forEachRow(function(id){
				if(idrec == gdSize_md3.cells(id,2).getValue()) {
					gdSize_md3.deleteRow(id);
				}
			});
		}
	}
	
</script>
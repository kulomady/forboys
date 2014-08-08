<div class="frmContainer">
  <form name="frm_alamat_md1" method="post" action="javascript:void(0);">
    <table width="341" border="0" align="center">
      <tr>
        <td width="76">Lokasi</td>
        <td width="255"><select name="slcLokasi" id="slcLokasi" style="width:210px;">
        	<?php echo $pilihJnsAlamat; ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><textarea name="txtAlamat" id="txtAlamat" cols="25" rows="5"></textarea></td>
      </tr>
      <tr>
        <td>Kota</td>
        <td id="tmpComboCity_md1"></td>
      </tr>
      <tr>
        <td>Kode Pos</td>
        <td><input name="txtKdPos" type="text" id="txtKdPos" size="5"></td>
      </tr>
    </table>
  </form>
  </div>
<script language="javascript">

var zJnsAlamat = dhtmlXComboFromSelect("slcLokasi");
zJnsAlamat.attachEvent("onChange", onChangezJnsAlamat);

function onChangezJnsAlamat() {
	idGrid = zJnsAlamat.getSelectedValue();
	try {
		document.frm_alamat_md1.txtAlamat.value = gdAlamat_md1.cells(idGrid,1).getValue();
		document.frm_alamat_md1.txtKdPos.value = gdAlamat_md1.cells(idGrid,3).getValue();
		pilihComboBox(cbCity_md1,gdAlamat_md1.cells(idGrid,5).getValue());
	} catch(e) {
		document.frm_alamat_md1.txtAlamat.value = "";
		document.frm_alamat_md1.txtKdPos.value = "";
		cbCity_md1.setComboText("");
	}
}

var cbCity_md1 = new dhtmlXCombo("tmpComboCity_md1", "cbCity_md1", 200);
cbCity_md1.enableFilteringMode(true);
loadCbCity_md1();
function loadCbCity_md1() {
	cbCity_md1.clearAll();
	cbCity_md1.loadXML(base_url+"index.php/rekan_bisnis/cbKota");
}

function tambahAlamat() {
	idJnsAlamat = zJnsAlamat.getSelectedValue();
	textJnsAlamat = zJnsAlamat.getSelectedText().toUpperCase();
	alamat = document.frm_alamat_md1.txtAlamat.value.toUpperCase();
	idCity = cbCity_md1.getSelectedValue();
	textCity = cbCity_md1.getSelectedText().toUpperCase();
	kdPos = document.frm_alamat_md1.txtKdPos.value;
	
	var idGrid = idJnsAlamat; 
	var posisi = gdAlamat_md1.getRowsNum();
	
	var ada = 0;
	gdAlamat_md1.forEachRow(function(id){
		if(id==idJnsAlamat) {
			ada = 1;
		}
	});
	
	if(ada==1) {
		alert("Jenis Alamat Sudah Ada, \n Tambah Alamat tidak dapat dilakukan \n Pilih Jenis Alamat Yang Lain.");
		return;
	}
	
	gdAlamat_md1.addRow(idGrid,[textJnsAlamat,alamat,textCity,kdPos,idJnsAlamat,idCity],posisi);
	gdAlamat_md1.selectRow(posisi)
	gdAlamat_md1.showRow(idGrid);
}
</script>

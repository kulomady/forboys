<div class="frmContainer">
<form name="frm_pr5" method="post" action="javascript:void(0);">
  <table width="443" border="0" align="center">
    <tr>
      <td>Tanggal</td>
      <td colspan="2"><input name="txttgl_pr5" type="text" id="txttgl_pr5" size="8" value="<?php if(isset($txttgl)) { echo $txttgl; } else { echo date("d/m/Y"); } ?>" readonly="readonly" />
        <span><img id="btntgl_pr5" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" />
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif;?>" />
        </span></td>
    </tr>
    <tr>
      <td>Cabang</td>
      <td colspan="2"><select name="slcOutlet_id" id="slcOutlet_id" style=" width:150px;">
        <?php echo $gudang; ?>
      </select></td>
    </tr>
    <tr>
      <td width="121">Nama</td>
      <td colspan="2"><input type="text" name="nama" id="nama" value="<?php if(isset($nama)): echo $nama; endif;?>" /></td>
    </tr>
    <tr>
      <td>Jenis Pekerjaan</td>
      <td colspan="2"><select name="jnsPekerjaan" id="jnsPekerjaan">
      <?php echo $pilihJnsPekerjaan; ?>
      </select></td>
      </tr>
    <tr>
      <td>Kode Akun Kas</td>
      <td width="94"><input name="kdakunKas" type="text" id="kdakunKas" size="8" value="<?php if(isset($idperkiraan_kas)): echo $idperkiraan_kas; endif;?>" />
      <img name="btnakunKas_pr5" id="btnakunKas_pr5" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkunKas_pr5();" /></td>
      <td width="214" id="tmpNmPerkiraanKas_pr5"><?php if(isset($nmperkiraan_kas)): echo $nmperkiraan_kas; endif;?></td>
    </tr>
    <tr>
      <td>Kode Akun Biaya</td>
      <td><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
        <img name="btnakun_pr5" id="btnakun_pr5" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_pr5();" /></td>
      <td id="tmpNmPerkiraan_pr5"><?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?></td>
    </tr>
    <tr>
      <td>Project Order</td>
      <td colspan="2"><select name="po" id="po">
      <?php echo $pilihPO; ?>
      </select></td>
    </tr>
    <tr>
      <td>Jumlah PO</td>
      <td colspan="2"><input name="jmlPo" type="text" id="jmlPo" size="5" value="<?php if(isset($jmlPo)): echo $jmlPo; endif;?>" /></td>
    </tr>
    <tr>
      <td>Jumlah Tagihan</td>
      <td colspan="2"><input name="jml" type="text" id="jml" style="text-align:right;" value="<?php if(isset($jml)): echo $jml; endif;?>"></td>
    </tr>
    <tr>
      <td valign="top">Keterangan</td>
      <td colspan="2"><textarea name="ket" id="ket" cols="20" rows="2"><?php if(isset($keterangan)): echo $keterangan; endif;?></textarea></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
cal1_pg2 = new dhtmlXCalendarObject({
		input: "txttgl_pr5",button: "btntgl_pr5"
});
cal1_pg2.setDateFormat("%d/%m/%Y");

$(function() {         
	$('#jml').number(true, 2);
});

function baru_pr5() {
	document.frm_pr5.slcOutlet_id.value = "";
	document.frm_pr5.nama.value = "";
	document.frm_pr5.txttgl_pr5.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_pr5.jnsPekerjaan.value = "";
	document.frm_pr5.kdakunKas.value = "";
	document.frm_pr5.kdakun.value = "";	
	document.frm_pr5.po.value = "";
	document.frm_pr5.jmlPo.value = "";
	document.frm_pr5.jml.value = "";
	document.frm_pr5.ket.value = "";
	document.getElementById('tmpNmPerkiraanKas_pr5').innerHTML = "";
	document.getElementById('tmpNmPerkiraan_pr5').innerHTML = "";
}

function winAkunKas_pr5() {
		try {
			if(w2_pr5.isHidden()==true) {
				w2_pr5.show();
				document.getElementById('frmSearchAkunKas_pr5').focus();
			}
			w2_pr5.bringToTop();
			return;
		} catch(e) {}
		w2_pr5 = dhxWins.createWindow("w2_pr5",0,0,430,450);
		w2_pr5.setText("Daftar Perkiraan Kas");
		w2_pr5.button("park").hide();
		w2_pr5.button("minmax1").hide();
		w2_pr5.center();
		
		tb_w2_pr5 = w2_pr5.attachToolbar();
		tb_w2_pr5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_pr5.setSkin("dhx_terrace");
		tb_w2_pr5.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_pr5.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahAkun_pr5(13);
			}
		});
		
		w2_pr5.attachURL(base_url+"index.php/prod_finishing/frm_search_akun_kas", true);
}

function winAkun_pr5() {
		try {
			if(w3_pr5.isHidden()==true) {
				w3_pr5.show();
				document.getElementById('frmSearchAkun_pr5').focus();
			}
			w3_pr5.bringToTop();
			return;
		} catch(e) {}
		w3_pr5 = dhxWins.createWindow("w3_pr5",0,0,430,450);
		w3_pr5.setText("Daftar Perkiraan");
		w3_pr5.button("park").hide();
		w3_pr5.button("minmax1").hide();
		w3_pr5.center();
		
		tb_w3_pr5 = w3_pr5.attachToolbar();
		tb_w3_pr5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w3_pr5.setSkin("dhx_terrace");
		tb_w3_pr5.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w3_pr5.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahAkun_pr5(13);
			}
		});
		
		w3_pr5.attachURL(base_url+"index.php/prod_finishing/frm_search_akun", true);
}



function simpan_pr5(){
		
		if(document.frm_pr5.txttgl_pr5.value == ""){
			alert("Tanggal Tidak Boleh Kosong !");
			document.frm_pr5.txttgl_pr5.focus();
			return;
		}
		
		if(document.frm_pr5.kdakunKas.value == ""){
			alert("Kode Akun Kas Tidak Boleh Kosong !");
			document.frm_pr5.kdakunKas.focus();
			return;
		}
		
		if(document.frm_pr5.kdakun.value == ""){
			alert("Kode Akun Biaya Tidak Boleh Kosong !");
			document.frm_pr5.kdakun.focus();
			return;
		}
		
		if(document.frm_pr5.jml.value == "" || document.frm_pr5.jml.value < 1){
			alert("Total Bayar Tidak Boleh Kosong !");
			document.frm_pr5.jml.focus();
			return;
		}
		
		var totalBayar = $('#jml').val();
		var postpr5 = 
			'id=' + document.frm_pr5.id.value +
			'&outlet_id=' + document.frm_pr5.slcOutlet_id.value +
			'&nama=' + document.frm_pr5.nama.value +
			'&tgl=' + document.frm_pr5.txttgl_pr5.value +
			'&jnsPekerjaan=' + document.frm_pr5.jnsPekerjaan.value +
			'&kdakunKas=' + document.frm_pr5.kdakunKas.value +
			'&kdakun=' + document.frm_pr5.kdakun.value +
			'&idjo=' + document.frm_pr5.po.value +
			'&jmlPo=' + document.frm_pr5.jmlPo.value +
			'&totalBayar=' + totalBayar +
			'&ket=' + document.frm_pr5.ket.value;
			
		statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/prod_finishing/simpan", encodeURI(postpr5), function(loader) {
			result = loader.xmlDoc.responseText;
			alert(result);
			statusEnding();
			refreshGd_pr5();	
		});			
	}
</script>

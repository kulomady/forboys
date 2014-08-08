<div class="frmContainer">
<form name="frm_ku3" method="post" action="javascript:void(0);">
  <table width="443" border="0" align="center">
    <tr>
      <td>PO</td>
      <td colspan="2"><input name="idjo" type="text" id="idjo" size="8" value="<?php if(isset($idjo)): echo $idjo; endif;?>"></td>
    </tr>
    <tr>
      <td>Nama CMT</td>
      <td colspan="2"><input type="text" name="nmcmt" id="nmcmt" readonly value="<?php if(isset($nmcmt)): echo $nmcmt; endif;?>">
      <input type="hidden" name="cmt" id="cmt" value="<?php if(isset($cmt)): echo $cmt; endif;?>">
      <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif;?>">
      <input type="hidden" name="kdtrans" id="kdtrans" value="<?php if(isset($kdtrans)): echo $kdtrans; endif;?>">
      </td>
    </tr>
    <tr>
      <td width="91">Tanggal</td>
      <td colspan="2"><input name="txttgl_ku3" type="text" id="txttgl_ku3" size="8" value="<?php if(isset($txttgl)) { echo $txttgl; } else { echo date("d/m/Y"); } ?>" readonly="readonly">        <span><img id="btntgl_ku3" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" /></span></td>
    </tr>
    <tr>
      <td>Kode Akun</td>
      <td width="93"><input name="kdakun" type="text" id="kdakun" size="8" value="<?php if(isset($idperkiraan)): echo $idperkiraan; endif;?>" />
      <img name="btnakun_pd1" id="btnakun_pd1" src="<?php echo base_url(); ?>assets/codebase_toolbar/icon/expand_orange.png" border="0" style="cursor:pointer;" onclick="winAkun_ku3();" /></td>
      <td width="237" id="tmpNmPerkiraan_ku3"><?php if(isset($nmperkiraan)): echo $nmperkiraan; endif;?></td>
    </tr>
    <tr>
      <td>Jumlah Bayar</td>
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
		input: "txttgl_ku3",button: "btntgl_ku3"
});
cal1_pg2.setDateFormat("%d/%m/%Y");

$(function() {         
	$('#jml').number(true, 2);
});

function baru_ku3() {
	document.frm_ku3.nmcmt.value = "";
	document.frm_ku3.cmt.value = "";
	document.frm_ku3.txttgl_ku3.value = "<?php echo date("d/m/Y"); ?>";
	document.frm_ku3.kdakun.value = "";
	document.frm_ku3.jml.value = "";
	document.frm_ku3.ket.value = "";	
	document.frm_ku3.kdtrans.value = "";
	document.getElementById('tmpNmPerkiraan_ku3').innerHTML = "";
}

function winAkun_ku3() {
		try {
			if(w2_ku3.isHidden()==true) {
				w2_ku3.show();
				document.getElementById('frmSearchAkun_ku3').focus();
			}
			w2_ku3.bringToTop();
			return;
		} catch(e) {}
		w2_ku3 = dhxWins.createWindow("w2_ku3",0,0,430,450);
		w2_ku3.setText("Daftar Perkiraan");
		w2_ku3.button("park").hide();
		w2_ku3.button("minmax1").hide();
		w2_ku3.center();
		
		tb_w2_ku3 = w2_ku3.attachToolbar();
		tb_w2_ku3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
		tb_w2_ku3.setSkin("dhx_terrace");
		tb_w2_ku3.addButton("pakai", 1, "GUNAKAN", "add.gif", "add_dis.gif");
		tb_w2_ku3.attachEvent("onclick", function(id) {
			if(id=='pakai') {
				tandaPanahAkun_ku3(13);
			}
		});
		
		w2_ku3.attachURL(base_url+"index.php/pembayaran_cmt/frm_search_akun", true);
}

function simpan_ku3(){
		
		if(document.frm_ku3.txttgl_ku3.value == ""){
			alert("Tanggal Tidak Boleh Kosong !");
			document.frm_ku3.txttgl_ku3.focus();
			return;
		}
		
		if(document.frm_ku3.kdakun.value == ""){
			alert("Kode Akun Tidak Boleh Kosong !");
			document.frm_ku3.kdakun.focus();
			return;
		}
		
		if(document.frm_ku3.jml.value == "" || document.frm_ku3.jml.value < 1){
			alert("Total Bayar Tidak Boleh Kosong !");
			document.frm_ku3.jml.focus();
			return;
		}
		
		var totalBayar = $('#jml').val();
		var postku3 = 
			'id=' + document.frm_ku3.id.value +
			'&idjo=' + document.frm_ku3.idjo.value +
			'&idrekan=' + document.frm_ku3.cmt.value +
			'&tgl=' + document.frm_ku3.txttgl_ku3.value +
			'&idperkiraan=' + document.frm_ku3.kdakun.value +
			'&jml=' + totalBayar +
			'&ket=' + document.frm_ku3.ket.value +
			'&kdtrans=' + document.frm_ku3.kdtrans.value;
		statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pembayaran_cmt/simpan", encodeURI(postku3), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			if(document.frm_ku3.id.value=="") {
				loadSubGd_ku3();	
			} else {
				refreshGd_ku3();
			}
		});			
	}
</script>

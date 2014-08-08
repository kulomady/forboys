<style>
	legend {
		font-weight:bold;
	}
</style>
<div class="frmContainer">
<form name="frm_mk2" id="frm_mk2" method="post" action="javascript:void(0);">
	<table style="padding-left:15px;">
    	<tr>
        	<td width="200">&nbsp;&nbsp;&nbsp;NUP</td>
            <td>&nbsp;&nbsp;&nbsp;<input type="text" size="30" id="nup" name="nup" readonly="readonly" value="<?php if(isset($nup)): echo $nup; endif;?>" /><input type="hidden" size="30" id="id" name="id" value="<?php if(isset($id)): echo $id; endif;?>" /></td>
     	</tr>
  	</table>
    	<fieldset>
        	<legend>Data Pemesan</legend>
        	<table style="padding-left:15px;">
                <tr>
                	<td width="200">Nama Konsumen </td>
                    <td><input type="text" size="30" id="nama_konsumen" name="nama_konsumen" value="<?php if(isset($nama_konsumen)): echo $nama_konsumen; endif;?>" /></td>
                </tr>
                <tr>
                    <td valign="top">Alamat</td>
                    <td><textarea name="alamat" id="alamat" cols="43" rows="2"><?php if(isset($alamat)): echo $alamat; endif;?></textarea></td>
                </tr>
                <tr>
                	<td>No. Telp Rumah / No. HP</td>
                    <td><input type="text" id="tlp_rumah" name="tlp_rumah" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_rumah)): echo $tlp_rumah; endif;?>" />&nbsp;/&nbsp;
                    <input type="text" id="tlp_hp" name="tlp_hp" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($tlp_hp)): echo $tlp_hp; endif;?>" /></td>
                </tr>
                <tr>
                	<td>Email</td>
                    <td><input type="text" size="30" id="email" name="email" value="<?php if(isset($email)): echo $email; endif;?>" /></td>
                </tr>
                <tr>
                	<td>No. Rek. Konsumen</td>
                    <td><input type="text" size="30" id="rek" name="rek" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($rek)): echo $rek; endif;?>" /></td>
                </tr>
            </table>
        </fieldset>
      	<br />
    	<fieldset>
        	<legend>Pembayaran</legend>
        	<table style="padding-left:15px;">
            	<tr>
                	<td width="200"><input type="radio" id="credit" name="type" value="credit" onClick="pil_credit();" <?php if(isset($type)){ if($type=='credit'){ echo 'checked'; } else { echo ''; } } ?>>&nbsp;Credit Card</td>
                    <td><input type="text" size="30" name="no_credit" id="no_credit" disabled="disabled" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($type)){ if($type=='credit'){ echo $no_card; } else { echo ""; } }?>"></td>
                </tr>
                <tr>
                	<td><input type="radio" id="debit" name="type" value="debit" onClick="pil_debit();" <?php if(isset($type)){ if($type=='debit'){ echo 'checked'; } else { echo ''; } } ?>>&nbsp;Debit Card</td>
                    <td><input type="text" size="30" name="no_debit" id="no_debit" disabled="disabled" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($type)){ if($type=='debit'){ echo $no_card; } else { echo ""; } }?>"></td>
                </tr>
                <tr>
                	<td><input type="radio" id="transfer" name="type" value="transfer" onClick="pil();" <?php if(isset($type)){ if($type=='transfer'){ echo 'checked'; } else { echo ''; } } ?>>&nbsp;Transfer</td>
                    <td><input type="radio" id="banking" name="type" value="banking" onClick="pil();" <?php if(isset($type)){ if($type=='banking'){ echo 'checked'; } else { echo ''; } } ?>>&nbsp;Internet Banking</td>
                </tr>
                <tr>
                	<td>&nbsp;&nbsp;Jumlah Rp.</td>
                    <td><input type="text" id="jumlah" size="30" name="jumlah" style="text-align:right;" value="<?php if(isset($jumlah)): echo $jumlah; endif;?>" /></td>
                </tr>
            </table>
        </fieldset>
        <br />
        <fieldset>
        	<legend>Pilihan Unit</legend>
        	<table style="padding-left:15px;">
                <tr>
                	<td><input type="radio" id="studio" name="units" value="studio" <?php if(isset($units)){ if($units=='studio'){ echo 'checked'; } else { echo ''; } } ?>>&nbsp;Studio
                    &nbsp;&nbsp;&nbsp;<input type="radio" id="sbedroom" name="units" value="sbedroom" <?php if(isset($units)){ if($units=='sbedroom'){ echo 'checked'; } else { echo ''; } } ?>>&nbsp;1 Bedroom
                    &nbsp;&nbsp;&nbsp;<input type="radio" id="dbedroom" name="units" value="dbedroom" <?php if(isset($units)){ if($units=='dbedroom'){ echo 'checked'; } else { echo ''; } } ?>>&nbsp;2 Bedroom</td>
                </tr>
            </table>
        </fieldset>
        <br />
        <fieldset>
        	<legend>Sales/Agent</legend>
        	<table style="padding-left:15px;">
                <tr>
                	<td width="200">Sales </td>
                    <td><select style='width:200px;' id="combo_zone1" name="sales">
                    <?php echo $opt; ?>
                    </select></td>
                </tr>
                <tr>
                	<td>No. Hp</td>
                    <td><input type="text" size="30" id="hp" name="hp" style="text-align:right;" onkeypress="return hanyaAngka(event, false)" value="<?php if(isset($hp)): echo $hp; endif;?>" /></td>
                </tr>
            </table>
        </fieldset>
</form>
</div>
<script language="javascript">
	function hanyaAngka(e, decimal) {
		var key;
		var keychar;
		 if (window.event) {
			 key = window.event.keyCode;
		 } else
		 if (e) {
			 key = e.which;
		 } else return true;
		
		//alert(key);
		keychar = String.fromCharCode(key);
		if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
			return true;
		} else 
		if ((("0123456789").indexOf(keychar) > -1)) {
			return true; 
		} else 
		if (decimal && (keychar == ".")) {
			return true; 
		} else return false; 
    }

document.frm_mk2.nama_konsumen.focus();
	var z = dhtmlXComboFromSelect("combo_zone1");
	$(function() {
		$('#jumlah').number(true, 2);
	});

<?php if(isset($type)){ if($type=='credit'){ ?> document.frm_mk2.no_credit.disabled = false; <?php } } ?>
<?php if(isset($type)){ if($type=='debit'){ ?> document.frm_mk2.no_debit.disabled = false; <?php } } ?>

function pil_credit(){
	document.frm_mk2.no_credit.disabled = false;
	document.frm_mk2.no_debit.disabled = true;
	document.frm_mk2.no_debit.value = "";
	document.frm_mk2.no_credit.focus();
}

function pil_debit(){
	document.frm_mk2.no_credit.value = "";
	document.frm_mk2.no_credit.disabled = true;
	document.frm_mk2.no_debit.disabled = false;
	document.frm_mk2.no_debit.focus();
}

function pil(){
	document.frm_mk2.no_credit.disabled = true;
	document.frm_mk2.no_debit.disabled = true;
}

function baru_mk2(){
	document.frm_mk2.id.value = "";
	document.frm_mk2.nup.value = "";
	document.frm_mk2.nama_konsumen.value = "";
	document.frm_mk2.alamat.value = "";
	document.frm_mk2.tlp_rumah.value = "";
	document.frm_mk2.tlp_hp.value = "";
	document.frm_mk2.email.value = "";
	document.frm_mk2.rek.value = "";
	document.frm_mk2.credit.checked == false;
	document.frm_mk2.no_credit.value = "";
	document.frm_mk2.debit.checked == false;
	document.frm_mk2.no_debit.value = "";
	document.frm_mk2.transfer.checked == false;
	document.frm_mk2.banking.checked == false;
	document.frm_mk2.jumlah.value = "";
	document.frm_mk2.studio.checked == false;
	document.frm_mk2.sbedroom.checked == false;
	document.frm_mk2.dbedroom.checked == false;
	document.frm_mk2.sales.value = "";
	document.frm_mk2.hp.value = "";
}

	function simpan_mk2(){
		if(document.frm_mk2.nama_konsumen.value==""){
			alert("Nama Konsumen tidak boleh kosong !");
			document.frm_mk2.nama_konsumen.focus();
			return;
		}
		
		//type
		if(document.frm_mk2.credit.checked == true){
			var type = 'credit';
			var no_card = document.frm_mk2.no_credit.value;
		} else if(document.frm_mk2.debit.checked == true){
			var type = 'debit';
			var no_card = document.frm_mk2.no_debit.value;
		} else if(document.frm_mk2.transfer.checked == true){
			var type = 'transfer';
			var no_card = 0;
		} else if(document.frm_mk2.banking.checked == true){
			var type = 'banking';
			var no_card = 0;
		}
		
		//units
		if(document.frm_mk2.studio.checked == true){
			var units = 'studio';
		} else if(document.frm_mk2.sbedroom.checked == true){
			var units = 'sbedroom';
		} else if(document.frm_mk2.dbedroom.checked == true){
			var units = 'dbedroom';
		}
		
		var jumlah = $('#jumlah').val();	
		var postData = 
			'id='+ document.frm_mk2.id.value +
			'&nup=' + document.frm_mk2.nup.value +
			'&nama_konsumen=' + document.frm_mk2.nama_konsumen.value +
			'&alamat=' + document.frm_mk2.alamat.value +
			'&tlp_rumah=' + document.frm_mk2.tlp_rumah.value +
			'&tlp_hp=' + document.frm_mk2.tlp_hp.value +
			'&email=' + document.frm_mk2.email.value +
			'&rek=' + document.frm_mk2.rek.value +
			'&type=' + type +
			'&no_card=' + no_card +
			'&jumlah=' + jumlah +
			'&unit=' + units +
			'&sales=' + document.frm_mk2.sales.value +
			'&hp=' + document.frm_mk2.hp.value;
		statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/fps/simpan", encodeURI(postData), function(loader) {
			result = loader.xmlDoc.responseText;
			if(result){
				statusEnding();
				refreshGd_mk2();
				document.frm_mk2.nup.value = result;
				tb_w1_mk2.disableItem("save");
				tb_w1_mk2.enableItem("baru");
			} else {
				statusEnding();
				alert("Proses Gagal");
			}
		});	
	}
</script>
<div class="frmContainer">
<form name="frm_pg12" id="frm_pg12" method="post" action="javascript:void(0);">
  <table width="312" border="0" align="center">
    <tr>
      <td width="138">Nama Pengguna</td>
      <td width="158"><input type="text" name="nmPengguna" id="nmPengguna" style="text-transform:none;" value="<?php if(isset($username)): echo $username; endif; ?>"></td>
    </tr>
    <tr>
      <td>Kata Kunci</td>
      <td><input type="password" name="kataKunci" id="kataKunci"></td>
    </tr>
    <tr>
      <td>Kata Kunci Ulang</td>
      <td><input type="password" name="kataKunciUlang" id="kataKunciUlang"></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><input type="text" name="nama" id="nama" value="<?php if(isset($first_name)): echo $first_name; endif; ?>"></td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td><input type="text" name="tlp" id="tlp" value="<?php if(isset($phone)): echo $phone; endif; ?>"></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td><input type="text" name="email" id="email" style="text-transform:none;" value="<?php if(isset($email)): echo $email; endif; ?>"></td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td><select name="outlet_id" id="outlet_id" style="width:158px;">
      <?php echo $lokasi; ?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Kelompok Pengguna</td>
      <td><select name="group_id" id="group_id" style="width:158px;">
      	 <?php echo $userGroup; ?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Status</td>
      <td><select name="status" id="status">
      	<option value=""></option>
        <option value="1" <?php if(isset($active) && $active == '1'): echo 'selected="selected"'; endif;?>>Aktif</option>
        <option value="0" <?php if(isset($active) && $active == '0'): echo 'selected="selected"'; endif;?>>Pasif</option>
      </select>
        <input type="hidden" name="id" id="id" value="<?php if(isset($id)): echo $id; endif; ?>">      </td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">
function simpan_pg12() {

	if(document.frm_pg12.nmPengguna.value == "") {
		alert("Nama Pengguna Tidak Boleh Kosong");
		document.frm_pg12.nmPengguna.focus();
		return;
	}
	if(document.frm_pg12.kataKunci.value == "") {
		alert("Password Tidak Boleh Kosong");
		document.frm_pg12.kataKunci.focus();
		return;
	}
	if(document.frm_pg12.kataKunci.value != document.frm_pg12.kataKunciUlang.value) {
		alert("Password Tidak Sama");
		document.frm_pg12.kataKunciUlang.focus();
		return;
	}
	if(document.frm_pg12.nama.value == "") {
		alert("Nama Tidak Boleh Kosong");
		document.frm_pg12.nama.focus();
		return;
	}
	if(document.frm_pg12.outlet_id.value == "") {
		alert("Lokasi Tidak Boleh Kosong");
		document.frm_pg12.outlet_id.focus();
		return;
	}
	if(document.frm_pg12.group_id.value == "") {
		alert("Group Tidak Boleh Kosong");
		document.frm_pg12.group_id.focus();
		return;
	}
	if(document.frm_pg12.status.value == "") {
		alert("Status Tidak Boleh Kosong");
		document.frm_pg12.status.focus();
		return;
	}
 	var poststr =
			'id=' + document.frm_pg12.id.value +
            '&nmPengguna=' + document.frm_pg12.nmPengguna.value +
			'&kataKunci=' + document.frm_pg12.kataKunci.value +
			'&nama=' + document.frm_pg12.nama.value +
			'&tlp=' + document.frm_pg12.tlp.value +
			'&email=' + document.frm_pg12.email.value +
			'&outlet_id=' + document.frm_pg12.outlet_id.value +
			'&group_id=' + document.frm_pg12.group_id.value +
			'&status=' + document.frm_pg12.status.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/user/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			if(result==2) {
				alert("Username Tidak Tersedia");
				return;
			}
			refreshGd_pg12();
			tb_w1_pg12.disableItem("save");
			tb_w1_pg12.enableItem("baru");
		});
}

function baru_pg12() {
	document.frm_pg12.id.value = "";
	document.frm_pg12.nmPengguna.value = "";
	document.frm_pg12.kataKunci.value = "";
	document.frm_pg12.kataKunciUlang.value = "";
	document.frm_pg12.nama.value = "";
	document.frm_pg12.tlp.value = "";
	document.frm_pg12.email.value = "";
	document.frm_pg12.outlet_id.value = "";
	document.frm_pg12.group_id.value = "";
	document.frm_pg12.status.value = "";
}
</script>
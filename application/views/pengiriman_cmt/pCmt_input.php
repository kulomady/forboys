<div class="frmContainer">
<form name="frm_pr4" id="frm_pr4" method="post" action="javascript:void(0);">
  <table width="758" border="0" align="center">
    
    <tr>
      <td width="109">No. JO / PO</td>
      <td width="288"><input type="text" name="textfield" id="textfield">
        <input type="button" name="button" id="button" value="PILIH" /></td>
      <td width="129">Lokasi</td>
      <td width="214"><select name="select2" id="select2" style="width:200px;">
      </select>
      </td>
    </tr>
    <tr>
      <td>Nama JO / PO</td>
      <td><select name="select" id="select" style="width:150px;">
      </select></td>
      <td>CMT</td>
      <td><select name="select3" id="select3" style="width:200px;">
      </select>
      </td>
    </tr>
    <tr>
      <td>Bahan</td>
      <td><input type="text" name="textfield2" id="textfield2" /></td>
      <td>Jumlah</td>
      <td><input type="text" name="textfield3" id="textfield3" /></td>
    </tr>
    
    <tr>
      <td colspan="4"><div id="tmpGridBrg_pr4" style="height:300px; width:100%;"></div></td>
      </tr>
  </table>
</form>
</div>
<script language="javascript">


gdBrg_pr4 = new dhtmlXGridObject('tmpGridBrg_pr4');
gdBrg_pr4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdBrg_pr4.setHeader("Kode Item,Nama Barang,Satuan,Warna,Jumlah",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdBrg_pr4.setInitWidths("80,200,100,100,100");
gdBrg_pr4.setColAlign("left,left,left,left,left");
gdBrg_pr4.setColSorting("str,str,str,str,str");
gdBrg_pr4.setColTypes("ro,ro,ro,ro,ro");
gdBrg_pr4.setSkin("dhx_skyblue");
gdBrg_pr4.init();
</script>

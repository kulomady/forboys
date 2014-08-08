<div class="frmContainer">
<form name="frm_pr5" id="frm_pr5" method="post" action="javascript:void(0);">
  <table width="851" border="0" align="center">
    
    <tr>
      <td width="109">No. JO / PO</td>
      <td width="288"><input type="text" name="textfield" id="textfield">
        <input type="button" name="button" id="button" value="PILIH" /></td>
      <td width="129">Bahan</td>
      <td width="307"><input type="text" name="textfield2" id="textfield2" /></td>
    </tr>
    <tr>
      <td>Nama JO / PO</td>
      <td><select name="select" id="select" style="width:150px;">
      </select></td>
      <td>Jumlah</td>
      <td><input type="text" name="textfield3" id="textfield3" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="4"><div id="tmpGridBrg_pr5" style="height:300px; width:100%;"></div></td>
      </tr>
  </table>
</form>
</div>
<script language="javascript">


gdBrg_pr5 = new dhtmlXGridObject('tmpGridBrg_pr5');
gdBrg_pr5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdBrg_pr5.setHeader("JO/PO,CMT,Kode Item,Nama Barang,Satuan,Size,Jumlah",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdBrg_pr5.setInitWidths("100,100,80,200,100,100,100");
gdBrg_pr5.setColAlign("left,left,left,left,left,left,left");
gdBrg_pr5.setColSorting("str,str,str,str,str,str,str");
gdBrg_pr5.setColTypes("ro,ro,ro,ro,ro,ro,ro");
gdBrg_pr5.setSkin("dhx_skyblue");
gdBrg_pr5.init();
</script>

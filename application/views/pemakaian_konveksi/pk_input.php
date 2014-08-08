<div class="frmContainer">
<form name="frm_pd1" id="frm_pd1" method="post" action="javascript:void(0);">
  <table width="959" border="0" align="center">
    
    <tr>
      <td width="108">No. JO / PO</td>
      <td width="246"><input type="text" name="textfield" id="textfield">
        <input type="button" name="button" id="button" value="PILIH" /></td>
      <td width="105">Nama JO / PO</td>
      <td width="312"><select name="select" id="select" style="width:150px;">
      </select></td>
    </tr>
    <tr>
      <td>Bahan</td>
      <td><input type="text" name="textfield2" id="textfield2" /></td>
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
      <td colspan="4"><div id="tmpGridBrg_pd1" style="height:300px; width:100%;"></div></td>
      </tr>
  </table>
</form>
</div>
<script language="javascript">


gdBrg_pd1 = new dhtmlXGridObject('tmpGridBrg_pd1');
gdBrg_pd1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdBrg_pd1.setHeader("Kode Item,Nama Barang,Satuan,PP (CM),Warna,Jumlah,Yards,Lapis,GBR,Jml,BDG,Pmkn.BHN",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdBrg_pd1.setInitWidths("70,100,70,70,70,70,70,70,70,70,70,70");
gdBrg_pd1.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left");
gdBrg_pd1.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str");
gdBrg_pd1.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gdBrg_pd1.setSkin("dhx_skyblue");
gdBrg_pd1.init();
</script>

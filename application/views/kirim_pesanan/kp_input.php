<div class="frmContainer">
<form name="frm_md28" id="frm_md28" method="post" action="javascript:void(0);">
  <table width="918" border="0" align="center">
    
    <tr>
      <td width="108">No. Transaksi</td>
      <td width="287"><input type="text" name="textfield" id="textfield"></td>
      <td colspan="2" rowspan="3" align="right" bgcolor="#CCCCCC"><h1>0.0</h1></td>
      </tr>
    <tr>
      <td>Pelanggan</td>
      <td><select name="select" id="select" style="width:150px;">
      </select>      </td>
      </tr>
    <tr>
      <td>Tanggal</td>
      <td><input type="text" name="textfield2" id="textfield2"></td>
      </tr>
    
    <tr>
      <td colspan="4"><div id="tmpGridBrg_pj1" style="height:250px; width:100%;"></div></td>
      </tr>
    <tr>
      <td>Sales</td>
      <td><select name="select2" id="select2" style="width:150px;">
      </select></td>
      <td width="345"><div align="right">Sub Total :</div></td>
      <td width="160" align="left"><input name="textfield3" type="text" id="textfield3" size="3" />
        <input name="textfield4" type="text" id="textfield4" size="10" /></td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td><select name="select3" id="select3" style="width:150px;">
      </select></td>
      <td><div align="right">Potongan :</div></td>
      <td align="left"><input name="textfield5" type="text" id="textfield5" size="3" />
        <input name="textfield5" type="text" id="textfield6" size="10" /></td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td><input type="text" name="textfield10" id="textfield10" /></td>
      <td><div align="right">Pajak :</div></td>
      <td align="left"><input name="textfield6" type="text" id="textfield7" size="3" />
        <input name="textfield6" type="text" id="textfield8" size="10" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="right">Biaya Lain :</div></td>
      <td align="left"><input type="text" name="textfield9" id="textfield9" /></td>
    </tr>
  </table>
</form>
</div>
<script language="javascript">


gdBrg_pj1 = new dhtmlXGridObject('tmpGridBrg_pj1');
gdBrg_pj1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gdBrg_pj1.setHeader("Kode Item,Nama Item,Jumlah,Satuan,Harga,Pot (%),Total",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gdBrg_pj1.setInitWidths("100,100,100,100,100,100,100");
gdBrg_pj1.setColAlign("left,left,left,left,left,left,left");
gdBrg_pj1.setColSorting("str,str,str,str,str,str,str");
gdBrg_pj1.setColTypes("ro,ro,ro,ro,ro,ro,ro");
gdBrg_pj1.setSkin("dhx_skyblue");
gdBrg_pj1.init();
</script>

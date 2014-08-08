<?php

/*
 * closing_bulanan.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>
<html>
<style type="text/css">
<!--
.style1 {color: #FF0000}
body {
    background-color: #FF0000;
}
-->
</style>
<body>
    <div class="frmContainer" style="height: 100%;">
<form name="frm_ak81" id="frm_ak81" method="post" action="javascript:void(0);">
  <fieldset>
  <legend><strong>Closing Bulanan</strong></legend>
  <p class="style1">
      Closing Bulanan adalah proses perhitungan data persediaan dan penjurnalan.
  </p>
  <p class="style1">
      Proses ini dapat dilakukan setiap saat jika anda membutuhkan informasi persediaan, Jurnal, dan Laporan yang berkaitan dengan Akuntansi.
  </p>
  <p class="style1">
      Apabila terdapat perubahan data pada bulan sebelumnya maka anda diwajibkan untuk melakukan proses ini agar nilai-nilainya dapat berpindah pada bulan berikutnya.
  </p>
  <p class="style1">
      Proses ini sebaiknya dilakukan pada saat tidak ada aktivitas / tutup toko.
  </p>
  <br /><br />
  <table border="0">
      <tr>
          <td>Periode : </td>
          <td><select name="periode_bulan" id="periode_bulan">
      	<?php echo $bulan; ?>
      </select>&nbsp;</td>
          <td>
      <select name="periode_tahun" id="periode_tahun">
      	<?php echo $tahun; ?>
      </select>
              </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
      <td><input type="button" id="btn_closing_bulanan" name="btn_closing_bulanan" value="PROSES" onclick="closing_bulanan();" /></td>
  </tr>
  </table>
 </p>
  </fieldset>
</form>
</div>

<script language="javascript">
    function closing_bulanan(){
        var bln = document.frm_ak81.periode_bulan.value;
        var thn = document.frm_ak81.periode_tahun.value;
        
        poststr =
            'txtbln=' + bln +
            '&txtthn=' + thn ;
        
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/closing/exe_closing_bulanan", encodeURI(poststr), outputSimpan_ak81);
    }
        
  function outputSimpan_ak81(loader) {
      result = loader.xmlDoc.responseText;     
      statusEnding();
      alert("Tutup Buku Bulanan Berhasil Dilakukan");
  }
</script>
</body>
</html>
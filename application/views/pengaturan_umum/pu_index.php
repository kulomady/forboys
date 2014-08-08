<fieldset> <legend>Label Tanda Tangan
  </legend>
  <table width="355" border="0">
    <tr>
      <td width="349"><div id="tmpGrid_pg3" style="height:200px;width: 100%"></div></td>
    </tr>
  </table>
</fieldset>
<script language="javascript">
	
gd_pg3 = new dhtmlXGridObject('tmpGrid_pg3');
gd_pg3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pg3.setHeader("&nbsp;,Label,isi");
gd_pg3.setInitWidths("30,150,150");
gd_pg3.setColAlign("right,left,left");
gd_pg3.setColSorting("na,connector,connector");
gd_pg3.setColTypes("cntr,ro,ed");
gd_pg3.setColumnColor("#CCE2FE,#CCE2FE");
gd_pg3.setSkin("dhx_skyblue");
gd_pg3.init();
gd_pg3.loadXML(base_url+"index.php/pengaturan_umum/tanda_tangan");

var dp_pg3 = new dataProcessor(base_url+"index.php/pengaturan_umum/tanda_tangan");
dp_pg3.init(gd_pg3);
</script>
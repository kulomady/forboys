<div class="frmContainer">
<form name="frm_pg11" id="frm_pg11" method="post" action="javascript:void(0);">
  <table width="618" border="0" align="center">
    <tr>
      <td width="88">Nama Group</td>
      <td width="183"><input type="text" name="txtNmGroup" id="txtNmGroup" value="<?php if(isset($name)): echo $name; endif; ?>"></td>
      <td width="325" valign="top"><input type="hidden" name="idgroup" id="idgroup" value="<?php if(isset($id)): echo $id; endif; ?>" /></td>
      </tr>
    <tr>
      <td>Keterangan</td>
      <td><input type="text" name="txtNmKet" id="txtNmKet" value="<?php if(isset($description)): echo $description; endif; ?>"></td>
      <td width="325" valign="top">&nbsp;</td>
      </tr>
    <tr>
      <td height="276" colspan="3" valign="top"><div id="a_tabbar" style="width:600px; height:400px;"/></td>
      </tr>
  </table>
</form>
</div>
<script language="javascript">
tabbar_pg11 = new dhtmlXTabBar("a_tabbar", "top");
tabbar_pg11.setSkin('dhx_skyblue');
tabbar_pg11.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
tabbar_pg11.addTab("a1", "Menu", "100px");
tabbar_pg11.addTab("a2", "Laporan", "100px");
tabbar_pg11.addTab("a3", "Akses Lokasi", "100px");
tabbar_pg11.setTabActive("a1");

gridMenu_pg11 = tabbar_pg11.cells("a1").attachGrid();
gridMenu_pg11.setSkin("dhx_skyblue");
gridMenu_pg11.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gridMenu_pg11.setHeader("Menu,Baru,Ubah,Hapus,Cetak,Kunci Tgl,idparent,idmenu");
gridMenu_pg11.setInitWidths("200,60,60,60,60,60,0,0");
gridMenu_pg11.setColTypes("tree,ch,ch,ch,ch,ch,ro,ro");
gridMenu_pg11.setColAlign("left,center,center,center,center,center,center,center");
gridMenu_pg11.setColSorting("connector,connector,connector,connector,connector,connector,connector,connector");
gridMenu_pg11.attachEvent("onCheck", function(rId,cInd,state){

	if(gridMenu_pg11.getAllSubItems(rId) != '') {
		subMenu_pg11 = gridMenu_pg11.getAllSubItems(rId).split(",");
		for(i=0;i < subMenu_pg11.length; i++) {
			id = subMenu_pg11[i];
			gridMenu_pg11.cells(id,cInd).setValue(state);
		}
		
		// Cek header
		level = gridMenu_pg11.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = gridMenu_pg11.getParentId(rId);
				gridMenu_pg11.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = gridMenu_pg11.getParentId(rId);
			gridMenu_pg11.forEachRow(function(id){
				if(gridMenu_pg11.cells(id,6).getValue() == idParent && gridMenu_pg11.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = gridMenu_pg11.getParentId(rId);
					gridMenu_pg11.cells(rId,cInd).setValue(state);
				}
			}
		}
		//
	} else {
		// Cek header
		level = gridMenu_pg11.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = gridMenu_pg11.getParentId(rId);
				gridMenu_pg11.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = gridMenu_pg11.getParentId(rId);
			gridMenu_pg11.forEachRow(function(id){
				if(gridMenu_pg11.cells(id,6).getValue() == idParent && gridMenu_pg11.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = gridMenu_pg11.getParentId(rId);
					gridMenu_pg11.cells(rId,cInd).setValue(state);
				}
			}
		}
		// End Header
	}
});
gridMenu_pg11.init();
loadMenu_pg11();

function loadMenu_pg11() {
	gridMenu_pg11.clearAll();
	gridMenu_pg11.loadXML("<?php echo base_url(); ?>index.php/group_user/dataMenu/"+document.frm_pg11.idgroup.value,function() {
		gridMenu_pg11.expandAll();
	});
}

// Report
gridRpt_pg11 = tabbar_pg11.cells("a2").attachGrid();
gridRpt_pg11.setSkin("dhx_skyblue");
gridRpt_pg11.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gridRpt_pg11.setHeader("Nama Report,Pilih,idparent,idreport");
gridRpt_pg11.setInitWidths("300,60,0,0");
gridRpt_pg11.setColTypes("tree,ch,ro,ro");
gridRpt_pg11.setColAlign("left,center,center,center");
gridRpt_pg11.setColSorting("connector,connector,connector,connector");
gridRpt_pg11.attachEvent("onCheck", function(rId,cInd,state){

	if(gridRpt_pg11.getAllSubItems(rId) != '') {
		subRpt_pg11 = gridRpt_pg11.getAllSubItems(rId).split(",");
		for(i=0;i < subRpt_pg11.length; i++) {
			id = subRpt_pg11[i];
			gridRpt_pg11.cells(id,cInd).setValue(state);
		}
		
		// Cek header
		level = gridRpt_pg11.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = gridRpt_pg11.getParentId(rId);
				gridRpt_pg11.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = gridRpt_pg11.getParentId(rId);
			gridRpt_pg11.forEachRow(function(id){
				if(gridRpt_pg11.cells(id,2).getValue() == idParent && gridRpt_pg11.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = gridRpt_pg11.getParentId(rId);
					gridRpt_pg11.cells(rId,cInd).setValue(state);
				}
			}
		}
		//
	} else {
		// Cek header
		level = gridRpt_pg11.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = gridRpt_pg11.getParentId(rId);
				gridRpt_pg11.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = gridRpt_pg11.getParentId(rId);
			gridRpt_pg11.forEachRow(function(id){
				if(gridRpt_pg11.cells(id,2).getValue() == idParent && gridRpt_pg11.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = gridRpt_pg11.getParentId(rId);
					gridRpt_pg11.cells(rId,cInd).setValue(state);
				}
			}
		}
		
	}
});
gridRpt_pg11.init();
loadRpt_pg11();

function loadRpt_pg11() {
	gridRpt_pg11.clearAll();
	gridRpt_pg11.loadXML("<?php echo base_url(); ?>index.php/group_user/dataReport/"+document.frm_pg11.idgroup.value,function() {
		gridRpt_pg11.expandAll();
	});
}

// Outlet
gridOutlet_pg11 = tabbar_pg11.cells("a3").attachGrid();
gridOutlet_pg11.setSkin("dhx_skyblue");
gridOutlet_pg11.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gridOutlet_pg11.setHeader("Nama Outlet,Pilih,idparent,idreport");
gridOutlet_pg11.setInitWidths("300,60,0,0");
gridOutlet_pg11.setColTypes("tree,ch,ro,ro");
gridOutlet_pg11.setColAlign("left,center,center,center");
gridOutlet_pg11.setColSorting("connector,connector,connector,connector");
gridOutlet_pg11.attachEvent("onCheck", function(rId,cInd,state){

	if(gridOutlet_pg11.getAllSubItems(rId) != '') {
		subOutlet_pg11 = gridOutlet_pg11.getAllSubItems(rId).split(",");
		for(i=0;i < subOutlet_pg11.length; i++) {
			id = subOutlet_pg11[i];
			gridOutlet_pg11.cells(id,cInd).setValue(state);
		}
		
		// Cek header
		level = gridOutlet_pg11.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = gridOutlet_pg11.getParentId(rId);
				gridOutlet_pg11.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = gridOutlet_pg11.getParentId(rId);
			gridOutlet_pg11.forEachRow(function(id){
				if(gridOutlet_pg11.cells(id,2).getValue() == idParent && gridOutlet_pg11.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = gridOutlet_pg11.getParentId(rId);
					gridOutlet_pg11.cells(rId,cInd).setValue(state);
				}
			}
		}
		//
	} else {
		// Cek header
		level = gridOutlet_pg11.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = gridOutlet_pg11.getParentId(rId);
				gridOutlet_pg11.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = gridOutlet_pg11.getParentId(rId);
			gridOutlet_pg11.forEachRow(function(id){
				if(gridOutlet_pg11.cells(id,2).getValue() == idParent && gridOutlet_pg11.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = gridOutlet_pg11.getParentId(rId);
					gridOutlet_pg11.cells(rId,cInd).setValue(state);
				}
			}
		}
		// End Header
	}
});
gridOutlet_pg11.init();
loadOulet_pg11();

function loadOulet_pg11() {
	gridOutlet_pg11.clearAll();
	gridOutlet_pg11.loadXML("<?php echo base_url(); ?>index.php/group_user/dataOutlet/"+document.frm_pg11.idgroup.value,function() {
		gridOutlet_pg11.expandAll();
	});
}

// Proses Simpan
function simpan_pg11() {
 	var poststr =
            'dataMenu=' + getData(gridMenu_pg11,[0,6]) +
			'&dataReport=' + getData(gridRpt_pg11,[0,2]) +
			'&dataOutlet=' + getData(gridOutlet_pg11,[0,2]) +
			'&nmGroup=' + document.frm_pg11.txtNmGroup.value +
			'&nmKet=' + document.frm_pg11.txtNmKet.value +
			'&idgroup=' + document.frm_pg11.idgroup.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/group_user/simpan", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			statusEnding();
			refreshGd_pg11();
			tb_w1_pg11.disableItem("save");
			tb_w1_pg11.disableItem("batal");
			tb_w1_pg11.enableItem("baru");
		});
}

function baru_pg11() {
	document.frm_pg11.txtNmGroup.value = "";
	document.frm_pg11.txtNmKet.value = "";
	document.frm_pg11.idgroup.value = "";
	gridRpt_pg11.clearAll();
	gridMenu_pg11.clearAll();
}
</script>

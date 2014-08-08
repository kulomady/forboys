<div id="tmpTb_pr1" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pr1" style="height:450px;width: 100%"></div>

<script language="javascript">
tb_pr1 = new dhtmlXToolbarObject("tmpTb_pr1");
tb_pr1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr1.setSkin("dhx_terrace");
tb_pr1.attachEvent("onclick", tbClick_pr1);
tb_pr1.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	tb_pr1.hideItem('print');
	<?php echo $hak_toolbar; ?>
});

function tbClick_pr1(id) {
	if(id=='new') {
		winForm_pr1('input');
	} else if(id=='edit') {
		winForm_pr1('edit');
	} else if(id=='del') {
		hapus_pr1();
	}
}

gd_pr1 = new dhtmlXGridObject('tmpGrid_pr1');
gd_pr1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr1.setHeader("&nbsp;,Tanggal,Kode,Nama PO,Artikel,Bahan,Jml PO,Tgl Selesai,Status,Tgl Buat, Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr1.setInitWidths("30,70,60,120,120,150,65,70,60,100,80");
gd_pr1.setColAlign("right,left,left,left,left,left,left,left,left,left,left");
gd_pr1.setColSorting("na,str,str,str,str,str,str,str,str,str,str");
gd_pr1.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
//gd_pr1.enableSmartRendering(true,50);
gd_pr1.setColumnColor("#CCE2FE");
gd_pr1.setSkin("dhx_skyblue");
gd_pr1.splitAt(1);
gd_pr1.init();
loadGd_pr1();

function loadGd_pr1() {
	gd_pr1.clearAll();
	gd_pr1.loadXML(base_url+"index.php/job_order/loadMainData");
}

function refreshGd_pr1() {
	gd_pr1.updateFromXML(base_url+"index.php/job_order/loadMainData");
}

function winForm_pr1(type) {
	idselect = gd_pr1.getRowIndex(gd_pr1.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr1 = dhxWins.createWindow("w1_pr1",0,0,550,330);
	w1_pr1.setText("Project Order (PO)");
	w1_pr1.button("park").hide();
	w1_pr1.button("minmax1").hide();
	w1_pr1.center();
	w1_pr1.setModal(true);
	if(type=='input') {
		w1_pr1.attachURL(base_url+"index.php/job_order/frm_input", true);
	} else {
		w1_pr1.attachURL(base_url+"index.php/job_order/frm_edit/"+gd_pr1.getSelectedId(), true);
	}
	
	w1_pr1.button("close").attachEvent("onClick", function() {
        w4_pr1.close(); 
	   	w1_pr1.close();
		return;
    });
	
	tb_w1_pr1 = w1_pr1.attachToolbar();
	tb_w1_pr1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr1.setSkin("dhx_terrace");
	tb_w1_pr1.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr1.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr1.disableItem("baru");
	tb_w1_pr1.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pr1();
		} else if(id=='baru') {
			tb_w1_pr1.disableItem("baru");
			tb_w1_pr1.enableItem("save");
			baru_pr1();
		}
	});

}

function hapus_pr1() {
	idselect = gd_pr1.getRowIndex(gd_pr1.getSelectedId());
	if(idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	var ya = prompt("Ketik 'ya' Jika anda yakin !","");
	if(ya=='ya') {
		 poststr =
            	'idrec=' + gd_pr1.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/job_order/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				gd_pr1.deleteSelectedItem();
			});
		}
}

</script>
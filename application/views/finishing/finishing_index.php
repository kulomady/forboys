<div id="tmpTb_pr6" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pr6" style="height:400px;width: 100%"></div>
<div id="tmpInfoGrid_pr6" style="background-color:#B8E0F5; padding-top:5px;"></div>

<script language="javascript">
tb_pr6 = new dhtmlXToolbarObject("tmpTb_pr6");
tb_pr6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr6.setSkin("dhx_terrace");
tb_pr6.attachEvent("onclick", tbClick_pr6);
tb_pr6.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

function tbClick_pr6(id) {
	if(id=='new') {
		winForm_pr6('input');
	} else if(id=='edit') {
		winForm_pr6('edit');
	} else if(id=='del') {
		hapus_pr6();
	}
}

gd_pr6 = new dhtmlXGridObject('tmpGrid_pr6');
gd_pr6.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr6.setHeader("&nbsp;,No.LPB,No.PO,Lokasi,Divisi,Tanggal,Supplier,No.Invoice,Tgl Buat,Dibuat Oleh,Tgl Modifikasi,Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr6.setInitWidths("30,100,200,100,100,100,100,100,100,100,100,100");
gd_pr6.setColAlign("right,left,left,left,left,left,left,left,left,left,left,left");
gd_pr6.setColSorting("na,int,str,str,int,int,str,date,date,str,str,str");
gd_pr6.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pr6.enableSmartRendering(true,50);
gd_pr6.setColumnColor("#CCE2FE");
gd_pr6.setSkin("dhx_skyblue");
gd_pr6.splitAt(3);
gd_pr6.init();
loadGd_pr6();

function loadGd_pr6() {
	gd_pr6.clearAll();
	gd_pr6.loadXML(base_url+"index.php/finishing/loadMainData");
}

function refreshGd_pr6() {
	gd_pr6.updateFromXML(base_url+"index.php/finishing/loadMainData");
}

gd_pr6.enablePaging(true, 50, 5, "tmpInfoGrid_pr6");
gd_pr6.setPagingSkin("toolbar", "dhx_terrace");


function winForm_pr6(type) {
	idselect = gd_pr6.getRowIndex(gd_pr6.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr6 = dhxWins.createWindow("w1_pr6",0,0,1000,600);
	w1_pr6.setText("Tambah Data Finishing");
	w1_pr6.button("park").hide();
	w1_pr6.button("minmax1").hide();
	w1_pr6.center();
	w1_pr6.setModal(true);
	if(type=='input') {
		w1_pr6.attachURL(base_url+"index.php/finishing/frm_input", true);
	} else {
		w1_pr6.attachURL(base_url+"index.php/finishing/frm_edit/"+gd_pr6.getSelectedId(), true);
	}
	
	tb_w1_pr6 = w1_pr6.attachToolbar();
	tb_w1_pr6.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr6.setSkin("dhx_terrace");
	tb_w1_pr6.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr6.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr6.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_pr6.disableItem("baru");
	tb_w1_pr6.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_pr6 = document.frm_pr6.hKp_pr6.value;
			var kota_pr6 = document.frm_pr6.hKota_pr6.value;
			document.frm_pr6.reset();
			// Kantor Pusat
			IDcbKP_pr6 = cbKP_pr6.getIndexByValue(kp_pr6);
			cbKP_pr6.selectOption(IDcbKP_pr6,true,true);
			// Kota
			IDcbKota_pr6 = cbKota_pr6.getIndexByValue(kota_pr6);
			cbKota_pr6.selectOption(IDcbKota_pr6,true,true);
		} else if(id=='save') {
			simpan_pr6();
		} else if(id=='baru') {
			tb_w1_pr6.disableItem("baru");
			tb_w1_pr6.enableItem("save");
			tb_w1_pr6.enableItem("batal");
			baru_pr6();
		}
	});

}

function hapus_pr6() {
		idselect = gd_pr6.getRowIndex(gd_pr6.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
			 poststr =
            	'idrec=' + gd_pr6.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/finishing/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				loadGd_pr6();
			});
		}
	}

</script>

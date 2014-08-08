<div id="tmpTb_pr4" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pr4" style="height:400px;width: 100%"></div>
<div id="tmpInfoGrid_pr4" style="background-color:#B8E0F5; padding-top:5px;"></div>

<script language="javascript">
tb_pr4 = new dhtmlXToolbarObject("tmpTb_pr4");
tb_pr4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr4.setSkin("dhx_terrace");
tb_pr4.attachEvent("onclick", tbClick_pr4);
tb_pr4.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

function tbClick_pr4(id) {
	if(id=='new') {
		winForm_pr4('input');
	} else if(id=='edit') {
		winForm_pr4('edit');
	} else if(id=='del') {
		hapus_pr4();
	}
}

gd_pr4 = new dhtmlXGridObject('tmpGrid_pr4');
gd_pr4.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr4.setHeader("&nbsp;,No.LPB,No.PO,Lokasi,Divisi,Tanggal,Supplier,No.Invoice,Tgl Buat,Dibuat Oleh,Tgl Modifikasi,Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr4.setInitWidths("30,100,200,100,100,100,100,100,100,100,100,100");
gd_pr4.setColAlign("right,left,left,left,left,left,left,left,left,left,left,left");
gd_pr4.setColSorting("na,int,str,str,int,int,str,date,date,str,str,str");
gd_pr4.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pr4.enableSmartRendering(true,50);
gd_pr4.setColumnColor("#CCE2FE");
gd_pr4.setSkin("dhx_skyblue");
gd_pr4.splitAt(3);
gd_pr4.init();
loadGd_pr4();

function loadGd_pr4() {
	gd_pr4.clearAll();
	gd_pr4.loadXML(base_url+"index.php/pengiriman_cmt/loadMainData");
}

function refreshGd_pr4() {
	gd_pr4.updateFromXML(base_url+"index.php/pengiriman_cmt/loadMainData");
}

gd_pr4.enablePaging(true, 50, 5, "tmpInfoGrid_pr4");
gd_pr4.setPagingSkin("toolbar", "dhx_terrace");


function winForm_pr4(type) {
	idselect = gd_pr4.getRowIndex(gd_pr4.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr4 = dhxWins.createWindow("w1_pr4",0,0,1000,600);
	w1_pr4.setText("Tambah Data Pengiriman CMT");
	w1_pr4.button("park").hide();
	w1_pr4.button("minmax1").hide();
	w1_pr4.center();
	w1_pr4.setModal(true);
	if(type=='input') {
		w1_pr4.attachURL(base_url+"index.php/pengiriman_cmt/frm_input", true);
	} else {
		w1_pr4.attachURL(base_url+"index.php/pengiriman_cmt/frm_edit/"+gd_pr4.getSelectedId(), true);
	}
	
	tb_w1_pr4 = w1_pr4.attachToolbar();
	tb_w1_pr4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr4.setSkin("dhx_terrace");
	tb_w1_pr4.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr4.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr4.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_pr4.disableItem("baru");
	tb_w1_pr4.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_pr4 = document.frm_pr4.hKp_pr4.value;
			var kota_pr4 = document.frm_pr4.hKota_pr4.value;
			document.frm_pr4.reset();
			// Kantor Pusat
			IDcbKP_pr4 = cbKP_pr4.getIndexByValue(kp_pr4);
			cbKP_pr4.selectOption(IDcbKP_pr4,true,true);
			// Kota
			IDcbKota_pr4 = cbKota_pr4.getIndexByValue(kota_pr4);
			cbKota_pr4.selectOption(IDcbKota_pr4,true,true);
		} else if(id=='save') {
			simpan_pr4();
		} else if(id=='baru') {
			tb_w1_pr4.disableItem("baru");
			tb_w1_pr4.enableItem("save");
			tb_w1_pr4.enableItem("batal");
			baru_pr4();
		}
	});

}

function hapus_pr4() {
		idselect = gd_pr4.getRowIndex(gd_pr4.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
			 poststr =
            	'idrec=' + gd_pr4.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pengiriman_cmt/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				loadGd_pr4();
			});
		}
	}

</script>

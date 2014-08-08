<div id="tmpTb_pr5" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pr5" style="height:400px;width: 100%"></div>
<div id="tmpInfoGrid_pr5" style="background-color:#B8E0F5; padding-top:5px;"></div>

<script language="javascript">
tb_pr5 = new dhtmlXToolbarObject("tmpTb_pr5");
tb_pr5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr5.setSkin("dhx_terrace");
tb_pr5.attachEvent("onclick", tbClick_pr5);
tb_pr5.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

function tbClick_pr5(id) {
	if(id=='new') {
		winForm_pr5('input');
	} else if(id=='edit') {
		winForm_pr5('edit');
	} else if(id=='del') {
		hapus_pr5();
	}
}

gd_pr5 = new dhtmlXGridObject('tmpGrid_pr5');
gd_pr5.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr5.setHeader("&nbsp;,No.LPB,No.PO,Lokasi,Divisi,Tanggal,Supplier,No.Invoice,Tgl Buat,Dibuat Oleh,Tgl Modifikasi,Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr5.setInitWidths("30,100,200,100,100,100,100,100,100,100,100,100");
gd_pr5.setColAlign("right,left,left,left,left,left,left,left,left,left,left,left");
gd_pr5.setColSorting("na,int,str,str,int,int,str,date,date,str,str,str");
gd_pr5.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pr5.enableSmartRendering(true,50);
gd_pr5.setColumnColor("#CCE2FE");
gd_pr5.setSkin("dhx_skyblue");
gd_pr5.splitAt(3);
gd_pr5.init();
loadGd_pr5();

function loadGd_pr5() {
	gd_pr5.clearAll();
	gd_pr5.loadXML(base_url+"index.php/terima_cmt/loadMainData");
}

function refreshGd_pr5() {
	gd_pr5.updateFromXML(base_url+"index.php/terima_cmt/loadMainData");
}

gd_pr5.enablePaging(true, 50, 5, "tmpInfoGrid_pr5");
gd_pr5.setPagingSkin("toolbar", "dhx_terrace");


function winForm_pr5(type) {
	idselect = gd_pr5.getRowIndex(gd_pr5.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr5 = dhxWins.createWindow("w1_pr5",0,0,1000,600);
	w1_pr5.setText("Tambah Data Terima CMT");
	w1_pr5.button("park").hide();
	w1_pr5.button("minmax1").hide();
	w1_pr5.center();
	w1_pr5.setModal(true);
	if(type=='input') {
		w1_pr5.attachURL(base_url+"index.php/terima_cmt/frm_input", true);
	} else {
		w1_pr5.attachURL(base_url+"index.php/terima_cmt/frm_edit/"+gd_pr5.getSelectedId(), true);
	}
	
	tb_w1_pr5 = w1_pr5.attachToolbar();
	tb_w1_pr5.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr5.setSkin("dhx_terrace");
	tb_w1_pr5.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr5.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr5.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_pr5.disableItem("baru");
	tb_w1_pr5.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_pr5 = document.frm_pr5.hKp_pr5.value;
			var kota_pr5 = document.frm_pr5.hKota_pr5.value;
			document.frm_pr5.reset();
			// Kantor Pusat
			IDcbKP_pr5 = cbKP_pr5.getIndexByValue(kp_pr5);
			cbKP_pr5.selectOption(IDcbKP_pr5,true,true);
			// Kota
			IDcbKota_pr5 = cbKota_pr5.getIndexByValue(kota_pr5);
			cbKota_pr5.selectOption(IDcbKota_pr5,true,true);
		} else if(id=='save') {
			simpan_pr5();
		} else if(id=='baru') {
			tb_w1_pr5.disableItem("baru");
			tb_w1_pr5.enableItem("save");
			tb_w1_pr5.enableItem("batal");
			baru_pr5();
		}
	});

}

function hapus_pr5() {
		idselect = gd_pr5.getRowIndex(gd_pr5.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
			 poststr =
            	'idrec=' + gd_pr5.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/terima_cmt/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				loadGd_pr5();
			});
		}
	}

</script>

<div id="tmpTb_pr3" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pr3" style="height:400px;width: 100%"></div>

<script language="javascript">
tb_pr3 = new dhtmlXToolbarObject("tmpTb_pr3");
tb_pr3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr3.setSkin("dhx_terrace");
tb_pr3.attachEvent("onclick", tbClick_pr3);
tb_pr3.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

function tbClick_pr3(id) {
	if(id=='new') {
		winForm_pr3('input');
	} else if(id=='edit') {
		winForm_pr3('edit');
	} else if(id=='del') {
		hapus_pr3();
	}
}

gd_pr3 = new dhtmlXGridObject('tmpGrid_pr3');
gd_pr3.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr3.setHeader("&nbsp;,No.Trans,Tanggal,Gudang,No.PO,Jml Lusin,Kd Akun,Keterangan,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr3.setInitWidths("30,100,80,150,100,80,200,200,100,100");
gd_pr3.setColAlign("right,left,left,left,left,left,left,left,left,left");
gd_pr3.setColSorting("na,int,str,str,int,int,str,date,date,str");
gd_pr3.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pr3.enableSmartRendering(true,50);
gd_pr3.setColumnColor("#CCE2FE");
gd_pr3.setSkin("dhx_skyblue");
gd_pr3.splitAt(1);
gd_pr3.init();
loadGd_pr3();

function loadGd_pr3() {
	gd_pr3.clearAll();
	gd_pr3.loadXML(base_url+"index.php/pemakaian_bahan_pembantu/loadMainData");
}

function refreshGd_pr3() {
	gd_pr3.updateFromXML(base_url+"index.php/pemakaian_bahan_pembantu/loadMainData");
}


function winForm_pr3(type) {
	idselect = gd_pr3.getRowIndex(gd_pr3.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr3 = dhxWins.createWindow("w1_pr3",0,0,830,460);
	w1_pr3.setText("Pemakaian Bahan Pembantu");
	w1_pr3.button("park").hide();
	w1_pr3.button("minmax1").hide();
	w1_pr3.center();
	w1_pr3.setModal(true);
	if(type=='input') {
		w1_pr3.attachURL(base_url+"index.php/pemakaian_bahan_pembantu/frm_input", true);
	} else {
		w1_pr3.attachURL(base_url+"index.php/pemakaian_bahan_pembantu/frm_edit/"+gd_pr3.getSelectedId(), true);
	}
	
	tb_w1_pr3 = w1_pr3.attachToolbar();
	tb_w1_pr3.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr3.setSkin("dhx_terrace");
	tb_w1_pr3.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr3.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr3.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pr3();
		} else if(id=='baru') {
			tb_w1_pr3.enableItem("baru");
			tb_w1_pr3.enableItem("save");
			baru_pr3();
		}
	});

}

function hapus_pr3() {
		idselect = gd_pr3.getRowIndex(gd_pr3.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pr3.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemakaian_bahan_pembantu/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pr3.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}

</script>

<div id="tmpTb_pr2" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pr2" style="height:400px;width: 100%"></div>

<script language="javascript">
tb_pr2 = new dhtmlXToolbarObject("tmpTb_pr2");
tb_pr2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pr2.setSkin("dhx_terrace");
tb_pr2.attachEvent("onclick", tbClick_pr2);
tb_pr2.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

function tbClick_pr2(id) {
	if(id=='new') {
		winForm_pr2('input');
	} else if(id=='edit') {
		winForm_pr2('edit');
	} else if(id=='del') {
		hapus_pr2();
	}
}

gd_pr2 = new dhtmlXGridObject('tmpGrid_pr2');
gd_pr2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pr2.setHeader("&nbsp;,No.Trans,Tanggal,Gudang,No.PO,Jml Lusin,Kd Akun,Keterangan,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr2.setInitWidths("30,100,80,150,100,80,200,200,100,100");
gd_pr2.setColAlign("right,left,left,left,left,left,left,left,left,left");
gd_pr2.setColSorting("na,int,str,str,int,int,str,date,date,str");
gd_pr2.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pr2.enableSmartRendering(true,50);
gd_pr2.setColumnColor("#CCE2FE");
gd_pr2.setSkin("dhx_skyblue");
gd_pr2.splitAt(1);
gd_pr2.init();
loadGd_pr2();

function loadGd_pr2() {
	gd_pr2.clearAll();
	gd_pr2.loadXML(base_url+"index.php/pemakaian_bahan_baku/loadMainData");
}

function refreshGd_pr2() {
	gd_pr2.updateFromXML(base_url+"index.php/pemakaian_bahan_baku/loadMainData");
}


function winForm_pr2(type) {
	idselect = gd_pr2.getRowIndex(gd_pr2.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr2 = dhxWins.createWindow("w1_pr2",0,0,830,460);
	w1_pr2.setText("Pemakaian Bahan Baku");
	w1_pr2.button("park").hide();
	w1_pr2.button("minmax1").hide();
	w1_pr2.center();
	w1_pr2.setModal(true);
	if(type=='input') {
		w1_pr2.attachURL(base_url+"index.php/pemakaian_bahan_baku/frm_input", true);
	} else {
		w1_pr2.attachURL(base_url+"index.php/pemakaian_bahan_baku/frm_edit/"+gd_pr2.getSelectedId(), true);
	}
	
	tb_w1_pr2 = w1_pr2.attachToolbar();
	tb_w1_pr2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr2.setSkin("dhx_terrace");
	tb_w1_pr2.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr2.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr2.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pr2();
		} else if(id=='baru') {
			tb_w1_pr2.enableItem("baru");
			tb_w1_pr2.enableItem("save");
			baru_pr2();
		}
	});

}

function hapus_pr2() {
		idselect = gd_pr2.getRowIndex(gd_pr2.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pr2.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemakaian_bahan_baku/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pr2.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}

</script>

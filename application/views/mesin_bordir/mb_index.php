<div id="tmpTb_pr4" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pr4" style="height:400px;width: 100%"></div>

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
gd_pr4.setHeader("&nbsp;,No.Trans,Tanggal,Gudang,No.PO,Jml Lusin,Mesin,Shift,S s.d L,3 s.d 5,6 s.d 8,10 s.d 12,Jml Stick,Total,Tgl Buat,Dibuat Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pr4.setInitWidths("30,120,70,150,80,65,65,65,65,65,65,65,65,80,100,100");
gd_pr4.setColAlign("right,left,left,left,left,left,left,left,right,right,right,right,right,right,left,left");
gd_pr4.setColSorting("na,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
gd_pr4.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ron,ron,ron,ron,ron,ron,ro,ro");
gd_pr4.enableSmartRendering(true,50);
gd_pr4.setColumnColor("#CCE2FE");
gd_pr4.setNumberFormat("0,000",8,",",".");
gd_pr4.setNumberFormat("0,000",9,",",".");
gd_pr4.setNumberFormat("0,000",10,",",".");
gd_pr4.setNumberFormat("0,000",11,",",".");
gd_pr4.setNumberFormat("0,000",12,",",".");
gd_pr4.setNumberFormat("0,000.00",13,",",".");
gd_pr4.setSkin("dhx_skyblue");
gd_pr4.splitAt(1);
gd_pr4.attachFooter("&nbsp;,Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:center>{#stat_total}</div>,<div style=text-align:right id=tmpTotal_pd1>{#stat_total}</div>,<div style=text-align:right id=tmpTotal_pd1>{#stat_total}</div>,&nbsp;,&nbsp;");
gd_pr4.init();


loadGd_pr4();

function loadGd_pr4() {
	gd_pr4.clearAll();
	gd_pr4.loadXML(base_url+"index.php/mesin_bordir/loadMainData");
}

function refreshGd_pr4() {
	gd_pr4.updateFromXML(base_url+"index.php/mesin_bordir/loadMainData");
}


function winForm_pr4(type) {
	idselect = gd_pr4.getRowIndex(gd_pr4.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pr4 = dhxWins.createWindow("w1_pr4",0,0,830,460);
	w1_pr4.setText("Mesin Bordir");
	w1_pr4.button("park").hide();
	w1_pr4.button("minmax1").hide();
	w1_pr4.center();
	w1_pr4.setModal(true);
	if(type=='input') {
		w1_pr4.attachURL(base_url+"index.php/mesin_bordir/frm_input", true);
	} else {
		w1_pr4.attachURL(base_url+"index.php/mesin_bordir/frm_edit/"+gd_pr4.getSelectedId(), true);
	}
	
	tb_w1_pr4 = w1_pr4.attachToolbar();
	tb_w1_pr4.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pr4.setSkin("dhx_terrace");
	tb_w1_pr4.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pr4.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pr4.attachEvent("onclick", function(id) {
		if(id=='save') {
			simpan_pr4();
		} else if(id=='baru') {
			tb_w1_pr4.enableItem("baru");
			tb_w1_pr4.enableItem("save");
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
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pr4.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/mesin_bordir/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					gd_pr4.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert(result);
				}
			});
		}
	}

</script>

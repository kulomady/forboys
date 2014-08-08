<div id="tmpTb_pj1" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpGrid_pj1" style="height:400px;width: 100%"></div>
<div id="tmpInfoGrid_pj1" style="background-color:#B8E0F5; padding-top:5px;"></div>

<script language="javascript">
tb_pj1 = new dhtmlXToolbarObject("tmpTb_pj1");
tb_pj1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pj1.setSkin("dhx_terrace");
tb_pj1.attachEvent("onclick", tbClick_pj1);
tb_pj1.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

function tbClick_pj1(id) {
	if(id=='new') {
		winForm_pj1('input');
	} else if(id=='edit') {
		winForm_pj1('edit');
	} else if(id=='del') {
		hapus_pj1();
	}
}

gd_pj1 = new dhtmlXGridObject('tmpGrid_pj1');
gd_pj1.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pj1.setHeader("&nbsp;,No.Transaksi,Tanggal,Cara Bayar,Kd.Supp,Nama,Mata Uang,Keterangan,Total,Tgl Buat,Dibuat Oleh,Tgl Modifikasi,Dimodifikasi Oleh",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pj1.setInitWidths("30,100,200,100,100,100,100,100,100,100,100,100,100");
gd_pj1.setColAlign("right,left,left,left,left,left,left,left,left,left,left,left,left");
gd_pj1.setColSorting("na,int,str,str,int,int,str,date,date,str,str,str,str");
gd_pj1.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pj1.enableSmartRendering(true,50);
gd_pj1.setColumnColor("#CCE2FE");
gd_pj1.setSkin("dhx_skyblue");
gd_pj1.splitAt(3);
gd_pj1.init();
loadGd_pj1();

function loadGd_pj1() {
	gd_pj1.clearAll();
	gd_pj1.loadXML(base_url+"index.php/kirim_pesanan/loadMainData");
}

function refreshGd_pj1() {
	gd_pj1.updateFromXML(base_url+"index.php/kirim_pesanan/loadMainData");
}

gd_pj1.enablePaging(true, 50, 5, "tmpInfoGrid_pj1");
gd_pj1.setPagingSkin("toolbar", "dhx_terrace");


function winForm_pj1(type) {
	idselect = gd_pj1.getRowIndex(gd_pj1.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pj1 = dhxWins.createWindow("w1_pj1",0,0,1000,600);
	w1_pj1.setText("Tambah Pengiriman Pesanan");
	w1_pj1.button("park").hide();
	w1_pj1.button("minmax1").hide();
	w1_pj1.center();
	w1_pj1.setModal(true);
	if(type=='input') {
		w1_pj1.attachURL(base_url+"index.php/kirim_pesanan/frm_input", true);
	} else {
		w1_pj1.attachURL(base_url+"index.php/kirim_pesanan/frm_edit/"+gd_pj1.getSelectedId(), true);
	}
	
	tb_w1_pj1 = w1_pj1.attachToolbar();
	tb_w1_pj1.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pj1.setSkin("dhx_terrace");
	tb_w1_pj1.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pj1.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pj1.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_pj1.disableItem("baru");
	tb_w1_pj1.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_pj1 = document.frm_pj1.hKp_pj1.value;
			var kota_pj1 = document.frm_pj1.hKota_pj1.value;
			document.frm_pj1.reset();
			// Kantor Pusat
			IDcbKP_pj1 = cbKP_pj1.getIndexByValue(kp_pj1);
			cbKP_pj1.selectOption(IDcbKP_pj1,true,true);
			// Kota
			IDcbKota_pj1 = cbKota_pj1.getIndexByValue(kota_pj1);
			cbKota_pj1.selectOption(IDcbKota_pj1,true,true);
		} else if(id=='save') {
			simpan_pj1();
		} else if(id=='baru') {
			tb_w1_pj1.disableItem("baru");
			tb_w1_pj1.enableItem("save");
			tb_w1_pj1.enableItem("batal");
			baru_pj1();
		}
	});

}

function hapus_pj1() {
		idselect = gd_pj1.getRowIndex(gd_pj1.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		cf = confirm("Apakah Anda Yakin ?");
		if(cf) {
			 poststr =
            	'idrec=' + gd_pj1.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/pemby_supplier/hapus", encodeURI(poststr), function(loader) {
				statusEnding();
				loadGd_pj1();
			});
		}
	}

</script>

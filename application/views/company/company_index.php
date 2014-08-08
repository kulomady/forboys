<div id="tmpTb_pg2" style="background-color:#B8E0F5; padding:3px; padding-bottom:0px;"></div>
<div id="tmpLayout_pg2" style="position: relative; width: 100%; height: 91%; border: #B5CDE4 1px solid;"></div>
<div id="tmpSearch_pg2" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; display:none;">
  <form id="frmSearch_pg2" name="frmSearch_pg2" method="post" action="javascript:void(0);">
    <table width="956" border="0">
      <tr>
        <td width="50">Kode</td>
        <td width="200"><input type="text" name="kode" id="kode" /></td>
        <td width="50">Nama</td>
        <td width="200"><input type="text" name="nama" id="nama" /></td>
        <td><input type="button" name="button" id="button" value="CARI" onclick="loadGd_pg2();" /></td>
      </tr>
    </table>
  </form>
</div>

<script language="javascript">
tb_pg2 = new dhtmlXToolbarObject("tmpTb_pg2");
tb_pg2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_pg2.setSkin("dhx_terrace");
tb_pg2.attachEvent("onclick", tbClick_pg2);
tb_pg2.loadXML(base_url+"assets/codebase_toolbar/dhxtoolbar.xml?etc=" + new Date().getTime(),function() {
	<?php echo $hak_toolbar; ?>
});

dhxLayout_pg2 = new dhtmlXLayoutObject("tmpLayout_pg2", "2E");
dhxLayout_pg2.cells("a").setText("Cari Data");
dhxLayout_pg2.setCollapsedText("a","<strong>Cari Data</strong>");
dhxLayout_pg2.cells("a").setHeight(60);
dhxLayout_pg2.cells("a").collapse();
dhxLayout_pg2.cells("a").attachObject("tmpSearch_pg2");
dhxLayout_pg2.cells("b").setText("Site Navigation");
dhxLayout_pg2.cells("b").hideHeader();

function tbClick_pg2(id) {
	if(id=='new') {
		winForm_pg2('input');
	} else if(id=='edit') {
		winForm_pg2('edit');
	} else if(id=='del') {
		hapus_pg2();
	} else if(id=='refresh') {
		loadGd_pg2();
	} else if(id=='print') {
		cetak_pg2();
	} else if(id=='cari') {
		if(dhxLayout_pg2.cells("a").isCollapsed()) {
			dhxLayout_pg2.cells("a").expand();
		} else {
			dhxLayout_pg2.cells("a").collapse();
		}
	}
}

gd_pg2 = dhxLayout_pg2.cells("b").attachGrid();
gd_pg2.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_pg2.setHeader("&nbsp;,Kode,Nama Perusahaan,Alamat,Telp,Fax,NPWP,Tgl PKP,Tgl Buka,Type,Kantor Pusat,Kota,Aktif",null,
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_pg2.setInitWidths("30,70,150,200,100,100,100,70,70,70,150,120,70");
gd_pg2.setColAlign("right,left,left,left,left,left,left,left,left,left,left,left,left");
gd_pg2.setColSorting("na,int,str,str,int,int,str,date,date,str,str,str,str");
gd_pg2.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_pg2.enableSmartRendering(true,50);
gd_pg2.setColumnColor("#CCE2FE");
gd_pg2.setSkin("dhx_skyblue");
//gd_pg2.splitAt(3);
gd_pg2.init();
loadGd_pg2();

function loadGd_pg2() {
	if(document.frmSearch_pg2.kode.value=="") {
		kode = "0";
	} else {
		kode = document.frmSearch_pg2.kode.value;
	}
	
	if(document.frmSearch_pg2.nama.value=="") {
		nama = "0";
	} else {
		nama = document.frmSearch_pg2.nama.value;
	}
	
	statusLoading();
	gd_pg2.clearAll();
	gd_pg2.loadXML(base_url+"index.php/company/loadMainData/"+kode+"/"+nama,function(){
		statusEnding();
	});
}

function refreshGd_pg2() {
	gd_pg2.updateFromXML(base_url+"index.php/company/loadMainData");
}


function winForm_pg2(type) {
	idselect = gd_pg2.getRowIndex(gd_pg2.getSelectedId());
	if(type=='edit' && idselect == "-1") {
		alert("Tidak ada data yang dipilih");
		return;
	}
	w1_pg2 = dhxWins.createWindow("w1_pg2",0,0,1025,600);
	w1_pg2.setText("Tambah Data Perusahaan");
	w1_pg2.button("park").hide();
	w1_pg2.button("minmax1").hide();
	w1_pg2.center();
	w1_pg2.setModal(true);
	if(type=='input') {
		w1_pg2.attachURL(base_url+"index.php/company/frm_input", true);
	} else {
		w1_pg2.attachURL(base_url+"index.php/company/frm_edit/"+gd_pg2.getSelectedId(), true);
	}
	
	w1_pg2.button("close").attachEvent("onClick", function() {
        try { w2_pg2.close(); } catch(e) {} 
	   	w1_pg2.close();
		return;
    });
	
	tb_w1_pg2 = w1_pg2.attachToolbar();
	tb_w1_pg2.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	tb_w1_pg2.setSkin("dhx_terrace");
	tb_w1_pg2.addButton("baru", 1, "BARU", "new.gif", "new_dis.gif");
	tb_w1_pg2.addButton("save", 2, "SIMPAN", "save.gif", "save_dis.gif");
	tb_w1_pg2.addButton("batal", 3, "BATAL", "delete.png", "dis_delete.png");
	tb_w1_pg2.disableItem("baru");
	tb_w1_pg2.attachEvent("onclick", function(id) {
		if(id=='batal') {
			var kp_pg2 = document.frm_pg2.hKp_pg2.value;
			var kota_pg2 = document.frm_pg2.hKota_pg2.value;
			document.frm_pg2.reset();
			// Kantor Pusat
			IDcbKP_pg2 = cbKP_pg2.getIndexByValue(kp_pg2);
			cbKP_pg2.selectOption(IDcbKP_pg2,true,true);
			// Kota
			IDcbKota_pg2 = cbKota_pg2.getIndexByValue(kota_pg2);
			cbKota_pg2.selectOption(IDcbKota_pg2,true,true);
		} else if(id=='save') {
			simpan_pg2();
		} else if(id=='baru') {
			tb_w1_pg2.disableItem("baru");
			tb_w1_pg2.enableItem("save");
			tb_w1_pg2.enableItem("batal");
			baru_pg2();
		}
	});

}

function hapus_pg2() {
		idselect = gd_pg2.getRowIndex(gd_pg2.getSelectedId());
		if(idselect == "-1") {
			alert("Tidak ada data yang dipilih");
			return;
		}
		var ya = prompt("Ketik 'ya' Jika anda yakin !","");
		if(ya=='ya') {
			 poststr =
            	'idrec=' + gd_pg2.getSelectedId();
			statusLoading();   
        	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/company/hapus", encodeURI(poststr), function(loader) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result==1) {
					gd_pg2.deleteSelectedItem();
					alert("Data Berhasil Dihapus");
				} else {
					alert("Data Tidak Dapat Dihapus");	
				}
			});
		}
	}

</script>

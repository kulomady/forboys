<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript">
var base_url = "<?php echo base_url(); ?>";
</script>
<!-- Layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcontainer.js"></script>
<!-- menu -->
<script src="<?php echo base_url(); ?>assets/codebase_menu/dhtmlxcommon.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_menu/skins/dhtmlxmenu_dhx_blue.css">
<script src="<?php echo base_url(); ?>assets/codebase_menu/dhtmlxmenu.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_menu/ext/dhtmlxmenu_ext.js"></script>
<!-- tabbar -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css">
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>
<!-- toolbar -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxcommon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_terrace.css"></link>
<!-- connector -->
<script src="<?php echo base_url(); ?>assets/codebase_connector/common/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/codebase_connector/connector.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/skins/dhtmlxgrid_dhx_skyblue.css">
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_filter.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgridcell.js"></script>
<!-- Modal -->
<link href="<?php echo base_url();?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shCore.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shBrushJScript.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/ModalPopups.js" language="javascript"></script>
<!-- window -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/skins/dhtmlxwindows_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxcontainer.js"></script>
<script src="<?php echo base_url(); ?>assets/window.js"></script>
<!-- combo -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url();?>assets/codebase_combo/dhtmlxcombo.css">
<script  src="<?php echo base_url();?>assets/codebase_combo/dhtmlxcommon.js"></script>
<script  src="<?php echo base_url();?>assets/codebase_combo/dhtmlxcombo.js"></script>
<script src="<?php echo base_url();?>assets/codebase_combo/ext/dhtmlxcombo_whp.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/codebase_combo/ext/dhtmlxcombo_extra.js" type="text/javascript"></script>
<!-- calander -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/codebase_calendar/dhtmlxcalendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/codebase_calendar/skins/dhtmlxcalendar_dhx_skyblue.css">
<script src="<?php echo base_url();?>assets/codebase_calendar/dhtmlxcalendar.js"></script>
<!-- Ajax -->
<script src="<?php echo base_url(); ?>/assets/codebase_ajax/dhtmlxcommon.js"></script>
<!-- other -->
<script src="<?php echo base_url(); ?>/assets/jquery-1.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/jquery.number.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/numberFormat.js"></script>

    
<title>King Cobra v.0.1</title>
</head>
<style>
		html, body {
			width: 100%;
			height: 100%;
			margin: 0px;
			padding: 0px;
			overflow: hidden;
		}
		.hdr_ftr {
			height: 74px;
			background-color: white;
			border: 1px solid #a4bed4;
		}
		.hdr_ftr .text {
			font-family: Tahoma;
			font-size: 12px;
			margin: 5px 10px;
		}
		
		.frmContainer {
			background-color: #FFFFCC; 
			padding-bottom:50px; 
			font-family: Verdana, Arial, Helvetica, sans-serif; 
			font-size:11px;
			overflow:auto;;
		}
		
		input,select,textarea {
			font-family: Verdana, Arial, Helvetica, sans-serif; 
			font-size:11px;
			text-transform:uppercase;
		}
	</style>
<body style="background-color:#CCCCCC;">
<div id="my_logo" style="padding:0px; margin:0px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" background="<?php echo base_url(); ?>assets/img/header.png">
  <tr>
    <td width="34%" rowspan="3">&nbsp;</td>
    <td width="35%" rowspan="3"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="31%"></td>
  </tr>
  <tr>
    <td height="27"><div id="toolbarObj"></div></td>
  </tr>
</table>
</div>
<div id="info" style="background-color: #CF6; height:100%;"></div>
<script>

	 var toolbar = new dhtmlXToolbarObject("toolbarObj");
	 toolbar.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
	 toolbar.setSkin("dhx_terrace");
	 toolbar.addText("info", 1, "Selamat Datang, User...... !&nbsp;&nbsp;&nbsp;&nbsp;");
	 toolbar.addButton("gPass", 2, "Ganti Password", "edit.png", "edit_dis.png");
	 toolbar.addButton("keluar", 3, "Keluar", "reject.png", "reject_dis.png");
	 toolbar.attachEvent("onclick", function(id) {
	 	if(id=='keluar') {
			window.location.href = "<?php echo base_url(); ?>/index.php/home/logout";
		}
	 });
	 
	var dhxLayout = new dhtmlXLayoutObject(document.body, "1C");
	dhxLayout.attachHeader("my_logo");
	dhxLayout.cells('a').hideHeader();
	var sb = dhxLayout.cells("a").attachStatusBar();
	sb.setText("Status Bar");
	
	// menu
	dhxMenu = dhxLayout.attachMenu();
	dhxMenu.setIconsPath("<?php echo base_url(); ?>assets/codebase_menu/common/imgs/");
    dhxMenu.loadXML("<?php echo base_url(); ?>index.php/home/mainMenu/<?php echo $this->session->userdata('group_id'); ?>");
	dhxMenu.setSkin("dhx_blue");
	
	dhxMenu.attachEvent("onClick", function(id) {
			
			var arr = id.split("|");
			var randomnumber = arr[0]; //Math.floor((Math.random()*1000)+1);
			var text = dhxMenu.getItemText(id);
			var textLength = text.length;
			if(parseInt(textLength) >= 12) {  
				var panjang = parseInt(textLength) * 9;
			} else {
				var panjang = 100;
			}
			
			arrTab = dhxTabbar.getAllTabs();
			idtab = "";
			for(i=0;i<arrTab.length;i++) {
				if(randomnumber == arrTab[i]) {
					idtab = arrTab[i];
				}
			}
			
			if(idtab != "") {
				dhxTabbar.setTabActive(idtab);
				return;
			}
			dhxTabbar.enableTabCloseButton(true);
			//dhxTabbar.setHrefMode("iframes-on-demand");
			dhxTabbar.setHrefMode("ajax-html");
			dhxTabbar.addTab(randomnumber,text, panjang+"px");
			dhxTabbar.setTabActive(randomnumber);
			dhxTabbar.setContentHref(randomnumber,"<?php echo base_url(); ?>index.php/"+arr[1]);
		});
	
	// Tabbar
	dhxTabbar = dhxLayout.cells("a").attachTabbar();
	dhxTabbar.setSkin('dhx_skyblue');
    dhxTabbar.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
	//dhxTabbar.enableTabCloseButton(true);
	dhxTabbar.addTab("a1", "WELCOME", 120);
	dhxTabbar.setContent("a1", "info");
	dhxTabbar.setTabActive("a1");
    //dhxTabbar.loadXML("../common/tabbar.xml?etc=" + new Date().getTime());
	
	function img_open(onclick) {
		imgOpen = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="'+onclick+'" />';
		return;
	}
	
	function img_del(onclick) {
		imgDel = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="'+onclick+'" />';
	}
</script>
<div id="tmpSearchBrg" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
	<table width="409" border="0" align="center">
  <tr>
    <td width="117">Cari Nama Barang</td>
    <td width="284"><input type="text" name="frmSearchBrg" id="frmSearchBrg" onKeyDown="tandaPanahBrg(event.keyCode);" tabindex="10">
      <input type="button" name="btnSaring" id="btnSaring" value="Muat Ulang" onclick="muatUlangBarang();" tabindex="11" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="srcGridBarang" style="width:550px; height:365px;"/>&nbsp;<br />&nbsp;</td>
  </tr>
</table>
<span style="display:none">
<a href="javascript:selectCel_input(6)" id="pilihCell4">selectCell</a>
<a href="javascript:selectCel_input(0)" id="pilihCell0">selectCell</a>
</span>
<input type="hidden" name="nmGrid" id="nmGrid" />
</div>

<div id="tmpSearchAkun" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
<table width="409" border="0">
  <tr>
    <td width="69">Cari Data</td>
    <td width="336"><input type="text" name="frmSearchAkun" id="frmSearchAkun" onKeyDown="tandaPanahAkun(event.keyCode);"></td>
  </tr> 
  <tr>
      <td colspan="2"><div id="gridAkun" style="width:405px; height:345px;" /></td>
  </tr>
</table>
<span style="display:none">
<a href="javascript:selectCel_inputAk(3)" id="pilihCell3_ak">selectCell</a>
<a href="javascript:selectCel_inputAk(0)" id="pilihCell0_ak">selectCell</a>
</span>
<input type="hidden" name="kdTransAkun" id="kdTransAkun" />
<input type="hidden" name="kdAkun" id="kdAkun" />
<input type="hidden" name="nmAkun" id="nmAkun" />
</div>
<script language="javascript">
// Window Cari Barang
img_link = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
img_del = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail();" />';

var win_brg = dhxWins.createWindow("win_brg",0,0,580,450);
win_brg.setText("Daftar Pramuniaga");
win_brg.button("park").hide();
win_brg.button("minmax1").hide();
win_brg.button("close").hide();
win_brg.center();
win_brg.hideHeader();
win_brg.hide();

tb_win_brg = win_brg.attachToolbar();
tb_win_brg.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_win_brg.setSkin("dhx_terrace");
tb_win_brg.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_win_brg.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_win_brg.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahBrg(13);
	} else if(id=='tutup') {
			win_brg.hide();
	}
});

gd_win_brg = new dhtmlXGridObject('srcGridBarang');
gd_win_brg.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_win_brg.setHeader("Kode #,Nama Barang,Warna,Ukuran,Satuan,jml,harga,pot,pot2,pot3,pot4,total",null,["text-align:center","text-align:center","text-align:center"]);
gd_win_brg.setInitWidths("80,200,100,70,70,0,0,0,0,0,0,0");
gd_win_brg.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left");
gd_win_brg.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str");
gd_win_brg.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_win_brg.enableSmartRendering(true,50);
gd_win_brg.makeSearch("frmSearchBrg",1);
gd_win_brg.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBrg(13);
});  
gd_win_brg.setSkin("dhx_skyblue");
gd_win_brg.init();

function show_win_brg(idbarang) {
	win_brg.show();
	win_brg.bringToTop();
	win_brg.attachObject('tmpSearchBrg');
	gd_win_brg.clearAll();
	baseXML = base_url+"index.php/master_barang/loadDataBarang/"+idbarang;
	try {
		if(document.frm_pj4.noPesanan.value != "") {
			baseXML = base_url+"index.php/penjualan/brgPesanan/"+document.frm_pj4.noPesanan.value;
		}
	} catch(e) { }
	
	try {
		if(document.frm_pj5.noTrsJual.value != "") {
			baseXML = base_url+"index.php/retur_penjualan/brgPenjualan/"+document.frm_pj5.noTrsJual.value;
		}
	} catch(e) { }
	
	gd_win_brg.loadXML(baseXML,function() {
		document.getElementById('frmSearchBrg').focus();
	});
}
	
function tandaPanahBrg(key) {
	if(key==13) {
		idbarang = gd_win_brg.cells(gd_win_brg.getSelectedId(),0).getValue();
		nmbarang = gd_win_brg.cells(gd_win_brg.getSelectedId(),1).getValue();
		warna = gd_win_brg.cells(gd_win_brg.getSelectedId(),2).getValue();
		ukuran = gd_win_brg.cells(gd_win_brg.getSelectedId(),3).getValue();
		satuan = gd_win_brg.cells(gd_win_brg.getSelectedId(),4).getValue();
		jml = gd_win_brg.cells(gd_win_brg.getSelectedId(),5).getValue();
		hrg = gd_win_brg.cells(gd_win_brg.getSelectedId(),6).getValue();
		disc_1 = gd_win_brg.cells(gd_win_brg.getSelectedId(),7).getValue();
		disc_2 = gd_win_brg.cells(gd_win_brg.getSelectedId(),8).getValue();
		disc_3 = gd_win_brg.cells(gd_win_brg.getSelectedId(),9).getValue();
		disc_4 = gd_win_brg.cells(gd_win_brg.getSelectedId(),10).getValue();
		total = gd_win_brg.cells(gd_win_brg.getSelectedId(),11).getValue();
		win_brg.hide();
		try { 
			if(document.frm_pj4.noPesanan.value != "") {
				setDataBrgPj4(idbarang,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,total);
			}
			return;
		} catch(e) {} 
		try {
			if(document.frm_pj5.noTrsJual.value != "") {
				setDataBrgPj5(idbarang,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,total);
			}
			return;
		} catch(e) {}
		setDataBrg(idbarang,nmbarang,warna,ukuran,satuan);
		
		
	}
	if(key==38) {
		pilihGridKeAtas(gd_win_brg,'frmSearchBrg');
	}
	if(key==40) {
		pilihGridKeBawah(gd_win_brg,'frmSearchBrg');
	}
	if(key==27) {
		win_brg.hide();
	}
	return;
}

function setDataBrg(kode,nmbarang,warna,ukuran,satuan) {
	/*if(adaBarang(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		grid.cells(grid.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0").click();
		return;
	}*/
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	gdInp.cells(gdInp.getSelectedId(),3).setValue(warna);
	gdInp.cells(gdInp.getSelectedId(),4).setValue(ukuran);
	gdInp.cells(gdInp.getSelectedId(),5).setValue(satuan);
	index = gdInp.getRowIndex(gdInp.getSelectedId());
	gdInp.setRowId(index,kode.toUpperCase());
	document.getElementById("pilihCell4").click();
}

function selectCel_input(idcell) {
	idselect = gdInp.getSelectedId();
	index = gdInp.getRowIndex(idselect);
	gdInp.selectCell(index,idcell,false,false,true);
}

function muatUlangBarang() {
	gd_win_brg.clearAll();
	nmbarang = document.getElementById('frmSearchBrg').value;
	statusLoading();
	gd_win_brg.loadXML(base_url+"index.php/master_barang/muatUlang/"+nmbarang,function() {
		statusEnding();
		document.getElementById('frmSearchBrg').focus();
	});
}


function cariBarang() {
	idbarang = gdInp.cells(gdInp.getSelectedId(),0).getValue();
	var poststr =
		'idbarang=' + idbarang;
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/cariBarang", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			show_win_brg(idbarang);
		} else {
			arrBrg = result.split('|');
			setDataBrg(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3]);
		}
	});
}

function delRowInp() {
	arrId = gdInp.getAllItemIds().split(",");
	idcell = arrId[arrId.length - 1];
	celIdbarang = gdInp.cells(idcell,0).getValue();
	if(celIdbarang == "") {
		gdInp.deleteRow(idcell);
	}
}

function hapusDetail() {
	kode = gdInp.cells(gdInp.getSelectedId(),0).getValue();
	if(kode != "") {
		y = confirm("Apakah Anda Yakin ?");
		if(y) {
				gdInp.deleteSelectedItem();
				// update ari karniawan 24/4/2014
				try {
					subtotal_pj1();
				   	addRowInp_pj1();
				} catch(e) {}
		}
	}
	return;
}

function adaBarang(kode) {
	ada = 0;
	gdInp.forEachRow(function(id){
		if(gdInp.cells(id,0).getValue()==kode && gdInp.cells(id,2).getValue()!="") {
			ada = 1;
			return ada;
		}
	});
	return ada;
}

// Window Akun Akuntansi

imgLinkAk = '<img id="btnTglBerlaku_ak4" src="<?php echo base_url(); ?>assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_akun(0);" />';
imgDelAk = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetailAk();" />';

var win_akun = dhxWins.createWindow("win_akun",0,0,430,450);
win_akun.setText("Daftar Akun");
win_akun.button("park").hide();
win_akun.button("minmax1").hide();
win_akun.button("close").hide();
win_akun.center();
win_akun.hideHeader();
win_akun.hide();

tb_win_akun = win_akun.attachToolbar();
tb_win_akun.setIconsPath(base_url+"assets/codebase_toolbar/icon/");
tb_win_akun.setSkin("dhx_terrace");
tb_win_akun.addButton("pakai", 1, "PILIH", "add.gif", "add_dis.gif");
tb_win_akun.addButton("tutup", 1, "TUTUP", "close.png", "close_dis.png");
tb_win_akun.attachEvent("onclick", function(id) {
	if(id=='pakai') {
			tandaPanahAkun(13);
	} else if(id=='tutup') {
			win_akun.hide();
	}
});

gd_win_akun = new dhtmlXGridObject('gridAkun');
gd_win_akun.setImagePath("<?php echo base_url(); ?>assets/codebase_grid/imgs/");
gd_win_akun.setHeader("Kode #,Nama Perkiraan,Kelompok",null,["text-align:center","text-align:center","text-align:center"]);
gd_win_akun.setInitWidths("80,180,110");
gd_win_akun.setColAlign("left,left,left");
gd_win_akun.setColSorting("str,str,str");
gd_win_akun.setColTypes("ro,ro,ro");
gd_win_akun.enableSmartRendering(true,50);
gd_win_akun.makeSearch("frmSearchAkun",1);
gd_win_akun.setSkin("dhx_skyblue");
gd_win_akun.init();

function show_win_akun(kdtrans,idx) {
        input = 'txt'+idx;
        text = 'tmp'+idx;
	document.getElementById('kdTransAkun').value = kdtrans;
        document.getElementById('kdAkun').value = input;
        document.getElementById('nmAkun').value = text;
	win_akun.show();
	win_akun.bringToTop();
	win_akun.attachObject('tmpSearchAkun');
        gd_win_akun.clearAll();
        if(kdtrans=="1"){            
            gd_win_akun.loadXML(base_url+"index.php/kas/loadDataPerkiraan_kas",function() {
                    document.getElementById('frmSearchAkun').focus();
            });
        } else {            
            gd_win_akun.loadXML(base_url+"index.php/kas/loadDataPerkiraan_all",function() {
                    document.getElementById('frmSearchAkun').focus();
            });
        }
}

function tandaPanahAkun(key) {
	if(key==13) {
		kdtransAkun = document.getElementById('kdTransAkun').value;
                fieldKdAkun = document.getElementById('kdAkun').value;
                fieldNmAkun = document.getElementById('nmAkun').value;
		idperkiraan = gd_win_akun.cells(gd_win_akun.getSelectedId(),0).getValue();
		nmperkiraan = gd_win_akun.cells(gd_win_akun.getSelectedId(),1).getValue();
		if(kdtransAkun=='0') {
			setDataAkun(idperkiraan,nmperkiraan);
		} else if(kdtransAkun=='1') {
            $("#"+fieldKdAkun).val(idperkiraan);
            $("#"+fieldNmAkun).text(nmperkiraan);
		}
		win_akun.hide();
		
	}
	if(key==38) {
		pilihGridKeAtas(gd_win_akun,'frmSearchAkun');
	}
	if(key==40) {
		pilihGridKeBawah(gd_win_akun,'frmSearchAkun');
	}
	if(key==27) {
		win_brg.hide();
	}
	return;
}

function setDataAkun(idperkiraan,nmperkiraan) {
	if(adaAkun(idperkiraan) != 0) {
		alert("Akun Yang Anda Input Sudah Ada");
		gdInpAk.cells(gdInpAk.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0_ak").click();
		return;
	}
	gdInpAk.cells(gdInpAk.getSelectedId(),0).setValue(idperkiraan.toUpperCase());
	gdInpAk.cells(gdInpAk.getSelectedId(),2).setValue(nmperkiraan);
	document.getElementById("pilihCell3_ak").click();
}

function selectCel_inputAk(idcell) {
	idselect = gdInpAk.getSelectedId();
	index = gdInpAk.getRowIndex(idselect);
	gdInpAk.selectCell(index,idcell,false,false,true);
}

function hapusDetailAk() {
	kode = gdInpAk.cells(gdInpAk.getSelectedId(),0).getValue();
	if(kode != "") {
		y = confirm("Apakah Anda Yakin ?");
		if(y) {
				gdInpAk.deleteSelectedItem();
		}
	}
	return;
}

function adaAkun(kode) {
	ada = 0;
	gdInpAk.forEachRow(function(id){
		if(gdInpAk.cells(id,0).getValue()==kode && gdInpAk.cells(id,2).getValue()!="") {
			ada = 1;
			return ada;
		}
	});
	return ada;
}

function delRowInpAk() {
    arrId = gdInpAk.getAllItemIds().split(",");
    idcell = arrId[arrId.length - 1];
    celIdAkun = gdInpAk.cells(idcell,0).getValue();
    if(celIdAkun == "") {
        gdInpAk.deleteRow(idcell);
    }
}

function cekKosong(kolom) {
	ada = 0;
	gdInp.forEachRow(function(id){
		if(gdInp.cells(id,kolom).getValue()=="" || gdInp.cells(id,kolom).getValue()=="0") {
			ada = 1;
			return ada;
		}
	});
	return ada;
}
</script>
</body>
</html>

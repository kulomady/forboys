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
<script src="<?php echo base_url(); ?>assets/codebase_connector/common/dhtmlx.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/codebase_connector/connector.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/skins/dhtmlxgrid_dhx_skyblue.css">
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_filter.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgridcell.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/excells/dhtmlxgrid_excell_dhxcalendar.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/excells/dhtmlxgrid_excell_sub_row.js"></script>  
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
<script src="<?php echo base_url(); ?>/assets/sis_function.js"></script>
<script language="javascript">
$(document).ready(function(){

	$(document).bind("contextmenu",function(e){
	return false;
	});

});
</script>
<title>JasPri ERP v.0.1</title>
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
    <td width="51%" rowspan="3">&nbsp;</td>
    <td width="33%" rowspan="3"><div id="toolbarObj" style="color:#FFF;"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="16%"></td>
  </tr>
  <tr>
    <td height="27">&nbsp;</td>
  </tr>
</table>
</div>
<div id="info" style="background-color: #CF6; height:100%;">
  <table width="299" border="0">
    <tr>
      <td width="83">&nbsp;</td>
      <td width="8">&nbsp;</td>
      <td width="186">&nbsp;</td>
    </tr>
    <tr>
      <td>Username</td>
      <td>:</td>
      <td><?php echo $sis_user; ?>&nbsp;</td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td><?php echo $first_name.' '.$last_name; ?></td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td>:</td>
      <td><?php echo $nm_outlet; ?></td>
    </tr>
  </table>
</div>
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
		} else if(id=='gPass') {
			gantiPassword();
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
	
	     function bukaTab(id,text,url){ 
                var urlnya = url;
                var randomnumber=Math.floor((Math.random()*1000)+1);
                var judul = text;
                var textLength = judul.length;
                if(parseInt(textLength) >= 12) {  
                    var panjang = parseInt(textLength) * 10;
                } else {
                    var panjang = 100;
                }
                dhxTabbar.setHrefMode("iframes");
                dhxTabbar.addTab(randomnumber,judul,panjang+"px");
                dhxTabbar.setTabActive(randomnumber);
                dhxTabbar.setContentHref(randomnumber,"<?php echo base_url(); ?>index.php/"+urlnya);       
            }
	// Tabbar
	dhxTabbar = dhxLayout.cells("a").attachTabbar();
	dhxTabbar.setSkin('dhx_skyblue');
    dhxTabbar.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
	//dhxTabbar.enableTabCloseButton(true);
	dhxTabbar.addTab("a1", "WELCOME", 120);
	dhxTabbar.setContent("a1", "info");
	dhxTabbar.setTabActive("a1");
	dhxTabbar.attachEvent("onTabClose", function() {
		try { 
			winCetak_pb1.close();
		} catch(e) {}
		try { 
			winCetak_pb4.close();
		} catch(e) {}
		try { 
			winCetak_pg4.close();
		} catch(e) {}
		try {
			winCetak_pj4.close();
		} catch(e) {}
    	return true;
	});
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
	<table width="784" border="0" align="center">
  <tr>
    <td height="21">Kode Item</td>
    <td width="167"><input type="text" name="txtKdItem_home" id="txtKdItem_home" /></td>
    <td width="54">Jenis</td>
    <td width="161" id="tmpJns_home"></td>
    <td width="77">Warna</td>
    <td width="137" id="tmpWarna_home"></td>
    <td width="94" rowspan="3"><input type="button" name="btnSaring" id="btnSaring" value="CARI DATA" style=" height:60px;" onclick="muatUlangBarang();" tabindex="11" /></td>
  </tr>
  <tr>
    <td>Nama Item</td>
    <td><input type="text" name="frmSearchBrg" id="frmSearchBrg" onkeydown="tandaPanahBrg(event.keyCode);" tabindex="10" placeholder = "Cari Data Tampil" /></td>
    <td>Kategori</td>
    <td id="tmpKat_home"></td>
    <td>Supplier</td>
    <td id="tmpSupplier_home"></td>
    </tr>
  <tr>
    <td width="86">Tipe Barang</td>
    <td id="tmpTipe_home"></td>
    <td>Merk</td>
    <td id="tmpMerk_home"></td>
    <td>Konsinyasi</td>
    <td><input type="checkbox" name="cbKonsinyasi_home" id="cbKonsinyasi_home" /></td>
    </tr>
  <tr>
    <td height="328" colspan="7"><div id="srcGridBarang" style="width:800px; height:300px;"/> <br />&nbsp;</td>
  </tr>
</table>
<span style="display:none">
<a href="javascript:selectCel_input(11)" id="pilihCell11">selectCell</a>
<a href="javascript:selectCel_input(8)" id="pilihCell8">selectCell</a>
<a href="javascript:selectCel_input(6)" id="pilihCell4">selectCell</a>
<a href="javascript:selectCel_input(4)" id="pilihCell5">selectCell</a>
<a href="javascript:selectCel_input(0)" id="pilihCell0">selectCell</a>
<a href="javascript:selectCel_input(5)" id="pilihCell6">selectCell</a>
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

<div id="tmpChangePass" style="background-color: #FFCC66; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; display:none;">
  <form id="frmCpass" name="frmCpass" method="post" action="javascript:void(0);">
    <table width="297" border="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="134">Password Baru</td>
        <td width="147"><input type="password" name="passBaru" id="passBaru" /></td>
      </tr>
      <tr>
        <td>Konfirmasi Password</td>
        <td><input type="password" name="cPassBaru" id="cPassBaru" /></td>
      </tr>
      <tr>
        <td><input type="submit" name="button" id="button" value="GANTI" onclick="gantiPasswd();" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<script language="javascript">
// Window Cari Barang
img_link = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
img_del = '<img id="btnTglBerlaku_md41" src="<?php echo base_url(); ?>assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail();" />';
var outlet_id = "";

// Combo Tipe Item
var cbTI_home = new dhtmlXCombo("tmpTipe_home", "cbTI_home", 156);
cbTI_home.enableFilteringMode(true);
cbTI_home.loadXML(base_url+"index.php/master_barang/cbTipeItem");

// Combo Jenis Barang
var cbJns_home = new dhtmlXCombo("tmpJns_home", "cbJns_home", 156);
cbJns_home.enableFilteringMode(true);
cbJns_home.loadXML(base_url+"index.php/master_barang/cbJenis");

// Combo Kategori Barang
var cbKat_home = new dhtmlXCombo("tmpKat_home", "cbKat_home", 156);
cbKat_home.enableFilteringMode(true);
cbKat_home.loadXML(base_url+"index.php/master_barang/cbKategori");

// Combo Merk Barang
var cbMerk_home = new dhtmlXCombo("tmpMerk_home", "cbMerk_home", 156);
cbMerk_home.enableFilteringMode(true);
cbMerk_home.loadXML(base_url+"index.php/master_barang/cbMerk");

// Combo Warna Barang
var cbWarna_home = new dhtmlXCombo("tmpWarna_home", "cbWarna_home", 156);
cbWarna_home.enableFilteringMode(true);
cbWarna_home.loadXML(base_url+"index.php/master_barang/cbWarna");

// Combo supplier
var cbSupplier_home = new dhtmlXCombo("tmpSupplier_home", "cbSupplier_home", 156);
cbSupplier_home.enableFilteringMode(true);
cbSupplier_home.loadXML(base_url+"index.php/master_barang/cbSupplier");

var win_brg = dhxWins.createWindow("win_brg",0,0,830,475);
win_brg.setText("Cari Barang");
win_brg.button("park").hide();
win_brg.button("minmax1").hide();
win_brg.button("close").hide();
win_brg.center();
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
gd_win_brg.setHeader("Kode #,Nama Barang,Warna,Ukuran,Satuan,jml,harga,pot,pot2,pot3,pot4,total,HrgBeli,Tipe,Jenis,Kategori,barcode,discrp,tax",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
gd_win_brg.setInitWidths("80,150,100,70,0,0,80,65,65,65,65,0,0,80,80,80,0,0,0");
gd_win_brg.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
gd_win_brg.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
gd_win_brg.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
gd_win_brg.enableSmartRendering(true,50);
gd_win_brg.makeSearch("frmSearchBrg",1);
gd_win_brg.attachEvent("onRowDblClicked", function(rId,cInd){
	tandaPanahBrg(13);
});  
gd_win_brg.setSkin("dhx_skyblue");
gd_win_brg.init();

function show_win_brg(idbarang) {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	win_brg.show();
	win_brg.bringToTop();
	win_brg.attachObject('tmpSearchBrg');
	if(idbarang != '0') {
		baseXML = base_url+"index.php/master_barang/loadDataBarang/"+outlet_id+"/"+idbarang;
		gd_win_brg.clearAll();
		gd_win_brg.loadXML(baseXML);
	}
	document.getElementById('btnSaring').disabled = false; 
	// Pesanan Barang
	try {
		if(document.frm_pj4.noPesanan.value != "") {
			document.getElementById('btnSaring').disabled = true; 
			baseXML = base_url+"index.php/penjualan/brgPesanan/"+document.frm_pj4.noPesanan.value;
			gd_win_brg.loadXML(baseXML);
			return;
		}
	} catch(e) { }
	// Penjualan Brg
	try {
		if(document.frm_pj5.noTrsJual.value != "") {
			document.getElementById('btnSaring').disabled = true; 
			baseXML = base_url+"index.php/retur_penjualan/brgPenjualan/"+document.frm_pj5.noTrsJual.value;
			gd_win_brg.loadXML(baseXML);
			return;
		}
	} catch(e) { }
	// Pesanan Beli
	try {
		if(document.frm_pb1.no_po.value != "") {
			document.getElementById('btnSaring').disabled = true; 
			baseXML = base_url+"index.php/pembelian_barang/brgPesanan/"+document.frm_pb1.no_po.value;
			gd_win_brg.loadXML(baseXML);
			return;
		}
	} catch(e) { }
	// Pesanan Beli
	try {
		if(document.frm_pb3.no_lpb.value != "") {
			document.getElementById('btnSaring').disabled = true; 
			baseXML = base_url+"index.php/retur_pembelian/brgPembelian/"+document.frm_pb3.no_lpb.value;
			gd_win_brg.loadXML(baseXML);
			return;
		}
	} catch(e) { }
	
	document.getElementById('frmSearchBrg').focus();
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
		hrgBeli = gd_win_brg.cells(gd_win_brg.getSelectedId(),12).getValue();
		barcode = gd_win_brg.cells(gd_win_brg.getSelectedId(),16).getValue();
		discrp = gd_win_brg.cells(gd_win_brg.getSelectedId(),17).getValue();
		tax = gd_win_brg.cells(gd_win_brg.getSelectedId(),18).getValue();
		win_brg.hide();
		// import Pesanan Pembelian
		try {
			if(document.frm_pb1.no_po.value != "") {
				setDataBrgImportPb1(idbarang,nmbarang,warna,ukuran,satuan,jml,hrgBeli,disc_1,disc_2,total,discrp,tax,hrg);
				return;
			}
		} catch(e) {}
		// import Pembelian Pembelian
		try {
			if(document.frm_pb3.no_lpb.value != "") {
				// disc_3 => pcs
				// disc_1 => disc
				// disc_2 => pajak
				setDataBrgImportPb3(idbarang,nmbarang,warna,ukuran,satuan,jml,disc_3,hrgBeli,disc_1,disc_2,total,discrp,tax);
				return;
			}
		} catch(e) {}
		// import pesanan
		try { 
			if(document.frm_pj4.gudang.value != "") {
				setDataBrgPj4(idbarang,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,total,hrgBeli);
				return;
			}
		} catch(e) {} 
		// import penjualan
		try {
			if(document.frm_pj5.gudang.value != "") {
				setDataBrgPj5(idbarang,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,total,hrgBeli);
				return;
			}
		} catch(e) {}
		// set data persediaan awal
		try {
			if(document.frm_pd1.txtPeriode.value != "") {
				setDataBrgPd1(idbarang,nmbarang,warna,ukuran,satuan,hrgBeli,hrg);
				return;
			}
		} catch(e) {}
		// Transfer Barang
		try {
			if(document.frm_pd3.tujuan.value != "") {
				setDataBrg(idbarang,nmbarang,warna,ukuran,satuan,hrg,hrgBeli);
				return;
			}
		} catch(e) {}
		// Pesanan Penjualan
		try {
			if(document.frm_pj3.gudang.value != "") {
				setDataBrgPj3(idbarang,nmbarang,warna,ukuran,satuan,hrg,disc_1,disc_2,disc_3,disc_4,hrgBeli);
				return;
			}
		} catch(e) {}
		// Penjualan
		try {
			if(document.frm_pj1.gudang.value != "") {
				setDataBrgPj1(idbarang,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,hrgBeli);
				return;
			}
		} catch(e) {}
		// Penjualan Konsinyasi
		try {
			if(document.frm_pj6.gudang.value != "") {
				setDataBrgPj6(idbarang,nmbarang,warna,ukuran,satuan,jml,hrg,disc_1,disc_2,disc_3,disc_4,hrgBeli);
				return;
			}
		} catch(e) {}
		// Pesanan Pembelian
		try {
			if(document.frm_pb4.gudang.value != "") {
				setDataBrgPb4(idbarang,nmbarang,warna,ukuran,satuan,hrgBeli);
				return;
			}
		} catch(e) {}
		// Pembelian Barang
		try {
			if(document.frm_pb1.gudang.value != "") {
				setDataBrgPb1(idbarang,nmbarang,warna,ukuran,satuan,hrgBeli,hrg);
				return;
			}
		} catch(e) {}
		// Retur Pembelian
		try {
			if(document.frm_pb3.gudang.value != "") {
				setDataBrgPb3(idbarang,nmbarang,warna,ukuran,satuan,hrgBeli);
				return;
			}
		} catch(e) {}
		// Opname
		try {
			if(document.frm_pd5.gudang.value != "") {
				setDataBrgPd5(idbarang,nmbarang,warna,ukuran,satuan,hrgBeli,hrg);
				return;
			}
		} catch(e) {}
		// barcode create
		try {
			if(document.frm_pg4.gudang.value != "") {
				setDataBrgpg4(idbarang,nmbarang,warna,ukuran,satuan,barcode);
				return;
			}
		} catch(e) {}
		
		
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

function setDataBrg(kode,nmbarang,warna,ukuran,satuan,harga,hrgBeli) {
	if(adaBarang(kode) != 0) {
		alert("Barang Yang Anda Input Sudah Ada");
		grid.cells(grid.getSelectedId(),0).setValue('');
		document.getElementById("pilihCell0").click();
		return;
	}
	gdInp.cells(gdInp.getSelectedId(),0).setValue(kode.toUpperCase());
	gdInp.cells(gdInp.getSelectedId(),2).setValue(nmbarang);
	gdInp.cells(gdInp.getSelectedId(),3).setValue(warna);
	gdInp.cells(gdInp.getSelectedId(),4).setValue(ukuran);
	gdInp.cells(gdInp.getSelectedId(),5).setValue(satuan);
	gdInp.cells(gdInp.getSelectedId(),8).setValue(harga);
	gdInp.cells(gdInp.getSelectedId(),11).setValue(hrgBeli);
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
	if(document.getElementById('txtKdItem_home').value != "") {
		kditem = document.getElementById('txtKdItem_home').value;
	} else {
		kditem = 0;
	}
	if(document.getElementById('frmSearchBrg').value != "") {
		nmbarang = document.getElementById('frmSearchBrg').value;
	} else {
		nmbarang = 0;
	}
	if(document.getElementById('cbKonsinyasi_home').checked==true) {
		konsinyasi = 1;
	} else {
		konsinyasi = 0;
	}
	tipe = cbTI_home.getSelectedValue();
	jns = cbJns_home.getSelectedValue();
	kat = cbKat_home.getSelectedValue();
	merk = cbMerk_home.getSelectedValue();
	warna = cbWarna_home.getSelectedValue();
	supplier = cbSupplier_home.getSelectedValue();
	statusLoading();
	gd_win_brg.loadXML(base_url+"index.php/master_barang/muatUlang/"+outlet_id+"/"+nmbarang+"/"+kditem+"/"+konsinyasi+"/"+tipe+"/"+jns+"/"+kat+"/"+merk+"/"+warna+"/"+supplier,function() {
		statusEnding();
		document.getElementById('frmSearchBrg').focus();
	});
}


function cariBarang() {
	if(outlet_id=="") {
		alert("Pilih Dahulu Gudang / Lokasi Barang");
		return;
	}
	idbarang = gdInp.cells(gdInp.getSelectedId(),0).getValue();
	var poststr =
		'idbarang=' + idbarang +
		'&outlet_id=' + outlet_id;
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/master_barang/cariBarang", encodeURI(poststr), function(loader) {
		result = loader.xmlDoc.responseText;
		if(result == '0') {
			show_win_brg(idbarang);
		} else {
			arrBrg = result.split('|');
			// API INDEX
			// [0]->nmbarang
			// [1]->nmwarna
			// [2]->nmsize
			// [3]->nmsatuan
			// [4]->jml
			// [5]->harga
			// [6]->disc_1
			// [7]->disc_2
			// [8]->disc_3
			// [9]->disc_4
			// [10]->total
			// [11]->harga_beli
			// [[12]->barcode
			
			// persediaan Awal
			try {
				if(document.frm_pd1.txtPeriode.value != "") {
					setDataBrgPd1(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[11],arrBrg[5]);
				}
				return;
			} catch(e) {}
			// Transfer Barang
			try {
				if(document.frm_pd3.tujuan.value != "") {
					setDataBrg(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[5],arrBrg[11]);
				}
				return;
			} catch(e) {}
			// Pesanan Penjualan
			try {
				if(document.frm_pj3.gudang.value != "") {
					setDataBrgPj3(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[5],arrBrg[6],arrBrg[7],arrBrg[8],arrBrg[9],arrBrg[11]);
				}
				return;
			} catch(e) {}
			// Penjualan
			try {
				if(document.frm_pj4.gudang.value != "") {
					setDataBrgPj4(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],arrBrg[6],arrBrg[7],arrBrg[8],arrBrg[9],arrBrg[11]);
				}
				return;
			} catch(e) {} 
			// Pesanan Pembelian
			try {
				if(document.frm_pb4.gudang.value != "") {
					// idbarang,nmbarang,warna,size,satuan,hrgBeli
					setDataBrgPb4(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[11]);
				}
				return;
			} catch(e) {}
			// Penjualan Kasir
			try {
				if(document.frm_pj1.gudang.value != "") {
					setDataBrgPj1(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],arrBrg[6],arrBrg[7],arrBrg[8],arrBrg[9],arrBrg[11]);
				}
				return;
			} catch(e) {}
			// Retur Penjualan
			try {
				if(document.frm_pj5.gudang.value != "") {
					setDataBrgPj5(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[4],arrBrg[5],arrBrg[6],arrBrg[7],arrBrg[8],arrBrg[9],arrBrg[11]);
				}
				return;
			} catch(e) {}
			// Pembelian Barang
			try {
				if(document.frm_pb1.gudang.value != "") {
					setDataBrgPb1(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[11],arrBrg[5]);
				}
				return;
			} catch(e) {}
			// barcode create
			try {
				if(document.frm_pg4.gudang.value != "") {
					setDataBrgpg4(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[12]);
					return;
				}
			} catch(e) {}
			// Retur Pembelian
			try {
				if(document.frm_pb3.gudang.value != "") {
					setDataBrgPb3(idbarang,arrBrg[0],arrBrg[1],arrBrg[2],arrBrg[3],arrBrg[11]);
					return;
				}
			} catch(e) {}
			
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
	document.getElementById('kdTransAkun').value = idx;
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
		if(kdtransAkun=='' || kdtransAkun=='undefined') {
			setDataAkun(idperkiraan,nmperkiraan);
		} else {
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

function initOutlet(isi) {
	outlet_id = isi;
}

// Pembulatan diskon
function pembulatanDisc(hrgDisc) {
	if(hrgDisc > 999) {
		var text = ""+hrgDisc+"";
		ratusan = text.substr(-3);
		nilai = parseInt(text);
		if(ratusan > 500) {
			tambah = 1000 - ratusan;
		} else if(ratusan < 500) {
			tambah = -1 * ratusan;	
		} else {
			tambah = 0;	
		}
		harga = nilai + tambah;
	} else {
		harga = hrgDisc;
	}
		return harga;
}

function kurangiDiscBrg(jumlah,disc) {
	hasil = jumlah;
	if(disc != "" && disc != "0") {
		hasil = jumlah - (jumlah * disc/100);
	}
	return hasil;
}

var win_cp = dhxWins.createWindow("win_cp",0,0,340,150);
win_cp.setText("Ganti Password");
win_cp.button("park").hide();
win_cp.button("minmax1").hide();
win_cp.center();
win_cp.button("close").attachEvent("onClick", function() {
		win_cp.hide();
		return;
    });
win_cp.hide();

function gantiPassword() {
	win_cp.show();
	win_cp.bringToTop();
	win_cp.attachObject('tmpChangePass');
}

function gantiPasswd() {
	passBaru = document.frmCpass.passBaru.value;
	cPassBaru = document.frmCpass.cPassBaru.value;
	if(passBaru != cPassBaru) {
		alert("Password Tidak Sama");
		return;
	}
	
	var poststr =
			'passwd=' + passBaru;
	dhtmlxAjax.post("<?php echo base_url(); ?>index.php/home/gantiPass", encodeURI(poststr), function(loader) {
			result = loader.xmlDoc.responseText;
			alert(result);
			if(result) {
				window.location.href = "<?php echo base_url(); ?>/index.php/home/logout";
			}
		});
}
</script>
</body>
</html>

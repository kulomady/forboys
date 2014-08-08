// JavaScript Document
//window.dhx_globalImgPath =  window.parent.base_url+"assets/codebase_combo/imgs/";
window.dhx_globalImgPath =  base_url+"assets/codebase_combo/imgs/";
document.write('<div id="winVP" style="position: relative; display:none; height: 500px; border: #cecece 1px solid; margin: 10px;"></div>');
var dhxWins;
//var base_url = window.parent.base_url;
		//function doOnLoad() {
			
			dhxWins = new dhtmlXWindows(); 
			dhxWins.enableAutoViewport(true); 
			dhxWins.setSkin("dhx_skyblue");
			//dhxWins.attachViewportTo("winVP");
			dhxWins.setImagePath(window.parent.base_url+"assets/codebase_windows/imgs/");
			dhxWins.attachEvent("onContentLoaded", function(win){
				statusEnding();	
			});
		//}
		
		
		
		function createWindow(id,weight,height,text,controller) {
			
			w1 = dhxWins.createWindow(id,0,0,weight,height);
    		w1.setText(text);
			w1.attachURL(window.parent.base_url+"index.php/"+controller,true);
			w1.center();
			statusLoading();
			w1.setModal(true);
			w1.button("close").attachEvent("onClose",function(){
				w1.close();
				w1.setModal(false);
			});
		}
		
		function createWindowAtcm(id,weight,height,text) {
			
			w1 = dhxWins.createWindow(id,0,0,weight,height);
    		w1.setText(text);
			w1.center();
			w1.setModal(true);
			w1.button("close").attachEvent("onClose",function(){
				w1.close();
				w1.setModal(false);
			});
			return w1;
		}
		
function statusLoading() {  
   ModalPopups.Indicator("idIndicator2",  
        "Please wait",  
        "<div style=''>" +   
        "<div style='float:left;'><img src='"+window.parent.base_url+"assets/modal/spinner.gif'></div>" +   
        "<div style='float:left; padding-left:10px;'>" +   
        "Permintaan Anda Sedang Diproses... <br/>" +   
        "Tunggu Beberapa Saat." +  
        "</div>",   
        {  
            width: 300,  
            height: 100  
        }  
    );
              
    //setTimeout('ModalPopups.Close(\"idIndicator2\");', 3000);  
}

function statusEnding() {
	ModalPopups.Close("idIndicator2");
}

// Insert Grid ok
function getData(grid,arrEx) {
	rowsnum = grid.getColumnCount();
	x = 1; data = "";
	grid.forEachRow(function(id){
		if(x==1) { spt = ""; } else { spt = "~"; }
		rows = "";
		n = 0;
		for(i=0;i<rowsnum;i++) {
			if(arrEx == "") {
				if(i==0) { sptc = ""; } else { sptc = "`"; }
				rows = rows+sptc+grid.cells(id,i).getValue(); 
			} else {
				if(include(arrEx,i)!=true) {
					if(n==0) { sptc = ""; } else { sptc = "`"; }
					rows = rows+sptc+grid.cells(id,i).getValue(); 
					n++;
				}	
			}
		}
		data = data+spt+rows;
		x++;
    });
	return data;
}

 function include(arr, obj) {
    for(var i=0; i<arr.length; i++) {
        if (arr[i] == obj) return true;
    } 
 }
 
 // end grid
 
 // select grid
 function pilihGridKeAtas(grid,input_id) {
	document.getElementById(input_id).blur();
	document.getElementById(input_id).value = "";
	idrec_md1 = grid.getRowIndex(grid.getSelectedId());
	idrec_next_md1 = parseInt(idrec_md1) - 1;
	grid.selectRow(idrec_next_md1);
	document.getElementById(input_id).focus();	 
 }
 
 function pilihGridKeBawah(grid,input_id) {
	document.getElementById(input_id).blur();
	document.getElementById(input_id).value = "";
	idrec_md1 = grid.getRowIndex(grid.getSelectedId());
	idrec_next_md1 = parseInt(idrec_md1) + 1;
	grid.selectRow(idrec_next_md1);
	document.getElementById(input_id).focus();	 
 }
 
 function pilihComboBox(zCombo,isi) {
	 	zCombo.setComboText("");
		idMdl = zCombo.getIndexByValue(isi);
		zCombo.selectOption(idMdl,true,true);	 
 }
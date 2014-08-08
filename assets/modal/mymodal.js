/* 
 * mymodal.js
 * 
 * Copyright (c) 2013 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */


function getBaseURL() {
    var url = location.href;  
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        // kalo base url nya localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // root url jika menggunakan domain name
        return baseURL + "/";
    }

}

function PesanBerhasil(pesan) {
    ModalPopups.Alert("jsAlert1",
        "Message Notification", 
        "<div style='padding:15px;'>" + 
        "<div style='' align='center'><img src='"+getBaseURL()+"images/success.png' style='vertical-align:middle;'></div><br />" +  
        "<div style='padding-left:12px;' align='center'>"+pesan+"<br/>" +
        "</div>" +
        "</div>",    
        {
            okButtonText: "Close",
            height: 170,
            width:350
        }        
    );
         setTimeout('ModalPopups.Close(\"jsAlert1\");', 5000); 
}

function statusLoading() {  
   ModalPopups.Indicator("modal",  
        "Please wait",  
        "<div style=''>" +   
        "<div style='float:left;'><img src="+getBaseURL()+"assets/modal/spinner.gif></div>" +   
        "<div style='float:left; padding-left:10px;'>" +   
        "Permintaan Anda Sedang Diproses... <br/>" +   
        "Tunggu Beberapa Saat." +  
		"<p><a href='javascript:void(0)' onClick='statusEnding()'>Close</a></p>" + 
        "</div>",   
        {  
            width: 300,  
            height: 120  
        }  
    );
              
    //setTimeout('ModalPopups.Close(\"idIndicator2\");', 3000);  
}

function statusEnding() {
	ModalPopups.Close("modal");
}

function PesanError(pesan) {
    ModalPopups.Alert("alerterror",
        "Message Notification", 
        "<div style='padding:15px;'>" + 
        "<div style='' align='center'><img src='"+getBaseURL()+"images/error.png' style='vertical-align:middle;'></div><br />" +  
        "<div style='padding-left:12px;' align='center'>"+pesan+"" +
        "</div>" +
        "</div>",    
        {
            okButtonText: "Close",
            height: 170,
            width:350
        }        
    );
         setTimeout('ModalPopups.Close(\"alerterror\");', 5000); 
}
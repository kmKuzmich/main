var place_general="";

function load_content(source,place){
	place_general=place;
	if (window.XMLHttpRequest) {req = new XMLHttpRequest(); req.onreadystatechange = processCont; req.open("GET", source, true);req.send(null); }
	else if (window.ActiveXObject) { req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) { req.onreadystatechange = processCont; req.open("GET", source, true); req.send(); }
	}
}
function processCont() {
	if (req.readyState == 4) {
		if (req.status==1){ document.getElementById(place_general).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req.status==2){document.getElementById(place_general).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req.status == 200) {document.getElementById(place_general).innerHTML=req.responseText;}
	}
}

function alert_content(source_alert){ 
	if (window.XMLHttpRequest) {req_alert = new XMLHttpRequest(); req_alert.onreadystatechange = processCont_alert; req_alert.open("GET", source_alert, true);req_alert.send(null); }
	else if (window.ActiveXObject) { req_alert = new ActiveXObject("Microsoft.XMLHTTP");
		if (req_alert) { req_alert.onreadystatechange = processCont_alert; req_alert.open("GET", source_alert, true); req_alert.send(); }
	}
}
function processCont_alert() {
	if (req_alert.readyState == 4) {
		if (req_alert.status==1){ alert('ќжидайте');} 
		if (req_alert.status==2){alert('ќжидайте');} 
		if (req_alert.status == 200) {alert(req_alert.responseText);}
	}
}

function load_content1(source1,place1,metod1){
	place_general1=place1;
	jmetod1=metod1;
	if (window.XMLHttpRequest) {req1 = new XMLHttpRequest(); req1.onreadystatechange = processCont1; req1.open("GET", source1, true);req1.send(null); }
	else if (window.ActiveXObject) { req1 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req1) { req1.onreadystatechange = processCont1; req1.open("GET", source1, true); req1.send(); }
	}
}

function processCont1() {
	if (req1.readyState == 4) {
		if (req1.status==1){ document.getElementById(place_general1).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req1.status==2){document.getElementById(place_general1).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req1.status == 200) {
			if (jmetod1=="inner"){ document.getElementById(place_general1).innerHTML=req1.responseText;}
			if (jmetod1=="value"){ document.getElementById(place_general1).value=req1.responseText;}
		}

	}
}
function load_content2(source2,place2,metod2){ 
	place_general2=place2;
	jmetod2=metod2;
	if (window.XMLHttpRequest) {req2 = new XMLHttpRequest(); req2.onreadystatechange = processCont2; req2.open("GET", source2, true);req2.send(null); }
	else if (window.ActiveXObject) { req2 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req2) { req2.onreadystatechange = processCont2; req2.open("GET", source2, true); req2.send(); }
	}
}

function processCont2() {
	if (req2.readyState == 4) {
		if (req2.status==1){ document.getElementById(place_general2).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req2.status==2){document.getElementById(place_general2).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req2.status == 200) {
			if (jmetod2=="inner"){ document.getElementById(place_general2).innerHTML=req2.responseText;}
			if (jmetod2=="value"){ document.getElementById(place_general2).value=req2.responseText;}
		}

	}
}
function load_content3(source3,place3,metod3){
	place_general3=place3;
	jmetod3=metod3;
	if (window.XMLHttpRequest) {req3 = new XMLHttpRequest(); req3.onreadystatechange = processCont3; req3.open("GET", source3, true);req3.send(null); }
	else if (window.ActiveXObject) { req3 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req3) { req3.onreadystatechange = processCont3; req3.open("GET", source3, true); req3.send(); }
	}
}

function processCont3() {
	if (req3.readyState == 4) {
		if (req3.status==1){ document.getElementById(place_general3).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req3.status==2){document.getElementById(place_general3).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req3.status == 200) {
			if (jmetod3=="inner"){ document.getElementById(place_general3).innerHTML=req3.responseText;}
			if (jmetod3=="value"){ document.getElementById(place_general3).value=req3.responseText;}
		}

	}
}
function load_content4(source4,place4,metod4){
	place_general4=place4;
	jmetod4=metod4;
	if (window.XMLHttpRequest) {req4 = new XMLHttpRequest(); req4.onreadystatechange = processCont4; req4.open("GET", source4, true);req4.send(null); }
	else if (window.ActiveXObject) { req4 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req4) { req4.onreadystatechange = processCont4; req4.open("GET", source4, true); req4.send(); }
	}
}

function processCont4() {
	if (req4.readyState == 4) {
		if (req4.status==1){ document.getElementById(place_general4).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req4.status==2){document.getElementById(place_general4).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req4.status == 200) {
			if (jmetod4=="inner"){ document.getElementById(place_general4).innerHTML=req4.responseText;}
			if (jmetod4=="value"){ document.getElementById(place_general4).value=req4.responseText;}
		}
	}
}
function load_content5(source5,place5,metod5){
	place_general5=place5;
	jmetod5=metod5;
	if (window.XMLHttpRequest) {req5 = new XMLHttpRequest(); req5.onreadystatechange = processCont5; req5.open("GET", source5, true);req5.send(null); }
	else if (window.ActiveXObject) { req5 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req5) { req5.onreadystatechange = processCont5; req5.open("GET", source5, true); req5.send(); }
	}
}

function processCont5() {
	if (req5.readyState == 4) {
		if (req5.status==1){ document.getElementById(place_general5).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req5.status==2){document.getElementById(place_general5).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req5.status == 200) {
			if (jmetod5=="inner"){ document.getElementById(place_general5).innerHTML=req5.responseText;}
			if (jmetod5=="value"){ document.getElementById(place_general5).value=req5.responseText;}
		}
	}
}
function load_content6(source6,place6,metod6){
	place_general6=place6;
	jmetod6=metod6;
	if (window.XMLHttpRequest) {req6 = new XMLHttpRequest(); req6.onreadystatechange = processCont6; req6.open("GET", source6, true);req6.send(null); }
	else if (window.ActiveXObject) { req6 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req6) { req6.onreadystatechange = processCont6; req6.open("GET", source6, true); req6.send(); }
	}
}

function processCont6() {
	if (req6.readyState == 4) {
		if (req6.status==1){ document.getElementById(place_general6).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req6.status==2){document.getElementById(place_general6).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req6.status == 200) {
			if (jmetod6=="inner"){ document.getElementById(place_general6).innerHTML=req6.responseText;}
			if (jmetod6=="value"){ document.getElementById(place_general6).value=req6.responseText;}
		}
	}
}
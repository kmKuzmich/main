var place_general="";
var res="";
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

function load_content1(source1,place1){
	place_general1=place1;
	if (window.XMLHttpRequest) {req1 = new XMLHttpRequest(); req1.onreadystatechange = processCont1; req1.open("GET", source1, true);req1.send(null); }
	else if (window.ActiveXObject) { req1 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req1) { req1.onreadystatechange = processCont1; req1.open("GET", source1, true); req1.send(); }
	}
}
function processCont1() {
	if (req1.readyState == 4) {
		if (req1.status==1){ document.getElementById(place_general1).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req1.status==2){document.getElementById(place_general1).innerHTML='<div align="center"><img src="uploads/images/general/loading.gif" border=0></div>';} 
		if (req1.status == 200) {document.getElementById(place_general1).innerHTML=req1.responseText;}
	}
}

function alert_content(sourcea){ 
	if (window.XMLHttpRequest) {reqa = new XMLHttpRequest(); reqa.onreadystatechange = processConta; reqa.open("GET", sourcea, true);reqa.send(null); }
	else if (window.ActiveXObject) { reqa = new ActiveXObject("Microsoft.XMLHTTP");
		if (reqa) { reqa.onreadystatechange = processConta; reqa.open("GET", sourcea, true); reqa.send(); }
	}
}
function processConta() {
	if (reqa.readyState == 4) {
		if (reqa.status == 200) {alert(reqa.responseText);}
	}
}

function return_content(sourcer){ 
	if (window.XMLHttpRequest) {reqr = new XMLHttpRequest(); reqr.onreadystatechange = processContr; reqr.open("GET", sourcer, true);reqr.send(null); }
	else if (window.ActiveXObject) { reqr = new ActiveXObject("Microsoft.XMLHTTP");
		if (reqr) { reqr.onreadystatechange = processContr; reqr.open("GET", sourcer, true); reqr.send(); }
	}
	return res;
}
function processContr() {
	if (reqr.readyState == 4) {
		if (reqr.status == 200) { res=reqr.responseText;}
	}
	return res;
}

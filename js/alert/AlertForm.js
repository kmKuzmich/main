var onload_set=false;
function showAlBg(){
	document.getElementById("AlertWindowBg").style.visibility="visible";
	document.getElementById("AlertWindowBg").style.position="absolute";
	document.getElementById("AlertWindowBg").style.width=$(document).width();
	document.getElementById("AlertWindowBg").style.height=$(document).height();
	document.getElementById("AlertWindowBg").style.left="0px";
	document.getElementById("AlertWindowBg").style.top="0px";
}
function closeAlBg(){
	document.getElementById("AlertWindowBg").style.visibility="hidden";
	document.getElementById("AlertWindowBg").style.position="absolute";
	document.getElementById("AlertWindowBg").style.width="0%";
	document.getElementById("AlertWindowBg").style.height="0%";
}

function showAlertForm(info) {showAlBg();
	document.getElementById("AlertForm").style.visibility="visible";
	document.getElementById("AlertForm").style.position="absolute";
	document.getElementById("AlertForm").style.width="500px";
	document.getElementById("AlertForm").style.left="50%";
	document.getElementById("AlertForm").style.marginLeft="-250px";
	document.getElementById("AlertForm").style.top="100px";
	document.getElementById("AlertForm").style.top=$(document).scrollTop()+200;
	document.getElementById("AlertInfo").innerHTML=info;
	
}
function closeAlertForm() {
	document.getElementById("AlertForm").style.visibility="hidden";
	document.getElementById("AlertForm").style.position="absolute";
	document.getElementById("AlertForm").style.left="-150%";
	document.getElementById("AlertForm").style.top="0%";
	document.getElementById("AlertInfo").innerHTML="";closeAlBg();
	
}
function startLoading() {
	document.getElementById("Loading").style.visibility="visible";
	document.getElementById("Loading").style.position="absolute";
	document.getElementById("Loading").style.width="50px";
	document.getElementById("Loading").style.left="50%";
	document.getElementById("Loading").style.marginLeft="-25px";
	document.getElementById("Loading").style.top="300px";
}
function stopLoading() {
	document.getElementById("Loading").style.visibility="hidden";
	document.getElementById("Loading").style.position="absolute";
	document.getElementById("Loading").style.left="-150%";
	document.getElementById("Loading").style.top="0%";
}
window.onkeyup = function (event) {
	if (event.keyCode == 27){
		if(document.getElementById("AlertForm").style.visibility=='visible') {closeAlertForm(); return false;}
		if(document.getElementById("InfoForm").style.visibility=='visible') { closeInfoForm(); return false;}
		if(document.getElementById("BusketForm").style.visibility=='visible') {closeBusketForm(); return false;}
		if(document.getElementById("wind").style.visibility=='visible') { win_close(); return false;}
	}
}
function win_open() {showAlBg();
	document.getElementById("wind").style.visibility="visible";
	document.getElementById("wind").style.position="absolute";
	document.getElementById("wind").style.left="50%";
	document.getElementById("wind").style.marginLeft="-300px";
	document.getElementById("wind").style.top=$(document).scrollTop()+100;
	document.getElementById("wind").style.width="700px";
	document.getElementById("wind").style.height="600px";
}
function win_close() {closeAlBg();
	document.getElementById("wind").style.visibility="hidden";
	document.getElementById("wind").style.position="absolute";
	document.getElementById("wind").style.left="-150%";
	document.getElementById("wind").style.top="0%";
	document.getElementById("wind").style.width="0px";
	document.getElementById("wind").style.height="0px";
	document.getElementById("wind_cont").innerHTML="";
}
function showInfoForm() {showAlBg();
	document.getElementById("InfoForm").style.visibility="visible";
	document.getElementById("InfoForm").style.position="absolute";
	document.getElementById("InfoForm").style.left="50%";
	document.getElementById("InfoForm").style.top=$(document).scrollTop()+100;
	document.getElementById("InfoForm").style.width="auto";
	document.getElementById("InfoForm").style.minWidth="500px";
	document.getElementById("InfoForm").style.maxWidth="900px";
	document.getElementById("InfoForm").style.marginLeft="-350px";
	document.getElementById("InfoForm").style.height=($(window).height())-350;
//	document.getElementById("InfoForm").style.height="700px";
}
function closeInfoForm() {
	document.getElementById("InfoForm").style.visibility="hidden";
	document.getElementById("InfoForm").style.position="absolute";
	document.getElementById("InfoForm").style.left="-150%";
	document.getElementById("InfoForm").style.top="0%";
	document.getElementById("InfoForm").style.width="0px";
	document.getElementById("InfoForm").style.height="0px";
	document.getElementById("InfoFormInfo").innerHTML="";closeAlBg();
}
function showHistorySearchFrom() { var er=0;
	if (document.getElementById("HistorySearchFrom").style.visibility=="visible"){closeHistorySearchFrom(); er=1;}
	if (er==0){
		document.getElementById("HistorySearchFrom").style.visibility="visible";
		document.getElementById("HistorySearchFrom").style.position="absolute";
		document.getElementById("HistorySearchFrom").style.height="auto";
		document.getElementById("HistorySearchFrom").style.width="auto";
		document.getElementById("HistorySearchFrom").style.marginTop="22px";
	}
}
function closeHistorySearchFrom() {
	document.getElementById("HistorySearchFrom").style.visibility="hidden";
	document.getElementById("HistorySearchFrom").style.position="absolute";
	document.getElementById("HistorySearchFrom").style.height="0px";
	document.getElementById("HistorySearchFrom").style.width="0px";
	document.getElementById("HistorySearchFrom").innerHTML="";
}
function win2_open() {showAlBg();
	document.getElementById("wind2").style.visibility="visible";
	document.getElementById("wind2").style.position="fixed";
	document.getElementById("wind2").style.left="50%";
	document.getElementById("wind2").style.marginLeft="-500px";
	document.getElementById("wind2").style.top="20px";
	document.getElementById("wind2").style.width="1000px";
	document.getElementById("wind2").style.height="700px";
}
function win2_close() {
	document.getElementById("wind2").style.visibility="hidden";
	document.getElementById("wind2").style.position="absolute";
	document.getElementById("wind2").style.left="-150%";
	document.getElementById("wind2").style.top="0%";
	document.getElementById("wind2").style.width="0px";
	document.getElementById("wind2").style.height="0px";
	document.getElementById("wind2_cont").innerHTML="";closeAlBg();
}
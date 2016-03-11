function win_open() {
	document.getElementById("wind").style.visibility="visible";
	document.getElementById("wind").style.position="fixed";
	document.getElementById("wind").style.left="50%";
	document.getElementById("wind").style.marginLeft="-500px";
	document.getElementById("wind").style.top="10px";
	document.getElementById("wind").style.width="1000px";
	document.getElementById("wind").style.height="700px";
}
function win_close() {
	document.getElementById("wind").style.visibility="hidden";
	document.getElementById("wind").style.position="absolute";
	document.getElementById("wind").style.left="-150%";
	document.getElementById("wind").style.top="0%";
	document.getElementById("wind").style.width="0px";
	document.getElementById("wind").style.height="0px";
	document.getElementById("wind_cont").innerHTML="";
}
function win2_open() {
	document.getElementById("wind2").style.visibility="visible";
	document.getElementById("wind2").style.position="absolute";
	document.getElementById("wind2").style.left="50%";
	document.getElementById("wind2").style.marginLeft="-25%";
	document.getElementById("wind2").style.top="50px";
	document.getElementById("wind2").style.width="500px";
	document.getElementById("wind2").style.height="300px";
}
function win2_close() {
	document.getElementById("wind2").style.visibility="hidden";
	document.getElementById("wind2").style.position="absolute";
	document.getElementById("wind2").style.left="-150%";
	document.getElementById("wind2").style.top="0%";
	document.getElementById("wind2").style.width="0px";
	document.getElementById("wind2").style.height="0px";
	document.getElementById("wind2_cont").innerHTML="";
}

function show_foto(foto,caption,data) {
	load_content("content.php?w=show_galery_foto&foto="+foto,"foto");
	document.getElementById("caption").innerHTML=caption;
	document.getElementById("data").innerHTML=data;
}


function show_galery_opinion(pic) {
	status=document.getElementById("opinion").innerHTML;
	if (status!=""){ document.getElementById("opinion").innerHTML=""; }
	if (status==""){ load_content("content.php?&w=load_galery_opinion&pic="+pic,"opinion",""); }
}
function clear_opinion_form() {
	document.getElementById("desc").value='';
}

function save_opinion_form() {
	desc = document.getElementById("desc").value;
	pic = document.getElementById("pic").value;
	if (desc==''){ alert("Не заполнены обязательные поля"); }
	if (desc!=''){ 
		load_content("content.php?&w=save_opinion&pic="+pic+"&desc="+desc,"opinion","");
	}
}
function save_galery_vote() {
	pic = document.getElementById("pic").value;
	if (pic!=''){ 
		alert("Ваш голос принят");
		document.getElementById("vote_button").disabled="disabled";
		load_content("content.php?&w=save_galery_vote&pic="+pic,"votes","");
	}
}
function clear_opinion_form() {
    document.getElementById("name").value='';
	document.getElementById("desc").value='';
}

function save_opinion_form() {
    name = document.getElementById("name").value;
	desc = document.getElementById("desc").value;
	article_id = document.getElementById("article_id").value;
	if ((name=='') || (desc=='')){ alert("Не заполнены обязательные поля"); }
	if ((name!='') && (desc!='')){ 
		load_content("content.php?&w=save_article_opinion&article_id="+article_id+"&name="+name+"&desc="+desc,"opinion","");
	}
}
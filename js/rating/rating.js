function vote_rating(file,id,rate) {
	if (file=='' || id==''){ alert("Ошибка голосования"); }
	if (file!='' && id!=''){ 
		alert_content("content.php?&w=save_"+file+"_vote&id="+id+"&rate="+rate);
		load_content("content.php?&w=show_"+file+"_vote&id="+id,"vote_form");
	}
}
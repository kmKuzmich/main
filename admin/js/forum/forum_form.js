function save_form() {
	er=0;
	if (document.all.forum_form.caption.value=="") { er=1; }
	if (document.all.forum_form.desc.value=="") { er=1; }
	

	if (er==1){ alert("Не заполнені всі поля!"); }
	if (er==0){ document.all.forum_form.submit(); }
}

function save_form() {
	er=0;
	if (document.all.articles_form.caption.value=="") { er=1; }
	if (er==1){ alert("Не заполнено поле Название!"); }
	if (er==0){ document.all.articles_form.submit(); }
}

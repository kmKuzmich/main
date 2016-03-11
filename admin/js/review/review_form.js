function save_form() {
	er=0;
	if (document.all.review_form.caption.value=="") { er=1; }
	if (document.all.review_form.data.value=="") { er=1; }
	

	if (er==1){ alert("Не заполнено поле Название!"); }
	if (er==0){ document.all.review_form.submit(); }
}

function save_form() {
	er=0;
	if (document.all.subscribe_form.caption.value=="") { er=1; }

	if (er==1){ alert("Не заполнено поле Название рассылки!"); }
	if (er==0){ document.all.subscribe_form.submit(); }
}

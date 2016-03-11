function save_form() {
	er=0;
	if (document.all.anons_form.caption.value=="") { er=1; }
	if (document.all.anons_form.data.value=="") { er=1; }
	

	if (er==1){ alert("Не заполнено поле Название раздела!"); }
	if (er==0){ document.all.anons_form.submit(); }
}

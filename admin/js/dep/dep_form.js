function save_form() {
	er=0;
	if (document.all.dep_form.caption.value=="") { er=1; }

	if (er==1){ alert("�� ��������� ���� �������� �������!"); }
	if (er==0){ document.all.dep_form.submit(); }
}

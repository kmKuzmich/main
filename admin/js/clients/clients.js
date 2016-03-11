function load_client_list(page) {
	document.getElementById("page").value=page;
	load_content("content.php?&w=show_client_list&page="+page,"client_list");
}
function show_client(id) {
	win_open();
	load_content("content.php?&w=show_client&client_id="+id,"wind_cont");
}

function delete_order(id) {
	if(confirm('Удалить заказ?')){
		win_close();
		alert_content("content.php?&w=delete_order&order_id="+id);
		page=document.getElementById("page").value;
		setTimeout('load_content(\"content.php?&w=show_order_list&page=\"+page,\"order_list\")', 2000);
	}
}
function print_order(id){
	printWin= open("print.php", "displayWindow1","width=1000,height=700,status=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes");
}
function client_discount(client_id) {
		win2_open();
		load_content("content.php?&w=show_client_discount&client_id="+client_id,"wind2_cont");
}
function save_client_discount_form(client_discount_id,discount) {
		alert_content("content.php?&w=save_client_discount&client_id="+client_discount_id+"&discount="+discount);
		client_id=document.getElementById("client_discount_id").value;
		setTimeout('load_content(\"content.php?&w=show_client&client_id=\"+client_id,\"wind_cont\")', 2000);
		win2_close();
		setTimeout('load_content(\"content.php?&w=show_client_list&page=\"+page,\"client_list\")', 1000);
		
}
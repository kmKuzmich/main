function load_order_list(page) {
	document.getElementById("page").value=page;
	load_content("content.php?&w=show_order_list&page="+page,"order_list");
}
function show_order(id) {
	win_open();
	load_content("content.php?&w=show_order&order_id="+id,"wind_cont");
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
function status_order(order_id) {
		win2_open();
		load_content("content.php?&w=show_order_status&order_id="+order_id,"wind2_cont");
}
function save_order_status_form(order_status_id,status) {
		alert_content("content.php?&w=save_order_status&order_id="+order_status_id+"&status="+status);
		order_id=document.getElementById("order_status_id").value;
		setTimeout('load_content(\"content.php?&w=show_order&order_id=\"+order_id,\"wind_cont\")', 2000);
		win2_close();
		setTimeout('load_content(\"content.php?&w=show_order_list&page=\"+page,\"order_list\")', 1000);
		
}
function show_kurier_form(order_id) {
		win2_open();
		load_content("content.php?&w=show_kurier_form&order_id="+order_id,"wind2_cont");
}
function create_order_sms(){
	var kurier=document.getElementById("kurier_kurier").value;
	var price=document.getElementById("kurier_price").value;
	var ttn=document.getElementById("kurier_ttn").value;
	var message=document.getElementById("kurier_message").value;
	message=message+""+kurier+"\nТТН:"+ttn+"\nДоставка:"+price+"грн\nОжидайте!";
	document.getElementById("kurier_message").value=message;
}

function save_order_kurier_form(order_id) {
	var id=document.getElementById("kurier_id").value;
	var kurier=document.getElementById("kurier_kurier").value;
	var price=document.getElementById("kurier_price").value;
	var ttn=document.getElementById("kurier_ttn").value;
	var message=document.getElementById("kurier_message").value;
	if (message==""){alert("Введите текст для СМС сообщения!");}
	if (message!=""){
		alert_content("content.php?&w=save_order_kurier&order_id="+order_id+"&id="+id+"&kurier="+kurier+"&ttn="+ttn+"&price="+price+"&message="+message);
		setTimeout('load_content(\"content.php?&w=show_order&order_id=\"+order_id,\"wind_cont\")', 2000);
		win2_close();
		setTimeout('load_content(\"content.php?&w=show_order_list&page=\"+page,\"order_list\")', 1000);
	}
}
function send_order_kurier_sms(order_id) {
	var message=document.getElementById("kurier_message").value;
	if (message==""){alert("Введите текст для СМС сообщения!");}
	if (message!=""){
		alert_content("content.php?&w=send_order_kurier_sms&order_id="+order_id+"&message="+message);
	}
}
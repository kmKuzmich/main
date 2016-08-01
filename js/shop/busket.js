function showBusketForm() {showAlBg();
	document.getElementById("BusketForm").style.visibility="visible";
	document.getElementById("BusketForm").style.position="absolute";
	document.getElementById("BusketForm").style.width="900px"; 
	document.getElementById("BusketForm").style.left=$(document).width()/2;
	document.getElementById("BusketForm").style.marginLeft="-450px";
	document.getElementById("BusketForm").style.top="100px";
	document.getElementById("AlertForm").style.top=$(document).scrollTop()+250;
}
function closeBusketForm() {
	document.getElementById("BusketForm").style.visibility="hidden";
	document.getElementById("BusketForm").style.position="absolute";
	document.getElementById("BusketForm").style.left="-150%";
	document.getElementById("BusketForm").style.top="0%";
	document.getElementById("BusketInfo").innerHTML="";closeAlBg();
}
/*function showOrderStr(orderId) {var er=0;startLoading();
	if (document.getElementById("arrow"+orderId).className=="arrowUp"){closeOrderStr(orderId); er=1;}
	if (er==0){
		document.getElementById("arrow"+orderId).className="arrowUp";
		document.getElementById("OrderStr"+orderId).style.visibility="visible";
		document.getElementById("OrderStr"+orderId).style.position="relative";
		document.getElementById("arrow"+orderId).src="/theme/images/arrowUp.png";
		document.getElementById("row"+orderId).style.backgroundColor="#3585e3";
		document.getElementById("row"+orderId).style.color="#ffffff";
		document.getElementById("row"+orderId).style.borderBottom="1px solid #ffffff";stopLoading();
	}
}
*/
function closeOrderStr(orderId) {
	document.getElementById("arrow"+orderId).className="arrowDown";
	document.getElementById("OrderStr"+orderId).style.visibility="hidden";
	document.getElementById("OrderStr"+orderId).style.position="absolute";
	document.getElementById("arrow"+orderId).src="/theme/images/arrowDown.png";
	document.getElementById("row"+orderId).style.backgroundColor="#ffffff";
	document.getElementById("row"+orderId).style.color="#000";
	document.getElementById("row"+orderId).style.borderBottom="1px solid #ffffff";
}
function showDocStr(docId) {var er=0;startLoading();
	if (document.getElementById("arrow"+docId).className=="arrowUp"){closeDocStr(docId); er=1;}
	if (er==0){
		document.getElementById("arrow"+docId).className="arrowUp";
		document.getElementById("DocStr"+docId).style.visibility="visible";
		document.getElementById("DocStr"+docId).style.position="relative";
		document.getElementById("arrow"+docId).src="/theme/images/arrowUp.png";
		document.getElementById("row"+docId).style.backgroundColor="#3585e3";
		document.getElementById("row"+docId).style.color="#ffffff";
		document.getElementById("row"+docId).style.borderBottom="1px solid #ffffff";
	}
	fleXenv.updateScrollBars(); fleXenv.fleXcrollMain("flexcroll");stopLoading();
}
function closeDocStr(docId) {
	document.getElementById("arrow"+docId).className="arrowDown";
	document.getElementById("DocStr"+docId).style.visibility="hidden";
	document.getElementById("DocStr"+docId).style.position="absolute";
	document.getElementById("arrow"+docId).src="/theme/images/arrowDown.png";
	document.getElementById("row"+docId).style.backgroundColor="#ffffff";
	document.getElementById("row"+docId).style.color="#000";
	document.getElementById("row"+docId).style.borderBottom="1px solid #ffffff";
}

function PlusOneOrder() {
	JsHttpRequest.query('content.php',{ 'w': 'PlusOneOrder'}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		if (result["Answer"]=="ok"){ loadOrdersList(); }
	}}, true);
}
function loadOrdersList() {
	JsHttpRequest.query('content.php',{ 'w': 'loadOrdersList'}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("orders_list_place").innerHTML=result["content"];
	}}, true);
}

function show_busket_form(model) {
	if (model==''){ alert("¬нутренн€€ ошибка сайта"); }
	if (model!=''){ startLoading();
		JsHttpRequest.query('content.php',{ 'w': 'show_busket_form', 'model': model}, 
		function (result, errors){ if (errors) {alert(errors);} if (result){ 
			document.getElementById("BusketInfo").innerHTML=result["content"];
			showBusketForm();
			updateBusketInformer();stopLoading();
		}}, true);
	}
}
function show_busket_maslo_form(model,category) {
	if (model==''){ alert("¬нутренн€€ ошибка сайта"); }
	if (model!=''){ startLoading();
		JsHttpRequest.query('content.php',{ 'w': 'show_busket_maslo_form', 'category':category, 'model': model}, 
		function (result, errors){ if (errors) {alert(errors);} if (result){ 
			document.getElementById("BusketInfo").innerHTML=result["content"];
			showBusketForm();
			updateBusketInformer();stopLoading();
		}}, true);
	}
}
function dropModel(model){
	var model=document.getElementById("model").value;
	JsHttpRequest.query('content.php',{ 'w': 'dropModel', 'model': model}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){  }}, true);
	closeBusketForm();
	updateBusketInformer();
}
function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}
function SaveModelBusket(model) {
	var order_id = document.getElementById("OrderActiveId")[document.getElementById("OrderActiveId").selectedIndex].value;
	var price = document.getElementById("model_price").value;
	var kol = document.getElementById("model_kol").value;
	JsHttpRequest.query('content.php', {
			'w': 'SaveModelBusket',
			'order_id': order_id,
			'model': model,
			'count': kol,
			'price': price
		},
		function (result, errors) {
			if (errors) {
				alert(errors);
			}
			if (result) {
				updateBusketInformer();
				closeBusketForm();
			}
		}, true);
}
function plusOne(model){
	var price=document.getElementById("model_price").value;
	var kol=document.getElementById("model_kol").value;
	var summ=0;
	kol++;
	summ=roundNumber(price*kol,2);
	document.getElementById("model_summ").innerHTML=summ;
	document.getElementById("model_kol").value=kol;
}
function minusOne(model){
	var price=document.getElementById("model_price").value;
	var kol=document.getElementById("model_kol").value;
	var summ=0;
	kol--;
	if (kol==0){kol=0;}
	summ=roundNumber(price*kol,2);
	document.getElementById("model_summ").innerHTML=summ;
	document.getElementById("model_kol").value=kol;
}
function plusOneBusket(order_id,or_id){
	var SummBusket=Number(document.getElementById("SummBusket"+order_id).innerHTML);
	var price=Number(document.getElementById("price"+or_id).value);
	var kol=Number(document.getElementById("count"+or_id).innerHTML);
	var summ=0;	kol++;
	summ=roundNumber(price*kol,2);
	document.getElementById("count"+or_id).innerHTML=kol;
	document.getElementById("summ"+or_id).value=summ;
	document.getElementById("summ_caption"+or_id).innerHTML=summ;
	document.getElementById("SummBusket"+order_id).innerHTML=roundNumber(SummBusket+price,2);
	JsHttpRequest.query('content.php',{ 'w': 'updateBusketModelCount', 'or_id': or_id, 'count':kol}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 	updateBusketInformer(); }}, true);
}
function minusOneBusket(order_id,or_id){
	var SummBusket=Number(document.getElementById("SummBusket"+order_id).innerHTML);
	var price=Number(document.getElementById("price"+or_id).value);
	var kol=Number(document.getElementById("count"+or_id).innerHTML);
	var summ=0; kol--;
	if (kol>=0){
		summ=roundNumber(price*kol,2);
		document.getElementById("count"+or_id).innerHTML=kol;
		document.getElementById("summ"+or_id).value=summ;
		document.getElementById("summ_caption"+or_id).innerHTML=summ;
		document.getElementById("SummBusket"+order_id).innerHTML=roundNumber(SummBusket-price,2);
		JsHttpRequest.query('content.php',{ 'w': 'updateBusketModelCount', 'or_id': or_id, 'count':kol}, 
		function (result, errors){ if (errors) {alert(errors);} if (result){ updateBusketInformer(); }}, true);
	}
}
function updateBusketInformer(){
	JsHttpRequest.query('content.php',{ 'w': 'show_busket'}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("BusketInformer").innerHTML=result["content"];
	}}, true);
}


function drop_busket_position(model, order_id) {
	if (model == '' && order_id == '') {
		alert("¬нутренн€€ ошибка сайта");
	}
	if (model != '' || order_id == '') {
		JsHttpRequest.query('content.php', {'w': 'dropModel', 'model': model},
			function (result, errors) {
				if (errors) {
					alert(errors);
				}
				if (result) {
					showOrderStr(order_id);
				}
			}, true);
	}
}

function confimOrder(orderId){startLoading();
	JsHttpRequest.query('content.php',{ 'w': 'confirmOrder', 'orderId': orderId}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		stopLoading();
		if (result["answer"]==""){location.href='index.php?dep=busket&w=make_order&order_id='+orderId;}
		if (result["answer"]!=""){
			if(confirm(result["answer"])){ location.href='index.php?dep=busket&w=make_order&order_id='+orderId;}
		}
	}}, true);
	
}
function drop_busket_action_position(action_id) {
	if (action_id==''){ alert("¬нутренн€€ ошибка сайта"); }
	if (action_id!=''){ 
		JsHttpRequest.query('content.php',{ 'w': 'dropAction', 'action_id': action_id}, 
		function (result, errors){ if (errors) {alert(errors);} if (result){ 
			showClientBusket();
		}}, true);
	}
}
function showClientBusket() {
	JsHttpRequest.query('content.php',{ 'w': 'showClientBusket'}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("busket").innerHTML=result["content"];
	}}, true);
}

function show_payment_comment(comment) {
	JsHttpRequest.query('content.php',{ 'w': 'show_payment_comment', 'comment':comment}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("payment_comment").innerHTML=result["content"];
	}}, true);
}
function setDelivery(caption) {
	document.getElementById("delivery").value=caption;
}
function save_fast_order() { 
	document.getElementById("OrderError").innerHTML="";
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//	var regexp = "/^[a-z]([0-9a-z])+$/i";
//	if(!regexp.test(name))  return "Name may consist of letter, numbers and start with a letter." );
	var email = document.getElementById("email").value;
	var phone = document.getElementById("phone").value;
	var name = document.getElementById("name").value;
	var state = document.getElementById("state_form")[document.getElementById("state_form").selectedIndex].value;
	var city = document.getElementById("city_form")[document.getElementById("city_form").selectedIndex].value;
	var new_city = document.getElementById("new_ordercity").value;
	var address = document.getElementById("address_sent").value;
	var activity = document.getElementById("RegActivity_form")[document.getElementById("RegActivity_form").selectedIndex].value;
	var delivery = document.getElementById("delivery")[document.getElementById("delivery").selectedIndex].value;
	var payment = document.getElementById("payment")[document.getElementById("payment").selectedIndex].value;
	var errorEmail = document.getElementById("errorEmail").value;
	
	if(reg.test(email) == false) { submit_email=0; } else {submit_email=1; }
	if(name==""){submit_name=0; } else {submit_name=1; }
	if(address==""){submit_address=0; } else {submit_address=1; }
	if(phone==""){submit_phone=0; } else {submit_phone=1; }
	if(city==""){submit_city=0; } else {submit_city=1; }
	if(state=="" || state==0){submit_state=0; } else {submit_state=1; }
	if(delivery=="" || delivery==0){submit_delivery=0; } else {submit_delivery=1; }
	if(payment=="" || payment==0){submit_payment=0; } else {submit_payment=1; }
	
	
	if (submit_email==0){ document.getElementById("OrderError").innerHTML+="¬ведите ¬аш E-mail<br>"; }
	if (submit_name==0){ document.getElementById("OrderError").innerHTML+="”кажите ¬аше »м€<br>";}
	if (submit_address==0){ document.getElementById("OrderError").innerHTML+="”кажите адрес доставки заказа<br>";}
	if (submit_phone==0){ document.getElementById("OrderError").innerHTML+="¬ведите ¬аш номер телефона<br>";}
	if (submit_delivery==0){ document.getElementById("OrderError").innerHTML+="”кажите способ доставки<br>";}
	if (submit_payment==0){ document.getElementById("OrderError").innerHTML+="”кажите способ оплаты<br>";}
	if (submit_state==0){ document.getElementById("OrderError").innerHTML+="¬ведите область проживани€<br>";}
	
	if (submit_email==1 && submit_name==1 && submit_address==1 && submit_phone==1 && submit_delivery==1 && submit_payment==1 && submit_state==1){
		document.all.order_form.submit(); 
	}
}

function save_order() { 
	document.getElementById("OrderError").innerHTML="";
	var address = document.getElementById("address_sent").value;
	var phone = document.getElementById("phone").value;
	var contactPerson = document.getElementById("contactPerson").value;
	
	if(address==""){submit_address=0; } else {submit_address=1; }
	if(phone==""){submit_phone=0; } else {submit_phone=1; }
	if(contactPerson==""){submit_contactPerson=0; } else {submit_contactPerson=1; }
	
	if (submit_address==0){ document.getElementById("OrderError").innerHTML+="”кажите адрес доставки заказа<br>";}
	if (submit_phone==0){ document.getElementById("OrderError").innerHTML+="¬ведите ¬аш номер телефона<br>";}
	if (contactPerson==0){ document.getElementById("OrderError").innerHTML+="”кажите контактное лицо<br>";}
	
	if (submit_contactPerson==1 && submit_address==1 && submit_phone==1){
		document.all.order_form.submit(); 
	}
}

function load_order_list(page) {
	load_content("content.php?&w=show_order_history&page="+page,"busket");
}
function print_bank_order(order){
	if(confirm('–аспечатать счет?')){
		open("print_order.php", "displayWindow1","width=1000,height=700,status=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes");		
	}
}
function show_bank_order(order){
	if (order==""){order=document.getElementById("order_id").value;}
	JsHttpRequest.query('content.php',{ 'w': 'print_order', 'order':order}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("wind2_cont").innerHTML=result["content"];
		win2_open();
		setTimeout("print_bank_order("+order+")",2000);
	}}, true);
}
function checkNom(place){
	var kol=place.value;
	var len = kol.length;
	var reg_simb = /([^0-9\[\]\{\}\s\.])/i;
	if (reg_simb.test(kol)) { kol = kol.substring(0,len-1); place.value=kol; }
}
function checkKol(place){
	checkNom(place);
	var price=document.getElementById("model_price").value;
	var kol=document.getElementById("model_kol").value;
	var summ=0;
	summ=roundNumber(price*kol,2);
	document.getElementById("model_summ").innerHTML=summ;
	document.getElementById("model_kol").value=kol;
}
function setDeliveryTime(inf){
	if (inf!='' && document.getElementById("time_delivery")){
		var op=inf.split(";;");
		document.getElementById("time_delivery").innerHTML=op[1];
	}
}
function showDocOrder(doc_id) {startLoading();
	if (doc_id==''){ alert("¬нутренн€€ ошибка сайта");stopLoading(); }
	if (doc_id!=''){ 
		JsHttpRequest.query('content.php',{ 'w': 'showDocOrder', 'doc_id': doc_id}, 
		function (result, errors){ if (errors) {alert(errors);} if (result){ 
			document.getElementById("InfoFormInfo").innerHTML=result["content"];
			showInfoForm();
			document.getElementById("InfoForm").style.width="800px";
			document.getElementById("InfoForm").style.marginLeft="-400px";
			document.getElementById("InfoForm").style.height="auto";stopLoading();
		}}, true);
	}
}

function showOrderStr(orderId) {
	startLoading();
	if (orderId == '') {
		alert("¬нутренн€€ ошибка сайта");
		stopLoading();
	}
	if (orderId != '') {
		JsHttpRequest.query('content.php', {'w': 'showOrderStr', 'orderId': orderId},
			function (result, errors) {
				if (errors) {
					alert(errors);
				}
				if (result) {
					document.getElementById("InfoFormInfo").innerHTML = result["content"];
					showInfoForm();
					document.getElementById("InfoForm").style.width = "1000px";
					document.getElementById("InfoForm").style.marginLeft = "-500px";
					document.getElementById("InfoForm").style.height = "auto";
					stopLoading();
				}
			}, true);
	}
}
function showOrderComment(orderId) {startLoading();
	if (orderId==''){ alert("¬нутренн€€ ошибка сайта");stopLoading(); }
	if (orderId!=''){ 
		JsHttpRequest.query('content.php',{ 'w': 'showOrderComment', 'orderId': orderId}, 
		function (result, errors){ if (errors) {alert(errors);} if (result){ 
			document.getElementById("InfoFormInfo").innerHTML=result["content"];
			showInfoForm();
			document.getElementById("InfoForm").style.width="auto";
			document.getElementById("InfoForm").style.height="auto";stopLoading();
		}}, true);
	}
}
function saveOrderComment(orderId) {startLoading();
	if (orderId==''){ alert("¬нутренн€€ ошибка сайта");stopLoading(); }
	if (orderId!=''){ 
		var more=document.getElementById("more").value;
		JsHttpRequest.query('content.php',{ 'w': 'saveOrderComment', 'orderId': orderId,'more': more,}, 
		function (result, errors){ if (errors) {alert(errors);} if (result){ 
			if (result["answer"]=="ok"){showOrderStr(orderId);}
			if (result["answer"]!="ok"){alert(result["answer"]);stopLoading();}
			
		}}, true);
	}
}
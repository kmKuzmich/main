function show_catalogue_form(top_id) {
	JsHttpRequest.query('content.php',{ 'w': 'show_catalogue_form', 'top_id': top_id}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		win_open();
		document.getElementById("wind_cont").innerHTML=result["content"];
	}}, true);
}
function select_model(model) {
	JsHttpRequest.query('content.php',{ 'w': 'get_catalogue_caption', 'model': model}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("model").value=model;
		document.getElementById("action_model").innerHTML=result["content"];
		win_close();
	}}, true);
}


function show_items_form(place,top_id) {
	JsHttpRequest.query('content.php',{ 'w': 'show_items_form', 'place': place, 'top_id': top_id}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		win_open();
		document.getElementById("wind_cont").innerHTML=result["content"];
	}}, true);
}
function select_item(place,model) {
	JsHttpRequest.query('content.php',{ 'w': 'get_catalogue_caption_price', 'model': model}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("item"+place).value=model;
		document.getElementById("item"+place+"_model").innerHTML=result["item"];
		document.getElementById("price"+place).value=result["price"];
		win_close();
	}}, true);
}
function delete_item(place,model) {
	document.getElementById("item"+place).value="";
	document.getElementById("item"+place+"_model").innerHTML="";
	document.getElementById("price"+place).value="";
}
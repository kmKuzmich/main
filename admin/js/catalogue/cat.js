function show_price_form(provider) {
	JsHttpRequest.query('content.php',{ 'w': 'showPriceForm', 'provider': provider}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("price_id").innerHTML=result["content"];
		$("#price_id").trigger("liszt:updated");
	}}, true);
}
function show_price_size_form(provider) {
	JsHttpRequest.query('../content.php',{ 'w': 'showPriceForm', 'provider': provider}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("price_id").innerHTML=result["content"];
		$("#price_id").trigger("liszt:updated");
	}}, true);
}
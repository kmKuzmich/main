function clear_opinion_form() {
	document.getElementById("op_name").value='';
	document.getElementById("op_desc").value='';
	document.getElementById("op_pos").value='';
	document.getElementById("op_neg").value='';
}

function save_opinion_form() {
	JsHttpRequest.query('content.php',{ 'w': 'load_model_opinion', 'model': model}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){  document.getElementById("OpinionList").innerHTML=result["content"]; }	}, true);
}

function save_opinion_form() {
	var name = document.getElementById("op_name").value;
	var desc = document.getElementById("op_desc").value;
	var pos = document.getElementById("op_pos").value;
	var neg = document.getElementById("op_neg").value;
	var model = document.getElementById("op_id").value;
	var er=0;
	
	if (name==''){ alert("Не забыли указать свое имя"); er=1; }
	if (desc==''){ alert("Не заполненно поле отзыв"); er=1; }
//	if (pos==''){ alert("Укажите пожалуйста достоинства"); er=1; }
//	if (neg==''){ alert("Укажите пожалуйста недостатки"); er=1; }
	
	if (name!='' && desc!=''){ 
		JsHttpRequest.query('content.php',{ 'w': 'save_model_opinion', 'model': model, 'name': name, 'desc': desc, 'pos': pos, 'neg': neg}, 
		function (result, errors){ 
			if (errors) {alert(errors);} 
			if (result){  var answer=result["answer"];
				if (answer=="ok"){ load_opinion_form(); clear_opinion_form();	}
				if (answer!="ok"){ alert(answer);	}
		} }, true);
	}
}
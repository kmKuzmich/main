function showTaskCalendar(month,year){
	window.location.hash="#taskCalendar="+month+"-"+year;
	startLoading();
	JsHttpRequest.query('content.php',{ 'w': 'showTaskCalendar', 'month': month,'year':year}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("task_content").innerHTML=result["content"];
		stopLoading();
	}}, true);	
}
function showTaskForm(data){
	window.location.hash="#taskData="+data;
	startLoading();
	JsHttpRequest.query('content.php',{ 'w': 'showTaskForm', 'data': data}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("InfoFormInfo").innerHTML=result["content"];
		stopLoading();
		showInfoForm();
		document.getElementById("InfoForm").style.height="500px";
	}}, true);	
}
function newTask(data){
	startLoading();
	JsHttpRequest.query('content.php',{ 'w': 'newTask', 'data': data}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("InfoFormInfo").innerHTML=result["content"];
		stopLoading();
		showInfoForm();
		document.getElementById("InfoForm").style.width="600px";
		document.getElementById("InfoForm").style.marginLeft="-300px";
		document.getElementById("InfoForm").style.height="400px";
		f_tcalInit();
	}}, true);	
}
function saveTaskForm(){
	startLoading();
	var data=document.getElementById("data").value;
	var caption=document.getElementById("taskCaption").value;
	var time_end=document.getElementById("timeendTask").value;
	var data_end=document.getElementById("dataendTask").value;
	var email=document.getElementById("taskEmail").value;
	var desc=document.getElementById("taskDesc").value;
	
	JsHttpRequest.query('content.php',{ 'w': 'addTask', 'data': data, 'caption':caption,'data_end':data_end,'time_end':time_end,'email':email,'desc':desc}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		if (result["Answer"]=="ok"){
			showTaskForm(data);
			showTaskCalendar(document.getElementById("month").value,document.getElementById("year").value);
		}
		if (result["Answer"]!="ok"){showAlertForm(result["Answer"]);}
		stopLoading();
	}}, true);	
}
function checkTime(){
	if (document.getElementById("timeendTask").value.length==2){document.getElementById("timeendTask").value+=":";}
}
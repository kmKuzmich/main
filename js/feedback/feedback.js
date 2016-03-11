var submit_name=0;
var submit_email=0;
var submit_desc=0;

function checkField(fname){
	if (fname.value!="" && fname.id=="name"){ submit_name=1; dis_zs('name');}if (fname.value=="" && fname.id=="name"){ submit_name=0; ac_zs('name');}
	if (fname.value!="" && fname.id=="desc"){ submit_desc=1; dis_zs('desc');}if (fname.value=="" && fname.id=="desc"){ submit_desc=0; ac_zs('desc');}
	if (fname.id=="email"){
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var email = fname.value;
   		if(reg.test(email) == false) { submit_email=0; ac_zs('email'); } else {submit_email=1; dis_zs('email');}
	}
	checkSubmitForm();
}
function checkSubmitForm(){
	if (submit_name==1 && submit_email==1 && submit_desc==1){
		document.getElementById("submit").disabled="";
		return 1;
	}
	if (submit_name!=1 || submit_email!=1 || submit_desc!=1){
		document.getElementById("submit").disabled="disabled";
		return 0;
	}
}

function SubmitForm(){
	f=checkSubmitForm();
	if (f==1){ document.getElementById("SubmitForm").submit();}
	if (f==0){ return; }
}
function dis_zs(name){ document.getElementById("zs_"+name).innerHTML=""; }
function ac_zs(name){ document.getElementById("zs_"+name).innerHTML="*"; }
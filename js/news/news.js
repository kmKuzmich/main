function load_news_list(data){
	window.location.hash="#data="+data;
	startLoading();
	JsHttpRequest.query('content.php',{ 'w': 'load_news_list', 'data': data}, 
	function (result, errors){ if (errors) {alert(errors);} if (result){ 
		document.getElementById("news_content").innerHTML=result["content"];
		stopLoading();
	}}, true);	
}

window.onload = function(){
		g_globalObject = new JsDatePick({
			useMode:1,
			isStripped:true,
			dateFormat:"%Y-%m-%d",
			target:"calendar_form"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			
			imgPath:"img/",
			weekStartDay:1*/
		});		
		
		g_globalObject.setOnSelectedDelegate(function(){
			var obj = g_globalObject.getSelectedDay();
			document.getElementById("news_head_data").innerHTML = " за "+obj.day + "/" + obj.month + "/" + obj.year;
			var year=obj.year.toString();
			var month=obj.month.toString();if (month.length==1){month="0"+month;}
			var day=obj.day.toString();if (day.length==1){day="0"+day;}
			load_news_list(year+"-"+month+"-"+day);
		});
				
};

function loadNewsContent(hash){
	var op=hash.split("=");
	if (op[0]=="#data"){ load_news_list(op[1]); }
}

$(function(){
	$(window).hashchange( function(){
		loadNewsContent(location.hash);
	  })
	$(window).hashchange();
});

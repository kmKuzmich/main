function show_video(video_id,caption,data) {
	JsHttpRequest.query('content.php',{ 'w': 'show_video', 'video_id': video_id }, 
	function (result, errors){ if (result){ document.getElementById("video_file").innerHTML=result["content"]; }}, true);
	document.getElementById("caption").innerHTML=caption;
	document.getElementById("data").innerHTML=data;
}

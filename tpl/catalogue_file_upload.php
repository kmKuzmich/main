<script type="text/javascript" src="/js/plupload/js/browserplus-min.js"></script>
<script type="text/javascript" src="/js/plupload/js/plupload.js"></script>
<script type="text/javascript" src="/js/plupload/js/plupload.gears.js"></script>
<script type="text/javascript" src="/js/plupload/js/plupload.silverlight.js"></script>
<script type="text/javascript" src="/js/plupload/js/plupload.flash.js"></script>
<script type="text/javascript" src="/js/plupload/js/plupload.browserplus.js"></script>
<script type="text/javascript" src="/js/plupload/js/plupload.html4.js"></script>
<script type="text/javascript" src="/js/plupload/js/plupload.html5.js"></script>

<div id="container"><div id="filelist"></div><br /><a id="pickfiles" href="javascript:;">[Выбрать файлы]</a> || <a id="uploadfiles" href="javascript:;">[Загрузить]</a></div>
<script type="text/javascript">
function $(id) { return document.getElementById(id); }
var uploader = new plupload.Uploader({
	runtimes : 'gears,html5,flash,silverlight,browserplus',
	browse_button : 'pickfiles',
	container: 'container',
	max_file_size : '10mb',
	url : '/uploader_items.php?item_id='+<? print $_GET["item_id"]; ?>,
	resize : {width : 650, height : 400, quality : 90},
	flash_swf_url : '/js/plupload/js/plupload.flash.swf',
	silverlight_xap_url : '/js/plupload/js/plupload.silverlight.xap',
	filters : [ {title : "Image files", extensions : "jpg"} ]
});
uploader.bind('Init', function(up, params) {});
uploader.init();
uploader.bind('FilesAdded', function(up, files) {
for (var i in files) {$('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';}
});
uploader.bind('UploadProgress', function(up, file) {$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";});
$('uploadfiles').onclick = function(){	uploader.start();	return false;};
</script>
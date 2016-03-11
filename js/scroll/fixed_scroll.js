function Toggle (state){
	document.body.style.background = state ? 'url(/;-)/n.gif) no-repeat' : 'none';
	document.body.style.backgroundAttachment = state ? 'fixed' : 'scroll';
	if (!state) if (navigator) if (navigator.userAgent) if (navigator.userAgent.indexOf ('MSIE') != -1) document.location.reload();
}
Toggle(true);

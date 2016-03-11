var sLang = $("html").attr("siteLang");

(function()
{
	window.$c = {};
	$(document.documentElement || document.body).attr('class', 'js');
})();

if (/MSIE (5\.5|6).+Win/.test(navigator.userAgent)) {
	try{ document.execCommand("BackgroundImageCache", false, true); } catch(e) {}
}


/**
 * @author John Resig (http://jquery.com/), Vlad Yakovlev (red.scorpix@gmail.com)
 * @version 1.0
 */
$c.browser = (function() {
	var userAgent = window.navigator.userAgent.toLowerCase();

	return {
		version: (userAgent.match( /.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [0,'0'])[1],
		webkit: /webkit/.test(userAgent),
		opera: /opera/.test(userAgent),
		msie: /msie/.test(userAgent) && !/opera/.test(userAgent),
		mozilla: /mozilla/.test(userAgent ) && !/(compatible|webkit)/.test(userAgent),
		safari: /safari/.test(userAgent) && !/chrome/.test(userAgent),
		chrome: /chrome/.test(userAgent)
	};
})();


$c.webkitPlaceholder = function()
{
	if ($c.browser.webkit) return { bind: $.noop };

	$(function() {
		$('input[placeholder]').each(function () {
			bind(this);
		});
	});

	function bind(els, classEmpty) {
		els = $(els);
		classEmpty = ('string' === typeof classEmpty) ? classEmpty : 'empty';

		els.focus(function () {
			if (this.value === $(this).attr('placeholder')) {
				this.value = '';
			}

			$(this).removeClass(classEmpty);
		});

		els.blur(function () {
			if (!this.value.length) {
				this.value = $(this).attr('placeholder');
				$(this).addClass(classEmpty);
			}
		});

		els.each(function() {
			$(this).val().length || $(this).blur();
		});
	}

	return {
		bind: bind
	};
}();

$c.shortcuts = (function()
{
	var navigationLinks = {
		'start': { keyCode: 0x24, ctrlKey: true, altKey: false },
		'prev':  { keyCode: 0x25, ctrlKey: true, altKey: false },
		'up':    { keyCode: 0x26, ctrlKey: true, altKey: false },
		'next':  { keyCode: 0x27, ctrlKey: true, altKey: false },
		'down':  { keyCode: 0x28, ctrlKey: true, altKey: false }
	};

	$(function() {
		$('link').each(function() {

			var rel = $(this).attr('rel');

			if (navigationLinks[rel]) {
				navigationLinks[rel].href = $(this).attr('href');
			}
		});

		$(document).keydown(function(event) {
			var links = navigationLinks;

			for (var rel in links) {
				if (links[rel].keyCode == event.keyCode && links[rel].ctrlKey == event.ctrlKey && links[rel].altKey == event.altKey) {
					if (!$('input:focus, textarea:focus').length) {
						if ('string' == typeof links[rel].href && '' != links[rel].href) {
							document.location = links[rel].href;
						} else if ($.isFunction(links[rel].href)) {
							return links[rel].href(event);
						}
					}
				}
			}
		});
	});

	return {
		bind: function(name, href, keyCode, ctrlKey, altKey) {
			ctrlKey = new Boolean(ctrlKey);
			altKey = new Boolean(altKey);

			navigationLinks[name] = {
				href: href,
				keyCode: keyCode,
				ctrlKey: ctrlKey,
				altKey: altKey
			};
		},

		unbind: function(name) {
			delete navigationLinks[name];
		},

		unbindAll: function() {
			navigationLinks = {};
		}
	};
})();

var MiniPag = $.inherit(
{
	__constructor: function(jContainer,jFtr)
	{
		this.jContainer = jContainer;
		this.jFtr = jFtr;
		this.iTopInitial = (this.jFtr.position()).top;
		
		this.iOffset = this.jFtr.offset().top - this.iTopInitial;
		this.jRoot = $(window);
		
		this.jitterBuffer = 100; 
		this.timeOutId = 0;

		this.jRoot.scroll(function(){
			this.catchScroll();
		}.scope(this));
	},

	catchScroll: function() 
	{
		var self = this; 
		if (self.timeOutId) clearTimeout (self.timeOutId);
		self.timeOutId = setTimeout(function(){self.doScroll();}, self.jitterBuffer);
	},
	
	doScroll: function()
	{
//		jTweener.removeTween(this.jContainer);
		
		var iScroll = this.jRoot.scrollTop();
		this.jFtr.height=iScroll;
		alert(iScroll);
	}
});

if (/Opera/.test (navigator.userAgent))
{
	var randomnumber=Math.floor(Math.random()*1000000);
	var fontstyle = $('<style></style>');
	var style = '@font-face {font-family: \'HeliosLightRegular' + randomnumber + '\'; src: local(\'☺\'), url(\'/f/1/global/css/helioslight-webfont.ttf\') format(\'truetype\');}';
	style += ' .site-menu>ul>li>a, .site-menu>ul>li>b, .site-menu>ul li .shadow{font-family:\'HeliosLightRegular' + randomnumber + '\',Arial,Helvetica,sans-serif !important;}';
	fontstyle.html(style).appendTo('head');
}
;(function($){

	'use strict';

	var wnd = $(window),
	w = 0,
	h = 0,
	wrap = $('.wrap'),
	slides = $('.slide'),
	ssize = $('.slide').size(),
	parallaxContainer = $('.parallax-container'),
	expanded = false,
	currentSection = null,
	extraSpace = 80,
	times = ['seconds', 'minutes', 'hours', 'days'],
	everClick = false,
	calcSize = function()
	{
		w = wnd.width();
		h = wnd.height();
	},
	toMiddle = function(selector, animate)
	{
		var el = $(selector),
		parent = el.parent(),
		elH = el.height(),
		parentH = parent.height(),
		calc = parentH < elH ? 0 : parseInt((parentH - elH) / 2, 10);

		if(animate === true)
			el.animate({'margin-top': calc}, animeTime);
		else
			el.css({ 'margin-top': calc });
	},
	toFit = function(selector)
	{
		var el = $(selector),
		parent = el.parent(),
		parentW = parent.width(),
		parentH = parent.height();

		el.css({
			width: parentW,
			height: parentH
		});
	},
	onResize = function()
	{
		if(!expanded)
		{
			var _w = 0,
			signwrap = $('.signwrap');

			$('.section').css({display: 'none'});

			calcSize();
			_w = parseInt(w / ssize, 10);

			wrap.css({ height: h, width: w });
			slides.each(function(idx, __el){
				$(__el).css({
					height: h,
					width: idx + 1 === slides.size() ? w - (_w * (ssize - 1)) : _w
				});
			});

			signwrap.show();
			toFit(signwrap);
			toMiddle('.sign');

			$.fn.parallax.doResize();
		}else if(currentSection !== null)
		{
			calcSize();

			var ch = currentSection.height(),
			_h = ch + extraSpace < h ? h : ch + extraSpace;

			wrap.css({
				width: w,
				height: _h
			});

			calcSize();

			toFit(currentSection.closest('.slide'));
			toMiddle(currentSection);

			slides.css({
				height: _h
			});

			$.fn.parallax.doResize();
		}
	},
	formState = function(state)
	{
		var els = $('#contact_form input, #contact_form textarea, #contact_form button');

		if(!state)
			els.attr('disabled', 'disabled');
		else
			els.removeAttr('disabled');
	},
	checkEmail = function(em)
	{
		var emailRe = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return emailRe.test(em);
	};

	// init parallax
	parallaxContainer.parallax({
		overflow: 0.09,
		children: '.parallax-item',
		motion: [{x: 0.5, y: 0.5}, {x: 0.6, y: 0.6}]
	});

wrap.show();
toFit('.signwrap');
parallaxContainer.show();

wnd.resize(onResize);
onResize();

if(openAtInit)
{
	setTimeout(function(){
		if(!everClick)
			$('.'.concat(initPanelToOpen, ' .signwrap')).trigger('click');
	}, initTimeout);
}

})(jQuery);
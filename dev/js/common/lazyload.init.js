define(['jquery','lazyload'], function($) {
	console.log('Module lazyload.init loaded.');
	$(function() {
		$('img[data-original]').lazyload({
			effect: 'fadeIn'
		});
	});
});
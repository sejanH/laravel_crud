(function() {

	var items = [].slice.call(document.querySelectorAll('div.grid > div.grid__item'));

	function init() {
		items.forEach(function(item) {
			var word = item.querySelector('.grid__heading'),
				// initialize the plugin
				instance = new Letters(word, {
					size : 85,
					weight : 10,
					color: '#E65454',
					duration: 0.8,
					delay: 0.1,
					individualDelays: 1.2,
					fade: 0,
					easing: d3_ease.easeElasticInOut.ease
				});

			// show word
			instance.showInstantly();


			item.addEventListener('click', function() {
				instance.hide({
					duration: 1.2,
					delay: 0,
					fade: 1,
					easing: d3_ease.easeBounceOut.ease,
					callback: function() {
						instance.show();
					}
				});
			});
			setInterval(function(){
				instance.toggle({
					duration: 2.0,
					delay: 0,
					fade: 1,
					easing: d3_ease.easePolyInOut.ease
				});
			}, 2500);
		});

	}

	init();
})();

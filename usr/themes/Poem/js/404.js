$(document).ready(function(){

	//DIMENSTION
	(function() {
	    function errorInit(){
	       var hero = $('.four-o-four'),
				wh = $(window).height(),
				heroHeight = wh;

			hero.css({
				height: heroHeight+"px",
			});

			var heroContent = $('.four-o-four .container'),
				contentHeight = heroContent.height(),
				parentHeight = hero.height(),
				topMargin = (parentHeight - contentHeight) / 2;

			heroContent.css({
				"margin-top" : topMargin+"px"
			});
	    }

	    $(window).on("resize", errorInit);
	    $(document).on("ready", errorInit);
	})();

});
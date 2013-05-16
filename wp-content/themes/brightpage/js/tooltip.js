$(document).ready(function(){
 
	$(".icon-popup a").hover(function() {
	$(this).next("em").stop(true, true).animate({opacity: "show", top: "-40"}, "slow");
	}, function() {
	$(this).next("em").animate({opacity: "hide", top: "-50"}, "fast");
	});
 
});
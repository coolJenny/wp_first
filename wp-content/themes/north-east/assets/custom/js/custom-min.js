/* 
	***Custom JS*** 
	//This Files Handles Custom Functions of this theme
*/ 
"use strict";jQuery(document).ready(function(o){var e=300,s=1200,d=700,l=o(".cd-top");o(window).scroll(function(){o(this).scrollTop()>e?l.addClass("cd-is-visible"):l.removeClass("cd-is-visible cd-fade-out"),o(this).scrollTop()>s&&l.addClass("cd-fade-out")}),l.on("click",function(e){e.preventDefault(),o("body,html").animate({scrollTop:0},d)})}),jQuery(window).load(function(){if(1==NT_customjs.floatmenu){var o=jQuery("#navmenu"),e=o.offset().top;jQuery(window).scrollTop()>=e?o.parent().addClass("fixed"):o.parent().removeClass("fixed"),jQuery(window).scroll(function(){jQuery(window).scrollTop()>=e?o.parent().addClass("fixed"):o.parent().removeClass("fixed")})}});
;$(function(){
	'use strict';
	var sidebar=$("#sidebar");
	var mask=$(".mask");
	var sidebar_trigger=$("#sidebar_trigger");
	var backButton=$(".back-to-top");
	var more=$(".next_more");
	sidebar_trigger.mousedown(function(){
		mask.fadeIn();
		sidebar.css('right',0);
	})
	sidebar.mouseleave(function(){
		mask.fadeOut();
		sidebar.css('right',-sidebar.width());
	})
	backButton.on('click',function(){
		$('html,body').animate({scrollTop:0},800)
	})
	$(window).on('scroll',function(){
		if ($(window).scrollTop()>$(window).height()) {
			backButton.fadeIn();
		}else{
			backButton.fadeOut();
		}
	})
	more.on('click',function(){
		$('html,body').animate({scrollTop:750},800)
	})	
	$(".main-wrapper nav li").mousedown(function(){
		$(this).css({ "border-bottom": "3px solid #fff" });
	})
	
	function reset_height(){
		var img_section=$(".img-section").height();
		$(".text-section").css("height",img_section);
	}
	reset_height();
	$(window).resize(function(){
		reset_height();
	})
})
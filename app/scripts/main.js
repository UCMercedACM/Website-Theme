$(document).ready(function(){


	// Menu

		// Responsive
			
			$(".menu-toggle").click(function(){

				if($(".menu").css("display") === "block") {
					$(".menu").css("display","none");
				} else {
					$(".menu").css("display","block");
				}
				
			})

			$(window).scroll(function (event) {
			    var scroll = $(window).scrollTop();
			    if(scroll > $(".slider").outerHeight()) {
			    	$("header").css("position","fixed");
			    	$(".slider").css("margin-bottom","100px");
			    } else {
			    	$("header").css("position","relative");
			    	$(".slider").css("margin-bottom","0px");
			    }
			});

			$(window).resize(function(){
				if($(window).width() > 1290) {
					$(".menu").css("display","block");
				} else {
					$(".menu").css("display","none");
				}
			});

		// Smooth Scroll

		$('a[href^="#"]').on('click',function (e) {
		    e.preventDefault();

		    var target = this.hash,
		    $target = $(target);

		    $('html, body').stop().animate({
		        'scrollTop': $target.offset().top - 150
		    }, 900, 'swing', function () {
		        window.location.hash = target;
		    });
		});
})
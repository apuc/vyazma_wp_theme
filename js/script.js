jQuery(document).ready(function($) {
	
	//WOW
	new WOW().init();

	//swiper slider
	if($('.swiper-slide').length>1){
		var swiper = new Swiper('.swiper-container', {
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			loop: true,
			autoplay: {
		        delay: 5000,
		        disableOnInteraction: false,
		    },
		    simulateTouch: true,
		});
	} else {
		$('.swiper-button-next').css('display', 'none');
		$('.swiper-button-prev').css('display', 'none');
	}
	
    //lazyload
    $(window).scroll(function () { 
    	$(".sp_lazyload").lazyload();
    });

    $(window).mousemove(function(){
    	$(".sp_lazyload").lazyload();
   	});

    let search_news_redirect = function (){
		document.location.href = document.location.origin + "/?s="
									+ document.getElementById("search-field").value + "&post_type=news";
	}

	$('.search_button').on('click', search_news_redirect);

    $('.search-field').on('keypress', function (e){
    	if (e.which == 13){
			search_news_redirect();
		}
	}).focusout(search_news_redirect);




});	
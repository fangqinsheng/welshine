$(document).ready(function(){
	$(function(){
		var banner_top = $("#myCarousel").offset().top;
		var counter_top = $("#counter").offset().top;
		var show_top = $("#product").offset().top;
		var recommend_top = $("#hot").offset().top;
		var video_top = $("#video").offset().top;
		var cate_top = $("#cate").offset().top;
		var news_top = $("#news").offset().top;
		var lastItem_top = $("#last-item").offset().top;
		console.log(banner_top);
		
		$(window).scroll(function(){
			var this_scrollTop = $(this).scrollTop();
			if(this_scrollTop>banner_top){ 
				$(".brands h1").css('opacity','1');
				$(".brands h1").css('transform','translate(0)');
				$(".brands hr").css('opacity','1');
				$(".brands hr").css('transform','translate(0)');
				$(".brands .brands-text").css('opacity','1');
				$(".brands .brands-text").css('transform','translate(0)');
				$(".brands .brands-pic").css('opacity','1');
				$(".brands .brands-pic").css('transform','translate(0)');
				$(".counter .counter-col").css('opacity','1');
				$(".counter .counter-icon").css('transform','translate(0)');
				$(".counter #counter-title").css('transform','translate(0)');
				$(".counter #counter-number").css('transform','translate(0)');
			}
			if(this_scrollTop>counter_top){
				$("#recommend h1").css('opacity','1');
				$("#recommend h1").css('transform','translate(0)');
				$("#recommend figure").css('transform','translate(0)');
				$("#recommend").css('opacity','1');
				$("#recommend #two").css('transform','translate(0)');
				$("#hot h1").css('opacity','1');
				$("#hot h1").css('transform','translate(0)');
				$("#hot img").css('opacity','1');
			}
			if(this_scrollTop>recommend_top){
				$("#cate h1").css('opacity','1');
				$("#cate h1").css('transform','translate(0)');
				$("#cate .nav").css('transform','translate(0)');
				$("#cate .filtr-item img").css('opacity','1');
			}
			if(this_scrollTop>lastItem_top){
				$("#news .container").css('opacity','1');
				$("#news .news-title").css('transform','translateX(0)');
				$("#news .news-btn").css('transform','translateX(0)');
				$("#news .news-bottom").css('transform','translateX(0)');
			}	
			if(this_scrollTop>news_top){
				$("#contact").css('opacity','1');
				$("#contact h1").css('transform','translate(0)');
				$("#contact .contact-fs").css('transform','translate(0)');
				$("#contact .email").css('transform','translate(0)');
				$(".public-footer").css('opacity','1');
				$(".public-footer").css('transform','translate(0)');
			}
		})
	})
})

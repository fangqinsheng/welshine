$(document).ready(function(){
//弹出框窗口图片
//function imgShow(alert, alert_big_img, bigimg, _this){  
//  var src = _this.attr("src");//获取当前点击的pimg元素中的src属性  
//  $(bigimg).attr("src", src);//设置#bigimg元素的src属性  
//}  
function wrong(){
	alert("抱歉，此功能正在开发中！");
}

//悬浮窗口
	$('#product ul li').click(function(){
		if($('#alert').css('display')=='none'){
			$("#alert").css('display','block');
		}else{
			$("#alert").css('display','block');
		}
	});
	
//关闭按钮
	$('#close-btn').click(function(){
		if($('#alert').css('display')=='block'){
			$('#alert').css('display','none')
		}else{
			$('#alert').css('display','block')
		}
	});

//返回顶部按钮
	$(".float-top").click(function() {
		$("html,body").animate({
			'scrollTop': '0px'
		},{
			duration:800,
			easing:"swing"
		});
		return false;
	});
		
//图片渐隐

	$(".product ul li .img-bg").hide();
	$(".product ul li .big-btn").hide();
	$(".product ul li").hover(function(){
		$(this).find(".img-bg").stop().fadeTo(500,0.9);
		$(this).find(".big-btn").stop().fadeTo(500,0.9);
	},function(){
		$(this).find(".img-bg").stop().fadeTo(500,0);
		$(this).find(".big-btn").stop().fadeTo(500,0);
	});
	
//new recommend
	$('#hot .row .img-mask').hide();
	$('#hot .row .col-sm-3').hover(function(){
		$(this).find(".img-mask").show();
	},function(){
		$(this).find(".img-mask").hide();
	})
	
//cate加载
	var hCatecontent = $('.cate-box').outerHeight() + 'px';
    console.log(hCatecontent);
	$('.icon-shizi').click(function(){
		if($('.cate-content').css('height')=='560px'){
			$('.cate-content').css('height',hCatecontent)
		}else{
			$('.cate-content').css('height','560px')
		}
	});
	
//video
	$('#video .video-btn').click(function(){
		if($('#video-source').css('display')=='none'){
			$('.video-controls').hide();
			$('#video-source').show();
		}else{
			$('.video-controls').show();
			$('#video-source').hide();
		}
	})


//新闻点击翻页
//	var hNewscontent = $('.cate-box').outerHeight() + 'px';
	$('.news-header .news-btn li .prev-btn').click(function(){
		$('.news-header .news-btn li a').css('background-position-y','-25px');
		$('.news-bottom .content-box').css('top','-340px');
	})
	$('.news-header .news-btn li .next-btn').click(function(){
		$('.news-header .news-btn li a').css('background-position-y','0');
		$('.news-bottom .content-box').css('top','0px');
	});	
	
//details.html
	$('.info-box li').click(function(){
        $('.info-header li').removeClass('info-active');
//      $('.info-content .info-col').removeClass('info-content-active');
        $(this).addClass('info-active');
	});
	$('.first').click(function(){
        $('.info-content .info-col').removeClass('info-content-active');
        $('.info-content .info-col1').addClass('info-content-active');
	});
	$('.second').click(function(){
        $('.info-content .info-col').removeClass('info-content-active');
        $('.info-content .info-col2').addClass('info-content-active');
	});
	$('.three').click(function(){
        $('.info-content .info-col').removeClass('info-content-active');
        $('.info-content .info-col3').addClass('info-content-active');
	});
})



		


		
	
	
	
	

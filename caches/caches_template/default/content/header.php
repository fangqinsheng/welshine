<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>css/pgwslideshow.css">
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>css/welshine.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>css/iconfont.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>css/slider.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>css/style.css"> <!-- Resource style -->
<script src="http://www.jq22.com/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo JS_PATH;?>js/modernizr.js"></script> <!-- Modernizr -->
<script src="<?php echo JS_PATH;?>js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo JS_PATH;?>js/common.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo JS_PATH;?>js/increase.js" type="text/javascript" charset="utf-8"></script>  <!-- 数字递增 -->
<script src="<?php echo JS_PATH;?>js/jquery.smint.js" type="text/javascript" charset="utf-8"></script>  <!-- 粘性导航 -->
<script src="<?php echo JS_PATH;?>js/scroll.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo JS_PATH;?>js/iconfont.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(document).ready( function() {
	    $('.menu').smint({
	    	'scrollSpeed' : 1000
	    });
	});
</script>
</head>
<body> 
	
<!-- 主页背景 -->
	<div class="index-bg"></div>
<!-- 主页背景 -->	
	
	<div class="cd-quick-view">
		<div class="cd-slider-wrapper">
			<ul class="cd-slider">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b11cd7a11b959515236049738d6c7cc1&action=lists&catid=15&num=6&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'15','order'=>'listorder ASC','limit'=>'6',));}?>
			  	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class="<?php echo $r['mes'];?>"><img src="<?php echo $r['thumb'];?>" alt="Product 1"></li>
				<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
			</ul> 
			
			<!--<ul class="cd-slider-navigation">
				<li><a class="carousel-control left" href="#full" data-slide="prev">&lsaquo;</a></li>
				<li><a class="carousel-control right" href="#full" data-slide="next">&rsaquo;</a></li>
			</ul> -->
			
		</div> 
		<div class="cd-item-info">
			<h2>Produt Title</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, omnis illo iste ratione. Numquam eveniet quo, ullam itaque expedita impedit. Eveniet, asperiores amet iste repellendus similique reiciendis, maxime laborum praesentium.</p>
			<ul class="cd-item-action">
				<li><button class="add-to-cart">Add to cart</button></li>					
				<li><a href="#0">Learn more</a></li>	
			</ul> <!-- cd-item-action -->
		</div> <!-- cd-item-info -->
		<a href="#0" class="cd-close">Close</a>
	</div>
	
	<script src="<?php echo JS_PATH;?>js/velocity.min.js"></script>
	<script src="<?php echo JS_PATH;?>js/main.js"></script>  
<!--//右侧悬浮窗口-->

	<div class="float-box clearfix">
		<ul class="float-menu">
	    <li class="float-QQ">
    		<i class="iconfont">&#xe68e;</i>
    		<div class="QQ-hover">
					<ul>
						<li class="QQ-service">
							<h3>惠而信营销总部</h3>
						</li>
						<li class="QQ-service">
							<strong>在线咨询</strong>
	    				<ul class="service-content">
	    					<li class="group">
	    						<span class="group-name">售后客服:</span>
	    						<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1105813323&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1105813323:51" alt="点击联系我" title="点击联系我"/></a>
	    					</li>
	    					<li class="group">
	    						<span class="group-name">售前客服:</span>
	    						<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1105813323&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1105813323:51" alt="点击联系我" title="点击联系我"/></a>
	    					</li>
	    				</ul>
						</li>
	    			<li class="QQ-service">
	    				<strong>工作时间</strong>
	    				<ul>
	    					<li><span class="group-name">周一至周六</span>:<span>09:00-18:00</span></li>
	    				</ul>
	    			</li>
	    			<li class="QQ-service">
	    				<strong>联系方式</strong>
	    				<ul>
	    					<li><span>电话联系：400-838-8198</span></li>
	    					<li><span>传真：020-89577250</span></li>
	    				</ul>
	    			</li>
					</ul>
					<div class="triangle-right" style="top: 8%;"></div>
    		</div>
	    </li>
	    <li class="float-code" style="height:53px;">
   			<i class="iconfont">&#xe608;</i>
   			<div class="code-hover hd_qr">
					<img src="<?php echo IMG_PATH;?>img/index/code.png" width="50px" alt="关注你附近">
	    		<h2>微信二维码</h2>
	    		<div class="triangle-right" style="top: 36%;"></div>
	    	</div>
	    </li>
	    <li class="float-top">
   			<i class="iconfont">&#xe63a;</i>
	   	</li>
		</ul>
	</div> 
	
<!-- bar -->

	<div class="bar sTop">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<li class="col-md-2"><a href="">微信公众号</a></li>
					<li class="col-md-3" style="margin-left: -1.25em;"><a href="">京东/阿里巴巴商城</a></li>
				</div>
				<div class="col-md-3 col-md-offset-1">
					<li class="col-md-6"><a href="http://localhost/welshine/">中文</a>/<a href="http://localhost/welshine/en/">English</a></li>
					<li class="col-md-6">请<a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=login" class="orange">登录</a>/<a class="orange" href="index.php?m=member&c=index&a=register&siteid=1">注册</a></li>
				</div>
			</div>
		</div>
	</div>

<!-- 品牌LOGO -->

	<nav class="navbar navbar-default logo">
	  	<div class="container">
	    	<div class="row"> 
	    		<div class="navbar-brand">
	    			<a href="#">
		        		<img src="<?php echo IMG_PATH;?>img/index/logo.png" alt="Brand" height="100%"/>
		      		</a>
	    		</div>
	      		<div class="navbar-text">
					<span class="navbar-title">信诚待客，共同发展</span><br>
					<span class="navbar-eng">Sincere hospitality, common development</span>
				</div>
				<div class="navbar-tel">
					<i class="iconfont icon-dianhua"></i>
					<div class="right-text">
						<span>服务热线:</span>
						<p>400-838-8198</p>
					</div>
				</div>
				<div class="navbar-icon" >
					<i class="icon-caidanlanmuicon iconfont"></i>
				</div> 
	    	</div>
	  </div>
	</nav>

<!-- 粘性菜单 -->

	<div class="menu">
		<div class="container clearfix">
			<div class="row">
				<div class="subMenu col-md-8 clearfix">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d57e36a9d64428417083b39ad72c2cee&action=category&catid=2&num=6&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'2','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'6',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				 	<a href="<?php echo $r['url'];?>" class="subNavBtn col-sm-2" style="transition-delay: 0.2s;"><?php echo $r['catname'];?></a>
				 	<?php $n++;}unset($n); ?>
        		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class="search-box col-md-4">
					<form action="<?php echo APP_PATH;?>index.php" method="get" target="_blank">
						<input type="hidden" name="m" value="search"/>
					    <input type="hidden" name="c" value="index"/>
					    <input type="hidden" name="a" value="init"/>
					    <input type="hidden" name="typeid" value="<?php echo $typeid;?>" id="typeid"/>
					    <input type="hidden" name="siteid" value="<?php echo $siteid;?>" id="siteid"/>
					    <input type="submit" value="搜 索" class="button" /><input type="text" class="text" name="q" id="q"/>
						<!--<input type="submit" name="keywords" id="keywords" value="<?php echo $keywords;?>" class="col-md-3"/>
						<input type="text" name="" id="" value="" class="col-md-8" placeholder="输入想要的产品" onfocus="this.placeholder=''" onblur="this.placeholder='输入想要的产品'"/>-->
					</form>
				</div>
			</div>
		</div>
	</div>
		
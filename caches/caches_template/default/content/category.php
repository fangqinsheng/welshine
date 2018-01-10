<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<!-- 热搜关键词 -->
	<div id="myCarousel" class="carousel slide">
		<ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    <li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>   
		<div class="carousel-inner">
		    <div class="item active">
		        <a><img src="<?php echo IMG_PATH;?>img/index/slider1.jpg" width="100%" alt="First slide"></a>
		    </div>
		    <div class="item">
		        <a><img src="<?php echo IMG_PATH;?>img/index/slider2.jpg" width="100%" alt="Second slide"></a>
		    </div>
		    <div class="item">
		        <a><img src="<?php echo IMG_PATH;?>img/index/slider3.jpg" width="100%" alt="Third slide"></a>
		    </div>
		    <div class="item">
		        <a><img src="<?php echo IMG_PATH;?>img/index/slider4.jpg" width="100%" alt="fourth slide"></a>
		    </div>
		</div>
		<div class="arrow">
	    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>  
	</div>
	
	<div class="search">
		<div class="container">
			<div class="search-content clearfloat">
				<ul class="search-keys clearfloat" style="">
					<li>热搜关键词：</li>
					<li><a href="#">托盘</a></li>
					<li><a href="#">保鲜盒</a></li>
					<li><a href="#">服务车</a></li>
					<li><a href="#">整理箱</a></li>
					<li><a href="#">筛</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="product-box">
		<div class="container clearfloat">
			<div class="row">
				<div class="left-part col-xs-3" style="padding: 0;width: 24%;">
					<div class="left-list">
						<h1 class="iconfont icon-weibiaoti35">产品分类</h1>
						<ul class="product-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cc5fa73a6bfb353b424749d0b544d710&action=category&catid=6&num=99&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'6','order'=>'listorder ASC','limit'=>'99',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li>
								<div class="list-item">
									<h1 class="<?php echo $r['catdir'];?>">
										<span class="iconfont icon-jiantou-copy fr"style="padding: 0 1rem;"></span>
										<a href="<?php echo $r['url'];?>" class=""><?php echo $r['catname'];?></a>
									</h1>
									<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7a050dd6ddaae46569b7acaf8c4fcb4d&action=category&catid=%24r%5Bcatid%5D&num=3&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$r[catid],'order'=>'listorder ASC','limit'=>'3',));}?>
									<div class="item-subtitle">
										<p>
											<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
											<a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>
											<?php $n++;}unset($n); ?>
										</p>
									</div>
									<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
								</div>
								<!--<div class="item-hover">
									<div class="hover-box">
										<div class="fl left-text">
											<h2><?php echo $r['catname'];?></h2>
											<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3e743fd3856c336d8d1cd580b5e57798&action=category&catid=%24r%5Bcatid%5D&num=66&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$r[catid],'order'=>'listorder ASC','limit'=>'66',));}?>
											<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
											<div class="description">sad sad sad asd asd </div><hr />
											<ul>
												<li><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></li>
											</ul>
											<?php $n++;}unset($n); ?>
											<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
										</div>
										<div class="fr right-pic"></div>
									</div>
								</div>-->
							</li>
							<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
				<div class="right-part col-xs-9" >
					<div class="show-head clearfloat">
						<div class="l-tittle fl">
							<font>+</font>
							<span>所有产品</span>
						</div>
						<div class="r-tittle fr">
							<a href="index.html">首页</a><span style="color: #333;">></span><a href="<?php echo $CATEGORYS[$catid]['url'];?>"><?php echo catpos($catid);?></a>
						</div>
					</div>
					<div class="list-show clearfloat">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5a3627dea15facf6ec922b8e2cb24b0c&action=category&catid=%24catid&num=9&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$catid,'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'9',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="show-item col-md-4 col-sm-6">
							<a href="<?php echo $r['url'];?>">
								<div class="show-box">
									<div class="hover">
										<h2><?php echo $r['catname'];?></h2>
									</div>
									<img src="<?php echo $r['image'];?>" alt="">
								</div>
							</a>
						</div>
						<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div id="pages"style="text-align: center;"><?php echo $pages;?></div>
					<!--<div class="page-list">
						总共5页/当前是第1页<a href="#" class="p-active">首页</a><a href="#" class="p-active">上一页</a><a href="#">1</a><a href="#">2</a>
					<a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">下一页</a><a href="#">尾页</a>
					</div>-->
				</div>	
			</div>
		</div>
	</div>
<?php include template("content","footer"); ?>

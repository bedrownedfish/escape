<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>Document</title>
	<link rel="stylesheet" href="<?=base_url('public/')?>css/swiper.min.css">
	<link rel="stylesheet" href="<?=base_url('public/')?>css/common.css">
	<script src="<?=base_url('public/')?>js/jquery.js"></script>
	<script src="<?=base_url('public/')?>js/swiper.min.js"></script>
</head>
<body>
	<div class="section_y">
		<p class="p1">
			<img src="<?=base_url('public/')?>images/logo.png" alt="">
		</p>
	</div>
	<div class="kong1"></div>
	<div class="c1_section1">
		<div class="ppp">
			<div class="swiper-container" id="mm">
			    <div class="swiper-wrapper">
			        <div class="swiper-slide"><a href="javascript:;"><img src="<?=base_url('public/')?>images/image_banner_01.png"/></a></div>
			        <div class="swiper-slide"><a href="javascript:;"><img src="<?=base_url('public/')?>images/image_banner_02.png"/></a></div>
			    </div>
			    <div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
	<div class="c1_section2">
		<div class="a1_1">
			<div class="a1">
				<p class="p1">我们的服务</p>
				<p class="p2"><span></span></p>
			</div>
			<div class="a2 clearfix">
				<ul>
					<li>
						<a href="">
							<img src="<?=base_url('public/')?>images/service_video.png" alt="">
							<p class="p1 select">AI视频转码</p>
						</a>
					</li>
					<li>
						<a href="">
							<img src="<?=base_url('public/')?>images/service_consult.png" alt="">
							<p class="p1">AI战略咨询</p>
						</a>
					</li>
					<li>
						<a href="">
							<img src="<?=base_url('public/')?>images/service_solution.png" alt="">
							<p class="p1">AI解决方案</p>
						</a>
					</li>
					<li>
						<a href="">
							<img src="<?=base_url('public/')?>images/service_development.png" alt="">
							<p class="p1">AI平台开发</p>
						</a>
					</li>
					

				</ul>
			</div>
		</div>
	</div>
	<div class="c1_section3">
		<div class="container">
			<div class="a1">
				<p class="p1">我们的AI领域</p>
				<p class="p2"><span></span></p>
			</div>
			<div class="a2 clearfix" onclick="javascript:window.location.href='<?=base_url('escape/upload')?>'" >
				<ul>
					<li>
						<div>
							<a href="javascript:void(0);">
								<img src="<?=base_url('public/')?>images/area_image_01_03.png" alt="">
								<div class="ao">
									<p class="p1">视频转码领域</p>
								</div>
							</a>
						</div>
					</li>
					<li>
						<div>
							<a href="javascript:void(0);">
								<img src="<?=base_url('public/')?>images/area_image_02_03.png" alt="">
								<div class="ao">
									<p class="p1">金融领域</p>
								</div>
							</a>
						</div>
					</li>
					<li>
						<div>
							<a href="javascript:void(0);">
								<img src="<?=base_url('public/')?>images/area_image_03_03.png" alt="">
								<div class="ao">
									<p class="p1">制造领域</p>
								</div>
							</a>
						</div>
					</li>
					<li>
						<div>
							<a href="javascript:void(0);">
								<img src="<?=base_url('public/')?>images/area_image_04_03.png" alt="">
								<div class="ao">
									<p class="p1">大数据领域</p>
								</div>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="a1 clearfix">
			<ul>
				<li>
					<a href="<?=base_url('escape/content')?>">
						<img src="<?=base_url('public/')?>images/icon_about_us.png" alt=""><span>关于我们</span>
					</a>
				</li>
				<li>
					<a href="<?=base_url('escape/contents')?>">
						<img src="<?=base_url('public/')?>images/icon_contact_us.png" alt=""><span>联系我们</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="a2">
			<p class="p1"><?=$sysemname?></p>
			<p class="p2"><span></span></p>
			<p class="p3">手机：<?=$defaultnick?></p>
			<p class="p3">电话：<?=$edition?></p>
			<p class="p4">地址：<?=$asrega?></p>
		</div>
	</div>
	
</body>
<script>
    var swiper = new Swiper('#mm', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
        delay: 2000,
        disableOnInteraction: false,
        },
        pagination: {
        el: '.swiper-pagination',
        clickable: true,
        },
    });
</script>
</html>
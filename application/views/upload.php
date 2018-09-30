<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>Document</title>
	<link rel="stylesheet" href="<?=base_url('public/')?>css/swiper.min.css">
	<link rel="stylesheet" href="<?=base_url('public/')?>css/common.css">
	<link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
	<script src="<?=base_url('public/')?>js/mui.min.js"></script>
	<script src="<?=base_url('public/')?>js/jquery.js"></script>
	<script src="<?=base_url('public/')?>js/swiper.min.js"></script>
	<?php $this->load->view('module/loading')?>
</head>
<body>
	<div class="section_x">
		<p class="p1">
			AI视频转码
		</p>
		<a href="<?=base_url()?>" class="a1"><img src="<?=base_url('public/')?>images/zzzz.png"></a>
	</div>
	<div class="kong1"></div>
	<div class="c2_section1">
		<div class="container clearfix">
			<div class="a1">
				<div class="sh">
					<form action="" id="form">
						<div class="a1_1 clearfix">
							<input type="file" id="upLoad" style="display: none;" class="in1">
							<input type="submit" style="display: none;">
							<p class="p1">现有视频地址</p> <span class="s1 shang_btn1">上传</span>
						</div>
					</form>
					<form action="">
						<div class="a1_1 a1_1s clearfix">
							<input type="submit" style="display: none;">
							<input type="file" style="display: none;" class="in2">
							<p class="p1"><progress value="10" max="100" class="pro2"></progress></p> <span id="escape" class="s1 shang_btn2">转码</span>
						</div>
					</form>
					<form action="">
						<div class="a1_1 a1_1s clearfix">
							<p class="p1" id="site"></p> <span class="s1" id="uploads">下载</span>
						</div>
					</form>
				</div>

			</div>
			<div class="a2">
				<div class="a2_1">
					<progress value="10" max="100" class="pro1"></progress>
				</div>
				<div class="a2_2">
					<img src="<?=base_url('public/')?>images/dui.png" alt="" class="dd1">
				</div>
			</div>
		</div>
	</div>
	<div class="ge"></div>
	<div class="c2_section2">
		<div class="container">
			<p class="p1">操作说明:</p>
			<p class="p2">1.粘贴现有地址，点击“上传”视频</p>
			<p class="p2">2.上传视频完成，点击“转码”完成视频转码</p>
			<p class="p2">3.视频转码完成，点击“下载”按钮，即可下载转码视频</p>
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
<script>
	$(function(){
		mui.init();
		$(".shang_btn1").click(function(){
			$(".in1").click();
		});
		var $input =  $("#upLoad");
                // ①为input设定change事件
		$input.change(function () {
			$(".pro1").val(10);
			fileLoad(this);
		})
		$('#uploads').click(function(event) {
			var src = $('#site').data('src');
			if(!src){
				mui.toast('没有进行转码');
				return false;
			}
			window.location.href=src;
		});
		$('#escape').click(function(event) {
			$(".pro2").val(10);
			var id = $(this).data('id');
			if(!id){
				mui.toast('请先上传视频文件再转码！');
				return false;
			}
			$.ajax({
				type:'post',
				url:'<?=base_url('escape/escapes')?>',
				data:{id:id},
				cache:false,
				dataType:'JSON',
				success:function(data){
					console.log(data)
					mui.hideLoading();
					var pro2 = $(".pro2").val();
					var tt = setInterval(function(){
						pro2+=5;
						if (pro2>=101) {
							clearInterval(tt);
							$(".pro2").val(pro2);
							$(".dd1").show();
							return;
						}
						$(".pro2").val(pro2);
					},200)
					setTimeout(function(){
						if(data.types == 1){$('#site').html(data.codename);$('#site').data('src',data.code)};
						mui.toast(data.message);
					},2000);
				},
			    error:function(e){
			       	console.log(e);
			       	mui.hideLoading();
			    },
			    beforeSend:function(e){
			       	mui.showLoading("正在转码视频资料···","div");
			    }
			});
		});
	})
	function checkTV(str){
		var strRegex = "(.AVI|.WMV|.RM|.RMVB|.MPEG1|.MP4|.3GP|.ASF|.SWF|.VOB|.DAT|.MOV|.M4V|.FLV|.F4V|.MKV|.MTS|.TS)$"; //用于验证图片扩展名的正则表达式
		var re=new RegExp(strRegex);
		if (re.test(str.toUpperCase())){
			return true;
		} else{
			mui.toast('视频格式错误');
			return false;
		}
	}
	function fileLoad(ele){
		//④创建一个formData对象
		
		var formDatas = new FormData();
		//⑤获取传入元素的val
		var name = $(ele).val();
		var a = checkTV(name.split('\\').pop());
		if(!a)return false;
		 //⑥获取files
		var files = $(ele)[0].files[0];
		
		//⑦将name 和 files 添加到formData中，键值对形式
		formDatas.append("file", files);
		formDatas.append("name", name);
		$.ajax({
			url: "<?=base_url('escape/uploads')?>",
			type: 'POST',
			data: formDatas,
			dataType:'JSON',
			processData: false,// ⑧告诉jQuery不要去处理发送的数据
			contentType: false, // ⑨告诉jQuery不要去设置Content-Type请求头
			beforeSend: function () {
				mui.showLoading("正在解析视频资料···","div");
				
			},
			success: function (data) {
				mui.hideLoading();
				var pro1 = $(".pro1").val();
				var dd = setInterval(function(){
					pro1+=5;
					if (pro1>=101) {
						clearInterval(dd);
						return;
						$(".pro1").val(pro1);
					}
					$(".pro1").val(pro1);
					
				},50)
				setTimeout(function(){
					mui.toast(data.message);
					if(data.type){$('#escape').data('id',data.ids);};
				},500);
			},
			error : function (responseStr) {
				mui.hideLoading();
				//12出错后的动作
			}
		});
	}
</script>
</html>
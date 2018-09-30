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
			联系我们
		</p>
		<a href="<?=base_url()?>" class="a1"><img src="<?=base_url('public/')?>images/zzzz.png"></a>
	</div>
	<div class="kong1"></div>
	<div class="c2_section1">
		<?=$contents?>
	</div>
	<div class="ge"></div>	
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
			fileLoad(this);
		})
		$('#escape').click(function(event) {
			var id = $(this).data('id');
			console.log(id)
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
						if(data.types == 1){$('#site').attr('src',data.message)};
						mui.toast(data.message);
					},200)					
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
		console.log(files)
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
					mui.toast(data.message);
					if(data.type){$('#escape').data('id',data.ids);};
				},50)
			},
			error : function (responseStr) {
				mui.hideLoading();
				//12出错后的动作
			}
		});
	}
</script>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>添加信息</title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/bootstrap/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>css/personal.css" media="all">
</head>
<body class="childrenBody">

	<form class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">公司名称</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" name="sysemname" value="<?=$codes['sysemname']?>" placeholder="请输入文章标题" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
		      	<label class="layui-form-label">修改时间</label>
		      	<div class="layui-input-inline">
		        	<input type="text" class="layui-input" value="<?=date('Y-m-d H:i:s')?>" name="addtime" id="date1" placeholder="选择修改时间">
		    	</div>
		    </div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
			<label class="layui-form-label">联系电话</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" name="defaultnick" value="<?=$codes['defaultnick']?>" placeholder="请输入默认昵称" type="text">
			</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
			<label class="layui-form-label">联系手机</label>
			<div class="layui-input-block">
				<input class="layui-input"  name="edition" value="<?=$codes['edition']?>" placeholder="联系手机" type="text">
			</div>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">公司地址</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" name="asrega" value="<?=$codes['asrega']?>" placeholder="请输入地址" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">返回</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui2.4/layui.js"></script>
	<script type="text/javascript">
		var newsImagInset = '<?=base_url('news/newsImagInset')?>',
			layditImgUrl = '<?=base_url('news/layditImg')?>',
			url = "<?=base_url()?>",
			setConfig = "<?=base_url('manage/setConfig')?>";
		layui.config({
			base : "js/"
		}).use(['form','layer','jquery','layedit','laydate','upload'],function(){
			var form = layui.form,
				layer = parent.layer === undefined ? layui.layer : parent.layer,
				laypage = layui.laypage,
				layedit = layui.layedit,
				upload = layui.upload,
				laydate = layui.laydate,
				$ = layui.jquery;
			
			//创建一个编辑器
			laydate.render({
			    elem: '#date1'
			    ,type: 'datetime'
			});
			layedit.set({
		        uploadImage: {
		            url: layditImgUrl, //接口url
		        	type: 'post' //默认post
				}
			});
		 	var editIndex = layedit.build('news_content');
		 	var addNewsArray = [],addNews;
		 	form.on("submit(addNews)",function(data){
		 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
 				codes = data.field;
 				$.ajax({
					type:'post',
					url: setConfig,
					data:codes,
					cache:false,
					dataType:'JSON',
					success:function(data){
						layer.msg(data.message);
					},
				    error:function(e){
				    	layer.close(index);
				    },
				    beforeSend:function(e){
				    }
				});
		        return false;
		 	})
			
		})
	</script>
</body>
</html>
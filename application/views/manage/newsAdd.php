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
			<label class="layui-form-label">关于我们</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="news_content"><?=$code['content']?></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">联系我们</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="news_content1"><?=$code['contents']?></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui2.4/layui.js"></script>
<script type="text/javascript">
		var newsImagInset = '<?=base_url('news/newsImagInset')?>',
			layditImgUrl = '<?=base_url('manage/layditImg')?>',
			url = "<?=base_url()?>"
			newsInset = '<?=base_url("manage/newsInset")?>';
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
	layedit.set({
        uploadImage: {
            url: layditImgUrl, //接口url
        	type: 'post' //默认post
		}
	});
	//创建一个编辑器
 	var editIndex = layedit.build('news_content');
 	var editIndex1 = layedit.build('news_content1');
 	var addNewsArray = [],addNews;
 	laydate.render({
	    elem: '#date1'
	    ,type: 'datetime'
	});
 	form.on("submit(addNews)",function(data){
 		
 		//弹出loading
 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8}),
 		codes = data.field;
 		codes.content = layedit.getContent(editIndex);
		codes.contents = layedit.getContent(editIndex1);
 		if(codes.content=="" || codes.contents==""){
 			layer.msg('请编辑文章内容！');
 			return false;
 		}
			$.ajax({
				type:'post',
				url: newsInset,
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
			    	layer.close(index);
			    }
			});
 		return false;
 	})

	
})

</script>

</body>
</html>
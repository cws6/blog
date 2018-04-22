<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo C('site.name');?></title>
	<link href="/thinkphp/blog/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/thinkphp/blog/public/admin/css/admin.css">
	<!--[if lt IE 9]>
	<script src="/thinkphp/blog/public/vendor/compatible/html5shiv.min.js"></script>
	<script src="/thinkphp/blog/public/vendor/compatible/respond.js"></script>
	<![endif]-->
	<script src="/thinkphp/blog/public/vendor/jquery.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand hidden-sm" href="<?php echo U('index.php/admin/index/index');?>">后台首页</a>
		</div>
		<div class="navbar-collapse collapse" role="navigation">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo U('index.php/admin/article/index');?>">文章管理</a></li>
				<li><a href="<?php echo U('index.php/admin/category/index');?>">分类管理</a></li>
				<li><a href="<?php echo U('index.php/admin/comment/index');?>">评论管理</a></li>
				<li><a href="<?php echo U('index.php/admin/link/index');?>">友情链接</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right hidden-sm">
				<li><a href="<?php echo U('index.php/admin/index/profile');?>">个人中心</a></li>
				<li><a href="<?php echo U('index.php/admin/index/logout');?>">退出登录</a></li>
			</ul>
		</div>
	</div>
</div>
<link rel="stylesheet" href="/thinkphp/blog/public/vendor/umeditor/themes/default/css/umeditor.min.css">
<div class="container">
	<?php if(empty($data)): ?><h1>发表文章</h1>
		<?php else: ?>
		<h1>编辑文章</h1><?php endif; ?>
	<form action="/thinkphp/blog/index.php/admin/article/add" method="post" class="form-horizontal" id="form">
		<input type="hidden" name="image" value="<?php echo ($data["image"]); ?>" id="image">
		<input type="hidden" name="content" value="<?php echo ($data["content"]); ?>" id="content">
		<div class="form-group">
			<label for="title" class="control-label col-md-2">文章标题</label>
			<div class="col-md-6">
				<input type="text" name="title" id="title" class="form-control" value="<?php echo ($data["title"]); ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="description" class="control-label col-md-2">文章简介</label>
			<div class="col-md-6">
				<textarea name="description" id="description" rows="6" class="form-control" maxlength="100" placeholder="不填则系统提取正文部分内容"><?php echo ($data["description"]); ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="image" class="col-md-2 control-label">封面图片</label>
			<div class="col-md-6">
				<style>
	.uploader {
		position: relative;
	}
	.uploader a {
	}
	.uploader input {
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		z-index: 10;
		opacity: 0;
	}
</style>
<div class="uploader">
	<a href="javascript:;" class="btn btn-success btn-block" id="status">点击上传</a>
	<input type="file" id="file" name="file" accept="image/*">
</div>
<script>
	$('#file').on('change', function(e) {
		if (e.target.files.length > 0) {
			var file = e.target.files[0];
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '<?php echo U("index.php/admin/index/upload");?>', true);
			var fd = new FormData;
			fd.append("file", file);
			xhr.onload = function(e) {
				var data = JSON.parse(xhr.responseText);
				$('.uploader #status').text('点击上传');
				if (data.error) {
					alert(data.error);
					return;
				}
				uploadCallback && uploadCallback(data.url);
			};
			xhr.upload && (xhr.upload.onprogress = function(e) {
				if (e.lengthComputable) {
					$('.uploader #status').text('上传中(' + parseInt((e.loaded / e.total) * 100) + ')%');
				}
			});
			xhr.send(fd);
		}
	});
</script>
				<div class="help-block">
					<img id="thumb" src="<?php echo ($data["image"]); ?>" width="100" class="img-responsive" alt="">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="categoryId" class="control-label col-md-2">分类</label>
			<div class="col-md-4">
				<select class="form-control" name="categoryId" id="categoryId">
					<?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["categoryId"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-2">
				<script type="text/plain" id="editor" class="form-control" style="height:400px"></script>
			</div>
		</div>

		<div class="form-group">
			<label for="sort" class="control-label col-md-2">排序</label>
			<div class="col-md-6">
				<input type="number" name="sort" id="sort" class="form-control" value="<?php echo ((isset($data["sort"]) && ($data["sort"] !== ""))?($data["sort"]):0); ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">状态</label>
			<div class="col-md-6">
				<label>
					<input type="radio" name="status" value="1"
					<?php if(($data["status"]) == "1"): ?>checked<?php endif; ?>
					>
					发布
				</label>
				<label>
					<input type="radio" name="status" value="0"
					<?php if(($data["status"]) == "0"): ?>checked<?php endif; ?>
					>
					不发布
				</label>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-2 col-md-offset-2">
				<button class="btn btn-primary btn-block">提交</button>
			</div>
		</div>
	</form>
</div>
<script src="/thinkphp/blog/public/vendor/umeditor/umeditor.config.js"></script>
<script src="/thinkphp/blog/public/vendor/umeditor/umeditor.min.js"></script>
<script>
	var um = UM.getEditor('editor');
</script>
<?php if(empty($data["content"])): else: ?>
	<script>
		setTimeout(function() {
			um.setContent('<?php echo (htmlspecialchars_decode($data["content"])); ?>');
		}, 500);
	</script><?php endif; ?>
<script>
	$('#thumb').hide();
	function uploadCallback(url) {
		$('#thumb').attr('src', url).show();
		$('#image').attr('value', url);
	}
	$(function() {
		$('#form').on('submit', function(e) {
			$("#content").attr('value', um.getContent());
		});
	});
</script>
<script src="/thinkphp/blog/public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
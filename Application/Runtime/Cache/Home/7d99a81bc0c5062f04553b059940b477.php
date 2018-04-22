<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo C('site.name');?></title>
	<link href="/thinkphp/blog/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/thinkphp/blog/public/home/css/site.css">
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
			<a class="navbar-brand hidden-sm" href="<?php echo U('/');?>"><?php echo C('site.name');?></a>
		</div>
		<div class="navbar-collapse collapse" role="navigation">
			<ul class="nav navbar-nav">
				<?php $categories = getCategory(1); ?>
				<?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('index.php/index/category',array('id'=>$category['categoryId']));?>"><?php echo ($category["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
</div>
<section class="container">
	<div class="col-md-9">
		<ol class="breadcrumb">
	<li><a href="<?php echo U('/');?>">首页</a></li>
	<li><a href="<?php echo U('index.php/index/category',array('id'=>$article['categoryId']));?>"><?php echo ($article["name"]); ?></a></li>
	<li class="active"><?php echo ($article["title"]); ?></li>
</ol>
<div class="panel panel-default">
	<div class="panel-body">
		<h2><?php echo ($article["title"]); ?></h2>
		<p class="text-muted">
			<i class="glyphicon glyphicon-list"></i>
			<a href="<?php echo U('index.php/index/category',array('id'=>$article['categoryId']));?>"><?php echo ($article["name"]); ?></a>
			<i class="glyphicon glyphicon-time"></i> <?php echo (date('m-d',$article["createdAt"])); ?>
		</p>
		<div class="well well-sm"><?php echo ($article["description"]); ?></div>
		<article><?php echo (htmlspecialchars_decode($article["content"])); ?></article>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">发表评论</div>
	<div class="panel-body">
		<form action="" method="post" class="form-horizontal" id="comment-form">
			<div class="form-group">
				<label for="nickname" class="control-label col-md-1">昵称</label>
				<div class="col-md-5">
					<input type="text" id="nickname" name="nickname" maxlength="10" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label for="content" class="control-label col-md-1">内容</label>
				<div class="col-md-5">
					<textarea name="content" id="content" class="form-control" rows="4" maxlength="100" required placeholder="写点什么..."></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 col-md-offset-1">
					<button class="btn btn-success btn-block">发表</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">评论列表</div>
	<div class="panel-body" id="comments">
		<?php if(empty($comments)): ?><p>暂时没有评论</p>
			<?php else: ?>
			<?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="media">
					<div class="media-body">
						<h4 class="media-heading"><?php echo ($item["nickname"]); ?>
							<small><?php echo (date('m-d H:i',$item["createdAt"])); ?></small>
						</h4>
						<p><?php echo ($item["content"]); ?></p>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	</div>
</div>
<script>
	$(function() {
		$('#comment-form').on('submit', function(e) {
			e.preventDefault();
			var nickname = $('#nickname').val().trim();
			var content = $('#content').val().trim();
			var $btn = $(this).find('button');
			$btn.text('提交中').prop('disabled', true);
			$.post('/thinkphp/blog/Home/Index/comment?id=<?php echo ($_GET['id']); ?>', {nickname: nickname, content: content}, function(data) {
				$btn.text('发表').prop('disabled', false);
				if (data.status !== undefined && data.status === 0) {
					alert(data.info);
					return;
				}
				commentSucceed(data);
				$('#nickname').val('');
				$('#content').val('');
			}, 'json');
		});
		function commentSucceed(data) {
			var $html = $('<div class="media">\n\t<div class="media-body"><h4 class="media-heading">' + data.nickname + '<small>' + data.createdAt + '</small></h4><p>' + data.content + '</p></div></div>');
			$('#comments').prepend($html);
		}
	});
</script>
	</div>
	<div class="col-md-3 hidden-xs">
		<div class="panel panel-default">
			<div class="panel-heading">所有分类</div>
			<div class="panel-body">
				<div class="row">
					<?php $categories2 = getCategory(); ?>
					<?php if(is_array($categories2)): $i = 0; $__LIST__ = $categories2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><div class="col-md-6">
							<a href="<?php echo U('index.php/index/category',array('id'=>$category['categoryId']));?>"><?php echo ($category["name"]); ?></a>
							<small class="text-muted">(<?php echo ($category["total"]); ?>)</small>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">友情链接</div>
			<div class="panel-body">
				<?php $links = getLinks(); ?>
				<?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><a href="<?php echo ($item["link"]); ?>" target="_blank"><?php echo ($item["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
</section>
<script src="/thinkphp/blog/public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
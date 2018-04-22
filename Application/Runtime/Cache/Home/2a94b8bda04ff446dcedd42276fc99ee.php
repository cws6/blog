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
		<div class="panel panel-default">
	<div class="panel-heading">最新文章</div>
	<div class="panel-body">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="media">
				<div class="media-left">
					<a href="<?php echo U('index.php/index/article',array('id'=>$article['articleId']));?>">
						<?php if((empty($article["image"])) == "0"): ?><img class="media-object" src="<?php echo ($article["image"]); ?>" alt="<?php echo ($article["title"]); ?>"><?php endif; ?>
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading">
						<a href="<?php echo U('index.php/index/article',array('id'=>$article['articleId']));?>">
							<?php echo ($article["title"]); ?>
						</a>
					</h4>
					<div class="text-muted">
						<i class="glyphicon glyphicon-time"></i> <?php echo (date('m-d',$article["createdAt"])); ?>
						<i class="glyphicon glyphicon-fire"></i> <?php echo ($article["hits"]); ?>
						<i class="glyphicon glyphicon-list"></i> <a class="text-muted" href="<?php echo U('index.php/index/category',array('id'=>$article['categoryId']));?>"><?php echo ($article["name"]); ?></a>
					</div>
					<?php echo ($article["description"]); ?>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>

<?php echo ($page); ?>
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
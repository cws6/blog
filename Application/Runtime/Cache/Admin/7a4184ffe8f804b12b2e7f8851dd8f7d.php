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
<div class="container">
	<h1>文章列表</h1>
	<p>
		<a href="<?php echo U('index.php/admin/article/add');?>" class="btn btn-primary">发表文章</a>
	</p>
	<div class="table-responsive">
		<table class="table table-bordered">
			<tr>
				<td>ID</td>
				<td>标题</td>
				<td>简介</td>
				<td>发表时间</td>
				<td>点击数</td>
				<td>状态</td>
				<td>分类</td>
				<td>操作</td>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($item["articleId"]); ?></td>
					<td><?php echo ($item["title"]); ?></td>
					<td><?php echo (mb_substr($item["description"],0,20,'UTF-8')); ?></td>
					<td><?php echo (date('m-d H:i',$item["createdAt"])); ?></td>
					<td><?php echo ($item["hits"]); ?></td>
					<td>
						<?php if(($item["status"]) == "1"): ?><span class="label label-success">已发布</span>
							<?php else: ?>
							<span class="label label-warning">未发布</span><?php endif; ?>
					</td>
					<td><?php echo ($item["name"]); ?></td>
					<td>
						<a href="<?php echo U('index.php/admin/article/edit?id='.$item['articleId']);?>">编辑</a>
						<a href="<?php echo U('index.php/admin/article/delete?id='.$item['articleId']);?>" onclick="return confirm('确定删除吗?')">删除</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</div>
	<?php echo ($page); ?>
</div>
<script src="/thinkphp/blog/public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
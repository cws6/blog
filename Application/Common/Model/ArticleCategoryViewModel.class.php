<?php
namespace Common\Model;
use Think\Model\ViewModel;
class ArticleCategoryViewModel extends ViewModel
{
	public $viewFields = array(
		'Article' => array('articleId', 'title', 'description', 'image', 'hits', 'createdAt', 'updateAt', 'status', 'sort', 'content'),
		'Category' => array('categoryId', 'name', '_on' => 'Article.categoryId=Category.categoryId')
	);
}
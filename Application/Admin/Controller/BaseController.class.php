<?php

namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller
{
	protected function _initialize()
	{
		if (session('admin.adminId') === null)
		{
			$this->error('请登录', U('index.php/admin/index/login'));
		}
		C('LAYOUT_NAME', 'admin');
	}
}
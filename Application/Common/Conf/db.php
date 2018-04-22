<?php

return array(
	'DB_TYPE' => 'mysql',
	'DB_DSN' => 'mysql:host=localhost;dbname=blog;charset=utf8mb4',
	'DB_uSER' => 'root',
	'DB_PWD' => '',
	'DB_PREFIX' => 'blog_',
	'DB_PARAMS' => array(
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	)
);
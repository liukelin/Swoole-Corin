<?php
/**
 	config.php
*/
return $config = array(

	'serviceDir' => './service', // 控制器文件夹
	'charset' => 'UTF-8', //编码


	//定义url规则
	// index.index => /service/index.php     class index{}
	'handlers'=> array(
					'/' => 'index\index',  //命名空间\类名
					'/test' => 'test\test',
					'/get_list' => 'index\get_list', 
				),
);


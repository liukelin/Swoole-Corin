<?php
/**
	公共方法
 	@authro: liukelin
 
 */
ini_set('date.timezone','Asia/Shanghai');

require('./config.php');
require('./protocols.php');

//获取配置
function config($k=null){
	$conf = @require('./config.php');
	return $k ? $conf[$k] : $conf;
}

//获取毫秒
function microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

//
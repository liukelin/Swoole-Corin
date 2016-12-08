<?php
/**
 @authro: liukelin

**/
require('./common.php');


//载入控制器
$serviceDir = config('serviceDir');
$file=scandir($serviceDir);
foreach ($file as $key => $file) {
	if(substr(strrchr($file, '.'), 1)=='php'){
		// echo $value;
		require($serviceDir.'/'.$file);
	}
}


// start up
$http = new swoole_http_server("0.0.0.0", 9501);
$http->on('request', function ($request, $response) {
		$start = microtime_float();

		//加载文件
		$handler = null;
		$handlers = config('handlers');

		$request_uri = $request->server['request_uri'];
		if($request_uri=='/'){
			$handler = $handlers['/']!='' ? $handlers['/'] : 'index.index';
		}else{
			foreach ($handlers as $k => $val) {
				if($k=='/') continue;
				$pos = strpos($request_uri, $k, 0);
				if ($pos===0) {
					// echo '===='.$pos.'=='.$request_uri.'=='.$k;
					$handler = $val;
					break;
				}
			}
		}

		if($handler){
			// echo 'action:'.$handler;

			// 加载对应方法
			$service = new $handler($request, $response);
			$fun = strtolower($request->server['request_method']);
			$body = $service->$fun();
			// $body = write_response_json($request, $response, $data);
		}else{ 
			$body = '404';
		}


	    $response->end($body);
	    // log
	    $end = microtime_float();
	    $runtime =round(($end-$start)*1000, 2);
	    $time = date('Y-m-d H:i:s',$request->server['request_time']);
	    echo '['. $time.' '.$request->server['server_protocol'].'] '.$request->server['request_method'].' '.$request->server['request_uri'].' ('.$request->server['remote_addr'].') '.$runtime."ms\r\n";

	});

// run
$http->start();


// curl http://localhost:9501/ss/
// swoole_http_request Object
// (
//     [fd] => 1
//     [header] => Array
//         (
//             [host] => localhost:9501
//             [user-agent] => curl/7.43.0
//             [accept] => */*
//         )

//     [server] => Array
//         (
//             [request_method] => GET
//	            [request_uri] => /ss/
//	            [path_info] => /ss/
//	            [request_time] => 1481012506
//	            [request_time_float] => 1481012506.62
//	            [server_port] => 9501
//	            [remote_port] => 38246
//	            [remote_addr] => 127.0.0.1
//	            [server_protocol] => HTTP/1.1
//	            [server_software] => swoole-http-server
//         )

//     [data] => GET /ss/ HTTP/1.1 HTTP/1.1
// 			Host: localhost:9501
// 			User-Agent: curl/7.43.0
// 			Accept: */*
// 			)


/**
    function variable()
         {
                  echo func_num_args();         //输出参数个数
                  $varArray = func_get_args;     //获取参数，返回参数数组
                   foreach($varArray as $value)
                     echo $value;
                  
                     echo func_get_arg;       //获取单个参数
                   
         }
**/

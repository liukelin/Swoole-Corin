<?php
/**
 response header 协议
 @authro: liukelin
 */

/**
	response header 协议
	json
 */
function write_response_json($request, $responser, $body){
    //Write json to client
    $responser->header('Content-type', 'application/json; charset=UTF-8');
    
    // $http_origin = $request->header('Origin') ? $request->header('Origin')!='' : '*';
	// $http_origin = 'http://' . $request->header('host') ? $request->header('host')!='' : '*';    
    $http_origin = '*';
    # 允许固定域名post跨域
    // if (http_origin in ['http://m.baidu.com', 'http://h5.baidu.com']){
        $responser->header("Access-Control-Allow-Origin", $http_origin);
        $responser->header("Access-Control-Allow-Credentials", "true");
        $responser->header("Access-Control-Allow-Methods", "*");
        $responser->header("Access-Control-Allow-Headers", "Content-Type,Accept,Authorization");
        $responser->header("Access-Control-Max-Age", "86400");
     // }
    return json_encode($body);
}

/**
	response header 协议
	text/html
 */
function write_response_text($responser, $body){
    $responser->header('Content-type', 'text/html; charset=UTF-8');
    return $body;
}


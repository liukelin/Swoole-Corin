<?php
namespace test;

class test{

    private $request, $response;
     
    //构造函数，初始化的时候最先执行
    public function __construct($request, $response) {
        $this->request  = $request;
        $this->response = $response;
    }

	public function get(){
		$body = array("test"=>'get');
		return write_response_json($this->request , $this->response , $body);
	}

	public function post(){
		$body = array("test"=>'post');
		return write_response_json($this->request , $this->response , $body);
	}

}




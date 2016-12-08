<?php
namespace index; //命名空间名和文件名一致

class index{

    private $request, $response;
     
    //构造函数，初始化的时候最先执行
    public function __construct($request, $response) {
        $this->request  = $request;
        $this->response = $response;
    }

	public function get(){
		$body = array("index"=>'get');
		return write_response_json($this->request , $this->response , $body);
	}

	public function post(){
		$body = array("index"=>'post');
		return write_response_json($this->request , $this->response , $body);
	}

}

class get_list{
	private $request, $response;
     
    //构造函数，初始化的时候最先执行
    public function __construct($request, $response) {
        $this->request  = $request;
        $this->response = $response;
    }

	public function get(){
		$body = array("index"=>'get_list');
		return $body;
	}
}
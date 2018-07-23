<?php
class _Init
{
	private $request;
	private $vars;
	
	function __construct()
	{
		session_start();
		
		date_default_timezone_set("Asia/Taipei");
		
		// 連結資料庫
		$this->getDb();
		// 變數設定
		$this->setting();
	}
	
	function setting()
	{
		// GET
		$this->request = $_SERVER['QUERY_STRING'];
		// POST
		if(empty($this->request)){
			$this->request = file_get_contents('php://input');
			$post = "Y";
		}
		
		if(!empty($this->request)){
			$getVars = array();
			//parse the page request and other GET variables
			$parsed = explode('&' , $this->request);
			// GET
			if (empty($post) || $parsed[0]=="./?login"){
				// $parsed陣列第一個被移出,$method為第一個陣列值,$parsed剩餘第二個陣列以後的值
				$getVars["m"] = urldecode(array_shift($parsed));
				if (empty($getVars["m"]))
				{
					$getVars["m"] = "index";
				}
				$getVars["m"] = str_replace("./?", "", $getVars["m"]);
			}
			
			foreach ($parsed as $argument)
			{
				//split GET vars along '=' symbol to separate variable, values
				list($variable , $value) = explode('=' , $argument);
				$getVars[$variable] = urldecode($value);
			}
		}else{
			if (!empty($_POST))
			{
				foreach($_POST as $key => $value)
				{
					$getVars[$key] = $value;
				}
			}
			
			if (empty($getVars["m"]))
			{
				$getVars["m"] = "index";
			}
		}
		
		$this->vars = $getVars;
	}
	
	function getDb()
	{
		if (empty($GLOBALS["db"])){
			$GLOBALS["db"]  = new _Connection;
			$GLOBALS["db"]->connect();
		}
	}
	
	function getVars(){
		return $this->vars;
	}
}
?>
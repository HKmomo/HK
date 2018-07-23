<?php
header("content-type:text/html;charset=utf-8");
new IndexController();

class IndexController
{
	// �����
	private $vars;
	// �摰�
	private $content;
	// ��
	private $page;
	private $member;
	private $path = "web/member/";
	
	public function __destruct()
	{
		if (!empty($GLOBALS["db"])) $GLOBALS["db"]->disconnect();
	}
	
	
	function __construct()
	{	
		include_once ("common/AutoLoad.php");
		
		$init = new _Init();
		$this->vars = $init->getVars();
		$vars = $this->vars;
		//$vars["m"]-->method
		if (empty($vars["m"]))
		{
			$this->index($vars);
		} else{
			if (!method_exists($this, $vars["m"]))
			{
				header("Location: /");
				exit;
			}else{
				$this->$vars["m"]($vars);
			}
		}
	}
	

	function setContent($content)
	{
		$this->content = $content;
	}
	
	function getContent()
	{
		return $this->content;
	}
	
	function view($files)
	{
		require_once($files);
	}
	
	
	function index($vars)
	{
		$this->content = "web/index.php";
		$this->view($this->content);
	}
	
	function search($vars)
	{
		$member = new Member();
		$this->member = $member->getList($vars);
		require($this->path."search.php");
	}
	
	function edit($vars)
	{
		$member = new Member();
		$this->member = $member->getInfo($vars);
		$this->setContent($this->path."edit.php");
		$this->view($this->content);
	}
	
	function updateInfo($vars)
	{
		$member = new Member();
		$this->member = $member->updateMember($vars);
		header("Location: ./");
		exit;
	}
}
?>

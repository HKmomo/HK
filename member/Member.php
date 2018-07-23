<?php 
class Member
{
	private $sql;
	private $pageNum = 50;
	private $conn;
	
	function __construct()
	{
		$this->conn = $GLOBALS["db"]->getConnection();
	}
	
	public function __get($property)
	{
		return $this->$property;
	} 
 
	public function __set($property, $value)
	{
		$this->$property = $value;
	}
	
	
	public function add($vars)
	{
		$this->sql = "INSERT INTO xxx(XX,XX,XX) VALUES(?,?,?)";
		
		$stmt = $this->conn->prepare($this->sql);
		$stmt->bind_param('sss', $vars["XXX"], $vars["XXX"], $vars["XXX"]);
		$stmt->execute();
	}
	
	
	public function updateMember($vars)
	{
		$this->sql = "UPDATE XXX SET XXX=? WHERE id=?";
		$stmt = $this->conn->prepare($this->sql);
		$stmt->bind_param('si', $vars["XXXX"], $vars["userId"]);
		$stmt->execute();
		$stmt->close();
	}
	
	
	public function getList($vars)
	{
		$this->sql = "SELECT * FROM XXX WHERE ";
		
		$GLOBALS["db"]->prepare($this->sql);
		$GLOBALS["db"]->query();
		$list = $GLOBALS["db"]->fetch('object');
		return $list;
	}
	
	
	public function getInfo($vars)
	{
		$this->sql = "SELECT * FROM XXX WHERE userId=".$vars["userId"];
	
		$GLOBALS["db"]->prepare($this->sql);
		$GLOBALS["db"]->query();
		$list = $GLOBALS["db"]->fetch('object');
		return $list;
	}
	
}
?>
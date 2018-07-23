<?php
class _Connection
{
	/**
	 * Connection holds MySQLi resource
	 */
	private static $conn;
	
	/**
	 * Query to perform
	 */
	private $query;
	
	/**
	 * Result holds data retrieved from server
	 */
	private $result;
	
	private $row;
	
	/**
	 * Create new connection to database
	 */ 
	public static function connect()
	{
		//connection parameters
		$host = 'localhost';
		$user = "root";
		$password = "";
		$database = 'u1045147';
		
		$port = null;
		$socket = null;	
		
		//create new mysqli connection
		self::$conn = new mysqli
		(
			$host , $user , $password , $database , $port , $socket
		);
		
		self::$conn->set_charset("utf8");
		return true;
	}
	
	public static function getConnection()
	{
		return self::$conn;
	}

	/**
	 * Break connection to database
	 */
	public function disconnect()
	{
		//clean up connection!
		if(mysqli_connect_errno()!==0)
		{
			self::$conn->close();	
		}
		
		return true;
	}
	
	/**
	 * Prepare query to execute
	 * 
	 * @param $query
	 */
	public function prepare($query)
	{
		//store query in query variable
		$this->query = $query;	
		
		return true;
	}
	
	/**
	 * Sanitize data to be used in a query
	 * 
	 * @param $data
	 */
	public function escape($data)
	{
		return self::$conn->real_escape_string($data);
	}
	
	/**
	 * Execute a prepared query
	 */
	public function query()
	{
		if (isset($this->query))
		{
			//execute prepared query and store in result variable
			$this->result = self::$conn->query($this->query);
		
			return true;
		}
		
		return false;		
	}
	
	/**
	 * Fetch a row from the query result
	 * 
	 * @param $type
	 */
	public function fetch($type = 'object')
	{
		if (isset($this->result))
		{
			$rows = null;
			switch ($type)
			{
				case 'array':
					$row = $this->result->fetch_array();
					break;
				case 'object':
					while($row = $this->result->fetch_object())
					{
						$rows[] = $row;
					}
				default:
					$row = $this->result->fetch_object();
				break;
			}
			
			if ($type=="object"){
				return $rows;
			} else{
				return $row;
			}
		}
		
		return false;
	}
}
?>
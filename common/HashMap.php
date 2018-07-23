<?php
class _HashMap
{
	var $map;

	/*
	 * HashMap建構子
	 */
	public function __construct()
	{
		$this->map = array();
	}

	public function put($key, $value)
	{
		if (!array_key_exists($key, $this->map))
		{
			$this->map[$key] = $value;
			return null;
		} else {
			$tempValue = $this->map[$key];
			$this->map[$key] = $value;
			return $tempValue;
		}
	}
  

	public function get($key)
	{
		if (array_key_exists($key, $this->map)){
			return $this->map[$key];
		} else{
			return null;
		}
	}


	public function remove($key)
	{
		$temp_table = array();
		if (array_key_exists($key, $this->map)){
			$tempValue = $this->map[$key];
			while ($curValue = current($this->map)){
				if (!(key($this->map) == $key)){
					$temp_table[key($this->map)] = $curValue;
				}
				next($this->map);
			}
			$this->map = null;
			$this->map = $temp_table;
			return $tempValue;
		} else{
			return null;
		}
	}
  

	/**
	 * 取得HashMap的所有鍵值
	 * @return HashMap中key的集合
	 */
	public function keys()
	{
		return array_keys($this->map);
	}
	
	
	/**
	 * 取得HashMap的所有value值
	 */
	public function values()
	{
		return array_values($this->map);
	}
  

	/**
	 * 將一个HashMap的值全部put到目前HashMap中
	 * @param $map
	 */
	public function putAll($map)
	{
		if(!$map->isEmpty()&& $map->size()>0){
			$keys = $map->keys();
			foreach($keys as $key){
				$this->put($key,$map->get($key));
			}
		}
	}
  
	
	/**
	 * 移除HashMap中所有元素
	 */
	public function removeAll()
	{
		$this->map = null;
		$this->map = array();
	}
	
	
	/**
	 * 清除HashMap中所有元素
	 */
	public function clear()
	{
		$this->map = null;
	}


	/**
	 *HashMap中是否包含指定的值
	 *@param $value
	 */
	public function containsValue($value)
	{
		while ($curValue = current($this->map))
		{
			if ($curValue == $value)
			{
				return true;
			}
			next($this->map);
		}
		return false;
	}


	/**
	 *HashMap中是否包含指定的key
	 *@param $key
	 */
	public function containsKey($key)
	{
		if (array_key_exists($key, $this->map))
		{
			return true;
		} else {
			return false;
		}
	}


	/**
	 * HashMap中元素個數
	 */
	public function size()
	{
		return count($this->map);
	}

  
	/**
	 * 判斷HashMap是否為空
	 */
	public function isEmpty()
	{
		return (count($this->map) == 0);
	}


	public function toString()
	{
		print_r($this->map);
	}
}
?>
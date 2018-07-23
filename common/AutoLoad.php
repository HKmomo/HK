<?php
function __autoload($className)
{
	$file = "";
	if (substr($className,0, 1)=="_"){
		// dirname(__FILE__):取得到此目錄前的完整 PATH
		$file = dirname(__FILE__)."/".substr($className,1) . ".php";
	}else{
		if (strpos($className, "_", 1))
		{
			$class = explode("_", $className);
			//$file = $_SERVER['DOCUMENT_ROOT']."/".lcfirst($class[0])."/" . $class[1] . ".php";
			//$file = $_SERVER['DOCUMENT_ROOT']."/".strtolower(substr($class[0],0,1)).substr($class[0],1)."/" . $class[1] . ".php";
			$file = $_SERVER['DOCUMENT_ROOT']."/".strtolower($class[0])."/" . $class[1] . ".php";
			if (!file_exists($file))
			{
				$file1 = dirname(dirname(__FILE__));
				$file2 = strtolower($class[0])."/" . $class[1] . ".php";
				$file = $file1."/".$file2;
			}
		}else{
			//$file = $_SERVER['DOCUMENT_ROOT']."/".lcfirst($className)."/" . $className . ".php";
			$file = $_SERVER['DOCUMENT_ROOT']."/".strtolower($className)."/" . $className . ".php";
		}
	}
	
	if (file_exists($file))
	{
		require_once($file);
	} else{
		$file1 = dirname(dirname(__FILE__));
		$file2 = strtolower($className)."/" . $className . ".php";
		if (file_exists($file1."/".$file2))
		{
			require_once($file1."/".$file2);
		}else{
			$file1 = dirname(dirname(__FILE__));
			$file2 = lcfirst($className)."/" . $className . ".php";
			if (file_exists($file1."/".$file2))
			{
				require_once($file1."/".$file2);
			}else{
				echo("file not found");
			}
		}
	}
}
?>
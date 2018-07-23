<?php
if ((isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600))
	|| empty($_SESSION['userId']))
{ // last request was more than 60 minates ago
	session_destroy();   // destroy session data in storage
	session_unset();     // unset $_SESSION variable for the runtime
	header("Location: /?login");
	exit();
}else{
	$_SESSION['LAST_ACTIVITY'] = time();
}
?>
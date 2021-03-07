<?php
	require_once 'onac.php';
	if(session_destroy()) header("Location: index.php");
	//todo what if the session expires due to time? what should I do then?
?>
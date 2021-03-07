<?php
	require_once 'config.php';
	require_once 'queries.php';
	$database_connection = new mysqli($servername, $username, $password, $dbname);
	if($database_connection->connect_error) header("Location: down.php");
	else session_start();
?>
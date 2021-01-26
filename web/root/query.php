<?php

 function onac_connect($server_hostname, $server_password, $server_account, $server_database) {
  return new mysqli($server_hostname, $server_password, $server_account, $server_database);
 }

 function onac_connectHasFailed($sqli) {
  return $sqli->connect_error;
 }
?>
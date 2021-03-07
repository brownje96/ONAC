<?php
//todo require onac.php instead??
   session_start();
   if(session_destroy()) header("Location: index.php");
//todo what if the session expires due to time? what should I do then?
?>
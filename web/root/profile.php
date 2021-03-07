<?php
 require_once 'onac.php';

 if(isset($_GET['name'])) {
  $profile=$_GET['name'];
 } else if(isset($_SESSION['login_user'])) {
  $profile=$_SESSION['login_user'];
 } else {
  $profile = "";
 }

 $query = sprintf("SELECT creationTime, verified FROM user WHERE username='%s'", $profile);
?>

<!DOCTYPE html>
<HTML>
 <HEAD>
  <link href="data/style/main.css" rel="stylesheet">
  <?php echo "<TITLE>" . $profile . " -- ONAC</TITLE>"; ?>
 </HEAD>
 <BODY>
 <?php include "data/inc/navbar.inc"; ?>
 <div class="headbar">
  <h3>
   <?php
    if(empty($profile)) echo "Unknown Account...";
    else echo $profile;
   ?>
  </h3>
 </div>

<?php

 $result = $database_connection->query($query);

 if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   echo "<h3>This member has been on ONAC since: " . $row["creationTime"] . "</h3>";
   $isVerified = $row["verified"] == 1? true : false;
   if($isVerified)	 	echo "<h3>This user's account is verified &#10004;&#65039;</h3>";
   else 			echo "<h3>This user's account is unverified &#10067; (boo...hiss...)</h3>";
  }
 } else {
  echo "<h1>There is no user with that name...</h1>";
 }
?>

<?php include 'data/inc/footer.inc'; ?>

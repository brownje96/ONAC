<?php
	require 'config.php';
	$statement = "SELECT communityName, isBanned, isPrivate, foundingUser, foundingTimestamp, description FROM community ORDER BY communityID DESC LIMIT 10";
	$conn = new mysqli($servername,$username,$password,$dbname);
	if($conn->connect_error) header("Location: down.php");
	$result = $conn->query($statement);
	//todo: search feature?
?>
<!DOCTYPE HTML>
<HTML>
 <HEAD>
  <TITLE>ONAC Discover</TITLE>
  <link rel="stylesheet" type="text/css" href="data/style/main.css">
 </HEAD>
 <BODY>
  <?php
   if($conn->connect_error) {
    include "data/inc/down.inc";
    echo "<h3>" . $conn->connect_error . "</h3>";
   } else {
    include "data/inc/navbar.inc";
    echo "<div class=\"headbar\"><h3>Find new communities on ONAC</h3></div>";
    echo "<TABLE><TR><TH>Community</TH><TH>Description</TH><TH>Founded By</TH><TH>Since</TH></TR>";
    while( $row = $result->fetch_assoc() ) {
     if(!(($row["isBanned"] > 0) || ($row["isPrivate"] > 0))) {
		 echo "<TR>";
		 echo "<TH><a href=\"community.php?name=" . $row["communityName"] . "\">" . $row["communityName"] . "</a></TH>";
		 echo "<TH>" . $row["description"] . "</TH> ";
		 echo "<TH>" . $row["foundingUser"] . "</TH> ";
		 echo "<TH>" . $row["foundingTimestamp"] . "</TH> ";
		 echo "</TR>";
	 }
    }
	echo "</TABLE>";
   }
?>
 <?php include 'data/inc/footer.inc';?>
 </BODY>
</HTML>

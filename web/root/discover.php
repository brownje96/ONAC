<?php
	require_once 'onac.php';
	$result = $database_connection->query($query_get_last_10_new_communities);
	//todo: search feature?
?>
<!DOCTYPE HTML>
<HTML>
 <HEAD>
  <TITLE>ONAC Discover</TITLE>
  <link rel="stylesheet" type="text/css" href="data/style/main.css">
 </HEAD>
 <BODY>
  <?php include "data/inc/navbar.inc"; ?>
  <div class="headbar">
   <h3>Find new communities on ONAC</h3>
  </div>
  <TABLE>
   <TR>
    <TH>Community</TH>
    <TH>Description</TH>
    <TH>Founded By</TH>
    <TH>Since</TH>
   </TR>
   <?php
    while($row = $result->fetch_assoc()) {
     if(!(($row["isBanned"] > 0) || ($row["isPrivate"] > 0))) {
      echo "<TR>";
      echo "<TD><a href=\"community.php?name=" . $row["communityName"] . "\">" . $row["communityName"] . "</a></TD>";
      echo "<TD>" . $row["description"] . "</TD>";
      echo "<TD>" . $row["foundingUser"] . "</TD>";
      echo "<TD>" . $row["foundingTimestamp"] . "</TD>";
      echo "</TR>";
     }
    }
   ?>
  </TABLE>
  <?php include 'data/inc/footer.inc'; ?>
 </BODY>
</HTML>

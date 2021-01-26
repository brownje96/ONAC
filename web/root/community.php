<?php
 require 'config.php';
 $community = $_GET["name"];
 $query1 = sprintf("SELECT * FROM community WHERE communityName='%s'", $community);
 $query2 = sprintf("SELECT postHash, poster, caption, postTime, nsfw FROM post WHERE community='%s' ORDER BY postID ASC LIMIT 10", $community);
 $conn = new mysqli($servername, $username, $password, $dbname);
 $result1 = $conn->query($query1);
 $result2 = $conn->query($query2);
?>

<!DOCTYPE html>
<HTML>
 <HEAD>
  <?php echo "<TITLE>" . $community . " on ONAC</TITLE>";?>
</HEAD>
<BODY>
<?php

 if($conn->connect_error) {
  echo "<H1>Connection to ONAC DB failed.</H1>";
  echo "<H2>" . $conn->connect_error . "</H2>";
 }

 if($result1->num_rows > 0) {
  while($row = $result1->fetch_assoc()) {
   if($row["isBanned"] > 0) {
    echo "<H1>This community, " . $community . ", is banned</H1><H2>" . $row["bannedReason"] . "</H2>";
    break;
   }
   if($row["isWarned"] > 0) {
    echo "<H1>You are strongly warned against visiting this community</H1><H2>" . $row["warnedReason"] . "</H2>";
   }
   echo "<h1>Welcome to " . $community . "</h1><h2>" . $row["description"] . "</h2>";
   echo "<h3>Founded by " . $row["foundingUser"] . " on " . $row["foundingTimestamp"] . "</h3>";
   echo "<hr/>";
   if($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			echo "<h3><a href=\"post.php?hash=" . $row["postHash"] . "\">" . $row["caption"]. "</a></h3>";
			echo "<p>posted by <a href=\"profile.php?name=" . $row["poster"] . "\">". $row["poster"] . "</a> on " . $row["postTime"] . "</p>";
			if($row["nsfw"] > 0) echo "<h2>THIS POST IS NOT SAFE FOR WORK</h2>";
			echo "<hr/>";
		}
	} else {
		echo "<H1>There are no posts in this community</H1>";
	}  
  }
 } else echo "<H1>This community does not exist.</H1>";
 include "footer.php";
?>

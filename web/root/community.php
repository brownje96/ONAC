<HTML>
 <HEAD>
<?php
 $servername = "SERVER_HERE";
 $username = "onac";
 $password = "PASSWORD_HERE";
 $dbname = "onac";

 $community = $_GET["name"];
 echo "<TITLE>" . $community . " on ONAC</TITLE>";
?>
</HEAD>
<BODY>
<?php
 $conn = new mysqli($servername, $username, $password, $dbname);
 if($conn->connect_error) {
  die("Connection to ONAC DB failed." . $conn->connect_error);
 }

 $query1 = "SELECT * FROM community WHERE communityName='" . $community . "'";
 $query2 = "SELECT postHash, poster, caption, postTime, nsfw FROM post WHERE community='" . $community . "' ORDER BY postID ASC LIMIT 10";

 $result = $conn->query($query1);

 if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   if($row["isBanned"] > 0) {
    die("<h1>This community, " . $community . ", is banned</h1><h2>" . $row["bannedReason"] . "</h2>");
   }
   if($row["isWarned"] > 0) {
    echo "<h1>You are strongly warned against visiting this community</h1><h2>" . $row["warnedReason"] . "</h2>";
   }
   echo "<h1>Welcome to " . $community . "</h1><h2>" . $row["description"] . "</h2>";
   echo "<h3>Founded by " . $row["foundingUser"] . " on " . $row["foundingTimestamp"] . "</h3>";
   echo "<hr/>";
  }
 } else {
  die("<h1>This community does not exist.</h1>");
 }

 $result = $conn->query($query2);
 if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   echo "<h3><a href=\"post.php?hash=" . $row["postHash"] . "\">" . $row["caption"]. "</a></h3>";
   echo "<p>posted by <a href=\"profile.php?name=" . $row["poster"] . "\">". $row["poster"] . "</a> on " . $row["postTime"] . "</p>";
   if($row["nsfw"] > 0) echo "<h2>THIS POST IS NOT SAFE FOR WORK</h2>";
   echo "<hr/>";
  }
 } else {
  die("There are no posts in this community");
 }

?>
<footer>
 <center><p>&copy; 2021 brownje96</center>
</footer>
</BODY>

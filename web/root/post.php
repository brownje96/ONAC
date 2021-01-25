<HTML>
 <HEAD>
<?php
 $servername = "SERVER_HERE";
 $username = "onac";
 $password = "PASSWORD_HERE";
 $dbname = "onac";

 $post = $_GET["hash"];
 echo "<TITLE>ONAC</TITLE>";
?>
</HEAD>
<BODY>
<?php
 $conn = new mysqli($servername, $username, $password, $dbname);
 if($conn->connect_error) {
  die("Connection to ONAC DB failed." . $conn->connect_error);
 }

 $query2 = "SELECT * FROM post WHERE postHash='". $post . "'";

 $result = $conn->query($query2);
 if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

   echo "<h1>" . $row["caption"] . "</h1>";
   echo "<h2>Posted by <a href=\"profile.php?name=" . $row["poster"] . "\">" . $row["poster"] . "</a> to <a href=\"community.php?name=" . $row["community"] . "\">" . $row["community"] . "</a> at " . $row["postTime"] . "</h2>";
   if($row["nsfw"] > 0) echo "<h2>THIS POST IS NOT SAFE FOR WORK</h2>";
   echo "<p>" . $row["contents"] . "</p>";
  }
 } else {
  die("This post does not exit.");
 }

?>
<footer>
 <center><p>&copy; 2021 brownje96</center>
</footer>
</BODY>

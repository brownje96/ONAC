<?php
 require 'config.php';
 $post = $_GET["hash"];
 $conn = new mysqli($servername, $username, $password, $dbname);
 $query = sprintf("SELECT * FROM post WHERE posthash='%s'", $post);
?>
<!DOCTYPE html>
<HTML>
 <?php if($conn->connect_error) {
  echo "<HEAD><TITLE>Database Error -- ONAC</TITLE></HEAD><BODY><H1>Could not connect to the ONAC Database.</H1><H2>" . $conn->connect_error . "</H2>";
 } else {
  $result = $conn->query($query);
  if($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
    echo "<HEAD><TITLE>" . $row["caption"] . " -- ONAC</TITLE></HEAD><BODY>";
    echo "<H1>". $row["caption"] . "</H1>";
    echo "<H2>Posted by <A href=\"profile.php?name=" . $row["poster"] . "\">" . $row["poster"] . "</A> to <A href=\"community.php?name=" . $row["community"] . "\">" . $row["community"] . "</A> at " . $row["postTime"] . "</H2>";
   if($row["nsfw"] > 0) echo "<H2>THIS POST IS NOT SAFE FOR WORK</H2>";
   echo "<P>" . $row["contents"] . "</P>";
   }
  } else {
   echo "<HEAD><TITLE>Post not found -- ONAC</TITLE></HEAD><BODY><H1>This post does not exist</H1>";
  }
 }
include 'footer.php';
?>

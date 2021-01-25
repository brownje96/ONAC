<HTML>
 <HEAD>
<?php
 $servername = "SERVER_HERE";
 $username = "onac";
 $password = "PASSWORD_HERE";
 $dbname = "onac";

 $profile = $_GET["name"];
 echo "<TITLE>" . $profile . " -- ONAC</TITLE>";
?>
</HEAD>
<BODY>
<?php
 $conn = new mysqli($servername, $username, $password, $dbname);
 if($conn->connect_error) {
  die("Connection to ONAC DB failed." . $conn->connect_error);
 }

 $query1 = "SELECT creationTime, verified FROM user WHERE username='" . $profile . "'";

 $result = $conn->query($query1);

 if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   echo "<h1>" . $profile . "</h1>";
   echo "<h2>" . $row["creationTime"] . "</h2>";
   echo "<h2> Verified? " . $row["verified"] . "</h2>";
  }
 } else {
  die("<h1>There is no user with that name...</h1>");
 }
?>
<footer>
 <center><p>&copy; 2021 brownje96</center>
</footer>
</BODY>

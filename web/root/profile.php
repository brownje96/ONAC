<?php
 require 'config.php';
 $profile = $_GET["name"];
 $query = sprintf("SELECT creationTime, verified FROM user WHERE username='%s'", $profile);
?>

<!DOCTYPE html>
<HTML>
 <HEAD>
  <?php echo "<TITLE>" . $profile . " -- ONAC</TITLE>"; ?>
 </HEAD>
 <BODY>
<?php
 $conn = new mysqli($servername, $username, $password, $dbname);
 if($conn->connect_error) {
  echo "Connection to ONAC DB failed." . $conn->connect_error;
 }


 $result = $conn->query($query);

 if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   echo "<h1>" . $profile . "</h1>";
   echo "<h2>" . $row["creationTime"] . "</h2>";
   echo "<h2> Verified? " . $row["verified"] . "</h2>";
  }
 } else {
  echo "<h1>There is no user with that name...</h1>";
 }

 include 'footer.php';
?>

<?php
 require 'config.php';
 $community = $_GET["name"];
 $query1 = sprintf("SELECT * FROM community WHERE communityName='%s'", $community);
 $query2 = sprintf("SELECT postHash, poster, caption, postTime, nsfw FROM post WHERE community='%s' ORDER BY postID ASC LIMIT 10", $community);
 $conn = new mysqli($servername, $username, $password, $dbname);

 if($conn->connect_error) header("Location: down.php");

 $result1 = $conn->query($query1);
 $result2 = $conn->query($query2);
 
 while($row = $result1->fetch_assoc()) {
	 $description 	= $row["description"];
	 $founder 		= $row["foundingUser"];
	 $timestamp		= $row["foundingTimestamp"];
	 $private		= $row["isPrivate"];
	 $privateReason	= $row["privateReason"];
	 $warned 		= $row["isWarned"];
	 $warnedReason	= $row["warnedReason"];
	 $banned 		= $row["isBanned"];
	 $bannedReason	= $row["bannedReason"];
 }
 
?>

<!DOCTYPE html>
<HTML>
 <HEAD>
  <?php echo "<TITLE>" . $community . " on ONAC</TITLE>"; ?>
  <link href="data/style/main.css" rel="stylesheet">
 </HEAD>
 <BODY>
 <?php include "data/inc/navbar.inc"; ?>
 <div class="headbar">
  <h3>
   <?php
   // this code handles the headbar.
    if($banned == 1) echo "Banned Community";
    else if($result1->num_rows === 0) echo "Community not found";
    else {
	    if($warned) echo "<span style=\"color: yellow\";>&#9888;</span>&nbsp;";
	    echo $community . "&nbsp;&mdash;&nbsp;" . $description;
    }
   ?>
  </h3>
 </div>
<?php
// here is where the warnings will be displayed for troublesome communities.
 if($banned == 1) {
	 echo "<h1 class=\"centered_text\">This community has been banned.</h1>";
	 echo "<h2 class=\"centered_text\">" . $bannedReason . "</h2>";
	 echo "<p class=\"centered_text\"><a href=\"discover.php\">Find another community?</a></p>";
 }
 if($warned == 1) {
	 echo "<h1 class=\"centered_text\">This community has been quarantined.</h1>";
	 echo "<h2 class=\"centered_text\">It may contained shocking content.</h2>";
	 echo "<h3 class=\"centered_text\">" . $warnedReason . "</h3>";
 }
?>

<?php
 if($banned != 1) {
	 if($result1->num_rows == 0) {
		 echo "<h1>This community does not exist...</h1>";
	 }
	 if($result2->num_rows > 0) {
		 while($row = $result2->fetch_assoc()) {
			echo "<p><a href=\"post.php?hash=" . $row["postHash"] . "\">" . $row["caption"]. "</a>";
			echo "&ensp;&mdash;&ensp;posted by <a href=\"profile.php?name=" . $row["poster"] . "\">". $row["poster"] . "</a> on " . $row["postTime"] . "</p>";
			if($row["nsfw"] > 0) echo "<h2>THIS POST IS NOT SAFE FOR WORK</h2>";
			echo "<hr/>"; 
		 }
	 } else echo "<h1>There doesn't seem to be anything here...</h1>";
 }
?>
<?php include "data/inc/footer.inc"; ?>
 </BODY>
</HTML>

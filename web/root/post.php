<?php
//todo require onac.php next time.
	require_once 'config.php';
	session_start();

	$post = $_GET["hash"];
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) header("Location: down.php");
	$query = sprintf("SELECT * FROM post WHERE posthash='%s'", $post);
	$result = $conn->query($query);
	while($row = $result->fetch_assoc()) {
		$title 		= $row["caption"];
		$poster 	= $row["poster"];
		$community 	= $row["community"];
		$stamp 		= $row["postTime"];
		$nsfw 		= $row["nsfw"];
		$contents 	= $row["contents"];
	}

?>
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE><?php echo $title;?> -- ONAC</TITLE>
  <link rel="stylesheet" type="text/css" href="data/style/main.css">
 </HEAD>
 <BODY>
  <?php include "data/inc/navbar.inc"; ?>
  <div class="headbar">
   <h3><?php echo $community;?></h3>
  </div>
  <?php if($nsfw==1) echo "<h1 class=\"centered_text\">THIS POST IS NOT SAFE FOR WORK</h1>";?>
  <h1><?php echo $title;?></h1>
  <h2>by <a href="profile.php?name=<?php echo $poster;?>"><?php echo $poster;?></a> at <?php echo $stamp; ?></h2>
  <br/>
  <p><?php echo $contents;?>
  <?php include 'data/inc/footer.inc'; ?>
 </BODY>
</HTML>
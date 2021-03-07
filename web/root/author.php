<?php
	require_once 'onac.php';
	
	// what about warned and banned
	
	$myError = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_SESSION['login_user'])) {
			$newID = substr(uniqid(), 0, 6);
			$database_connection->query(sprintf($query_create_post, $newID, $_SESSION['login_user'], $_POST['community'], $_POST['title'], isset($_POST['nsfw']) ? 1 : 0, $_POST['message']));
			header("Location: post.php?hash=" . $newID);
		} else $myError = "You need to be logged in to do that!";
	}
	
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>Create a post on ONAC</TITLE>
		<LINK href="data/style/main.css" rel="stylesheet">
	</HEAD>
	<BODY>
		<?php include "data/inc/navbar.inc"; ?>
		<DIV class="headbar">
			<h3>Create a post on ONAC</h3>
		</DIV>
		<BR/><BR/>
		<FORM class="signup" action="" method="POST">
			<LABEL>Post Title</LABEL>
			<INPUT type="text" name="title">
			<LABEL>Community</LABEL>
			<INPUT type="text" name="community">
			<LABEL>Age-restricted (NSFW)?</LABEL>
			<INPUT type="checkbox" name="nsfw">
			<LABEL>Message</LABEL>
			<TEXTAREA rows="20" cols="50" name="message"></TEXTAREA>
			<INPUT type="reset" value="Reset?">
			<INPUT type="submit" value="Submit">
		</FORM>
		<p id="errormsg" style="color: red;"><?php echo $myError; ?></p>
		<?php include "data/inc/footer.inc"; ?>
	</BODY>
</HTML>
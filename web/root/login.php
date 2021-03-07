<?php
	require_once 'onac.php';

	if(isset($_SESSION['login_user'])) header("Location: index.php");

	if($_SERVER["REQUEST_METHOD"] == "POST") { // username and password sent from the form.
		$myusername = mysqli_real_escape_string($database_connection,$_POST['username']);
		$mypassword = mysqli_real_escape_string($database_connection,$_POST['password']); 

		$sql = "SELECT banned, passHash FROM user WHERE username = '$myusername'";
		$result = $database_connection->query($sql);
		$row = $result->fetch_assoc();      
		$count = mysqli_num_rows($result);
		
		if($count == 1) { // verify if the user exists
			if($row['banned'] < 1) { //if the user is not banned
				if(password_verify($mypassword, $row["passHash"])) {
					$_SESSION['login_user'] = $myusername;
					header("Location: index.php");
				} else $_SESSION['auth_error'] = "Your password is incorrect.";
			} else $_SESSION['auth_error'] = "This account has been banned.";
		} else $_SESSION['auth_error'] = "Your account does not exist.";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login to ONAC</title>
		<link href="data/style/main.css" rel="stylesheet">
	</head>
	<body>
		<?php include "data/inc/navbar.inc"; ?>
		<div class="headbar">
			<h3>Login to ONAC</h3>
		</div>
		<h3>Sign into ONAC to converse with people, start a community, blah blah blah</h3>
		<div style="margin-left: 30px;">
			<br/>
			<form method="post" class="signup">
				<label>Username</label>
				<input type="text" name = "username"/>
				<label>Password</label>
				<input type="password" name="password"/>
				<input type="submit" value="Submit"/>
			</form>
			<?php
				if(isset($_SESSION['auth_error'])) {
					echo "<p style=\"color: red;\">" . $_SESSION['auth_error'] . "</p>";
				}
			?>
		</div>
		<br/>
	</body>
</html>
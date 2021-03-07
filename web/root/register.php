<?php
	require_once 'onac.php';
	if(isset($_SESSION['login_user'])) header("Location: index.php");
	
	// Define variables and initialize with empty values
	$username = $password = $confirm_password = $myError = "";
 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Validate username
		if(empty(trim($_POST["username"]))) $myError = "Please enter a username.";
		else {
			// Prepare a select statement
			$result = $database_connection->query(sprintf($query_get_user_id_from_username, $_POST["username"]));             
			if($result->num_rows == 1) $myError = "This username is already taken.";
			else $username = trim($_POST["username"]);
		}

		// Validate password
		if(empty(trim($_POST["password"]))) $myError = "Please enter a password.";     
		elseif(strlen(trim($_POST["password"])) < $cfg_pw_len) $myError = "Password must have at least " . $cfg_pw_len . " characters.";
		else $password = trim($_POST["password"]);

		// Validate confirm password
		if(empty(trim($_POST["confirm_password"]))) $myError = "Please confirm password.";     
		else $confirm_password = trim($_POST["confirm_password"]);

		if(empty($myError) && ($password != $confirm_password)) $myError = "Password did not match.";
		
		// Check input errors before inserting in database
		if(empty($myError)){
			if($database_connection->query(sprintf($query_create_user, $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)))) header("Location: login.php");
			else $myError = "Could not create the account. Please email support about your issue.";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="data/style/main.css">
	</head>
	<body>
		<?php include "data/inc/navbar.inc"; ?>
		<div class="headbar">
			<h3>Sign Up</h3>
		</div>
		<p>Please fill this form to create an account.</p>
		<form class="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<label>Username</label>
			<input type="text" name="username">
			<label>Password</label>
			<input type="password" name="password">
			<label>Confirm Password</label>
			<input type="password" name="confirm_password">
			<input type="submit" value="Submit">
			<input type="reset" value="Reset">
		</form>
		<p>Already have an account? Login <a href="login.php">here</a>.</p>
		<p id="errorMsg" style="color: red;"><?php if(isset($myError)) echo $myError; ?></p>
		<?php include "data/inc/footer.inc"; ?>
	</body>
</html>
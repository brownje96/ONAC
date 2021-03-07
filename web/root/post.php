<?php
	require_once 'onac.php';
	
	// what about quarantined posts?!
	// what about banned posts?!
	
	$result = $database_connection->query(sprintf($query_get_post_from_id, $_GET['hash']));
	$row = $result->fetch_assoc();
	$warned = $database_connection->query(sprintf($query_get_warning_status_from_community_name, $row['community']))->fetch_assoc()['isWarned'];
	$banned = $database_connection->query(sprintf($query_get_banned_status_from_community_name, $row['community']))->fetch_assoc()['isBanned'];

	if($banned) header("Location: community.php?name=" . $row['community']);	// send user back if the community is banned.
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>
		<?php
			if($result->num_rows < 1) echo "Nothing here...";
			else echo $row['caption'];
		?>
		 &nbsp;-- ONAC
		</TITLE>
		<link rel="stylesheet" type="text/css" href="data/style/main.css">
	</HEAD>
	<BODY>
		<?php include "data/inc/navbar.inc"; ?>
		<div class="headbar">
			<h3>
				<?php
					if($result->num_rows < 1) echo "Unknown Post";
					else {
						if($warned) echo "<span style=\"color: yellow\";>&#9888;</span>&nbsp;";
						echo $row['community'];
					}
				?>
			</h3>
		</div>
		<?php
			if($row["nsfw"] > 0) echo "<h1 class=\"centered_text\">THIS POST IS NOT SAFE FOR WORK</h1>";
		?>
		<h1>
		<?php
			if($result->num_rows > 0) echo $row['caption'];
			else echo "There is no post with that ID.";
		?>
		</h1>
		<h2>
			<?php
				if($result->num_rows > 0) {
					echo "by <a href=\"profile.php?name=" . $row['poster'] . "\">" . $row['poster'] . "</a> at " . $row['postTime'];
				}
			?>
		</h2>
	<br/>
	<p>
		<?php
			if($result->num_rows > 0) echo $row['contents'];
		?>
	<?php include 'data/inc/footer.inc'; ?>
	</BODY>
</HTML>
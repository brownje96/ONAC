<?php
	require_once 'onac.php';
	
	// what about quarantined posts?!
	
	$result = $database_connection->query(sprintf($query_get_post_from_id, $_GET['hash']));
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>
		<?php
			if($result->num_rows < 1) echo "Nothing here...";
			else echo $row["caption"];
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
					else echo $row["community"];
				?>
			</h3>
		</div>
		<?php
			if($row["nsfw"] > 0) echo "<h1 class=\"centered_text\">THIS POST IS NOT SAFE FOR WORK</h1>";
		?>
		<h1>
		<?php
			if($result->num_rows > 0) echo $title;
			else echo "There is no post with that ID.";
		?>
		</h1>
		<h2>
			<?php
				if($result->num_rows > 0) {
					echo $row['caption'] . "<br/> by <a href=\"profile.php?name=" . $row['poster'] . "\">" . $row['poster'] . "</a> at " . $row['postTime'];
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
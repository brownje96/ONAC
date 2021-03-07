<?php
	$query_get_community_from_name = "SELECT * FROM community WHERE communityName='%s'"; // invisible/deleted/locked?
	$query_get_amt_of_posts_from_community = "SELECT COUNT(*) FROM community WHERE communityName='%s'";
	$query_get_last_10_posts_from_community = "SELECT postHash, poster, caption, postTime, nsfw FROM post WHERE community='%s' ORDER BY postID ASC LIMIT 10"; // what if there's more than 10?
	$query_get_last_10_new_communities = "SELECT communityName, isBanned, isPrivate, foundingUser, foundingTimestamp, description FROM community ORDER BY communityID DESC LIMIT 10";
	$query_get_post_from_id = "SELECT * FROM post WHERE posthash='%s'";
	$query_get_user_metadata_from_name = "SELECT creationTime, verified FROM user WHERE username='%s'"; //todo: no way, needs ALL the attributes for profile.php
	$query_get_user_id_from_username = "SELECT userID FROM user WHERE username = '%s'";
	$query_get_user_from_username_and_password = "SELECT userID FROM user WHERE username = '%s' and passHash = '%s'";
	$query_create_user = "INSERT INTO user VALUES(NULL, '%s', '%s', 0, 0, NULL, 0, NULL)";
?>
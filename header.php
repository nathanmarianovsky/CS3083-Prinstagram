<?php

$username = $_SESSION['username'];

?>

<div id="header">
	<h2>Prinstagram</h2>
	<div id="nav">
		<a href="welcome.php">Home</a>
	</div>
	<a id="post" href="post_photo.php">Post</a>
	<a id="post" href="add_friend.php">Add a Friend</a>
	<a id="post" href="defriend.php">Remove a Friend</a>
	<a id="post" href="manage_tags.php">Manage Tags</a>
	<a id="signout" href="logout.php">Logout</a>
	<div id="username">
		User logged in: <?php echo $username; ?>
	</div>
</div>
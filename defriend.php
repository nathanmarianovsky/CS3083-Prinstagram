<?php

include "lock.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Remove a Friend</title>
		<link rel="stylesheet" type="text/css" href="tag_user.css">
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="wrapper">	
			<div id="formbox">
				<div id="login_title">Remove Person from Friendgroup(s)</div>
				<form action="remove_friend.php" method="post" enctype="multipart/form-data">
				   	<span id="info">Username:</span>
				    <input type="text" name="friend" class="box" required/>
				    <span id="info">Friendgroup:<br> (Leave empty if you want to remove from all friendgroups)</span>
				    <input type="text" name="friendgroups" class="box"/>
				    <input type="submit" value="Submit"/>
				</form>
			</div>
		</div>
	</body>
</html>
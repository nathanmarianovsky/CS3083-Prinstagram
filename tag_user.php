<?php

include "lock.php";

$pid = $_GET['pid'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Tag a User</title>
		<link rel="stylesheet" type="text/css" href="tag_user.css">
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="wrapper">	
			<div id="formbox">
				<div id="login_title">Tag a User</div>
				<form action="tag_insert.php?pid=<?=$pid?>" method="post" enctype="multipart/form-data">
				    <span id="info">Which user do you want to tag?:</span>
				    <input type="text" name="taggee" class="box" required/>
				    <input type="submit" value="Submit"/>
				</form>
			</div>
		</div>
	</body>
</html>
<?php

include "lock.php";
include "photo.php";
include "mapper.php";

$pid = $_GET['pid'];

$Mapper = new Mapper($db);
$comments = $Mapper->get_photo_comments($pid);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Comments</title>
		<?php include "includes.php"; ?>
	</head>
	<body>
		<?php
			include "header.php";
		?>
		<div id="wrapper">
		<?php
			foreach ($comments as &$comment) {
				$comment->render();
				echo "<br>";
			}
		?>
		</div>
	</body>
</html>
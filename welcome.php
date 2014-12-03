<?php

include "lock.php";
include "photo.php";
include "mapper.php";

$Mapper = new Mapper($db);
$photos = $Mapper->query(new Photo(), "SELECT * FROM <table> WHERE is_pub=1 OR EXISTS (SELECT 1 FROM inGroup WHERE gname IN (SELECT gname FROM shared WHERE photo.pid=shared.pid) 
	AND ownername = photo.poster AND username='" . $username . "' ) OR poster='" . $username . "'", []);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Home</title>
		<?php include "includes.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="wrapper">
		<?php
			foreach ($photos as &$photo) {
				$photo->render();
				echo "<br>";
			}
		?>
		</div>
	</body>
</html>
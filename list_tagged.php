<?php

include "lock.php";
include "photo.php";

$pid = $_GET['pid'];
$names = [];


$sql = $db->prepare("SELECT fname,lname FROM person,tag WHERE pid=? AND username=taggee AND tstatus=1");
$sql->bind_param("i",$pid);
$sql->bind_result($fname,$lname);
$sql->execute();
while($sql->fetch()) {
	$names[] = $fname . " " . $lname;
}
$sql->close();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>People Tagged</title>
		<?php include "includes.php"; ?>
	</head>
	<body>
		<?php
			include "header.php";
		?>
		<div id="wrapper">
			<div id="names">
				<h3 id="people_tagged">People Tagged:</h3>
				<?php
					for($i = 0; $i < sizeof($names); $i++) {
						?><div id="person"><?php echo $names[$i]; ?></div><?php
					}
				?>
			</div>
		</div>
	</body>
</html>
<?php

include "config.php";
include "lock.php";
include "photo.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pid = $_GET['pid'];
    $taggee=$_POST['taggee'];

    if($taggee == $username) {
        $sql = "INSERT INTO tag (pid, tagger, taggee, ttime, tstatus) VALUES ('{$pid}', '{$username}', '{$username}', NOW(), 1)";
    }
    else {
        $sql = "INSERT INTO tag (pid, tagger, taggee, ttime, tstatus) VALUES ('{$pid}', '{$username}', '{$taggee}', NOW(), 0)";
    }

    $result = $db->query($sql);

    if($result) {
        $attempt = "Insert of Tag Successful!";
    }
    else {
        $attempt = "Insert of Tag Unsuccessful!";
    }

    $db->close();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Insert Tag</title>
		<?php include "includes.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="attempt"><?php echo $attempt; ?></div>
	</body>
</html>
<?php

include "config.php";
include "lock.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_GET['pid'];
    $tagger = $_GET['tagger'];
    $status = $_POST['status'];

    if($status == 0) {
        $tmp = 1;
    }
    else {
        $tmp = 0;
    }
    
    $sql = "UPDATE tag SET tstatus='{$tmp}' WHERE pid='{$pid}' AND tagger='{$tagger}' AND taggee='{$username}'";
    echo $sql;
    $result = $db->query($sql);
    $db->close();

    if($result) {
        $attempt = "Tag Change Successful!";
    }
    else {
        $attempt = "Could not Change Tag!";
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Change Tag</title>
		<?php include "includes.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="attempt"><?php echo $attempt; ?></div>
	</body>
</html>
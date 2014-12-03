<?php

include "config.php";
include "lock.php";
include "photo.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pid = $_GET['pid'];
    $comment = $_POST['comment'];
    
    $sql = "INSERT INTO comment (ctime, ctext) VALUES (NOW(), '{$comment}')";
    $result1 = $db->query($sql);
    $cid = $db->insert_id;
    $db->close();
    include "config.php";
    $sql = "INSERT INTO commentOn (cid, pid, username) VALUES ('{$cid}', '{$pid}', '{$username}')";
    $result2 = $db->query($sql);
    $db->close();

    if($result1 == $result2) {
        $attempt = "Comment Insert Successful!";
    }
    else {
        $attempt = "Comment Insert Unsuccessful!";
    }
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
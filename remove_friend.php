<?php

include "lock.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $friend = $_POST['friend'];
    $friendgroups_string = $_POST['friendgroups'];
    $friendgroups=explode(",", $friendgroups_string);
    $result = [];

    for($i=0; $i<COUNT($friendgroups); $i++) {
        $sql = "DELETE FROM inGroup WHERE ownername='{$username}' AND gname='{$friendgroups[$i]}' AND username='{$friend}'";
        $result[$i] = $db->query($sql);
    }

    if(array_sum($result) == count($result)) {
        $attempt = $friend . " was successfully removed from all friendgroups requested";
    }
    else {
        $attempt = "Could not remove " . $friend . " from all friendgroups requested";
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
<?php

include "lock.php";

$poster=$username;
$attempt='You did not attach a photo!';

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$caption=$_POST['caption'];
	$friendgroups_string = $_POST['friendgroups'];
	$friendgroups=explode(",", $friendgroups_string);
	$image = isset($_GET['image']) ? $_GET['image'] : null;
	$is_pub = isset($_POST['is_pub']) && $_POST['is_pub']  ? "1" : "0";
}

if(isset($_FILES['image'])) {
    if($_FILES['image']['error'] == 0) {
        $data = $db->real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
        $query = "INSERT INTO photo (poster, caption, image, pdate, is_pub) VALUES ('{$poster}', '{$caption}', '{$data}', NOW(), '{$is_pub}')";
        $result = $db->query($query);

        $pid=$db->insert_id;
        $pid = strval($pid);
        for($i=0; $i<COUNT($friendgroups); $i++) {
            $sql = "INSERT INTO shared (gname, pid, ownername) VALUES ('{$friendgroups[$i]}', '{$pid}', '{$poster}')";
            $db->query($sql);
        }

        if($result) {
            $attempt='Your file was successfully added!';
        }
        else {
            $attempt='Error! Failed to insert the file';
        }
    }
    else {
        echo 'An error accured while the file was being uploaded.';
    }
    $db->close();
}
else {
    $attempt='Error! Failed to insert the file';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Upload</title>
		<?php include "includes.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="attempt"><?php echo $attempt; ?></div>
	</body>
</html>
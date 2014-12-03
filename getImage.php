<?php

include "lock.php";

$pid = $_GET['pid'];

$sql = $db->prepare("SELECT image FROM photo WHERE pid=?");
$sql->bind_param("i",$pid);
$sql->execute();
$sql->bind_result($image);
$sql->fetch();
$sql->close();

header("Content-type: image/png");
echo $image;

?>
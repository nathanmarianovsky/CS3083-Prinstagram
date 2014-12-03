<?php

include "config.php";
session_start();

if(isset($_SESSION['login_user'])) {
	$username=$_SESSION['login_user'];
	$_SESSION['username'] = $username;
}
else {
	fail();
}

$sql = $db->prepare("SELECT username FROM person WHERE username=?");
$sql->bind_param("s",$username);
$sql->execute();
$sql->bind_result($username);
$sql->fetch();
$sql->close();

if(!isset($username)) {
	fail();
}

function fail() {
	header("Location: login.php");
}

?>
<?php

include "config.php";

session_start();

$error=NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$username=$_POST['username'];
	$_SESSION['username'] = $username;
	$pass=$_POST['password'];

	$sql= $db->prepare("SELECT username FROM person WHERE username=? and password=?");
	$sql->bind_param("ss",$username,$pass);
	$sql->execute();
	$sql->bind_result($uid);
	$sql->fetch();
	$sql->close();

	if(isset($uid)) {
		$_SESSION['login_user']=$uid;
		header("location: welcome.php");
	}	
	else {
		$error="Your Login Name or Password is invalid";
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="login.css">
	</head>
	<body>
		<h1>Prinstagram</h1>
		<div id="wrapper">	
			<div id="main">
				<div id="formbox">
					<div id="login_title">Login</div>
					<form action="" method="post">
						<input type="text" name="username" placeholder="username" class="box"/>
						<input type="password" name="password" placeholder="password"  class="box" />
						<input type="submit" value="Submit"/><!-- <br><a href="register.php" id="register_link">Register</a>
 -->					</form>
					<?php
					if( !is_null($error) ) { ?>
					<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</body>
</html>
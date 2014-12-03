<?php

include "config.php";
include "lock.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Post a Photo</title>
		<link rel="stylesheet" type="text/css" href="post_photo.css">
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="wrapper">	
			<div id="formbox">
				<div id="login_title">Post a Photo</div>
				<form action="upload.php" method="post" enctype="multipart/form-data">
				    <span id="info">Caption:</span>
				    <input type="text" name="caption" class="box"/>
				    <span id="info">Friendgroup(s) to share it with: (Enter as comma seperated list)</span>
				    <input type="text" name="friendgroups" class="box"/>
				    <span id="info">Public?</span>
				    <input type="checkbox" name="is_pub" value="1"/>
				    <span id="info">Choose File to Upload:</span>
				    <div class="fileUpload btn btn-primary">
				    	<div id="upload">Upload</div>
				    	<input type="file" class="upload" name="image" required>
				    </div>
				    <input type="submit" value="Submit"/>
				</form>
			</div>
		</div>
	</body>
</html>
<?php

include "lock.php";
include "mapper.php";
include "photo.php";

$photos = [];
$status = [];

$sql = $db->prepare("SELECT tag.pid,tagger,caption,tstatus,pdate FROM tag,photo WHERE taggee=? and tag.pid=photo.pid");
$sql->bind_param("s",$username);
$sql->bind_result($pid,$tagger,$caption,$tstatus,$pdate);
$sql->execute();
while($sql->fetch()) {
	$tmp = new Photo();
	$tmp->populate($pid, $tagger, $caption, $pdate);
	$photos[] = $tmp;
	$status[] = $tstatus;
}
$sql->close();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Manage Tags</title>
		<link rel="stylesheet" type="text/css" href="tag_user.css">
		<?php include "includes.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
		<div id="wrapper">	
			<div id="formbox">
				<div id="login_title">Manage Tags</div>
				<?php
					for($i = 0; $i < sizeof($photos); $i++) {
						$photos[$i]->tag_render();
						echo "<br>";
						?><div id="status"><?php
							if($status[$i]) {
								echo "Status: Tag Confirmed";
							}
							else {
								echo "Status: Tag Unconfirmed";
							}
						?><br><br>If you would like to change the tag opposite to what it is currently, check the box and click submit!</div>
						<form action="change_tag.php?tagger=<?=$photos[$i]->poster?>&pid=<?=$photos[$i]->pid?>" method="post" enctype="multipart/form-data">
				    		<input type="checkbox" name="change" class="box" required/>
				    		<input type="hidden" name="tagger" value="<?php echo $photos[$i]->poster; ?>">
				    		<input type="hidden" name="status" value="<?php $status[$i]; ?>">
				    		<input type="hidden" name="pid" value="<?php echo $photos[$i]->pid; ?>">
				    		<input type="submit" value="Submit"/>
						</form>
						<?php
					}
				?>
			</div>
		</div>
	</body>
</html>
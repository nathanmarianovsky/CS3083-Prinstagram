<?php

$mysql_hostname = "162.244.31.176";
$mysql_user = "tmp";
$mysql_password = "tmp";
$mysql_database = "Project";

$db = new MySQLi($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die ("Opps something went wrong");

?>
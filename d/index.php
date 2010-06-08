<?php

include('../server-side/db-connection.php');

$defaulturl = "..";
$safefilekey = mysql_real_escape_string($_GET['k']);

$result = mysql_query("SELECT * FROM share_system WHERE access_key='" . $safefilekey . "' LIMIT 1");

if(mysql_num_rows($result) > 0)
{
	$list = mysql_fetch_array($result);
	$file = $defaulturl .  $list['file_location'];
}

header("Pragma: public");
header("Expires: 0");
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
readfile($file);
?> 
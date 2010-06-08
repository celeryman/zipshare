<?php
	include('db-connection.php');
	
	$defaulturl = "http://www.yoursitepath";
	$safefilekey = mysql_real_escape_string($_POST['filekey']);
	$return['success_state'] = false;
	
	mysql_query("UPDATE share_system SET activated=1 WHERE access_key='" . $safefilekey . "'");
	
	if(mysql_affected_rows() > 0)
	{
		$result = mysql_query("SELECT * FROM share_system WHERE access_key='" . $safefilekey . "' LIMIT 1");
		if(mysql_num_rows($result) > 0)
		{
			$list = mysql_fetch_array($result);
			$return['fileurl'] = $defaulturl . "/d?k=" . $list['access_key'];
			$return['success_state'] = true;
		}
	}	
	
	echo json_encode($return);
	die();
?>
	

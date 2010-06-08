<?
	/*****************************************************************
		This file provides a query that needs to run routinely
		to ensure that files that have expired get removed, and files
		that where never activiated will be removed as well.
		
		The query will return a list of directories, which are to be
		deleted.
		
		The variable that will contain the list of directories:
			
				$listofdirectories
				
	******************************************************************/
	include('db-connection.php');
	
	$listofdirectories = null;
	$listofids = null;
	$comma = null;
	$directoryofupload = "..";
	
	function removeFile($target) {
   		unlink($target);
		rmdir(substr($target,0, strrpos($target,"/")));
    }
	
	$result = mysql_query("SELECT 
						  		*					  
						   FROM
						  		share_system
						   WHERE
						   		(activated = 0
								AND NOW() > DATE_ADD(created, INTERVAL 5 MINUTE))
								OR
								NOW() > expire_date") or die(mysql_error());

	while($list = mysql_fetch_array($result))
	{
		removeFile($directoryofupload . $list['file_location']);
		$listofdirectories .= $list['file_location'];
		$listofids .= $comma . $list['id'];
		$comma = ", ";
	}
	
	if(!empty($listofids))
	{
		mysql_query("DELETE FROM
						share_system
					 WHERE
					  	id IN ($listofids)") or die(mysql_error());
	}
?>

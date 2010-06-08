<? 
	$host = "localhost";
	$user = "yourdbuser";
	$password = "";
	$database = "";
	if (!($db = mysql_pconnect($host, $user , $password))){
  		die("Can't connect to database server.");    
	}
	else
	{
  		if (!(mysql_select_db("$database",$db)))
		{
      		die("Can't connect to database.");
    	}
	}
?>

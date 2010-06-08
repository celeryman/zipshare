<?php 
include('db-connection.php'); 
function generateRandomDirectory($directory)
{
	$array = array_merge(range('A','Z'), range('a','z'), range(0,9));
	$size = rand(30,50);
	for($i=0;$i < $size;$i++)
	{
		$directory .= $array[rand(0, count($array))];
	}
	mkdir($directory, 0777);
	chmod($directory, 0777);	
	$directory .= "/";
	return $directory;
}

function generateRandomKey()
{
	$array = array_merge(range('A','Z'), range('a','z'), range(0,9));
	$size = rand(7,10);
	$key = '';
	for($i=0;$i < $size;$i++)
	{
		$key .= $array[rand(0, count($array))];
	}
	
	$result = mysql_query("SELECT * FROM share_system WHERE access_key='" . $key . "' LIMIT 1");
	if(mysql_num_rows($result) > 0)
	{
		return generateRandomKey();
	}
	
	return $key;
}
$expires 	= array(1 => " DATE_ADD(NOW(),  INTERVAL 30 MINUTE) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 1 HOUR) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 5 HOUR) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 1 DAY) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 2 DAY) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 3 DAY) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 4 DAY) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 5 DAY) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 6 DAY) ",
   					  	 " DATE_ADD(NOW(),  INTERVAL 7 DAY) ");

$expire_date = $expires[$_POST['expirevalue']]?$expires[$_POST['expirevalue']]:" DATE_ADD(NOW(),  INTERVAL 30 MINUTE) ";
$uploaddirectory = '../uploads/';
$directory = generateRandomDirectory($uploaddirectory);
$uploadfilename =  $directory . basename($_FILES['uploadfile']['name']);
$defaulturl = "http://www.yoursitepath";

mysql_query("CREATE TABLE IF NOT EXISTS share_system (
			  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  file_location VARCHAR(250),
			  access_key VARCHAR(20),
			  expire_date VARCHAR(20),
			  activated INT(1) default 0,
			  created TIMESTAMP DEFAULT NOW()
			)") or die();

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfilename)) {	
	chmod($uploadfilename, 0777);	
	chmod($directory, 0777);	
	$key = generateRandomKey();
  	mysql_query("INSERT INTO 
					share_system(file_location, access_key, expire_date)  
			     VALUES( '" . substr($uploadfilename, 2) . "', '" . $key . "', " . $expire_date . ")") or die(mysql_error());
	echo $key;
}
?>

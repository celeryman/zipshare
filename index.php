<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Sharing</title>
<link href="css/index.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" language="javascript" src="js/jquery.js" ></script>
<script type="text/javascript" language="javascript" src="js/ajaxupload.js" ></script>
<script type="text/javascript" language="javascript" src="js/index.js" ></script>
</head>

<div id='upload' class='centerdiv'>
	<span class="steps"><strong>STEP 1:</strong> Select the file.</span><br /><br />
    <input type="file" name="fileselector" id="fileselector" autocomplete="off" />
    <span id='thisfile' class="hidden" autocomplete="off" ></span><br /><br />
    
	<span class="steps"><strong>STEP 2:</strong> Select how long the file will remain available.</span><br /><br />
    <select name="expire_time" id="expire_time" autocomplete="off" >
            <option value='1'>30 minutes</option>
            <option value='2'>1 hour</option>
            <option value='3'>5 hours</option>
            <option value='4'>1 day</option>
            <option value='5'>2 days</option>
            <option value='6'>3 days</option>
            <option value='7'>4 days</option>
            <option value='8'>5 days</option>
            <option value='9'>6 days</option>
            <option value='10'>1 week</option>
    </select>
    <br /><br />
    <input type="hidden" id="filekey" value="" />
	<span class="steps"><strong>STEP 3:</strong> Click on UPLOAD.</span><br />
    <div id="uploadbutton"></div>
    <span id="error"></span>
</div>
<div id='uploaded' class='hidden'>
	<div style="margin-top:55px;">
        <span class="steps"><strong>Succcess!</strong></span><br /><br />
        <span class="steps">Here is your link:</span><br /><br />
        <a href="" id='filelink'></a>
    </div>
</div>
<body>
</body>
</html>
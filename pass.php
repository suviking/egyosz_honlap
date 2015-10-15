<?php

include("include/functions.php");

?>
<html>
<head>
	<meta charset = 'UTF-8'>
</head>
<body>
<form action='pass.php' method='POST'>
	<label>Jelszó:</label><input type='text' name='password'><br>
	<input type='submit' value='Generate!'>
</form>



<?php
if (isset($_POST["password"]))
{
	$new = sha1($_POST["password"]);
	echo($new);
}
else
{
	echo("ad");
}



?>
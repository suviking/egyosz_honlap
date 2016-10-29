<?php

$rows[] = array();

$file = fopen('tanuloi_adatbazis/2016-17/StudentListFinished2016-17_v5.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE)
{
  $rows[] = $line;
}
fclose($file);


include("include/dbconnect.php");
include("include/functions.php");


for ($i=2; $i < 613; $i++)
{

		$OM = sha1($rows[$i][0]);
		$fullname = $rows[$i][4];
		$firstname = $rows[$i][1];
		$class = $rows[$i][2];
		$username = nameString($rows[$i][3]);
		$cookie = 452318+$i*7926;
	
		echo("INSERT INTO students (OM, fullname, firstname, class, username, cookie) VALUES ('" .$OM. "', '" .$fullname. "', '" .$firstname. "', '" .$class. "', '" .$username. "', " .$cookie. " );");
}


?>
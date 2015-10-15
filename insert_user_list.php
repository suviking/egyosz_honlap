<?php

$rows[] = array();

$file = fopen('adatbazis/diaklist_v2.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE)
{
  $rows[] = $line;
}
fclose($file);


include("include/dbconnect.php");

for ($i=1; $i < 605; $i++)
{
		$OM = sha1($rows[$i][0]);
		$fullname = $rows[$i][1];
		$firstname = $rows[$i][2];
		$class = $rows[$i][3];
		$username = $rows[$i][4];
		$cookie = 452318+$i*7926;
		echo("INSERT INTO students (OM, fullname, firstname, class, username, cookie) VALUES ('" .$OM. "', '" .$fullname. "', '" .$firstname. "', '" .$class. "', '" .$username. "', " .$cookie. " );");

}



?>
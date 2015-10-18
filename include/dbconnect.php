<?php

$db = new mysqli('127.0.0.1', 'root', '', 'egyosz_honlap');

if ($db->connect_errno)
{
	die("Sorry, we are having some issues with the database connection. Please try again later.");
}

if (!mysqli_set_charset($db, "utf8"))
{
	echo(mysqli_error($db));
}

?>

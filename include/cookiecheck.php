<?php

require_once("dbconnect.php");
require_once("functions.php");


if (isset($_COOKIE["username"]) AND isset($_COOKIE["cookie"]))
{
	$username = res($_COOKIE["username"]);
	$cookie = res($_COOKIE["cookie"]);

	if ($result = $db->query("SELECT * FROM students WHERE username = '" .$username. "' "))
	{
		$user = $result->fetch_assoc();
		if (sha1($user["cookie"]) == $cookie)
		{
			setcookie("cookie", $cookie, time() + 1800);
			setcookie("username", $username, time() + 1800);
		}
		else
		{
			header("Location: logout.php");
			exit;
		}

	}
	else
	{
		header("Location: logout.php");
		exit;
	}
}
else
{
	header("Location: logout.php");
	exit;
}

$result->free();

?>

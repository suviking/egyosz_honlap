<?php

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
	exit;
}

if ($user["accesLevel"] == 0)
{
require("include/head.php");



}
else 
{
	header("Locaation: logout.php");
	exit;
}

?>
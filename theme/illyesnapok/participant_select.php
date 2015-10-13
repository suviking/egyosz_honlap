 <?php

/*if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
}*/
include("../../include/dbconnect.php");


$q = $_GET["q"];

$hintSearchResult = $db->query("SELECT firstName, fullname, class, username FROM students");
$rows = array();
while ($row = $hintSearchResult->fetch_assoc()) 
{
	$rows[] = $row;
}

$hint = "";

if (strlen($q) > 2)
{


	for ($i=0; $i < count($rows); $i++)
	{
		if (stristr($rows[$i]["fullname"], $q))
		{
			$toHint = "<a onClick='addUser(" .'"' .$rows[$i]["username"] .'"'. ")' href='#' >" .$rows[$i]["fullname"]. " - " .$rows[$i]["class"]. "</a><br />";
			$hint = $hint . $toHint;
		}
	}
}
else
{
	$hint = "Legalább három karaktert meg kell adnod!";
}

if ($hint == "")
{
	$hint = "no suggestion";
}

echo ($hint);
 ?>
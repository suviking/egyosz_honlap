<?php

if(!include("../../include/cookiecheck.php"))
{
	header("Location: ../../logout.php");
	exit;
}


echo(
	"<head>
		<meta charset='UTF-8' />
		<title>Egyosznap</title>
		<link rel='shortcut icon' href='../../style/favicon.ico' />

		<link rel='stylesheet' href='../../bootstrap/css/bootstrap.css'>
		<link rel='stylesheet' href='../../bootstrap/material/css/material-fullpalette.css'>
		<link rel='stylesheet' href='../../bootstrap/material/css/ripples.css'>
		<link rel='stylesheet' href='../../bootstrap/material/css/roboto.css'>
		<link rel='stylesheet' href='../../style/custom_bootstrap.css'>

		<script type='text/javascript' src='../../js/jquery-2.1.4.min.js'></script>
		<script type='text/javascript' src='../../js/init.js'></script>
		<script type='text/javascript' src='../../bootstrap/js/bootstrap.js'></script>
		<script type='text/javascript' src='../../bootstrap/material/js/material.js'></script>
		<script type='text/javascript' src='../../bootstrap/material/js/ripples.js'></script>

		<script src='./themeScript.js'></script>
	</head>
	");

if ($user["EGYOSZaccessLevel"] == 2 AND $user["accessLevel"] == 3)
{
	header("Location: ../../logout.php");
	exit;
}

$lectureId = res($_GET["id"]);
$ifFreeSpace = 0;



if ($result = $db->query("SELECT id, seats, reserved,timelineNumber FROM lectures WHERE id=" .$lectureId))
{
	$rows = array();
	while ($row = mysqli_fetch_array($result))
	{
		$rows[] = $row;
	}
	$result->free();

	if (empty($rows))
	{
		header("Location: ../../index.php");
		exit;
	}
	else if ($rows[0]["reserved"] < $rows[0]["seats"])
	{
		if ($result = $db->query("SELECT L".$rows[0]["timelineNumber"].", changes FROM lecregistration WHERE studentId=".$user["id"]))
		{
			$prevR = array();
			while ($prev = mysqli_fetch_array($result))
			{
				$prevR[] = $prev;
			}
			$result->free();

			if ($prevR[0][0] == $lectureId)
			{
				header("Location: ../../index.php");
				exit;
			}
			if ($prevR[0][1] == 0)
			{
				echo "<a href='../../index.php'>A jelentkezés sikertelen volt. Túl sokszor módosítottál rajta. :(</a>";
				header("Refresh: 3; url = ../../index.php");
				exit;			
			}
		}
		else 
		{
			header("Location: ../../index.php");
			exit;
		}

		if ($db->query("UPDATE lecregistration SET L" .$rows[0]["timelineNumber"]. "=" .$rows[0]["id"]. " WHERE studentId=".$user["id"]) AND 
			$db->query("UPDATE lectures SET reserved=reserved+1 WHERE id=".$rows[0]["id"]) AND
			$db->query("UPDATE lectures SET reserved=reserved-1 WHERE id=".$prevR[0][0]) AND
			$db->query("UPDATE lecregistration SET changes=changes-1 WHERE studentId=".$user["id"])) 
		{
			echo "<a href='../../index.php'>Jelentkezésedet rögzítettük. Még ".($prevR[0][1]-1)." alkalommal módosíthatsz a jelentkezéseden.</br>Jó szórakozást kívánunk az előadáshoz!</a>";
			header("Refresh: 5; url = ../../index.php");
			exit;
		}
		else
		{
			echo "<a herf='../../index.php'>Hiba merült fel a jelentkezés elküldése közben. Kérlek, próbálj újra később!</a>";
			header("Refresh: 3; url = ../../index.php");
			exit;
		}
	}
}

exit;
?>

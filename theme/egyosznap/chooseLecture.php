<?php

//no caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.


if(!include("../../include/cookiecheck.php"))
{
	header("Location: ../../logout.php");
	exit;
}

#head section starts
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
#head section ends

#if the user olny can see all or one class's lecture selections, unauthorized access -> logput.php
if ($user["EGYOSZaccessLevel"] == 2 AND $user["accessLevel"] == 3)
{
	header("Location: ../../logout.php");
	exit;
}

#defining variables
$lectureId = res($_GET["id"]);
$ifFreeSpace = 0;


#tries to select the chosen lecture from the database
if ($result = $db->query("SELECT id, seats, reserved,timelineNumber FROM lectures WHERE id=" .$lectureId))
{	#if query was successful --> $rows : the datas of the lecture
	$rows = array();
	while ($row = mysqli_fetch_array($result))
	{
		$rows[] = $row;
	}
	$result->free();

	if (empty($rows))	#there is no lecture with the selected id --> goes to index.php
	{
		header("Location: ../../index.php");
		exit;
	}
	else if ($rows[0]["reserved"] < $rows[0]["seats"])	#the lecture is not full yet, the user can choose this lecture
	{
		if ($result = $db->query("SELECT L".$rows[0]["timelineNumber"].", changes FROM lecregistration WHERE studentId=".$user["id"]))
		{
			#gets the previously selected lecture and the amount of changes left as prev[][], [0][0]->previously selected lecture, [0][1]->changes left
			$prevR = array();
			while ($prev = mysqli_fetch_array($result))
			{
				$prevR[] = $prev;
			}
			$result->free();

			if ($prevR[0][0] == $lectureId)	#if the previously selected lexture's id equals to the new lecture's id -> change is not necessary, goes to index.php
			{
				header("Location: ../../index.php");
				exit;
			}
			if ($prevR[0][1] == 0)	#if the user has no changes left, can not change lecture, error message, redirects after 3 second to index.php
			{
				//echo "<a href='../../index.php'>A jelentkezés sikertelen volt. Túl sokszor módosítottál rajta. :(</a>";
				echo "
					<div class='alert alert-danger'>
						<h3>A jelentkezés sikertelen volt. Túl sokszor módosítottál rajta.</h3>
						<a href='../../index.php' class='btn btn-raised btn-primary'>Vissza a főoldalra</a>
					</div>
				";
				header("Refresh: 5; url = ../../index.php");
				exit;
			}
		}
		else 	#cannot check the user's data (previously selected lecture, changes left)->logout.php
		{
			header("Location: ../../index.php");
			exit;
		}

		#changes the user's selected lecture, increases the new lecture's reserved value, decreases the prev.ly selected lecture's reserved value, decreases the user's change value
		if ($db->query("UPDATE lecregistration SET L" .$rows[0]["timelineNumber"]. "=" .$rows[0]["id"]. " WHERE studentId=".$user["id"]) AND
			$db->query("UPDATE lectures SET reserved=reserved+1 WHERE id=".$rows[0]["id"]) AND
			$db->query("UPDATE lectures SET reserved=reserved-1 WHERE id=".$prevR[0][0]) AND
			$db->query("UPDATE lecregistration SET changes=changes-1 WHERE studentId=".$user["id"])) 	#if the queries above were successful, message, redirects after 5 seconds to index.php
		{
			//echo "<a href='../../index.php'>Jelentkezésedet rögzítettük. Még ".($prevR[0][1]-1)." alkalommal módosíthatsz a jelentkezéseden.</br>Jó szórakozást kívánunk az előadáshoz!</a>";
			echo "
				<div class='alert alert-success'>
					<h3>Jelentkezésedet rögzítettük.</h3>
					<h5>Még ".($prevR[0][1]-1)." alkalommal módosíthatsz a jelentkezéseden.</h5>
					<a href='../../index.php' class='btn btn-raised btn-primary'>Vissza a főoldalra</a>
				</div>
			";
			header("Refresh: 5; url = ../../index.php");
			exit;
		}
		else 	#queries above were unsuccessful, error message, redirects after 3 seconds to index.php
		{
			//echo "<a herf='../../index.php'>Hiba merült fel a jelentkezés elküldése közben. Kérlek, próbálj újra később!</a>";
			echo "
				<div class='alert alert-danger'>
					<h3>Hiba merült fel a jelentkezés elküldése közben. Kérlek, próbáld újra később!</h3>
					<a href='../../index.php' class='btn btn-raised btn-primary'>Vissza a főoldalra</a>
				</div>
			";
			header("Refresh: 5; url = ../../index.php");
			exit;
		}
	}
}

exit;
?>

<?php

require_once("../../include/dbconnect.php");
require_once("../../theme/currentTheme.php");


$result = $db->query("SELECT studentId FROM lecregistration WHERE L1 = 0") OR die($db->error);
$userIds = array();
while ($row = mysqli_fetch_array($result))
{
	$userIds[] = $row["studentId"];
}
$result->free();


$result = $db->query("SELECT id, seats, reserved FROM lectures WHERE seats > reserved") OR die($db->error);
$lecturesSource = array();
while ($row = mysqli_fetch_array($result))
{
	$lecturesSource[] = $row;
}
$result->free();



$result = $db->query("SELECT Count(id) FROM lectures WHERE seats > reserved") OR die($db->error);
$lectureFreeNumber = mysqli_fetch_array($result)[0];
$result->free();




$lecturesFreePlaces = array();
for ($i = 0; $i < $lectureFreeNumber; $i++)
{
	$free = $lecturesSource[$i]["seats"] - $lecturesSource[$i]["reserved"];
	for ($j = 0; $j < $free; $j++)
	{
		$lecturesFreePlaces[] = $lecturesSource[$i]["id"];
	}
}

shuffle($userIds);


for ($k = 0; $k < sizeof($userIds); $k++)
{
	$lectureId = $lecturesFreePlaces[$k];
	$studentId = $userIds[$k];
	echo("UPDATE lecregistration SET L1 = $lectureId WHERE studentId = $studentId;<br />");
}

?>

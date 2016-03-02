<?php

require_once("../../theme/currentTheme.php");
require_once("../../include/dbconnect.php");

$title = $maintitle;
require_once("../../include/head.php");



if (isset($_GET["truncate"]))
{
	$db->query("TRUNCATE TABLE perftoexcel");
	header("Location: listPerformances.php");
	exit;
}
else if (isset($_GET['filltable']))
{
	$allPerfRes = $db->query("SELECT * FROM performances WHERE deleted=0 ORDER BY id ASC");
	$allPerf = array();
	while($row = $allPerfRes->fetch_array())
	{
		$allPerf[] = $row;
	}
	$allPerfRes->free();


	foreach ($allPerf as $perf)
	{
		$regStud = $db->query("SELECT fullname, class FROM students WHERE id = " . $perf["regStudId"])->fetch_array();

		if ($perf["category"] == "Osztálytánc" OR $perf["category"] == "Osztályének")
		{
			$db->query("INSERT INTO perftoexcel (id, regStudClass,participants, title, partNo, category, duration, location, wiredMic, wiredMicStand, wirelessMic, wirelessMicStand, microport, fieldMic, instMic, chair, musicFile, projectorFile, lightRequest, email, piano, jack63, jack35, musicStand, guitarAmp, comment)
				VALUES (".$perf['id'].", '".$regStud[1]."' ,'".$regStud[1]."','".$perf['title']."', ".$perf['partNo'].", '".$perf['category']."', ".$perf['duration'].", '".$perf['location']."', ".$perf['wiredMic'].",
					".$perf['wiredMicStand'].", ".$perf['wirelessMic'].", ".$perf['wirelessMicStand'].", ".$perf['microport'].", ".$perf['fieldMic'].", ".$perf['instMic'].", 
					".$perf['chair'].", '".$perf['musicFile']."', '".$perf['projectorFile']."', ".$perf['lightRequest'].", '".$perf['email']."', ".$perf['piano'].", ".$perf['jack63'].", 
					".$perf['jack35'].", ".$perf['musicStand'].", ".$perf['guitarAmp'].", '".$perf['comment']."')") OR die($db->error);
		}
		else
		{
			$partArray = explode(";", $perf["particUsers"]);
			$participants = $db->query("SELECT fullname, class FROM students WHERE id = " . $perf["regStudId"])->fetch_array()[0].";";
			foreach($partArray as $particUsername)
			{
				$particUser = $db->query("SELECT fullname FROM students WHERE username = '".$particUsername."'")->fetch_array();
				if ($particUser[0] != NULL)
				{
					$participants .= $particUser[0].";";
				}
				else
				{
					$participants .= $particUsername.";";
				}
			}

			$db->query("INSERT INTO perftoexcel (id, regStudClass, participants, title, partNo, category, duration, location, wiredMic, wiredMicStand, wirelessMic, wirelessMicStand, microport, fieldMic, instMic, chair, musicFile, projectorFile, lightRequest, email, piano, jack63, jack35, musicStand, guitarAmp, comment)
				VALUES (".$perf['id'].", '".$regStud[1]."','".$participants."','".$perf['title']."', ".$perf['partNo'].", '".$perf['category']."', ".$perf['duration'].", '".$perf['location']."', ".$perf['wiredMic'].",
					".$perf['wiredMicStand'].", ".$perf['wirelessMic'].", ".$perf['wirelessMicStand'].", ".$perf['microport'].", ".$perf['fieldMic'].", ".$perf['instMic'].", 
					".$perf['chair'].", '".$perf['musicFile']."', '".$perf['projectorFile']."', ".$perf['lightRequest'].", '".$perf['email']."', ".$perf['piano'].", ".$perf['jack63'].", 
					".$perf['jack35'].", ".$perf['musicStand'].", ".$perf['guitarAmp'].", '".$perf['comment']."')") OR die($db->error);
		}

	}
	header("Location: listPerformances.php");
	exit;
}
else
{
	echo("<p><a href=?truncate>Excel_kompatibilis tábla kiürítése</a> - mindig tegye meg, mielőtt feltölti a táblát!</p>");
	echo("<p><a href=?filltable>Excel_kompatibilis tábla feltöltése</a></p>");
}

?>

<?php

$maintitle = "Illyés Napok - 2016";

$deadLineDate = new DateTime('2016-12-05 23:59:59', new DateTimeZone('Europe/Rome'));
$deadLineTS = date_timestamp_get($deadLineDate); //the UNIX timestamp of the deadLineDate

$theme = "illyesnapok"; //you can choose from: "illyesnapok"; "egyosznap"; "tanarertekeles"

$vars = array();
$vars["illyesnapok"] = array("title" => "Illyés Napok");
$vars["egyosznap"] = array("title" => "Egyos Nap");

$welcomeText = "Köszöntünk az Egyosz oldalán!";
$description = "Idén is, mint azt már megszokhattátok, az interneten kell jelentkeznetek az ".$vars[$theme]['title']."ra a produkcióitokkal.";



$bottomLineText = "Készítő és üzemeltető: Süvegh Dávid - Design: Gergály Benedek <br>
	Az üzemeltetők ügyelnek a rendszerben tárolt adatok biztonságára és nem adják ki azokat harmadik félnek.";

//THEME SPECIFIC VARIABLES

	//egyosznap
		$timelineNumber = 1; //gives that how many timeline should the program handle

	//illyesnapok


	//tanarertekeles


?>

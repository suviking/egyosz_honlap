<?php

$result = $db->query("SELECT * FROM config LIMIT 1");
$config = $result->fetch_assoc();
$result->free();


$maintitle = $config["maintitle"]." - ".$config["titleYear"];

$deadLineDate = new DateTime($config["deadLineDate"], new DateTimeZone('Europe/Rome'));
$deadLineTS = date_timestamp_get($deadLineDate); //the UNIX timestamp of the deadLineDate

$theme = $config["currentTheme"]; //you can choose from: "illyesnapok"; "egyosznap"; "tanarertekeles"


$headerText = "<div class='navbar navbar-warning'>
					<div class='navbar-header'>
						<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
					</div>";
$welcomeText = "Köszöntünk az Egyosz oldalán!";
$description = "Idén is, mint azt már megszokhattátok, az interneten kell jelentkeznetek az ".$config["maintitle"]."ra a produkcióitokkal.";



$bottomLineText = "Készítő és üzemeltető: Süvegh Dávid - Design: Gergály Benedek <br>
	Az üzemeltetők ügyelnek a rendszerben tárolt adatok biztonságára és nem adják ki azokat harmadik félnek.";

//THEME SPECIFIC VARIABLES

	//egyosznap
		$timelineNumber = 1; //gives that how many timeline should the program handle

	//illyesnapok


	//tanarertekeles


?>

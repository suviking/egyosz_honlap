<?php

$maintitle = "EGYOSZ Nap - 2016";
$date = mktime(0,0,0,3,18,2016);		// the date you want to display when the event will take place
$deadLine = "2015-12-01"."T"."12:00:00";	// the date you want to display as the deadline of the registration
$deadLineDate = mktime(0,0,0,3,18,2015);

$theme = "egyosznap"; //you can choose from: "illyesnapok"; "egyosznap"; "tanarertekeles"
$welcomeText = "Köszöntünk az Egyosz oldalán!";
$description = "Idén is, mint azt már megszokhattátok, az interneten kell regisztrálnotok az EGYOSZ Nap-i előadásokra.";

/*$bottomLineText = "
<p><b>". $maintitle ." - Jelentkezési rendszer </b> <br/>
Ötletgazda: Solymosi Máté, A rendszer tervezője és üzemeltetője: Süvegh Dávid, Látványterv: Szakács Norbert <br/>
Az üzemeltetők ügyelnek a rendszerben tárol adatok biztonságára és nem adják ki azokat harmadik félnek.</p>
";*/

$bottomLineText = "Készítő és üzemeltető: Süvegh Dávid - Design: Gergály Benedek <br>
	Az üzemeltetők ügyelnek a rendszerben tárolt adatok biztonságára és nem adják ki azokat harmadik félnek.";

//THEME SPECIFIC VARIABLES

	//egyosznap
		$timelineNumber = 1; //gives that how many timeline should the program handle

	//illyesnapok


	//tanarertekeles


?>

<?php
if(!include("../../include/cookiecheck.php"))
{
	header("Location: ../../logout.php");
}


echo(
	"<head>
		<meta charset='UTF-8' />
		<title>Illyésnapok</title>
		<link rel='shortcut icon' href='../../style/favicon.ico' />
	</head>
	");

$regStudID = $user["id"];
$title = $_POST["title"];
$partNo = $_POST["partNo"];
$category = $_POST["category"];
$duration = $_POST["duration"];
$location = $_POST["location"];
$wiredMic = $_POST["wiredMic"];
$wiredMicStand = $_POST["wiredMicStand"];
$wirelessMic = $_POST["wirelessMic"];
$wirelessMicStand = $_POST["wirelessMicStand"];
$microport = $_POST["microport"];
$fieldMic = $_POST["fieldMic"];
$instMic = $_POST["instMic"];
$jack63 = $_POST["jack63"];
$jack35 = $_POST["jack35"];
$guitarAmp = $_POST["guitarAmp"];
$piano = $_POST["piano"];
$musicStand = $_POST["musicStand"];
$chair = $_POST["chair"];
$musicFile = $_POST["musicFile"];
$projectorFile = $_POST["projectorFile"];
if(isset($_POST["ifMusicFile"])) {$ifMusicFile = 1;} else {$musicFile = "NO";}
if(isset($_POST["ifProjector"])) {$ifProjector = 1;} else {$projectorFile = "NO";}
if(isset($_POST["lightRequest"])) {$lightRequest = 1;} else {$lightRequest = 0;}
$email = $_POST["email"];
$particUsers = $_POST["particUsers"];
$comment = $_POST["comment"];
$dateOfReg = date("Y-m-d");




if ($stmt = $db->prepare(
	"INSERT INTO performances (regStudID, title, partNo, category, duration, location, wiredMic, wiredMicStand, wirelessMic, wirelessMicStand, microport, fieldMic, instMic, chair, musicFile, projectorFile, lightRequest, email, particUsers, piano, jack63, jack35, musicStand, guitarAmp, comment, dateOfReg) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ")) {} else {die($db->error);}

$stmt->bind_param("isisisiiiiiiiississiiiiiss",$regStudID, $title, $partNo, $category, $duration, $location, $wiredMic, $wiredMicStand, $wirelessMic, 
	$wirelessMicStand, $microport, $fieldMic, $instMic, $chair, $musicFile, $projectorFile, $lightRequest, $email, $particUsers, $piano, $jack63, $jack35, 
	$musicStand, $guitarAmp, $comment, $dateOfReg);

if($stmt->execute())
{
	echo("<p>Jelentkezésedet fogadtuk. Kellemes felkészülést és sok sikert a produkciódhoz! :) </p>");
}
else
{
	echo($db->error);
	echo("<p>Probléma merült fel a jelentkezésed elküldése közben. Kérlek, ismételd meg később!</p>");
}

$stmt->close();

header("Refresh: 3; url=../../");
exit;

?>

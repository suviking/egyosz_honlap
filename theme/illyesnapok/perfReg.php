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
if(isset($_POST["ifExtraLight"])) {$lightRequest = 1;} else {$lightRequest = 0;}
$email = $_POST["email"];
$particUsers = $_POST["particUsers"];
$comment = $_POST["comment"];
$dateOfReg = date("Y-m-d");

$uniqueTimeStamp = 123456789;



if (!isset($_GET["edit"]))
{
	if ($stmt = $db->prepare(
		"INSERT INTO performances (regStudID, title, partNo, category, duration, location, wiredMic, wiredMicStand, wirelessMic, wirelessMicStand, microport, fieldMic, instMic, chair, musicFile, projectorFile, lightRequest, email, particUsers, piano, jack63, jack35, musicStand, guitarAmp, comment, dateOfReg)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ")) {} else {die($db->error);}

	$stmt->bind_param("isisisiiiiiiiississiiiiiss",$regStudID, $title, $partNo, $category, $duration, $location, $wiredMic, $wiredMicStand, $wirelessMic,
		$wirelessMicStand, $microport, $fieldMic, $instMic, $chair, $musicFile, $projectorFile, $lightRequest, $email, $particUsers, $piano, $jack63, $jack35,
		$musicStand, $guitarAmp, $comment, $dateOfReg);

	if($stmt->execute())
	{
		echo"
			<div class='alert alert-success'>
				<h3>Jelentkezésedet fogadtuk. Kellemes felkészülést és sok sikert a produkciódhoz! :)</h3>
			</div>
		";
	}
	else
	{
		echo($db->error);
		echo"
			<div class='alert alert-danger'>
				<h3>Probléma merült fel a jelentkezésed elküldése közben. Kérlek, ismételd meg később!</h3>
			</div>
		";
	}

	$stmt->close();

	header("Refresh: 5; url=../../");
	exit;
}
else if (isset($_GET["edit"]))
{
	if ($stmt = $db->prepare("UPDATE performances SET title=?, partNo=?, category=?, duration=?, location=?, wiredMic=?, wiredMicStand=?, wirelessMic=?,
		wirelessMicStand=?, microport=?, fieldMic=?, instMic=?, jack63=?, jack35=?, guitarAmp=?, piano=?, musicStand=?, chair=?, musicFile=?, projectorFile=?,
		lightRequest=?, email=?, particUsers=?, comment=?, uniqueTimeStamp=? WHERE id=?")) {} else {die($db->error);}
	$stmt->bind_param("sisisiiiiiiiiiiiiissssssii", $title, $partNo, $category, $duration, $location, $wiredMic, $wiredMicStand, $wirelessMic, $wirelessMicStand,
		$microport, $fieldMic, $instMic, $jack63, $jack35, $guitarAmp, $piano, $musicStand, $chair, $musicFile, $projectorFile, $lightRequest, $email, $particUsers,
		$comment, $uniqueTimeStamp, $_GET["id"]);
	if ($stmt->execute())
	{
		echo"
			<div class='alert alert-success'>
				<h3>Sikeresenen szerkesztetted a produkciót.</h3>
			</div>
		";
	}
	else
	{
		echo($db->error);
		echo"
			<div class='alert alert-danger'>
				<h3>Probléma merült fel a produkció szerkkesztése közben. Kérlek, próbáld meg később!</h3>
			</div>
		";
	}
	$stmt->close();
	$id = res($_GET["id"]);
	header("Refresh: 5; url=../../?adminpage=2&id=$id");
	exit;
}


?>

<?php
error_reporting(E_ALL);

$db = new mysqli('127.0.0.1', 'root', '', 'egyosz_honlap2');


if ($db->connect_errno)
{	
	require_once("./theme/currentTheme.php");
	require_once("head.php");
	require_once("functions.php");

	die("
	<body>
		<div class='navbar navbar-warning'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
			</div>
		</div>
		<div class='alert alert-danger'>
			<h3>Nem sikerült az adatbázishoz csatalakozni! Próbáld meg később vagy írj erre a címre: illyes.egyosz+support@gmail.com </h3>
		</div>
	</body>
	");
}

if (!mysqli_set_charset($db, "utf8"))
{
	echo(mysqli_error($db));
	exit;
}

?>

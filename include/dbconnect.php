<?php

$db = new mysqli('127.0.0.1', 'root', '', 'egyosz_honlap');

if ($db->connect_errno)
{
	die("
	<div class='navbar navbar-warning'>
		<div class='navbar-header'>
			<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
		</div>
	</div>

	<div class='alert alert-danger'>
		<h3>Ne sikerült az adatbázishoz csatalakozni! Próbáld meg később vagy írj erre a címre: egyosz.illyes@gmail.com (még nincs ilyen email cím)</h3>
	</div>
	");
}

if (!mysqli_set_charset($db, "utf8"))
{
	echo(mysqli_error($db));
}

?>

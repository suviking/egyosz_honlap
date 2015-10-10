<?php

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
}

$line = res($_GET["l"]);

require_once("theme/currentTheme.php");

$title = $line. ". sáv - " .$maintitle;
$style = $theme;
require_once("include/head.php");

echo("
	<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
	<hr align='center'size='10' width='816px'>

	<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
		<tr background='style/top_line.png' style='height:32px;'>
			<td style='text-align: left' id='signInText'>Köszöntünk az oldalon, " .$user["surName"]. " " .$user["firstName"]. "!</td>
			<td style='text-align: right' id='signInText'><a href='logout.php'>Kijelentkezés</a></td>
		</tr>
		<tr>
			<td colspan='2' id='introText'><h3>Kérlek, válassz előadást a " .$line. ". sávra! </h3><br/></td>
		</tr>
	");

if ($result = $db->query("SELECT * FROM programs WHERE timeline = ".$line." "))
{
	$rows = $result->fetch_all(MYSQLI_ASSOC);

	foreach ($rows as $row) 
	{
		if ($row["maxParticipants"] > $row["currentParticipants"])
		{
			echo("
				<tr class='reg'>
						<td colspan='2'><div style='border-bottom-style: solid;'><b><a href='#'>" . $row["programName"] . "</a></b></div></td>
				</tr>
				<tr><td colspan='2' style='height: 30px;'></td></tr>

				");
		}
		else
		{
			echo("
				<tr class='unreg'>
						<td colspan='2'><div style='border-bottom-style: solid;'><b><a href='#'>" . $row["programName"] . "</a></b></div></td>
				</tr>
				<tr><td colspan='2' style='height: 30px;'></td></tr>
				");
		}
	}
}






echo("
		<tr id='bottom_line'>
				<td colspan='2'>
					" .$bottomLineText. "
				</td>
		</tr>
	</table>");
?>
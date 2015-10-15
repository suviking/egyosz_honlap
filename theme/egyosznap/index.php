<?php
/// The index.php for the egyosznap theme.

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
}


echo("<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
		<hr align='center'size='10' width='816px'>

		<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
			<tr background='style/top_line.png' style='height:32px;'>
				<td style='text-align: left' id='signInText'>Köszöntünk az oldalon, " .$user["lastName"]. " " .$user["firstName"]. "!</td>
				<td style='text-align: right' id='signInText'><a href='logout.php'>Kijelentkezés</a></td>
			</tr>
			<tr>
				<td colspan='2' id='introText'><h3>Itt kell jelentkezned a különböző sávok előadásaira.</h3><br/></td>
			</tr>
			");


for ($i=0; $i < $timelineNumber; $i++)
{

	if ($result = $db->query("SELECT * FROM programregistration WHERE studentID = " . $user['id'] . " AND timeline = " . ($i+1)))
	{
		if ($result->num_rows == 1) //if the user registrated to somewhere in the "i"th timeline
		{
			$programID = $result->fetch_assoc()["programID"];
			$progRes = $db->query("SELECT * FROM programs WHERE programID = " . $programID . " ");
			$program = $progRes->fetch_assoc();

			echo("
					<tr class='reg'>
						<td colspan='2'><div><b>" . ($i+1) . ". sáv</b></div></td>
					</tr>

					<tr class='reg'>
						<td colspan='2'><div id='nd'><a href='#'>" . $program['programName'] . " - Módosításhoz kattintson ide!</a></div></td>
					</tr>
					<tr><td colspan='2' style='height: 30px;'></td></tr>
				");
		}
		else //if the "i"th timeline is empty, the user did not registrated yet
		{
			echo("
					<tr class='unreg'>
						<td colspan='2'><div><b>" . ($i+1) . ". sáv</b></div></td>
					</tr>

					<tr class='unreg'>
						<td colspan='2'><div id='un_nd'><a href='registration.php?l=" .($i+1). "'>
							Még nem jelentkeztél előadásra ebben a sávban. - A jelentkezéshez kattintson ide!
						</a></div></td>
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

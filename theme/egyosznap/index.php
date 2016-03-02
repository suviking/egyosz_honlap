<?php
/// The index.php for the egyosznap theme.

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
	exit;
}

if (!isset($_GET["adminpage"]))		#dont wanted to use the admin site, goes directly to the registration form
{
	$adminLink = "";

	if ($user["accessLevel"] < 4) 	#checks if the user has the right to access the admin page and if it does the program creates a link to there
	{
		$adminLink =
		"<li>
			<a href='?adminpage=1'>Admin felület</a>
		</li>";
	}
	if ($user["accessLevel"] == 3 OR $user["accessLevel"] == 2)	#if the user not a student but not an admin - redirect to adminpage
	{
		header("Location: ?adminpage=1");
		exit;
	}
	$dateNow = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	if ($user["accessLevel"] == 4 AND $dateNow > $deadLineDate)	#if the user is a student and the deadline is over - registration forbidden
	{
		echo "
		<div class='navbar navbar-warning'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
			</div>
			<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					" .$adminLink. "
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlapon, " .$user["firstName"]. "! A jelenzkezési határidő lejárt. Mostmár nem tudsz jelentkezni.</h2>";
		exit;
	}

	#can use the registration page --> the registration page

	#header starts
	echo "	
		<div class='navbar navbar-warning'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
			</div>
			<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					" .$adminLink. "
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlapon, " .$user["firstName"]. "! Itt tudsz regisztrálni a különböző előadásokra.</h2>";
	#header ends




	for ($i = 0; $i < $timelineNumber; $i++)
	{
		$result = $db->query("SELECT * FROM lectures INNER JOIN lecregistration ON lectures.id = lecregistration.L".($i+1)." WHERE studentId = ".$user["id"]) OR die($db->error);
		$rows = array();
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		$result->free();

		if (empty($rows))
		{
			echo("<table>
				<tr> <th>".($i+1).". sáv</th> </tr>
				<tr> <td><b>Ebben a sávban még nem jelentkeztél előadásra.</td> <th><a href='#'>Jelentkezés</th> </tr>
				</table>");
		}
		else
		{
			echo("<table>
					<tr> <th>".($i+1).". sáv</th> </tr>
					<tr> <td><b>".$rows[0]["title"]."</b> - ".$rows[0]["subtitle"]."</td> <th><a href='#'>Módosítás</th> </tr>
				</table>");
		}
	}

}

exit;
?>

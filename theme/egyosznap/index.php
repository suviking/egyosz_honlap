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


}

exit;
?>

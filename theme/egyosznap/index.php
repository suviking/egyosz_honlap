<?php
/// The index.php for the egyosznap theme.


//no caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
	exit;
}

if (!isset($_GET["adminpage"]) AND !isset($_GET["lectureSelect"]))		#dont wanted to use the admin site, goes directly to the registration form, only lists selected lectures
{
	$adminLink = "";

	if ($user["EGYOSZaccessLevel"] < 4) 	#checks if the user has the right to access the admin page and if it does the program creates a link to there
	{
		$adminLink =
		"<li>
			<a href='?adminpage=1'>Admin felület</a>
		</li>";
	}
	if ($user["EGYOSZaccessLevel"] == 3 OR $user["EGYOSZaccessLevel"] == 2)	#if the user not a student but not an admin - redirect to adminpage
	{
		header("Location: ?adminpage=1");
		exit;
	}
	$dateNow = time();
	if ($user["EGYOSZaccessLevel"] == 4 AND $dateNow > $deadLineTS)	#if the user is a student and the deadline is over - registration forbidden
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

	#can use the registration page --> the registration page, only lists selected lectures, full list and select mode are below

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

	#gets that how many changes the user has as $change
	$result = $db->query("SELECT changes FROM lecregistration WHERE studentId=".$user["id"]) OR die($db->error);
	$changes = array();
	while ($change = mysqli_fetch_array($result))
	{
		$changes[] = $change;
	}
	$result->free();
	$change = $changes[0][0];

	echo "
		<div class='panel panel-default panel-body'>
			Még $change módosítási lehetőséged van hátra.
		</div>
	";

	#lists the timelines and indicates to each, if the user has selected a lecture to the timeline, and if does, which
	for ($i = 0; $i < $timelineNumber; $i++)
	{
		$result = $db->query("SELECT * FROM lectures INNER JOIN lecregistration ON lectures.id = lecregistration.L".($i+1)." WHERE studentId = ".$user["id"]) OR die();
		$rows = array();
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		$result->free();

		if (empty($rows))
		{
			/*echo("<table>
				<tr> <th>".($i+1).". sáv</th> </tr>
				<tr> <td><b>Ebben a sávban még nem jelentkeztél előadásra.</td> <th><a href='?lectureSelect=".($i+1)."'>Jelentkezés</th> </tr>
				</table>");*/

			echo "
				<div class='panel panel-success'>
					<div class='panel-heading'>
						<b>".($i+1)." .sáv</b>
					</div>
					<div class='panel-body'>
						Ebben a sávban még nem jelentkeztél előadásra.
						<br>
						<a href='?lectureSelect=".($i+1)."' class='btn btn-raised btn-success'>Jelentkezés</a>
					</div>
				</div>
			";
		}
		else
		{
			/*echo("<table>
					<tr> <th>".($i+1).". sáv</th> </tr>
					<tr> <td><b>".$rows[0]["title"]."</b> - ".$rows[0]["subtitle"]."</td> <th><a href='?lectureSelect=".($i+1)."'>Módosítás</th> </tr>
				</table>");*/

				echo "
					<div class='panel panel-warning'>
						<div class='panel-heading'>
							<b>".($i+1)." .sáv</b>
						</div>
						<div class='panel-body'>
							".$rows[0]["title"]." - ".$rows[0]["subtitle"]."
							<br>
							<a href='?lectureSelect=".($i+1)."' class='btn btn-raised btn-warning'>Módosítás</a>
						</div>
					</div>
				";
		}
	}

}
else if (isset($_GET["lectureSelect"]) AND intval($_GET["lectureSelect"])<10 AND intval($_GET["lectureSelect"])>0 ) #if the user wants to modify the selected lecture or wants to select
{

	#header starts
	echo "
		<div class='navbar navbar-warning'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
			</div>
			<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					<li>
						<a href='index.php'>Vissza</a>
					</li>
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlapon, " .$user["firstName"]. "! Itt tudsz regisztrálni a különböző előadásokra.</h2>";
	#header ends



	#gets the number of the lectures in the chosen timeline as $lectureNumber
	$result = $db->query("SELECT Count(lectures.id) FROM lectures WHERE timelineNumber = ".res($_GET["lectureSelect"])) OR die();
	$rows = array();
	while ($row = mysqli_fetch_array($result))
	{
		$rows[] = $row;
	}
	$result ->free();
	$lectureNumber = $rows[0][0];	#how many lectures are there in the chosen timeline

	#selects the properties of all lectures in the given as $rows[][]
	$result = $db->query("SELECT * FROM lectures WHERE timelineNumber=" .res($_GET["lectureSelect"])) OR die();
	$rows = array();
	while ($row = mysqli_fetch_array($result))
	{
		$rows[] = $row;
	}
	$result->free();


	#gets that how many changes the user has as $change
	$result = $db->query("SELECT changes FROM lecregistration WHERE studentId=".$user["id"]) OR die($db->error);
	$changes = array();
	while ($change = mysqli_fetch_array($result))
	{
		$changes[] = $change;
	}
	$result->free();
	$change = $changes[0][0];


	echo "
		<div class='panel panel-default panel-body'>
			Még $change módosítási lehetőséged van hátra.
		</div>
	";


	#displays all lectures in the given timeline
	for ($i = 0; $i < $lectureNumber; $i++)
	{
		if ($rows[$i]["reserved"] < $rows[$i]["seats"] && $change > 0)	#if the lecture is not full and the user has changes left
		{
		?>
			<!--<div>
				<p><b> <?php echo $rows[$i]["title"]; ?> </b> <?php echo $rows[$i]["reserved"];?>/<?php echo $rows[$i]["seats"];?> </p>

				<div>
					<p> <?php echo $rows[$i]["subtitle"];?> </p>
					<p> <?php echo $rows[$i]["presenter"];?> </p>
					<p> <?php echo $rows[$i]["description"];?> </p>
					<p><a href='theme\egyosznap\chooseLecture.php?id=<?php echo $rows[$i]["id"];?>' >Kiválaszt</a></p>
				</div>
			</div>
		</br></br>-->


			<div class='panel panel-success'>
				<div class='panel-heading'>
					<b><?php echo $rows[$i]["title"]; ?> </b> <?php echo $rows[$i]["reserved"];?>/<?php echo $rows[$i]["seats"];?>
				</div>
				<div class='panel-body'>
					<b>Helyszín:</b> <?php echo $rows[$i]["location"];?>
					<br>
					<b>Előadó: </b><?php echo $rows[$i]["presenter"];?>
					<br> <br>
					<p> <?php echo $rows[$i]["description"];?> </p>
					<a href='theme/egyosznap/chooseLecture.php?id=<?php echo $rows[$i]["id"];?>' class='btn btn-raised btn-success'>Kiválaszt</a>
				</div>
			</div>


		<?php
		}
		else 	#the lecture is already full or the user has no changes left
		{
		?>
			<!-- <div>
				<p><b> <?php echo $rows[$i]["title"]; ?> </b> Erre az előadásra nem tudsz jelentkezni. <?php echo $rows[$i]["reserved"];?>/<?php echo $rows[$i]["seats"];?> </p>

				<div>
					<p> <?php echo $rows[$i]["subtitle"];?> </p>
					<p> <?php echo $rows[$i]["presenter"];?> </p>
					<p> <?php echo $rows[$i]["description"];?> </p>
				</div>
			</div>
		</br></br> -->

			<div class='panel panel-danger'>
				<div class='panel-heading'>
					<b><?php echo $rows[$i]["title"]; ?> </b> <?php echo $rows[$i]["reserved"];?>/<?php echo $rows[$i]["seats"];?>
					<br>
					<b> Erre az előadásra nem tudsz jelentkezni.</b>
				</div>
				<div class='panel-body'>
					<b> <?php echo $rows[$i]["subtitle"];?> </b>
					<br>
					<b>Előadó: </b><?php echo $rows[$i]["presenter"];?>
					<br> <br>
					<p> <?php echo $rows[$i]["description"];?> </p>
				</div>
			</div>


		<?php
		}
	}

}
else if (isset($_GET["adminpage"]))
{

}
else
{
	header("Location: logout.php");
	exit;
}

exit;
?>

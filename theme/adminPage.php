<?php

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
	exit;
}

if ($_GET["adminpage"] == 1)	#the DEFAULT admin page
{
	setcookie("sql", "", time()-1800);

	if ($user["accessLevel"] < 3)		#case of the user is an admin, or can edit, or can see everything, accessLevel 0, 1, 2 in order
	{
		require("include/head.php");

		$adminLink = "";

		if ($user["accessLevel"] == 0 )
		{
			$adminLink = "	<li><a href='index.php?adminpage=4'>Jelszavak kezelése</a></li>
							<li><a href='index.php?adminpage=5'>SQL</a></li>
							<li><a href='index.php?adminpage=6'>Rendszerkonfiguráció</a></li>";
		}


		########the top bar of the website
			echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
					<ul class='nav navbar-nav navbar-right'>
						".$adminLink."
						<li>
							<a href='index.php'>Vissza a regisztrációs űrlaphoz</a>
						</li>
						<li>
							<a href='logout.php'>Kijelentkezés</a>
						</li>
					</ul>
				</div>
			</div>

			<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!</h2>
				";
		#########

	###prints the registrated performances
		if (isset($_GET["orderby"]))
		{
			$orderby = res($_GET["orderby"]);
		}
		else
		{
			$orderby = "id";
		}

		$result = $db->query(
			"SELECT performances.id, fullname, class, particUsers, title, category, duration, partNo, location, email, dateOfReg, comment
			FROM students INNER JOIN performances ON students.id = performances.regStudID WHERE deleted=0 ORDER BY $orderby ASC") OR die($db->error);

		$rows = array();
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		$result->free();
		$userFunctionKeys = "";


		if (empty($rows)) 		#rows array is empty --> no registrations were sent yet
		{
			echo("<p>Nincs még regisztrált előadás.</p>");
			$resultField = "";
		}
		else 		#rows array is not empty --> registration(s) was(were) made already --> displays the not deleted ones
		{
			$resultField = "";
			for ($i = 0; $i < count($rows); $i++)
			{
				$resultField .= "<tr>";
				for ($j = 0; $j < 12; $j++)
				{
					$resultField .= "<td><input type='text' value='" .$rows[$i][$j]. "' disabled></td>";
				}
		########set users function keys (delete, edit, add)
				if ($user["accessLevel"] < 2)
				{
					$userFunctionKeys = "<td><a href='index.php?adminpage=2&id=" .$rows[$i]["id"]. "'>Szerkesztés</a>
											<a href='index.php?adminpage=3&id=" .$rows[$i]["id"]. "'>Törlés</a></td>";
				}
		#########
				$resultField .= $userFunctionKeys . "</tr>";
			}
		}
			echo("<table><tr>
				<td><a href='?adminpage=1&orderby=id'>id</a></td> <td>Név</td> <td>Osztály</td> <td>Résztvevők</td> 
				<td>Cím</td> <td><a href='?adminpage=1&orderby=category'>Kategória</a></td> <td>Időtartam</td> <td>Résztvevők száma</td> 
				<td><a href='?adminpage=1&orderby=location'>Helyszín</a></td> <td>E-mail</td> <td>dateOfReg</td> <td>Megjegyzés</td>
				</tr>" .$resultField. "</table>");
	###########

	}
	else if ($user["accessLevel"] == 3)	#case of the user is a headteacher, only can see the performances in its own class, accessLevel 3
	{

	}
	else 		#user is not an admin
	{
		header("Location: logout.php");
		exit;
	}
}
else if ($_GET["adminpage"] == 2) 	#EDIT - here the user (with the appropriate access level) can edit the choosen performance
{
	$result = $db->query("SELECT * FROM performances WHERE id=" .res($_GET["id"])) OR die($db->error);

	$rows = array();
	while ($row = $result->fetch_array())
	{
		$rows[] = $row;
	}
	$result->free();

	if ($rows[0]["lightRequest"] == 1)
	{
		$lightRequestChecked = "checked";
	}
	else
	{
		$lightRequestChecked = "";
	}
	#######the registration form to edit values
		echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					<li>
						<a href='?adminpage=1'>Vissza</a>
					</li>
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!  Az alábbi űrlap kitöltésével tudod szerkeszteni az adott produkciót.</h2>

		<div class='jumbotron col-lg-12'>

			<form action='theme/illyesnapok/perfReg.php?edit&id=".$rows[0]["id"]."' id='regForm' class='form-horizontal' method='POST'>
				<fieldset>
					<legend>Általános információk</legend>

					<div class='form-group'>
						<label for='title' class='col-lg-2 control-label'>Produkció címe</label>
						<div class='col-lg-4'>
							<input id='title' class='form-control' name='title' type='text' maxlength='25' size='30' required='required' value='" .$rows[0]["title"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='partNo' class='col-lg-2 control-label'>Résztvevők száma</label>
						<div class='col-lg-4'>
							<input id='partNo' class='form-control' name='partNo' type='number' min='1' max='700' size='3' value='" .$rows[0]["partNo"]. "'>
						</div>
					</div>


					<div class='form-group'>
						<label for='category' class='col-lg-2 control-label'>Kategória</label>
						<div class='col-lg-4'>
							<input type='text' class='form-control' name='category' value='" .$rows[0]["category"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='duration' class='col-lg-2 control-label'>Produkció hossza</label>
						<div class='col-lg-4 input-group'>
							<input id='duration' class='form-control' name='duration' type='number' min='1' max='15' size='3' value='" .$rows[0]["duration"]. "'>
							<span class='input-group-addon'>perc &nbsp;(Inkább felfele kerekíts!)</span>
						</div>
					</div>

					<div class='form-group'>
						<label for='location' class='col-lg-2 control-label'>Helyszín</label>
						<div class='col-lg-4'>
							<input type='text' class='form-control' name='location' value='" .$rows[0]["location"]. "'>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Technikai igények</legend>

					<div class='form-group'>
						<label for='wiredMic' class='col-lg-2 control-label'>Vezetékes mikrofon</label>
						<div class='col-lg-4'>
							<input id='wiredMic' class='form-control' name='wiredMic' type='number' min='0' max='2' value='" .$rows[0]["wiredMic"]. "'>
						</div>
						<label for='wiredMicStand' class='col-lg-2 control-label'>Ebből állványos</label>
						<div class='col-lg-4'>
							<input id='wiredMicStand' class='form-control' name='wiredMicStand' type='number' min='0' max='2' value='" .$rows[0]["wiredMicStand"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='wirelessMic' class='col-lg-2 control-label'>Vezetéknélküli mikrofon</label>
						<div class='col-lg-4'>
							<input id='wirelessMic' class='form-control' name='wirelessMic' type='number' min='0' max='3' value='" .$rows[0]["wirelessMic"]. "'>
						</div>
						<label for='wirelessMicStand' class='col-lg-2 control-label'>Ebből állványos</label>
						<div class='col-lg-4'>
							<input id='wirelessMicStand' class='form-control' name='wirelessMicStand' type='number' min='0' max='3' value='" .$rows[0]["wirelessMicStand"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='microport' class='col-lg-2 control-label'>Mikroport</label>
						<div class='col-lg-4'>
							<input id='microport' class='form-control' name='microport' type='number' min='0' max='2' value='" .$rows[0]["microport"]. "'>
						</div>
					</div>


					<div class='form-group'>
						<label for='fieldMic' class='col-lg-2 control-label'>Térmikrofon (állvánnyal)</label>
						<div class='col-lg-4'>
							<input id='fieldMic' class='form-control' name='fieldMic' type='number' min='0' max='4' value='" .$rows[0]["fieldMic"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='instMic' class='col-lg-2 control-label'>Hangszermikrofon (állvánnyal)</label>
						<div class='col-lg-4'>
							<input id='instMic' class='form-control' name='instMic' type='number' min='0' max='2' value='" .$rows[0]["instMic"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='jack63' class='col-lg-2 control-label'>Jack 6.3mm</label>
						<div class='col-lg-4'>
							<input id='jack63' class='form-control' name='jack63' type='number' min='0' max='2' value='" .$rows[0]["jack63"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='jack35' class='col-lg-2 control-label'>Jack 3.5mm</label>
						<div class='col-lg-4'>
							<input id='jack35' class='form-control' name='jack35' type='number' min='0' max='2' value='" .$rows[0]["jack35"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='guitarAmp' class='col-lg-2 control-label'>Ha hozol gitárerősítőt</label>
						<div class='col-lg-4'>
							<input id='guitarAmp' class='form-control' name='guitarAmp' type='number' min='0' max='5' value='" .$rows[0]["guitarAmp"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='piano' class='col-lg-2 control-label'>Zongora</label>
						<div class='col-lg-4'>
							<input id='piano' class='form-control' name='piano' type='number' min='0' max='1' value='" .$rows[0]["piano"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='musicStand' class='col-lg-2 control-label'>Kottatartó (nekünk csak egy van)</label>
						<div class='col-lg-4'>
							<input id='musicStand' class='form-control' name='musicStand' type='number' min='0' max='1' value='" .$rows[0]["musicStand"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='chair' class='col-lg-2 control-label'>Székek</label>
						<div class='col-lg-4'>
							<input id='chair' class='form-control' name='chair' type='number' min='0' max='9' value='" .$rows[0]["chair"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='musicFile' class='col-lg-2 control-label'>Fájl(ok) neve</label>
						<div class='col-lg-4'>
							<input id='musicFile' class='form-control' name='musicFile' type='text' size='30' value='" .$rows[0]["musicFile"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='projectorFile' class='col-lg-2 control-label'>Kivetítendő fájl(ok) neve</label>
						<div class='col-lg-4'>
							<input id='projectorFile' class='form-control' name='projectorFile' type='text' size='30' value='" .$rows[0]["projectorFile"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='lightRequest' class='col-lg-2 control-label'>Külön fénytechinkai igény</label>
						<div class='col-lg-10 checkbox' id='lightRequest'>
							<label>
								<input name='ifExtraLight' type='checkbox' value='yes' ".$lightRequestChecked.">
								 Van - Az egyéb kéréshez is írhatod, vagy meg is kereshetsz vele minket!
							</label>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Egyéb</legend>

					<div class='form-group'>
						<label for='email' class='col-lg-2 control-label'>E-mail cím, amin elérünk</label>
						<div class='col-lg-4'>
							<input id='email' class='form-control' name='email' type='email' size='30' required='required' value='" .$rows[0]["email"]. "'>
						</div>
					</div>

					<br>

					<div class='form-group'>
						<label for='userSearch' class='col-lg-2 control-label'>Résztvevők hozzáadása</label>
						<div class='col-lg-4'>
							<p>Osztálytánc és osztályének esetén nem kell kitölteni, elég a résztvevők számát beírni fenn</p>
							<div id='hintField' style='' class='well'></div>
						</div>
						<div class='col-lg-6'>
							<textarea class='form-control' form='regForm' name='particUsers' rows='5' maxlength='10000' id='addedUserField' onKeyUp='showUser(this.value)'>".
							$rows[0]["particUsers"]."</textarea>
						</div>
					</div>

					<div class='form-group'>
						<label for='comment' class='col-lg-2 control-label'>Egyéb kérés</label>
						<div class='col-lg-4'>
							<textarea class='form-control' id='comment' form='regForm' cols='30' rows='5' maxlength='500' name='comment'>".$rows[0]["comment"]."</textarea>
						</div>
					</div>
					<!--<div class='form-group'>
						<label for='' class='col-lg-2 control-label'></label>
						<div class='col-lg-4'>
							<input id='' class='form-control' >
						</div>
					</div>-->

					<div class='form-group col-lg-10 col-lg-offset-2'>
						 <button type='submit' class='btn btn-primary'>Elküldés</button>
					</div>

				</fieldset>
			</form>
		</div>";

	#######
}
else if ($_GET["adminpage"] == 3) 	#DELETE - here the user (with the appropriate access level) can delete the choosen performance
{
	####checks if the user has the access level to delete a performance
	if ($user["accessLevel"] > 1)		#the user does not have the access level to delete
	{
		header("Location: logout.php");
		exit;
	}
	else 		#the user does have the access level to delete
	{
		if ($stmt = $db->prepare("UPDATE performances SET deleted = 1 WHERE id = ?")) {} else {die($db->error());}
		$stmt->bind_param("i", $_GET["id"]);
		if ($stmt->execute())
		{
			echo("<p>Sikeresen kitörölted a produkciót a listából.</p>");
			header("Refresh: 3; url='index.php?adminpage=1'");
		}
		$stmt->close();
	}
}
else if (isset($_GET["adminpage"]) AND $_GET["adminpage"] == 4)		#PASSWORDS - here the user (only with admin rights) can give new passwords for users who forgotten it
{
	if (!include("include/cookiecheck.php"))
	{
		header("Location: logout.php");
		exit;
	}

	####checks if the user has the access level to change passwords
	if ($user["accessLevel"] > 1)		#the user does not have the access level
	{
		header("Location: logout.php");
		exit;
	}

	echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					<li>
						<a href='?adminpage=1'>Vissza</a>
					</li>
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!  Az alábbi űrlapon tudod az elfelejtett jelszót megváltoztatni.</h2>


		<input type='text' id='displayUser-q'> <a href='#' onClick='displayUser()'>Mutat</a>
		<div id='password-edit-hintField'>
		</div>
		";
}
else if ($_GET["adminpage"] == 5)		#SQL - here the user (only with admin rights after separate login) can run sql queries
{
	####checks if the user has the access level to the SQL panel
	if ($user["accessLevel"] > 1)		#the user does not have the access level
	{
		header("Location: logout.php");
		exit;
	}

	$sqlPass = "fd29c6f5fa4b58938829b46f91f7ca9b49643fc6";		#gotta find out what it is!!!!!!!!!!

	if (isset($_POST["sqlPswrd"]))		#if got a password from the sql panel's login form
	{
		if (sha1(res($_POST["sqlPswrd"])) == $sqlPass)
		{
			setcookie("sql", sha1($sqlPass), time() + 300);
			header("Location: index.php?adminpage=5");
			exit;
		}
		else
		{
			setcookie("sql", "", time() - 1800);
			header("Location: index.php?adminpage=5");
			exit;
		}
	}

	if (!isset($_GET["query"]) AND !isset($_COOKIE["sql"]))		#no query were sent, no sql authentication cookie exists - the sql panel's login form
	{
		echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
					<ul class='nav navbar-nav navbar-right'>
						<li>
							<a href='?adminpage=1'>Vissza</a>
						</li>
						<li>
							<a href='logout.php'>Kijelentkezés</a>
						</li>
					</ul>
				</div>
			</div>

			<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!  Az alábbi űrlapon SQL lekérdezéseket futtathatsz.</h2>

			<form action='index.php?adminpage=5' method='POST'>
				<h3>Az SQL panel eléréséhez külön be kell jelentkezned.</h3>
				<input type='password' name='sqlPswrd' autofocus>
				<input type='submit' value='Bejelentkezés'>
			</form>
			";
	}
	if (!isset($_GET["query"]) AND isset($_COOKIE["sql"])) 		#no query were sent, sql authentication cookie exists, checks if the authentication is correct
	{
		if ($_COOKIE["sql"] == sha1($sqlPass))		#if the authentication is correct
		{
			setcookie("sql", sha1($sqlPass), time() + 180);

			echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
					<ul class='nav navbar-nav navbar-right'>
						<li>
							<a href='?adminpage=1'>Vissza</a>
						</li>
						<li>
							<a href='logout.php'>Kijelentkezés</a>
						</li>
					</ul>
				</div>
			</div>

			<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!  Az alábbi űrlapon SQL lekérdezéseket futtathatsz.</h2>

			<form action='index.php?adminpage=5&query' method='POST' id='sqlQueryForm'>
				<h3>Az sql panellen futtatott parancsok végzetes kárt okozhatnak az adatbázisban, annak adataiban és szerkezetében!</h3>
				<textarea name='queryText' form='sqlQueryForm' rows='2' cols='100'></textarea>
				<input type='submit' value='Futtatás'>
			</form>
			";


		}
		else 		#if the authentication is not correct
		{
			setcookie("sql", "", time() - 1800);
			header("Location: index.php?adminpage=5");
			exit;
		}
	}
	if (isset($_GET["query"]) AND isset($_COOKIE["sql"]))		#query were sent, sql authentication cookie exists, if the authentication is correct runs the query
	{
		if ($_COOKIE["sql"] == sha1($sqlPass))		#if the authentication is correct, runs the query
		{
			setcookie("sql", sha1($sqlPass), time() + 180);

			echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
					<ul class='nav navbar-nav navbar-right'>
						<li>
							<a href='?adminpage=1'>Vissza</a>
						</li>
						<li>
							<a href='logout.php'>Kijelentkezés</a>
						</li>
					</ul>
				</div>
			</div>

			<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!  Az alábbi űrlapon SQL lekérdezéseket futtathatsz.</h2>

			<form action='index.php?adminpage=5&query' method='POST' id='sqlQueryForm'>
				<h3>Az sql panellen futtatott parancsok végzetes kárt okozhatnak az adatbázisban, annak adataiban és szerkezetében!</h3>
				<textarea name='queryText' form='sqlQueryForm' rows='2' cols='100'></textarea>
				<input type='submit' value='Futtatás'>
			</form>
			";

			$queryText = $_POST["queryText"];


			$result = $db->query($queryText);

			if (gettype($result) == "object")
			{
				$rows = array();
				while ($row = $result->fetch_assoc())
				{
					$rows[] = $row;
				}
				print_r($rows);
				$result->free();
			}
			else
			{
				if ($result == 1)
				{
					print("A lekérdezés sikeresen lefutott!");
				}
				else
				{
					print("A lekérdezés végrehajtása közben hiba merült fel.</br>");
					print_r($db->error);
				}
			}
		}
		else 		#if the authentication is not correct
		{
			setcookie("sql", "", time() - 1800);
			header("Location: index.php?adminpage=5");
			exit;
		}
	}
}
else if ($_GET["adminpage"] == 6 )
{
	if ($user["accessLevel"] > 1)		#the user does not have the access level
	{
		header("Location: logout.php");
		exit;
	}
	if (!isset($_GET["modify"]))
	{
		echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
						<ul class='nav navbar-nav navbar-right'>
							<li>
								<a href='?adminpage=1'>Vissza</a>
							</li>
							<li>
								<a href='logout.php'>Kijelentkezés</a>
							</li>
						</ul>
					</div>
				</div>

				<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!  Az alábbi űrlapon konfigurálhatod a rendszert.</h2>
			";

		$result = $db->query("SELECT * FROM config LIMIT 1");
		$config = $result->fetch_assoc();
		$result->free();

		$deadLineDate = $config["deadLineDate"];
		$exploded = explode(" ", $deadLineDate);

		$deadLineDate = $exploded[0]."T".$exploded[1];



			echo "
				<div class='row'>
				<div class='col-md-1'></div>
				<div class='col-md-10'>
					<form action='index.php?adminpage=6&modify' method='POST' id='configForm'>
					<table class='table'>
					  <thead>
					  <tr>
					    <th>Téma neve</th>
					    <th>Főcím</th>
					    <th>Esemény éve a címben</th>
					    <th>Esemény dátuma</th>
					    <th>Jelentkezési határidő</th>
					  </tr>
					  </thead>
					  <tbody>
					  <tr class='active'>
					    <td><select class='form-control' name='currentTheme' require='require'>
								<option name='currentTheme' "; echo ($config["currentTheme"]=='illyesnapok')?'checked':''; echo ">illyesnapok</option>
								<option name='currentTheme' "; echo ($config["currentTheme"]=='egyosznap')?'checked':''; echo ">egyosznap</option>
							</select>
					    </td>
					    <td><input type='text' name='maintitle' maxlength='15' value='".$config["maintitle"]."'  require='require'></td>
					    <td><input type='number' name='titleYear' min='2016' max='9999' value='".$config["titleYear"]."'  require='require'></td>
					    <td><input type='text' name='date' maxlength='20' value='".$config["date"]."'></td>
					    <td><input type='datetime-local' name='deadLineDate' value='".$deadLineDate."' step=1 require='require'>
					    	<br><small>(Y-m-d H:i:s)</small></td>
					  </tr>
					  <tr class='active'>
					  	<td colspan='5'><input type='submit' value='Futtatás' class='pull-right btn btn-raised btn-primary'></td>
					  </tr>
					</form>
				</div>
				<div class='col-md-1'></div>
				</div>
				";
	}
	else
	{
		$currentTheme = res($_POST["currentTheme"]);
		$maintitle = res($_POST["maintitle"]);
		$titleYear = res($_POST["titleYear"]);
		$date = res($_POST["date"]);
		$deadLineDate = res($_POST["deadLineDate"]);

		$exploded = explode("T", $deadLineDate);
		$deadLineDate = $exploded[0] . " " . $exploded[1];


		if ($db->query("UPDATE config SET currentTheme = '$currentTheme', maintitle = '$maintitle', titleYear = '$titleYear', date = '$date', deadLineDate = '$deadLineDate' "))
		{
			echo $headerText."</div>

				<div class='alert alert-success'>
					<h3>A rendszer beállításait sikeresen módosítottad.</h3>
					<a href='?adminpage=6' class='btn btn-success btn-raised'>Vissza</a>
				</div>
				";

				header("Refresh: 3; url=?adminpage=1");
				exit;
		}
		else
		{
			echo $headerText."</div>

				<div class='alert alert-danger'>
					<h3>A bállítások módosítása közben váratlan hiba lépett fel. Kérjük, próbáld meg később, 
					vagy lépj kapcsolatba velünk az illyes.egyosz+support@gmail.com e-mail címen.</h3>
					<a href='?adminpage=6' class='btn btn-danger btn-raised'>Vissza</a>
				</div>
				";

				header("Refresh: 3; url=?adminpage=6");
				exit;
		}
	}
}
else 	#every other cases are invalid links --> logging out for security reasons
{
	header("Location: logout.php");
	exit;
}

?>
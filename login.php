<?php

#region //including the required files
require_once("include/dbconnect.php");
require_once("include/functions.php");
require_once("theme/currentTheme.php");

$title = $maintitle;
$style = "asd";

require_once("include/head.php");
#endregion



if (isset($_POST["username"]))	//if the user tried to log in
{
	if ($_POST["username"] != "" AND $_POST["password"] != "")	//checks if the user gave a username AND a passowrd
	{
		$username = nameString(res($_POST["username"]));
		$password = res($_POST["password"]);
		$cookie = $password;
		$password = sha1($password);

		if ($result = $db->query("SELECT * FROM students WHERE username = '".$username."' AND OM = '".$password."' "))
		{
			if ($result->num_rows == 1) //one row was selected from the database, so the user gave a password-username which can match with a row in the database
			{
				$user = $result->fetch_assoc();
				$cookie = sha1($user["cookie"]);
				setcookie("cookie", $cookie, time() + 1800);
				setcookie("username", $user["username"], time() + 1800);
				header("Location: index.php");
				exit;
			}
			else //the user gave a password-username which can not match with any row in the database, incorrect passowrd or username
			{
				/*echo("
				<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
				<hr align='center'size='10' width='816px'>

				<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
					<tr background='style/top_line.png' style='height:32px;'>
						<td style='text-align: right' id='signInText' colspan='2'>Belépés</td>
					</tr>
					<tr><td style='padding: 10px;'><a href='logout.php'><img src='style/back_butt.png'></a></td></tr>
					<tr><td style='padding: 20px;padding-top:0px;' align='center'>
						Hibás felhasználóevet vagy jelszót adott meg.
					</td></tr>
				</table>");*/

				echo "
				<div class='navbar navbar-warning'>
					<div class='navbar-header'>
						<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
					</div>
					<div class='navbar-collapse collapse navbar-warning-collapse'>
						<ul class='nav navbar-nav navbar-right'>
							<li>
								<!--<a href=''>Bejelentkezés</a>-->
							</li>
						</ul>
					</div>
				</div>

				<div class='alert alert-danger'>
					<h3>Hibás felhasználónév vagy jelszó!</h3>
					<a href='./logout.php' class='btn btn-danger btn-raised'>Vissza</a>
				</div>
				";

				header("Refresh: 3; url=logout.php");
				exit;
			}
			$result->free();
		}
	}
	else //if the user did not gave a username OR a password
	{
		/*echo("
			<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
			<hr align='center'size='10' width='816px'>

			<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
				<tr background='style/top_line.png' style='height:32px;'>
					<td style='text-align: right' id='signInText' colspan='2'>Belépés</td>
				</tr>
				<tr><td style='padding: 10px;'><a href='logout.php'><img src='style/back_butt.png'></a></td></tr>
				<tr><td style='padding: 20px;padding-top:0px;' align='center'>Nem adott meg felhasználónevet vagy jelszót!</td></tr>
			</table>
			");*/

			echo "
			<div class='navbar navbar-warning'>
				<div class='navbar-header'>
					<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
				</div>
				<div class='navbar-collapse collapse navbar-warning-collapse'>
					<ul class='nav navbar-nav navbar-right'>
						<li>
							<!--<a href=''>Bejelentkezés</a>-->
						</li>
					</ul>
				</div>
			</div>

			<div class='alert alert-danger'>
				<h3>Nincs megadva felhasználónév vagy jelszó!</h3>
				<a href='./logout.php' class='btn btn-danger btn-raised'>Vissza</a>
			</div>
			";


		header("Refresh: 3; url = logout.php");
		die();
	}
}
else	//if the user did not try to log in, the default login form
{
	/*echo("

		<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
		<hr align='center'size='10' width='816px'>

		<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
			<tr background='style/top_line.png' style='height:32px;'>
				<td style='text-align: right' id='signInText' colspan='2'>Belépés</td>
			</tr>
			<tr>
				<td id='introText' colspan='2'>
					<p><h3>" .$welcomeText. "</h3></p>
				</td>
			</tr>
			<tr>
				<td style='width: 50%; padding: 10px; font-size: 105%;' >" .$description. "</td>
				<td id='loginForm'>
					<form action='login.php' method='POST'>
						<p>Felhasználónév: <input type='text' name='username'></p>
						<p>Jelszó: <input type='password' name='password'></p>
						<p><input type='image' src='style/small_reg_butt.png' alt='Jelentkezés'></p>
					</form>
				</td>
			</tr>
			<tr>
				<td colspan='2' style='text-align: center; padding: 10px;'><img src='style/logo.png'></td>
			</tr>
			<tr id='bottom_line'>
				<td colspan='2'>
					" .$bottomLineText. "
				</td>
			</tr>
		</table>

		");*/

		echo "

			<div class='navbar navbar-warning'>
				<div class='navbar-header'>
					<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
				</div>
				<div class='navbar-collapse collapse navbar-warning-collapse'>
					<ul class='nav navbar-nav navbar-right'>
						<li>
							<!--<a href=''>Bejelentkezés</a>-->
						</li>
					</ul>
				</div>
			</div>

			<div class='jumbotron col-lg-12'>
				<h1>$welcomeText</h1>
				<div class='col-lg-8'>
					<p>$description</p>
				</div>
				<form class='col-lg-4' action='login.php' method='POST'>
					<fieldset>
						<div class='form-group'>
							<input class='form-control floating-label' type='text' name='username' placeholder='Felhasználónév'>
						</div>
						<div class='form-group'>
							<input class='form-control floating-label' type='password' name='password' placeholder='Jelszó'>
						</div>
						<div class='form-group'>
							<button type='submit' class='btn btn-primary'>Jelentkezés</button>
						</div>
					</fieldset>
				</form>
			</div>

			<footer class='footer'>
				<p class='text-center'>$bottomLineText</p>
			</footer>

		";
}



exit;
?>
